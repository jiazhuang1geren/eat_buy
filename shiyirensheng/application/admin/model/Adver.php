<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;
class Adver extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	public function advInfo($adid){
		$res = Adver::destroy($adid);
		return $res;
	}
}