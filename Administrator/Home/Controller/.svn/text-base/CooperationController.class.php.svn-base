<?php
namespace Home\Controller;
use Think\Controller;
class CooperationController extends Controller {
    public function index(){
    	$type = D("Type")->where(array('type_model'=>3,'is_delete'=>N))->select();
    	$this->assign('type',$type);
        $this->display();
	}
	
	//dataTables数据显示 
	public function getMaintenanceRegApplication(){
		$map['type.type_model'] = 3;
		$map['post_messages.is_delete'] = N;
		$aaData = M('PostMessages')->join('type ON post_messages.message_type = type.type_id')->where($map)->select();

		foreach($aaData as $key=>$value){
			$aaData[$key] = array(
				'message_id' => $value['message_id'],
				'language'   => $value['language'],
				'message_type' => $value['message_type'],
				'message_content' => delHtmlTag($value['message_content']),
				'message_title' => $value['message_title'],
				'post_date' => $value['post_date'],
				'view_times' => $value['view_times'],
				'is_show' => $value['is_show'],
				'is_delete' => $value['is_delete'],
				'type_id' => $value['type_id'],
				'type_model' => $value['type_model'],
				'type_name' => $value['type_name'],
			);
		};
		$aaData = array_values($aaData);
    	$aaData = $aaData?$aaData:array();
		$dataResult = array('aaData'=>$aaData);
		echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
	}
		
	//添加
	public function add(){
    	$type = D("Type")->where(array('type_model'=>3))->getField("type_name,type_id");
		if(I()){
			$data = array('message_content'=>I()['message_content'],
						  'post_date'	   =>date('Y-m-d H:i:s'),
						  'is_delete'      => 'N',
						  'language'	   =>I('languageType'),
						  'message_title'  =>I('cooperationTitle'),
						  'message_type'   =>I('cooperationType'),	
						  'is_show'        =>'N',
						  'view_times'	   => 0	
			); 
			$res = D("PostMessages")->add($data);
			if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
		}
	}
	
	//删除
	public function upData(){
		if(I()){
			$cond['message_id'] = I()['message_id'];
			$res = D('PostMessages')->where($cond)->save(array('is_delete'=>Y));
			if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
		}
	}
	//查询
	public function showDetile(){
		if(I()){
    		$cond['message_id'] = I('message_id');
    		$res = D("PostMessages")->join('type ON post_messages.message_type = type.type_id')->where($cond)->find();
    	}
    	if($res){
				echo json_encode($res);
			} 
	}
	
	//修改
	public function saveData(){
		$cond['message_id'] = I('message_id');
    	$res = D("PostMessages")->join('type ON post_messages.message_type = type.type_id')->where($cond)->find();
		if($res){
				echo json_encode($res);
			} 
	}
	//编辑
	public function edit(){
		$cond['message_id'] = I('message_id');
		$res = D('PostMessages')->where($cond)->save(I());
		if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
	}
	//是否显示在前台
	public function editIsShow(){
		$cond['post_messages.is_delete'] = N;
		$cond['type.type_model'] = 3;
		$res = D('PostMessages')->join('type ON post_messages.message_type=type.type_id')->where($cond)->select();
		$pRes =  D('PostMessages')->where(array('message_id'=>I('message_id')))->find();	
		foreach($res as $key=>$value){
			if($pRes['is_show'] == N){
				$NotShow = D('PostMessages')->where(array('message_type'=>I('message_type')))->save(array('is_show'=>N));	
				$IsShow =  D('PostMessages')->where(array('message_id'=>I('message_id')))->save(array('is_show'=>Y));	
			}
			if($pRes['is_show'] == Y){
				$IsShow =  D('PostMessages')->where(array('message_id'=>I('message_id')))->save(array('is_show'=>N));	
			}
		}
	}
}