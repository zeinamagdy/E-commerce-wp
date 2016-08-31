<?php
/**
 * The header layout 7.
 *
 * @since   1.0.0
 * @package Gecko
 */
?>
<header id="jas-header" class="header-7 pf">
	<i class="close-menu hidden-md visible-1024 pe-7s-close pa"></i>
	<div class="flex column center-xs pt__60 pb__60">
		<?php jas_gecko_logo(); ?>
		<div class="jas-action flex middle-xs center-xs pr">
			<a class="sf-open cb chp" href="javascript:void(0);"><i class="pe-7s-search"></i></a>
			<?php
				if ( class_exists( 'WooCommerce' ) ) {
					echo jas_gecko_wc_my_account();
					if ( class_exists( 'YITH_WCWL' ) ) {
						global $yith_wcwl;
						echo '<a class="cb chp" href="' . esc_url( $yith_wcwl->get_wishlist_url() ) . '"><i class="pe-7s-like"></i></a>';
					}
					echo jas_gecko_wc_shopping_cart();
				}
			?>
		</div><!-- .jas-action -->
		<nav class="jas-navigation center-xs mt__30" role="navigation">
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary-menu',
						'container_id'    => 'jas-mobile-menu',
						'walker'          => new JAS_Gecko_Menu_Walker(),
						'fallback_cb'    => NULL
					)
				);
			?>
		</nav><!-- .jas-navigation -->
		<?php echo jas_gecko_social(); ?>
	</div>
</header><!-- #jas-header -->
<?php if ( class_exists( 'WooCommerce' ) ) : ?>	
	<div class="jas-mini-cart jas-push-menu">
		<div class="jas-mini-cart-content">
			<h3 class="mg__0 tc cw bgb tu ls__2"><?php esc_html_e( 'Mini Cart', 'gecko' );?> <i class="close-cart pe-7s-close pa"></i></h3>
			<div class="widget_shopping_cart_content"></div>
		</div>
	</div><!-- .jas-mini-cart -->
<?php endif ?>

<form class="header__search w__100 dn pf" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="pa">
		<input class="w__100 jas-ajax-search" type="text" name="s" placeholder="<?php echo esc_html__( 'Search for...', 'gecko' ); ?>" />
	</div>
	<a id="sf-close" class="pa" href="#"><i class="pe-7s-close"></i></a>
</form><!-- #header__search -->
<div class="pl__15 pr__15 hidden-md visible-1024 top-menu pf w__100">
	<div class="jas-row middle-xs">
		<div class="jas-col-sm-3 jas-col-xs-3">
			<a href="javascript:void(0);" class="jas-push-menu-btn"><img src="<?php echo JAS_GECKO_URL . '/assets/images/icons/hamburger-black.svg'; ?>" width="25" height="22" /></a>
		</div>
		<div class="jas-col-sm-6 jas-col-xs-6 start-md center-sm center-xs">
			<?php jas_gecko_logo(); ?>
		</div>
		<div class="jas-col-md-3 jas-col-sm-3 jas-col-xs-3">
			<div class="jas-action flex end-xs middle-xs">
				<a class="sf-open cb chp hidden-xs" href="javascript:void(0);"><i class="pe-7s-search"></i></a>
				<?php
					if ( class_exists( 'WooCommerce' ) ) {
						echo jas_gecko_wc_my_account();

						if ( class_exists( 'YITH_WCWL' ) ) {
							global $yith_wcwl;
							echo '<a class="cb chp hidden-xs" href="' . esc_url( $yith_wcwl->get_wishlist_url() ) . '"><i class="pe-7s-like"></i></a>';
						}
						echo jas_gecko_wc_shopping_cart();
					}
				?>
			</div><!-- .jas-action -->
		</div>
	</div><!-- .jas-row -->
</div><!-- .header__mid -->