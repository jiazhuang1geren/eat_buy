<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
class Car extends Controller
{
	// 购物车
    public function car()
    {
    	$name = Session::get('uid');
    	$cart['id'] = $name;
    	if (empty($name)) {
            $this->success('请先登录...','__PUBLIC__/index/user/login');
        } else {
	    	if ($_SERVER['REQUEST_METHOD']=='POST') {
	    		$gid   = input('post.caid');
	    		$han   = input('post.han');
	    		$goods = Db::query("select * from buy_goods where gid = $gid ");
	    		$cart['shopp']   = $han;
	    		$cart['picture'] = $goods[0]['pricture'];
	    		$cart['gsname']  = $goods[0]['goodsname'];
	    		$cart['price']   = $goods[0]['price'];
	    		$cart['sales']   = $goods[0]['sales'];
	    		db('car')->insert($cart);
	    		
			}
			$car = Db::name('car')->where('id',$name)->select();
			if (!empty($car)) {
				$shopp   = $car[0]['shopp'];	
				$scid    = $car[0]['cid'];	
				$picture = $car[0]['picture'];	
				$gsname  = $car[0]['gsname'];
				$price   = $car[0]['price'];
				$sales   = $car[0]['sales'];
				Session::set('shopp',$shopp);
				Session::set('scid',$scid);
				Session::set('photo',$picture);
				Session::set('gsname',$gsname);
				Session::set('price',$price);
				Session::set('sales',$sales);
				
			}
			$this->assign('car', $car);
		}
        return $this->fetch();
    }

    public function dele()
    {
    	if ($_SERVER['REQUEST_METHOD']=='POST') {
    		$scid = input('post.scid');
    		$a = db('car')->where('cid',$scid)->delete();
    		if ($a) {
    			return true;
    		} else {
    			return false;
    		}
    	}
    }
}