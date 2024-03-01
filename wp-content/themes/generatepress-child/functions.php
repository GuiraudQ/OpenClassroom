<?php 

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/styles.css');
	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}

function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __('Primary Menu'),
			'footer-menu' => __('Footer Menu')
		)
	);
}
add_action('init', 'register_my_menus');


add_filter( 'wp_nav_menu_items', 'add_extra_item_to_nav_menu', 10, 2 );

function add_extra_item_to_nav_menu( $items, $args ) {
	if (is_user_logged_in() && $args->menu == 'header-menu') {
		// $items.unshift('<li><a href="http://localhost:8888/oc-Planty/wp-admin/">Admin</a></li>');
		$new_items = '<li><a href="' . get_admin_url() . '">Admin</a></li>' . $items;
        // $items .= '<li><a href="http://localhost:8888/oc-Planty/wp-admin/">Admin</a></li>';
        // $items .= '<li><a href=" . admin_url() . ">Admin</a></li>';
		return $new_items;
    }
    return $items;
}



add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );

function mycustom_wpcf7_form_elements( $form ) {
$form = do_shortcode( $form );

return $form;
}