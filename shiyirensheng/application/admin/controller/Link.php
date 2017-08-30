<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Link as LinkModel;
class Link extends Controller
{
    public function systems()
    {
        $link = Db::name('link')->select();
        $this->assign('link',$link);
        return $this->fetch();
    }

    public function system_section()
    {
        return $this->fetch();
    }

    public function system_logs()
    {
        return $this->fetch();
    }

    public function up_link(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lname  = input('post.lname');
            $icon   = input('post.icon');
            $url    = input('post.url');
            $descp  = input('post.descp');
            $mege   = input('post.mege');
            $mark   = input('post.mark');
            $stus   = input('post.stus');
            $lid    = input('post.lid');
            $data['lname'] = $lname;
            $data['licon']  = $icon;
            $data['url']   = $url;
            $data['descp'] = $descp;
            $data['mege']  = $mege;
            $data['mark']  = $mark;
            $data['status']  = $stus;
            $res = Db::name('link')->where('lid',"$lid")->update($data);
            if ($res) {
                return true;
            }
        }
    }
}