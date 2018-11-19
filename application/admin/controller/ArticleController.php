<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Article;
use app\admin\model\Category;
class ArticleController extends Controller
{
    protected $middleware = ['Login'];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = Article::alias('a')
        ->leftJoin('category b','a.cat_id = b.id')
        ->field(['a.id','cat_id','title','b.name','is_show'])
        ->paginate(7);
        // return $data;
        $this->assign('data',$data);
        return $this->fetch('index');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $data = Category::all();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $model = new Article;
        $model->title = $request->title;
        $model->cat_id = $request->cat_id;
        $model->content = $request->content;
        $model->is_show = $request->is_show;
        $model->short_content = $request->short_content;
        $file = $request->file('image');
        // 先判断是否上传了图片
        if ($this->validate(['image' => $file], ['image' => 'require|image'])) {
            $info = $file->move('uploads');//默认保存在网站根目录，也就是public/下
            if($info){
                $model->image = $info->getSaveName();
            }
        } 

        
        $model->save();
        return $this->success('新增成功','/article');

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $art = Article::get($id);
        $data = Category::all();

   
        return $this->fetch('edit',[
            'art' => $art,
            'data' => $data,
        ]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $model = Article::get($id);
        $model->title = $request->title;
        $model->cat_id = $request->cat_id;
        $model->content = $request->content;
        $model->is_show = $request->is_show;
        $model->short_content = $request->short_content;
       
        if($request->has('image'))//判断是否上传了图片
        {
            $file = $request->file('image');
            $info = $file->move('uploads');//默认保存在网站根目录，也就是public/下
            if($info){
                @unlink('uploads/'.$model->image);

                $model->image = $info->getSaveName();
            }
        }
        $model->save();
        return $this->success('更改成功','/article');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $model = Article::get($id);
        @unlink('uploads/'.$model->image);
        $model->delete();
        return $this->success('删除成功','/article');

    }
}
