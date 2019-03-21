<?php
namespace Home\Controller;
use Think\Controller;
class RecruitManageController extends Controller {
    public function post_management(){
    	$cond['is_delete'] = 'N';
    	$recruitPosition = M('recruit_position')->where($cond)->order('language')->select();

    	$cond_type['modle_name'] = '招聘管理';
		$typeModel = M('type_model')->where($cond_type)->getField('model_id');
		$cond_type = array(
			'status' => 0,
			'type_model' => $typeModel
		);
		$type = M('type')->where($cond)->where($cond_type)->select();

    	$this->assign(array(
    		'recruitPosition' => $recruitPosition,
    		'type' => $type,
    	));
        $this->display();
	}
	// 职位信息
	public function getPostInfo(){
		$cond['modle_name'] = '招聘管理';
		$typeModel = M('type_model')->where($cond)->getField('model_id');
		$map = array(
			'type.type_model' => $typeModel,
			'recruit.is_delete' => 'N',
		);
		$postInfo = M('recruit')
			->join('type ON recruit.recruit_type = type.type_id')
			->join('recruit_position ON recruit_position.position_id = recruit.position_id')
			->where($map)
			->order('recruit_date desc')
			->select();
		$aaData = array();
		foreach ($postInfo as $key => $value) {
			$aaData[$key] = array(
				'num' => $key+1,
				'recruit_id' => $value['recruit_id'],
				'position_id' => $value['position_id'],
				'recruit_position' => $value['position_name'],
				'recruit_date' => date('Y-m-d',strtotime( $value['recruit_date'] )),
				'type_id' => $value['type_id'],
				'recruit_type' => $value['type_name'],
				'language' => $value['language'],
				'recruit_numbers' => $value['recruit_numbers'],
				'recruit_viewtimes' => $value['recruit_viewtimes'],
				'recruit_detial' => $value['recruit_detial'],
				'is_show' => $value['is_show'],

			);
		}
		$aaData = array_values($aaData);
		$dataResult = array('aaData'=>$aaData);
		echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
	}
	// 发布职位
	public function newPost(){
		if (I('recruit_id')) { // 编辑
			$cond['recruit_id'] = I('recruit_id');
			$editPostData = I();
			unset($editPostData['recruit_id']);
			$editPostRes = M('recruit')->where($cond)->save($editPostData);
		}else{
			$newPostData = I();
			$newPostData['recruit_date'] = date("Y-m-d H:i:s");
			unset($newPostData['recruit_id']);
			$newPostRes = M('recruit')->add($newPostData);
		}
		if ($newPostRes === false) {
			return ajaxReturn(0,'发布职位出错');
		}
		if ($editPostRes === false) {
			return ajaxReturn(0,'编辑职位出错');
		}
		return ajaxReturn(1);
	}
	public function hidePost(){
		$cond = I();
		$hidePostData['is_show'] = 'N';
		$hidePostRes = M('recruit')->where($cond)->save($hidePostData);
		if ($hidePostRes == false) {
			return ajaxReturn(0,'隐藏出错');
		}
		return ajaxReturn(1);
	}
	public function showPost(){
		$cond = I();
		$hidePostData['is_show'] = 'Y';
		$hidePostRes = M('recruit')->where($cond)->save($hidePostData);
		if ($hidePostRes == false) {
			return ajaxReturn(0,'显示出错');
		}
		return ajaxReturn(1);
	}
	public function deletePost(){
		$cond = I();
		$deletePostData['is_delete'] = 'Y';
		$deletePostRes = M('recruit')->where($cond)->save($deletePostData);
		if ($deletePostRes == false) {
			return ajaxReturn(0,'删除出错');
		}
		return ajaxReturn(1);
	}
    public function apply_management(){
        $this->display();
	}
	// 申请信息
	public function getApplyInfo(){
		$cond['modle_name'] = '招聘管理';
		$typeModel = M('type_model')->where($cond)->getField('model_id');
		$map = array(
			'type.type_model' => $typeModel,
			'job_application.is_delete' => 'N',
		);
		$applyInfo = M('job_application')
			->join('type ON job_application.jobapp_type = type.type_id')
			->join('recruit_position ON recruit_position.position_id = job_application.jobapp_position')
			->where($map)
			->order('jobapp_date desc')
			->select();
		$dataResult = array('aaData'=>$applyInfo);
		echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
	}
	// 阅读职位申请
	public function readApplyInfo(){
		$cond = I();
		$readState['is_read'] = 'Y';
		$changeReadState = M('job_application')->where($cond)->save($readState);
		if ($changeReadState === false) {
			return ajaxReturn(0,'修改阅读状态失败');
		}
		return ajaxReturn(1);
	}
	// 招聘职位管理
	public function position_management(){
		$this->display();
	}
	public function getPositionInfo(){
		$positionInfo = M('recruit_position')->where(array( 'is_delete' => 'N' ))->select();
		$aaData = array();
		foreach ($positionInfo as $key => $value) {
			$aaData[$key] = array(
				'position_id' => $value['position_id'],
				'language' => $value['language'],
				'position_name' => $value['position_name'],
			);
		}
		$aaData = array_values($aaData);
		$dataResult = array('aaData'=>$aaData);
		echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
	}
	public function newPosition(){
		$newPositionRes = M('recruit_position')->add(I());
		if ($newPositionRes == false) {
			return ajaxReturn(0,'添加职位出错');
		}
		return ajaxReturn(1);
	}
	public function editPosition(){
		$cond['position_id'] = I('position_id');
		$editPositionData['position_name'] = I('position_name');
		$editPositionRes = M('recruit_position')->where($cond)->save($editPositionData);
		if ($editPositionRes === false) {
			return ajaxReturn(0,'添加职位出错');
		}
		return ajaxReturn(1);
	}
	public function deletePosition(){
		$cond = I();
		$deletePositionData['is_delete'] = 'Y';
		$deletePositionRes = M('recruit_position')->where($cond)->save($deletePositionData);
		if ($deletePositionRes === false) {
			return ajaxReturn(0,'删除出错');
		}
		return ajaxReturn(1);
	}
}
