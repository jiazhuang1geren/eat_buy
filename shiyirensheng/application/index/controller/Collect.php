<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Collect extends Controller
{
	//收藏
    public function collect()
    {
        return $this->fetch();
    }
}