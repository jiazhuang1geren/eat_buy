<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\Model\User as UserModel;
use think\Db;
class User extends Controller
{
    public function user_list()
    {
        $user = UserModel::all();
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function member_grading()
    {
        return $this->fetch();
    }

    public function integration()
    {
        return $this->fetch();
    }

    public function member_show()
    {
        return $this->fetch();
    }
    
}