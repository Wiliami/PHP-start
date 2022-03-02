<?php

/**
 * <b>AlterTable.class </b>{ TIPO }
 * Classe responsavel por alterar tabela no banco de dados!
 * @copyright (c) 2015, Rodrigo Oliveira, UNITBRASIL
 */
class AlterTable extends Conn {

    private $Select;
    private $Result;
    private $Tabela;

    /** @var PDOStatement */
    private $Alter;

    /** @var PDO */
    private $Conn;

    public function getResult() {
        return $this->Result;
    }

    public function getRowCount() {
        return $this->Alter->rowCount();
    }

    /**
     * Inserir ou atualizar uma Coluna na Tabela
     * @param string $Tabela - Nome da Tabela
     * @param string $Coluna - Nome da Coluna e tipo. Ex: 'nome_coluna'
     * @param string $Config - Configurações da Coluna e tipo. Ex: 'VARCHAR(255)' OU 'VARCHAR(255) AFTER colunaqueexiste'
     * @param bool $Modify - Caso a coluna exista, se deseja modificar
     */
    public function exeAlterColumn($Tabela, $Coluna, $Config, $Modify = null) {
        $this->Tabela = $Tabela;
        $ModifyCol = ($Modify == 1 ? true : false);
        if (!$this->VerifyTableExists($Tabela, $Coluna)):
            $this->Select = "ALTER TABLE {$Tabela} ADD {$Coluna} {$Config};";
            $this->Execute();
        else:
            if ($ModifyCol):
                $this->Select = "ALTER TABLE {$Tabela} MODIFY {$Coluna} {$Config};";
                $this->Execute();
            endif;
        endif;
    }

    /**
     * Alterar o nome de uma coluna de determinada tabela
     * @param string $Tabela - Tabela onde se encontra a coluna
     * @param string $Coluna - Coluna a ser alterada
     * @param bool $Nome - Novo nome para a coluna
     * @param string $Config - Configurações da Coluna e tipo. Ex: 'VARCHAR(255)' OU 'VARCHAR(255) AFTER colunaqueexiste'
     */
    public function exeAlterNameColumn($Tabela, $Coluna, $Nome, $Config) {
        $this->Tabela = $Tabela;
        if ($this->VerifyTableExists($Tabela, $Coluna)) {
            $this->Select = "ALTER TABLE {$Tabela} CHANGE {$Coluna} {$Nome} {$Config};";
            $this->Execute();
        }
    }

    /**
     * Alterar o nome de uma tabela
     * @param string $LastName - Nome antigo da tabela
     * @param string $NewName - Nome novo
     * @param string $ColumnVerify - Caso queria fazer uma segunda verificação, verifica se a tabela a ser renomeada, possui a coluna
     */
    public function exeAlterNameTable($LastName, $NewName, $ColumnVerify = null) {
        $this->Tabela = $LastName;
        if ($this->VerifyTableExists($LastName, $ColumnVerify)) {
            $this->Select = "RENAME TABLE {$LastName} TO {$NewName};";
            $this->Execute();
        }
    }

    /** Excluir uma coluna
     * @param $Table - Nome da tabela
     * @param $Column - NOme da coluna
     */
    public function exeDeleteColumn($Table, $Column) {
        $this->Tabela = $Table;
        if ($this->VerifyTableExists($Table, $Column)) {
            $this->Select = "ALTER TABLE {$Table} DROP {$Column}";
            $this->Execute();
        }
    }

    /**
     * Inserir Comando Completo para Alterar a tabela
     * @param string $Query - Comando Completo
     */
    public function fullAlter($Query) {
        $this->Select = ($Query);
        $this->Execute();
    }

    /**
     * Verifica se uma tabela ou coluna existe no banco de dados
     * @param string $Tabela - A tabela a ser consultada
     * @param string $Column - Nome da Coluna (opcional)
     * @return boolean - Se existe retorna true, se não false
     */
    public function VerifyTableExists($Tabela, $Column = null) {
        $this->Tabela = $Tabela;
        $Col = ($Column ? $Column : '*');
        $this->Select = "SELECT {$Col} FROM {$Tabela}";
        $this->ExecuteNoError();
        return $this->Result;
    }

    /**
     * Verifica se uma tabela ou coluna existe no banco de dados
     * @param STRING $DB - Database que deseja pesquisar
     * @return boolean - Se existe retorna true, se não false
     */
    public function VerifyDBExists($DB) {
        $Read = new Read();
        $Read->FullRead("SELECT SCHEMA_NAME FROM information_schema.SCHEMATA WHERE SCHEMA_NAME = :db", "db={$DB}");
        if ($Read->getResult()):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * Responsavel por criar uma tabela
     * @param STRING $DB - Nome da tabela a ser criada
     * @param STRING $Character - Código do Caractere: Padrão utf-8
     * @param STRING $Collate - Padrão: utf8_general_ci
     * @return BOOL
     */
    public function CreateDB($DB, $Character = 'utf8', $Collate = 'utf8_general_ci') {
        if (!$this->VerifyDBExists($DB)):
            $this->Select = (string) ("CREATE DATABASE `{$DB}` DEFAULT CHARACTER SET `{$Character}` DEFAULT COLLATE {$Collate};");
            $this->Execute();
        else:
            $this->Result = null;
            return false;
        endif;
    }

    /**
     * ****************************************
     * *********** PROVATE METHODS ************
     * ****************************************
     */

    /** OBTEM O PDO E PREPARE STATEMENT */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Alter = $this->Conn->prepare($this->Select);
        $this->Alter->setFetchMode(PDO::FETCH_ASSOC);
    }

    /** OBTEM A CONEXÃO E A SYNTAX E EXECUTA A QUERY */
    private function Execute() {
        $this->Connect();
        try {
            $this->Alter->execute();
            $this->Result = true;
            $this->Alter->closeCursor();
        } catch (PDOException $e) {
            $this->Result = null;
            error_handler($e->getCode(), "Tabela: {$this->Tabela} - Erro ao alterar tabela: " . $e->getMessage() . " - COMANDO: {$this->Select}", $e->getFile(), $e->getLine());
        }
    }

    /** OBTEM A CONEXÃO E MAS NÃO MOSTRA TEXTO DE ERRO SÓ TRUE OU FALSE */
    private function ExecuteNoError() {
        $this->Connect();
        try {
            $this->Alter->execute();
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = false;
        }
    }

}
