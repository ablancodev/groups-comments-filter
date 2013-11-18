<?php
/*
Plugin Name: Groups comments filter
Plugin URI: http://www.eggemplo.com
Description: Left comments in pages where the user has group access
Author: eggemplo
Version: 1.0
Author URI: http://www.eggemplo.com/
*/


function init_groups_filter_comments () {
	add_filter('the_comments', 'groups_filter_comments');	
}

function groups_filter_comments ( $data ) {
	
	$user_id = get_current_user_id();
	$res = array();
	foreach ($data as $comment) {
		if ( ( is_admin() ) || ( Groups_Post_Access::user_can_read_post( $comment->comment_post_ID, $user_id ) ) ) {
			$res[] = $comment;
		} 
	}
	return $res;
}

add_action( 'init', 'init_groups_filter_comments' );

?>
