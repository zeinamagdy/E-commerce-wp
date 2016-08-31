<?php
/**
 * Portfolio custom post type.
 *
 * @package JASAddons
 * @since   1.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

class JAS_Addons_Portfolio {
	/**
	 * Construct function.
	 *
	 * @return  void
	 */
	function __construct() {
		add_action( 'init', array( __CLASS__, 'portfolio_init' ) );

		add_filter( 'single_template', array( $this, 'portfolio_single' ) );
		add_filter( 'archive_template', array( $this, 'portfolio_archive' ) );
	}

	/**
	 * Register a portfolio post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public static function portfolio_init() {
		register_post_type( 'portfolio',
			array(
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'portfolio' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 99,
				'menu_icon'          => 'dashicons-welcome-widgets-menus',
				'supports'           => array( 'title', 'editor', 'thumbnail' ),
				'labels'             => array(
					'name'               => _x( 'Portfolio', 'jsa' ),
					'singular_name'      => _x( 'Portfolio', 'jsa' ),
					'menu_name'          => _x( 'Portfolio', 'jsa' ),
					'name_admin_bar'     => _x( 'Portfolio', 'jsa' ),
					'add_new'            => _x( 'Add New', 'jsa' ),
					'add_new_item'       => __( 'Add New Portfolio', 'jsa' ),
					'new_item'           => __( 'New Portfolio', 'jsa' ),
					'edit_item'          => __( 'Edit Portfolio', 'jsa' ),
					'view_item'          => __( 'View Portfolio', 'jsa' ),
					'all_items'          => __( 'All Portfolios', 'jsa' ),
					'search_items'       => __( 'Search Portfolios', 'jsa' ),
					'parent_item_colon'  => __( 'Parent Portfolios:', 'jsa' ),
					'not_found'          => __( 'No portfolios found.', 'jsa' ),
					'not_found_in_trash' => __( 'No portfolios found in Trash.', 'jsa' )
				),
			)
		);

		// Register portfolio category
		register_taxonomy( 'portfolio_cat',
			array( 'portfolio' ),
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'portfolio_cat' ),
				'labels'            => array(
					'name'              => _x( 'Categories', 'jsa' ),
					'singular_name'     => _x( 'Category', 'jsa' ),
					'search_items'      => __( 'Search Categories', 'jsa' ),
					'all_items'         => __( 'All Categories', 'jsa' ),
					'parent_item'       => __( 'Parent Category', 'jsa' ),
					'parent_item_colon' => __( 'Parent Category:', 'jsa' ),
					'edit_item'         => __( 'Edit Category', 'jsa' ),
					'update_item'       => __( 'Update Category', 'jsa' ),
					'add_new_item'      => __( 'Add New Category', 'jsa' ),
					'new_item_name'     => __( 'New Category Name', 'jsa' ),
					'menu_name'         => __( 'Categories', 'jsa' ),
				),
			)
		);

		// Register portfolio project client
		register_taxonomy( 'portfolio_client',
			'portfolio',
			array(
				'hierarchical'          => true,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'portfolio_client' ),
				'labels'                => array(
					'name'                       => _x( 'Clients', 'jsa' ),
					'singular_name'              => _x( 'Client', 'jsa' ),
					'search_items'               => __( 'Search Clients', 'jsa' ),
					'all_items'                  => __( 'All Clients', 'jsa' ),
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => __( 'Edit Client', 'jsa' ),
					'update_item'                => __( 'Update Client', 'jsa' ),
					'add_new_item'               => __( 'Add New Client', 'jsa' ),
					'new_item_name'              => __( 'New Client Name', 'jsa' ),
					'separate_items_with_commas' => __( 'Separate writers with commas', 'jsa' ),
					'add_or_remove_items'        => __( 'Add or remove writers', 'jsa' ),
					'choose_from_most_used'      => __( 'Choose from the most used writers', 'jsa' ),
					'not_found'                  => __( 'No writers found.', 'jsa' ),
					'menu_name'                  => __( 'Clients', 'jsa' ),
				),
			)
		);

		// Register portfolio tag
		register_taxonomy( 'portfolio_tag',
			'portfolio',
			array(
				'hierarchical'          => false,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'portfolio_tag' ),
				'labels'                => array(
					'name'                       => _x( 'Tags', 'jsa' ),
					'singular_name'              => _x( 'Tag', 'jsa' ),
					'search_items'               => __( 'Search Tags', 'jsa' ),
					'popular_items'              => __( 'Popular Tags', 'jsa' ),
					'all_items'                  => __( 'All Tags', 'jsa' ),
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => __( 'Edit Tag', 'jsa' ),
					'update_item'                => __( 'Update Tag', 'jsa' ),
					'add_new_item'               => __( 'Add New Tag', 'jsa' ),
					'new_item_name'              => __( 'New Tag Name', 'jsa' ),
					'separate_items_with_commas' => __( 'Separate writers with commas', 'jsa' ),
					'add_or_remove_items'        => __( 'Add or remove writers', 'jsa' ),
					'choose_from_most_used'      => __( 'Choose from the most used writers', 'jsa' ),
					'not_found'                  => __( 'No writers found.', 'jsa' ),
					'menu_name'                  => __( 'Tags', 'jsa' ),
				),
			)
		);
	}

	/**
	 * Load single item template file for the portfolio custom post type.
	 *
	 * @param   string  $template  Current template file.
	 *
	 * @return  string
	 */
	function portfolio_single( $template ) {
		global $post;

		if ( $post->post_type == 'portfolio' ) {
			$template = JAS_ADDONS_PATH . 'includes/portfolio/views/single.php';
		}

		return $template;
	}

	/**
	 * Load archive template file for the portfolio custom post type.
	 *
	 * @param   string  $template  Current template file.
	 *
	 * @return  string
	 */
	function portfolio_archive( $template ) {
		global $post;

		if ( isset( $post->post_type ) && $post->post_type == 'portfolio' ) {
			$template = JAS_ADDONS_PATH . 'includes/portfolio/views/archive.php';
		}

		return $template;
	}

	/**
	 * Define helper function to print related portfolio.
	 *
	 * @return  array
	 */
	public static function related() {
		global $post;

		// Get the portfolio tags.
		$tags = get_the_terms( $post, 'portfolio_tag' );

		if ( $tags ) {
			$tag_ids = array();

			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}

			$args = array(
				'post_type'      => 'portfolio',
				'post__not_in'   => array( $post->ID ),
				'posts_per_page' => -1,
				'tax_query'      => array(
					array(
						'taxonomy' => 'portfolio_tag',
						'field'    => 'id',
						'terms'    => $tag_ids,
					),
				)
			);

			// Get portfolio category
			$categories = wp_get_post_terms( get_the_ID(), 'portfolio_cat' );

			$the_query = new WP_Query( $args );
			?>
			<div class="jas-container mb__60">
				<h4 class="mg__0 mb__30 tu tc fwb"><?php echo esc_html__( 'Related Portfolio', 'gecko' ); ?></h4>
				<div class="jas-carousel" data-slick='{"slidesToShow": 3,"slidesToScroll": 1,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<figure id="portfolio-<?php the_ID(); ?>" class="portfolio-item pl__10 pr__10 pr">
							<a href="<?php the_permalink(); ?>" class="mask db pr chp">
								<?php
									if ( has_post_thumbnail() ) :
										the_post_thumbnail();
									endif;
								?>
							</a>
							<figcaption class="pa tc ts__03">
								<h4 class="fs__14 tu mg__0"><a class="cd chp" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<?php
									if ( $categories ) {
										echo '<span>' . get_the_term_list( $post->ID, 'portfolio_cat', '', ', ' ) . '</span>';
									}
								?>
							</figcaption>
						</figure>
					<?php endwhile; ?>
				</div>
			</div>
		<?php
		}

		wp_reset_postdata();
	}
}
$portfolio = new JAS_Addons_Portfolio;