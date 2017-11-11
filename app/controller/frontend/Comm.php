<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/11
 * Time: 15:10
 */

namespace app\controller\frontend;

use app\controller;
use app\model\Comm as CommModel;
class Comm extends \core\Controller
{
    public function add()
    {
        if (!isset($_SESSION['loginFlag'])) {//如果session里的loginFlag不存在,表明没有登录
            $_SESSION['loginFlag'] = false;
        }
        if ($_SESSION['loginFlag'] == false) {//没有登录
            return $this->_redirect('登录后评论', '?c=User&p=backend&a=login');
        }
        //var_dump($_POST);
        if (CommModel::model()->insert(array(
            'user_id' => $_SESSION['user']['id'],
            'publish_time' => time(),
            'content' => htmlspecialchars(addslashes($_POST['txaArticle'])),
            'reply_id' => $_POST['inpRevID'],
            'article_id' => $_POST['a_id']
        ))) {
            return $this->_redirect('评论成功', '?c=Article&p=frontend&a=view&id=' . $_POST['a_id']);
        } else {
            return $this->_redirect('评论失败', '?c=Article&p=frontend&a=view&id=' . $_POST['a_id']);
        }
    }
}