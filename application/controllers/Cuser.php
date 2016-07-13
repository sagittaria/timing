<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuser extends CI_Controller {

	#需要个初始化方法 init(){}
	public function __construct(){
		parent::__construct();
		$this->load->model('Mblock');
		$this->load->model('Mbrick');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
 		if(!isset($_SESSION['id'])){
 			redirect('Welcome');
 		}
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
		#增加block的功能
		if($_SERVER['REQUEST_METHOD'] !== "POST"){
			redirect('logout');
		}#禁止输入网址访问
		if($this->Mblock->MFaddBlockGo()){
			echo "new block added.";
			redirect('Cuser/index');
		}else{
			echo "block not added.";
			redirect('Cuser/addBlock');
		}
	}
	
	public function addBrick(){
		#新增个 brick
		if($_SERVER['REQUEST_METHOD'] !== "POST"){
			redirect('Cuser/logout');
		}#禁止输入网址访问
		if($this->Mbrick->MFaddBrickGo()){
			echo "succeeded.";
		}else{
			echo "<script>alert('Somehow failed, please try later');</script>";
		}
		redirect('Cuser/index');
	}
	
	public function deleteBlock(){
		#删除block，id由ajax方法post过来
		if($_SERVER['REQUEST_METHOD'] !== "POST"){
			redirect('logout');
		}#禁止输入网址访问
		echo $this->Mblock->MFdeleteBlockGo();
	}
	
	public function updateBlock(){
		#修改block
		if($_SERVER['REQUEST_METHOD'] !== "POST"){
			redirect('logout');
		}#禁止输入网址访问
		if($this->Mblock->MFupdateBlockGo()){
			echo "Block updated.";
		}else{
			echo "<script>alert('Somehow failed, please try later');</script>";
		}
		redirect('Cuser/index');
	}
		
	public function logout(){
		#注销登录
		session_destroy();
		redirect('Welcome');
	}
}
