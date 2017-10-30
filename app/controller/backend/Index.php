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
        return $this -> _loadHtml('index/index');
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
}