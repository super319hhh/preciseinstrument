<?php
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller{
	function __construct(){
		parent::__construct();
		// 登录限制
		$this->loginVerify();
	}
	// 登录限制
	function loginVerify(){
		if (session(C('ADMIN_SESSION'))==null){
			$this->redirect('Login/index');
		}
	}
}
