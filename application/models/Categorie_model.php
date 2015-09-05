<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 class Categorie_model extends PIXOLO_Model 
 { 
 	public $_table = 'categories';
 
 	 //Write functions here 
 	public function givecategoriesnames()
 	{
 		
 		$query= $this->db->query('SELECT `Categories`.`id` AS `Categories_id`, `categories`.`name` AS `Categories_Name`
 			FROM `categories`
 			WHERE `categories`.`show`=1')->result();
 		return $query;
 	}
 	




 } 

 
 ?>