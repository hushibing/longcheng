<?php
/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-03-03
 * Time: 9:39
 */

class St extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = '顺丰物流下单与打印系统';
        $this->load->view('shunfeng/shunfeng_view',$data);
    }

    public function test()
    {
        header("Content-type: text/html; charset=utf-8");
        $data_array=array(
            'orderid' =>  '145236978',
            'express_type' =>  '2' ,
            'j_company' =>  '西瓜の公司' ,
          'j_contact' =>  '大西瓜' ,
          'j_tel' =>  '15842345665',
          'j_province' =>  '山东省',
          'j_city' =>  '青岛市',
          'j_qu' =>  '崂山区',
          'j_address' =>  '丽达广场对面',
          'd_company' =>  '菠萝の公司',
          'd_contact' =>  '大菠萝',
          'd_tel' =>  '15544456578',
          'd_province' =>  '山东省',
          'd_city' =>  '临沂市',
          'd_qu' =>  '兰山区',
          'd_address' =>  '金雀山路齐鲁大厦',
          'pay_method' =>  '1',
          'custid' =>  '5322059827',
          'daishou' =>  '0',
          'things' =>  '小笼包',
          'things_num' =>  '1',
          'remark' =>  '精密仪器，小心轻拿轻放~'
        );

        //转成utf-8编码
        $this->load->helper("convert_to_utf8_helper");
        $data_array = array_to_utf8($data_array);
        var_dump($data_array);


        //加载路径
        $this->load->add_package_path(BING_SHARE_PATH . 'third_party/shunfeng');
        $this->load->library('sfapi',$data_array);
        //var_dump($this->sfapi);
        $this->sfapi->send();
        $tests = $this->sfapi->receivexml();

        $xml = $this->sfapi->return_xml();


        /**
         * 多维
         */
        $this->load->library('xml2array');
        $res = $this->xml2array->parser_xml($xml);
        //var_dump($res);
        /**
         * tag
         */
        $res = $this->xml2array->parser_xml($xml,'Order');
        var_dump($res);

        $this->load->library('xml2assoc');
        $str = $this->xml2assoc->parseString($xml,true);
        //var_dump($str);

    }


    public function xmlto(){
        $xml = '<?xml version="1.0" encoding="utf-8" ?><Request service="OrderService" lang="zh-CN"><Head>BSPdevelop</Head><Body><Order orderid="145236978" express_type="2" j_company="西瓜の公司" j_contact="大西瓜" j_tel="15842345665" j_address="丽达广场对面" d_company="菠萝の公司" d_contact="大菠萝" d_tel="15544456578" d_address="金雀山路齐鲁大厦" pay_method="1" j_province="山东省" j_city="青岛市" j_county="崂山区" d_province="山东省" d_city="临沂市" d_county="兰山区" custid="5322059827" remark="精密仪器，小心轻拿轻放~" parcel_quantity="1"><Cargo name="小笼包" count="1"></Cargo></Order></Body></Request>';

        $this->load->helper("convert_to_utf8_helper");
        $data_array = array_to_utf8($xml);
        $this->load->library('xml2array');
        $res = $this->xml2array->parser_xml($data_array);
        var_dump($res);
    }





}