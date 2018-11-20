<?php
namespace app\index\controller;
use think\Controller;
use app\admin\model\Article;
use app\admin\model\Category;
class IndexController extends Controller
{
    public function index()
    {
        // 引入视图
        $article = Article::where('is_show',1)
        ->order('id desc')
        ->limit(10)
        ->select();
        $category = Category::all();
        $slide = Article::where('is_show=1')->field('id,title,image')->orderRaw('rand()')->limit(4)->select();
        $this->assign('slide',$slide);
        $this->assign('category',$category);
        $this->assign('article', $article);
        return $this->fetch();
        // return 'fasdf';
    }

    
    public function content($id)
    {
        $article = Article::find($id);
        $news = Article::order('id desc')->limit(5)->select();
        $category = Category::all();

        $this->assign('news', $news);
        $this->assign('article',$article);
        $this->assign('category',$category);

        return $this->fetch();
    }
    public function about()
    {
        $category = Category::all();

        $this->assign('category',$category);
        return $this->fetch();
    }

    public function list($id)
    {
        $data = Article::where('cat_id',$id)->paginate(15);
        $category = Category::all();

        $this->assign('data',$data);
        $this->assign('category',$category);
        $this->assign('cat_id',$id);
        return $this->fetch();
    }
}
