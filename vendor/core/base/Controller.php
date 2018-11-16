<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace vendor\core\base;

/**
 * Description of Controller
 *
 * @author eugenie
 */
abstract class Controller {
    
    /**
     * Текущий маршрут 
     * @var array
     */
    public $route = [];
    
    /**
     * Текущий вид
     * @var string Description
     */
    public $view;

    /**
     * Текущий шаблон
     * @var string
     */
    public $layout;
    
    /**
     * Пользовательские данные
     * @var array
     */
    public $vars =[];
    
    
    public function __construct($route) {
        $this->route = $route;
        $this->view = $route['action'];
    }
    
    public function getView() {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
        
    }
    
    public function set($vars) {
        $this->vars = $vars;
        
    }
    
    public function isAjax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&$_SERVER['HTTP_X_REQUESTED_WITH'] ==='XMLHttpRequest';
    }
    
    public function loadView($view, $vars = []) {
        extract($vars);
        require  APP ."/views/{$this->route['controller']}/{$view}.php";
        
    }
}
