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

$latest = array();

$catalog_page_id = get_option( 'woocommerce_shop_page_id' );

if (!$catalog_page_id) {
	$catalog_page_id = 24;
}

$category_name = get_field( 'latest_cat_id', $catalog_page_id );

$category = get_term_by('slug', $category_name, 'product_cat', 'ARRAY_A');

if (!empty($category)) {
	$category_id = $category['term_id'];
	
	$args = array (
		'posts_per_page' => -1, 
		'post_type' => 'product',
		'post_status' => array( 'publish' ),
		'tax_query' => array(
			array (
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => array( $category_id ),
			),
		),
	);
	
	$query = new WP_Query($args); 
	 if( $query->have_posts() ) {  
		 while( $query->have_posts() ) {
			 $query->the_post(); 
			 
			 array_push($latest, get_the_ID());
		 }        
	 }
	
	 wp_reset_postdata(); // сброс
}

$product_id = $product->get_id();

?>
<?php 
	if ( $product->is_on_sale() && !in_array($product_id, $latest) ) { 
		if( $product->is_type( 'simple' ) ) {

			// a simple product
			
			// рассчитываем процент скидки
			$percentage = round(( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100);

		} elseif( $product->is_type( 'variable' ) ) {

			// a variable product
			
			$available_variations = $product->get_available_variations();

			if($available_variations){

				#Step 2: Get product variation id
				$variation_id=$available_variations[0]['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.

				#Step 3: Create the variable product object
				$variable_product1= new WC_Product_Variation( $variation_id );

				#Step 4: You have the data. Have fun :)
				$regular_price = $variable_product1->regular_price;
				$sale_price = $variable_product1->sale_price;
				
				$percentage = round(( ( $regular_price - $sale_price ) / $regular_price ) * 100);
			} else {
				$percentage = 0;
			}

		}
		
		if (isset($percentage)) {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="good-article__new good-article__new--sale" style="background-color: #FF4557;">-' . $percentage . '%</span>', $post, $product );
		}

	} elseif (in_array($product_id, $latest) && ($product->is_on_sale() || !$product->is_on_sale())) {
		echo '<span class="good-article__new good-article__new--latest">' . esc_html__( 'New', 'woozzee' ) . '</span>';
	}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
