<!DOCTYPE html>
<html>
<head>
    <meta charset="GB2312">
    <title>�̳Ƕ�������-<?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!--bootstrap-->
    <link href="<?php echo base_url(); ?>static/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>static/bootstrap/js/jquery.min1.9.1.js"></script>
    <!--<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>-->
    <script src="<?php echo base_url(); ?>static/bootstrap/js/bootstrap.js"></script>
    <!--datetimpker-->
    <link href="<?php echo base_url(); ?>static/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>static/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <!--�Զ���Css-->
    <link href="<?php echo base_url(); ?>static/mycss/mycss.css" type="text/css" rel="stylesheet"/>
    <!--webuploader--����CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/webuploader/webuploader.css">
    <!--webuploader--����JS-->
    <script type="text/javascript" src="<?php echo base_url(); ?>static/webuploader/webuploader.js"></script>

	<script type="text/javascript">
	$(function(){
	$list=$("#thelist");
    var uploader = WebUploader.create({

        // swf�ļ�·��
        swf:'<?php echo base_url(); ?>static/webuploader/Uploader.swf',

        // �ļ����շ���ˡ�
        server: '<?php echo site_url();?>/importexcel/ioexcel/uploadfile',
        // ѡ���ļ��İ�ť����ѡ��
        // �ڲ����ݵ�ǰ�����Ǵ�����������inputԪ�أ�Ҳ������flash.
        pick: '#picker',

        // ��ѹ��image, Ĭ�������jpeg���ļ��ϴ�ǰ��ѹ��һ�����ϴ���
        resize: false
    });
    // �����ļ�����ӽ����е�ʱ��
    uploader.on( 'fileQueued', function( file ) {
        $list.append( '<div id="' + file.id + '" class="item">' +
        '<h4 class="info">' + file.name + '</h4>' +
        '<p class="state">�ȴ��ϴ�...</p>' +
        '</div>' );
    });

    // �ļ��ϴ������д���������ʵʱ��ʾ��
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress .progress-bar');

        // �����ظ�����
        if ( !$percent.length ) {
            $percent = $('<div class="progress progress-striped active">' +
            '<div class="progress-bar" role="progressbar" style="width: 0%">' +
            '</div>' +
            '</div>').appendTo( $li ).find('.progress-bar');
        }

        $li.find('p.state').text('�ϴ���');

        $percent.css( 'width', percentage * 100 + '%' );
    });

    //
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).find('p.state').text('���ϴ�');
    });

    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('�ϴ�����');
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
            <!--��������ļ���Ϣ-->
            <div id="thelist" class="uploader-list"></div>
            <div class="btns">
                <div id="picker">ѡ���ļ�</div>
                <button id="ctlBtn" class="btn btn-default">��ʼ�ϴ�</button>
            </div>
    </div>

</body>

</html>