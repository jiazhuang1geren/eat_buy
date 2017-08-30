<?php
namespace app\admin\controller;
use think\Controller;

class Messge extends Controller
{
    public function guestbook()
    {
        return $this->fetch();
    }

    public function feedback()
    {
        return $this->fetch();
    }
}