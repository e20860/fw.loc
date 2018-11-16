<?php

namespace app\controllers;

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

/**
 * Description of PostsNew
 *
 * @author eugenie
 */
class PostsNewController extends AppController {
    //
     public function indexAction() {
        echo 'PostNew::index';
    }

    public function testAction() {
        echo 'PostNew::test';
    }   
    public function testPageAction() {
        echo 'PostNew::testPage';
    }
    public function before() {
        echo 'PostNew::before';
    }
    
}
