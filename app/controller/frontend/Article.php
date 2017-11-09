<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/9
 * Time: 13:39
 */

namespace app\controller\frontend;

use core\Controller;
use app\model\Article as ArticleModel;

class Article extends Controller
{
    public function index()
    {
        $articles = Article::model()->findAll();
        return $this->_loadHtml('article/index' array(
            'articles' => $articles
    ));
    }
}