<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 header('Access-Control-Allow-Origin: *'); 
 
 class Newsphotos extends PIXOLO_Controller { 
 
 	 function __construct(){ 
 	 	 parent::__construct(); 
 
 	 	 $this->load->model('Newsphoto_model', 'model'); 
 	 } 

 	 public function index() 
 	 { 
 	 	 $message['json']=$this->model->get_all(); 
 	 	 $this->load->view('json', $message); 
 	 }
 	 public function getallimagesofnews()
 	 {
 	 	$id= $this->input->get('id');
 	 	$message['json']= $this->model->getallimagesofnews($id);
 	 	$this->load->view('json',$message);

 	 } 
 }