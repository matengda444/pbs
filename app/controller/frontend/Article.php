<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/9
 * Time: 13:39
 */

namespace app\controller\frontend;

use app\model\Category;
use core\Controller;
use app\model\Article as ArticleModel;
use vendor\Pager;

class Article extends Controller
{
    public function index()
    {
        $q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';

        $size = 2;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $where = "name like '%{$q}%'";
        $pager = new Pager(ArticleModel::model()->count($where), $size, $page, '', array(
            'p' => 'frontend',
            'a' => 'index',
            'c' => 'Article',
            'size' => $size,
            'q' => $q
        ));
        $pagerButtons = $pager->showPage();
        $start = ($page - 1) * $size;
        $articles = ArticleModel::model()->getList(0, 0, 0, $q, $start, $size);
        //var_dump($articles);exit;
//        return $this->_loadHtml('article/index', array(
//            'articles' => $articles
//    ));
        $categorys = Category::model()->noLimitCategory(Category::model()->findAll());
        $this->_smarty->assign('articles', $articles);
        $this->_smarty->assign('categorys', $categorys);
        $this->_smarty->assign('pagerButtons', $pagerButtons);
        $this->_smarty->display('article/index.html');
        //return $this->_loadHtml('article/index');
    }
}