<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <title>excel��to��mysql</title>

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
<h4>��������</h4>


<?php
require_once 'Excel/reader.php';         //����������

$data = new Spreadsheet_Excel_Reader();  // ʵ����

$data->setOutputEncoding('gbk');//���ñ���

if (file_exists(getcwd() . '\xls\dingdan_zs.xls')) {

    $data->read('xls/dingdan_zs.xls');  //read������ȡ����EXCEL��֧������

} else {
    echo "<script>alert('�����ϴ�excel�ļ�!');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit;
}


//include_once("../../../../inc/auth.php");

$conn = mysql_connect('localhost', 'root', 'myoa888') or die("���ݿ����ӳ����ˡ�������");   // �������ݿ�

mysql_query("set names 'gbk'");//���ñ������

mysql_select_db('TD_OA'); //ѡ�����ݿ�
$table_tr_td = '';
$nums = 0;//���嵼������
$no_insert_tag = false;
$row_num = '';
$sql = "INSERT INTO orderlist(id,order_num,order_time,shangpin,jiage,shuliang,fenqi,dinghuo,shouhuo,songhuo_addr,dinghuo_tel,shouhuo_tel,dianhua_beizhu,fapiao_taitou,work,coupon) VALUES";
$values = ' ';
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {

    if ($data->sheets[0]['cells'][$i][1] != "") {
        //$work_excel = trim($data->sheets[0]['cells'][$i][13]);

        //�������
        $order_numbers = $data->sheets[0]['cells'][$i][1];
        //��Ʒ��Ϣ���
        $order_shop_name = $data->sheets[0]['cells'][$i][3];
          //��ѯ��Ʒ��Ϣ���


        //��Ʒ���
        $order_money = $data->sheets[0]['cells'][$i][9];
        //����
        $matches=array();
        $pre = preg_match("/\w*\(\s*(\d+)\s*\)\s*/", $data->sheets[0]['cells'][$i][9],$matches);
        if(!$pre) {
            $matches[1]=1;
        }
        $order_quantity = $matches[1];
        //����
        $per_installment = $data->sheets[0]['cells'][$i][8];
        $order_installment = floor($order_money/$per_installment);
        //������
        $order_order = $data->sheets[0]['cells'][$i][11];
        //�ջ���
        $order_consignee = $data->sheets[0]['cells'][$i][11];
        //��ϵ��ַ
        $order_addr = $data->sheets[0]['cells'][$i][13];
        //�����绰
        $order_otel = $data->sheets[0]['cells'][$i][12];
        //�ջ����绰
        $order_ctel = $data->sheets[0]['cells'][$i][12];
        //��ע
        $order_note = $data->sheets[0]['cells'][$i][15];
        //��Ʊ̧ͷ
        $order_invice_title='';
        //����
        $order_bank = '����';
        //�Żݽ��
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
//sql��䴦��
$values = substr($values, 0, strlen($values) - 1);
$values = strip_tags($values);

//���ִ���ж�
if ($no_insert_tag) {
    echo '<br> <span style=\'color:red;font-weight:bold;\'>����ʧ��:  ����' . $row_num . '�е���������.[����е�˳�����������]</span><br>';
} else {
    $sql .= $values;
    //$insert = mysql_query($sql);
    //echo $sql;
    if ($insert) {
        echo '<br><span style=\'color:green;font-size:13px;\'>�ɹ����� ' . $nums . ' �� ' . $work_excel . ' �������ݡ�</span><br>';
    } else {
        echo 'mysqlִ�в������ʧ��: ���sql���<br><br>';
        //echo $sql;
    }
}
//ҳ����ת�ж�
if ($work_excel == '�Ա�' || $work_excel == '����' || $work_excel == 'һ��ͨ') {
    echo "<br></br><a href='./tmall.php'>������ҳ</a><br><br>";
} else {
    echo "<br></br><a href='./index.php'>������ҳ</a><br><br>";
}

//���е�����
echo '<h4>excel���е�����</h4>';
echo '<table class=\'table\' cellPadding=1>' .
    '<tr><th>�� ��</th><th>�������</th><th>��Ʒ��Ϣ</th><th>�������(Ԫ)</th><th>����</th><th>����</th><th>������</th><th>�ջ���</th><th>��ϵ��ַ</th><th>�����˵绰</th><th>�ջ��˵绰</th><th>��ע</th><th>��Ʊ̧ͷ</th><th>����</th><th>�Ż�ȯ���</th></tr>';
echo $table_tr_td;
echo '</table>';


/* �޸ĵ���ɹ����ļ��� */

date_default_timezone_set('PRC');

$renamed = date('Y-m-d_H-i-s');
if (file_exists(getcwd() . '\xls\dingdan_zs.xls')) {
    if (rename(getcwd() . '\xls\dingdan_zs.xls', getcwd() . "\xls\dingdan_zs_�ɹ�����_" . $renamed . '_' . $work_excel . ".xls")) //��ԭ�ļ���������
    {
        echo "�ļ����޸ĳɹ�!";
        //echo "<a href='./index.php'>������ҳ</a>";
    } else {
        print "dingdan_zs.xls �ļ�������!<br>";
    }
} else {

    print "dingdan_zs.xls �ļ�������!<br>";

}

?>
</body>

</html>