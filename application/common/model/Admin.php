<?php
namespace app\common\model;
use think\Model;    //  导入think\Model类
class Admin extends Model
{
    static public function login($username, $password) 
    { 
        // 验证用户是否存在 
        $xinde = array('username' => $username); 
        $Admin = self::get($xinde); 
        if (!is_null($Admin)) {
        // 验证密码是否正确 
            if ($Admin->checkPassword($password)) { 
            // 登录 
                session('adminId', $Admin->getData('id')); 
                return true; 
            } 
        }
        return false;
    }
    public function checkPassword($password) 
    { 
        if ($this->getData('password') === $this::encryptPassword($password)){ 
            return true; 
        } else {
           return false;
       }
   }

       static public function encryptPassword($password) 
       { 
        return sha1(md5($password) . 'mengyunzhi'); 
    }
    static public function logOut() 
    {  
        session('adminId', null); 
        return true; 
    }
    static public function isLogin() 
    { 
        $adminId = session('adminId'); 
        if (isset($adminId)) { 
            return true;
        } else { 
            return false; 
        } 
    }
}
