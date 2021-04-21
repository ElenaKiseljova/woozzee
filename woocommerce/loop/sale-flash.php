<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

// Массив ИД товаров Новинок
$latest = array();

$catalog_page_id = get_option( 'woocommerce_shop_page_id' );

if (!$catalog_page_id) {
	$catalog_page_id = 24;
}

$category_id = get_field( 'latest_cat_id', $catalog_page_id );

$category = get_term_by('id', $category_id, 'product_cat', 'ARRAY_A');

if (!empty($category) && is_array($category)) {
	$category_slug = $category['slug'];
	
	$args = array(
	  'category' => array( $category_slug ),
		'status' => 'publish',
		'return' => 'ids',
	);
	
	$products = wc_get_products( $args );
	
	foreach ($products as $prod) {
		array_push($latest, $prod);
	}
	
	//var_dump($latest);
}

$product_id = $product->get_id();

?>
<?php 
	if ( $product->is_on_sale() ) { 
		$sale_percentage = get_post_meta( $product_id, '_sale_field', true );
		
		if ($sale_percentage) {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="good-article__new good-article__new--sale" style="background-color: #FF4557;">-' . $sale_percentage . '%</span>', $post, $product );
		}
		//var_dump($sale_percentage);
	} elseif ( in_array($product_id, $latest) && !$product->is_on_sale() ) {
		echo '<span class="good-article__new good-article__new--latest">' . esc_html__( 'New', 'woozzee' ) . '</span>';
	}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
