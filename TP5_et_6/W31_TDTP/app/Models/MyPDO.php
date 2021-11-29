<?php

require_once('bdd.php');

class MyPDO
{
    private static ?PDO $_pdo = null;

    private function __construct() {}

	public static function pdo() : PDO
    {
        global $SQL_DSN;
        if ( self::$_pdo == null )
            self::$_pdo = new PDO($SQL_DSN);
        return self::$_pdo;
	}
}
