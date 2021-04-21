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
<ul class="sorting-section__sort-by">
	<?php
		switch ($_GET['orderby']) :
				case 'price_desc' :
					echo '<li class="sorting-section__item sorting-section__item--current"><a href="?orderby=price_asc">Цене</a></li>';
					break;
				case 'price_asc' :
					echo '<li class="sorting-section__item sorting-section__item--reverse sorting-section__item--current"><a href="?orderby=price_desc">Цене</a></li>';
					break;
				default:
					echo '<li class="sorting-section__item"><a href="?orderby=price_desc">Цене</a></li>';
		endswitch;	
		
		switch ($_GET['orderby']) :
				case 'popularity_desc' :
					echo '<li class="sorting-section__item sorting-section__item--current"><a href="?orderby=popularity_asc">По популярности</a></li>';
					break;
				case 'popularity_asc' :
					echo '<li class="sorting-section__item sorting-section__item--reverse sorting-section__item--current"><a href="?orderby=popularity_desc">По популярности</a></li>';
					break;
				default:
					echo '<li class="sorting-section__item"><a href="?orderby=popularity_desc">По популярности</a></li>';
		endswitch;	
		
		switch ($_GET['orderby']) :
				case 'discount_desc' :
					echo '<li class="sorting-section__item sorting-section__item--current"><a href="?orderby=discount_asc">Размеру скидки</a></li>';
					break;
				case 'discount_asc' :
					echo '<li class="sorting-section__item sorting-section__item--reverse sorting-section__item--current"><a href="?orderby=discount_desc">Размеру скидки</a></li>';
					break;
				default:
					echo '<li class="sorting-section__item"><a href="?orderby=discount_desc">Размеру скидки</a></li>';
		endswitch;		
	?>   			
</ul>
