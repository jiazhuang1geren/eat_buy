<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use app\admin\model\Role;
class Assecc extends Controller
{
    public function admin_competence()
    {
        //管理角色表
        $role = Role::all();
        $this->assign('role',$role);
        return $this->fetch();
    }

    public function administrator()
    {
        //管理用户表
        $result = Db::name('sadmin')->select();
        //管理角色表
        $role   = Db::name('role')->select();
        $this->assign('role',$role);
        $this->assign('result',$result);
        return $this->fetch();
    }


    public function admin_info()
    {
        $username = Session::get('username');
        $user = Db::name('sadmin')->where('username',$username)->select();
        $rid = $user[0]['rid'];
        Session::set('rid',$rid);
        $acc = Db::name('role')->where('rid',$rid)->select();
        $this->assign('acc',$acc);
        $this->assign('user',$user);
        return $this->fetch();
    }


    public function competence()
    {
        //管理员
        $assecc = Db::name('sadmin')->where('uid>1')->select();
        //角色
        $role = Db::name('role')->where('rid>0')->select();
        //权限
        $stu = Db::name('assecc')->select();

        $this->assign('role',$role);
        $this->assign('stu',$stu);
        $this->assign('assecc',$assecc);
        return $this->fetch();
    }

    //添加权限
    public function add_ass()
    {
        if (Request::instance()->isPost()) {
            $aname = Request::instance()->param('acc');
            $data['aname'] = $aname;
            $add = Db::name('assecc')->insert($data);
            if ($add) {
                return true;
            }
        }
    }

    //权限分配
    public function add_role_access()
    {
        if (Request::instance()->isPost()) {
            $rid = Request::instance()->param('rid');
            $aid = Request::instance()->param('aid');
            $data['rid'] = $rid;
            $data['aid'] = $aid;
            $add_r = Db::name('role_access')->insert($data);
            if ($add_r) {
                return true;
            }
        }
    }

    //启用更新delete_time
    public function update_t()
    {
        if (Request::instance()->isPost()) {
            $id = Request::instance()->param('id');
            $up = Db::name('role')->where('rid',$id)->update(['delete_time' => null,'update_time'=> null]);
            if ($up) {
                return true;
            }
        }
    }

    //修改个人信息
    public function updada()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $rid = Session::get('rid');
            $name  = input('post.name');
            $sex   = input('post.sex');
            $age   = input('post.age');
            $phone = input('post.phone');
            $mail  = input('post.mail');
            $data['username'] = $name;
            $data['sex']      = $sex;
            $data['age']      = $age;
            $data['phone']    = $phone;
            $data['email']    = $mail;
            $res = Db::name('sadmin')->where('rid',$rid)->update($data);
            if ($res) {
                return true;
            }
        }
    }

    public function mima()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $rid = Session::get('rid');
            $pwd = md5(input('post.pwd'));
            $res = Db::name('sadmin')->where(['rid'=>$rid])->select();
            $pass = $res[0]['password'];
            if ($pass != $pwd) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function up_xiugai()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $rid = Session::get('rid');
            $rpwd = md5(input('post.rpwd'));
            $data['password'] = $rpwd;
            $res = Db::name('sadmin')->where(['rid'=>$rid])->update($data);
            if ($res) {
                return true;
            }
        }
    }
}