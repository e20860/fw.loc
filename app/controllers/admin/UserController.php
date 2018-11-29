<?php


namespace app\controllers\admin;

use vendor\fw\core\base\View;

/**
 * UserController
 * Общий административный контроллер
 * @author eugenie
 */
class UserController extends AdmController
{
    public function indexAction()
    {
        // Установка метеданных
        View::setMeta('Админка', 'Главная страница', 'трали-вали');

        //Передача переменных
        $test = 'Тестовая переменная';
        $data = ['test',2];
 //       $this->set([
 //           'test'=>$test,
 //           'data'=>$data,
 //       ]);
 $this->set(compact('test','data'));
        
    }
    public function testAction()
    {
        
    }
    
}
