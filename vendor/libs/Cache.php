<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace vendor\libs;

/**
 * Description of cache
 *
 * @author eugenie
 */
class Cache {
    
    public function __construct() {
        
    }
    
    public function set($key, $data, $seconds = 3600) {
        
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        if(file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
            return TRUE;
        }
        echo 'NoNoNo';
        return FALSE;
    }
    
    public function get($key) {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            }
            // Кэш устарел
            unlink($file);
        }
        // Файла нет или устарел
        return FALSE;
    }
    
    public function delete($key) {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
        
    }
            
}
