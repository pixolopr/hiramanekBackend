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
 	  public function newsofcategoriesbyid()
 	 {
 	 	
 	 	$id= $this->input->get('id');
 	 	$message['json']= $this->model->newsofcategoriesbyid($id);
 	 	$this->load->view('json',$message);

 	 }
 	 public function fullarticalbynewsid()
 	 {
 	 	$id=$this->input->get('id');
 	 	$message['json']= $this->model->fullarticalbynewsid($id);
 	 	$this->load->view('json',$message);
 	 }
 }