<?php
namespace Home\Controller;
use Think\Controller;
class MessagesController extends Controller {
    public function index(){
    	$mes['num']=D('message_borad')->where(array('is_read'=>'N'))->count("message_id");
    	$this->assign('mes',$mes);
		$this -> display();
    }
	
	public function getmessages(){
		
		$res=D('message_borad')->where(array('is_delete'=>'N'))->order('message_id desc')->select();
		$aaData = array();
	    foreach ($res as $key => $value) {
		    $aaData[$key] = array(
		    	'message_id'=> $value['message_id'],
		   		'theme'		=> $value['theme'],
			    'message'	=> $value['message'],
			    'name' 	    => $value['name'],
			    'mail' 		=> $value['mail'],
			    'company'  	=> $value['company'],
			    'address'	=> $value['address'],
		    	'remark'	=> $value['remark'],
			    'contact' 	=> $value['contact'],
			    'is_read' 	=> $value['is_read'],
		    );
	    }
	    $aaData = array_values($aaData);
	    $dataResult = array('aaData'=>$aaData);
	    echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
		
	}
	//展示
	public function show(){
		if($_GET['dataid']){
			$cond = array('message_id' =>$_GET['dataid'],);
			$res = D('message_borad')->where($cond)->getfield('message');
			echo($res);
		}
	}
	public function showdz(){
		if($_GET['dataid']){
			$cond = array('message_id' =>$_GET['dataid'],);
			$res = D('message_borad')->where($cond)->getfield('address');
			echo($res);
		}
	}
	public function showbz(){
		if($_GET['dataid']){
			$cond = array('message_id' =>$_GET['dataid'],);
			$res = D('message_borad')->where($cond)->getfield('remark');
			echo($res);
		}
	}
	//删除
	public function drop(){
		$a=$_GET['dadel'];
		$cond = array('message_id' =>$a);
		$save=  array('is_delete' =>'Y');
		$res = D('message_borad')->where($cond)->save($save);
		if($res){
			echo true;
		}else{
			echo false;
		}
	}
	//已读
	public function read(){
		$a=$_GET['dadel'];
		$cond = array('message_id' =>$a);
		$save=  array('is_read' =>'Y');
		$res = D('message_borad')->where($cond)->save($save);
		if($res){
			echo true;
		}else{
			echo false;
		}
	}
	public  function adddata(){
		if($_GET['dadel']){
			$cond['message_id'] = $_GET['dadel'];
			$res = D('message_borad')->where($cond)->select();
			foreach($res as $key => $value){
				$r['message_id']=$value['message_id'];
				$r['remark']=$value['remark'];
			}
			echo json_encode($r);
		}
	}
	public function edit(){
		$id=I('xid');			
		$a=I('xdatt');
		$list = D('message_borad')->where(array('message_id'=>$id))->save(array('remark'=>$a));
		if ($list) {
				echo true;
			} else {
				echo false;
			}
	}
}
?>