<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Shop extends Model
{
	public function Up_info($sid)
	{
		return db('shop')->where('sid',$sid)->update(['status' => 1]);
	}

	public function De_info($sid)
	{
		return db('shop')->where('sid',$sid)->update(['status' => 0]);
	}
}