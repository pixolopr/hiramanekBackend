<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 class New_model extends PIXOLO_Model 
 { 

 	public $_table = 'news';
 
 	 //Write functions here
 	 public function getnewsofonecategory($category)
 	{   
 		
 		$sql = "SELECT `news`.`id` AS `news_id`, `news`.`shortheadline` AS `shortheadline`, `news`.`photo` AS `photo`
 			FROM `news`" ;

 			if($category == "topnews")
 			{
 				$sql .= " WHERE `top` = 1";
 			}else{
 				$sql .= " where `news`.`category`= '$category' ";
 			};


 			$sql .= " order by `news`.`timestamp` 
 			limit 15";

		$query = $this->db->query($sql)->result();
 		return $query;


   	}
 	public function getfullarticalbynewsid($id)
 	{
 		$value="SELECT `news`.`headline` AS `headLine`, `news`.`article` AS `artical`, `news`.`timestamp` AS `timeStamp`, `author`.`name` AS `authorname`,`news`.`photo` AS `photo`
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
	public function getlatestnewsfromallcategories()
	{


		//$query = new array();

		$firstobj = new stdClass();
		$firstobj->category = "Top News";
		$firstobj->news = $this->db->query("SELECT `news`.`id` AS `newsid`, `news`.`photo` as `photo`, `news`.`shortheadline` AS `shortheadline`
		FROM `news`
		WHERE `top`=1
		ORDER BY `news`.`timestamp` desc limit 15")->result();		

		$query=$this->db->query("SELECT distinct `categories`.`id` AS `id`,`categories`.`name` AS `category`
			FROM `categories`
			INNER JOIN `news`
			ON `news`.`category`=`categories`.`id`")->result();

		foreach ($query as $q)
			{
				$q->news = $this->db->query("SELECT `news`.`id` AS `newsid` , `news`.`photo` AS `photo`, `news`.`shortheadline` AS `shortheadline` FROM `news`
				WHERE `news`.`category` = '$q->id' order by `news`.`timestamp` desc limit 5 ")->result();
			};

			array_unshift($query, $firstobj);

	return $query;
	} 

	public function getnexttennews($count,$category)
	{
		$nxtcount=$count+10;


		$sql = "SELECT `news`.`id` AS `news_id`, `news`.`shortheadline` AS `shortheadline`, `news`.`photo` AS `photo`
 			FROM `news`" ;

 			if($category == "topnews")
 			{
 				$sql .= " WHERE `top` = 1";
 			}else{
 				$sql .= " where `news`.`category`= '$category' ";
 			};


 			$sql .= " order by `news`.`timestamp` 
 			limit $count ,$nxtcount";

		$query = $this->db->query($sql)->result();
 		
 		return $query;
	}


 } 
 
 ?> 