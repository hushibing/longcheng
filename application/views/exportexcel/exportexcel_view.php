<!DOCTYPE html>
<html>
<head>
    <meta charset="GB2312">
    <title>商城订单报表-<?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!--bootstrap-->
    <link href="<?php echo base_url(); ?>static/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>static/bootstrap/js/jquery.min1.9.1.js"></script>
    <!--<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>-->
    <script src="<?php echo base_url(); ?>static/bootstrap/js/bootstrap.js"></script>
    <!--datetimpker-->
    <link href="<?php echo base_url(); ?>static/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>static/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <!--自定义Css-->
    <link href="<?php echo base_url(); ?>static/mycss/mycss.css" type="text/css" rel="stylesheet"/>
    <!--webuploader--引入CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/webuploader/webuploader.css">
    <!--webuploader--引入JS-->
    <script type="text/javascript" src="<?php echo base_url(); ?>static/webuploader/webuploader.js"></script>

	<script type="text/javascript">
	$(function(){
	$list=$("#thelist");
    var uploader = WebUploader.create({

        // swf文件路径
        swf:'<?php echo base_url(); ?>static/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: '<?php echo site_url();?>/importexcel/ioexcel/uploadfile',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#picker',

        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false
    });
    // 当有文件被添加进队列的时候
    uploader.on( 'fileQueued', function( file ) {
        $list.append( '<div id="' + file.id + '" class="item">' +
        '<h4 class="info">' + file.name + '</h4>' +
        '<p class="state">等待上传...</p>' +
        '</div>' );
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress .progress-bar');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<div class="progress progress-striped active">' +
            '<div class="progress-bar" role="progressbar" style="width: 0%">' +
            '</div>' +
            '</div>').appendTo( $li ).find('.progress-bar');
        }

        $li.find('p.state').text('上传中');

        $percent.css( 'width', percentage * 100 + '%' );
    });

    //
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).find('p.state').text('已上传');
    });

    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错');
    });

    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').fadeOut();
    });

})
</script>
</head>
<body>
    <div class="container">
        <div id="uploader" class="wu-example">
            <!--用来存放文件信息-->
            <div id="thelist" class="uploader-list"></div>
            <div class="btns">
                <div id="picker">选择文件</div>
                <button id="ctlBtn" class="btn btn-default">开始上传</button>
            </div>
    </div>

</body>

</html>