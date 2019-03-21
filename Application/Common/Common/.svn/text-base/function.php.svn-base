<?php

//开发者调试方法
function cDebug($data)
{
    echo "<pre>";
    var_dump($data);
    exit();
}
function ajaxReturn($status=0,$msg='',$data=array())
{
    $ret= array(
        'status'=>$status,
        'msg'=>$msg,
        'data'=>$data
    );
    echo(json_encode($ret));
}

function bootstrap_page_style($page_html){
	    if ($page_html) {
	        $page_show = str_replace('<div>','<nav><ul class="pagination">',$page_html);
	        $page_show = str_replace('</div>','</ul></nav>',$page_show);
	        $page_show = str_replace('<span class="current">','<li class="active"><a>',$page_show);
	        $page_show = str_replace('</span>','</a></li>',$page_show);
	        $page_show = str_replace(array('<a class="num"','<a class="prev"','<a class="next"','<a class="end"','<a class="first"'),'<li><a',$page_show);
	        $page_show = str_replace('</a>','</a></li>',$page_show);
	    }
	    return $page_show;
	}