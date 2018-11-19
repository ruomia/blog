<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Category;
class CategoryController extends Controller
{
    protected $middleware = ['Login'];

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = Category::all();
        // return $data;
        return $this->fetch('index',[
            'data'=>$data,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $data = Category::all();
        // $data = [1,2,3,45];
        return $this->fetch('create',[
            'data'=>$data
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    { 
        $result = Category::create($request->param());
        // if($result){
        //     //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
        //     return $this->success('新增成功', '/category');
        // } else {
        //     //错误页面的默认跳转页面是返回前一页，通常不需要设置
        //     return $this->error('新增失败');
        // }
        // dump($request->param());
        $this->redirect('/category');
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
        $data = Category::find($id);
        return $this->fetch('edit',[
            'data'=>$data
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
        $model = Category::get($id);
        $model->name = $request->name;
        $model->pid = $request->pid;
        $model->save();
        return $this->redirect('/category');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        Category::destroy($id);
        return $this->redirect('/category');
    }
}
