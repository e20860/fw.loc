<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace app\controllers;

/**
 * Description of App
 *
 * @author eugenie
 */
class AppController extends \vendor\core\base\Controller {
    public $meta = [];
    //put your code here
    protected function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title']    = $title;
        $this->meta['desc']     = $desc;
        $this->meta['keywords'] = $keywords;
    }            
}
