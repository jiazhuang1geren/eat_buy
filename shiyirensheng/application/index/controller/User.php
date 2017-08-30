<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Ucpaas;
use think\Request;
use think\Smtp;
use think\Image;
use think\Upload;
use kuange\qqconnect\QC;
use app\index\model\User as UserModel;
class User extends Controller
{
    //第三方qq登录
    public function qqlogin()
    {
        $qc = new QC();
        $this->redirect($qc->qq_login());     
    }

    //回调
    public function callback()
    {
        $qc = new QC();
        $access_token =  $qc->qq_callback();
        $openid = $qc->get_openid();
        $qc = new QC($access_token, $openid);
        $qq_user_info = $qc->get_user_info();
    }
    //登录
    public function login()
    {
    	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = input('post.username');
            $password = md5(input('post.password'));
            $result   = Db::query('select * from buy_user where uname='. '\''."$username" .'\'');
            $udertype  = $result[0]['type'];
            $picture   = $result[0]['picture'];
            $uid       = $result[0]['id'];
            $password  = $result[0]['pwd'];
            $telephone = $result[0]['phone'];
            $sex       = $result[0]['sex'];
            Session::set('udertype',$udertype);
            Session::set('picture',$picture);
            Session::set('uid',$uid);
            Session::set('username',$username);
            Session::set('password',$password);
            Session::set('telephone',$telephone);
            Session::set('sex',$sex);
            if ($result) {
                $this->success('登录成功','index/index');
            } else {
                $this->error('登录失败');
            }
        }
        return $this->fetch();
    }
    public function logout()
    {
        Session::clear();
        $this->success('退出成功','index/index');
        return $this->fetch();
    }
    //验证用户名
    public function username()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = input('post.username');
            $user = new UserModel();
            $res = $user->where('uname', $data)->find();
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }
    //验证密码
    public function password()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pass = md5(input('post.password'));
            $name = input('post.username');
            $user = new UserModel();
            $res  = Db::name('user')->field('pwd')->where('uname',$name)->select();
            $pwd = $res[0]['pwd'];
            if ($pwd == $pass) {
                return true;
            } else {
                return false;
            }
        }
    }

    //验证码
    public function yanzm()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $yzm = trim(input('post.yzm'));
            // dump($data);
            if (captcha_check($yzm)){
                //验证成功
                return true;
            } else {
                return false;
            }
        }
    }

    // 注册
    public function register()
    {    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = input('post.');
            $data['password'] = md5(trim($data['password']));
            $regip = $_SERVER['REMOTE_ADDR'];
            if ($regip == '::1') {
                $regip = '127.0.0.1';
            }
            $data['regip'] = ip2long($regip);
            $user = new UserModel();
            //插入数据到数据库
            $result = $user->allowField(true)->save($data);
            
            if ($result) {
                $username = input('post.username');
                Session::set('username',$username);
                $this->success('注册成功,正在登录请稍后...','index/index');
            } else {
                $this->error('注册失败');
            }
        }
        return $this->fetch();
    }

    // ajax用户名
    public function regs()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = input('post.username');
            $user = new UserModel();
            $res = $user->where('username', $data)->find();
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }
    // ajax邮箱
    public function email()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = input('post.email');
            $user = new UserModel();
            $res = $user->where('email', $data)->find();
            // dump($res);exit;
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }

    // ajax密码
    public function pwd()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = md5(trim(input('post.password')));
            // dump($data);die;
            if ($data) {
                return true;
            }
        }
    }

    //确认密码
    public function rpwd()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = md5(trim(input('post.rpassword')));
            // dump($data);die;
            if ($data) {
                return true;
            } 
        }
    }
    //ajax验证码
    public function yzm()
    {   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $yzma = trim(input('post.yzm'));
            if ($yzma) {
                return true;
            } 
        }
    }

    public function mail()
    {
        $smtpserver = "smtp.163.com";//SMTP服务器
        $smtpserverport =25;//SMTP服务器端口
        $smtpusermail = "13877940691@163.com";//SMTP服务器的用户邮箱

        $smtpemailto = input('post.mail');//发送给谁
        $smtpuser = "13877940691";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
        $smtppass = "K123456";//SMTP服务器的用户密码
        $mailtitle = "您正在进行邮箱验证";//邮件主题
        $yanzma = mt_rand(10000,99999);
        $mailcontent = "您的验证码是".$yanzma;
        // $a = input('session.yanzma');
        // dump($a);die;
        $mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件
        //************************ 配置信息 ****************************
        $smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
        echo json_encode(['errno'=>0, 'yza'=>$yanzma]);
        // if($state==""){
        //     alert("邮件发送失败！请检查邮箱填写是否有误。"); 
        // }
        // alert("恭喜！邮件发送成功！！");
    }
    
    //个人中心
    public function personal()
    {
        $name = Session::get('username');
        $self = Db::name('user')->where('uname',$name)->select();
        $this->assign('self', $self);
        if (empty($name)) {
            $this->success('请先登录...','__PUBLIC__/index/user/login');
        } else {
            $update = Request::instance()->post('update');
            // dump($update);die;
            if ($update) {
                $picture = Request::instance()->post('image');
                // dump($picture);die;
                $name = Request::instance()->post('username');
                $password = Request::instance()->post('password');
                $phone = Request::instance()->post('phone');
                // $relname = Request::instance()->post('relname');
                $sex = Request::instance()->post('sex');
                $arr['picture'] = $picture;
                $arr['uname'] = $name;
                $arr['pwd'] = md5($password);
                $arr['phone'] = $phone;
                $arr['sex'] = $sex;
                $data = Db::name('user')->where('uname', $name)->update($arr);
             }

        }
        $uid = Session::get('uid');
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $upload = new Upload();
             $upload ->upload('img');
                $name = $upload->newName;
                $path = $upload->newPath;
                 //dump($path);
                $error = $upload->errorNumber;
                $errorInfo = $upload->errorInfo;
                if ($error != 0) {
                    return $this->error($errorInfo);
                }
                $p = $path.'/'.$name;
                $image = new Image();
                $mpicture =$image ->suofang($p,100,100);
               $mpicture=ltrim($mpicture,'.');
              unlink($p);
            $reslut = Db::name('user')->where('id',$uid)->update(['picture'=>"$mpicture"]);
            if($reslut) {
                $this->error('添加成功!');
            }
        }
        return $this->fetch();
    }
    //找回密码
    public function pwdforpost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $options['accountsid']='c355185a9bd20b4c53a4dc2f3ae2fdae';
            $options['token']='53c98a6652fdc939ffd9dad541ac9dd4';
            //初始化 $options必填
            $ucpass = new Ucpaas($options);
            //开发者账号信息查询默认为json或xml
            // echo $ucpass->getDevinfo('json');
            $str = '12345678909876543210';
            $str1 = substr(str_shuffle($str),0,5);
            $appId = "083ebcd8c31840ec98eee5f9302e2a25";
            $to = input('get.name'); 
            $templateId = "88115";
            $param=$str1;
            $ucpass->templateSMS($appId,$to,$templateId,$param);
            echo $str1;
        }

    }

    public function add_phone()
    {
        if (Request::instance()->isPost()){
            $yzm  = request()->param('yzm');
            $yzm2 = request()->param('yzm2');
            $sj   = request()->param('sj');
            Session::set('name',$sj);
            if ($yzm == $yzm2) {
                return true;
            } else {
                return false;
            }
        } 
    }
    public function pwdforget()
    {
        return $this->fetch();
    }

    //密码重置
    public function pwdreset()
    {
        $phone = Session::get('name');
        $sec = Db::name('user')->field('id,phone')->where('phone',$phone)->select();   
        $uid = $sec[0]['id'];
        Session::set('uid',$uid);
        $this->assign('sec', $sec);
        return $this->fetch();
    }

    //重置成功
    public function pwdsuccess()
    {
        $uid = Session::get('uid');
        $data = md5(input('post.pass'));
        $user = new UserModel;
        $a = $user->where('id',$uid)->update(['pwd' => $data]);
        return $this->fetch();
    }

    //商家入驻
    public function apply()
    {
        return $this->fetch();
    }
}
