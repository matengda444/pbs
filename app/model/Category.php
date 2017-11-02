<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/1
 * Time: 21:10
 */

namespace app\model;


use core\Model;

class Category extends Model
{
    public function getTableName()
    {
        return 'category';
    }

    public function noLimitCategory($categorys, $parentId = 0, $level = 0)
    {
        //var_dump($categorys);exit();
        static $noLimitCategory = array();

        //print_r('<pre>');var_dump($categorys);exit();
        foreach ($categorys as $category) {
            //var_dump($category);exit();
            if ($category['parent_id'] == $parentId) {
                $category['level'] = $level;
                $noLimitCategory[] = $category;
                //var_dump($category);exit();
                //var_dump($noLimitCategory);exit();
                $this -> noLimitCategory($categorys, $category['id'], $level + 1);
            }
        }
        //var_dump($noLimitCategory);exit();
        return $noLimitCategory;
    }
    public function test()
    {
        echo 1234123412342134;
    }
}