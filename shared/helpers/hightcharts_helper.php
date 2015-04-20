<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-01-22
 * Time: 11:38
 */

/**
 * generate higthchart_data
 * @param array $arr = array("建行" => 45.0, '招商' => 15.0, '民生' => 40)
 * @param string $str
 * @return string
 */

if (!function_exists('higthchart_data')) {

    function higthchart_data($arr = array(), $str = '')
    {
        if (is_array($arr)) {
            $json = '[';
            foreach ($arr as $key => $val) {
                if ($key == $str) {
                    $json .= '{name:"' . $key . '",y:' . $val . ',sliced:true,selected:true},';
                } else {
                    $json .= '["' . $key . '",' . $val . '],';
                }
            }
            $json = substr($json, 0, strlen($json) - 1);
            $json .= ']';
            return $json;
        }
        return false;
    }
}