<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/26
 * Time: 21:41
 */
namespace core;

use vendor\Smarty;

class Controller
{
    protected $_smarty;

    public function __construct()
    {
        $this->_initSmarty();
    }

    public function _initSmarty()
    {
        $s = new Smarty();

        //设定左定界符
        $s->left_delimiter = '<{';
        //设定右定界符
        $s->right_delimiter = '}>';

        //templates --> view
        $s->setTemplateDir(ROOT . DS . 'app' . DS . 'view' . DS . PLATFORM);
        //templates_c --> view_c
        $s->setCompileDir(sys_get_temp_dir() . DS . 'view_c');
        $this->_smarty = $s;
    }

    protected function _redirect($msg, $url = '?', $time = 3)
    {
        echo "<h1>$msg</h1>";
        header("refresh: {$time}; url = {$url}");
    }
    protected function _loadHtml($file, $data = array())
    {
        extract($data);
        include ROOT . '/app/view/' . PLATFORM . '/' . $file . '.html';
    }
}