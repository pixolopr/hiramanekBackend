<?php 
 defined('BASEPATH') OR exit('No direct script access allowed'); 
 
 class New_model extends PIXOLO_Model 
 { 

 	public $_table = 'news';
 
 	 //Write functions here
 	 public function getnewsofonecategory($category)
 	{   
 		
 		$sql = "SELECT `news`.`id` AS `news_id`, `news`.`shortheadline` AS `shortheadline`, `news`.`photo` AS `photo`,`news`.`language` AS language
 			FROM `news`" ;

 			if($category == "topnews")
 			{
 				$sql .= " WHERE `news`.`top` = 1";
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
 		$value="SELECT `news`.`id` AS `id`,`news`.`headline` AS `headLine`, `news`.`article` AS `artical`, `news`.`timestamp` AS `timeStamp`, `author`.`name` AS `authorname`,`news`.`photo` AS `photo`,`news`.`language` AS `language`
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
		$firstobj->news = $this->db->query("SELECT `news`.`id` AS `newsid`, `news`.`photo` as `photo`, `news`.`shortheadline` AS `shortheadline`,`news`.`language` AS `language`  FROM `news`
		WHERE `top`=1
		ORDER BY `news`.`timestamp` desc limit 15")->result();		

		$query=$this->db->query("SELECT distinct `categories`.`id` AS `id`,`categories`.`name` AS `category`
			FROM `categories`
			INNER JOIN `news`
			ON `news`.`category`=`categories`.`id`")->result();

		foreach ($query as $q)
			{
				$q->news = $this->db->query("SELECT `news`.`id` AS `newsid` , `news`.`photo` AS `photo`, `news`.`shortheadline` AS `shortheadline`, `news`.`language` AS `language` FROM `news`
				WHERE `news`.`category` = '$q->id' order by `news`.`timestamp` desc limit 5 ")->result();
			};

			array_unshift($query, $firstobj);

	return $query;
	} 

	public function getnexttennews($count,$category)
	{
		$nxtcount=$count+10;


		$sql = "SELECT `news`.`id` AS `news_id`, `news`.`shortheadline` AS `shortheadline`, `news`.`photo` AS `photo`,`news`.`language` AS `language`
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
	public function getsearchnews($example, $count)
	{
		$count2 = $count + 20;

		$sql1="SELECT distinct `news`.`id` AS `id`,`news`.`shortheadline` AS `shortheadline`,`news`.`photo` AS `photo` FROM `news`
				WHERE `news`.`headline` LIKE '%$example%' order by `news`.`timestamp` limit $count, $count2";

		$numrows=$this->db->query($sql1)->num_rows();
		$exe = false;
		if($numrows < 20)
		{
			$exe = true;
		}	

		//$count=20-$count;

		if($numrows == 0)
			{
				$numrows=$this->db->query("SELECT distinct `news`.`id` AS `id`,`news`.`shortheadline` AS `shortheadline`,`news`.`photo` AS `photo` FROM `news`
				WHERE `news`.`headline` LIKE '%$example%'")->num_rows();
				$numrows2=$this->db->query("SELECT distinct `news`.`id` AS `id`,`news`.`shortheadline` AS `shortheadline`,`news`.`photo` AS `photo` FROM `news`
				WHERE `news`.`article` LIKE '%$example%'")->num_rows();
				if(($numrows+$numrows2) <= $count)
					{
						$exe = false;
					}else{
				
						$numrows = $numrows%20;
						$count = 20 - $numrows;
						$count2 = $count + 20;
					}
			}else{
				$count = 0;
				$count2 = 20-$numrows;
			};


		$sql2="SELECT  distinct `news`.`id` AS `id`,`news`.`shortheadline` AS `shortheadline`,`news`.`photo` AS `photo` FROM `news`
				WHERE `news`.`article` LIKE '%$example%' order by `news`.`timestamp` limit $count, $count2";
		
		$query1=$this->db->query($sql1)->result();

		if($exe)
		{
			$query2=$this->db->query($sql2)->result();
			foreach ($query2 as $row) {
				array_push($query1,$row);
			};
			
		}
		return $query1;

	}


 } 
 
 ?> 