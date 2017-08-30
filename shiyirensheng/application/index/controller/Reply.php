<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Reply extends Controller
{
	//评论
    public function comment()
    {
    	if ($_SERVER['REQUEST_METHOD']=='GET') {
            $sid = input('get.sid');
            $detail = Db::query("select * from buy_shop where sid = $sid ");
        }
       // dump($detail);die;
        $this->assign('detail', $detail);
        return $this->fetch();
    }
}