<?php
/**
 * Custom template tags.
 *
 * @since   1.0.0
 * @package Gecko
 */

/**
 * Render header layout.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_header' ) ) {
	function jas_gecko_header() {
		$layout = cs_get_option( 'header-layout' );
		if ( isset( $_GET['header'] ) ) {
			$layout = $_GET['header'];
		}

		ob_start();
		get_template_part( 'views/header/layout', $layout );
		$output = ob_get_clean();

		echo apply_filters( 'jas_gecko_header', $output );
	}
}

/**
 * Render footer layout.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_footer' ) ) {
	function jas_gecko_footer() {
		$layout = cs_get_option( 'footer-layout' );
		if ( isset( $_GET['footer'] ) ) {
			$layout = $_GET['footer'];
		}

		ob_start();
		get_template_part( 'views/footer/layout', $layout );
		$output = ob_get_clean();

		echo apply_filters( 'jas_gecko_footer', $output );
	}
}

/**
 * Render logo.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_logo' ) ) {
	function jas_gecko_logo() {
		$output = '';

		$output .= '<div class="jas-branding ts__05">';
			$output .= '<a class="db" href="' . esc_url( home_url( '/' ) ) . '">';
				if ( ! cs_get_option( 'header-transparent' ) ) {
					if ( cs_get_option( 'logo' ) ) {
						$logo = wp_get_attachment_image_src( cs_get_option( 'logo' ), 'full', true );

						$output .= '<img class="regular-logo" src="' . esc_url( $logo[0] ) . '" width="' . esc_attr( $logo[1] ) . '" height="' . esc_attr( $logo[2] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
					} else {
						$output .= '<img class="regular-logo" src="' . JAS_GECKO_URL . '/assets/images/logo.png' . '" width="200" height="25" alt="' . get_bloginfo( 'name' ) . '" />';
					}

					if ( cs_get_option( 'logo-retina' ) ) {
						$logo_retina = wp_get_attachment_image_src( cs_get_option( 'logo-retina' ), 'full', true );

						$output .= '<img class="retina-logo" src="' . esc_url( $logo[0] ) . '" width="' . esc_attr( $logo[1] ) . '" height="' . esc_attr( $logo[2] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
					} else {
						$output .= '<img class="retina-logo" src="' . JAS_GECKO_URL . '/assets/images/logo-2x.png' . '" width="200" height="25" alt="' . get_bloginfo( 'name' ) . '" />';
					}
				} else {
					if ( cs_get_option( 'logo-transparent' ) ) {
						$logo_retina = wp_get_attachment_image_src( cs_get_option( 'logo-transparent' ), 'full', true );

						$output .= '<img class="regular-logo" src="' . esc_url( $logo[0] ) . '" width="' . esc_attr( $logo[1] ) . '" height="' . esc_attr( $logo[2] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
					} else {
						$output .= '<img class="regular-logo" src="' . JAS_GECKO_URL . '/assets/images/logo-white.png' . '" width="200" height="25" alt="' . get_bloginfo( 'name' ) . '" />';
					}

					if ( cs_get_option( 'logo-transparent-retina' ) ) {
						$logo_retina = wp_get_attachment_image_src( cs_get_option( 'logo-transparent-retina' ), 'full', true );

						$output .= '<img class="retina-logo" src="' . esc_url( $logo[0] ) . '" width="' . esc_attr( $logo[1] ) . '" height="' . esc_attr( $logo[2] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
					} else {
						$output .= '<img class="retina-logo" src="' . JAS_GECKO_URL . '/assets/images/logo-white-2x.png' . '" width="200" height="25" alt="' . get_bloginfo( 'name' ) . '" />';
					}
				}
			$output .= '</a>';
		$output .= '</div>';

		echo apply_filters( 'jas_gecko_logo', $output );
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_posted_on' ) ) {
	function jas_gecko_posted_on() {
		$output = '';
		$time = '<a class="cg" href="%3$s"><time class="entry-date published updated" datetime="%1$s">%2$s</time></a>';

		$output .= sprintf( $time,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_permalink() )
		);

		echo apply_filters( 'jas_gecko_posted_on', '<span class="posted-on fs__12">' . $output . '</span>' );
	}
}

/**
 * Prints post title.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_post_title' ) ) {
	function jas_gecko_post_title( $link = true ) {
		$output = '';

		if ( $link ) {
			$output .= sprintf( '<h2 class="post-title fs__14 ls__2 mt__10 mb__5 tu"><a class="chp" href="%2$s" rel="bookmark">%1$s</a></h2>', get_the_title(), esc_url( get_permalink() ) );
		} else {
			$output .= sprintf( '<h2 class="post-title fs__14 ls__2 tu">%s</h2>', get_the_title() );
		}

		echo apply_filters( 'jas_gecko_post_title', $output );
	}
}

/**
 * Prints post meta with the post author, categories and post comments.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_post_meta' ) ) {
	function jas_gecko_post_meta() {
		$output = '';
		// Post author
		$output .= sprintf(
			esc_html__( '%1$s', 'gecko' ),
			'<span class="author vcard pr">' . esc_html__( 'By ', 'gecko' ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		// Post categories
		$categories = get_the_category_list( esc_html__( ', ', 'gecko' ) );
		if ( $categories ) {
			$output .= sprintf(
				'<span class="cat pr">' . esc_html__( 'In %1$s', 'gecko' ) . '</span>', $categories 
			);
		}

		// Post comments
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			$output .= sprintf( '<span class="comment-number pr"><a href="%2$s">' . esc_html__( '%1$s Comment', get_comments_number(), 'gecko' ) . '</a></span>', number_format_i18n( get_comments_number() ), get_comments_link() );
		}

		echo apply_filters( 'jas_gecko_post_title', '<div class="post-meta fs__12">' . $output . '</div>' );
	}
}

/**
 * Render post tags.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_get_tags' ) ) :
	function jas_gecko_get_tags() {
		$output = '';

		// Get the tag list
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'gecko' ) );
		if ( $tags_list ) {
			$output .= sprintf( '<div class="post-tags"><i class="fa fa-tags"></i> ' . esc_html__( '%1$s', 'gecko' ) . '</div>', $tags_list );
		}
		return apply_filters( 'jas_gecko_get_tags', $output );
	}
endif;

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_post_thumbnail' ) ) {
	function jas_gecko_post_thumbnail() {
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		?>
			<div class="post-thumbnail pr mb__25">
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
						<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
					</a>
				<?php endif; ?>
				<div class="pa inside-thumb tc cg">
					<?php jas_gecko_post_meta(); ?>
					<?php jas_gecko_post_title(); ?>
					<?php jas_gecko_posted_on(); ?>
				</div>
			</div>
		<?php
	}
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_pagination' ) ) {
	function jas_gecko_pagination( $nav_query = false ) {

		global $wp_query, $wp_rewrite;

		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		// Prepare variables
		$query        = $nav_query ? $nav_query : $wp_query;
		$max          = $query->max_num_pages;
		$current_page = max( 1, get_query_var( 'paged' ) );
		$big          = 999999;
		?>
		<nav class="jas-pagination" role="navigation">
			<?php
				echo '' . paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => $current_page,
						'total'     => $max,
						'type'      => 'list',
						'prev_text' => esc_html__( 'Prev', 'gecko' ),
						'next_text' => esc_html__( 'Next', 'gecko' ),
					)
				) . ' ';
			?>
		</nav><!-- .page-nav -->
		<?php
	}
}

/**
 * Create a breadcrumb menu.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_breadcrumb' ) ) {
	function jas_gecko_breadcrumb() {
		// Settings
		$sep   = '<i class="fa fa-angle-right"></i>';
		$home  = esc_html__( 'Home', 'gecko' );
		$blog  = esc_html__( 'Blog', 'gecko' );
		$shop  = esc_html__( 'Shop', 'gecko' );
		 
		// Get the query & post information
		global $post, $wp_query;

		// Get post category
		$category = get_the_category();

		// Get product category
		$product_cat = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		if ( $product_cat ) {
			$tax_title = $product_cat->name;
		}

		$output = '';
		 
		// Build the breadcrums
		$output .= '<ul class="jas-breadcrumb dib oh">';
		 
		// Do not display on the homepage
		if ( ! is_front_page() ) {

			if ( is_home() ) {
				
				// Home page
				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl separator"> ' . $blog . ' </li>';

			} elseif ( function_exists( 'is_shop' ) && is_shop() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl">' . $shop . '</li>';
			
			} elseif ( function_exists( 'is_product' ) && is_product() || function_exists( 'is_cart' ) && is_cart() || function_exists( 'is_checkout' ) && is_checkout()  || function_exists( 'is_account_page' ) && is_account_page() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl"><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" title="' . esc_attr( $home ) . '">' . $shop . '</a></li>';

			} elseif ( function_exists( 'is_product_category' ) && is_product_category() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl"><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" title="' . esc_attr( $home ) . '">' . $shop . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl separator"> ' . esc_html__( 'Category', 'gecko' ) . ' </li>';

			} elseif ( function_exists( 'is_product_tag' ) && is_product_tag() ) {

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl"><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" title="' . esc_attr( $home ) . '">' . $shop . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl separator"> ' . esc_html__( 'Tag', 'gecko' ) . ' </li>';

			} elseif ( is_post_type_archive() ) {

				$post_type = get_post_type_object( get_post_type() );

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl current">' . $post_type->labels->singular_name . '</li>';
			} elseif ( is_tax() ) {

				$term = $GLOBALS['wp_query']->get_queried_object();

				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl current">' . $term->name . '</li>';

			} elseif ( is_single() ) {
				 
				// Single post (Only display the first category)
				if ( ! empty( $category ) ) {
					$output .= '<li class="fl"><a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '" title="' . esc_attr( $category[0]->cat_name ) . '">' . $category[0]->cat_name . '</a></li>';
				}
				
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl current">' . get_the_title() . '</li>';
				 
			} elseif ( is_category() ) {
				 
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) echo get_category_parents( $thisCat->parent, TRUE, ' ' );

				// Category page
				$output .= '<li class="fl current">' . single_cat_title( '', false ) . '</li>';
				 
			} elseif ( is_page() ) {
				 
				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';

				// Standard page
				if ( $post->post_parent ) {
					 
					// If child page, get parents 
					$anc = get_post_ancestors( $post->ID );
					 
					// Get parents in the right order
					$anc = array_reverse($anc);
					 
					// Parent page loop
					foreach ( $anc as $ancestor ) {
						$parents = '<li class="fl"><a href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a></li>';
						$parents .= '<li class="fl separator"> ' . $sep . ' </li>';
					}
					 
					// Display parent pages
					$output .= $parents;
					 
					// Current page
					$output .= '<li class="fl current"> ' . get_the_title() . '</li>';
					 
				} else {
					 
					// Just display current page if not parents
					$output .= '<li class="fl current"> ' . get_the_title() . '</li>';
					 
				}
				 
			} elseif ( is_tag() ) {
				 
				// Tag page
				 
				// Get tag information
				$term_id  = get_query_var( 'tag_id' );
				$taxonomy = 'post_tag';
				$args     = 'include=' . $term_id;
				$terms    = get_terms( $taxonomy, $args );
				 
				// Display the tag name
				$output .= '<li class="fl current">' . $terms[0]->name . '</li>';
			 
			} elseif ( is_day() ) {
				 
				// Day archive
				 
				// Year link
				$output .= '<li class="fl"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . esc_html__( ' Archives', 'gecko' ) . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				 
				// Month link
				$output .= '<li class="fl"><a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time( 'm' ) ) ) . '" title="' . esc_attr( get_the_time( 'M' ) ) . '">' . get_the_time( 'M' ) . esc_html__( ' Archives', 'gecko' ) . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				 
				// Day display
				$output .= '<li class="fl current"> ' . get_the_time('jS') . ' ' . get_the_time('M') . esc_html__( ' Archives', 'gecko' ) . '</li>';
				 
			} elseif ( is_month() ) {
				 
				// Month Archive
				 
				// Year link
				$output .= '<li class="fl"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . esc_html__( ' Archives', 'gecko' ) . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				 
				// Month display
				$output .= '<li class="fl">' . get_the_time( 'M' ) . esc_html__( ' Archives', 'gecko' ) . '</li>';
				 
			} elseif ( is_year() ) {
				 
				// Display year archive
				$output .= '<li class="fl current">' . get_the_time('Y') . esc_html__( 'Archives', 'gecko' ) . '</li>';
				 
			} elseif ( is_author() ) {
				 
				// Auhor archive
				 
				// Get the author information
				global $author;
				$userdata = get_userdata( $author );
				 
				// Display author name
				$output .= '<li class="fl current">' . esc_html__( 'Author: ', 'gecko' ) . $userdata->display_name . '</li>';
			 
			} elseif ( get_query_var('paged') ) {
				 
				// Paginated archives
				$output .= '<li class="fl current">' .  esc_html__( 'Page', 'gecko' ) . ' ' . get_query_var( 'paged' ) . '</li>';
				 
			} elseif ( is_search() ) {
			 
				// Search results page
				$output .= '<li class="fl current">' .  esc_html__( 'Search results for: ', 'gecko' ) . get_search_query() . '</li>';
			 
			} elseif ( is_404() ) {
				 
				// 404 page
				$output .= '<li class="fl home"><a href="' . esc_url( get_home_url() ) . '" title="' . esc_attr( $home ) . '">' . $home . '</a></li>';
				$output .= '<li class="fl separator"> ' . $sep . ' </li>';
				$output .= '<li class="fl current">' . esc_html__( 'Error 404', 'gecko' ) . '</li>';
			}
			 
		} else  {
			$output .= '<li class="fl current">' . esc_html__( 'Front Page', 'gecko' ) . '</li>';
		}
		 
		$output .= '</ul>';

		return apply_filters( 'jas_gecko_breadcrumb', $output );
	}
}

/**
 * Print HTML for social share.
 *
 * @return  void
 */
if ( ! function_exists( 'jas_gecko_social_share' ) ) {
	function jas_gecko_social_share() {
		global $post;
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );
		?>
			<div class="social-share">
				<div class="jas-social">
					<a title="<?php echo esc_html__( 'Share this post on Facebook', 'gecko' ); ?>" class="cb facebook" href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=380,width=660');return false;">
						<i class="fa fa-facebook"></i>
					</a>
					<a title="<?php echo esc_html__( 'Share this post on Twitter', 'gecko' ); ?>" class="cb twitter" href="https://twitter.com/share?url=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=380,width=660');return false;">
						<i class="fa fa-twitter"></i>
					</a>
					<a title="<?php echo esc_html__( 'Share this post on Google Plus', 'gecko' ); ?>" class="cb google-plus" href="https://plus.google.com/share?url=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=380,width=660');return false;">
						<i class="fa fa-google-plus"></i>
					</a>
					<a title="<?php echo esc_html__( 'Share this post on Pinterest', 'gecko' ); ?>" class="cb pinterest" href="//pinterest.com/pin/create/button/?url=<?php esc_url( the_permalink() ); ?>&media=<?php echo esc_url( $src[0] ); ?>&description=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						<i class="fa fa-pinterest"></i>
					</a>
					<a data-title="<?php echo esc_html__( 'Share this post on Tumbr', 'gecko' ); ?>" class="cb tumblr" data-content="<?php echo esc_url( $src[0] ); ?>" href="//tumblr.com/widgets/share/tool?canonicalUrl=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=540');return false;">
						<i class="fa fa-tumblr"></i>
					</a>
				</div>
			</div>
		<?php
	}
}

/**
 * Print HTML for social list.
 *
 * @return  void
 */
if ( ! function_exists( 'jas_gecko_social' ) ) {
	function jas_gecko_social() {
		$output = '';

		$socials = cs_get_option( 'social-network' );
		if ( empty( $socials ) ) return;

		$output .= '<div class="jas-socials">';
			foreach ( $socials as $social) {
				$output .= '<a class="dib br__50 tc ' . esc_attr( str_replace( 'fa fa-', '', $social['icon'] ) ) . '" href="' . esc_url( $social['link'] ) . '" target="_blank"><i class="' . esc_attr( $social['icon'] ) . '"></i></a>';
			}
		$output .= '</div>';

		return apply_filters( 'jas_gecko_social', $output );
	}
}

/**
 * Render author information.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_author_info' ) ) {
	function jas_gecko_author_info() {
		$author = sprintf(
			wp_kses_post( '<div class="post-author">%1$s<div class="clearfix">%2$s%3$s</div></div>', 'gecko' ),
			'<h4 class="mg__0 mb__35 pr dib tu cp head__1">' . esc_html__( 'About Author', 'gecko' ) . '</h4>',
			'<div class="fl">' . get_avatar( get_the_author_meta( 'user_email' ), '100', '' ) . '</div>',
			'<div class="oh pl__70"><a class="f__mont cb chp fwb db mb__10 mt__5" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a><p>' . get_the_author_meta( 'description' ) . '</p></div>'

		);
		echo apply_filters( 'jas_gecko_author_info', $author );
	}
}

/**
 * Render related post based on post tags.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_related_post' ) ) {
	function jas_gecko_related_post() {
		global $post;

		// Get post's tags
		$tags = wp_get_post_tags( $post->ID );

		if ( $tags ) {
			// Get id for all tags
			$tag_ids = array();

			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}

			// Build arguments to query for related posts
			$args = array(
				'tag__in'             => $tag_ids,
				'post__not_in'        => array( $post->ID ),
				'posts_per_page'      => apply_filters( 'jas_gecko_related_post_per_page', '5' ),
				'ignore_sticky_posts' => 1,
				'orderby'             => 'rand',
			);

			// Get related post
			$related = new wp_query( $args );

			$output = '';
			$output .= '<div class="post-related mt__50">';
				$output .= '<h4 class="mg__0 mb__30 tu">' . esc_html__( 'Related Articles', 'gecko' ) . '</h4>';
				$output .= '<div class="jas-carousel" data-slick=\'{"slidesToShow": 3,"slidesToScroll": 1, "responsive":[{"breakpoint": 960,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}\'>';
					while ( $related->have_posts() ) :
						// Update global post data
						$related->the_post();

						$output .= '<div class="item">';
							if ( has_post_thumbnail() ) {
								$output .= '<a class="db mb__20" href="' . esc_url( get_permalink() ) . '">';
									$url   = get_the_post_thumbnail_url();
									$image = aq_resize( $url, 370, 210, true );
									$output .= '<img src="' . esc_url( $image ) . '" width="370" height="210" alt="' . get_the_title() . '" />';
								$output .= '</a>';
							}

							$output .= '<h5 class="mg__0 fs__14"><a class="cd chp" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h5>';
							$output .= '<span class="f__libre">' . get_the_time( 'F j' ) . '</span>';
						$output .= '</div>';
					endwhile;
				$output .= '</div>';	
			$output .= '</div>';
			
			// Reset global query object
			wp_reset_postdata();

			echo apply_filters( 'jas_gecko_related_post', $output );
		}
	}
}

/**
 * custom function to use to open and display each comment
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_comments_list' ) ) {
	function jas_gecko_comments_list( $comment, $args, $depth ) {
	// Globalize comment object
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :

			case 'pingback'  :
			case 'trackback' :
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p>
						<?php
							echo esc_html__( 'Pingback:', 'gecko' );
							comment_author_link();
							edit_comment_link( esc_html__( 'Edit', 'gecko' ), '<span class="edit-link">', '</span>' );
						?>
					</p>
				<?php
			break;

			default :
				global $post;
				?>
				<li <?php comment_class( 'mt__30' ); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment_container">
						<?php echo get_avatar( $comment, 80 ); ?>

						<div class="comment-text">
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'gecko' ); ?></p>
							<?php endif; ?>

							<?php
								printf(
									'<h5 class="comment-author mg__0 mb__5 tu cb">%1$s</h5>',
									get_comment_author_link(),
									( $comment->user_id == $post->post_author ) ? '<span class="author-post">' . esc_html__( 'Post author', 'gecko' ) . '</span>' : ''
								);
							?>
							<?php comment_text(); ?>

							<div class="flex">
								<?php
									printf(
										'<time class="grow f__libre">%3$s</time>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										sprintf( wp_kses_post( '%1$s at %2$s', 'gecko' ), get_comment_date(), get_comment_time() )
									);
								?>
								<?php
									edit_comment_link( wp_kses_post( '<span>' . esc_html__( 'Edit', 'gecko' ) . '</span>', 'gecko' ) );
									comment_reply_link(
										array_merge(
											$args,
											array(
												'reply_text' => wp_kses_post( '<span class="ml__10">' . esc_html__( 'Reply', 'gecko' ) . '</span>', 'gecko' ),
												'depth'      => $depth,
												'max_depth'  => $args['max_depth'],
											)
										)
									);
								?>
							</div><!-- .action-link -->
						</div><!-- .comment-content -->
					</article><!-- #comment- -->
				<?php
			break;

		endswitch;
	}
}

/**
 * Render custom styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_custom_css' ) ) {
	function jas_gecko_custom_css( $css = array() ) {
		// Header layout 6 background
		$header_bg = cs_get_option( 'header-bg' );

		if ( ! empty( $header_bg['image'] ) ) {
			$css[] = '.header-6 .header__mid, .header-7 {';
				$css[] = '
					background-image:  url(' .  esc_url( $header_bg['image'] ) . ');
					background-size:       ' .  $header_bg['size'] .       ';
					background-repeat:     ' .  $header_bg['repeat'] .     ';
					background-position:   ' .  $header_bg['position'] .   ';
					background-attachment: ' .  $header_bg['attachment'] . ';
				';
				if ( ! empty( $header_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $header_bg['color'] .';';
				}
			$css[] = '}';
			$css[] = '
				.header-6 .header__mid:before, .header-7:before {
					content: "";
					position: absolute;
					background: rgba(255, 255, 255, .85);
					left: 0;
					top: 0;
					width: 100%;
					height: 100%;
					z-index: 0;
				}
				.header-6 .header__mid .jas-branding, .header-7 .jas-branding {
					position: relative;
				}
			';
		}

		// Boxed layout
		$boxed_bg = cs_get_option( 'boxed-bg' );

		if ( ! empty( $boxed_bg['image'] ) ) {
			$css[] = '.boxed {';
				$css[] = '
					background-image:  url(' .  esc_url( $boxed_bg['image'] ) . ');
					background-size:       ' .  $boxed_bg['size'] .       ';
					background-repeat:     ' .  $boxed_bg['repeat'] .     ';
					background-position:   ' .  $boxed_bg['position'] .   ';
					background-attachment: ' .  $boxed_bg['attachment'] . ';
				';
				if ( ! empty( $boxed_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $boxed_bg['color'] .';';
				}
			$css[] = '}';
		}

		// WC page title
		$wc_head_bg = cs_get_option( 'wc-pagehead-bg' );

		if ( ( function_exists( 'is_shop' ) && is_shop() || function_exists( 'is_product' ) && is_product() ) && ! empty( $wc_head_bg ) ) {
			$css[] = '.jas-wc .page-head, .jas-wc-single .page-head {';
				$css[] = '
					background-image:  url(' .  esc_url( $wc_head_bg['image'] ) . ');
					background-size:       ' .  $wc_head_bg['size'] .       ';
					background-repeat:     ' .  $wc_head_bg['repeat'] .     ';
					background-position:   ' .  $wc_head_bg['position'] .   ';
					background-attachment: ' .  $wc_head_bg['attachment'] . ';
				';
				if ( ! empty( $wc_head_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $wc_head_bg['color'] .';';
				}
			$css[] = '}';
		} elseif ( function_exists( 'is_product_category' ) && is_product_category() ) {
			global $wp_query;
			$cat = $wp_query->get_queried_object();
			$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
			$tmp = wp_get_attachment_image_src( $thumbnail_id,'full' );
			if ( !empty( $tmp ) )  {
				$css[] = '.jas-wc .page-head {';
					$css[] = '
						background-image:  url(' . esc_url( $tmp[0] ) . ');
						background-size: cover;
					';
				$css[] = '}';
			}
		}

		// Portfolio page title
		$portfolio_head_bg = cs_get_option( 'portfolio-pagehead-bg' );
		if ( ! empty( $portfolio_head_bg['image'] ) ) {
			$css[] = '.jas-portfolio .page-head {';
				$css[] = '
					background-image:  url(' .  esc_url( $portfolio_head_bg['image'] ) . ');
					background-size:       ' .  $portfolio_head_bg['size'] .       ';
					background-repeat:     ' .  $portfolio_head_bg['repeat'] .     ';
					background-position:   ' .  $portfolio_head_bg['position'] .   ';
					background-attachment: ' .  $portfolio_head_bg['attachment'] . ';
				';
				if ( ! empty( $portfolio_head_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $portfolio_head_bg['color'] .';';
				}
			$css[] = '}';
		}


		// Footer background
		$footer_bg = cs_get_option( 'footer-bg' );

		if ( ! empty( $footer_bg['image'] ) ) {
			$css[] = '.footer__top {';
				$css[] = '
					background-image:  url(' .  esc_url( $footer_bg['image'] ) . ')     ;
					background-size:       ' .  esc_attr( $footer_bg['size'] ) .       ';
					background-repeat:     ' .  esc_attr( $footer_bg['repeat'] ) .     ';
					background-position:   ' .  esc_attr( $footer_bg['position'] ) .   ';
					background-attachment: ' .  esc_attr( $footer_bg['attachment'] ) . ';
				';
				if ( ! empty( $footer_bg['color'] ) ) {
					$css[] = 'background-color: ' .  $footer_bg['color'] .';';
				}
			$css[] = '}';
		}

		// Typography
		$body_font    = cs_get_option( 'body-font' );
		$heading_font = cs_get_option( 'heading-font' );

		$css[] = 'body {';
			// Body font family
			$css[] = 'font-family: "' . $body_font['family'] . '";';
			if ( '100italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '700italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '900italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $body_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $body_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $body_font['variant'] . ';';
			}

			// Body font size
			if ( cs_get_option( 'body-font-size' ) ) {
				$css[] = 'font-size:' . cs_get_option( 'body-font-size' ) . 'px;';
			}

			// Body color
			if ( cs_get_option( 'body-color' ) ) {
				$css[] = 'color:' . cs_get_option( 'body-color' );
			}
		$css[] = '}';

		$css[] = 'h1, h2, h3, h4, h5, h6, .f__mont {';
			$css[] = 'font-family: "' . $heading_font['family'] . '";';
			if ( '100italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '700italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '900italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $heading_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $heading_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $heading_font['variant'];
			}
		$css[] = '}';
		
		if ( cs_get_option( 'heading-color' ) ) {
			$css[] = 'h1, h2, h3, h4, h5, h6 {';
				$css[] = 'color:' . cs_get_option( 'heading-color' );
			$css[] = '}';
		}

		if ( cs_get_option( 'h1-font-size' ) ) {
			$css[] = 'h1 { font-size:' . cs_get_option( 'h1-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h2-font-size' ) ) {
			$css[] = 'h2 { font-size:' . cs_get_option( 'h2-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h3-font-size' ) ) {
			$css[] = 'h3 { font-size:' . cs_get_option( 'h3-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h4-font-size' ) ) {
			$css[] = 'h4 { font-size:' . cs_get_option( 'h4-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h5-font-size' ) ) {
			$css[] = 'h5 { font-size:' . cs_get_option( 'h5-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h6-font-size' ) ) {
			$css[] = 'h6 { font-size:' . cs_get_option( 'h6-font-size' ) . 'px; }';
		}

		// Custom css
		if ( cs_get_option( 'custom-css' ) ) {
			$css[] = cs_get_option( 'custom-css' );
		}

		return implode( '', $css );
	}
}

/**
 * Get custom data to js.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_custom_data_js' ) ) {
	function jas_gecko_custom_data_js() {
		$data = array();

		// Header Sticky
		$data['header_sticky'] = cs_get_option( 'header-sticky' );

		return $data;
	}
}

/**
 * Render title of page.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_page_title' ) ) {
	function jas_gecko_page_title() {
		$output = '';

		// Get title of blog list
		$blog_title      = cs_get_option( 'blog-page-title' );
		$portfolio_title = cs_get_option( 'portfolio-page-title' );

		$output .= '<h1 class="tu mb__10 cw">';
			if ( is_page() ) {

				$output .= get_the_title();

			} elseif ( is_home() ) {

				if ( ! empty( $blog_title ) ) {
					$output .= $blog_title;
				} else {
					$output .= esc_html__( 'Article', 'gecko' );
				}

			} elseif ( is_post_type_archive( 'portfolio' ) ) {
				
				if ( ! empty( $portfolio_title ) ) {
					$output .= $portfolio_title;
				} else {
					$output .= esc_html__( 'Portfolio', 'gecko' );
				}

			} elseif ( is_tax() ) {
				$term = $GLOBALS['wp_query']->get_queried_object();
				$output .= $term->name;
			}
		$output .= '</h1>';

		return apply_filters( 'jas_gecko_page_title', $output );
	}
}

/**
 * Render sub title of page.
 *
 * @return string
 */
if ( ! function_exists( 'jas_gecko_page_sub_title' ) ) {
	function jas_gecko_page_sub_title() {
		$output = '';

		// Get sub title
		if ( is_page() ) {
			$subtitle = get_post_meta( get_the_ID(), '_custom_page_options', true );
			if ( isset( $subtitle['subtitle'] ) && ! $subtitle['subtitle'] ) return;

			$output .= '<p>';
				if ( isset( $subtitle['subtitle'] ) && $subtitle['subtitle'] && ! empty( $subtitle['title'] ) ) {
					$output .= $subtitle['title'];
				}
			$output .= '</p>';
		} elseif ( is_post_type_archive( 'portfolio' ) ) {
			$portfolio_subtitle = cs_get_option( 'portfolio-sub-title' );
			if ( ! empty( $portfolio_subtitle ) ) {
				$output .= '<p>' . esc_html( $portfolio_subtitle ) . '</p>';
			}
		} elseif ( is_tax() ) {
			$output .= category_description();
		}

		return apply_filters( 'jas_gecko_page_sub_title', $output );
	}
}

/**
 * Render page heading for page.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_head_page' ) ) {
	function jas_gecko_head_page() {
		$output = $atts = '';

		if ( ! is_post_type_archive( 'portfolio' ) ) {
			// Get post or page thumbnail
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );

			if ( $image ) {
				$atts = 'style="background: url(' . esc_url( $image[0] ) . ') no-repeat center center / cover;"';
			}
		}

		$output .= '<div class="page-head pr tc" ' . $atts . '>';
			$output .= '<div class="jas-container pr">';
				$output .= jas_gecko_page_title();
				$output .= jas_gecko_page_sub_title();
				$output .= jas_gecko_breadcrumb();
			$output .= '</div>';
		$output .= '</div>';

		return apply_filters( 'jas_gecko_head_page', $output );
	}
}

/**
 * Render page heading for single post.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_head_single' ) ) {
	function jas_gecko_head_single() {
		$output = $atts = '';

		// Get post or page thumbnail
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );

		if ( $image ) {
			$atts = 'style="background: url(' . esc_url( $image[0] ) . ') no-repeat center center / cover;"';
		}

		// Get posted on
		$time = '<time class="entry-date published updated f__libre" datetime="%1$s">%2$s</time>';

		// Post categories
		$categories = get_the_category_list( esc_html__( ', ', 'gecko' ) );

		$output .= '<div class="page-head pr tc" ' . $atts . '>';
			$output .= '<div class="jas-container pr">';
				$output .= sprintf( '<h1 class="tu cw mb__10">%s</h1>', get_the_title() );
				$output .= sprintf( $time,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				$output .= '<div class="pr mt__20">';
					if ( $categories ) {
						$output .= sprintf( '<span>' . esc_html__( 'In %1$s', 'gecko' ) . '</span>', $categories );
					}
					// Post comments
					if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
						$output .= sprintf( '<span class="ml__15"><a href="%2$s">' . esc_html__( '%1$s Comment', get_comments_number(), 'gecko' ) . '</a></span>', number_format_i18n( get_comments_number() ), get_comments_link() );
					}
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		return apply_filters( 'jas_gecko_head_single', $output );
	}
}

/**
 * Get all registered sidebars.
 *
 * @return  array
 */
function jas_gecko_get_sidebars() {
	global $wp_registered_sidebars;

	// Get custom sidebars.
	$custom_sidebars = get_option( 'gecko_custom_sidebars' );

	// Prepare output.
	$output = array();

	$output[] = esc_html__( 'Select a sidebar', 'gecko' );

	if ( ! empty( $wp_registered_sidebars ) ) {
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$output[ $sidebar['id'] ] = $sidebar['name'];
		}
	}

	if ( ! empty( $custom_sidebars ) ) {
		foreach ( $custom_sidebars as $sidebar ) {
			$output[ $sidebar['id'] ] = $sidebar['name'];
		}
	}


	return $output;
}

/**
 * Render google font link
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jas_gecko_google_font_url' ) ) {
	function jas_gecko_google_font_url() {
		// Google font
		$fonts = $font_parse = array();

		// Font default
		$fonts['Montserrat'] = array(
			'400',
			'700',
		);
		$fonts['Lato'] = array(
			'400',
			'300',
			'700',
		);
		$fonts['Libre Baskerville'] = array( '400italic' );

		// Body font
		$body_font    = cs_get_option( 'body-font' );
		$heading_font = cs_get_option( 'heading-font' );

		if ( $body_font ) {
			$font_family = esc_attr( $body_font['family'] );
			if ( '100italic' == $body_font['variant'] ) {
				$font_weight = array( '100' );
			} elseif ( '300italic' == $body_font['variant'] ) {
				$font_weight = array( '300' );
			} elseif ( '400italic' == $body_font['variant'] ) {
				$font_weight = array( '400' );
			} elseif ( '700italic' == $body_font['variant'] ) {
				$font_weight = array( '700' );
			} elseif ( '900italic' == $body_font['variant'] ) {
				$font_weight = array( '900' );
			} elseif ( 'regular' == $body_font['variant'] ) {
				$font_weight = array( '400' );
			} else {
				$font_weight = array( $body_font['variant'] );
			}

			// Merge array and delete values duplicated
			$fonts[$font_family] = isset( $fonts[$font_family] ) ? array_unique( array_merge( $fonts[$font_family], $font_weight ) ) : $font_weight;
		}

		if ( $heading_font ) {
			$font_family = esc_attr( $heading_font['family'] );
			if ( '100italic' == $heading_font['variant'] ) {
				$font_weight = array( '100' );
			} elseif ( '300italic' == $heading_font['variant'] ) {
				$font_weight = array( '300' );
			} elseif ( '400italic' == $heading_font['variant'] ) {
				$font_weight = array( '400' );
			} elseif ( '700italic' == $heading_font['variant'] ) {
				$font_weight = array( '700' );
			} elseif ( '900italic' == $heading_font['variant'] ) {
				$font_weight = array( '900' );
			} elseif ( 'regular' == $heading_font['variant'] ) {
				$font_weight = array( '400' );
			} else {
				$font_weight = array( $heading_font['variant'] );
			}

			// Merge array and delete values duplicated
			$fonts[$font_family] = isset( $fonts[$font_family] ) ? array_unique( array_merge( $fonts[$font_family], $font_weight ) ) : $font_weight;
		}

		// Parse array to string for url Google fonts
		foreach ( $fonts as $font_name => $font_weight ) {
			$font_parse[] = $font_name . ':'. implode( ',' , $font_weight );
		}

		$query_args = array(
			'family' => urldecode( implode( '|', $font_parse ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		return esc_url_raw( $fonts_url );
	}
}