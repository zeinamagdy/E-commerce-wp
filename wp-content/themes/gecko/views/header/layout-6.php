<?php
/**
 * The header layout 6.
 *
 * @since   1.0.0
 * @package Gecko
 */
?>
<header id="jas-header" class="header-6">
	<div class="header__top bgbl pl__30 pr__30">
		<div class="jas-row middle-xs">
			<div class="jas-col-md-2 jas-col-sm-6 jas-col-xs-12 start-md start-sm center-xs"><?php echo jas_gecko_social(); ?></div>
			<div class="jas-col-md-8 hidden-sm hidden-xs">
				<nav class="jas-navigation flex middle-xs" role="navigation">
					<?php
						if ( has_nav_menu( 'primary-menu' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'primary-menu',
									'menu_class'     => 'jas-menu clearfix',
									'menu_id'        => 'jas-main-menu',
									'container'      => false,
									'fallback_cb'    => NULL
								)
							);
						} else {
							echo '<ul class="jas-menu clearfix"><li><a target="_blank" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Add Menu', 'gecko' ) . '</a></li></ul>';
						}
					?>
				</nav><!-- .jas-navigation -->
			</div>
			<div class="jas-col-md-2 jas-col-sm-6 jas-col-xs-12">
				<div class="jas-action flex end-md end-sm center-xs middle-xs">
					<?php
						if ( class_exists( 'WooCommerce' ) ) {
							echo jas_gecko_wc_currency();
						}
					?>
				</div><!-- .jas-action -->
			</div>
		</div><!-- .jas-row -->
	</div><!-- .header__top -->

	<div class="header__mid pr tc pl__30 pr__30<?php echo ( cs_get_option( 'header-transparent' ) ? ' header__transparent pa w__100' : '' ); ?>">
		<div class="jas-row middle-xs pr">
			<div class="jas-col-sm-3 jas-col-md-3 jas-col-xs-3 flex start-xs middle-xs">
				<a href="javascript:void(0);" class="jas-push-menu-btn"><img src="<?php echo JAS_GECKO_URL . '/assets/images/icons/hamburger-black.svg'; ?>" width="25" height="22" /></a>
			</div>
			<div class="jas-col-md-6 jas-col-sm-6 jas-col-xs-6"><?php jas_gecko_logo(); ?></div>
			<div class="jas-action flex end-xs middle-xs jas-col-md-3 jas-col-sm-3 jas-col-xs-3">
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
		</div><!-- .jas-row -->
	</div><!-- .header__mid -->
	<form class="header__search w__100 dn pf" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="pa">
			<input class="w__100 jas-ajax-search" type="text" name="s" placeholder="<?php echo esc_html__( 'Search for...', 'gecko' ); ?>" />
		</div>
		<a id="sf-close" class="pa" href="#"><i class="pe-7s-close"></i></a>
	</form><!-- #header__search -->

	<div class="jas-canvas-menu jas-push-menu">
		<h3 class="mg__0 tc cw bgb tu ls__2"><?php esc_html_e( 'Menu', 'gecko' ); ?> <i class="close-menu pe-7s-close pa"></i></h3>
		<div class="jas-action flex center-xs middle-xs hidden-md hidden-sm visible-xs mt__30">
			<a class="sf-open cb chp" href="javascript:void(0);"><i class="pe-7s-search"></i></a>
			<?php
				if ( class_exists( 'WooCommerce' ) ) {
					echo jas_gecko_wc_my_account();

					if ( class_exists( 'YITH_WCWL' ) ) {
						global $yith_wcwl;
						echo '<a class="cb chp" href="' . esc_url( $yith_wcwl->get_wishlist_url() ) . '"><i class="pe-7s-like"></i></a>';
					}
				}
			?>
		</div><!-- .jas-action -->
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
					'container_id'   => 'jas-mobile-menu',
					'walker'         => new JAS_Gecko_Menu_Walker(),
					'fallback_cb'    => NULL
				)
			);
		?>
	</div><!-- .jas-canvas-menu -->
	
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>	
		<div class="jas-mini-cart jas-push-menu">
			<div class="jas-mini-cart-content">
				<h3 class="mg__0 tc cw bgb tu ls__2"><?php esc_html_e( 'Mini Cart', 'gecko' );?> <i class="close-cart pe-7s-close pa"></i></h3>
				<div class="widget_shopping_cart_content"></div>
			</div>
		</div><!-- .jas-mini-cart -->
	<?php endif ?>
</header><!-- #jas-header -->