<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Admin;
use app\common\model\Student;
use think\Request;
use think\Validate;   
class AdminController extends IndexController
{   
    //index索引
    public function index()
    {
        $Admin = new Admin;
        $admins =$Admin->select();
        // 向V层传数据 
        $this->assign('admins', $admins); 
        // 取回打包后的数据 
        $htmls = $this->fetch(); 
        // 将数据返回给用户 
        return $htmls;
    }
    public function insert ()
    {
        $postData = Request::instance()->post();
        //$postData = $this->request->post();
        $Admin = new Admin();
        $Admin->username =  $postData['username'];
        $Admin->password =  $postData['password'];
        $Admin->save();
        return $this->success( $Admin->username . '新增成功。新增用户名为：' . $Admin->id,url('index'));
    }
    public function add() 
    { 
        $this->assign('Admin', new Admin); 
        return $this->fetch();
    } 
    public function delete()
    {
        $id = Request::instance()->param('id/d');
        if (is_null($id) || 0 ===$id){
            return $this->error('未获取到id信息',url('index'));
        }
        $Admin = Admin::get($id);
        if(is_null($Admin)){
            return $this ->error('不存在id为' . $id . '的用户,删除失败',url('index'));
        }
        if(!$Admin->delete()){
            return $this->error('删除失败' . $Admin->getError(),url('index'));
        }
        return $this->success('删除成功', url('index'));
    }
    public function edit ()
    {
        $id = Request::instance()->param('id/d');
        //dump($id);
        if(is_null($Admin = Admin::get($id))){
            return '系统未找到ID为' . $id . '的记录';
        }
        $this->assign('Admin', $Admin); 
        $htmls =  $this->fetch();
        return $htmls;
    }
    public function update()
    {
        
        $admin = Request::instance()->post(); 
        // 将数据存入Teacher表 
        $Admin = new Admin(); 
        $message = '更新成功'; 
        // 依据状态定制提示信息 
        if (false === $Admin->validate(true)->isUpdate(true)->save($admin)) { 
            $message = '更新失败：' . $Admin->getError(); 
        }
        //return $message;
        return $this->success('更新成功', url('index'));
        /*
        $admin = Request::instance()->post();
        dump($admin);
        $Admin = new Admin();
        $state = $Admin->validate(true)->isUpdate(true)->save($admin);
        dump($state);
        if($state){
            //return '更新成功';
            return $this->success('更新成功', url('index'));
        } else {
            return '更新失败';
        }*/


        /*$user = Request::instance()->post(); 
        // 将数据存入Teacher表 
        $User = new User(); 
        $message = '更新成功'; 
        // 依据状态定制提示信息 
        if (false === $User->validate(true)->isUpdate(true)->save($user)) { 
            $message = '更新失败：' . $User->getError(); 
        }
        return $message;*/

    }
}
