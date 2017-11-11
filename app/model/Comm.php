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
    public function getCommByArticleId($id)
    {
        $sql = "SELECT comm.*, user.username FROM comm
                LEFT JOIN user ON comm.user_id = user.id
                WHERE comm.article_id = {$id}";
        return $this->getAll($sql);
    }

    public function noLimitComment($comments, $replyId = 0)
    {
        $noLimitComments = array();
        foreach ($comments as $comment) {
            if ($comment['reply_id'] == $replyId) {
                //可能有子评论
                $comment['son'] = $this->noLimitComment($comments, $comment['id']);
                $noLimitComments[] = $comment;
            }
        }
        return $noLimitComments;
    }
}