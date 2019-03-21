<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function index(){
		$type=D('type')->where(array('type_model'=>2,'is_delete'=>'N','language'=>'ZH'))->select();
		$this->assign('type',$type);
		$this -> display();
    }
	public function getmessages(){
		$i=I('id');
		if($i !== '101'){
			if($i == '102'){
				$type=D('type')->where(array('type_name'=>'公司动态'))->select();
			}elseif($i == '103'){
				$type=D('type')->where(array('type_name'=>'知识百问'))->select();
			}elseif($i == '106'){
				$type=D('type')->where(array('type_name'=>'促销信息'))->select();
			}elseif($i == '104'){
				$cond['post_messages.language']='ZH';
				$type=D('type')->where(array('type_model'=>2,'language'=>'ZH'))->select();
			}else{
				$cond['post_messages.language']='EN';
				$type=D('type')->where(array('type_model'=>2,'language'=>'ZH'))->select();
			}
			$cond['post_messages.is_delete']='N';
			foreach($type as $k=>$value){
				$cond['message_type']=$value['type_id'];
				$d=D('post_messages')->where($cond)
					->join('type ON post_messages.message_type=type_id')
					->field('message_id,message_title,message_content,message_type,post_date,view_times,is_show,post_messages.language as language,type_name')
					->select();
				for($i=0;$i<count($d);$i++){
					$dData[]=$d[$i];
				}
			}
		}else if($i=='101'){
			$cond=array(
				'post_messages.is_delete'=>'N',
			);
			
			$type=D('type')->where(array('type_model'=>2,'language'=>'ZH'))->select();
			foreach($type as $k=>$value){
				$cond['message_type']=$value['type_id'];
				$d=D('post_messages')->where($cond)
					->join('RIGHT JOIN type ON post_messages.message_type=type_id')
					->field('message_id,message_title,message_content,message_type,post_date,view_times,is_show,post_messages.language as language,type_name')
					->select();
				for($i=0;$i<count($d);$i++){
					$dData[]=$d[$i];
				}
			}
		}
			
	    $aaData = array();
	    foreach ($dData as $key => $value) {
		    $aaData[$key] = array(
		   		'type_name'			=> $value['type_name'],
			    'message_id'	 	=> $value['message_id'],
			    'message_title' 	=> $value['message_title'],
			    'message_content' 	=> $value['message_content'],      
			    'message_type'  	=> $value['message_type'],
			    'post_date' 		=> $value['post_date'],
			    'view_times' 		=> $value['view_times'],
			    'is_show'    		=> $value['is_show'],
			    'language'    		=> $value['language'],
		    );
	    }
	    $aaData = array_values($aaData);
	    $dataResult = array('aaData'=>$aaData);
	    echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
	}
	//删除
	public function drop(){
		$a=$_GET['dadel'];
		$cond = array('message_id' =>$a);
		$save=  array('is_delete' =>'Y');
		$res = D('post_messages')->where($cond)->save($save);
		if($res){
			echo true;
		}else{
			echo false;
		}
	}
	public function isshow(){
		$a=$_GET['dasid'];
		$cond = array('message_id' =>$a);
		$save=  array('is_show' =>'Y');
		$res = D('post_messages')->where($cond)->save($save);
		if($res){
			echo true;
		}else{
			echo false;
		}
	}
	public function isheid(){
		$a=$_GET['dahid'];
		$cond = array('message_id' =>$a);
		$save=  array('is_show' =>'N');
		$res = D('post_messages')->where($cond)->save($save);
		if($res){
			echo true;
		}else{
			echo false;
		}
	}
	//展示
	public function show(){
		if($_GET['dataid']){
			$cond = array('message_id' =>$_GET['dataid'],);
			$res = D('post_messages')->where($cond)->getfield('message_content');
			echo($res);
		}
	}
	
	public function add(){
//		datt:title,dala:langer,datex:te,'datetp':tp,'showtp':showtp,
		$a=I('datt');
		$b=I('dala');
		$c=I('datex');
		$d=I('datetp');
		$e=I('showtp');
		$data=array(
			'message_title'		=>$a,
			'message_type'		=>$d,
			'language'			=>$b,
			'message_content'	=>$c,
			'post_date'			=>date('Y-m-d H:i:s',time()),
			'view_times'		=>0,
			'is_delete' 		=>N,
			'is_show'   		=>$e,
		);
		$list = D('post_messages')->add($data);
		if ($list) {
				echo true;
			} else {
				echo false;
			}
	}
	public  function enitdata(){
		if($_GET['dadel']){
			$cond['message_id'] = $_GET['dadel'];
			$res = D('post_messages')
				->join('type ON post_messages.message_type=type_id')
				->where($cond)
				->field('message_id,message_title,message_content,message_type,post_date,view_times,is_show,post_messages.language as language,type_name')
				->select();
			foreach($res as $key => $value){
				$r['type_id']=$value['type_id'];
				$r['type_name']=$value['type_name'];
				$r['message_id']=$value['message_id'];
				$r['language']=$value['language'];
				$r['message_content']=$value['message_content'];
				$r['message_title']=$value['message_title'];
			    $r['is_show']= $value['is_show'];
				
			}
			echo json_encode($r);
		}
	}
	public function edit(){
            	
//'xid':xid,'xdatt':xtitle,'xdala':xlanger,'xdatex':xtex,'xgselect':xgselect,'xshowtp':xshowtp,
		$id=I('xid');			
		$a=I('xdatt');
		$b=I('xdala');
		$c=I('xdatex');
		$d=I('xgselect');
		$e=I('xshowtp');
		$data=array(
			'message_title' 	=>$a,
			'language'			=>$b,
			'message_content'	=>$c,
			'message_type'		=>$d,
			'is_delete' 		=>N,
			'is_show'			=>$e,
		);
		$list = D('post_messages')->where(array('message_id'=>$id))->save($data);
		if ($list==1 || $list ===0) {
				echo true;
			} else {
				echo false;
			}
	}
	

}

?>