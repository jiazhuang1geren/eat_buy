<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Shop as ShopModel;
class Shop extends Controller
{
    public function shop_list()
    {
        $shop = ShopModel::all();
        $this->assign('shop',$shop);
        return $this->fetch();
    }

    public function shops_audit()
    {
        $shop = ShopModel::all();
        $this->assign('shop',$shop);
        return $this->fetch();
    }

    public function shopping_detailed()
    {
        $sid = $_GET['sid'];
        $res = Db::name('shop')->where('sid',$sid)->select();
        $this->assign('res',$res);        
        return $this->fetch();
    }

    //启用
    public function up_qi()
    {
        if (Request::instance()->ispost()) {
            $sid = request()->param('sid');
            $shop = new ShopModel;
            $res = $shop->Up_info($sid);
            if ($res) {
                return true;
            }
        }
    }

    //禁用
    public function de_jin()
    {
        if (Request::instance()->ispost()) {
            $sid = request()->param('sid');
            $shop = new ShopModel;
            $res = $shop->De_info($sid);
            if ($res) {
                return true;  
            }
        }
    }
}