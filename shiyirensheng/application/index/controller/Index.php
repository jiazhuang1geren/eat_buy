<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use traits\controller\Jump;

class Index extends Controller
{
    public function index()
    {	
        $adver = Db::name('adver')->select();
  		$result = Db::name('user')->select();
  		$this->assign('result', $result);
  		$this->assign('adver', $adver);
        return $this->fetch();
    }
}
