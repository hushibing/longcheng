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
        $data['title'] = '˳�������µ����ӡϵͳ';
        $this->load->view('shunfeng/shunfeng_view',$data);
    }

    public function test()
    {
        header("Content-type: text/html; charset=utf-8");
        $data_array=array(
            'orderid' =>  '145236978',
            'express_type' =>  '2' ,
            'j_company' =>  '���Ϥι�˾' ,
          'j_contact' =>  '������' ,
          'j_tel' =>  '15842345665',
          'j_province' =>  'ɽ��ʡ',
          'j_city' =>  '�ൺ��',
          'j_qu' =>  '��ɽ��',
          'j_address' =>  '����㳡����',
          'd_company' =>  '���ܤι�˾',
          'd_contact' =>  '����',
          'd_tel' =>  '15544456578',
          'd_province' =>  'ɽ��ʡ',
          'd_city' =>  '������',
          'd_qu' =>  '��ɽ��',
          'd_address' =>  '��ȸɽ·��³����',
          'pay_method' =>  '1',
          'custid' =>  '5322059827',
          'daishou' =>  '0',
          'things' =>  'С����',
          'things_num' =>  '1',
          'remark' =>  '����������С���������~'
        );

        //ת��utf-8����
        $this->load->helper("convert_to_utf8_helper");
        $data_array = array_to_utf8($data_array);
        var_dump($data_array);


        //����·��
        $this->load->add_package_path(BING_SHARE_PATH . 'third_party/shunfeng');
        $this->load->library('sfapi',$data_array);
        //var_dump($this->sfapi);
        $this->sfapi->send();
        $tests = $this->sfapi->receivexml();

        $xml = $this->sfapi->return_xml();


        /**
         * ��ά
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
        $xml = '<?xml version="1.0" encoding="utf-8" ?><Request service="OrderService" lang="zh-CN"><Head>BSPdevelop</Head><Body><Order orderid="145236978" express_type="2" j_company="���Ϥι�˾" j_contact="������" j_tel="15842345665" j_address="����㳡����" d_company="���ܤι�˾" d_contact="����" d_tel="15544456578" d_address="��ȸɽ·��³����" pay_method="1" j_province="ɽ��ʡ" j_city="�ൺ��" j_county="��ɽ��" d_province="ɽ��ʡ" d_city="������" d_county="��ɽ��" custid="5322059827" remark="����������С���������~" parcel_quantity="1"><Cargo name="С����" count="1"></Cargo></Order></Body></Request>';

        $this->load->helper("convert_to_utf8_helper");
        $data_array = array_to_utf8($xml);
        $this->load->library('xml2array');
        $res = $this->xml2array->parser_xml($data_array);
        var_dump($res);
    }





}