<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/5
 * Time: 19:29
 */

namespace app\model;

use core\Model;
class Comm extends Model
{
    public function getTableName()
    {
        return 'comm';
    }
    public function getList()
    {
        $sql = "SELECT comm.*, article.name AS article_name, user.username as user_name, co.content AS reply_content
                FROM comm LEFT JOIN article ON comm.article_id = article.id
                LEFT JOIN user ON comm.user_id = user.id
                LEFT JOIN comm co ON comm.reply_id = co.id";
        return $this->getAll($sql);
    }
}