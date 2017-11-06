<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/5
 * Time: 19:29
 */

namespace app\controller\backend;


use core\Controller;
use app\model\Comm as CommModel;

class Comm extends Controller
{
    public function index()
    {
        $comms = CommModel::model()->getList();
        //var_dump($comms);exit;
        return $this->_loadHtml('comm/index', array(
            'icomments' => $comms
        ));
    }
    public function delete()
    {
        $id = $_GET['id'];
        if (CommModel::model()->deleteById($id)) {
            return $this->_redirect('删除成功', '?c=Comm&p=backend&a=index');
        } else {
            return $this->_redirect('删除失败', '?c=Comm&p=backend&a=index');
        }
    }
}