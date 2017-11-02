<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/1
 * Time: 20:33
 */

namespace app\controller\backend;


use core\Controller;
use app\model\Category as CategoryModel;
use function PHPSTORM_META\elementType;

class Category extends Controller
{
    public function index()
    {
        $categoryModel = CategoryModel::model();
        $categorys = $categoryModel -> findAll();
        //var_dump($categorys);
        //$categoryModel -> test();exit();
        $categorys = $categoryModel -> noLimitCategory($categorys);
        //var_dump($a);exit();
        //var_dump($categorys);exit();
        return $this -> _loadHtml('category/index', array(
            'categorys' => $categorys
        ));
    }
    public function delete()
    {
        $id = $_GET['id'];
        //var_dump(CategoryModel::model() -> count("parent_id = '{$id}'"));
        if (CategoryModel::model()->count("parent_id = '{$id}'") == 0) {
            if (CategoryModel::model()->deleteById($id)) {
                return $this->_redirect('删除成功', '?c=Category&p=backend&a=index');
            } else {
                return $this->_redirect('删除失败', '?c=Category&p=backend&a=index');
            }
        } else {
            return $this->_redirect('有子分类,无法删除', '?c=Category&p=backend&a=index');
        }
    }
}