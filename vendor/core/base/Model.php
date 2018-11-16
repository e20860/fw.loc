<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace vendor\core\base;

use vendor\core\Db;

/**
 * Description of Model
 *
 * @author eugenie
 */
abstract class Model {
    
    protected $pdo;
    protected $table;
    protected $pk = 'id';


    public function __construct() {
        $this->pdo = Db::instance();
    }
    
    public function query($sql) {
        return $this->pdo->execute($sql, $params);
    }
    
    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
    
    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    } 
    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }
    public function findLike($str, $field, $table = [])
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }
}
