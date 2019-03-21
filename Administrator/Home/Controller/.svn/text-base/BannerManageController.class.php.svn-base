<?php
namespace Home\Controller;
use Think\Controller;
import('KKit.ImageUploader');
use KKit\ImageUploader;
class BannerManageController extends CommonController {
    public function banner_manage()
    {
        $count = D('BannerManagement')->where(array('is_delete'=>'N','status'=>0))->order('banner_order asc')->select();
//        $banner = D('BannerManagement')->where()
        $this->assign('count',$count);
        $this->display();
    }
    public function selectBanner()
    {
        if (I('language'))
        {
            $banner = D('BannerManagement')->where(array('is_delete'=>'N','language'=>I('language')))->select();
        }
        else
        {
            $banner = D('BannerManagement')->where(array('is_delete'=>'N'))->select();
        }
//        cDebug($banner);
        $aaData = array();
        foreach ($banner as $key=>$value)
        {
            $aaData[$key]=array(
                'pic_url'=>$value['pic_url'],
                'description'=>$value['description'],
                'link'=>$value['link'],
                'upload_time'=>$value['upload_time'],
                'banner_order'=>$value['banner_order'],
                'click_rate'=>$value['click_rate'],
                'status'=>$value['status'],
                'banner_id'=>$value['banner_id'],
                'language'=>$value['language'],
            );
        }
        $aaData = array_values($aaData);
        if ($aaData == null)
        {
            $aaData=array();
        }
//        cDebug($aaData);
        $dataResult = array('aaData'=>$aaData);
        echo json_encode($dataResult,JSON_UNESCAPED_UNICODE);
    }

    public function index()
    {
        $count = D('BannerManagement')->where(array('is_delete'=>'N','status'=>0))->order('banner_order asc')->select();
//        $banner = D('BannerManagement')->where()
        $this->assign('count',$count);
        $this->display();
    }
    //轮播排序
    public function bannerImage()
    {
        $count = D('BannerManagement')->where(array('is_delete'=>'N','status'=>0,'language'=>$_POST['language']))->order('banner_order asc')->select();
        return ajaxReturn(0,$count);
    }
//查询是否超过上限
    public function selectBanners()
    {
//        cDebug($_POST);
        $order = D('BannerManagement')->where(array('is_delete'=>'N','status'=>0,'language'=>$_POST['language']))->select();
        return ajaxReturn(0,$order);
    }
    //图片排序
    public function imageSort()
    {
//        cDebug($_POST);
        foreach ($_POST as $value)
        {
            $res = explode(',',$value);
//            cDebug($res);

            $alertImage = D('BannerManagement')->where(array('banner_id'=>$res[0]))->save(array('banner_order'=>$res[1]));
        }
        return ajaxReturn(0,'图片排序成功');
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
    public function addBannerManage()
    {
//cDebug($_POST);
        if ($_POST['status'] == 1)
        {
            $_POST['banner_order'] = 7;
        }
        if ($_POST['status'] == 0)
        {
            $order = D('BannerManagement')->where(array('is_delete'=>'N','status'=>0,'language'=>$_POST['language']))->count();
            if ($order == 5)
            {
                return ajaxReturn(2,'超过设置上限');
            }
        }
        $validData = D('BannerManagement')->create();
//        cDebug($validData);
        if ($validData)
        {
            $validData['upload_time'] = date("Y-m-d H:i:s");
            $validData['is_delete']='N';
//            cDebug($validData);
            $res = D('BannerManagement')->add($validData);

            if ($res == false)
            {
                return ajaxReturn(1,'添加失败');
            }
            return ajaxReturn(0,'添加成功');
        }
    }

    public function alertStatus()
    {
//        cDebug(I('status'));
//        cDebug($_POST);
        if ($_POST['status'] == 1)
        {
            $_POST['banner_order'] = 7;
        }
//        cDebug($_POST);
        if (I('status') == 0)
        {
            $cond['banner_id'] = I('banner_id');
            $_POST['banner_order'] = 0;
            unset($_POST['banner_id']);
            $res = D('BannerManagement')->where($cond)->save($_POST);
            if ($res == false)
            {
                return ajaxReturn(1,'修改失败');
            }
            return ajaxReturn(0,'修改成功');

        }else
        {
            $cond['banner_id'] = I('banner_id');
            unset($_POST['banner_id']);
            $res = D('BannerManagement')->where($cond)->save($_POST);
            if ($res == false)
            {
                return ajaxReturn(1,'修改失败');
            }
            return ajaxReturn(0,'修改成功');
        };
    }
//删除Banner
    public function deleteBanner()
    {
        $cond['is_delete']='Y';
        $res = D('BannerManagement')->where($_POST)->save($cond);
        if ($res == false)
        {
            return ajaxReturn(1,'删除失败');
        }
        return ajaxReturn(0,'删除成功');
    }
}