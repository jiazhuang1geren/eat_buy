<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Sadmin extends Model
{
	//用户名
	public function nameInfo($name)
	{
		$res = Db::name('sadmin')->where('username',$name)->find();
		return $res;
	}

	//密码
	public function pwdInfo($pwd)
	{
		$res = Db::name('sadmin')->where('password',$pwd)->find();
		return $res;
	}
}