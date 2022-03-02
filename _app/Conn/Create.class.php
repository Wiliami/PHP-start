<?php

/**
 * <b>Create.class </b>{ TIPO }
 * Classe responsavel por cadastros genéricos no banco de dados!
 * @copyright (c) 2015, Rodrigo Oliveira, UNITBRASIL
 */
class Create extends Conn {

    private $Tabela;
    private $Dados;
    private $Result;
    private $Error;

    /** @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * <br>ExeCreate:</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com nome da coluna e valor!
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array atribuitivo. ['Nome da Coluna' => 'Valor']
     */
    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $this->getSyntax();
        $this->Execute();
    }

    /**
     * Retorna o resultado de dados inseridos na tabela TRUE ou FALSE
     * @return TRUE
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * @return mixed
     */
    public function getError() {
        return $this->Error;
    }

    /**
     * ****************************************
     * *********** PROVATE METHODS ************
     * ****************************************
     */

    /** @var PREPARE STATEMENT */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }

    /** SINTAX DE PESQUISA */
    private function getSyntax() {
        $Fileds = implode(', ', array_keys($this->Dados)); //PEGAR OS DADOS KEYS (NOME DAS COLUNAS) DENTRO DO ARRAY GERADO NO EXECREATE 
        $Places = ':' . implode(', :', array_keys($this->Dados)); //PEGA OS LINKS (A SER SUBSTITUIDO PELO BINDVALUES) DENTRO DO ARRAY E COLOCA OS DOIS PONTOS NOS LINKS
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }

    /** EXECUCAO NO BANCO DE DADOS */
    private function Execute() {
        $this->Connect();
        try {
//            ini_set('memory_limit', '-1');
            $this->Create->execute($this->Dados);
            $LastId = $this->Conn->lastInsertId();
            $this->Result = ($LastId ? $LastId : true);
        } catch (PDOException $e) {
            $this->Error = $e->getMessage();
            $this->Result = null;
            error_handler($e->getCode(), "Tabela: {$this->Tabela} - Erro ao cadastrar: " . $e->getMessage() . " - Dados: " . json_encode($this->Dados), $e->getFile(), $e->getLine());
           // WSErro("Erro ao cadastrar!  <a class='system_update'>Clique aqui para tentar resolver automaticamente</a> ou caso não funcione informe ao suporte o código abaixo:", "<pre>{$e->getMessage()} - {$e->getCode()} <br></pre>", WS_ERROR);
        }
    }

}
