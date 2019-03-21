<?php
namespace Home\Controller;
use Think\Controller;
class LanguageDemoController extends Controller {

    public function index( $language = 'ZH' ){
    	$this->assign('lan',$language);
        $this->show();
	}
}