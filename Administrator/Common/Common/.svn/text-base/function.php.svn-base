<?php
//判断参数是否为空
function isArgumentEmpty($argName){
	$args=!$_POST ? $_GET :$_POST;
	return (!isset($args[$argName])||!$args[$argName]);
}
//格式化接口返回值为json
function  ajaxReturn($status=0,$msg='',$data=array()){
	$result=array(
	  	'status'=>$status,
	  	'msg'=>$msg,
	  	'data'=>$data,
	);
	echo (json_encode($result));
}
//将字符串处理成MD5
function getMD5Sstring($str){
	return md5(C('MD5_PREFIX').$str);
}
//开发者调试	方法
function cDebug($data){
	echo "<pre>";
	var_dump($data);
	exit;
}
//将status字段转换为用户友好的数据
function getDataStatus($status){
	if($status == -1){
		return '删除';
	}
	if($status == 1){
		return '正常';
	}
	if($status == 0){
		return '关闭';
	}
}
//根据当前页面的contiroller,设置侧面菜单选中状态
function getMenuActiveStatus($controller){
	$currentC = strtolower(CONTROLLER_NAME);
	if($currentC==strtolower($controller)){
		return 'class="active"';
	}
}
//时间显示去掉时分秒
function showtime($times){
	$time =date('Y-m-d',strtotime($times));
}
//将操作状态转换为用户友好的数据
function getOperationStatusHtml($status){
	if($status == 2){
		return '<span id="refuseState" class="text-danger"><i class="fa fa-times-circle-o fa-fw fa-lg"></i>驳回</span>';
	}
	if($status == 1){
		return '<span class="text-success"><i class="fa fa-check-circle-o fa-fw fa-lg"></i>通过</span>';
	}
	if($status == 0){
		return '<span class="text-warning"><i class="fa fa-minus-circle fa-fw fa-lg"></i>待批</span>';
	}
}
function getOperationStatus($status){
	if($status == 2){
		return '驳回';
	}
	if($status == 1){
		return '通过';
	}
	if($status == 0){
		return '待批';
	}
}
//将工作完成情况转换为用户友好的数据
function getWorksState($status){

	if($status == 1){
		return '正常';
	}
	if($status == 0){
		return '<span style="color:red">异常</span>' ;
	}
}
//将工作完成情况转换为用户友好的数据
function getsolveState($status){

	if($status == 1){
		return '已排除';
	}
	if($status == 0){
		return '<span style="color:red">未排除</span>' ;
	}
}
//解决字段
function getIsSolveStatus($status){
	return $status = $status == 1 ? '已解决' : '未解决';
}
//时间未设置显示为空
function getSetTime($data){
	if (strcmp($data,'0000-00-00 00:00:00')==0) {
		return '';
	}else{
		return $data;
	}
}
function getMultipleData($k,$v){
	foreach (explode(",",$v) as $key => $value) {
		$data.= $k[$value].',';
	}
	$data = rtrim($data,",");
	$data = ltrim($data,",");
	return $data;
}
//生成 keyGen
function keyGen(){
	$code	= 	new \Org\Util\String;
	return $code->keyGen();
}

//二维数组去掉重复值 并保留键值
function array_unique_fb($array2D)
{
	foreach ($array2D as $k=>$v)
	{
		$v = join(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		$temp[$k] = $v;
	}
	$temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
	foreach ($temp as $k => $v)
	{
		$array=explode(",",$v); //再将拆开的数组重新组装
		$temp2[$k]["elevator_id"] =$array[0];
		$temp2[$k]["maintenance_times"] =$array[1];
		$temp2[$k]["take_plan_stuff"] =$array[2];
	}
	return $temp2;
}
//把一个字段的一个属性换成对用户友好的文字
function alternative($s){
	$data=D('ElevatorMalfunctionType')->select();
	foreach($s as $ke => $v){
		$a=strlen($v['malfunction_type']);
		if($a == 3){
			$str=str_replace(',','',$v['malfunction_type']);
			foreach($data as $ke1 => $v1){
				if($str==$data[$ke1]['type_id']){
					$s[$ke]['malfunction_typeName'] = $data[$ke1]['type_name'];
				}
			}
		}else{
			$trim=trim($v['malfunction_type'],',');
			$types=explode(',',$trim);
			for ($i=0; $i <count($types) ; $i++) {
				$typenName[$i]=D('ElevatorMalfunctionType')->where(array('type_id'=>$types[$i]))->getField('type_name');
			}
			$typenNames=implode('/',$typenName);
			$s[$ke]['malfunction_typeName'] = $typenNames;
		}
	}
	return $s;
}

function getUserPermissions(){
	$userInfo = M('group_user_mapping')->join('tjem_group ON tjem_group_user_mapping.group_id = tjem_group.group_id')
	->join('tjem_permissions_group_mapping ON tjem_group_user_mapping.group_id = tjem_permissions_group_mapping.group_id')
	->join('tjem_permissions ON tjem_permissions_group_mapping.permission_type_id = tjem_permissions.permissions_id')
	->where(array(
		'user_id'			=>	session(C('USER_AUTH_KEY')),
		'permissions_type'	=>	session('user_platform_type_id')
	))->select();
	foreach ($userInfo as $key => $value) {
		$permissionsIds[] = $value['permissions_id'];
	}
	return $permissionsIds;
}
function hasPermission($permissionKey){
	if ( in_array($permissionKey,getUserPermissions()) ) return TRUE; return FALSE;
}
function getModelName(){
	return MODULE_NAME;
}

//这个函数是在调用的时候把删除的图片移动到指定的文件夹里面，不修改数据
function DeleteImg ($tname,$detailed){
	//传值 $tname是表名锁定表  $detailed是数组查询条件，锁定具体某一条数据，
	//如果传值调用那么就删除符合条件的图片，不传值就过一遍数据库
	if($tname && $detailed){
		$url= D($tname)->where($detailed)->field('upload_url')->select();
		foreach($url as $k=>$v){$u[]=$v['upload_url'];}
	}else{
		$picurl=array('application_contract_picture','application_maintenance_picture','application_property_picture','elevator_malfunction_picture','maintenance_work_picture');
		//把所有符合条件的url提取到一个数组里面
		for($i=0;$i<count($picurl);$i++){
			$url= D($picurl[$i])->where('is_delete=1')->field('upload_url')->select();
			foreach($url as $k=>$v){$u[]=$v['upload_url'];}
		}
	}
	foreach($u as $v){
	//在config里面配置文件地址，
	    $rootDir = C('ROOTDIR');
	//获取原文件名
		$filename= substr( $v, strrpos($v, '/')+1 ); 
	//移动到新目录不改变原文件名字
	    $newFile=$rootDir.'/UploadImages/DeleteImages/'.$filename; //新目录
	//原文件目录替换 (网址和文件地址有区别)   
		$kmcv = str_ireplace("http://127.0.0.1/ElevatorMaintenanceCloudPlatform",$rootDir,$v);
	//如果目标文件名字已经存在，则在名字前面加一个随机数，在移动到新目录	
		$newFiles=$rootDir.'/UploadImages/DeleteImages/'.keyGen().$filename; //
		// 首先需要检测目标目录是否存在
		if (!is_dir($rootDir.'/UploadImages/DeleteImages/')) // 如果不存在则创建
			mkdir($rootDir.'/UploadImages/DeleteImages/');
		if(file_exists($kmcv)){//判断原文件是否存在
			if(!file_exists($newFile)){//判断目标文件是否存在
				copy($kmcv,$newFile);//旧目录($v)拷贝到新目录
		   		unlink($kmcv); 
			}else{
				copy($kmcv,$newFiles);//旧目录($v)拷贝到新目录
		   		unlink($kmcv); 
			}
		}
	}
	//成功返回true  失败 返回 false
	if($tname && $detailed && !file_exists($kmcv) && (file_exists($newFile) || file_exists($newFiles))){	
		return true;
	}else{
		return false;
	}
}


//传递数据以易于阅读的样式格式化后输出
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}

function delHtmlTag($str){
	return preg_replace('/<\/?[^>]+>/i',"",$str);
}
?>
