<?php
namespace Home\Controller;
use Think\Controller;
class TypeManageController extends CommonController {
    public function cooperate_type(){
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
    public function selectCooperateType()
    {
        $type = D('Type')->where(array('type_model'=>3,'is_delete'=>'N'))->select();
//        var_dump($type);exit();
        $aaData = array();
        foreach ($type as $key=>$value)
        {

            $count = D('PostMessages')->where(array('message_type'=>$value['type_id'],'is_delete'=>'N'))->count();
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

    //添加分类
    public function addCooperateType()
    {
        if ($_POST['type_id'])
        {
            return $this->alertType();
        }

        $validData = D('Type')->create();
//        var_dump($validData);exit();
        $validData['type_model'] = 3;
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

        $validData = D('Type')->create();
//        var_dump($validData);exit();
        if ($validData)
        {
            $validData['type_model'] = 3;
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
}