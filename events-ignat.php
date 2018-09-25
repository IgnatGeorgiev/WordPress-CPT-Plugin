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

function event_date(){
  global $post;
  $custom = get_post_custom($post->ID);
  $event_date = $custom["event_date"][0];
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style('jquery-ui.min',plugins_url('events-ignat/assets/jquery-ui-1.12.1/jquery-ui.min.css'));

  ?>
    <script>
  jQuery( function() {
    jQuery("#date").datepicker();
  } );
  </script>
  <label>Date:</label>
  <input name="event_date" id="date" value="<?php echo $event_date; ?>" />
  <?php
}

function event_location(){
  global $post;
  $custom = get_post_custom($post->ID);
  $event_location = $custom["event_location"][0];
  ?>
  <label>Address:</label>
  <input name="event_location" id="event_location" value="<?php echo $event_location; ?>" />
  <?php
}


function event_url(){
  global $post;
  $custom = get_post_custom($post->ID);
  $event_url = $custom["event_url"][0];

  ?>
  <label>URL:</label>
  <input name="event_url" id="event_url" value="<?php echo $event_url; ?>" />
  <?php
}

function admin_init(){
  add_meta_box("event-date-meta", "Event Date", "event_date", "events", "normal", "high");
  add_meta_box("event-location-meta", "Event Location", "event_location", "events", "normal", "high");
  add_meta_box("event-url-meta", "Event URL", "event_url", "events", "normal", "high");
}
function save() {
	global $post;

	update_post_meta($post->ID, "event_date", $_POST["event_date"]);
	update_post_meta($post->ID, "event_location", $_POST["event_location"]);
	update_post_meta($post->ID, "event_url", $_POST["event_url"]);
}
add_action( 'init', 'create_posttype' ); 
add_action( 'admin_init', 'admin_init' );
add_action('save_post', 'save'); 
add_filter('archive_template', 'yourplugin_get_custom_archive_template');
add_filter('single_template', 'get_custom_single_template');

function yourplugin_get_custom_archive_template($template) {
    global $wp_query;
    if (is_post_type_archive('events')) {
        $templates[] = 'archive-events.php';
        $template = events_locate_template($templates);
    }
    return $template;
}
function get_custom_single_template($template) {
    global $wp_query;
    if (is_post_type_archive('events')) {
        $templates[] = 'single-events.php';
        $template = events_locate_template($templates);
    }
    return $template;
}
function events_locate_template($template_names, $load = false, $require_once = true ) {
    if (!is_array($template_names)) {
        return '';
    }
    $located = '';  
    $this_plugin_dir = WP_PLUGIN_DIR . '/' . str_replace( basename(__FILE__), "", plugin_basename(__FILE__));
    foreach ( $template_names as $template_name ) {
        if ( !$template_name )
            continue;
        if ( file_exists(STYLESHEETPATH . '/' . $template_name)) {
            $located = STYLESHEETPATH . '/' . $template_name;
            break;
        } elseif ( file_exists(TEMPLATEPATH . '/' . $template_name) ) {
            $located = TEMPLATEPATH . '/' . $template_name;
            break;
        } elseif ( file_exists( $this_plugin_dir . '/templates/' . $template_name) ) {
            $located =  $this_plugin_dir . '/templates/' . $template_name;
            break;
        }
    }
    if ( $load && $located != '' ) {
        load_template( $located, $require_once );
    }
    return $located;
}
?>
