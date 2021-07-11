<?php 
namespace app\index\controller; 
use think\Controller; 
use think\Request; // 请求//
use app\common\model\Admin;
class LoginController extends Controller 
{ 
    public function index()
    {
        return $this->fetch();
    }
    public function login()
    {
        // 接收post信息 
        $postData = Request::instance()->post(); 
        if (Admin::login($postData['username'], $postData['password'])) { 
            return $this->success('login success', url('Admin/index')); 
        } else { 
            return $this->error('username or password incorrent', url('index')); 
        }
    }
    public function logOut() 
    { 
        if (Admin::logOut()) { 
            return $this->success('logout success', url('index')); 
        } else { 
            return $this->error('logout error', url('index')); 
        } 
    }
    public function test() 
    { 
        echo Admin::encryptPassword('123'); 
    }
}