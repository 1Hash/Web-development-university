<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'de_tcc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

class DB{

    public static function PDO($sql) {

        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname='. DB_NAME, DB_USER, DB_PASSWORD);
        $pdo->exec("SET CHARACTER SET utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo->query($sql);
    }

    private static $instance;

    public static function getInstance(){

        if(!isset(self::$instance)) {

            try {
                
                self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname='. DB_NAME, DB_USER, DB_PASSWORD);
                self::$instance->exec("SET CHARACTER SET utf8");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                
            } catch (PDOException $e) {
                
                echo  $e->getMessage();	
            }
        }
        return self::$instance;
    }
	
    public static function prepare($sql) {
        
        return self::getInstance()->prepare($sql);
    }
}