<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 class New_model extends PIXOLO_Model 
 { 

 	public $_table = 'news';
 
 	 //Write functions here
 	 public function newsofcategoriesbyid($id)
 	{   
 		$value = "SELECT `news`.`id` AS `News_id`, `news`.`shortheadline` AS `ShortHeadline`, `news`.`photo` AS `Photo`
 			FROM `news`
 			where `news`.`category`= '$id' 
 			order by `news`.`timestamp` 
 			limit 15";
 		$query=$this->db->query($value)->result();
 		print_r($query);
 		return $query;
 		
 	}
 	public function fullarticalbynewsid($id)
 	{
 		$value="SELECT `news`.`headline` AS `HeadLine`, `news`.`article` AS `Artical`, `news`.`timestamp` AS `TimeStamp`, `author`.`name` AS `AuthorName`
 		FROM `news`
 		INNER JOIN `author`
       ON `author`.`id`=`news`.`author`
       WHERE `news`.`id`= '$id' ";
       $query=$this->db->query($value)->row();

	$count = $this->db->query("SELECT COUNT(*) AS `count` FROM `newsphotos` WHERE `newsid` = '$id'")->row();

$query->count_image = $count->count;

	$comments = $this->db->query("SELECT `comments`.`comment`, `comments`.`date`, `users`.`name` FROM `comments` INNER JOIN `users` ON `users`.`id` = `comments`.`userid` WHERE `newsid` = '$id' ORDER BY `comments`.`date` DESC")->result();
	$query->comments = $comments;

	return $query;

		}
 } 
 
 ?> 