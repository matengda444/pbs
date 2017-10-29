<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/29
 * Time: 16:33
 */
namespace app\controller\backend;

use core\Controller;
use app\model\User as UserModel;//防止命名冲突

class User extends Controller
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel -> findAll();
        //var_dump($users);
        $this -> _loadHtml('userlist');
    }
}