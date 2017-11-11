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
        $sql = "SELECT article.*, category.name as category_name, user.username
                FROM article
                LEFT JOIN category ON article.category_id = category.id
                LEFT JOIN user ON article.user_id = user.id
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
        if ($size != 0) {
            $sql .= " limit {$start}, {$size}";
        }
        //echo $sql;
        return $this->getAll($sql);
    }

    public function getArticleById($id)
    {
        $sql = "SELECT article.*, user.username, category.name AS category_name, count(comm.id) AS comm_count
                FROM article
                LEFT JOIN user ON article.user_id = user.id
                LEFT JOIN category ON article.category_id = category.id
                LEFT JOIN comm ON article.id = comm.article_id
                WHERE article.id = {$id} GROUP BY article.id";
        return $this->getOne($sql);
    }

    public function increaseRead($id)
    {
        $sql = "UPDATE article SET `read` = `read` + 1 WHERE id = {$id}";
        return $this->exec($sql);
    }

    public function increasePraise($id)
    {
        $sql = "UPDATE `article` SET praise = praise + 1 WHERE id = {$id}";
        //var_dump($this->exec($sql));
        return $this->exec($sql);
    }
}