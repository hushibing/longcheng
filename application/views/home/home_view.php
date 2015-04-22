<!doctype html>
<html lang="en">
<head>
    <meta charset="gbk">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" ,Chrome=1">
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
    <!--boostrap-->
    <link href="<?php echo base_url(); ?>static/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>static/bootstrap/js/jquery.min1.9.1.js"></script>
    <script src="<?php echo base_url(); ?>static/bootstrap/js/bootstrap.js"></script>

    <!--datetimpker-->
    <link href="<?php echo base_url(); ?>static/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>static/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lte IE 9]>
    <script src="<?php echo base_url(); ?>static/iejs/respond.min.js"></script>
    <script src="<?php echo base_url(); ?>static/iejs/html5shiv.min.js"></script>
    <![endif]-->

    <!--<script src="http://libs.baidu.com/jquery/1.10.2/jquery.js"></script>-->
    <script type="text/javascript">
        $(function () {
            // Invoke the plugin
            $('input, textarea').placeholder();
        });
    </script>
    <title>Document</title>
</head>
<body>
<div class="container"><br><br>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">�� ��</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="name"
                       placeholder="����������">
            </div>

            <label for="telphone" class="col-sm-2 control-label">�� ��</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="telphone"
                       placeholder="����������">
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">��</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname"
                       placeholder="��������">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> ���ס��
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">��¼</button>
            </div>
        </div>
    </form>


    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">����</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" placeholder="���������������ַ">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">����</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="������������������">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox">��ס����
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btnbtn-default">��������</button>
            </div>
        </div>
    </form>

</div>
</body>
</html>