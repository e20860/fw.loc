<?php

namespace  vendor\core;
/**
 * Класс Router Маршрутизатор
 * Выделяет запросы к сайту и перенаправляет их для обработки
 * соответствующим контроллером используя необходимое действие
 * @author eugenie
 */
class Router {
    
    /**
     * таблица маршрутов
     * @var array 
     */
    protected static $routes = [];
    
    /**
     * текущий маршрут
     * @var array
     */
    protected static $route = [];
    
    /**
     * добавляет маршрут в таблицу маршрутов
     * 
     * @param string $regexp регулярное выражение маршрута
     * @param array $route маршрут ([controller, action, params])
     */
    public static function add($regexp,$route = []) {
        self::$routes[$regexp] = $route;
    }
    /**
     *  Возвращает таблицу маршрутов
     * @return array
     */
    public static function getroutes() {
        return self::$routes;
    }
    
    /**
     * Возвращает текущий маршрут
     * @return array
     */
    public static function getroute() {
        return self::$route;
    }
    
    /**
     * Ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return boolean
     */
    private static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            // результаты проверки $url по регулярному выражению $pattern
            // помещаются в массив $matches
            if(preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    // В маршрут переносятся только пары с символьным ключом
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return TRUE;
            }
        }
        return FALSE;
    }
    
    /**
     * Перенаправляет URL по корректному маршруту
     * @param string $url входящий URL
     * @return void 
     */
    public static function dispatch($url) {
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] .'Controller';
            if(class_exists($controller)) {
                // Если класс найден - создаётся объект контроллер
                $cObj = new $controller(self::$route);
                // Для маскировки. Каждому методу класса, являющемуся действием
                // по внешнему запросу добавляется постфикс Action
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($cObj, $action)) {
                    // И если есть метод - запускается на выполнение
                    $cObj->$action();
                    $cObj->getView();
                }else{
                    //echo "Метод <b>$controller::$action</b> не найден";
                    throw new \Exception("Метод <b>$controller::$action</b> не найден", 404);
                }
            }else{
                //echo "Контроллер <b>$controller</b> не найден";
                throw new \Exception("Контроллер <b>$controller</b> не найден", 404);
            }
        } else {
            //http_response_code(404);
            //include '404.html';
            throw new \Exception("Страница не найдена", 404);
        }
    }
    
    /**
     *  Преобразует строку вида текст-текст в ТекстТекст
     * @param string $name
     * @return string
     */
    protected static function upperCamelCase($name) {
        return str_replace(' ', '',  ucwords(str_replace('-', ' ', $name)));
    }

    /**
     *  Преобразует строку вида текст-текст в текстТекст (camelCase)
     * @param type $name
     * @return string
     */
    
    protected static function lowerCamelCase($name) {
        return lcfirst(self::upperCamelCase($name));
    }
    
    /**
     * Удаляет из запроса "чистые" GET-параметры
     */
    
    protected static function removeQueryString($url) {
        if($url){
            $params = explode('&',$url, 2);
            if(strpos($params[0], '=') === FALSE) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
            
        }
    }
} // Class
