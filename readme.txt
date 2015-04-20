
项目说明文档

1. 静态文件引用地址   <?php echo base_url();?>static

   注意：要在autoload文件中引入配置 $autoload['helper'] = array('url');或是在控制器中加载url类 $this->load->helper('url');


2. 控制器子目录访问 、视图多目录管理

3. 顺丰物流打印：使用third_party(第三方应用插件管理功能)；

   使用方法：在控制器的示例如下：
   
   //加载应用程序包 路径
   $this->load->add_package_path(BING_SHARE_PATH . 'third_party/shunfeng');
   //加载模型
   $this->load->model('test_model');
   //调用
   $this->test_model->index();

   

     


