<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/3
 * Time: 14:39
 */

namespace app\controller\backend;


use core\Controller;
use app\model\Article as ArticleModel;
use app\model\Category;

class Article extends Controller
{
    public function add()
    {
        if ($_POST) {
            if (ArticleModel::model()->insert(array(
                'name' => $_POST['Title'],
                'content' => $_POST['Content'],
                'category_id' => $_POST['CateID'],
                'status' => $_POST['Status'],
                'publish_date' => strtotime($_POST['PostTime']),
                'is_top' => isset($_POST['isTop']) ? 1 : 2
            ))) {
                return $this->_redirect('添加成功', '?c=Article&p=backend&a=index');
            } else {
                return $this->_redirect('添加失败', '?c=Article&p=backend&a=index');
            }
        } else {
            $categorys = Category::model()->noLimitCategory(Category::model()->findAll());
            return $this->_loadHtml('article/add', array(
                'categorys' => $categorys
            ));
        }
    }
}