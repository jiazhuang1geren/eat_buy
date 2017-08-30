<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Role extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';

	public function addRole($data)
	{
		$role = Db::name('role')->insert($data);
		return ture;
	}

	public function deleId($id)
	{
		$role = Role::destroy($id);
		return true;
	}
}