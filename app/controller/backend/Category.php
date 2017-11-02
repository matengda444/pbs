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
}