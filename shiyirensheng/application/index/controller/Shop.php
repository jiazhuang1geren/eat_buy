<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Upload;
use app\index\model\Shop as ShopModel;
class Shop extends Controller
{
	//商店
    public function detail()
    {
        if ($_SERVER['REQUEST_METHOD']=='GET') {
            $sid = input('get.sid');
            $detail = Db::query("select * from buy_shop where sid = $sid ");
            $this->assign('detail', $detail);
            //店铺菜单分类
            // $big = Db::query("select * from buy_gplate where pid = $sid");
            // $this->assign('big', $big);
            $small = Db::query("select * from buy_goods ");
            $this->assign('small', $small);
        }
        return $this->fetch();
    }

    //店铺介绍
    public function intro()
    {
        if ($_SERVER['REQUEST_METHOD']=='GET') {
            $sid = input('get.sid');
            $detail = Db::query("select * from buy_shop where sid = $sid ");
        }
        $this->assign('detail', $detail);
        return $this->fetch();
    }

    // 店铺列表 、分类
    public function list()
    {
        //店铺分类
        // $result = Db::query("select * from buy_category order by bid desc");
        // $this->assign('result', $result);
        //商店信息
        $detail = Db::query("select * from buy_shop");
        $this->assign('detail', $detail);
        return $this->fetch();
    }

    public function pleace()
    {
        if (Request::instance()->isPost()) {
            $sname   = request()->param('sname');
            $relname = request()->param('relname');
            $card    = request()->param('card');
            $tele    = request()->param('tele');
            $address = request()->param('address');
            $type     = request()->param('cid');
            $desp    = request()->param('description');
            $upload  = new Upload();
            $upload ->upload('image1');
            $name    = $upload->newName;
            $path    = $upload->newPath;
            $pic     = $path.$name;
            $uid     = Session::get('uid');
            $data['uid']         = $uid;
            $data['sname']       = $sname;
            $data['relname']     = $relname;
            $data['card']        = $card;
            $data['tele']        = $tele;
            $data['address']     = $address;
            $data['type']        = $type;
            $data['description'] = $desp;
            $data['photo']       = $pic;
            $data['create_time'] = date('Y-m-d H:i:s');
            $res = Db::name('shop')->insert($data);
            if ($res) {
                $this->success('申请成功，请等待审核','index/index');   
            }
        }
    }
}
