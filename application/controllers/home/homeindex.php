<?php
/**
 * Created by PhpStorm.
 * User: bing
 * Date: 2015-04-20
 * Time: 21:43
 */
class Homeindex extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("home/home_view");
    }

}
