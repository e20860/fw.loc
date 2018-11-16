<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace app\controllers;

use app\models\Main;
/**
 * Description of Page
 *
 * @author eugenie
 */
class PageController extends AppController {
    
        public function indexAction() {
            $model = new Main;
            $menu  = \R::findAll('category');

            $title = 'СТРАНИЦА';
            $this->set(compact('title','menu'));
            
        }    

}
