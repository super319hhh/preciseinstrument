<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {
    public function home(){
    	if(I('language'))
    		cookie('lan', I('language'), 30*24*60*60);
    	$cond_EN['language'] = 'EN';
    	$cond_ZH['language'] = 'ZH';
    	$cond_banner = array(
    		'is_delete' => 'N',
    		'status' => '0',
    	);
    	$cond_pros = array(
    		'is_show_on_main' => 'Y',
    		'is_show' => 'Y',
    		'is_delete' => 'N',
    	);
    	$cond_type['modle_name'] = '新闻管理';
		$typeModel = M('type_model')->where($cond_type)->getField('model_id');
    	$cond_news = array(
    		'type.type_model' => $typeModel,
    		'post_messages.is_delete' => 'N',
    		'post_messages.is_show' => 'Y',
		);
		$cond_news_EN['post_messages.language'] = 'EN';
		$cond_news_ZH['post_messages.language'] = 'ZH';
    	if(cookie('lan') == 'EN'){
    		$banners = M('banner_management')->where($cond_banner)->where($cond_EN)->order('banner_order')->select();
    		$pros = M('product_management')->where($cond_pros)->where($cond_EN)->select();
	    	$news = M('post_messages')
		    	->join('type ON post_messages.message_type = type.type_id')
		    	->where($cond_news)->where($cond_news_EN)
		    	->order('post_date desc')->limit(5)->select();
    	}else{
    		$banners = M('banner_management')->where($cond_banner)->where($cond_ZH)->order('banner_order')->select();
    		$pros = M('product_management')->where($cond_pros)->where($cond_ZH)->select();

	    	$news = M('post_messages')
		    	->join('type ON post_messages.message_type = type.type_id')
		    	->where($cond_news)->where($cond_news_ZH)
		    	->order('post_date desc')->limit(5)->select();
    	}
	    $this->assign(
	    	array(
		    	'banners' => $banners,
		    	'pros' => $pros,
		    	'news' => $news,
	    	)
	    );
        $this->show();
	}
	// 百度地图
	public function map(){
        $this->display();
	}

	public function career(){
		if(I('language'))
    		cookie('lan', I('language'), 30*24*60*60);
		$cond = array(
			'recruit.is_delete' => 'N',
			'recruit.is_show' => 'Y',
		);
		if (I('t')) { // 选择类型跳转
			$post_EN['recruit.recruit_type'] = I('t');
			$post_ZH['recruit.recruit_type'] = I('t');
		}else{ // 招贤纳士跳转
			$post_EN = array(
				'recruit.language' => 'EN',
				'type.type_name' => 'Social Recruit'
			);
			$post_ZH = array(
				'recruit.language' => 'ZH',
				'type.type_name' => '校园招聘'
			);
		}
		if(cookie('lan') == 'EN'){
			$postInfo = M('recruit')
				->join('type ON recruit.recruit_type = type.type_id')
				->join('recruit_position ON recruit_position.position_id = recruit.position_id')
				->where($cond)
				->where($post_EN)
				->order('recruit_date desc')
				->select();
		}else{
			$postInfo = M('recruit')
				->join('type ON recruit.recruit_type = type.type_id')
				->join('recruit_position ON recruit_position.position_id = recruit.position_id')
				->where($cond)
				->where($post_ZH)
				->order('recruit_date desc')
				->select();
		}
		$this->assign(array(
			'postInfo' => $postInfo,
		));
        $this->display();
	}

	public function chooseType(){
		$cond = array(
			'recruit_type' => I('recruit_type'),
			'is_show' => 'Y',
			'recruit.is_delete' => 'N'
		);
		$careerInfo = M('recruit')
			->join('recruit_position ON recruit_position.position_id = recruit.position_id')
			->where($cond)
			->select();
		if ($careerInfo == false) {
			return ajaxReturn(0,'该栏目没有招聘信息');
		}
		return ajaxReturn(1,'',$careerInfo);;
	}

	public function search(){
		$searchType = I('search_type');
		$searchC = I('search_content');
		if ($searchType == 'pro') { //搜产品
			$cond_pro['product_name|product_detail'] = array('like','%'.$searchC.'%');
	        $cond_pro['is_delete'] = 'N';
	        $cond_pro['is_show'] = 'Y';
	        $proInfo = M('product_management')->where($cond_pro)->select();
			return ajaxReturn(1,'',$proInfo);
		}
		if ($searchType == 'all') {
			// 搜招聘
			$cond_post = array(
				'recruit_position.position_name' => array('like','%'.$searchC.'%'),
				'is_show' => 'Y',
				'recruit.is_delete' => 'N'
			);
			$careerInfo = M('recruit')
				->join('recruit_position ON recruit_position.position_id = recruit.position_id')
				->where($cond_post)
				->select();
			// 搜新闻
			$cond_news['message_title|message_content'] = array('like','%'.$searchC.'%');
         	$cond_news['is_delete'] = 'N';
         	$cond_news['is_show'] = 'Y';
         	$newInfo = M('post_messages')->where($cond_news)->select();

         	$allInfo['career'] = $careerInfo;
         	$allInfo['new'] = $newInfo;
         	$allInfo['total'] = count($careerInfo) + count($newInfo);
         	return ajaxReturn(2,'',$allInfo);;
		}
	}

	public function searchPost(){
		$searchC = I('search_content');
		$cond = array(
			'recruit_position.position_name' => array('like','%'.$searchC.'%'),
			'is_show' => 'Y',
			'recruit.is_delete' => 'N'
		);
		$careerInfo = M('recruit')
			->join('recruit_position ON recruit_position.position_id = recruit.position_id')
			->where($cond)
			->select();
		if ($careerInfo == false) {
			return ajaxReturn(0,'搜索没结果');
		}
		return ajaxReturn(1,'',$careerInfo);;
	}

	public function searchPro(){
		$searchC = I('search_content');
		$cond['product_name|product_detail'] = array('like','%'.$searchC.'%');
        $cond['is_delete'] = 'N';
        $cond['is_show'] = 'Y';
        $proInfo = M('product_management')->where($cond)->select();
		if ($proInfo == false) {
			return ajaxReturn(0,'搜索没结果');
		}
		return ajaxReturn(1,'',$proInfo);
	}


	public function newApply(){
		$newData = I();
		$newData['jobapp_date'] = date("Y-m-d H:i:s");;
		$newApplyRes = M('job_application')->add($newData);
		if ($newApplyRes == false) {
			return ajaxReturn(0,'申请职位失败');
		}
		return ajaxReturn(1);
	}

	//计算Banner点击量
	public function BannerClick(){
		$click = D('BannerManagement')->where(array('banner_id'=>I('banner_id')))->find();
		$num = $click['click_rate'] +1;
		$clickRate = D('BannerManagement')->where(array('banner_id'=>I('banner_id')))->save(array('click_rate'=>$num));
	}
}
