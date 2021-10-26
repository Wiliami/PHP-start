<?php

/**
 * Conn.class { CONEXAO }
 * Classe abstrata de conexão. Padrão SingleTon.
 * Retorna um objeto PDO pelo método estático getConn();
 * @copyright (c) 2015, Rodrigo Oliveira, UNITBRASIL
 */
class Conn {

    protected static $Host = HOST;
    protected static $User = USER;
    protected static $Pass = PASS;
    protected static $Dbsa = null;

    /** @var PDO */
    protected static $Connect = null;

    public function __construct() {
        self::$Dbsa = (defined('DBSA') ? DBSA : (defined('DBSA_CENTRAL') ? DBSA_CENTRAL : null));
    }


    /**
     * Conecta com o banco de Dados com pattern singleton
     * Retorna um objeto PDO!
     */
    private static function Conectar() {
        try {
            if (self::$Connect == null):
                $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa . ';charset=utf8mb4'; // MODIFICAR DE ACORDO COM O TIPO DE BANCO DE DADOS
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'];
                self::$Connect = new PDO($dsn, self::$User, self::$Pass, $options); //SERVE PARA QUALQUER TIO DE BANCO DE DADOS. SOMENTE MUDA O DSN (EX: PESQUISAR QUAL DSN PARA SLQSERVER)
            endif;
        } catch (PDOException $e) {
            error_handler($e->getCode(), "Erro ao conectar: " . $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }

        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }

    /** Retorna um objeto PDO Sigleton Pattern */
    public static function getConn() {
        return self::Conectar();
    }

}
