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
 	  public function newsofonecategories()
 	 {
 	 	
 	 	$category= $this->input->get('category');
 	 	$message['json']= $this->model->newsofonecategories($category);
 	 	$this->load->view('json',$message);

 	 }
 	 public function fullarticalbynewsid()
 	 {
 	 	$id=$this->input->get('id');
 	 	$message['json']= $this->model->fullarticalbynewsid($id);
 	 	$this->load->view('json',$message);
 	 }
 	 public function latestnewsfromallcategories()
 	 {
 	 	$message['json']=$this->model->latestnewsfromallcategories();
 	 	$this->load->view('json',$message);	
 	 }
 	 public function nexttennews()
 	 {
 	 	$count=$this->input->get('count');
 	 	$category=$this->input->get('category');
 	 	$message['json']= $this->model->nexttennews($count,$category);
 	 	$this->load->view('json',$message);
 	 }
 }