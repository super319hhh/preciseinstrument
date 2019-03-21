<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {

    public function index(){

    	if(I('language'))
    		cookie('lan', I('language'), 30*24*60*60);

    	if(cookie('lan') == 'EN'){
			$tiaojian['language']='EN';
			$cond['language']='EN';
		}else{
			$tiaojian['language']='ZH';
			$cond['language']='ZH';
		}
		$cond=array('post_messages.is_delete'=>'N','post_messages.is_show'=>'Y',);
		$types=D('type')->where(array('type_name'=>'公司动态'))->select();
	//取出所有的符合条件的新闻
		foreach($types as $k=>$value){
			$cond['message_type']=$value['type_id'];
			$d=D('post_messages')->where($cond)
				->join('type ON post_messages.message_type=type_id')
				->select();
			for($i=0;$i<count($d);$i++){
				$dData[]=$d[$i];
			}
			$condfy[]=$value['type_id'];
		}
		$tiaojian['message_type']=array('IN',$condfy);
		$tiaojian['is_delete']='N';
		$tiaojian['is_show']='Y';
		// 分页逻辑
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
		$pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 10;
		$offset = ($page - 1) * $pageSize;
		$newsCount =count($dData);
		$pageObj = new \Think\Page($newsCount,$pageSize);
		$pageObj->lastSuffix = false;//最后一页不显示为总页数
        $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
		$pageRes = bootstrap_page_style($pageObj->show());//重点在这里
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		//条件
		$news=D('post_messages')->where($tiaojian)->limit($offset,$pageSize)->order('post_date desc')->select();

		foreach ($news as $key => $v) {
			$news[$key]['post_date']=date("Y-m-d",strtotime($v['post_date']));
		}

	    $this->assign('pageRes',$pageRes);
	    $this->assign('news',$news);
		$type=D('type')->where(array('type_model'=>2))->select();
		$this->assign('type',$type);
		$this->display();
	}

	public function news(){

		if(I('language'))
    		cookie('lan', I('language'), 30*24*60*60);

		if(cookie('lan') == 'EN'){
			$tiaojian['language']='EN';
			$cond['language']='EN';
		}else{
			$tiaojian['language']='ZH';
			$cond['language']='ZH';
		}
		$cond=array('post_messages.is_delete'=>'N','post_messages.is_show'=>'Y',);
		$types=D('type')->where(array('type_name'=>'知识百问'))->select();
	//取出所有的符合条件的新闻
		foreach($types as $k=>$value){
			$cond['message_type']=$value['type_id'];
			$d=D('post_messages')->where($cond)
				->join('type ON post_messages.message_type=type_id')
				->select();
			for($i=0;$i<count($d);$i++){
				$dData[]=$d[$i];
			}
			$condfy[]=$value['type_id'];
		}
		$tiaojian['message_type']=array('IN',$condfy);
		$tiaojian['is_delete']='N';
		$tiaojian['is_show']='Y';
		// 分页逻辑
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
		$pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 10;
		$offset = ($page - 1) * $pageSize;
		$newsCount =count($dData);
		$pageObj = new \Think\Page($newsCount,$pageSize);
		$pageObj->lastSuffix = false;//最后一页不显示为总页数
        $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
		$pageRes = bootstrap_page_style($pageObj->show());//重点在这里
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		//条件
		$news=D('post_messages')->where($tiaojian)->limit($offset,$pageSize)->order('post_date desc')->select();
		foreach ($news as $key => $v) {
			$news[$key]['post_date']=date("Y-m-d",strtotime($v['post_date']));
		}

	    $this->assign('pageRes',$pageRes);
	    $this->assign('news',$news);
		$type=D('type')->where(array('type_model'=>2))->select();
		$this->assign('type',$type);
		$this->display();
    }
public function Promotions(){

	if(I('language'))
		cookie('lan', I('language'), 30*24*60*60);

		if(cookie('lan') == 'EN'){
			$tiaojian['language']='EN';
			$cond['language']='EN';
		}else{
			$tiaojian['language']='ZH';
			$cond['language']='ZH';
		}
		$cond=array('post_messages.is_delete'=>'N','post_messages.is_show'=>'Y',);
		$types=D('type')->where(array('type_name'=>'促销信息'))->select();
	//取出所有的符合条件的新闻
		foreach($types as $k=>$value){
			$cond['message_type']=$value['type_id'];
			$d=D('post_messages')->where($cond)
				->join('type ON post_messages.message_type=type_id')
				->select();
			for($i=0;$i<count($d);$i++){
				$dData[]=$d[$i];
			}
			$condfy[]=$value['type_id'];
		}
		$tiaojian['message_type']=array('IN',$condfy);
		$tiaojian['is_delete']='N';
		$tiaojian['is_show']='Y';
		// 分页逻辑
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
		$pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 10;
		$offset = ($page - 1) * $pageSize;
		$newsCount =count($dData);
		$pageObj = new \Think\Page($newsCount,$pageSize);
		$pageObj->lastSuffix = false;//最后一页不显示为总页数
        $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
		$pageRes = bootstrap_page_style($pageObj->show());//重点在这里
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		//条件
		$news=D('post_messages')->where($tiaojian)->limit($offset,$pageSize)->order('post_date desc')->select();
		foreach ($news as $key => $v) {
			$news[$key]['post_date']=date("Y-m-d",strtotime($v['post_date']));
		}

	    $this->assign('pageRes',$pageRes);
	    $this->assign('news',$news);
		$type=D('type')->where(array('type_model'=>2))->select();
		$this->assign('type',$type);
		$this->display();
    }

	public function getNews(){
		$map['message_id'] = intVal(I('news'));
    	$newsDetail = M('post_messages')->where($map)->find();
		$a=$newsDetail['view_times']+1;
		$res=D('post_messages')->where($map)->save(array('view_times'=>$a));
		return ajaxReturn(1,'',$newsDetail);
	}
//	public function search(){
//		if(I('inptval')){
//			$a=I('inptval');
//			$cond['message_title|message_content'] = array('like','%'.$a.'%');
//          $cond['is_delete'] = 'N';
//          $cond['is_show'] = 'Y';
//			if(cookie('lan') == 'EN'){
//				$cond['language']='EN';
//			}else{
//				$cond['language']='ZH';
//			}
//			$type=D('type')->where(array('type_model'=>2,'language'=>'ZH'))->select();
//			foreach($type as $k=>$value){
//				$cond['message_type']=$value['type_id'];
//				$d=D('post_messages')->where($cond)->select();
//				for($i=0;$i<count($d);$i++){
//					 $news[]=$d[$i];
//				}
//			}
//			$count=count($news);
//			foreach ( $news as $key => $v) {
//				$news[$key]['post_date']=date("Y-m-d",strtotime($v['post_date']));
//			}
//			$ts['tiaojian']=$a;
//			$ts['shuliang']=$count;
//      }
//      $this->assign('ts',$ts);
//		$this->assign('news', $news);
//      $this->display();
//	}
//


}
