<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/9
 * Time: 13:39
 */

namespace app\controller\frontend;

use app\model\Category;
use app\model\Comm;
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

    public function view()
    {
        $id = $_GET['id'];
        ArticleModel::model()->increaseRead($id);
        $article = ArticleModel::model()->getArticleById($id);
        //var_dump($article);exit;
        $comments = Comm::model()->getCommByArticleId($id);
        //var_dump($comments);exit;
        $comments = Comm::model()->noLimitComment($comments);
        //var_dump($comments);exit;
        $this->_smarty->assign('comments', $comments);
        $this->_smarty->assign('article', $article);
        $this->_smarty->display('article/view.html');
    }

    public function praise()
    {
        $id = $_GET['id'];
        //var_dump(ArticleModel::model()->increasePraise($id));exit;
        if (!isset($_SESSION['praise_' . $id])) {
            if (ArticleModel::model()->increasePraise($id)) {
                $_SESSION['praise_' . $id] = true;
                return $this->_redirect('点赞成功', '?c=Article&p=frontend&a=view&id=' . $id);
            } else {
                return $this->_redirect('点赞失败', '?c=Article&p=frontend&a=view&id=' . $id);
            }
        } else {
            return $this->_redirect('不能重复点赞', '?p=frontend&c=Article&a=view&id=' . $id);
        }
    }
}