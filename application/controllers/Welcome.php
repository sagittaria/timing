<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        $this->load->model('Mbuilder'); 
        $this->load->helper('url');
    }
	
	public function index(){
		#显示登录界面
		$this->load->helper('form');
		$this->load->view('login');
	}
	
	public function register(){
		#新用户注册
		$this->load->helper('form');
		$this->load->library('form_validation');

		$un=$this->input->post('builderUsername');
		$em=$this->input->post('builderEmail');
		$this->form_validation->set_rules('builderUsername', 'Username', 'required|trim|min_length[5]|max_length[20]|callback_validUsername['.$un.']');
		$this->form_validation->set_rules('builderPassword', 'password', 'required|min_length[6]');
		$this->form_validation->set_rules('builderEmail', 'Email', 'trim|required|valid_email|callback_validEmail['.$em.']');
		
		if ($this->form_validation->run() === FALSE){
			$this->load->view('register');//如果没通过检查，就显示注册页面
		}else{   //如果通过检查的话调用 模型的 MFregister()方法注册
			if($this->Mbuilder->MFregister()){
				echo "Thanks for signing up ^_^";
			}else{
				echo "somehow failed, please try again T^T";
			}
		}
	}
	
	public function validUsername($un){//注册时会用到的回调函数，检查用户名唯一性
		if($this->Mbuilder->MFvalidUsername($un)){
			$this->form_validation->set_message('validUsername', 'Username already taken.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	public function validEmail($em){//注册时会用到的回调函数，检查邮箱唯一性
		if($this->Mbuilder->MFvalidEmail($em)){
			$this->form_validation->set_message('validEmail', 'Email address already taken.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	public function verifying(){
		#验证用户名密码		echo "verifying username and password...";
	}
	
	public function logout(){
		#注销登录
	}
}
