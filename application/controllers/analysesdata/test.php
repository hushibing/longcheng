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
        $str = '华为 HUAWEI Ascend Mate7 标配版  曜石黑 移动4G (    12    )  ';
        $matches = array();
        $prem = preg_match("/\w*\(\s*(\d+)\s*\)\s*/", $str,$matches);
        var_dump($prem);
        var_dump($matches);
    }

    public function index()
    {
        //[['建行 500', 35.0], ['招商 200', 36.8],['民生 100', 8.5],['淘宝 400', 6.2],['邮乐 263', 0.5],['一卡通 253', 0.2]]

        $arr = array("建行" => 35.0, '招商' => 36.8, '民生' => 8.5);
        $arrs = array(array('name' => 'bing', 'sex' => 'man'));
        $json = '';
        foreach ($arr as $key => $val) {
            $json .= '["' . $key . '",' . $val . '],';

        }
        $json = substr($json, 0, strlen($json) - 1);
        echo $json;


        var_dump(json_encode($arr));
        var_dump(json_encode($arrs));
        var_dump(json_decode("[{'建行500', '35.0'}]"));
    }

    public function json()
    {
        $this->load->helper("hightcharts");
        $arr = array("建行" => 35.0, '招商' => 36.8, '民生' => 8.5);
        var_dump(higthchart_data($arr,'招商'));

    }
}