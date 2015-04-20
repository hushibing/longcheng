<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Class Firstpage
 */
class Firstpage extends CI_Controller
{

    /**
     *  构造函数
     */
    function __construct()
    {
        parent::__construct();
        $this->load->helper("hightcharts");
    }


    public function testmodel()
    {
        //        $datestart=date("Y-m-d",mktime(0, 0 , 0,date("m")-1,1,date("Y")));
        //        $dateend=date("Y-m-d",mktime(0, 0 , 0,date("m"),0,date("Y")));
        //        echo $datestart.' '.$dateend;
        $this->load->model('firstpage_model');
        //        $this->load->helper('array');
        $order_all_data = $this->firstpage_model->find_all();
        var_dump($order_all_data);
        //        var_dump(array_multisort_array($order_all_data['order_all'],'nums'));

    }

    /**
     * 加载页面
     */
    public function index()
    {

        //全部订单
        $arr = array("建行" => 45.0, '招商' => 15.0, '民生' => 40);
        $chart_order_all_data = higthchart_data($arr, '招商');

        $data = array(
            'title' => '数据分析页面',
            'chart_order_all_data' => $chart_order_all_data,
        );

        $this->load->view('analysesdata/firstpage_view', $data);
    }

    /**
     * 返回饼图数据 数组格式
     * @array $arr=
     * @return array|bool : =array("建行" => 44.43, '招商' => 15.57, '民生' => 40);
     */
    private function _generate_chart_data($arr)
    {
        $chart_data_array = array();
        if (is_array($arr)) {
            foreach ($arr as $key => $val) {
                foreach ($val as $vkey => $vval) {
                    if ($key != '总计:') {
                        $chart_data_array[$key] = $val['ratio'];
                    }
                }

            }
            return $chart_data_array;
        }
        return false;
    }

    /**
     *订单总量数据
     * echo JSON
     */
    public function orderAllData()
    {
        //接收传入参数值
        $datestart = $this->input->post('datestart');
        $dateend = $this->input->post('dateend');
        $pattern = $this->input->post('pattern');
        //默认为本周统计数据
        if(empty($datestart) && empty($dateend)&& empty($pattern)) $pattern='thisweek';


        //固定时间段
        switch ($pattern) {
            case 'thisdate':
                $datestart = date("Y-m-d", strtotime("now"));
                $dateend = date('Y-m-d', strtotime("now"));
                break;
            case 'thisweek':
                $datestart = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y")));
                $dateend = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y")));
                break;
            case 'thismonth':
                $datestart = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
                $dateend = date('Y-m-d', strtotime("now"));
                break;

            case 'preday':
                $datestart = date("Y-m-d", strtotime("yesterday"));
                $dateend = date('Y-m-d', strtotime("yesterday"));;
                break;
            case 'preweek':
                $datestart = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));//date("Y-m-d",strtotime("-2 week Monday"));
                $dateend = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w"), date("Y")));//date("Y-m-d",strtotime("-1 week Monday"));
                break;
            case 'premonth':
                $datestart = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
                $dateend = date("Y-m-d", mktime(0, 0, 0, date("m"), 0, date("Y")));
                break;
        }


        //返回所有订单信息
        $this->load->model('firstpage_model');
        $this->load->helper('array');
        $order_all_data = $this->firstpage_model->find_all($datestart, $dateend);

        //表格 数据格式：二维数组 array("建行" => array('nums' => 45000, 'ratio' => 45.0), '招商' => array('nums' => 15000, 'ratio' => 15.0), '民生' => array('nums' => 40000, 'ratio' => 40.0))

        $order_all = $this->_GenerateOrderData_(array_multisort_array($order_all_data['order_all'], 'nums'));//全部订单
        $order_send = $this->_GenerateOrderData_(array_multisort_array($order_all_data['order_send'], 'nums'));//发货订单
        $order_back = $this->_GenerateOrderData_(array_multisort_array($order_all_data['order_back'], 'nums'));//退货订单
        $order_not_send = $this->_GenerateOrderData_(array_multisort_array($order_all_data['order_not_send'], 'nums'));//未发未退订单

        $order_money = array("建行" => array('nums' => 45000, 'ratio' => 45.0), '招商' => array('nums' => 15000, 'ratio' => 15.0), '民生' => array('nums' => 40000, 'ratio' => 40.0));

        //加入本平台退单占比率
        $bank_back_percent = $this->order_back_percent($order_all, $order_back);
        $order_back = array_merge_recursive($order_back, $bank_back_percent);
        //去年销售额统计
        $order_back['总计:']['total_money'] = '0';


        //构造表格数据 多维数组
        $order_table_data = array(
            'order_all' => $order_all,
            'order_send' => $order_send,
            'order_back' => $order_back,
            'order_not_send' => $order_not_send,
            'order_money' => $order_money
        );


        //生成饼图数据格式 array("建行" => 44.43, '招商' => 15.57, '民生' => 40);
        $order_all_chart = $this->_generate_chart_data($order_all);
        $order_send_chart = $this->_generate_chart_data($order_send);
        $order_back_chart = $this->_generate_chart_data($order_back);
        $order_not_send_chart = $this->_generate_chart_data($order_not_send);

        $order_money_chart = array("建行" => 35.0, '招商' => 25.0, '民生' => 40);

        //转换成饼图 数据格式 [后台需要转成JSON格式]：JSON = [['招商',25.0],{ name: '建行', y: 12.8, sliced: true, selected: true},['民生',35.0]]
        $order_all_chart_data = higthchart_data($order_all_chart, '招商');
        $order_send_chart_data = higthchart_data($order_send_chart, '建行');
        $order_back_chart_data = higthchart_data($order_back_chart, '民生');
        $order_not_send_chart_data = higthchart_data($order_not_send_chart, '民生');
        $order_money_chart_data = higthchart_data($order_money_chart, '招商');

        //        var_dump(array_multisort_array($order_all_data['order_all'],'nums'));
//        var_dump($order_all);
//        echo 'back';
//        var_dump($order_back);
//        echo 'back_bank';

//            echo 'bank_percent';
//                var_dump($bank_back_percent);
        //        var_dump($order_all_chart);
        //将饼图数据格式组成数组
        $order_chart_data = array(
            'order_all_chart' => $order_all_chart_data,
            'order_send_chart' => $order_send_chart_data,
            'order_back_chart' => $order_back_chart_data,
            'order_not_send_chart' => $order_not_send_chart_data,
            'order_money_chart' => $order_money_chart_data
        );

        //合并表格数据格式与饼图数据格式: 方便页面输出- 表格数据:json.order_table_data; 饼图数据json.order_chart_data
        $order_data = array(
            'order_table_data' => $order_table_data,
            'order_chart_data' => $order_chart_data
        );

        //转成UTF-8编码
        $this->load->helper("convert_to_utf8");
        $order_data = array_to_encode($order_data);

        //返回JSON数据
        echo json_encode($order_data);

    }

    /**
     * 获取本平台的退单比率
     * @param array $order_all 全部订单数据
     * @param array $order_back 退单数据
     * @return array|bool
     */
    protected function order_back_percent($order_all = array(), $order_back = array())
    {
        $bank_percent = array();
        if (is_array($order_all) && count($order_all) > 0 && is_array($order_back) && count($order_back) > 0) {
            foreach ($order_back as $key => $val) {
                foreach ($order_all as $oa_key=>$oa_val) {
                    if ($key==$oa_key)
                    {
                        $bank_percent[$key] = array();
                        $bank_percent[$key]['this_bank_percent'] = floatval(number_format($order_back[$key]['nums'] / $order_all[$oa_key]['nums'], 4));
                    }
                }
            }
            return $bank_percent;
        }
        return false;

    }

    /**
     * 生成 表格需要的数据格式：二维数组 用于页面展示输出
     * @param $res_array
     * @return array ：=array("建行" => array('nums' => 450, 'ratio' => 45.45), '招商' => array('nums' => 150, 'ratio' => 14.55), '民生' => array('nums' => 400, 'ratio' => 40.0), '总计:' => array('nums' => '1000', 'ratio' => 100.0));
     */
    protected function _GenerateOrderData_($res_array = array())
    {

        if (is_array($res_array) && count($res_array) > 0) {

            $total_nums = 0;
            $total_money = 0;

            foreach ($res_array as $key => $val) {
                if (is_array($val) && count($val) > 0) {
                    foreach ($val as $vkey => $vval) {
                        if ($vkey == 'nums' && $vkey != '') {
                            $total_nums += (int)$vval;
                        }
                        if ($vkey == 'sum_money' && $vkey != '') {
                            $total_money += (float)$vval;
                        }
                    }
                }
            }

            $order_all = array();

            foreach ($res_array as $key => $val) {
                if (is_array($val) && count($val) > 0) {
                    foreach ($val as $vkey => $vval) {
                        if ($vkey == 'work') {
                            $order_all[$vval] = $val;
                            $order_all[$vval]['ratio'] = (floatval(number_format($val['nums'] / $total_nums, 4)));
                            $order_all[$vval]['ratio_money'] = (floatval(number_format($val['sum_money'] / $total_money, 4)));
                        }
                        unset($order_all[$vval]['work']);
                    }
                }
            }
            $order_all['总计:'] = array('nums' => $total_nums, 'ratio' => 100, 'total_money' => $total_money);
            return ($order_all);
        }
    }
}

/* End of file firstpage.php */
/* Location: ./application/controllers/firstpage.php */