<?php

/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-01-22
 * Time: 11:02
 */
class Test extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function pre()
    {
        $str = '��Ϊ HUAWEI Ascend Mate7 �����  ��ʯ�� �ƶ�4G (    12    )  ';
        $matches = array();
        $prem = preg_match("/\w*\(\s*(\d+)\s*\)\s*/", $str,$matches);
        var_dump($prem);
        var_dump($matches);
    }

    public function index()
    {
        //[['���� 500', 35.0], ['���� 200', 36.8],['���� 100', 8.5],['�Ա� 400', 6.2],['���� 263', 0.5],['һ��ͨ 253', 0.2]]

        $arr = array("����" => 35.0, '����' => 36.8, '����' => 8.5);
        $arrs = array(array('name' => 'bing', 'sex' => 'man'));
        $json = '';
        foreach ($arr as $key => $val) {
            $json .= '["' . $key . '",' . $val . '],';

        }
        $json = substr($json, 0, strlen($json) - 1);
        echo $json;


        var_dump(json_encode($arr));
        var_dump(json_encode($arrs));
        var_dump(json_decode("[{'����500', '35.0'}]"));
    }

    public function json()
    {
        $this->load->helper("hightcharts");
        $arr = array("����" => 35.0, '����' => 36.8, '����' => 8.5);
        var_dump(higthchart_data($arr,'����'));

    }
}