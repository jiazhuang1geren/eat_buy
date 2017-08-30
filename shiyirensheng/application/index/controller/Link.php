<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Link extends Controller
{
    //关于
    public function about()
    {
    	
        return $this->fetch();
    }

    //联系我们
    public function contact()
    {
    	
        return $this->fetch();
    }

    //帮助
    public function help()
    {
    	
        return $this->fetch();
    }
}