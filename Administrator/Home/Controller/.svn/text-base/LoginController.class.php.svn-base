<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller{

//    public function __construct()
//    {
//        if (session() == null)
//        {
//            redirect("admin.php/Home/Login/index");
//        }
//    }

    public function index(){
//        var_dump('asdasda');
        $this->display();
    }
    public function check_user(){
        if (I('username') != 'admin') {
            echo "false";
        }else{
            echo "true";
        }
    }
    public function check_psw(){
        if (I('password')) {
            if (I('password') != 'admin') {
                echo "false";
            }else{
                echo "true";
            }
        }
    }
    public function login(){


        if (I('username') == 'admin' && I('password') == 'admin') {
//            cDebug(I());
            session(C('ADMIN_SESSION'),1);
            echo json_encode(array('status'=>1));
//            cDebug(session());
        }
    }
    public function logout(){
        session(C('ADMIN_SESSION'),null);
        redirect("admin.php/Home/Login/index");
    }
}
