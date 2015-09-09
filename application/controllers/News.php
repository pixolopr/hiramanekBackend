<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 header('Access-Control-Allow-Origin: *'); 
 
 class News extends PIXOLO_Controller { 
 
 	 function __construct(){ 
 	 	 parent::__construct(); 
 
 	 	 $this->load->model('New_model', 'model'); 
 	 } 

 	 public function index() 
 	 { 
 	 	 $message['json']=$this->model->get_all(); 
 	 	 $this->load->view('json', $message); 
 	 } 
 	  public function getnewsofonecategory()
 	 {
 	 	
 	 	$category= $this->input->get('category');
 	 	$message['json']= $this->model->getnewsofonecategory($category);
 	 	$this->load->view('json',$message);

 	 }
 	 public function getfullarticalbynewsid()
 	 {
 	 	$id=$this->input->get('id');
 	 	$message['json']= $this->model->getfullarticalbynewsid($id);
 	 	$this->load->view('json',$message);
 	 }
 	 public function getlatestnewsfromallcategories()
 	 {
 	 	$message['json']=$this->model->getlatestnewsfromallcategories();
 	 	$this->load->view('json',$message);	
 	 }
 	 public function getnexttennews()
 	 {
 	 	$count=$this->input->get('count');
 	 	$category=$this->input->get('category');
 	 	$message['json']= $this->model->getnexttennews($count,$category);
 	 	$this->load->view('json',$message);
 	 }
 }