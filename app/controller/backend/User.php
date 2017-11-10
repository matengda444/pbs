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
use vendor\Captcha;

class User extends Controller
{
    public function index()
    {
        //$userModel = new UserModel();
        $userModel = UserModel::model();
        $users = $userModel->findAll();
        //var_dump($users);
        $this->_loadHtml('user/userlist', array(
            'users' => $users
        ));
    }

    public function delete()
    {
        $userModel = UserModel::model();
        $id = $_GET['id'];
        if ($userModel->deleteById($id)) {
            return $this->_redirect("{$id} 删除成功", '?c=User&p=backend&a=index');
        } else {
            return $this->_redirect("{$id} 删除失败", '?c=User&p=backend&a=index');
        }
    }

    public function add()
    {
        //var_dump($_POST);
        if (!empty($_POST)) {
            $userModel = UserModel::model();
            if ($userModel->insert(array(
                'username' => $_POST['Name'],
                'nickname' => $_POST['Alias'],
                'email' => $_POST['Email'],
                'password' => md5(md5($_POST['Password']))
            ))) {
                return $this->_redirect("{$_POST['Name']} 添加成功", '?c=User&p=backend&a=index');
            } else {
                return $this->_redirect("{$_POST['Name']} 添加失败", '?c=User&p=backend&a=index');
            }
        }
        $this->_loadHtml('user/useradd');
    }

    public function edit()
    {
        //var_dump($_POST);
        $userModel = UserModel::model();
        $id = $_GET['id'];
        if (!empty($_POST)) {
            if ($userModel->updateById($id, array(
                'username' => $_POST['Name'],
                'nickname' => $_POST['Alias'],
                'email' => $_POST['Email']
            ))) {
                return $this->_redirect("{$_POST['Name']} 修改成功", '?c=User&p=backend&a=index');
            } else {
                return $this->_redirect("{$_POST['Name']} 修改失败", '?c=User&p=backend&a=edit&id=' . $id);
            }
        }
        $user = $userModel->findById($id);
        $this->_loadHtml('user/useredit', array(
            'user' => $user
        ));
    }

    public function login()
    {
        return $this->_loadHtml('user/login');
    }

    public function loginCheck()
    {
        if ($_POST['edtCaptcha'] != $_SESSION['captchaCode']) {
            return $this -> _redirect('验证码错误', '?c=User&p=backend&a=login');
        }
        //var_dump($_POST);
        $userModel = new UserModel;
        //加斜杠
        $_POST['username'] = addslashes($_POST['username']);
        $user = $userModel->find("username = '{$_POST['username']}' AND password = '{$_POST['password']}'");
        //var_dump($user);
        if ($user != false) {//找到了用户
            $_SESSION['loginFlag'] = true;
            $_SESSION['user'] = $user;
            return $this -> _redirect('登录成功', '?c=Index&p=backend&a=index');
        } else {//没有找到用户
            $_SESSION['loginFlag'] = false;
            return $this -> _redirect('登录失败', '?c=Index&pbackend&a=login');
        }
    }

    public function logout()
    {
        $_SESSION['loginFlag'] = false;
        return $this -> _redirect('注销成功', '?c=User&p=backend&a=index');
    }

    public function captcha()
    {
        $captcha = new Captcha();
        $captcha -> generateCode();
        //exit();
        //var_dump($_SESSION);exit();
        $_SESSION['captchaCode'] = $captcha -> getCode();
    }

    public function test()
    {
        //echo 'asdfasdfasdfase';
        //return $this -> _redirect('asdfsadfsadfsadf', '?c=Index&p=backend&a=test');
    }

}