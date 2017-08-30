<?php
namespace app\index\validate;
use think\Validate;
class User extends Validate
{
	protected $rule = [
		'username' => 'require|min:6',
		'username' => 'require|max:16',
		'password' => 'require|min:6|confirm:rpassword',
		'email' => 'require|email',

	];

	protected $message = [
		'name.require' => '用户名不能为空',
		'name.min' => '用户名不能少于6位',
		'name.max' => '用户名不能大于16位',
		'password.require' => '密码不能为空',
		'password.min' => '密码不能少于6位',
		'password.confirm' => '两次密码不一致',
		'email.require' => '邮箱不能为空',
		'email' => '邮箱格式错误',
	];
}