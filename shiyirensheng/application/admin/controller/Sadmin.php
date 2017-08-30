<?php
namespace app\admin\controller;
use think\Request;
use think\Controller;
use think\Session;
use think\Db;
use app\admin\model\Sadmin as SadminModel;
class Sadmin extends Controller
{
    protected $is_login = [''];
    public function _initialize()
    {
        if (!$this->checklogin() && $this->is_login[0] == '*') {
            $this->error('您还没有登录，请先登录',url('admin/sadmin/login'));
        }
    }    
    
    public function checklogin()
    {
        return Session::get('username');
    }
    
    public function login()
    {
        return $this->fetch();
    }

    public function dologin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = input('post.uname');
            $result = db('sadmin')->where('username',$name)->find();
            $username = $result['username'];
            Session::set('username',$username);
            if ($result) {
                $this->success('登录成功 ',url('admin/admin/index'));
            } else {
                $this->error('您还没有登录，请先登录',url('admin/sadmin/login'));
            }
        }
    }

    //用户名
    public function name()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = input('post.uname');
            $user = new SadminModel();
            $res  = $user->nameInfo($name);
            $username = $res['username'];
            if (!$username) {
                return false;
            } else {
                return true;
            }
        }  
    }

    //密码
    public function rpassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pwd  = md5(trim(input('post.password')));
            $user = new SadminModel();
            $res  = $user->pwdInfo($pwd);
            $password = $res['password'];
            if (!$password) {
                return false;
            } else {
                return true;
            }
        }
    }

    //验证码
    public function code()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $yzm = trim(input('post.code'));
            if (captcha_check($yzm)){
                return true;
            } else {
                return false;
            }
        }
    }

    //添加管理
    public function addAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['username'] = input('post.name');
            $data['password'] = md5(input('post.npwd'));
            $data['phone']    = input('post.utel');
            $data['email']    = input('post.email');
            $data['sex']      = input('post.ace');
            $data['rid']      = input('post.sec');
            date_default_timezone_set("PRC");
            $data['create_time'] = date("Y-m-d H:i:s");
            $regip = $_SERVER['REMOTE_ADDR'];
            if ($regip == '::1') {
                $regip = '127.0.0.1';
            }
            $data['login_ip'] = ip2long($regip);
            $res = Db::name('sadmin')->insert($data);
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }
}