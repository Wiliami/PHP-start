<?php

/**
 * <b>Delete.class </b>{ TIPO }
 * Classe responsavel por deletar genericamente no banco de dados!
 * @copyright (c) 2015, Rodrigo Oliveira, UNITBRASIL
 */
class Delete extends Conn {

    private $Tabela;
    private $Termos;
    private $Places;
    private $Result;
    private $Error;

    /** @var PDOStatement */
    private $Delete;

    /** @var PDO */
    private $Conn;

    public function ExeDelete($Tabela, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getRowCount() {
        return $this->Delete->rowCount();
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
        $this->Delete = $this->Conn->prepare($this->Delete);
    }

    /** SINTAX DE QUERY PARA PREPARED STATEMENTS */
    private function getSyntax() {
        $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";
    }

    /** OBTEM A CONEXÃO E A SYNTAX E EXECUTA A QUERY */
    private function Execute() {
        $this->Connect();
        try {
            $this->Delete->execute($this->Places);
            $this->Result = true;
            $this->Delete->closeCursor();
        } catch (PDOxception $e) {
            $this->Result = null;
            $this->Error = $e->getMessage();
            error_handler($e->getCode(), "Tabela: {$this->Tabela} - Erro ao deletar: " . $e->getMessage(), $e->getFile(), $e->getLine());
//            WSErro("Erro ao Deletar:", "{$e->getMessage()} - {$e->getCode()} - {$this->Tabela}", WS_ERROR);
        }
    }

}
