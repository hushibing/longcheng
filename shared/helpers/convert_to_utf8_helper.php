<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-01-22
 * Time: 16:29
 */


/**
 * Convert Array to utf_8
 * @param $arr
 * @param string $encoding
 * @return array|bool
 */
if (!function_exists('array_to_utf8')) {

    function array_to_utf8($arr, $encoding = 'GBK')
    {
        $utf8_array = array();
        if (is_array($arr)) {
            foreach ($arr as $key => $val) {
                if (function_exists('iconv')) {
                    $u_key = @iconv($encoding, 'UTF-8', $key);
                    if (is_array($val)) {
                        $u_val = array_to_utf8($val, $encoding);
                    } else {
                        $u_val = @iconv($encoding, 'UTF-8', $val);
                    }
                } elseif (function_exists('mb_convert_encoding')) {
                    $u_key = @mb_convert_encoding($key, 'UTF-8', $encoding);
                    if (is_array($val)) {
                        $u_val = array_to_utf8($val, $encoding);
                    } else {
                        $u_val = @mb_convert_encoding($val, 'UTF-8', $encoding);
                    }
                } else {
                    return false;
                }
                $utf8_array[$u_key] = $u_val;
            }
        }
        return $utf8_array;
    }
}


/**
 *	使用特定function对数组中所有元素做处理 使用引用直接处理数据
 *	@param	string	&$array		要处理的字符串
 *	@param	string	$function	要执行的函数
 *	@return boolean	$apply_to_keys_also	是否也应用到key上
 */
if (!function_exists('array_to_urlcode')) {

    function array_to_urlcode(&$array, $function='urlencode', $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        if (++$recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                array_to_urlcode($array[$key], $function, $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }

            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter--;
    }
}

/**
 * ?* 数组转码: 使用var_export
 * ?* @param array $arr 要转码的数组
 * ?* @param string $in_charset 输入的字符集
 * ?* @param string $out_charset 输出的字符集
 * ?* @return array
 * ?*/
if (!function_exists('array_to_encode')) {
    function array_to_encode(&$arr, $in_charset = 'GBK', $out_charset = "utf-8")
    {
        if (function_exists('iconv')) {
            return eval('return ' . iconv($in_charset, $out_charset, var_export($arr, 1)) . ';');
        } elseif (function_exists('mb_convert_encoding')) {
            return eval('return ' . mb_convert_encoding(var_export($arr, 1), $out_charset, $in_charset) . ';');
        }
    }
}