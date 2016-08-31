<?php
/**
 * Class for adding custom widget area and choose them on single pages/posts/portfolios
 *
 * @since   1.0.0
 * @package Gecko
 */

class JAS_Gecko_Sidebar {
	/**
	 * Initialize pluggable functions.
	 *
	 * @return  void
	 */
	public function __construct() {
		// Register Ajax actions to add and remove custom sidebar.
		add_action( 'wp_ajax_gecko_add_sidebar'   , array( __CLASS__, 'add'    ) );
		add_action( 'wp_ajax_gecko_remove_sidebar', array( __CLASS__, 'remove' ) );

		// Register necessary actions to manage custom sidebars.
		add_action( 'init'              , array( __CLASS__, 'init'    ) );
		add_action( 'sidebar_admin_page', array( __CLASS__, 'manage'  ) );
	}

	/**
	 * Add a custom sidebar.
	 *
	 * @return  array
	 */
	public static function add() {
		// Verify request variables.
		$name     = isset( $_REQUEST['name'    ] ) ? sanitize_text_field( $_REQUEST['name'    ] ) : null;
		$nonce    = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

		if ( empty( $name ) ) {
			wp_send_json_error( esc_html__( 'Missing sidebar name.', 'gecko' ) );
		} elseif ( empty( $nonce ) ) {
			wp_send_json_error( esc_html__( 'Invalid request.', 'gecko' ) );
		}

		// Verify nonce.
		if ( ! wp_verify_nonce( $nonce, 'gecko_add_sidebar' ) ) {
			wp_send_json_error( esc_html__( 'Nonce verification fails.', 'gecko' ) );
		}

		// Get all custom sidebars.
		$sidebars = get_option( 'gecko_custom_sidebars', array() );

		// Get the last sidebar ID from the database.
		$sidebar_num = get_option( 'gecko_custom_sidebars_last_id', -1 );

		if ( $sidebar_num < 0 ) {
			// Backward compatibility for existing sidebars.
			if ( is_array( $sidebars ) ) {
				$sidebar_num = ( int ) end( explode( '-', end( array_keys( $sidebars ) ) ) );
			}

			else {
				$sidebar_num = 0;
			}
		}

		// Increase the the number of sidebar and save.
		update_option( 'gecko_custom_sidebars_last_id', ++$sidebar_num );

		// Update custom sidebars.
		$sidebars[ 'gecko-sidebar-' . $sidebar_num ] = array(
			'id'             => 'gecko-sidebar-' . $sidebar_num,
			'name'           => esc_sql( $name ),
			'class'          => 'gecko-custom',
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h3 class="widget-title">',
			'after_title'    => '</h3>',
		);

		update_option( 'gecko_custom_sidebars', $sidebars );

		// Generate HTML code for the new sidebar box then return.
		if ( ! function_exists( 'wp_list_widget_controls' ) ) {
			include_once ABSPATH . 'wp-admin/includes/widgets.php';
		}

		ob_start();
		?>
		<div class="widgets-holder-wrap sidebar-gecko-custom closed">
			<?php wp_list_widget_controls( 'gecko-sidebar-' . $sidebar_num, $name ); ?>
		</div>
		<?php
		wp_send_json_success( ob_get_clean() );
	}

	/**
	 * Remove a custom sidebar.
	 *
	 * @return  array
	 */
	public static function remove() {
		// Verify request variables.
		$id    = isset( $_REQUEST['id'      ] ) ? sanitize_text_field( $_REQUEST['id'      ] ) : null;
		$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

		if ( empty( $id ) ) {
			wp_send_json_error( esc_html__( 'Missing sidebar ID.', 'gecko' ) );
		} elseif ( empty( $nonce ) ) {
			wp_send_json_error( esc_html__( 'Invalid request.', 'gecko' ) );
		}

		// Verify nonce.
		if ( ! wp_verify_nonce( $nonce, 'gecko_remove_sidebar' ) ) {
			wp_send_json_error( esc_html__( 'Nonce verification fails.', 'gecko' ) );
		}

		// Get all custom sidebars.
		$sidebars = get_option( 'gecko_custom_sidebars', array() );

		// Remove the custom sidebar specified.
		unset( $sidebars[ $id ] );

		update_option( 'gecko_custom_sidebars', $sidebars );

		wp_send_json_success();
	}

	/**
	 * Register sidebars.
	 *
	 * @return  void
	 */
	public static function init() {
		// Get all sidebars.
		$sidebars = get_option( 'gecko_custom_sidebars' );

		if ( is_array( $sidebars ) ) {
			foreach ( $sidebars as $id => $sidebar ) {
				// Add ID parameter if missing.
				if ( ! isset( $sidebar['id'] ) ) {
					$sidebar['id'] = $id;
				}

				register_sidebar( $sidebar );
			}
		}
	}

	/**
	 * Print HTML code to manage custom sidebars.
	 *
	 * @return  void
	 */
	public static function manage() {
		global $wp_registered_sidebars;
		?>
		<div class="widgets-holder-wrap">
			<div id="jas-add-custom-sidebar" class="widgets-sortables">
				<div class="sidebar-name">
					<div class="sidebar-name-arrow"><br></div>
					<h2>
						<?php esc_html_e( 'Add New Sidebar', 'gecko' ); ?>
						<span class="spinner"></span>
					</h2>
				</div>
				<div class="sidebar-description">
					<form class="description" method="POST" action="<?php
						echo esc_url( admin_url( 'admin-ajax.php?action=gecko_add_sidebar' ) );
					?>">
						<?php wp_nonce_field( 'gecko_add_sidebar' ); ?>
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><?php esc_html_e( 'Name', 'gecko' ) ?></th>
								<td>
									<input type="text" class="text" name="name" value="">
								</td>
								<td>
									<input type="submit" class="button-primary" value="<?php esc_html_e( 'Add', 'gecko' ) ?>">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				// Move the form to add new custom sidebar to the top of the first sidebars column.
				$('#jas-add-custom-sidebar').parent().prependTo($('#widgets-right .sidebars-column-1'));

				// Init custom sidebars.
				function jas_init_custom_sidebars() {
					// Define function to re-arrange sidebar columns.
					function jas_rearrange_columns() {
						// Get sidebar columns.
						var	left = $('#wpbody-content > .wrap #widgets-right .sidebars-column-1'),
							right = $('#wpbody-content > .wrap #widgets-right .sidebars-column-2');

						if (left.children().length - right.children().length > 2) {
							// Move sidebar at the bottom of left column to the top of right column.
							$('#wpbody-content > .wrap #widgets-right .sidebars-column-1').children().last()
								.prependTo($('#wpbody-content > .wrap #widgets-right .sidebars-column-2'));
						} else if (right.children().length >= left.children().length) {
							// Move sidebar at the top of right column to the bottom of left column.
							$('#wpbody-content > .wrap #widgets-right .sidebars-column-2').children().first()
								.appendTo($('#wpbody-content > .wrap #widgets-right .sidebars-column-1'));
						}
					}

					// Setup action to add new custom sidebar.
					$('#jas-add-custom-sidebar form').submit(function(event) {
						event.preventDefault();

						// Disable submit button.
						$(this).find('input[type="submit"]').attr('disabled', 'disabled');

						// Show processing icon.
						$(this).closest('#jas-add-custom-sidebar').find('.spinner').addClass('is-active');

						// Send Ajax request to add new custom sidebar.
						$.ajax({
							context: this,
							url: $(this).attr('action'),
							type: $(this).attr('method'),
							dataType: 'json',
							data: $(this).serializeArray(),
							complete: function(response) {
								// Hide processing icon.
								$(this).closest('#jas-add-custom-sidebar').find('.spinner').removeClass('is-active');

								// Enable submit button.
								$(this).find('input[type="submit"]').removeAttr('disabled');

								if ( ! response || ! response.responseJSON || ! response.responseJSON.success) {
									// Show error message.
									if (response && response.responseJSON && response.responseJSON.data) {
										alert(response.responseJSON.data);
									} else {
										alert('<?php esc_html_e( 'Adding custom sidebar fails.', 'gecko' ); ?>');
									}
								} else {
									// Update HTML backup.
									jas_init_custom_sidebars.html_backup = $('#wpbody-content > .wrap').clone();

									// Append new sidebar to the bottom of the right column.
									jas_init_custom_sidebars.html_backup
										.find('#widgets-right .sidebars-column-2').append(response.responseJSON.data);

									// Remove widgets toggle event handler.
									$(document.body).unbind('click.widgets-toggle');

									// Reset HTML.
									$('#wpbody-content > .wrap').replaceWith(jas_init_custom_sidebars.html_backup.clone());

									setTimeout(function() {
										// Re-init interaction.
										wpWidgets.init();
										jas_init_custom_sidebars();

										// Re-arrange columns.
										jas_rearrange_columns();
									}, 200);
								}
							},
						});
					});

					// Setup action to remove custom sidebar.
					$('#widgets-right .sidebar-gecko-custom .sidebar-name h2').on('click', '.jas-remove-custom-sidebar', function(event) {
						event.preventDefault();
						event.stopPropagation();

						if (confirm('<?php esc_html_e( 'Are you sure you want to remove this custom sidebar?', 'gecko' ); ?>')) {
							// Toggle precessing state.
							$(this).addClass('hidden').next('.spinner').addClass('is-active');

							// Send Ajax request to remove custom sidebar.
							$.ajax({
								context: this,
								url: '<?php echo esc_url( admin_url( 'admin-ajax.php?action=gecko_remove_sidebar' ) ); ?>',
								dataType: 'json',
								data: {
									id: $(this).closest('.widgets-sortables').attr('id'),
									_wpnonce: '<?php echo wp_create_nonce( 'gecko_remove_sidebar' ); ?>',
								},
								complete: function(response) {
									if ( ! response || ! response.responseJSON || ! response.responseJSON.success) {
										// Show error message.
										if (response && response.responseJSON && response.responseJSON.data) {
											alert(response.responseJSON.data);
										} else {
											alert('<?php esc_html_e( 'Removing custom sidebar fails.', 'gecko' ); ?>');
										}

										// Toggle precessing state.
										$(this).removeClass('hidden').next('.spinner').removeClass('is-active');
									} else {
										// Remove sidebar box in Widgets screen.
										$(this).closest('.sidebar-gecko-custom').remove();

										// Re-arrange columns.
										jas_rearrange_columns();
									}
								},
							});
						}
					}).children('.spinner').each(function() {
						if ( ! $(this).prev('.jas-remove-custom-sidebar').length) {
							$(this).before('<a class="jas-remove-custom-sidebar" href="#">x</a>');
						}
					});
				}

				$(document).ready(function() {
					// Init custom sidebars.
					jas_init_custom_sidebars();
				});
			});
		</script>
		<?php
	}
}
$sidebar = new JAS_Gecko_Sidebar;