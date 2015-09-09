<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 class Categorie_model extends PIXOLO_Model 
 { 
 	public $_table = 'categories';
 
 	 //Write functions here 
 	public function getcategoriesnames()
 	{
 		
 		$query= $this->db->query('SELECT `Categories`.`id` AS `categories_id`, `categories`.`name` AS `categories_name`
 			FROM `categories`
 			WHERE `categories`.`show`=1')->result();
 		return $query;
 	}
 	




 } 

 
 ?>