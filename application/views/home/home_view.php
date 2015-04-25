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
    <script src="<?php echo base_url(); ?>static/bootstrap/js/bootstrap-datetimepicker.zh-CN.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lte IE 9]>
    <script src="<?php echo base_url(); ?>static/iejs/respond.min.js"></script>
    <script src="<?php echo base_url(); ?>static/iejs/html5shiv.min.js"></script>
    <![endif]-->


    <script type="text/javascript">
        $(function () {
            // Invoke the plugin
            //$('input, textarea').placeholder();
        });
    </script>
    <title>Document</title>
</head>
<body>
<div class="container"><br><br>
    <form class="form-horizontal" role="form" id="add_custom">
        <div class="panel-group" id="accordion">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_base">
                            ������Ϣ
                        </a>
                    </h4>
                </div>
                <div id="collapse_base" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="name" class="control-label col-sm-2">�� ��</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm" id="name" name="name" placeholder="����������">
                            </div>

                            <label class="control-label col-sm-2" for="sex">�� ��</label>
                            <div class="col-sm-2">
                                <select class="form-control input-sm" name="sex" id="sex">
                                    <option>��</option>
                                    <option>Ů</option>
                                </select>
                            </div>

                            <label class="control-label col-sm-2" for="age">�� ��</label>
                            <div class="col-sm-2">
                                <input class="form-control input-sm" name="age" id="age" placeholder="����������">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telphone" class="col-sm-2 control-label">�� ��</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm" name="telphone" id="telphone" placeholder="������绰">
                            </div>

                            <label for="birthday" class="col-sm-2 control-label">�� ��</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form_datetime input-sm" name="birthday" id="birthday" placeholder="����������">
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- panel_base-->

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_invest">
                            Ͷ�����
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapse_invest">

                        <div class="panel-body">
                            <div class="form-group">

                                <label for="invest_type" class="col-sm-2 control-label">Ͷ������</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control input-sm" name="invest_type" id="invest_type" placeholder="������Ͷ������">
                                </div>

                                <label for="invest_date" class="col-sm-2 control-label">Ͷ������</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form_datetime input-sm" name="invest_date" id="invest_date" placeholder="������Ͷ������">
                                </div>

                                <label for="invest" class="col-sm-2 control-label">Ͷ�ʽ��</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control input-sm" name="invest" id="invest" placeholder="������Ͷ�ʽ��(��Ԫ)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="longcheng_type" class="col-sm-2 control-label">�˽����Ƿ�ʽ</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" name="longcheng_type" id="longcheng_type" placeholder="�������˽����Ƿ�ʽ">
                                </div>
                            </div>

                    </div>
                </div>
            </div><!-- panel ����invest -->

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_other">
                            ������Ϣ
                        </a
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapse_other">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="hobby" class="col-sm-2 control-label">�� ��</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm" name="hobby" id="hobby" placeholder="�����밮��">
                            </div>

                            <label for="elder" class="col-sm-2 control-label">�� ��</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm" name="elder" id="elder" placeholder="����������">
                            </div>

                            <label for="baby" class="col-sm-2 control-label">�� ��</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm" name="baby" id="baby" placeholder="�����뺢��">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">��ͥסַ</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control input-sm" name="address" id="address" placeholder="�������ͥסַ">
                            </div>

                        </div>

                        <div class="form-group">

                            <label for="work" class="col-sm-2 control-label">ְ ҵ</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control input-sm" name="work" id="work" placeholder="������ְҵ">
                            </div>

                            <label for="work_palce" class="col-sm-2 control-label">�� λ</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control input-sm" name="work_palce" id="work_palce" placeholder="�����뵥λ">
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div><!--panel group -->

    </form>
    <div class="form-group">
        <div class="col-sm-6">
            <button class="btn btn-primary" type="button" id="save">��������</button>
            <button class="btn btn-white" type="button">ȡ��</button>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(function () {
        $(".form_datetime").datetimepicker({
            format: 'yyyy-mm-dd',
            minView: "month",
            language: 'zh-CN', //����
            autoclose: true,
        });

        $("#save").click(
            function(){
                var gets = $("#add_custom").serialize();
                alert(gets);
            }
        );


    });

</script>
</body>
</html>