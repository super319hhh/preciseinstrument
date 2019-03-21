<?php
namespace Home\Controller;
use Think\Controller;
class  ProductManageController extends Controller
{
    public function product_manage()
    {
        if(I('product_id'))
        {
//            cDebug(I('product_id'));
            if (cookie('lan') ==null)
            {
                $type = D('Type')->where(array('is_delete'=>'N','language'=>'ZH','type_model'=>1))->select();
            }else
            {
                $type = D('Type')->where(array('is_delete'=>'N','language'=>cookie('lan'),'type_model'=>1))->select();
            }

//            cDebug($type);
            foreach ($type as $key=>$value)
            {
//                var_dump($key);
                $productid = D('ProductManagement')->where(array('product_id'=>I('product_id')))->getField('product_type');
                if ($productid == $value['type_id'])
                {
                    $pages = "index_".$key;
                }
//                cDebug($productid);
            }
//            cDebug($productid);
            $productMessage = D('ProductManagement')->where(array('product_id'=>I('product_id')))->find();
            $typeName = D('Type')->where(array('type_id'=>$productMessage['product_type']))->find();
            $productMessage['type_name']=$typeName['type_name'];
            $productMessage['page']=I('page');
            if(cookie('lan') == 'EN'){
                $product = 'productMessage';
            }else
            {
                $product = '产品介绍';
            }
            $this->assign('product',$product);
            $this->assign('pages',$pages);
            $this->assign('productMessage',$productMessage);
            $this->display();
        }else
        {
            $this->redirect('ProductManage/index_0');
        }

    }
    public function index_0()
    {
        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

//        cDebug(cookie('lan'));
        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();
//            cDebug($type);

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[0],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[0],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();
//            cDebug($type);
            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[0],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[0],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function index_1()
    {

        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[1],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[1],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[1],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[1],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function index_2()
    {
        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[2],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[2],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[2],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[2],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function index_3()
    {

        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[3],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[3],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[3],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[3],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function index_4()
    {

        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[4],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[4],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[4],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[4],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function index_5()
    {

        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[5],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[5],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[5],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[5],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function index_6()
    {
        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[6],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[6],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[6],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[6],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function index_7()
    {
        if(I('language'))
            cookie('lan', I('language'), 30*24*60*60);

        if(cookie('lan') == 'EN'){
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'EN'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[7],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[7],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        else
        {
            $type = D('Type')->where(array('is_delete'=>'N','type_model'=>1,'language'=>'ZH'))->select();

            foreach ( $type as $value)
            {
                $typeid[] =$value['type_id'];
            }
//        cDebug($typeid);
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[7],'is_show'=>'Y'))->select();
//        cDebug($product);

            // 分页逻辑
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSIze'] ? $_REQUEST['pageSize'] : 6;
            $offset = ($page - 1) * $pageSize;
            $newsCount =count($product);
//        cDebug($newsCount);
            $pageObj = new \Think\Page($newsCount,$pageSize);
            $pageObj->lastSuffix = false;//最后一页不显示为总页数
            $pageObj->setConfig('theme',' %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% ');
            $pageRes = bootstrap_page_style($pageObj->show());//重点在这里
            $product=D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>$typeid[7],'is_show'=>'Y'))->limit($offset,$pageSize)->order('product_id desc')->select();
        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('searchName',$searchName);
        $this->assign('alert',$alert);
        $this->assign('placeholder',$placeholder);
//        cDebug($product);
        $this->assign('pageRes',$pageRes);
        $this->assign('type',$type);
        $this->assign('product',$product);
        $this->display();
    }
    public function search_result(){
//        cDebug(I());
        if (I('search'))
        {
            if(cookie('lan') == 'EN'){
                $cond['product_name|product_detail'] = array('like','%'.I('search').'%');
                $cond['is_delete'] = 'N';
                $cond['is_show'] = 'Y';
                $cond['language'] = 'EN';
                $res = D('ProductManagement')->where($cond)->select();
                if ($res == '')
                {
                    $count = "No qualified records are found";
                }else
                {
                    $count = "search “".I('search')."” altogether ".count($res)." product";
                }

            }else
            {
                $cond['product_name|product_detail'] = array('like','%'.I('search').'%');
                $cond['is_delete'] = 'N';
                $cond['is_show'] = 'Y';
                $cond['language'] = 'ZH';
                $res = D('ProductManagement')->where($cond)->select();
                if ($res == '')
                {
                    $count = "未搜索到符合关键词的产品";
                }else
                {
                    $count = "搜索“".I('search')."”共有".count($res)."个产品";
                }
            }
            $this->assign('res',$res);

            $this->assign('count',$count);
            $this->assign('search',I('search'));

        }
        if(cookie('lan') == 'EN'){
            $placeholder = 'Please this here import product keyword';
            $searchName = 'Search Product';
            $alert = 'Please enter keyword search';
        }else
        {
            $alert = '请输入关键词后搜索';
            $placeholder = '请在此输入产品关键词';
            $searchName = '搜产品';
        }
        $this->assign('alert',$alert);
        $this->assign('searchName',$searchName);
        $this->assign('placeholder',$placeholder);
        $this->display();
    }
}
