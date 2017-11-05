<?php
/**
 * Created by PhpStorm.
 * User: sa
 * Date: 2017/11/3
 * Time: 14:39
 */

namespace app\controller\backend;


use core\Controller;
use app\model\Article as ArticleModel;
use app\model\Category;
use vendor\Pager;

class Article extends Controller
{
    public function add()
    {
        if ($_POST) {
            if (ArticleModel::model()->insert(array(
                'name' => $_POST['Title'],
                'content' => $_POST['Content'],
                'category_id' => $_POST['CateID'],
                'status' => $_POST['Status'],
                'publish_date' => strtotime($_POST['PostTime']),
                'is_top' => isset($_POST['isTop']) ? 1 : 2
            ))) {
                return $this->_redirect('添加成功', '?c=Article&p=backend&a=index');
            } else {
                return $this->_redirect('添加失败', '?c=Article&p=backend&a=index');
            }
        } else {
            $categorys = Category::model()->noLimitCategory(Category::model()->findAll());
            return $this->_loadHtml('article/add', array(
                'categorys' => $categorys
            ));
        }
    }
    public function index()
    {
        // 0表示不加这个条件(私有规定)
        $status = isset($_POST['status']) ? $_POST['status'] : 0;
        $categoryID = isset($_POST['category']) ? $_POST['category'] : 0;
        // 没有istop表示（置顶+不置顶的文章）
        // sql语句条件：不置顶的条件和不加置顶条件谁优先？
        // $isTop = isset($_POST['istop'])? 1 : 2;
        // 不置顶: SELECT * FROM article WHERE is_top=2
        // 不加置顶条件： SELECT * FROM article
        $isTop = isset($_POST['istop']) ? $_POST['istop'] : 0;
        $name = isset($_POST['search']) ? $_POST['search'] : '';
        $size = isset($_GET['size']) ? $_GET['size'] : 10;//一个页面显示多少条数据
        $page = isset($_GET['page']) ? $_GET['page'] : 1;//当前页面是多少页
        $start = ($page - 1) * $size;

        //生成分页的按钮
        $pager = new Pager(ArticleModel::model()->count(), $size, $page, '', array(
            'c' => 'Article',
            'p' => 'backend',
            'a' => 'index',
            'size' => $size
        ));
        $articles = ArticleModel::model()->getList($status, $categoryID, $isTop, $name, $start, $size);
        //var_dump($articles);exit;
        $categorys = Category::model()->noLimitCategory(Category::model()->findAll());
        var_dump($pager->showPage());exit;
        return $this->_loadHtml('article/index', array(
            'articles' => $articles,
            'categorys' => $categorys,
            'pagerHtml' => $pager -> showPage()
        ));
    }
}