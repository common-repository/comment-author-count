<?php
/*
Plugin Name: Comment Author count
Plugin URI: http://www.amit.me/
Description: Comment Author count adds total number of comments posted by the comment authors. 
Version: 1.0
Author: Amit Verma
Author URI: http://www.amit.me/
*/

function countComment($text) {
	global $comment;
	
	if (!empty($comment->comment_author_email) && $comment->comment_author_email!=get_the_author_email()) {
		//echo wpautop($comment_text);
		
		
		global $wpdb;
		$querystr = "
		SELECT count(*) 
		FROM $wpdb->comments wpc 
		WHERE 
		comment_author_email='" . $comment->comment_author_email . "'
		AND comment_approved='1'";
	 
	 $result = $wpdb->get_var($querystr);
	 if($result>0 && $result==1)
	 	$count="\n<small>Total Comment by <i>" . $comment->comment_author . "</i>: " . $result . "</small>";
	 elseif($result>1)
	 	$count="\n<small>Total Comments by <i>" . $comment->comment_author . "</i>: " . $result . "</small>";
	  $text.=$count;
	}
	return $text;
}
add_filter("comment_text","countComment");

//wp-include/formatting.php
?>