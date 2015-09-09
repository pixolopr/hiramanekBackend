<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 header('Access-Control-Allow-Origin: *'); 
 
 class Users extends PIXOLO_Controller { 
 
 	 function __construct(){ 
 	 	 parent::__construct(); 
 
 	 	 $this->load->model('User_model', 'model'); 
 	 } 

 	 public function index() 
 	 { 
 	 	 $message['json']=$this->model->get_all(); 
 	 	 $this->load->view('json', $message); 
 	 } 
 	 public function login()
 	 {
 	 	
 	 	$user=$this->input->get('user');
 	 	$user=json_decode($user);
 	 	$email=$user->email;
 	 	$password=$user->password;
 	 	$message['json']= $this->model->login($email,$password);
 	 	$this->load->view('json',$message);
 	
 	 }
 	 public function signup()
 	 {
 	 	$user=$this->input->get('user');
 	 	$user=json_decode($user);
 	 	$name=$user->name;
 	 	$lastname=$user->lastname;
 	 	$contact=$user->contact;
 	 	$email=$user->email;
 	 	$password=$user->password;
 	 	
 	 	$message['json']= $this->model->signup($name,$lastname,$contact,$email,$password);
 	 	$this->load->view('json',$message);
 	}


 }