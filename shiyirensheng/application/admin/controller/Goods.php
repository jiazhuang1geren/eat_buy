<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Upload;
use app\admin\model\Goods as GoodsModel;
use app\admin\model\Show;
class Goods extends Controller
{

    public function products_list()
    {
        $show = Show::all();
        $shops = GoodsModel::all();
        $shops = $this->limitless($shops);
        $this->assign('shops',$shops);
        $this->assign('show',$show);
        return $this->fetch();
    }

    public function brand_manage()
    {
        return $this->fetch();
    }

    public function category_manage()
    {
        return $this->fetch();
    }

    public function product_category_add()
    {
        $goods = GoodsModel::all();
        $goods = $this->limitless($goods);
        $this->assign('goods',$goods);
        return $this->fetch();
    }

    public function brand_detailed()
    {
        return $this->fetch();
    }

    public function picture_add()
    {
        $goods = GoodsModel::all();
        $goods = $this->limitless($goods);
        $this->assign('goods',$goods);
        return $this->fetch();
    }

    //分类递归
    public function limitless($data,$pid = 0,$level = 0)
    {
        $arr = array();
        foreach ($data as $val) {
            if ($val['pid'] == $pid) {
                $val['level'] = $level;
                $val['html'] = str_repeat('--', ($level * 5));
                $arr[] = $val;
                $arr = array_merge($arr,$this->limitless($data,$val['gid'],$level + 1));
            }
        }
        return $arr;
    }

    //添加分类
    public function add_goods()
    {
        if (Request::instance()->isPost()) {
            $one = request()->param('one');
            $two = request()->param('two');
            $data['pid'] = $two;
            $data['gname'] = $one;
            $data['create_time'] = date("Y-m-d H:i:s");
            $rws = Db::name('goods')->insert($data);
            if ($rws) {
                return true;
            }
        }
    }

    //修改
    public function xiu_gai()
    {
        if (Request::instance()->isPost()) {
            $gname = request()->param('name');
            $gid = request()->param('gid');
            $data['gname'] = $gname;
            $data['update_time'] = date("Y-m-d H:i:s");
            $upp = $upp = Db::name('goods')->where('gid',$gid)->update($data);
            if ($upp) {
                return true;
            }
        }
    }
    //禁用
    public function stop_dd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gid = input('post.gid');
            $upp = Db::name('goods')->where('gid',$gid)->update(['status' => 1]);
            if ($upp) {
                return true;
            }
        }
    }

    //启用
    public function start_dd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gid = input('post.gid');
            $upp = Db::name('goods')->where('gid',$gid)->update(['status' => 0]);
            if ($upp) {
                return true;
            }
        }
    }

    //添加商品
    public function ad_goods()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $shid   = trim(input('post.selc'));
            $shname = trim(input('post.goods'));
            $place  = trim(input('post.place'));
            $strong = trim(input('post.strong'));
            $nums   = trim(input('post.nums'));
            $price  = trim(input('post.price'));
            $rprice = trim(input('post.rprice'));
            $tents  = trim(input('post.tents'));
            $photos = new Upload();
            $photos->upload('img');
            $name  = $photos->newName;
            $path  = $photos->newPath;
            $photo = $path . $name;
            $data['shid']    = $shid;
            $data['shname']  = $shname;
            $data['place']   = $place;
            $data['strong']  = $strong;
            $data['nums']    = $nums;
            $data['price']   = $price;
            $data['rprice']  = $rprice;
            $data['tents']   = $tents;
            $data['picture'] = $photo;
            $data['create_time'] = date('Y-m-d H:i:s');
            $res = Db::name('show')->insert($data);
            if($res) {
                $this->success('上传头像成功');
            }
        }
    }
}