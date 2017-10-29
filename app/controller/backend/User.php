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
        $this -> _loadHtml('userlist', array(
            'users' => $users
        ));
    }
    public function delete()
    {
        $userModel = new UserModel();
        $id = $_GET['id'];
        if ($userModel -> deleteById($id)) {
            return $this -> _redirect("{$id} 删除成功", '?c=User&p=backend&a=index');
        } else {
            return $this -> _redirect("{$id} 删除失败", '?c=User&p=backend&a=index');
        }
    }
    public function add()
    {
        var_dump($_POST);
        if (!empty($_POST)) {
            $userModel = new UserModel();
            if ($userModel -> insert(array(
                'username' => $_POST['Name'],
                'nickname' => $_POST['Alias'],
                'email' => $_POST['Email']
            ))) {
                return $this -> _redirect("{$_POST['Name']} 添加成功", '?c=User&p=backend&a=index');
            } else {
                return $this -> _redirect("{$_POST['Name']} 添加失败", '?c=User&p=backend&a=index');
            }
        }
        $this -> _loadHtml('useradd');
    }
    public function edit()
    {
        //var_dump($_POST);
        $userModel = new UserModel();
        $id = $_GET['id'];
        if (!empty($_POST)) {
            if ($userModel -> updateById($id, array(
                'username' => $_POST['Name'],
                'nickname' => $_POST['Alias'],
                'email' => $_POST['Email']
            ))) {
                return $this -> _redirect("{$_POST['Name']} 修改成功", '?c=User&p=backend&a=index');
            } else {
                return $this -> _redirect("{$_POST['Name']} 修改失败", '?c=User&p=backend&a=edit&id=' . $id);
            }
        }
        $user = $userModel -> findById($id);
        $this -> _loadHtml('useredit', array(
            'user' => $user
        ));
    }
}