<?php
namespace app\index\controller;
use think\Controller ;
use app\common\model\Admin;
use think\Db;
class IndexController extends Controller 
{
	public function __construct() 
	{ 
	    // 调用父类构造函数(必须) 
		parent::__construct();
		// 验证用户是否登陆 
		if (!Admin::isLogin()) { 
			return $this->error('plz login first', url('login/index'));
		} 
	}
	public function index()
	{
		dump(Db::name('admin')->find());
		//获取数据表中第一条数据
		echo"</pre>";
	}
}