<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-01-29
 * Time: 14:48
 * @author Bing
 * @date 2014-11-08
 *  Êý×é°ïÖúº¯Êý
 */
 if(!function_exists('array_multisort_array'))
 {
     function array_multisort_array($multi_array,$sort_key,$sort_type=SORT_NUMERIC,$sort_order=SORT_DESC)
     {
         if (is_array($multi_array) && count($multi_array) > 0) {
             foreach ($multi_array as $key => $value) {
                 if (is_array($value)) $key_array[] = $value[$sort_key];
             }
             array_multisort($key_array, $sort_type, $sort_order, $multi_array);
             return $multi_array;
         }
     }
 }