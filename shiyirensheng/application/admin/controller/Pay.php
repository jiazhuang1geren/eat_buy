<?php
namespace app\admin\controller;
use think\Controller;
class Pay extends Controller
{
    public function cover_management()
    {
        return $this->fetch();
    }

    public function payment_method()
    {
        return $this->fetch();
    }

    public function payment_configure()
    {
        return $this->fetch();
    }

    public function account_details()
    {
        return $this->fetch();
    }

    public function payment_details()
    {
        return $this->fetch();
    }

}