<?php
require_once "functions.php";
class myFeed{

	function get_follow_id(){
		
		if(($_SESSION['family']) != null ) {
			$wall_feed = new Wall;
			$owner_id = $_SESSION['family'];
		} else {
			$owner_id = $_SESSION['user_id'];
		}
		$result = mysql_query("SELECT * FROM followers WHERE owner_id='$owner_id'") or die(mysql_error());
		if(mysql_num_rows($result) != 0 ){ 

			while ($arr = mysql_fetch_assoc($result)) {
				$arra[] = $arr['my_following'];
				$arra[] = $arr['owner_id'];
				//$wall_feed->get_posts_bytime($arra);
				
			}

			$this->get_feed_post($arra);
		}
	}

	function get_count_feedpost(){
		if(($_SESSION['family']) != null ) {
			$wall_feed = new Wall;
			$owner_id = $_SESSION['family'];
		} else {
			$owner_id = $_SESSION['user_id'];
		}
		$result = mysql_query("SELECT * FROM followers WHERE owner_id='$owner_id'") or die(mysql_error());
		if(mysql_num_rows($result) != 0 ){ 

			while ($arr = mysql_fetch_assoc($result)) {
				$arrau[] = $arr['my_following'];
				$arrau[] = $arr['owner_id'];
				//$wall_feed->get_posts_bytime($arra);
				
			}
			$arra = array_unique($arrau);
			for ($i=0; $i < count($arra); $i++) { 
				$uid[$i] = $arra[$i];
				$sql_res = mysql_query("SELECT post_id FROM wall WHERE user_owner='$uid[$i]'");
				if(mysql_num_rows($sql_res) != 0 ){

					for ($t=0; $t < mysql_num_rows($sql_res); $t++) { 

						$arrt[] = mysql_fetch_assoc($sql_res);
					}
				}
			}
		}
		return count($arrt);
	}

	function get_feed_post($arra){
		
		$wall_feed = new Wall;
		//print_r($arra);
		$arra = array_unique($arra);
		$arra = array_merge($arra);

		for ($i=0; $i < count($arra); $i++) { 
			
			//echo $arra[$i];
			$sql_res = mysql_query("SELECT post_id FROM wall WHERE user_owner='$arra[$i]'");
			if(mysql_num_rows($sql_res) != 0 ){
				
				for ($t=0; $t < mysql_num_rows($sql_res); $t++) { 
					
					$arr[] = mysql_fetch_assoc($sql_res);
				}
			}
		}
		rsort($arr);
		for ($g=0; $g < count($arr); $g++) { 
			$pd[$g] = $arr[$g]['post_id'];
			$sql_ress = mysql_query("SELECT * FROM wall WHERE post_id='$pd[$g]' ORDER BY publish_date DESC LIMIT 0, 20");
			if(mysql_num_rows($sql_ress) != 0 ){
				for ($r=0; $r < mysql_num_rows($sql_ress); $r++) { 
					$arrar = mysql_fetch_assoc($sql_ress);
					$wall_feed->post($arrar['post_id'], $arrar['message'], $arrar['attachment'],$arrar['user_from'], $arrar['user_owner'], $arrar['publish_date']);
				}

			}
		}

	}
}
?>