<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="orderby-block">
	<?php
		switch ($_GET['orderby']) :
				case 'price_desc' :
					echo '<a href="?orderby=price_asc" class="sorting-section__item sorting-section__item--current">Цене</a>';
					break;
				case 'price_asc' :
					echo '<a href="?orderby=price_desc" class="sorting-section__item sorting-section__item--reverse sorting-section__item--current">Цене</a>';
					break;
				default:
					echo '<a href="?orderby=price_desc" class="sorting-section__item">Цене</a>';
		endswitch;	
		
		switch ($_GET['orderby']) :
				case 'popularity_desc' :
					echo '<a href="?orderby=popularity_asc" class="sorting-section__item sorting-section__item--current">По популярности</a>';
					break;
				case 'popularity_asc' :
					echo '<a href="?orderby=popularity_desc" class="sorting-section__item sorting-section__item--reverse sorting-section__item--current">По популярности</a>';
					break;
				default:
					echo '<a href="?orderby=popularity_desc" class="sorting-section__item">По популярности</a>';
		endswitch;	
		
		switch ($_GET['orderby']) :
				case 'discount_desc' :
					echo '	<a href="?orderby=discount_asc" class="sorting-section__item sorting-section__item--current">Размеру скидки</a>';
					break;
				case 'discount_asc' :
					echo '<a href="?orderby=discount_desc" class="sorting-section__item sorting-section__item--reverse sorting-section__item--current">Размеру скидки</a>';
					break;
				default:
					echo '<a href="?orderby=discount_desc" class="sorting-section__item">Размеру скидки</a>';
		endswitch;		
	?>   			
</div>
