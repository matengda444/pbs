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
        return $this -> _loadHtml('index');
    }
    public function top()
    {
        echo 'top';
    }
    public function menu()
    {
        echo 'menu';
    }
    public function content()
    {
        echo 'content';
    }
}