<?php
namespace Common\Model;
use Think\Model;
class TypeModel extends Model{
	public function getTypeList($modelName,$languageCond){
		$typeModel = M('type_model')->where(array('modle_name'=>$modelName))->getField('model_id');
		$cond['type_model'] = $typeModel;
		$cond = array(
			'type_model' => $typeModel,
			'is_delete' => 'N',
			'status' => 0
		);
		return $this->where($languageCond)->where($cond)->select();
	}
}
