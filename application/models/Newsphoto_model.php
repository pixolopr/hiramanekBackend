<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 class Newsphoto_model extends PIXOLO_Model 
 {
 	public $_table = 'newsphotos';
 
 		 //Write functions here 
 	public function getallimagesofnews($id)
	{
		$query=$this->db->query("SELECT `newsphotos`.`id` AS `photoid`,`newsphotos`.`photo` AS `photo` FROM `newsphotos` 
			INNER JOIN `news`
			ON `newsphotos`.`newsid`=`news`.`id`
			WHERE `news`.`id`='$id' ")->result();

		return $query;
	}



 } 
 
 ?>