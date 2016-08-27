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
		$data['chartsData']=json_encode($this->Mblock->MFgetChartsData());
		$data['chartsDataForLineType']=json_encode($this->Mblock->MFgetChartsDataForLineType());
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
			redirect('Cuser/logout');
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
			redirect('Cuser/logout');
		}#禁止输入网址访问
		echo $this->Mblock->MFdeleteBlockGo();
	}
	
	public function updateBlock(){
		#修改block
		if($_SERVER['REQUEST_METHOD'] !== "POST"){
			redirect('Cuser/logout');
		}#禁止输入网址访问
		if($this->Mblock->MFupdateBlockGo()){
			echo "Block updated.";
		}else{
			echo "<script>alert('Somehow failed, please try later');</script>";
		}
		redirect('Cuser/index');
	}
	
	public function checkBlock(){
		#查看block里有的brick
		if($_SERVER['REQUEST_METHOD'] !== "POST"){
			redirect('Cuser/logout');
		}#禁止输入网址访问
		echo json_encode($this->Mbrick->MFcheckBlockGo());
	}
	
	public function showMoreBricks($blockId='NoWay',$num=0){
		#点开checkBlock之后，点More弹出的窗口，显示更多bricks
		$config['per_page'] = 12;//每页多少条
		
		//用模型方法获取所需数据
		$data=$this->Mbrick->MFshowMoreBricks($blockId,$config['per_page'],$num);
		
		if(!$data){	redirect('Cuser/logout');}//如果检查到不是本人的block，注销
		
		$this->load->library('pagination');
		$config['base_url'] = site_url('Cuser/showMoreBricks').'/'.$blockId;
		$config['total_rows'] = $data['total_rows'];		
		$config['num_links'] = 10;
		$config['first_link'] = 'First';
		$config['prev_link'] = 'Prev';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['attributes']=array('class'=>"btn btn-default");
		$config['cur_tag_open']='<button class="btn btn-default"><strong>';
		$config['cur_tag_close']='</strong></button>';
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
    $data['blockIdInFilter']=$blockId;#send to view (needed in filterFunction)
		
		$this->load->view('header');
		$this->load->view('vuser/showMoreBricks',$data);
		$this->load->view('footer');
	}
	
	public function deleteBrick(){
		echo $this->Mbrick->MFdeleteBrickGo();
	}
		
	public function logout(){
		#注销登录
		session_destroy();
		redirect('Welcome');
	}
}
