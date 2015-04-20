<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-01-22
 * Time: 10:20
 */
class Firstpage_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    /**
     * ʹ������: ���ordertime����
     * @param string $date_start
     * @param string $date_end
     * @return bool
     */
    public function create_temptable($date_start = '', $date_end = '')
    {
        $drop_table = $this->db->query("DROP TEMPORARY TABLE IF EXISTS order_temp_table");
        $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS order_temp_table (
  SELECT
  id,
  order_time,
  fahuo_flag,
  tuihuo_flag,
  `work`,
  shuliang,
  jiage
  FROM orderlist_js WHERE order_time BETWEEN '$date_start' AND '$date_end' AND fahuo_flag IN (0,1) AND tuihuo_flag IN (0,1) AND `work` IN ('����',  '����',  '�Ա�',  '����',  'һ��ͨ',  '����',  '����'))
  UNION (SELECT
  id,
  order_time,
  fahuo_flag,
  tuihuo_flag,
  `work`,
  shuliang,
  jiage
  FROM orderlist WHERE order_time BETWEEN '$date_start' AND '$date_end' AND fahuo_flag IN (0,1) AND tuihuo_flag IN (0,1) AND `work` IN ('����',  '����',  '�Ա�',  '����',  'һ��ͨ',  '����',  '����'))";
        $create_temp_table = $this->db->query($sql);
        if ($drop_table && $create_temp_table) {
            return true;
        }
        return false;
        //        var_dump($boolean);

        //        $query = $this->db->query("SELECT * FROM order_temp_table");
        //        $res = $query->result_array();
        //        var_dump($res);
    }

    public function find_all($date_start = '', $date_end = '')
    {
        //����
        //$date_endΪ�գ���Ϊ��ǰϵͳʱ��
        $date_start = '2015-01-01';
        $date_end = '2015-01-27';

        $this->load->helper("check_date_formate");
        $date_start = check_date_formate($date_start, 0);
        $date_end = check_date_formate($date_end, 1);
        if(!$date_start||!$date_end) return '���ڸ�ʽ����';
        $order_array = array();
        $temp_table = $this->create_temptable($date_start, $date_end);
        if ($temp_table) {
            //ȫ������
            $res_order_all = $this->_result_array(array());
            //��������
            $res_order_send = $this->_result_array(array('fahuo_flag' => 1, 'tuihuo_flag' => 0));
            //δ��δ��
            $res_order_not_send = $this->_result_array(array('fahuo_flag' => 0, 'tuihuo_flag' => 0));
            //�˻�����
            $res_order_back = $this->_result_array(array('tuihuo_flag' => 1));
            $order_array['order_all'] = $res_order_all;
            $order_array['order_send'] = $res_order_send;
            $order_array['order_not_send'] = $res_order_not_send;
            $order_array['order_back'] = $res_order_back;
            return $order_array;
        }
        return false;
    }


//    private function check_date_formate($date_string='',$model=0){
//        //����
//        $now = time();
//        $dateformate = "%Y-%m-%d %h:%i:%s";
//        $dateformate00 = "%Y-%m-%d 00:00:00";
//        $dateformate59 = "%Y-%m-%d 23:59:59";
//        $this->load->helper('date');
//        if($date_string=='') return mdate($dateformate, $now);
//        if ($date_string != mdate('%Y-%m-%d', strtotime($date_string))) {
//            return '���ڸ�ʽ����';
//        }
//        if ($model){
//            $date_fromat = mdate($dateformate59,strtotime($date_string));
//        }else{
//            $date_fromat = mdate($dateformate00, strtotime($date_string));
//        }
//        return $date_fromat;
//    }

    /**
     * _result_array
     * return result array
     * @param array $where
     * @return mixed
     */
    private function _result_array($where = array())
    {
        $this->db->select("count('id') nums,sum(shuliang*jiage) sum_money,`work`");
        if(count($where)>0)  $this->db->where($where);
        $this->db->group_by('work');
        $query = $this->db->get('order_temp_table');
        $res_array = $query->result_array();
        return $res_array;
    }

//    /**
//     * ��ѯȫ����������
//     * @param string $date_start
//     * @param string $date_end
//     * @return string || Array
//     */
//    public function find_order_all($date_start = '', $date_end = '')
//    {
//        //����
//        $this->load->helper('date');
//        $date_start = '2015-01-01';
//        $date_end = '2015-01-27';
//        if ($date_start != mdate('%Y-%m-%d', strtotime($date_start)) || $date_end != mdate('%Y-%m-%d', strtotime($date_end))) {
//            return '���ڸ�ʽ����';
//        }
//
//        $now = time();
//        $dateformate = "%Y-%m-%d %h:%i:%s";
//        $dateformate0 = "%Y-%m-%d 00:00:00";
//        if ($date_start == '') $date_start = mdate($dateformate0, $now);
//        if ($date_end == '') $date_end = mdate($dateformate, $now);
//
//        /**
//         * $sql ��fahuo_flag:������ʶ tuihuo_flag���˻���ʶ [0:δ�˻�δ����1:�ѷ�������]
//         *
//         */
//        $sql = "SELECT
//  count('id') nums,
//  work
//FROM (SELECT
//        id,
//        order_time,
//        fahuo_flag,
//        tuihuo_flag,
//        work
//      FROM orderlist_js
//      UNION SELECT
//              id,
//              order_time,
//              fahuo_flag,
//              tuihuo_flag,
//              work
//            FROM orderlist) temptable
//WHERE fahuo_flag IN (0, 1) AND tuihuo_flag IN (0, 1) AND order_time BETWEEN '$date_start' AND '$date_end' AND
//      temptable.work IN ('����', '����', '�Ա�', '����', 'һ��ͨ', '����', '����')
//GROUP BY work ;";
//        $query = $this->db->query($sql);
//        $res = $query->result_array();
//        return $res;
//    }

}