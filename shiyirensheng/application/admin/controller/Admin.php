<?php
namespace app\admin\controller;
use app\admin\controller\Sadmin;
use think\Session;
use think\Db;
class Admin extends Sadmin
{
    protected $is_login = ['*'];
    public function index()
    {
        $username = Session::get('username');
        $id = Db::name('sadmin')->field('rid')->where('username',$username)->select();
        if (!$id) {
            $this->error('请不要非法登录！','admin/sadmin/login');
        }
        $rid = $id[0]['rid'];
        $result = Db::name('role')->field('rid')->where('rid',$rid)->select();
        $this->assign('result',$result);
        $this->assign('id',$id);
        return $this->fetch();
    }

    //退出
    public function logout()
    {
        $username = Session::get('username');
        Session::clear($username);
        $this->success('退出成功','admin/sadmin/login');
    }

    public function home()
    {
        return $this->fetch();
    }

}
