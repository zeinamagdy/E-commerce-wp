<?php
/**
 * Blog shortcode.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'jas_shortcode_blog' ) ) {
	function jas_shortcode_blog( $atts, $content = null ) {
		$output = '';

		extract( shortcode_atts( array(
			'id'            => '',
			'style'         => 'outside',
			'columns'       => 4,
			'limit'         => 3,
			'slider'        => '',
			'autoplay'      => '',
			'arrows'        => '',
			'dots'          => '',
			'css_animation' => '',
			'class'         => '',
		), $atts ) );

		$classes = array( 'jas-sc-blog ' . $class );

		$row = 'jas-row';

		if ( '' !== $css_animation ) {
			wp_enqueue_script( 'waypoints' );
			$classes[] = 'wpb_animate_when_almost_visible wpb_' . $css_animation;
		}

		$args = array(
			'post_type'              => 'post',
			'posts_per_page'         => $limit,
			'no_found_rows'          => true,
			'post_status'            => 'publish',
			'cache_results'          => false,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => true,
		);

		if ( $id !== '' )
			$args['post__in'] = explode( ',', $id );

		$query = new WP_Query( $args );

		$attr = array();

		if ( $slider ) {
			if ( $columns == '6' ) {
				$attr_slider[] = '"slidesToShow": 2';
			} elseif ( $columns == '4' ) {
				$attr_slider[] = '"slidesToShow": 3';
			} else {
				$attr_slider[] = '"slidesToShow": 4';
			}
			if ( ! empty( $autoplay ) ) {
				$attr_slider[] = '"autoplay": true';
			}
			if ( ! empty( $arrows ) ) {
				$attr_slider[] = '"arrows": true';
			}
			if ( ! empty( $dots ) ) {
				$attr_slider[] = '"dots": true';
			}
			if ( ! empty( $attr_slider ) ) {
				$attr[] = 'data-slick=\'{' . esc_attr( implode( ', ', $attr_slider ) ) . ',"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]' .'}\'';
			}
			$row = 'jas-carousel';
			$columns = 12;
		}

		$output .= '<div class="' . implode( ' ', $classes ) . '">';
			if ( $style == 'outside' ) {
				$output .= '<div class="' . esc_attr( $row ) . '" ' . implode( ' ', $attr ) . '>';
					while ( $query->have_posts() ) {
						$query->the_post();

						$output .= '<div class="jas-col-md-' . esc_attr( $columns ) . ' jas-col-sm-4 jas-col-xs-12 mb__40">';
							$output .= '<article class="' . implode( ' ', get_post_class() ) . '">';
								if ( has_post_thumbnail() ) {
									$url   = get_the_post_thumbnail_url();
									$image = aq_resize( $url, 570, 420, true );
									$output .= '<a class="mb__20 db" href="' . esc_url( get_permalink() ) . '"><img src="' . esc_url( $image ) . '" width="570" height="420" alt="' . get_the_title() . '" /></a>';
								}
								$output .= '<div class="post-info mb__10">';
									$output .= '<h4 class="mg__0 fs__16 mb__5"><a class="cd chp" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h4>';
									$output .= '<span class="post-author mr__5">' . __( 'By ', 'jsa' ) . '<span class="cp">' . get_the_author() . '</span></span>';
									$output .= '<span class="post-time">' . __( 'on ', 'jsa' ) . '<span class="cp">' . get_the_time( 'M j' ) . '</span></span>';
								$output .= '</div>';

								$output .= '<p>' . do_shortcode( wp_trim_words( get_the_content(), 15, '...' ) ) . '</p>';
							$output .= '</article>';
						$output .= '</div>';
					}
				$output .= '</div>';
			} else {
				$output .= '<div class="jas-blog-slider ' . esc_attr( $row ) . '" ' . implode( ' ', $attr ) . '>';
					while ( $query->have_posts() ) {
						$query->the_post();

						$output .= '<div class="jas-col-md-' . esc_attr( $columns ) . ' jas-col-sm-4 jas-col-xs-12 mb__40">';
							$output .= '<div class="post-thumbnail pr">';
								$output .= '<a href="' . esc_url( get_permalink() ) . '">';
									if ( has_post_thumbnail() ) :
										$url   = get_the_post_thumbnail_url();
										$image = aq_resize( $url, 480, 310, true );
										if ( ! empty( $url ) ) {
											$size  = getimagesize( $url );
										}
										if ( $size[0] > 479 && $size[1] > 309 ) {
											$output .= '<img src="' . esc_url( $image ) . '" width="480" height="310" alt="' . get_the_title() . '" />';
										} else {
											$output .= '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.png" width="480" height="310" alt="' . get_the_title() . '" />';
										}
									else :
										$output .= '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.png" width="480" height="310" alt="' . get_the_title() . '" />';
									endif;
								$output .= '</a>';
								$output .= '<div class="pa tc cg w__100">';
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
									$output .= sprintf( '<h2 class="post-title fs__14 ls__2 mt__10 mb__5 tu"><a class="chp" href="%2$s" rel="bookmark">%1$s</a></h2>', get_the_title(), esc_url( get_permalink() ) );
									$time = '<a class="cg" href="%3$s"><time class="entry-date published updated" datetime="%1$s">%2$s</time></a>';

									$output .= sprintf( $time,
										esc_attr( get_the_date( 'c' ) ),
										esc_html( get_the_date() ),
										esc_url( get_permalink() )
									);
								$output .= '</div>';
							$output .= '</div>';	
						$output .= '</div>';
					}
				$output .= '</div>';
			}
		$output .= '</div>';

		wp_reset_postdata();

		// Return output
		return apply_filters( 'jas_shortcode_blog', force_balance_tags( $output ) );
	}
}