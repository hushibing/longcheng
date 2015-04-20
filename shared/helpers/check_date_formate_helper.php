<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-01-29
 * Time: 11:55
 */

/**
 * check date formate and return
 * @param string $date_string= '2015-01-29'
 * @param int $model
 * @return bool|string ex:'2015-01-29 11:58:59'
 */
if (!function_exists("check_date_formate"))
{
    function check_date_formate($date_string='',$model=0)
    {
        //日期
        $now = time();
        $dateformate = "Y-m-d h:i:s";
        $dateformate00 = "Y-m-d 00:00:00";
        $dateformate59 = "Y-m-d 23:59:59";
        if($date_string=='') return date($dateformate, $now);
        if ($date_string != date('Y-m-d', strtotime($date_string))) {
            log_message('error','日期格式错误',true);
            return false;
        }
        if ($model){
            $date_fromat = date($dateformate59,strtotime($date_string));
        }else{
            $date_fromat = date($dateformate00, strtotime($date_string));
        }
        return $date_fromat;
    }
}