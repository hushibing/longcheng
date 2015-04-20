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
    <!--highcharts js-->
    <script src="<?php echo base_url(); ?>static/highcharts/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>static/highcharts/modules/exporting.js"></script>
    <!--�Զ���Css-->
    <link href="<?php echo base_url(); ?>static/mycss/mycss.css" type="text/css" rel="stylesheet"/>
    <!--��ť������ʽ-->
    <link href="<?php echo base_url(); ?>static/ladda/ladda-themeless.min.css" rel="stylesheet">
</head>
<body data-spy="scroll" data-target="#myScrollspy">

<div class="container">
    <div id="bing"></div>
    <!--�̳Ƕ�������-->
    <div class="row"> <!--container-start-->
        <div class="col-md-12" id="search_form">

            <h3 class="text-center text-info">�̳Ƕ������ݷ���</h3><br>

            <form class="form-inline" role="form">
                <div class="form-group">
                    <label class="">�µ�ʱ�䣺</label>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">��ʼ����</div>
                        <input type="text" class="form-control form_datetime tooltip-show" id="date_start"
                               placeholder="����ѡ��" data-toggle="tooltip" title="���ڲ���Ϊ��:��ʽ��:2015-01-28">
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon">��������</div>
                        <input type="text" class="form-control form_datetime tooltip-show" id="date_end"
                               placeholder="����ѡ��" data-toggle="tooltip" title="Ϊ����Ĭ��Ϊ��ǰʱ��">
                    </div>
                </div>

                <!-- <div class="form-group">
                     <label class="sr-only" for="inputfile">�̳�ƽ̨ѡ��</label>
                     <select type="text" class="form-control" style="width: 160px;" id="inputfile" placeholder="�̳�ƽ̨ѡ��">
                         <option>�� ��</option>
                         <option>�� ��</option>
                         <option>�� ��</option>
                         <option>�� ��</option>
                         <option>�� ��</option>
                         <option>�� ��</option>
                         <option>һ��ͨ</option>
                     </select>
                 </div>-->

                <div class="form-group" style="margin-left: 16px;">
                    <button id="search_button" type="button" data-loading-text="ͳ����..."
                            class="btn btn-info ladda-button" data-style="expand-left">
                        <span class="ladda-label"> �ύͳ�� </span>
                    </button>
                </div>

                <div class="form-group" style="margin-left: 16px">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default" id="now_date">
                            <input type="radio" name="options"> �� ��</label>
                        <label class="btn btn-default" id="now_week">
                            <input type="radio" name="options">�� ��</label>
                        <label class="btn btn-default" id="now_month">
                            <input type="radio" name="options">�� ��</label>
                    </div>

                    <span class="badge popover-hide cursor-pointer font-size_12" title="ʹ��˵��"
                          data-container="body"
                          data-toggle="popover" data-placement="bottom"
                          data-content="<b>����ʱ������OA���µ�ʱ��Ϊ����:</b><br>1. ѡ���µ��Ŀ�ʼ������������ں�,����ύ">ʹ��˵��
                        </span>
                    <!--                    <button type="button" class="btn btn-default" id="now_date">�� ��</button>-->
                    <!--                    <button type="button" class="btn btn-default" id="now_week">�� ��</button>-->
                    <!--                    <button type="button" class="btn btn-default" id="now_month">�� ��</button>-->
                </div>
            </form>

        </div>

        <!--        <div class="col-md-12">
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar"
                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                             style="width: 40%;">
                            <span class="sr-only">100% ���</span>
                        </div>
                    </div>
                </div>
        -->
    </div>
    <!--container-end-->
    <!--�̳Ƕ�������-->
    <br/>

    <div class="row display_none">
        <div class="col-md-12 ">
            <div class="alert alert-warning fade in" id="alert_tip">
                <a href="#" class="close" id="alert_tip_close">
                    &times;
                </a>
                <strong>����</strong><span id="ajax_error"></span>��
            </div>
        </div>
    </div>
    <div class="row">
        <!--����������������-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_all">�����������ݷ��� <span class="pull-right">
                        <span class="badge popover-hide cursor-pointer font-size_12" title="��������˵��"
                              data-container="body"
                              data-toggle="popover" data-placement="top"
                              data-content="����ʱ������OA���µ�ʱ��Ϊ����,��ѯ��ĳʱ����ڵ����ж���">����˵��
                        </span> ������λ���� </span></div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4>
                            ������������: <span id="order_all_span"></span>
                            <!-- <button type="button" class="btn btn-sm btn-info" id="order_all" title="��ƽ̨��������"
                                     data-content="���У�<br>���̣�<br>">
                                 ������������
                             </button>-->
                        </h4>

                        <div id="containers_order_all"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                    <div class="col-md-6">
                        <h4>������������</h4>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>����</th>
                                <th>ƽ̨</th>
                                <th>����</th>
                                <th>����ռ����</th>
                                <th>���۶�(Ԫ)</th>
                                <th>���۶�ռ����</th>
                            </tr>
                            <tbody id="table_order_all">
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--panel-body-end -->
            </div>
            <!--panel-end-->
        </div>
        <!--����������������-->

        <!--�����������ݷ���-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_send">�����������ݷ���
                    <span class="badge popover-hide cursor-pointer font-size_12 pull-right" title="��������˵��"
                          data-container="body"
                          data-toggle="popover" data-placement="top"
                          data-content="����ʱ������OA���µ�ʱ��Ϊ����,��ѯ��ĳʱ����ڵ����з�������(���������ʱ���ڷ��������˻��Ķ���)">����˵��
                        </span>
                </div>
                <div class="panel-body">

                    <div class="col-md-6">
                        <h4>����������������</h4>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>����</th>
                                <th>ƽ̨</th>
                                <th>����</th>
                                <th>����ռ����</th>
                                <th>���۶�(Ԫ)</th>
                                <th>���۶�ռ����</th>
                            </tr>
                            <tbody id="table_order_send">

                            </tbody>
                        </table>
                        <div>
                            <div class="text-info" title="�������� / ��������"> ������ ��<span id="order_send_percent"></span></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4 class="text-info">����������������: <span id="order_send_span"></span></h4>

                        <div id="container_order_send"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                </div>
                <!--panel-body-end-->
            </div>
            <!--panel-end-->
        </div>
        <!--col-md-12-end -->
        <!--�����������ݷ���-->

        <!--�˻��������ݷ���-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_back"> �˻��������ݷ���

                    <span class="badge popover-hide cursor-pointer font-size_12 pull-right" title="��������˵��"
                          data-container="body"
                          data-toggle="popover" data-placement="top"
                          data-content="����ʱ������OA���µ�ʱ��Ϊ����,��ѯ��ĳʱ����ڵ������˻�������<br><b>ȫƽ̨���˵�ռ�ȣ�</b>�˵�������ȫƽ̨�˵������ȡ�<br><b>��ƽ̨���˵�ռ��:</b>��ƽ̨�˵������뱾ƽ̨������������">����˵��
                        </span>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4 class="text-info">�˻�������������: <span id="order_back_span"></span></h4>

                        <div id="container_order_back"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>����</th>
                                <th>ƽ̨</th>
                                <th>�˵�����</th>
                                <th>ȫƽ̨���˵�ռ��</th>
                                <th>��ƽ̨���˵�ռ��</th>
                            </tr>
                            <tbody id="table_order_back">

                            </tbody>
                        </table>
                        <div class="text-info" title="�˵����� / ��������"> �˵��� ��<span id="order_back_percent"></span></div>
                    </div>
                </div>
                <!--panel-body-end -->
            </div>
            <!--panel-end -->
        </div>
        <!--�˻��������ݷ���-->

        <!--δ�� δ�����������ݷ���-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_not_send"> δ��_δ�����������ݷ���</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4 class="text-info">δ��_δ����������������: <span id="order_not_send_span"></span></h4>

                        <div id="container_order_not_send"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>����</th>
                                <th>ƽ̨</th>
                                <th>����</th>
                                <th>�˵���</th>
                                <th>���۶�(Ԫ)</th>
                                <th>���۶�ռ����</th>
                            </tr>
                            <tbody id="table_order_not_send">

                            </tbody>
                        </table>
                        <div class="text-info" title="δ��_δ������ / ��������"> δ��_δ������ ��<span
                                id="order_not_send_percent"></span></div>
                    </div>
                </div>
                <!--panel-body-end -->
            </div>
            <!--panel-end -->
        </div>
        <!--δ�� δ�����������ݷ���-->


        <!--���۶�����ͳ�Ʒ���-->
        <div class="col-md-12 display_none">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_money">���۶�����ͳ�Ʒ�������<span class="pull-right"> ��λ��Ԫ</span></div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h5 class="text-info">���۶�����ͳ�Ʒ���</h5>
                        <table class="table table-responsive table-bordered table-striped">
                            <tr>
                                <th>����</th>
                                <th>ƽ̨</th>
                                <th>���</th>
                                <th>ռ��</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">�ϼƣ�</td>
                                <td colspan="2">222222</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-info">�����������۶�����ͳ�Ʒ���</h5>
                        <table class="table table-responsive table-bordered table-striped">
                            <tr>
                                <th>����</th>
                                <th>ƽ̨</th>
                                <th>���</th>
                                <th>ռ��</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>����</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">�ϼƣ�</td>
                                <td colspan="2">222222</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--���۶�����ͳ�Ʒ���-->

        <!--��ƷƷ��ͳ�Ʒ���-->
        <div class="col-md-12 display_none">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_shops">������ƷƷ���������</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div id="order_categorie"></div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th>����</th>
                                <th>��ƷƷ������</th>
                                <th>��������</th>
                                <th>��ƽ̨����</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>ƻ��Apple</td>
                                <td>256</td>
                                <td>���� 23������25</td>
                            </tr>
                            <tr>
                                <td>�ϼƣ�</td>
                                <td></td>
                                <td colspan="2"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Ʒ��ͳ�Ʒ���-->

        <div id="test_bing" class="col-md-12" style="height: 300px;">

        </div>
        <div id="test_bing1" class="col-md-12" style="height: 300px;">

        </div>


    </div>
</div>
<!--container end-->

<div id="myScrollspy" class="pull-right">
    <ul class="nav nav-tabs nav-stacked" id="myNav">
        <li class="active"><a href="#search_form">������ѯ</a></li>
        <li><a href="#order_all">������������</a></li>
        <li><a href="#order_send">������������</a></li>
        <li><a href="#order_back">�˻���������</a></li>
        <li><a href="#order_money">���۶�����ͳ��</a></li>
        <li><a href="#order_shops">������ƷƷ��</a></li>
    </ul>
</div>

</body>

<!--ͼ����js-->
<script type="text/javascript" src="<?php echo base_url(); ?>static/myjs/mycharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/myjs/comm_function.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/myjs/formatcurency.js"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd',
        minView: "month",
        autoclose: true,
    });
    $("#order_send_percent,#order_back_percent").tooltip({
        placement: 'bottom'
    });
    $("#myNav").affix({
        offset: {
            top: 0
        }
    });

    //  ����Ԫ����������
    $("#order_all").attr('data-content', '');

    //    $("#order_all").popover({html: true});
    //    $("#order_all").popover("toggle");
    //    $("#order_all").popover("hide");

    $('#search_button').click(function () {
        $(this).button('loading');//ִ�еȴ�״̬�л�����
        $(this).find('span.ladda-label').html('ͳ����....');
//        setTimeout(function () {
//            $("#search_button").button('reset');
//        }, 3000);

    })

    //��ʾ������ʾ��Ϣ
    function alert_show(text) {
        $('#alert_tip').show();
        $('#ajax_error').html(text);
    }

    $(function () {
        //��������


        //����˵����Ϣ��ʾ
        var $popover_tag = $('.popover-hide');
        $('.popover-hide').popover({
            html: true
        });
        $('.popover-hide').popover('hide');
        $popover_tag.on('mouseenter', function () {
            $(this).popover('show');
        });
        $popover_tag.on('mouseleave', function () {
            $(this).popover('hide');
        });


//        $('.popover-hide').on('show.bs.popover', function () {
//            setTimeout(function () {
//                $('.popover-hide').popover('hide');
//            }, 5000);
//        });

        //����ajax�ύ�������ʾ��Ϣ
        $('#alert_tip').hide();
        $('#alert_tip_close').click(function () {
            $('#alert_tip').hide();
        });


        //�ύ��ѯ�¼�
        $('#search_button').click(function () {
            var DateStart = $('#date_start').val();
            var DateEnd = $('#date_end').val();
            if (DateEnd == '' || DateEnd == undefined) {
                DateEnd = new Date().Format("yyyy-MM-dd");
            }
            if (!check_two_date(DateStart, DateEnd)) {
                //����ʾ��Ϣ
                $('.tooltip-show').tooltip('show');
                $("#search_button").button('reset');
            } else {
                //ִ�в�ѯ
                ajax_select(DateStart, DateEnd, '');
            }
        });

        $("#now_date").click(function () {
            ajax_select('', '', 'thisdate');
        });

        $("#now_week").click(function () {
            ajax_select('', '', 'thisweek');
        });

        $("#now_month").click(function () {
            ajax_select('', '', 'thismonth');
        });


    });

    /**
     * AJAx�ύ��ѯ
     * @param dateStart
     * @param dateEnd
     */
    function ajax_select(dateStart, dateEnd, models) {

        $.ajax({
            type: 'post',
            url: '<?php echo site_url();?>/analysesdata/firstpage/OrderAllData?nowtime=' + new Date().getTime(),
            data: {datestart: dateStart, dateend: dateEnd, pattern: models},
            dataType: 'json',
            error: function (XMLHttpRequest, textStatus, errorThrown) {

                if (textStatus == 'parsererror') alert_show('���ص��������ʹ���');
                var status_code = XMLHttpRequest.status;
                switch (status_code) {
                    case 404:
                        alert_show('���������ַ�����ڻ����');
                        break;
                    case 500:
                        alert_show('�����ڲ�����������');
                        break;
                }
                $("#search_button").button('reset');//�����ύ��ť
            },

            success: function (data) {

                //ȫ����������
                var order_all_table = generate_table(data.order_table_data.order_all, 'order_all');
                var order_send_table = generate_table(data.order_table_data.order_send, 'order_send');
                var order_back_table = generate_table(data.order_table_data.order_back, 'order_back');
                var order_not_send_table = generate_table(data.order_table_data.order_not_send, 'order_not_send');
//                var order_money_table = generate_table(data.order_table_data.order_money);
                $("#table_order_all").html(order_all_table);
                $("#table_order_send").html(order_send_table);
                $("#table_order_back").html(order_back_table);
                $("#table_order_not_send").html(order_not_send_table);
//                $("#table_order_money").append(order_money_table);
                //��ͼ����ȫ����������
                chart_order_all.series[0].setData(eval('(' + data.order_chart_data.order_all_chart + ')'));
                //��ͼ����������������
                chart_order_send.series[0].setData(eval('(' + data.order_chart_data.order_send_chart + ')'));
                //��ͼ�����˻���������
                chart_order_back.series[0].setData(eval('(' + data.order_chart_data.order_back_chart + ')'));

                chart_order_not_send.series[0].setData(eval('(' + data.order_chart_data.order_not_send_chart + ')'));

                //�ı��ѯ��ť״̬
                $("#search_button").button('reset');
                $('#alert_tip').hide();

            }
        })
    }


    //���ɱ������
    function generate_table(table_data, tag) {
        var tr_tag = '';
        var i = 1;
        var sum_money = 0;
        if (!($.isEmptyObject(table_data)) && typeof (table_data) == 'object') {
            $.each(table_data, function (key, val) {

                sum_money += parseFloat(val.sum_money);
                if (key == '�ܼ�:') {
                    tr_tag += '<tr>';
                    tr_tag += '<td colspan=\'2\' class=\'text-right font-weight-bold\'>' + key + '</td>';
                    tr_tag += '<td colspan=\'2\' class=\'font-weight-bold\'>' + val.nums + '</td>';
                    tr_tag += '<td colspan=\'2\' class=\'font-weight-bold formate_curency\'>' + fmoney(val.total_money, 2) + '</td>';
                    //tr_tag += '<td  class=\'font-weight-bold formate_curency\'>' + fmoney(val.ratio_money,2) + '</td>';
                    tr_tag += '</tr>';

                    //ÿ����Ŀ����
                    $("#" + tag + "_span").html(val.nums);
                    var total_tag = parseInt($("#order_all_span").text());
                    var val_nums = parseInt(val.nums);
                    if (total_tag != '') {
                        var total_percent = ( val_nums / total_tag).toFixed(2);
                        $("#" + tag + "_percent").html(total_percent * 100 + '%');
                    }


                } else {
                    if (key != '' && val.nums != '' && val.ratio != '') {
                        var ratio = parseFloat(val.ratio);
                        var ratio_money = parseFloat(val.ratio_money);
                        tr_tag += '<tr><td>' + i + '</td>';
                        tr_tag += '<td>' + key + '</td>';
                        tr_tag += '<td>' + val.nums + '</td>';
                        tr_tag += '<td>' + (ratio * 100).toFixed(2) + '%</td>';
                        console.info(val.this_bank_percent);
                        if (val.this_bank_percent != '' && typeof val.this_bank_percent != 'undefined') {
                            tr_tag += '<td>' + (val.this_bank_percent * 100).toFixed(2) + '%</td>';
                        } else {
                            tr_tag += '<td class=\'formate_curency\'>' + fmoney(val.sum_money, 2) + '</td>';
                            tr_tag += '<td>' + (ratio_money * 100).toFixed(2) + '%</td>';
                        }
                        tr_tag += '</tr>';
                    }
                }
                i++;
            });
            return tr_tag;
        }
        return false;
    }

    //        chart_order_all.series[0].setData([["���� 500",   35.0],['���� 200',36.8],{name: '���� 362',y: 12.8,sliced: true,selected: true},['���� 100',8.5],['�Ա� 400',6.2],['���� 263',0.5],['һ��ͨ 253',0.2]]);
    //        chart_order_all.series[0].setData(<?php //echo $chart_order_all_data;?>//);
    //        $("#bing").html('<?php //echo $chart_order_all_data;?>//');
    //���÷�����������
    //        chart_order_send.series[0].setData([['���� 500',   40.0],['���� 200',31.8],{name: '���� 362',y: 12.8,sliced: true,selected: true},['���� 100',8.5],['�Ա� 400',6.2],['���� 263',0.5],['һ��ͨ 253',0.2]]);
    //�����˻���������


</script>

<!--��ť���-->
<script type="text/javascript" src="<?php echo base_url(); ?>static/ladda/spin.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/ladda/ladda.min.js"></script>
<script type="text/javascript">
    Ladda.bind('button[type=submit]', {timeout: 2000});
    //    $(function () {
    //        //��ʽ�������ʾ
    //        $(".formate_curency").formatCurrency();
    //        $('.formate_curency').toNumber();
    //    })
</script>
</html>