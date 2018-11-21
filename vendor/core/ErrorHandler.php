<?php

namespace vendor\core;

/**
 * Обработчик ошибок и исключений фреймворка
 * 
 * Переключает системные обработчики ошибок и исключений на себя
 *  До использования должна быть объявлена константа DEBUG
 *  DEBUG = 0 - вариант боевой (ошибки не детализируются)
 *  DEBUG = 1 - вариант разработки (ошибки детализируются в выводе)
 *  использует 3 шаблона вывода (хранятся в /errors/ (404.html, dev.php, prod.php)
 *  Ведёт протокол ошибок (/tmp/errors.log)
 * 
 * @author eugenie
 */
class ErrorHandler 
{
    public function __construct() {
        if (DEBUG) {
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this,'fatalErrorHandler']);
        set_exception_handler([$this,'exceptionHandler']);
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
    
    public function exceptionHandler($e)
    {
        $this->display_error('Исключение',$e->getMessage(), $e->getFile(), $e->getLine(),$e->getCode());
    }
    
    /**
     *  Выводит в поток сообщение об ошибки, заносит ошибку в системный протокол
     *  Использует два вида вывода ошибок (разработка = dev.php  и работа=prod.php)
     *  Стандартные параметры используются в видах
     * @param int $errno Номер ошибки
     * @param str $errstr Строка  описания ошибки
     * @param str $errfile Файл, в котором произошла ошибка
     * @param str $errline № Строки, содержащей ошибку
     * @param str $responce HTTP - код возврата
     */
    protected function display_error($errno, $errstr, $errfile, $errline, $responce=500)
    {
        http_response_code($responce);
        if ($responce == 404 && !DEBUG) {
            require WWW . '/errors/404.html';
            $this->logErrors($errstr, $errfile, $errline);
            exit();
        }
        if (DEBUG) {
            require WWW . '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        $this->logErrors($errstr, $errfile, $errline);
        exit();
    }
    
    /**
     *  Заносит в протокол информацию об ошибке
     * @param string $message
     * @param string $file
     * @param string $line
     */
    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" .date('Y-m-d h:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n------------------------------\n", 3, ROOT . '/tmp/errorrs.log');        
    }
}
   

