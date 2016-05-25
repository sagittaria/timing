<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuser extends CI_Controller {

	#需要个初始化方法 init(){}
	public function __construct(){
		parent::__construct();
		$this->load->model('Mblock');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	public function index(){
		#用户首页，显示各 block 的状态和累积时长
		$data['blocks']=$this->Mblock->MFgetAllMyBlocks();
		$this->load->view('header');
		$this->load->view('vuser/showallmyblock',$data);
		$this->load->view('footer');
	}
	
	public function addBlock(){
		#增加block的界面
		$this->load->view('header');
		$this->load->view('vuser/addblock');
		$this->load->view('footer');
	}
	
	public function addBlockGo(){
		if($this->Mblock->MFaddBlockGo()){
			echo "new block added.";
		}else{
			echo "block not added.";
		}
	}
	
	public function logout(){
		#注销登录
	}
}
