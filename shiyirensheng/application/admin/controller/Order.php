<?php
namespace app\admin\controller;
use think\Controller;
class Order extends Controller
{
    public function transaction()
    {
        return $this->fetch();
    }

    public function order_chart()
    {
        return $this->fetch();
    }

    public function orderform()
    {
        return $this->fetch();
    }

    public function amounts()
    {
        return $this->fetch();
    }

    public function order_handling()
    {
        return $this->fetch();
    }

    public function refund()
    {
        return $this->fetch();
    }

    public function order_detailed()
    {
        return $this->fetch();
    }

    public function refund_detailed()
    {
        return $this->fetch();
    }

}