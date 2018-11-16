<?php

namespace vendor\core;

trait TSingletone 
{
    protected static $instance;

   public static function instance() {
        if(is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
}
