<?php
namespace Home\Controller;
use Think\Controller;
import('KKit.ImageUploader');
use KKit\ImageUploader;
class CompanyController extends Controller {
    public function index(){
    	$res = D("Company")->where(array('id'=>1))->find();
    	$resEn = D("Company")->where(array('id'=>2))->find();
    	$qq = $res['qq'];
    	$showQQ = explode("/",$qq);
    	$fax = $res['fax'];
    	$showFax = explode("/",$fax);
    	$tel = $res['tel'];
    	$showTel = explode("/",$tel);
    	$mail = $res['mail'];
    	$showMail = explode("/",$mail);
    	$showWX = $res['wechat'];
    	$this->assign('showWX',$showWX);
    	$this->assign('showQQ',$showQQ);
    	$this->assign('showFax',$showFax);
    	$this->assign('showTel',$showTel);
    	$this->assign('showMail',$showMail);
    	$this->assign('resEn',$resEn);
    	$this->assign('res',$res);
        $this->display();
	}
	
	//编辑公司信息中文版
	public function saveInfo(){
		$res = D("Company")->where(array('id'=>1))->save(I());
		if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
	}
	//编辑公司信息英文版
	public function saveInfoEn(){
		$res = D("Company")->where(array('id'=>2))->save(I());
		if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
	}
	
	//新增客服信息
	public function addQQData(){
		$oddData = D("Company")->where(array('id'=>1))->find();
		$oddQQ = $oddData['qq'];
		$oddFax = $oddData['fax'];
		$oddTel = $oddData['tel'];
		$oddMail = $oddData['mail'];
		
		$newQQ = I('qq');
		$newFax = I('fax');
		$newTel = I('tel');
		$newMail = I('mail');
		if($newQQ!==''){
			if($oddQQ!==''){
				$tureQQ = $oddQQ."/".$newQQ;
			}else{
				$tureQQ	= $newQQ;
			}
		}else{
			$tureQQ = $oddQQ;
		};
		if($newFax!==''){
			if($oddFax!==''){
				$tureFax = $oddFax."/".$newFax;
			}else{
				$tureFax = $newFax;
			}
		}else{
			$tureFax = $oddFax;
		};
		if($newTel!==''){
			if($oddTel!==''){
				$tureTel = $oddTel."/".$newTel;
			}else{
				$tureTel = $newTel;
			}
		}else{
			$tureTel = $oddTel;
		};
		if($newMail!==''){
			if($oddMail!==''){
				$tureMail = $oddMail."/".$newMail;
			}else{
				$tureMail = $newMail;
			}
		}else{
			$tureMail = $oddMail;
		};
		$tureData = array('QQ'=>$tureQQ,'fax'=>$tureFax,'tel'=>$tureTel,'mail'=>$tureMail);
		$res = D("Company")->where(array('id'=>1))->save($tureData);
		if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
	}
	//编辑客服信息
	public function editQQData(){
		$oddData = D("Company")->where(array('id'=>1))->select();
		$qq = $oddData[0]['qq'];
		$fax = $oddData[0]['fax'];
		$tel = $oddData[0]['tel'];
		$mail = $oddData[0]['mail'];
		if(I('type') == 'qq'){
			$qq = $oddData[0]['qq'];
    		$showQQ = explode("/",$qq);
    		$showQQ[I('num')] = I('qq');
    		$showQQ = implode("/",$showQQ); 
		}else{
			$showQQ = $qq;
		}
		if(I('type') == 'fax'){
			$fax = $oddData[0]['fax'];
    		$showFax = explode("/",$fax);
    		$showFax[I('num')] = I('fax');
    		$showFax = implode("/",$showFax); 
		}else{
			$showFax = $fax;
		}
		if(I('type') == 'tel'){
			$tel = $oddData[0]['tel'];
    		$showTel = explode("/",$tel);
    		$showTel[I('num')] = I('tel');
    		$showTel = implode("/",$showTel); 
		}else{
			$showTel = $tel;
		}
		if(I('type') == 'mail'){
			$mail = $oddData[0]['mail'];
    		$showMail = explode("/",$mail);
    		$showMail[I('num')] = I('mail');
    		$showMail = implode("/",$showMail); 
		}else{
			$showMail = $mail;
		}
		$tureData = array('QQ'=>$showQQ,
							'fax'=>$showFax,
							'tel'=>$showTel,
							'mail'=>$showMail
							);
		$res = D("Company")->where(array('id'=>1))->save($tureData);
		if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
	}
	//删除客服信息
	public function deleteQQData(){
		$oddData = D("Company")->where(array('id'=>1))->select();
		$qq = $oddData[0]['qq'];
		$fax = $oddData[0]['fax'];
		$tel = $oddData[0]['tel'];
		$mail = $oddData[0]['mail'];
		if(I('type') == 'qq'){
			$showQQ = I('data');
			$showQQ = rtrim($showQQ,"/");
		}else{
			$showQQ = $qq;
		}
		if(I('type') == 'fax'){
			$showFax = I('data');
			$showFax = rtrim($showFax,"/");
		}else{
			$showFax = $fax;
		}
		if(I('type') == 'tel'){
			$showTel = I('data');
			$showTel = rtrim($showTel,"/");
		}else{
			$showTel = $tel;
		}
		if(I('type') == 'mail'){
			$showMail = I('data');
			$showMail = rtrim($showMail,"/");
		}else{
			$showMail = $mail;
		}
		$tureData = array('QQ'=>$showQQ,
							'fax'=>$showFax,
							'tel'=>$showTel,
							'mail'=>$showMail
							);
		$res = D("Company")->where(array('id'=>1))->save($tureData);
		if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
	}
	//上传二维码图片，制作缩略图
    function ajaxUploadImage(){
        $uploader = new ImageUploader();
        $res =  $uploader->imageUpload();
        session('imagepath',$res);
        echo json_encode($res);
    }
    //把二维码图片链接存储到数据库
    public function saveWx(){
    	$res = D('Company')->where(array('id'=>1))->save(array('WeChat'=>I('WeChat')));
    	if($res){
				echo json_encode(array('state'=>TRUE,'info'=>'您的操作已保存'));
			} else {
				echo json_encode(array('state'=>false,'info'=>'step-2-Error 通过申请信息失败'));
			}
    }
}