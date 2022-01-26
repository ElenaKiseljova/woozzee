<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

	<div class="tabs-section__wrapper">
		<ul class="tabs-section__tabs-list tabs-section__tabs-list--no-margin" role="tablist">
			<?php $tab_i = 0; ?>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<?php if (($tab_i == 0) && (count($product_tabs) > 1)): ?>
					<li class="tabs-section__item tabs-section__item--current" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
				<?php elseif (($tab_i == 0) && (count($product_tabs) == 1)): ?>
					<li class="tabs-section__item tabs-section__item--active" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
				<?php else : ?>
					<li class="tabs-section__item" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
				<?php endif; ?>
					<a>
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
				<?php $tab_i++; ?>
			<?php endforeach; ?>
		</ul>
		<?php $tab_i = 0; ?>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<?php if ($tab_i == 0): ?>
				<div class="tabs-section__goods-list tabs-section__goods-list--block" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
			<?php else : ?>
				<div class="tabs-section__goods-list tabs-section__goods-list--hidden tabs-section__goods-list--block" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
			<?php endif; ?>
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
			<?php $tab_i++; ?>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
