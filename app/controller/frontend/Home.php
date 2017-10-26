<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/26
 * Time: 14:48
 */
namespace app\controller\frontend;


use core\Controller;
//use core\Model;
//use app\model\User;
class Home extends Controller
{
    public function index()
    {
        echo 'hello,world';
    }
    public function fish()
    {
        $this->_redirect('总有刁民想害朕', 'index.php?c=Home&p=frontend&a=index');
    }
}