<?php

define("DEBUG", 1);

/**
 * Класс ErrorHandelr Обработчик ошибок проекта
 * Перехватывает ошибки (критические и некритические) и исключения
 * 
 */

class ErrorHandler 
{
    /**
     * Переключает системные обработчики ошибок и исключений на себя
     */
    
    public function __construct() {
        if (DEBUG) {
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this,'fatalErrorHandler']);
        set_exception_handler($this,'exceptionHandler');
    }
    
    /**
     *  Обработчик стандартных некритических ошибок
     * @param int $errno
     * @param str $errstr
     * @param str $errfile
     * @param str $errline
     * @return boolean
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->display_error($errno, $errstr, $errfile, $errline);
        return true;
    }
    
    /**
     *  Обработчик критических ошибок
     */
    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            ob_end_clean();
            $errno   = $error['type'];
            $errstr  = $error['message'];
            $errfile  = $error['file'];
            $errline = $error['line'];
            $this->display_error($errno, $errstr, $errfile, $errline);
        } else {
            ob_end_flush();
        }
        
    }
    
    /**
     *  Обработчик исключений
     * @param Exception $e
     */
    
    public function exceptionHandler(Exception $e)
    {
        $this->display_error('Исключение',$e->getMessage(), $e->getFile(), $e->getLine(),$e->getCode());
    }
    
    /**
     *  Выводит в поток сообщение об ошибки, заносит ошибку в системный протокол
     *  Использует два вида вывода ошибок (разработка = dev.php  и работа=prod.php)
     *  Стандартные параметры используются в видах
     * @param int $errno
     * @param str $errstr
     * @param str $errfile
     * @param str $errline
     * @param str $responce
     */
    protected function display_error($errno, $errstr, $errfile, $errline, $responce=500)
    {
        http_response_code($responce);
        if (DEBUG) {
            require 'views/dev.php';
        } else {
            require 'views/prod.php';
        }
        error_log("[" .date('Y-m-d h:i:s') . "] Текст ошибки: {$errstr} | Файл: {$errfile} | Строка: {$errline}\n------------------------------\n",3,__DIR__ . '/errorrs.log');
        exit();
    }
}




new ErrorHandler();

echo $test;