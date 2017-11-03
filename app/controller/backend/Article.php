<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/3
 * Time: 14:39
 */

namespace app\controller\backend;


use core\Controller;

class Article extends Controller
{
    public function add()
    {
        if ($_POST) {

        } else {
            return $this->_loadHtml('article/add');
        }
    }
}