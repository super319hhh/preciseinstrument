<?php
namespace Home\Controller;
use Think\Controller;
class CompanyController extends Controller {
    public function index(){

    	if(I('language'))
    		cookie('lan', I('language'), 30*24*60*60);

    	if(cookie('lan')=='EN'){
    		$res = D('Company')->where(array('language'=>'EN'))->find();
			$searchName = 'Search Product';
			$placeholder = 'Please this here import product keyword';
    	}else{
    		$res = D('Company')->where(array('language'=>'ZH'))->find();
			$searchName = '搜产品';
			$placeholder = '请在此输入产品关键词';
    	}
		$this->assign('searchName',$searchName);
		$this->assign('placeholder',$placeholder);
    	$this->assign('res',$res);
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
	public function messages(){
		if(I('language'))
			cookie('lan', I('language'), 30*24*60*60);
		$this->display();
	}
}
