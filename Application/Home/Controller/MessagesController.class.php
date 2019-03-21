<?php
namespace Home\Controller;
use Think\Controller;
class MessagesController extends Controller {

    public function index(){
		$this->display();
	}
	public function add(){
		if(I('theme')!=''){
				$a=I();
				$a['is_read']='N';
				$a['is_delete']='N';
				$res=D('message_borad')->add($a);
				if($res){
					echo true;
				}else{
					echo false;
				}
		}else{
			echo false;
		}
	}
}
?>