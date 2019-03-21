<?php
namespace Home\Controller;
//use Administrator\Controller\CommonController;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	$mes['num']=D('message_borad')->where(array('is_read'=>'N','is_delete'=>'N'))->count("message_id");
    	$applyCount = M('job_application')->where(array( 'is_read'=>'N' ))->count();
    	$this->assign(array(
    		'mes' => $mes,
    		'applyCount' => $applyCount,
    	));
        $this->show();
	}
}
