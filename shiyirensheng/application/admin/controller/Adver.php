<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Upload;
use think\Request;
use app\admin\model\Adver as AdverModel;
class Adver extends Controller
{
    public function advertising()
    {
    	$adver = AdverModel::all();
    	$this->assign('adver',$adver);
        return $this->fetch();
    }

    public function sort_ads()
    {
        return $this->fetch();
    }


    //上传图片
    public function add_photo()
    {
    	if ($_SERVER['REQUEST_METHOD'] == "POST") {
    		$classify = input('post.classify');
    		$url      = input('post.url');
    		$stuu     = input('post.stuu');
    		$photos = new Upload();
            $photos->upload('file');
            $name  = $photos->newName;
            $path  = $photos->newPath;
            $photo = $path . $name;
            $data['classify']   = $classify;
            $data['adurl']        = $url;
            $data['adpicture']  = $photo;
            $data['status']     = $stuu;
            $data['create_time']= date('Y-m-d H:i:s');
            $res = Db::name('adver')->insert($data);
            if ($res) {
            	header('Location:'.$_SERVER['HTTP_REFERER']);
            }
    	}
    }

    //停用
    public function tingyong()
    {
    	if (Request::instance()->isPost()) {
    		$adid = Request::instance()->param('id');
    		$res = Db::name('adver')->where('adid',$adid)->update(['status'=>1]);
    		if ($res) {
    			return true;
    		}
    	}
    }

    //启用
    public function qingyong()
    {
    	if (Request::instance()->isPost()) {
    		$adid = Request::instance()->param('id');
    		$res = Db::name('adver')->where('adid',$adid)->update(['status'=>0]);
    		if ($res) {
    			return true;
    		}
    	}
    }

    //删除
    public function dele_adver(){
    	if (Request::instance()->isPost()) {
    		$adid = Request::instance()->param('id');
    		$adver = new AdverModel();
            $res  = $adver->advInfo($adid);
            if ($res) {
            	return true;
            }	
    	}
    }
}