<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 header('Access-Control-Allow-Origin: *'); 
 
 class Usernews extends PIXOLO_Controller { 
 
 	 function __construct(){ 
 	 	 parent::__construct(); 
 
 	 	 $this->load->model('Usernew_model', 'model'); 
 	 } 

 	 public function index() 
 	 { 
 	 	 $message['json']=$this->model->get_all(); 
 	 	 $this->load->view('json', $message); 
 	 } 
 }