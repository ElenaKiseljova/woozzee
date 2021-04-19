<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
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

global $product;

?>
<div class="good-article__price">
	<?php if ( $product->get_sale_price( $context = 'view' ) ) : ?>
    <p class="good-article__price--sale">
      <ins>
        <span>
          <?php
            echo $product->get_sale_price( $context = 'view' );
          ?>
        </span>
        <span>
          <?php
            echo get_woocommerce_currency_symbol();
          ?>
        </span>
      </ins>
      <del>
        <span>
          <?php
            echo $product->get_regular_price( $context = 'view' );
          ?>
        </span>
        <span>
          <?php
            echo get_woocommerce_currency_symbol();
          ?>
        </span>
      </del>
    </p>
  <?php elseif ( !$product->get_sale_price( $context = 'view' ) && $product->get_price( $context = 'view' ) ) : ?>
    <p class="good-article__price--regular">
      <span>
        <?php
          echo $product->get_price( $context = 'view' );
        ?>
      </span>
      <span>
        <?php
          echo get_woocommerce_currency_symbol();
        ?>
      </span>
    </p>
  <?php endif; ?>
</div>
  
