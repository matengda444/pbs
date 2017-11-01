<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/29
 * Time: 23:17
 */

namespace app\controller\backend;


use core\Controller;

class Index extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['loginFlag'])) {//如果session里的loginFlag不存在,表明没有登录
            $_SESSION['loginFlag'] = false;
        }
        if ($_SESSION['loginFlag'] == false) {//没有登录
            return $this->_redirect('请登录', '?c=User&p=backend&a=login');
        }
        return $this->_loadHtml('index/index');
    }
    public function top()
    {
        return $this -> _loadHtml('index/top');
    }
    public function menu()
    {
        return $this -> _loadHtml('index/menu');
    }
    public function content()
    {
        return $this -> _loadHtml('index/content');
    }
    public function test()
    {
        $_SESSION['loginFlag'] = null;
    }
}