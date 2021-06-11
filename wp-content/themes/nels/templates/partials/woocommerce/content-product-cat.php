<?php

use Pikart\Nels\DependencyInjection\Service;
use Pikart\Nels\ThemeOptions\ThemeOption;

$shopDisplay = Service::themeOptionsUtil()->getOption( ThemeOption::SHOP_DISPLAY );

?>

<li <?php wc_product_cat_class( '', $category ); ?>>
	<div class="card-body container-fluid">
		<?php
		/**
		 * The woocommerce_before_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_open - 10
		 */
		do_action( 'woocommerce_before_subcategory', $category ); ?>
		<?php if($category->slug != 'calcinhas'): ?>
		<div class="card-header header-standard col-md-7 col-sm-12">
			<a class="card-thumbnail" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) )?>">
				<?php if ( Service::templatesUtil()->isTransparencyAllowed( $shopDisplay ) ): ?>
					<div class="color-overlay">
						<div class="color-overlay-inner"></div>
					</div>
				<?php endif;
				do_action( 'woocommerce_before_subcategory_title', $category ); ?>
			</a>
		</div>

		<div class="card-content col-md-4 col-sm-12 text-center">
			<div class='col-12'>
				<a class="card-branding" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) )?>">
				<span class="border-top-cat col-1"></span>
					<h4 class="branding__title">
						<?php do_action( 'woocommerce_shop_loop_subcategory_title', $category ); ?>
					</h4>
				<span class="border-top-cat col-1"></span>
					<!--<div class="branding__meta">
						<div class="branding__meta__item woocommerce-loop-category__items">
							<?php printf( esc_html( _n( '%s product', '%s products',
								(int) $category->count, 'nels' ) ), (int) $category->count ) ?>
						</div>
					</div>-->
				</a>
			</div>
			<div class="buyButtom col-12">
				<a class="button" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) )?>">
					Comprar Agora
				</a>
			</div>
		</div>
		<?php else : ?>
			<div class="card-content col-md-4 col-sm-12 text-center">
				<div class='col-12'>
					<a class="card-branding" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) )?>">
					<span class="border-top-cat col-1"></span>
						<h4 class="branding__title">
							
							<?php
							/**
							 * The woocommerce_shop_loop_subcategory_title hook.
							 *
							 * @hooked woocommerce_template_loop_category_title - 10
							 */
							do_action( 'woocommerce_shop_loop_subcategory_title', $category ); ?>
						
						</h4>
						<span class="border-top-cat col-1"></span>
						<!--<div class="branding__meta">
							<div class="branding__meta__item woocommerce-loop-category__items">
								<?php printf( esc_html( _n( '%s product', '%s products',
									(int) $category->count, 'nels' ) ), (int) $category->count ) ?>
							</div>
						</div>-->
					</a>
				</div>
				<div class="buyButtom col-12">
					<a class="button" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) )?>">
						Comprar Agora
					</a>
				</div>
			</div>
		<div class="card-header header-standard col-md-7 col-sm-12">
			<a class="card-thumbnail" href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) )?>">
				<?php if ( Service::templatesUtil()->isTransparencyAllowed( $shopDisplay ) ): ?>
					<div class="color-overlay">
						<div class="color-overlay-inner"></div>
					</div>
				<?php endif;
				do_action( 'woocommerce_before_subcategory_title', $category ); ?>
			</a>
		</div>

		<?php endif; ?>
		<?php
		/**
		 * The woocommerce_after_subcategory_title hook.
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );

		/**
		 * The woocommerce_after_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_close - 10
		 */
		do_action( 'woocommerce_after_subcategory', $category ); ?>
	</div>
</li>