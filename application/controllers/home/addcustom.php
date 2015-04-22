<?php
/**
 * Created by PhpStorm.
 * User: bing
 * Date: 2015-04-22
 * Time: 20:52
 */
class Addcustom extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("home/addcustom_view");


    }
}