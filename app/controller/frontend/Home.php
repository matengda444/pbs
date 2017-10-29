<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/10/26
 * Time: 14:48
 */
namespace app\controller\frontend;

use core\Controller;
use core\Model;
use app\model\User;
//use core\Model;
//use app\model\User;
class Home extends Controller
{
    public function index()
    {
        $this -> _loadHtml('index');
    }
    public function fish()
    {
        $this -> _redirect('总有刁民想害朕', 'index.php?c=Home&p=frontend&a=index');
    }
    public function pdotest()
    {
        $usermodel = new User();
        //$model = new Model() ;
        //$users = $model -> getAll('SELECT * FROM user WHERE 1 = 1');
        //var_dump($users);
        //$usermodel = new User();
        //$users = $usermodel -> findAll('1 = 1');
        //var_dump($users);
        //$usermodel = new User;
        //$usermodel -> insert(array(
            //'username' => 'upoiup',
            //'nickname' => 'puipoiup',
            //'email' => 'oiupoiu@piup.cc'
        //));
        $usermodel -> updateById(1, array(
            'username' => 'upoiup',
            'nickname' => 'puipoiup',
            'email' => 'poiupoi@spoadfiu.cc'
        ));
    }
}