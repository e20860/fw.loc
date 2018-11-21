<?php

/*
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */

namespace vendor\widgets\menu;

/**
 * Description of Menu
 *
 * @author eugenie
 */
class Menu 
{
    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $container = "ul";
    protected $class = 'menu';
    protected $table = 'categories';
    protected $cache = 3600;
    
    public function __construct($options = []) 
    {
        $this->tpl = __DIR__ .'/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }
    
    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if(property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }
    
    protected function output()
    {
        echo "<{$this->container} class='{$this->class}'>";
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    protected function run()
    {
        $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
        $this->tree = $this->getTree();

        //debug($this->tree);
        $this->menuHtml = $this->getMenuHtml($this->tree);
        $this->output();
    }
    
    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
	foreach ($data as $id=>&$node) {    
		if (!$node['parent']){
                    $tree[$id] = &$node;
		} else { 
                    $data[$node['parent']]['childs'][$id] = &$node;
		}
	}

	return $tree;
    }
    
    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str  .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }
    
    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}