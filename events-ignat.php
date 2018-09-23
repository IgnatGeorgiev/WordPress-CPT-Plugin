<?php
/*
Plugin Name: Event
Plugin URI: localhost
Description: A plugin that creates a CPT
Version: 1.0
Author: Ignat Georgiev
Author URI: none
License: GPLv3
*/
?>
<?php
function create_posttype() {
	
	register_post_type('events', 
	array(
	'labels' => array( 
		'name' => 'Event',
		'singular_name' => 'Events',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Event',
		'edit'=>'Edit',
		'edit_item' => 'Edit Event',
		'view' => 'View',
		'view_item' => 'View Event',
		'search_items'=>'Search Event',
		'not_found' => 'No Event found',
		'not_found_in_trash' => 'No Event found in trash',
	),

	'public' => true,
	'supports' => array('title', 'editor', 'comments', 'custom-fields'),
	'has_archive' => true,
	)
	);
}
add_action( 'init', 'create_posttype' ); ?>