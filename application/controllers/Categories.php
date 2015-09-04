<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 header('Access-Control-Allow-Origin: *'); 
 
 class Categories extends PIXOLO_Controller { 
 
 	 function __construct(){ 
 	 	 parent::__construct(); 
 
 	 	 $this->load->model('Categorie_model', 'model'); 
 	 } 

 	 public function index() 
 	 { 
 	 	 $message['json']=$this->model->get_all(); 
 	 	 $this->load->view('json', $message); 
 	 }
 	  public function givecategoriesnames()
 	 {

 	 	
		$message['json']=$this->model->givecategoriesnames();
 	 	$this->load->view('json',$message);
 	 }  
 	 public function 15newsofcategoriesbyid()
 	 {
 	 	$id=$this->input->get('id');
 	 	$message['json']=$this->mode1->15newsofcategoriesbyid($id);
 	 	$this->load->view('json',$message);

 	 }
 }