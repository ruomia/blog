<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\User;
class LoginController extends Controller
{
    
    public function login()
    {
        return $this->fetch();
    }

 
    public function store(Request $request)
    {
        // return $request;
        $user = User::where('username',$request->username)
        ->where('password', md5($request->password))
        ->find();
        if($user!=null)
        {
            session('name',$user->username);
            session('id',$user->id);
            return $this->redirect('/admin/index');
        }
        else
        {
            return $this->error('用户名或者密码错误');
        }
    }
    public function logout()
    {
        session(null);
        return $this->redirect('/admin/login');
    }

    
}
