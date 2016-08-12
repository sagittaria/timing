<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Mbuilder'); 
        //$this->load->model('Mblock');
        $this->load->helper('url');
        $this->load->library('session');
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
		$this->form_validation->set_rules('builderPassword', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('builderEmail', 'Email', 'trim|required|valid_email|callback_validEmail['.$em.']');
		$this->form_validation->set_error_delimiters('<span style="color:red;font-size:12px;">','</span>');

		if ($this->form_validation->run() === FALSE){
			$this->load->view('register');//如果没通过检查，就显示注册页面
		}else{   //如果通过检查的话调用 模型的 MFregister()方法注册
			if($this->Mbuilder->MFregister()){
				echo "Welcome, ".$un.". Click to <a href='".site_url()."'> Sign In</a> (redirecting in 2 seconds...)";
				echo "<script>setTimeout('location=\"".site_url()."\"',1600);</script>";				
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
		#验证用户名密码
		if($user=$this->Mbuilder->MFverify()){
			//echo "signed in as ".$user[0]['builderId']." ".$user[0]['builderUsername']." ".$user[0]['builderEmail']; //var_dump($user[0]);
			$_SESSION['id']=$user[0]['builderId'];
			$_SESSION['name']=$user[0]['builderUsername'];
			$_SESSION['email']=$user[0]['builderEmail'];
			$this->load->model('Mbrick');
			$this->Mbrick->MFupdateVoidBlock();#每次登陆更新Void block里的brick
			redirect('Cuser/index');
		}else{
			echo "Invalid username or password";
			echo "<script>setTimeout('window.history.go(-1)',1000);</script>";
		}
	}
	
	public function trydbops(){
		#这是个用来测试数据库操作的方法，真正部署时应该被注释或删掉
	}
}
