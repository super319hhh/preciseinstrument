//初始化fileinput
var FileInput = function () {
    var oFile = new Object();
    //初始化fileinput控件（第一次初始化）
    oFile.Init = function(ctrlName, uploadUrl, browseLabel) {
        var control = $('#' + ctrlName);
        //初始化上传控件的样式
        control.fileinput({
            language: 'zh', //设置语言
            uploadUrl: uploadUrl, //上传的地址
            showUpload: false, //是否显示上传按钮
            showCaption: false,//是否显示标题
            showRemove: false,//是否显示删除按钮
            uploadAsync: false,//是否异步
            maxFileSize : 3000,//最大尺寸
            allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
            browseClass: "btn btn-default btn-block", //按钮样式
            dropZoneEnabled: true,//是否显示拖拽区域
            enctype: 'multipart/form-data',
            previewSettings:{
                image: {width: "100%", height: "180px"},
            },
            previewFileType: "image",
            browseLabel: browseLabel,
            browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
            previewClass:'previewPanel',
            dropZoneTitle: '点击上传 & 拖拽文件到这里',
        })
    }
    return oFile;
};
