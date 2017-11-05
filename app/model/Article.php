<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/3
 * Time: 16:04
 */

namespace app\model;


use core\Model;

class Article extends Model
{
    public function getTableName()
    {
        return 'article';
    }
    public function getList($status = 0, $categoryID = 0, $isTop = 0, $name = '', $start = 0, $size = 10)
    {
        $sql = "SELECT article.*, category.name as category_name
                FROM article
                LEFT JOIN category ON article.category_id = category.id
                WHERE 1 = 1";
        if ($status != 0) {
            $sql .= " AND article.status = {$status}";//AND前面有一个空格(链接sql语句)
        }
        if($categoryID != 0) {
            $sql .= " AND article.category_id = {$categoryID}";
        }
        if ($isTop != 0) {
            $sql .= " AND article.is_top = {$isTop}";
        }
        if ($name != '') {
            $sql .= " AND article.name LIKE '%{$name}%'";
        }
        $sql .= " limit {$start}, {$size}";
        //echo $sql;
        return $this->getAll($sql);
    }
}