
��Ŀ˵���ĵ�

1. ��̬�ļ����õ�ַ   <?php echo base_url();?>static

   ע�⣺Ҫ��autoload�ļ����������� $autoload['helper'] = array('url');�����ڿ������м���url�� $this->load->helper('url');


2. ��������Ŀ¼���� ����ͼ��Ŀ¼����

3. ˳��������ӡ��ʹ��third_party(������Ӧ�ò��������)��

   ʹ�÷������ڿ�������ʾ�����£�
   
   //����Ӧ�ó���� ·��
   $this->load->add_package_path(BING_SHARE_PATH . 'third_party/shunfeng');
   //����ģ��
   $this->load->model('test_model');
   //����
   $this->test_model->index();

   

     


