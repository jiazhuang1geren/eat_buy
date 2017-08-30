<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Role as RoModel;
class Role extends Controller
{
	//添加角色
	public function add_role()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = input('post.name');
            $cont = input('post.cont');
            $data['uname'] = $name;
            $data['contents'] = $cont;
            $data['create_time'] = date('Y-m-d H:i:s');
            $role = new RoModel();
            $resu = $role->addRole($data);
            if ($resu) {
                return true;
            }
        }
    }

    //软删除
    public function dele_admin()
    {
    	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    		$id = input('post.id');
    		$role = new RoModel();
            $resu = $role->deleId($id);
            if ($resu) {
            	return true;
            }
    	}
    }
}