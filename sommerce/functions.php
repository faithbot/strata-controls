<?php
/**
 * @package WordPress
 * @subpackage YIW Themes
 * 
 * Here the first hentry of theme, when all theme will be loaded.
 * On new update of theme, you can not replace this file.
 * You will write here all your custom functions, they remain after upgrade.
 */                                                                               

// include all framework
require_once dirname(__FILE__) . '/core/core.php';

/*-----------------------------------------------------------------------------------*/
/* End Theme Load Functions - You can add custom functions below */
/*-----------------------------------------------------------------------------------*/         
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
function jk_change_breadcrumb_home_text( $defaults ) {
// Change the breadcrumb home text from 'Home' to 'Products'
$defaults['home'] = 'Products';
return $defaults;
}

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
return 'http://184.154.229.16/~strataco/product-category/';
}

add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {
 
$tabs['description']['priority'] = 1; // Description second
$tabs['reviews']['priority'] = 10; // Reviews first
$tabs['additional_information']['priority'] = 15; // Additional information third
 
return $tabs;
}	

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
woocommerce_related_products(8,4); // Display 4 products in rows of 2
}
// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_action( 'woocommerce_after_shop_loop', 'wpse_71885_shop_loop_list_init' );

function wpse_71885_shop_loop_list_init() {
    ?>

<script type="text/javascript">
    jQuery( "ul.products" ).addClass( jQuery.cookie( "gridcookie" ) || "list" );
</script>

<?php
}