<?php

namespace app\controllers;

/**
 * Контроллер управления  пользователями
 *
 * @author eugenie
 */
class UserController extends AppController
{
    public function signupAction()
    {
        $user = new \app\models\User();
        if(!empty($_POST)) {
            $user = new \app\models\User();
            $data = $_POST;
            $user->load($data);
            if($user->validate($data) && $user->checkUnique()) {
                //OK
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if($user->save('user')) {
                    $_SESSION['success'] = 'Вы успешно зарегистрированы';
                } else {
                    $_SESSION['error'] = 'Ошибка записи';
                    redirect();
                }
            } else {
                // Mot OK
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }
        }
        $menu  = \R::findAll('category');
        $this->set(compact('menu'));
        
    }
    public function loginAction()
    {
        $user = new \app\models\User;
        if(!empty($_POST)){
            if($user->login()) {
                $_SESSION['success'] = 'Вы успешно авторизованы';
            } else {
                $_SESSION['error'] = 'Ошибка авторизации';
                redirect();
            }
        }
        \vendor\fw\core\base\View::setMeta('Вход');
        
        $menu  = \R::findAll('category');
        $title = 'Вход';
        $this->set(compact('menu','title'));
    }
    
    public function logoutAction()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        redirect();
    }
    
}
