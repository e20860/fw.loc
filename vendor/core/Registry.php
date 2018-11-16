<?php

namespace vendor\core;

/**
 * класс Registry
 * регистратор
 * используется для фиксации настроек
 * @author eugenie
 */
class Registry {
    
    use TSingletone;
    
    public static $objects = [];
    //protected static $instance;
    
    private function __construct() { 
        require_once ROOT .'/config/config.php'; // $config объфвлена там;
        foreach ($config['components'] as $name=> $component) {
            self::$objects[$name] = new $component;
        }
        
    }
    
//    public static function instance() {
//        if(is_null(self::$instance)) {
//            self::$instance = new self;
//        }
//        return self::$instance;  
//    }
    
    public function __get($name) {
        if (is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
        return NULL;  // Если не нашли
    }
    
    public function __set($name, $object) {
        if (!isset(self::$objects[$object])) {
            self::$objects[$name] = new $object;
        }
        
    }
    
}



