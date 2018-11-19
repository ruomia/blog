<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Article;
class IndexController extends Controller
{
    protected $middleware = ['Login'];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->fetch('index');
    }

    public function main()
    {
        $article_count = Article::count(); 
        $this->assign('article_count',$article_count);
        return $this->fetch();
    }
}
