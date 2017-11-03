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
}