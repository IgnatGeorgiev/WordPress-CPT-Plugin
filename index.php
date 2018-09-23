function create_posttype() {
	
	register_post_type('events', 
	array(
	'labels' => array( 
		'name' => __('Events'),
		'singular_name' => __('Event')
	),
	'public' => true,
	'has_archive' => true,
	'rewrite' => array('slug'=>'events'),
	)
	);
}
add_action('init','create_posttype');