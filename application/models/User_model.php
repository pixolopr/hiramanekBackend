<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 class User_model extends PIXOLO_Model 
 { 
 	public $_table = 'users';
 
 
 	 //Write functions here 
 	public function login($email,$password)
 	{
 		$query=$this->db->query("SELECT * FROM users WHERE `email`='$email' and `password`='$password'");
 		if($query->num_rows()==1)
 		{
 			
 			return $query->result();
 		}
 		else
 		{
 			return false;
 		}
 	}
 	public function signup($name,$lastname,$contact,$email,$password)
 	{
 		$check=$this->db->query("SELECT * FROM `users` where `email`='$email'")->num_rows();

 		if($check>0)
 		{
 			return false;

 		}
 		else
 		{
 			$data="INSERT INTO `users`(`name`,`lastname`,`contact`,`email`,`password`) values('$name','$lastname','$contact','$email','$password')";
 			$query=$this->db->query($data);
 			
 			$id = $this->db->insert_id();

 			$query= $this->db->query("SELECT * FROM `users` WHERE `id` = '$id'")->row();
 			
 			//print_r($query);
 			return $query;

 		}
 	}



 	public function checkemail($email)
 	{
 		$check=$this->db->query("SELECT *FROM `users` WHERE `users`.`email`='$email'")->num_rows();
 		if($check>0)
 		{
 			return true;

 		}
 		else
 		{
 			return false;
 		}
 	}

 	public function changepassword($password,$id)
 	{
 		$change=$this->db->query("UPDATE `users`	SET `users`.`password`='$password' WHERE `users`.`id`='$id'");
 		return true;
 		

 	}

 } 
 
 ?>