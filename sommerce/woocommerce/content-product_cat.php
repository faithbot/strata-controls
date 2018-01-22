<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
    $woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

$class_li = array( 'product' );
if (   yiw_get_option( 'shop_border_thumbnail' ) )        { $class_li[] = 'border'; }
if (   yiw_get_option( 'shop_shadow_thumbnail' ) )        { $class_li[] = 'shadow'; }
if ( ! yiw_get_option( 'shop_show_price' ) )              { $class_li[] = 'hide-price'; }
if ( ! yiw_get_option( 'shop_show_button_details' ) )     { $class_li[] = 'hide-details-button'; }
if ( ! yiw_get_option( 'shop_show_button_add_to_cart' ) ) { $class_li[] = 'hide-add-to-cart-button'; }

$title_position = yiw_get_option( 'shop_title_position' );

// Increase loop count
$woocommerce_loop['loop'] ++;

$loop_class_li = $class_li;

$loop_class_li[] = 'product';

if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) {
    $loop_class_li[] = 'last';
}

if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 ) {
    $loop_class_li[] = 'first';
}

if ( ! empty( $loop_class_li ) ) {
    $class = ' class="' . implode( ' ', $loop_class_li ) . '"';
} else {
    $class = '';
}
?>
<li<?php echo $class ?>>

    <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

        <div class="thumbnail">
            <?php
            /**
             * woocommerce_before_subcategory_title hook
             *
             * @hooked woocommerce_subcategory_thumbnail - 10
             */
            do_action( 'woocommerce_before_subcategory_title', $category );
            ?>

            <div class="thumb-shadow"></div>

            <strong class="<?php echo $title_position ?>"><?php echo $category->name; ?></strong>
        </div>

        <?php
        /**
         * woocommerce_after_subcategory_title hook
         */
        do_action( 'woocommerce_after_subcategory_title', $category );
        ?>

    </a>

    <?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>