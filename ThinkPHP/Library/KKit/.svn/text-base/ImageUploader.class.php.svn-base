<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/6/006
 * Time: 12:32
 */
namespace KKit;

class ImageUploader
{
    private $_uploadObj = '';

    function __construct()
    {
        $config = array(
            'rootPath'=>'./UploadImages/',
            'subName' =>date(Y).'/'.date(m).'/'.date(d),

        );
        $this->_uploadObj = new \Think\Upload($config);

    }
    //上传图片，制作缩略图
    function imageUpload()
    {
        $res = $this->_uploadObj->upload();
//        cDebug($res);

        if($res)
        {
            foreach ($res as $images)
            {
                $imagePath[]= $this->_uploadObj->rootPath.$images['savepath'].$images['savename'];
                $thumbPath[] = $this->_uploadObj->rootPath.$images['savepath'].'small'.$images['savename'];
            }
//            cDebug($imagePath);

            for ($i=0;$i<count($imagePath);$i++)
            {
                $fullImagePath[] = 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/'.ltrim($imagePath[$i],'./');
            }
//            cDebug($fullImagePath);
//            cDebug($fullImagePath);

//            cDebug($image);
                return array(
                    'image_path'=>$fullImagePath,
                );

        }else
        {
            return false;
        }

    }
}




