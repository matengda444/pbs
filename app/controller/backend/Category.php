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
        $categorys = $categoryModel->findAll();
        //var_dump($categorys);
        //$categoryModel -> test();exit();
        $categorys = $categoryModel->noLimitCategory($categorys);
        //var_dump($a);exit();
        //var_dump($categorys);exit();
        return $this->_loadHtml('category/index', array(
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

    public function add()
    {
        //$categorys = '';
        if ($_POST) {
            $category = array();
            $category['name'] = $_POST['Name'];
            $category['alias'] = $_POST['Alias'];
            $category['sort'] = $_POST['Order'];
            $category['parent_id'] = $_POST['ParentID'];
            if (!$_POST['Name']) {
                return $this->_redirect('名称不能为空', '?c=Category&p=backend&a=add');
            }
            if (CategoryModel::model()->insert($category)) {
                return $this->_redirect('添加分类成功', '?p=backend&c=Category&a=index');
            } else {
                return $this->_redirect('添加分类失败', '?p=backend&c=Category&a=index');
            }
        } else {
//            $categorys = CategoryModel::model()->findAll();
//            $categorys = CategoryModel::model()->noLimitCategory($categorys);
            $categorys = CategoryModel::model()->noLimitCategory(CategoryModel::model()->findAll());
            return $this->_loadHtml('category/add', array(
                'categorys' => $categorys
            ));
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        if ($_POST) {
            if (CategoryModel::model()->updateById($id, array(
                'name' => addslashes($_POST['Name']),
                'alias' => addslashes($_POST['Alias']),
                'sort' => addslashes($_POST['Order']),
                'parent_id' => addslashes($_POST['ParentID'])
            ))) {
                return $this->_loadHtml('修改成功', '?c=Category&p=backend&a=index');
            } else {
                return $this->_loadHtml('修改失败', '?c=Category&p=backend&a=edit&id=' . $id);
            }
        } else {
            $category = CategoryModel::model()->findById($id);
            $categorys = CategoryModel::model()->noLimitCategory(CategoryModel::model()->findAll($id));
            return $this->_loadHtml('category/edit', array(
                'category' => $category,
                'categorys' => $categorys
            ));
        }
    }
}