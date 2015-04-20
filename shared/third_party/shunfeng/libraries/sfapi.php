<?php

/**
 * 顺丰下单接口[http/post]
 * 返回数组数据
 * User: Bing
 * Date: 2015-04-09
 * Time: 16:33
 */
class SFapi
{

    private $_CHECKHEADER = 'BSPdevelop'; //客户卡号,校验码
    private $_CHECKBODY = 'j8DzkIFgmlomPt0aLuwU'; //checkbody
    private $_URL = 'http://bsp-oisp.test.sf-express.com:6080/bsp-oisp/sfexpressService'; //快递类服务接口url
    private $_XML = "";
    private $_RES = "";

    /**
     * @param array $arr
     */
    public function __construct($arr=array())
    {
        //$this->orderservice($arr['orderdata']);
        $this->orderservice($arr);
    }

    /**
     * 生成xml请求数据格式
     * @param array $data
     */
    public function orderservice($data = array())
    {
        $xml = '<?xml version="1.0" encoding="utf-8" ?>';
        $xml .= '<Request service="OrderService" lang="zh-CN">';
        $xml .= '<Head>' . $this->_CHECKHEADER . '</Head>';
        $xml .= '<Body>';
        $xml .= '<Order orderid="' . $data["orderid"] . '" express_type="' . $data["express_type"] . '" j_company="' . $data["j_company"] . '" j_contact="' . $data["j_contact"] . '" j_tel="' . $data["j_tel"] . '" j_address="' . $data["j_address"] . '" d_company="' . $data["d_company"] . '" d_contact="' . $data["d_contact"] . '" d_tel="' . $data["d_tel"] . '" d_address="' . $data["d_address"] . '" pay_method="' . $data["pay_method"] . '" j_province="' . $data["j_province"] . '" j_city="' . $data["j_city"] . '" j_county="' . $data["j_qu"] . '" d_province="' . $data["d_province"] . '" d_city="' . $data["d_city"] . '" d_county="' . $data["d_qu"] . '" custid="' . $data["custid"] . '" remark="' . $data["remark"] . '" parcel_quantity="1">';
        if ($data["things_num"] != 0 && $data["things_num"] != "") {
            $xml .= '<Cargo name="' . $data["things"] . '" count="' . $data["things_num"] . '"></Cargo>';
        }
        if ($data["daishou"] != "" && $data["daishou"] != 0) {
            $xml .= '<AddedService name="COD" value="' . $data["daishou"] . '" value1="' . $data["custid"] . '" />';
        }
        $xml .= '</Order>';
        $xml .= '</Body>';
        $xml .= '</Request>';
        $this->_XML = $xml;
        return $this;
    }

    /**
     * 发送请求数据
     * @return $this
     */
    public function send()
    {
        if ($this->_XML == "") {
            return $this;
        } else {
            $newbody = $this->_XML.$this->_CHECKBODY;
            $md5 = md5($newbody, true);
            $verifyCode = base64_encode($md5);
            $PostData = array(
                "xml" => $this->_XML,
                "verifyCode" => $verifyCode
            );
            $this->_RES = $this->_http_post($this->_URL, $PostData);
        }
    }

    /**
     * post请求
     * @param $url
     * @param $param
     * @return mixed
     */
    private function _http_post($url, $param)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        $strPOST = http_build_query($param,'','&');
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, true);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        return $sContent;
    }

    /**
     * 返回请求数据xml格式
     * @return string
     */
    public function receivexml()
    {
        return $this->_RES;
    }

    public function return_xml()
    {
        return $this->_XML;
    }


}