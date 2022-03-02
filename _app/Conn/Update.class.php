<?php

/**
 * <b>Update.class </b>{ TIPO }
 * Classe responsavel por atualizações genéricas no banco de dados!
 * @copyright (c) 2015, Rodrigo Oliveira, UNITBRASIL
 */
class Update extends Conn {

    private $Tabela;
    private $Dados;
    private $Termos;
    private $Places;
    private $Result;
    private $Error;

    /** @var PDOStatement */
    private $Update;

    /** @var PDO */
    private $Conn;

    public function ExeUpdate($Tabela, array $Dados, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getRowCount() {
        return $this->Update->rowCount();
    }

    /**
     * @return mixed
     */
    public function getError() {
        return $this->Error;
    }

    /** Edita novamente somente a condição . Apenas altear a $ParseString */
    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * ****************************************
     * *********** PROVATE METHODS ************
     * ****************************************
     */

    /** OBTEM O PDO E PREPARE STATEMENT */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Update = $this->Conn->prepare($this->Update);
    }

    /** SINTAX DE QUERY PARA PREPARED STATEMENTS */
    private function getSyntax() {
        foreach ($this->Dados as $Key => $Value):
            $Places[] = $Key . ' = :' . $Key;
        endforeach;

        $Places = implode(', ', $Places);
        $this->Update = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
    }

    /** OBTEM A CONEXÃO E A SYNTAX E EXECUTA A QUERY */
    private function Execute() {
        $this->Connect();
        try {
//            ini_set('memory_limit', '-1');
            $this->Update->execute(array_merge($this->Dados, $this->Places));
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            $this->Error = $e->getMessage();
            error_handler($e->getCode(), "Tabela: {$this->Tabela} - Erro ao atualizar: " . $e->getMessage() . " - Termos: {$this->Termos} - Dados: " . json_encode($this->Dados), $e->getFile(), $e->getLine());
            //            WSErro("Erro ao Atualizar:", "{$e->getMessage()} - {$e->getCode()} - {$this->Tabela}", WS_ERROR);
        }
    }

}
