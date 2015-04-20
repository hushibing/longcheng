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
    <!--highcharts js-->
    <script src="<?php echo base_url(); ?>static/highcharts/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>static/highcharts/modules/exporting.js"></script>
    <!--自定义Css-->
    <link href="<?php echo base_url(); ?>static/mycss/mycss.css" type="text/css" rel="stylesheet"/>
    <!--按钮加载样式-->
    <link href="<?php echo base_url(); ?>static/ladda/ladda-themeless.min.css" rel="stylesheet">
</head>
<body data-spy="scroll" data-target="#myScrollspy">

<div class="container">
    <div id="bing"></div>
    <!--商城订单报表-->
    <div class="row"> <!--container-start-->
        <div class="col-md-12" id="search_form">

            <h3 class="text-center text-info">商城订单数据分析</h3><br>

            <form class="form-inline" role="form">
                <div class="form-group">
                    <label class="">下单时间：</label>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">开始日期</div>
                        <input type="text" class="form-control form_datetime tooltip-show" id="date_start"
                               placeholder="日期选择" data-toggle="tooltip" title="日期不能为空:格式如:2015-01-28">
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon">结束日期</div>
                        <input type="text" class="form-control form_datetime tooltip-show" id="date_end"
                               placeholder="日期选择" data-toggle="tooltip" title="为空则默认为当前时间">
                    </div>
                </div>

                <!-- <div class="form-group">
                     <label class="sr-only" for="inputfile">商城平台选择</label>
                     <select type="text" class="form-control" style="width: 160px;" id="inputfile" placeholder="商城平台选择">
                         <option>招 商</option>
                         <option>建 行</option>
                         <option>民 生</option>
                         <option>善 融</option>
                         <option>淘 宝</option>
                         <option>邮 乐</option>
                         <option>一卡通</option>
                     </select>
                 </div>-->

                <div class="form-group" style="margin-left: 16px;">
                    <button id="search_button" type="button" data-loading-text="统计中..."
                            class="btn btn-info ladda-button" data-style="expand-left">
                        <span class="ladda-label"> 提交统计 </span>
                    </button>
                </div>

                <div class="form-group" style="margin-left: 16px">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default" id="now_date">
                            <input type="radio" name="options"> 今 日</label>
                        <label class="btn btn-default" id="now_week">
                            <input type="radio" name="options">本 周</label>
                        <label class="btn btn-default" id="now_month">
                            <input type="radio" name="options">本 月</label>
                    </div>

                    <span class="badge popover-hide cursor-pointer font-size_12" title="使用说明"
                          data-container="body"
                          data-toggle="popover" data-placement="bottom"
                          data-content="<b>订单时间是以OA的下单时间为依据:</b><br>1. 选择下单的开始日期与结束日期后,点击提交">使用说明
                        </span>
                    <!--                    <button type="button" class="btn btn-default" id="now_date">今 日</button>-->
                    <!--                    <button type="button" class="btn btn-default" id="now_week">本 周</button>-->
                    <!--                    <button type="button" class="btn btn-default" id="now_month">本 月</button>-->
                </div>
            </form>

        </div>

        <!--        <div class="col-md-12">
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar"
                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                             style="width: 40%;">
                            <span class="sr-only">100% 完成</span>
                        </div>
                    </div>
                </div>
        -->
    </div>
    <!--container-end-->
    <!--商城订单报表-->
    <br/>

    <div class="row display_none">
        <div class="col-md-12 ">
            <div class="alert alert-warning fade in" id="alert_tip">
                <a href="#" class="close" id="alert_tip_close">
                    &times;
                </a>
                <strong>错误！</strong><span id="ajax_error"></span>。
            </div>
        </div>
    </div>
    <div class="row">
        <!--订单数据总量分析-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_all">订单总量数据分析 <span class="pull-right">
                        <span class="badge popover-hide cursor-pointer font-size_12" title="订单数据说明"
                              data-container="body"
                              data-toggle="popover" data-placement="top"
                              data-content="订单时间是以OA的下单时间为依据,查询出某时间段内的所有订单">数据说明
                        </span> 数量单位：个 </span></div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4>
                            订单总量数据: <span id="order_all_span"></span>
                            <!-- <button type="button" class="btn btn-sm btn-info" id="order_all" title="各平台订单详情"
                                     data-content="建行：<br>招商：<br>">
                                 订单数量详情
                             </button>-->
                        </h4>

                        <div id="containers_order_all"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                    <div class="col-md-6">
                        <h4>订单数量详情</h4>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>排序</th>
                                <th>平台</th>
                                <th>数量</th>
                                <th>订单占比率</th>
                                <th>销售额(元)</th>
                                <th>销售额占比率</th>
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
        <!--订单数据总量分析-->

        <!--发货订单数据分析-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_send">发货订单数据分析
                    <span class="badge popover-hide cursor-pointer font-size_12 pull-right" title="订单数据说明"
                          data-container="body"
                          data-toggle="popover" data-placement="top"
                          data-content="订单时间是以OA的下单时间为依据,查询出某时间段内的所有发货订单(不包含这段时间内发货后又退货的订单)">数据说明
                        </span>
                </div>
                <div class="panel-body">

                    <div class="col-md-6">
                        <h4>发货订单数量详情</h4>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>排序</th>
                                <th>平台</th>
                                <th>数量</th>
                                <th>发货占比率</th>
                                <th>销售额(元)</th>
                                <th>销售额占比率</th>
                            </tr>
                            <tbody id="table_order_send">

                            </tbody>
                        </table>
                        <div>
                            <div class="text-info" title="发货总数 / 订单总数"> 发货率 ：<span id="order_send_percent"></span></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4 class="text-info">发货订单数据总量: <span id="order_send_span"></span></h4>

                        <div id="container_order_send"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                </div>
                <!--panel-body-end-->
            </div>
            <!--panel-end-->
        </div>
        <!--col-md-12-end -->
        <!--发货订单数据分析-->

        <!--退货订单数据分析-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_back"> 退货订单数据分析

                    <span class="badge popover-hide cursor-pointer font-size_12 pull-right" title="订单数据说明"
                          data-container="body"
                          data-toggle="popover" data-placement="top"
                          data-content="订单时间是以OA的下单时间为依据,查询出某时间段内的所有退货订单。<br><b>全平台的退单占比：</b>退单数量与全平台退单总数比。<br><b>本平台的退单占比:</b>本平台退单数量与本平台订单总量比率">数据说明
                        </span>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4 class="text-info">退货订单数据总量: <span id="order_back_span"></span></h4>

                        <div id="container_order_back"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>排序</th>
                                <th>平台</th>
                                <th>退单数量</th>
                                <th>全平台的退单占比</th>
                                <th>本平台的退单占比</th>
                            </tr>
                            <tbody id="table_order_back">

                            </tbody>
                        </table>
                        <div class="text-info" title="退单总数 / 订单总数"> 退单率 ：<span id="order_back_percent"></span></div>
                    </div>
                </div>
                <!--panel-body-end -->
            </div>
            <!--panel-end -->
        </div>
        <!--退货订单数据分析-->

        <!--未退 未发货订单数据分析-->
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_not_send"> 未退_未发货订单数据分析</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h4 class="text-info">未退_未发货订单数据总量: <span id="order_not_send_span"></span></h4>

                        <div id="container_order_not_send"
                             style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>排序</th>
                                <th>平台</th>
                                <th>数量</th>
                                <th>退单率</th>
                                <th>销售额(元)</th>
                                <th>销售额占比率</th>
                            </tr>
                            <tbody id="table_order_not_send">

                            </tbody>
                        </table>
                        <div class="text-info" title="未退_未发总数 / 订单总数"> 未退_未发货率 ：<span
                                id="order_not_send_percent"></span></div>
                    </div>
                </div>
                <!--panel-body-end -->
            </div>
            <!--panel-end -->
        </div>
        <!--未退 未发货订单数据分析-->


        <!--销售额数据统计分析-->
        <div class="col-md-12 display_none">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_money">销售额数据统计分析　　<span class="pull-right"> 单位：元</span></div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h5 class="text-info">销售额数据统计分析</h5>
                        <table class="table table-responsive table-bordered table-striped">
                            <tr>
                                <th>排序</th>
                                <th>平台</th>
                                <th>金额</th>
                                <th>占比</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">合计：</td>
                                <td colspan="2">222222</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-info">发货订单销售额数据统计分析</h5>
                        <table class="table table-responsive table-bordered table-striped">
                            <tr>
                                <th>排序</th>
                                <th>平台</th>
                                <th>金额</th>
                                <th>占比</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>建行</td>
                                <td>15000</td>
                                <td>26%</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">合计：</td>
                                <td colspan="2">222222</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--销售额数据统计分析-->

        <!--商品品类统计分析-->
        <div class="col-md-12 display_none">
            <div class="panel panel-info">
                <div class="panel-heading" id="order_shops">发货商品品类详情分析</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div id="order_categorie"></div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th>排序</th>
                                <th>商品品类名称</th>
                                <th>订单数量</th>
                                <th>各平台数量</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>苹果Apple</td>
                                <td>256</td>
                                <td>建行 23，招商25</td>
                            </tr>
                            <tr>
                                <td>合计：</td>
                                <td></td>
                                <td colspan="2"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--品类统计分析-->

        <div id="test_bing" class="col-md-12" style="height: 300px;">

        </div>
        <div id="test_bing1" class="col-md-12" style="height: 300px;">

        </div>


    </div>
</div>
<!--container end-->

<div id="myScrollspy" class="pull-right">
    <ul class="nav nav-tabs nav-stacked" id="myNav">
        <li class="active"><a href="#search_form">条件查询</a></li>
        <li><a href="#order_all">订单总量数据</a></li>
        <li><a href="#order_send">发货订单数据</a></li>
        <li><a href="#order_back">退货订单数据</a></li>
        <li><a href="#order_money">销售额数据统计</a></li>
        <li><a href="#order_shops">发货商品品类</a></li>
    </ul>
</div>

</body>

<!--图表插件js-->
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

    //  设置元素属性内容
    $("#order_all").attr('data-content', '');

    //    $("#order_all").popover({html: true});
    //    $("#order_all").popover("toggle");
    //    $("#order_all").popover("hide");

    $('#search_button').click(function () {
        $(this).button('loading');//执行等待状态切换操作
        $(this).find('span.ladda-label').html('统计中....');
//        setTimeout(function () {
//            $("#search_button").button('reset');
//        }, 3000);

    })

    //显示警告提示信息
    function alert_show(text) {
        $('#alert_tip').show();
        $('#ajax_error').html(text);
    }

    $(function () {
        //浏览器检测


        //数据说明信息提示
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

        //隐藏ajax提交错误的提示信息
        $('#alert_tip').hide();
        $('#alert_tip_close').click(function () {
            $('#alert_tip').hide();
        });


        //提交查询事件
        $('#search_button').click(function () {
            var DateStart = $('#date_start').val();
            var DateEnd = $('#date_end').val();
            if (DateEnd == '' || DateEnd == undefined) {
                DateEnd = new Date().Format("yyyy-MM-dd");
            }
            if (!check_two_date(DateStart, DateEnd)) {
                //表单提示信息
                $('.tooltip-show').tooltip('show');
                $("#search_button").button('reset');
            } else {
                //执行查询
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
     * AJAx提交查询
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

                if (textStatus == 'parsererror') alert_show('返回的数据类型错误');
                var status_code = XMLHttpRequest.status;
                switch (status_code) {
                    case 404:
                        alert_show('请求网络地址不存在或错误');
                        break;
                    case 500:
                        alert_show('请求内部服务器错误');
                        break;
                }
                $("#search_button").button('reset');//重置提交按钮
            },

            success: function (data) {

                //全部订单数据
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
                //饼图——全部订单数据
                chart_order_all.series[0].setData(eval('(' + data.order_chart_data.order_all_chart + ')'));
                //饼图——发货订单数据
                chart_order_send.series[0].setData(eval('(' + data.order_chart_data.order_send_chart + ')'));
                //饼图——退货订单数据
                chart_order_back.series[0].setData(eval('(' + data.order_chart_data.order_back_chart + ')'));

                chart_order_not_send.series[0].setData(eval('(' + data.order_chart_data.order_not_send_chart + ')'));

                //改变查询按钮状态
                $("#search_button").button('reset');
                $('#alert_tip').hide();

            }
        })
    }


    //生成表格数据
    function generate_table(table_data, tag) {
        var tr_tag = '';
        var i = 1;
        var sum_money = 0;
        if (!($.isEmptyObject(table_data)) && typeof (table_data) == 'object') {
            $.each(table_data, function (key, val) {

                sum_money += parseFloat(val.sum_money);
                if (key == '总计:') {
                    tr_tag += '<tr>';
                    tr_tag += '<td colspan=\'2\' class=\'text-right font-weight-bold\'>' + key + '</td>';
                    tr_tag += '<td colspan=\'2\' class=\'font-weight-bold\'>' + val.nums + '</td>';
                    tr_tag += '<td colspan=\'2\' class=\'font-weight-bold formate_curency\'>' + fmoney(val.total_money, 2) + '</td>';
                    //tr_tag += '<td  class=\'font-weight-bold formate_curency\'>' + fmoney(val.ratio_money,2) + '</td>';
                    tr_tag += '</tr>';

                    //每个项目的率
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

    //        chart_order_all.series[0].setData([["建行 500",   35.0],['招商 200',36.8],{name: '善融 362',y: 12.8,sliced: true,selected: true},['民生 100',8.5],['淘宝 400',6.2],['邮乐 263',0.5],['一卡通 253',0.2]]);
    //        chart_order_all.series[0].setData(<?php //echo $chart_order_all_data;?>//);
    //        $("#bing").html('<?php //echo $chart_order_all_data;?>//');
    //设置发货订单数据
    //        chart_order_send.series[0].setData([['建行 500',   40.0],['招商 200',31.8],{name: '善融 362',y: 12.8,sliced: true,selected: true},['民生 100',8.5],['淘宝 400',6.2],['邮乐 263',0.5],['一卡通 253',0.2]]);
    //设置退货订单数据


</script>

<!--按钮插件-->
<script type="text/javascript" src="<?php echo base_url(); ?>static/ladda/spin.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/ladda/ladda.min.js"></script>
<script type="text/javascript">
    Ladda.bind('button[type=submit]', {timeout: 2000});
    //    $(function () {
    //        //格式化金额显示
    //        $(".formate_curency").formatCurrency();
    //        $('.formate_curency').toNumber();
    //    })
</script>
</html>