<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace vendor\core\base;

/**
 * Description of View
 *
 * @author eugenie
 */
class View {
    /**
     * Текущий маршрут вида
     * @var array
     */
    public $route = [];
    
    /**
     * Текущий вид
     * @var string Description
     */
    public $view;

    /**
     * Текущий шаблон вида
     * @var string
     */
    public $layout;
    
    /**
     * Хранилище скриптов
     * @var array
     */
    public $scripts = [];

    public static $meta = ['title' => '', 'desc' => '', 'keywords'=> ''];
    /**
     *  Конструктор
     * @param type $route
     * @param type $layout
     * @param type $view
     */
    
    public function __construct($route, $layout='', $view='') {
        $this->route = $route;
        
        if($layout === FALSE){
            $this->layout = FALSE;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }
            
        $this->view = $view;
        
    }
    public function render($vars) {
        // Массив переменных превращаем в отдельные переменные
        if(is_array($vars)) extract($vars);
        // Определяем вид
        $prefix = str_replace('\\', '/', $this->route['prefix']);
        $file_view   = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if(is_file($file_view)) {
            require $file_view;
        } else {
            
            //echo "<p>Не найден вид <b>{$file_view}</b></p>";
            throw new \Exception("<p>Не найден вид <b>{$file_view}</b></p>", 404);
        }
        $content = ob_get_clean();
        // При необходимости, определяем шаблон
        if(FALSE != $this->layout){
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($file_layout)){
                $content = $this->cutScript($content);
                $scripts = [];
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require $file_layout;
            } else {
                //echo "<p>Не найден шаблон <b>{$file_layout}</b></p>";
                throw new \Exception("<p>Не найден шаблон <b>{$file_layout}</b></p>", 404);
            }
        }
    }
    
    /**
     * Вырезает скрипты из контента, чтобы вставить их после объявления jquery
     * @param type $content
     */
    protected function cutScript($content) {
        $pattern =  "#\<script.*?\>.*?\<\/script\>#si";
        if (!empty(preg_match_all($pattern, $content, $this->scripts))) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
        
    }
    
    public static function getMeta() {
       $str = '<title>' . self::$meta['title'] . '</title>'
               . '<meta name="description" content="' . self::$meta['desc'] .'">'
               . '<meta name="keywords" content="' . self::$meta['keywords'] .'">'; 
       echo $str;
       
    }
    public static function setMeta($title='', $desc='',$keywords='') {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }
    
}
