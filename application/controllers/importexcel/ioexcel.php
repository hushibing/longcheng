<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 智能分析excel表并按需要格式导入到数据库中
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-02-03
 * Time: 15:59
 */

class Ioexcel extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }

    

    public function index()
    {
        $data['title'] = 'excel导入';
        $this->load->view('exportexcel/exportexcel_view',$data);
    }

    public function uploadfile()
    {
//        echo 'asdf';

        $field_name = "file";
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($field_name))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('upload_success', $data);
        }

    }
}