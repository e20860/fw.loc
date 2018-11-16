<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace vendor\core;

/**
 * Description of db
 *
 * @author eugenie
 */
class Db {
    
    use TSingletone;
    
    protected $pdo;
    //protected static $instance;
    public static $countSql = 0;
    public static $queries = [];
    
    protected function __construct() {
        $db = require ROOT .'/config/config_db.php';
        $qq = require LIBS .'/rb-mysql.php';
        \R::setup($db['dsn'], $db['user'], $db['pass']);
        \R::freeze(TRUE);
//        \R::fancyDebug(TRUE);        
    }
    
//    public static function instance() {
//        if(is_null(self::$instance)) {
//            self::$instance = new self;
//        }
//        return self::$instance;
//    }
    
}
