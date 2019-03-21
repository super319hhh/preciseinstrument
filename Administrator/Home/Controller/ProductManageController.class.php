<?php
namespace Home\Controller;
use Think\Controller;
import('KKit.ImageUploader');
use KKit\ImageUploader;
class ProductManageController extends CommonController {
    public function index(){

        $this->display();
    }
    public function managetype(){
//        var_dump(session());exit();
        $this->display();
    }
    public function product_manage()
    {
        $res = D('Type')->where(array('is_delete'=>'N','type_model'=>1))->select();
//        var_dump($res);exit();
        $this->assign('res',$res);
        $this->display();
    }
    public function selectType()
    {
        if (I('language'))
        {
            $type = D('Type')->where(array('type_model'=>1,'is_delete'=>'N','language'=>I('language')))->select();
        }else
        {
            $type = D('Type')->where(array('type_model'=>1,'is_delete'=>'N'))->select();
        }

//        var_dump($type);exit();
        $aaData = array();
        foreach ($type as $key=>$value)
        {
            $count = D('ProductManagement')->where(array('product_type'=>$value['type_id'],'is_delete'=>'N'))->count();
            $aaData[$key]=array(
                'type_name'=>$value['type_name'],
                'status'=>$value['status'],
                'product_count'=>$count,
                'type_id'=>$value['type_id'],
                'language'=>$value['language'],
                
            );
        }
        $aaData = array_values($aaData);
        if ($aaData == null)
        {
            $aaData=array();
        }
        $dataResult = array('aaData'=>$aaData);
        echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
    }
    //查询是否超过上限
    public function selectAlltype()
    {
        $res = D('Type')->where(array('type_model'=>1,'is_delete'=>'N'))->count();
        echo json_encode($res);
    }
    //查询是否超过上限
    public function selectShowProduct()
    {
        $res = D('ProductManagement')->where(array('is_show_on_main'=>'Y','is_delete'=>'N'))->count();
        echo json_encode($res);
    }
    //修改时
    public function selectShowProducts()
    {
        
    }
    //添加分类
    public function addType()
    {
        if ($_POST['type_id'])
        {
            return $this->alertType();
        }
        $order = D('Type')->where(array('is_delete'=>'N','language'=>$_POST['language'],'type_model'=>1))->count();
        if ($order == 8)
        {
            return ajaxReturn(2,'超过设置上限');
        }
        $validData = D('Type')->create();
//        var_dump($validData);exit();
        $validData['type_model'] = 1;
        $validData['is_delete'] = 'N';
        if ($validData)
        {
            $res = D('Type')->add($validData);
            if ($res == false)
            {
                echo json_encode(array('status'=>1,'result'=>'添加分类失败'));
            }
            else
            {
                echo json_encode(array('status'=>0,'result'=>'添加成功'));
            }
        }
    }
    public function alertType()
    {
//        cDebug(I());

        $validData = D('Type')->create();
//        var_dump($validData);exit();
        if ($validData)
        {
            $validData['type_model'] = 1;
            $validData['is_delete'] = 'N';


            $res = D('Type')->save($validData);

            echo json_encode(array('status'=>0,'result'=>'修改成功'));
//            var_dump($res);exit();
        }

    }
    //删除分类
    public function deleteType()
    {
//        var_dump($_POST);exit();
        $res = D('Type')->where($_POST)->save(array('is_delete'=>'Y'));
        if ($res == false)
        {
            echo json_encode(array('status'=>1,'result'=>'删除分类失败'));
        }
        else
        {
            echo json_encode(array('status'=>0,'result'=>'删除成功'));
        }

    }
    //查询产品
    public function selectProduct()
    {
        if (I('product_type'))
        {
            $product = D('ProductManagement')->where(array('is_delete'=>'N','product_type'=>I('product_type')))->select();
        }
        else
        {
            $product = D('ProductManagement')->where(array('is_delete'=>'N'))->select();
        }
//        var_dump($product);exit();
        $aaData = array();
        foreach ($product as $key=>$value)
        {
            $typeName = D('Type')->where(array('type_id'=>$value['product_type']))->find();
//            var_dump($typeName);exit();
            $aaData[$key]=array(
                'product_id'=>$value['product_id'],
                'product_type'=>$typeName['type_name'],
                'main_pic'=>$value['main_pic'],
                'product_name'=>$value['product_name'],
                'product_num'=>$value['product_num'],
                'product_detail'=>$value['product_detail'],
                'is_show_on_main'=>$value['is_show_on_main'],
                'is_show'=>$value['is_show'],
                'type_id'=>$value['product_type'],
                'language'=>$value['language']

            );
        }
        $aaData = array_values($aaData);
        if ($aaData == null)
        {
            $aaData=array();
        }
        $dataResult = array('aaData'=>$aaData);
        echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
    }

    //上传封面图，制作缩略图
    function ajaxUploadImage()
    {

        $uploader = new ImageUploader();
        $res =  $uploader->imageUpload();

//        return $res;
//       cDebug($res);
//        if($res===false)
//        {
//            return ajaxReturn(\UPLOAD_FAILURE,'图片上传失败');
//        }
        session('imagepath',$res);
//        return session('imagepath',$res);

        echo json_encode($res);
    }

    //添加产品
    public function addProductManage()
    {
//        cDebug($_POST);
//        var_dump($_POST);exit();
        if($_POST['product_id'])
        {
          return  $this->alertProduct();
        }
        if (I('is_show_on_main') == 'Y')
        {
            $count  = D('ProductManagement')->where(array('is_delete'=>'N','is_show_on_main'=>'Y','language'=>I('language')))->count();

            if ($count == 6)
            {
                return ajaxReturn(2,'超过设置上限');
            }
        }
        $validData = D('ProductManagement')->create();
//        var_dump($validData);exit();
        if ($validData)
        {
            $validData['is_delete']='N';
            $res= D('ProductManagement')->add($validData);
            if ($res == false)
            {
                echo json_encode(array('status'=>1,'res'=>'添加失败'));
            }else
            {
                echo json_encode(array('status'=>0,'res'=>'添加成功'));
            }
        }
    }
    public function deleteProduct()
    {
        $res = D('ProductManagement')->where($_POST)->save(array('is_delete'=>'Y'));
        if ($res == false)
        {
            echo json_encode(array('status'=>1,'result'=>'删除产品失败'));
        }
        else
        {
            echo json_encode(array('status'=>0,'result'=>'删除成功'));
        }
    }
    public function alertProduct()
    {
        if (I('is_show_on_main') == 'Y')
        {
            $count  = D('ProductManagement')->where(array('is_delete'=>'N','is_show_on_main'=>'Y','language'=>I('language')))->count();

            if ($count == 6)
            {
                return ajaxReturn(2,'超过设置上限');
            }
        }
//        $_POST['product_type']=$_POST['type_id'];
        $validData = D('ProductManagement')->create();
//        var_dump($validData);exit();
        if ($validData)
        {
            $validData['is_delete']='N';
//            var_dump($validData);exit();
            $product_id['product_id']=$validData['product_id'];
            unset($validData['product_id']);
//            var_dump($validData);exit();
            $res= D('ProductManagement')->where($product_id)->save($validData);
                echo json_encode(array('status'=>0,'res'=>'修改成功'));
        }
    }
    
    //按语言查分类
    public function selectTypes()
    {
//        cDebug($_POST);
       $res = D('Type')->where(array('language'=>I('language'),'is_delete'=>'N','type_model'=>1))->select();
        return ajaxReturn(0,$res);
        
    }

    //改变状态
    public function alertShow()
    {
//        cDebug(I());
        $show = D('ProductManagement')->where(array('product_id'=>I('product_id')))->find();
        if ($show['is_show_on_main'] == 'Y')
        {
            $result['is_show_on_main'] = 'N';
        }
        $result['is_show'] = I('is_show');
        $res = D('ProductManagement')->where(array('product_id'=>I('product_id')))->save($result);
        if ($res == false)
        {
            return ajaxReturn(1,'修改失败');
        }
        return ajaxReturn(0,'修改成功');
    }
    //展示改变
    public function alertMainShow()
    {
//        cDebug(I());
        $result['is_show_on_main'] = I('is_show_on_main');
        $res = D('ProductManagement')->where(array('product_id'=>I('product_id')))->save($result);
        if ($res == false)
        {
            return ajaxReturn(1,'修改失败');
        }
        return ajaxReturn(0,'修改成功');
    }
    
    public function selectMainShow()
    {
        $counts = D('ProductManagement')->where(array('is_delete'=>'N','language'=>I('language'),'is_show_on_main'=>'Y'))->count();

        return ajaxReturn(0,$counts);
    }
}