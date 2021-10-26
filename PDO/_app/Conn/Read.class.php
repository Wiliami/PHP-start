<?php

/**
 * <b>Read.class </b>{ TIPO }
 * Classe responsavel por leituras genéricas no banco de dados!
 * @copyright (c) 2015, Rodrigo Oliveira, UNITBRASIL
 */
class Read extends Conn {

    private $Select;
    private $Places;
    private $Result;
    private $ResultNull;
    private $Tabela;

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function ExeRead($Tabela, $Termos = null, $ParseString = null) {
        $this->Tabela = $Tabela;
        if (!empty($ParseString)):
            parse_str($ParseString, $this->Places);
        endif;

        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getRowCount() {
        return $this->Read->rowCount();
    }

    /**
     * Responsável pela troca do DB
     * @param $Dbsa
     */
    public function setDbsa($Dbsa){
        parent::$Dbsa = $Dbsa;
        parent::$Connect = null;
    }

    /**
     * Trocar dados de conexão com o banco e refazer a conexão
     * @param STRING $Host
     * @param STRING $User
     * @param STRING $Pass
     * @param STRING $Dbsa
     */
    public function setAll($Host = null, $User = null, $Pass = null, $Dbsa = null) {
        parent::$Host = ($Host ? $Host : parent::$Host);
        parent::$User = ($User ? $User : parent::$User);
        parent::$Pass = ($Pass ? $Pass : parent::$Pass);
        parent::$Dbsa = ($Dbsa ? $Dbsa : parent::$Dbsa);
        parent::$Connect = null;
    }

    /** Passa a Query total sem separar por WHERE
     * @param string $Query - Query a ser executados
     * @param string $ParseString - Os valores das condições
     */
    public function FullRead($Query, $ParseString = null) {
        $this->Tabela = substr($Query, strpos($Query, "FROM") + 5);
        $this->Tabela = substr($this->Tabela, 0, strpos($this->Tabela, " "));
        $this->Select = (string) $Query;
        if (!empty($ParseString)):
            //parse_str($ParseString, $this->Places);
            foreach (explode('&', $ParseString) as $chunk):
                $param = explode("=", $chunk);
                $Places[$param[0]] = $param[1];
            endforeach;
            $this->Places = $Places;
        endif;

        $this->Execute();
    }

    /** Edita novamente somente a condição . Apenas altear a $ParseString */
    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
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
        $this->Read = $this->Conn->prepare($this->Select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }

    /** SINTAX DE QUERY PARA PREPARED STATEMENTS */
    private function getSyntax() {
        if ($this->Places):
            foreach ($this->Places as $Vinculo => $Valor):
                if ($Vinculo == 'limit' || $Vinculo == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Read->bindValue(":{$Vinculo}", $Valor, ( is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    /** OBTEM A CONEXÃO E A SYNTAX E EXECUTA A QUERY */
    private function Execute() {
        $this->Connect();
        try {
            $this->getSyntax();
            $this->Read->execute();
            
            $this->Result = $this->Read->fetchAll();
            if(!$this->Result){
                $this->_setResultNull();
            }
//            ini_set('memory_limit', '-1');
            $this->Read->closeCursor();
        } catch (PDOException $e) {
            $this->Result = null;
            error_handler($e->getCode(), "Tabela: {$this->Tabela} - Erro ao ler: " . $e->getMessage() . " \n Consulta: {$this->Select} \n Places: " . json_encode($this->Places), $e->getFile(), $e->getLine());
//            WSErro("Erro ao ler!  <a class='system_update'>Clique aqui para tentar resolver automaticamente</a> ou caso não funcione informe ao suporte o código abaixo:", "<pre>{$e->getMessage()} - {$e->getCode()} <br></pre>", WS_ERROR);
        }
    }

    //Devolve vazio para cada coluna
    private function _setResultNull() {
        $str = substr($this->Select, 6, strpos($this->Select, "FROM") - 6);
        $strPrev = str_replace(" ", "", $str);
        if($strPrev === '*'){
            //Executar uma consulta para retornar resultado removendo WHERE
            $this->ResultNull = $str;
        } elseif (strlen($strPrev) > 1) {
            $dtArr = [];
            foreach (explode(',', $str) as $item) {
                $key = (strpos($item, ' as ') ? substr($item, strpos($item, ' as ') + 4) : (strpos($item, '.') ? substr($item, strpos($item, '.') + 1) : $item));
                $key = str_replace(" ", "", $key);
                $dtArr[$key] = null;
            }
            $this->ResultNull = $dtArr;
        }
    }

}
