<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
class Order extends Controller
{
   //地址
    public function address()
    {
        $name = Session::get('username');
        $sec = Db::name('user')->where('uname', $name)->select();
        $uid = $sec[0]['id'];
        if (empty($name)) {
            $this->success('请先登录...','__PUBLIC__/index/user/login');
        } else {
            if($_SERVER['REQUEST_METHOD']=='POST') {
                 $name = Request::instance()->post('name');
                 $phone = Request::instance()->post('contact');
                 $address = Request::instance()->post('address');
                 $array['name'] = $name;
                 $array['phone'] = $phone;
                 $array['address'] = $address;
                 $array['did'] = $uid;
                 $address = Db::name('address')->insert($array);   
            }
        }
        $adda = Db::name('address')->where('did', $uid)->select();
        
        $this->assign('adda', $adda);
        return $this->fetch();
    }

    //订单表
    public function order()
    {   
        $name = Session::get('username');
        $sec = Db::name('user')->where('uname', $name)->select();
        $uid = $sec[0]['id'];
        if (empty($name)) {
            $this->success('请先登录...','__PUBLIC__/index/user/login');
        } else {
            $adda = Db::name('address')->where('did', $uid)->select();
            $aid = $adda[0]['did'];
            $phone = $adda[0]['phone'];
            Session::set('aid',$aid);
            Session::set('phone',$phone);
            $this->assign('adda', $adda);
        }
        $cid = Session::get('scid');
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $price = input('post.price');
            $num = input('post.num');
            $cai = input('post.cai');
            $nums = $num * $price;
            Session::set('nums',$nums);
            db('car')->where('cid',$cid)->update(['num' => $num,'number'=>$nums]);
        }
        $der = Db::name('car')->select();
        $this->assign('der', $der);
        return $this->fetch();
    }

    //商品订单最多的
    public function shoporder()
    {
    	if ($_SERVER['REQUEST_METHOD']=='GET') {
            $sid = input('get.sid');
            $detail = Db::query("select * from buy_shop where sid = $sid ");
        }
        $this->assign('detail', $detail);
        return $this->fetch();
    }

    //提交订单
    public function odsuccess()
    {
        Session::get('phone');
        return $this->fetch();
    }

    //订单详情
    public function numberorder()
    {
        $name = Session::get('username');
        $car = Session::get('scid');
        $sec = Db::name('user')->where('uname', $name)->select();
        $uid = $sec[0]['id'];
        if (empty($name)) {
            $this->success('请先登录...','__PUBLIC__/index/user/login');
        } else {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $gsname = input('post.cp');
                $num = input('post.num');
                $sec = Db::name('car')->where('cid', $car)->select();
                $data = date("Y").date("m").date("d").rand().$car;
                $order['ordernum'] = $data;
                $order['odate'] = date("Y-m-d H:i:s");
                $a = $sec[0]['num'];
                $order['num'] = $num;
                $order['tname'] = $sec[0]['gsname'];
                // $order['tname'] = $gsname;
                $price = $sec[0]['price'];    
                $order['gprice'] = $price * $a;    
                $asd = Db::name('address')->where('did', $uid)->select();
                $order['uid'] = $uid;
                $order['address'] = $asd[0]['address'];
                $order['adname'] = $asd[0]['name'];
                $order['adphone'] = $asd[0]['phone'];
                // 插入
                db('order')->insert($order);
                if ($order) {
                    Db::name('car')->where('cid', $car)->delete();
                } else {
                    return false;
                }
            }
        }
        // 查询
        $order = Db::name('order')->where('oid', $uid)->select();
        $this->assign('order', $order);
        // 查询状态为1的用户数据 并且每页显示10条数据 总记录数为1000
        $list = Db::name('order')->where('oid', $uid)->paginate(2);
        // 获取分页显示
        $page = $list->render();
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('page', $page);
        // 渲染模板输出

        return $this->fetch();
    }


}