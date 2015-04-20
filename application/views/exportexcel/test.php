<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <title>excel—to—mysql</title>

    <style type='text/css'>
        body {
            font-size: 12px;
        }

        h4 {
            font-size: 14px;
            color: #555;
        }

        .table {
            border: 1px #C0C0C0 solid;
            BORDER-COLLAPSE: collapse;
            margin: 6px 0;
            color: #555
        }

        .table th {
            padding: 3px 5px;
            border: 1px #C0C0C0 solid;
            font-size: 13px;
        }

        .table td {
            padding: 3px 5px;
            border: 1px #C0C0C0 solid;
            font-size: 12px;
        }
    </style>
</head>

<body style="font-size:13px;">
<h4>订单导入</h4>


<?php
require_once 'Excel/reader.php';         //加载所需类

$data = new Spreadsheet_Excel_Reader();  // 实例化

$data->setOutputEncoding('gbk');//设置编码

if (file_exists(getcwd() . '\xls\dingdan_zs.xls')) {

    $data->read('xls/dingdan_zs.xls');  //read函数读取所需EXCEL表，支持中文

} else {
    echo "<script>alert('请先上传excel文件!');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit;
}


//include_once("../../../../inc/auth.php");

$conn = mysql_connect('localhost', 'root', 'myoa888') or die("数据库连接出错了。。。。");   // 连接数据库

mysql_query("set names 'gbk'");//设置编码输出

mysql_select_db('TD_OA'); //选择数据库
$table_tr_td = '';
$nums = 0;//定义导入数量
$no_insert_tag = false;
$row_num = '';
$sql = "INSERT INTO orderlist(id,order_num,order_time,shangpin,jiage,shuliang,fenqi,dinghuo,shouhuo,songhuo_addr,dinghuo_tel,shouhuo_tel,dianhua_beizhu,fapiao_taitou,work,coupon) VALUES";
$values = ' ';
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {

    if ($data->sheets[0]['cells'][$i][1] != "") {
        //$work_excel = trim($data->sheets[0]['cells'][$i][13]);

        //订单编号
        $order_numbers = $data->sheets[0]['cells'][$i][1];
        //商品信息编号
        $order_shop_name = $data->sheets[0]['cells'][$i][3];
          //查询商品信息编号


        //商品金额
        $order_money = $data->sheets[0]['cells'][$i][9];
        //数量
        $matches=array();
        $pre = preg_match("/\w*\(\s*(\d+)\s*\)\s*/", $data->sheets[0]['cells'][$i][9],$matches);
        if(!$pre) {
            $matches[1]=1;
        }
        $order_quantity = $matches[1];
        //分期
        $per_installment = $data->sheets[0]['cells'][$i][8];
        $order_installment = floor($order_money/$per_installment);
        //订货人
        $order_order = $data->sheets[0]['cells'][$i][11];
        //收货人
        $order_consignee = $data->sheets[0]['cells'][$i][11];
        //联系地址
        $order_addr = $data->sheets[0]['cells'][$i][13];
        //订货电话
        $order_otel = $data->sheets[0]['cells'][$i][12];
        //收货货电话
        $order_ctel = $data->sheets[0]['cells'][$i][12];
        //备注
        $order_note = $data->sheets[0]['cells'][$i][15];
        //发票抬头
        $order_invice_title='';
        //银行
        $order_bank = '招商';
        //优惠金额
        $order_benefit = '';


        if (true) {
            $values .= "('','" . $data->sheets[0]['cells'][$i][1] . "',now(),'" . $data->sheets[0]['cells'][$i][3] . "','" . $data->sheets[0]['cells'][$i][9] . "','" . $data->sheets[0]['cells'][$i][4] . "','" . $data->sheets[0]['cells'][$i][5] . "','" . $data->sheets[0]['cells'][$i][11] . "','" . $data->sheets[0]['cells'][$i][11] . "','" . $data->sheets[0]['cells'][$i][13] . "','" . $data->sheets[0]['cells'][$i][12] . "','" . $data->sheets[0]['cells'][$i][12] . "','" . $data->sheets[0]['cells'][$i][15] . "','" . $data->sheets[0]['cells'][$i][12] . "','" . $data->sheets[0]['cells'][$i][13] . "','" . $data->sheets[0]['cells'][$i][14] . "'),";

            $nums = $nums + 1;
        } else {
            $no_insert_tag = true;
            $row_num .= $i . ', ';
        }


        $str = '';
        $tr_td = '<tr><td>' . ($i - 1);

        //for ($j=1;$j<=15;$j++)
        //{
        $tr_td .= '<td>' . $order_numbers . '</td>';
        $tr_td .= '<td>' . $order_shop_name . '</td>';
        $tr_td .= '<td>' . $order_money. '</td>';
        $tr_td .= '<td>' . $order_quantity . '</td>';
        $tr_td .= '<td>' . $order_installment . '</td>';
        $tr_td .= '<td>' . $order_order . '</td>';
        $tr_td .= '<td>' . $order_consignee . '</td>';
        $tr_td .= '<td>' . $order_addr . '</td>';
        $tr_td .= '<td>' . $order_otel . '</td>';
        $tr_td .= '<td>' . $order_ctel . '</td>';
        $tr_td .= '<td>' . $order_note . '</td>';
        $tr_td .= '<td>' . $order_invice_title . '</td>';
        $tr_td .= '<td>' . $order_bank . '</td>';
        $tr_td .= '<td>' . $order_benefit . '</td>';

        //	}
        $tr_td .= '</tr>';
        $table_tr_td .= $tr_td;
    }
}
//sql语句处理
$values = substr($values, 0, strlen($values) - 1);
$values = strip_tags($values);

//语句执行判断
if ($no_insert_tag) {
    echo '<br> <span style=\'color:red;font-weight:bold;\'>导入失败:  检查第' . $row_num . '行的数据问题.[检查列的顺序或银行名称]</span><br>';
} else {
    $sql .= $values;
    //$insert = mysql_query($sql);
    //echo $sql;
    if ($insert) {
        echo '<br><span style=\'color:green;font-size:13px;\'>成功导入 ' . $nums . ' 条 ' . $work_excel . ' 订单数据。</span><br>';
    } else {
        echo 'mysql执行插入操作失败: 检查sql语句<br><br>';
        //echo $sql;
    }
}
//页面跳转判断
if ($work_excel == '淘宝' || $work_excel == '邮乐' || $work_excel == '一卡通') {
    echo "<br></br><a href='./tmall.php'>返回首页</a><br><br>";
} else {
    echo "<br></br><a href='./index.php'>返回首页</a><br><br>";
}

//表中的数据
echo '<h4>excel表中的数据</h4>';
echo '<table class=\'table\' cellPadding=1>' .
    '<tr><th>序 号</th><th>订单编号</th><th>商品信息</th><th>订单金额(元)</th><th>数量</th><th>分期</th><th>订货人</th><th>收货人</th><th>联系地址</th><th>订货人电话</th><th>收货人电话</th><th>备注</th><th>发票抬头</th><th>银行</th><th>优惠券金额</th></tr>';
echo $table_tr_td;
echo '</table>';


/* 修改导入成功的文件名 */

date_default_timezone_set('PRC');

$renamed = date('Y-m-d_H-i-s');
if (file_exists(getcwd() . '\xls\dingdan_zs.xls')) {
    if (rename(getcwd() . '\xls\dingdan_zs.xls', getcwd() . "\xls\dingdan_zs_成功导入_" . $renamed . '_' . $work_excel . ".xls")) //把原文件重新命名
    {
        echo "文件名修改成功!";
        //echo "<a href='./index.php'>返回首页</a>";
    } else {
        print "dingdan_zs.xls 文件不存在!<br>";
    }
} else {

    print "dingdan_zs.xls 文件不存在!<br>";

}

?>
</body>

</html>