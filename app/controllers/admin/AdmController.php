<?php

namespace app\controllers\admin;

use vendor\core\base\Controller;
/**
 * Description of AdmController
 *
 * @author eugenie
 */
class AdmController extends Controller
{
    public $layout = 'admin';
    
    public function __construct($route) {
        parent::__construct($route);
        
    }
}
