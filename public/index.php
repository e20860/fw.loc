<?php
/* * 
 *  Главная точка входа в систему
 * 
 * 
 */
use vendor\core\Router;

ini_set('display_errors', 'On');
define('DEBUG', 1);
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__) .'/vendor/libs');
define('APP', dirname(__DIR__) . '/app');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('LAYOUT','default');

$query = rtrim($_SERVER['QUERY_STRING'],'/');

//require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

// Классы грузятся и регистрируются автоматом
spl_autoload_register(function($class){
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_file($file)) {
        require_once $file;
    }
});

new vendor\core\App;

// Пользовательские маршруты (если надо что-то сделать нестандартно)
// например, перенаправить pages на Posts
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller'=> 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

//маршруты по умолчанию
// Если пустой URL - перенаправляется на главную страницу
Router::add('^$',['controller' => 'Main', 'action' => 'index']);

// Во всех остальных случаях - первый параметр - controller
// второй - action, дальше - параметры самого action
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getroutes());

Router::dispatch($query);

    