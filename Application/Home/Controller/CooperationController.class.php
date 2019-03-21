<?php
namespace Home\Controller;
use Think\Controller;
class CooperationController extends Controller {

    public function index(){
    	$headerZH = D('Type')->where(array('type_model'=>3,'language'=>'ZH','is_delete'=>'N'))->select();
    	$headerEN = D('Type')->where(array('type_model'=>3,'language'=>'EN','is_delete'=>'N'))->select();
    	if(I('t')){
       		$res =  D('PostMessages')->where(array('message_type'=>I('t'),'is_show'=>Y))->find();
    		$h1 = D('Type')->where(array('type_id'=>I('t')))->find();
    	}else{
    		if(cookie('lan')=='EN'){
       			$res =  D('PostMessages')->where(array('message_type'=>$headerEN[0]["type_id"],'is_show'=>Y))->find();
    			$h1['type_name'] = $headerEN[0]["type_name"];
    		}else{
       			$res =  D('PostMessages')->where(array('message_type'=>$headerZH[0]["type_id"],'is_show'=>Y))->find();
    			$h1['type_name'] = $headerZH[0]["type_name"];
    		}
    	}

        $tel =  D('Company')->where(array('id'=>1))->find();
        $telQQ = explode('/',$tel['qq']);
        $this->assign('h1',$h1);
        $this->assign('telQQ',$telQQ);
        $this->assign('tel',$tel);
     	$this->assign('res',$res);
        $this->display();
	}
}