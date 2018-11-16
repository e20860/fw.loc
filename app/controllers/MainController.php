<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\App;

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

/**
 * Description of Main
 *
 * @author eugenie
 */
class MainController extends AppController {
    //Можно добавить шаблони вид для контроллера
    public function indexAction() {
        
        $model = new Main;
        $posts = App::$app->cache->get('posts');
        if (!$posts) {
            $posts = \R::findAll('articles');
            App::$app->cache->set('posts', $posts);
        }
        
        $menu  = \R::findAll('category');
        //
        $title = 'PAGE TITLE';
        //$this->setMeta('Главная страница', 'Описане страницы', 'Ключевые слова');
        //$meta = $this->meta;
        \vendor\core\base\View::setMeta('Главная страница', 'Описане страницы', 'Ключевые слова');
        $this->set(compact('title','posts','menu', 'meta'));
        //$this->layout = 'main';
        //$this->view ='test';
    } 
    public function testAction() {
        if ($this->isAjax()) {
           $model = new Main();
           $post = \R::findOne('articles', "id = {$_POST['id']}");
           //debug($post);
           $this->loadView('ajax', compact('post'));
           exit();
        }
        $model = new Main;
        $this->layout = 'main';
        $this->view = 'test';

    }
}
