<style>
	.currencies-list table,
	.currencies-list table td {
		border-collapse: collapse;
	}
	.currencies-list table thead {
		background-color: #4d5959;
		color: #fff;
	}
	.currencies-list table thead th {
		padding: 20px;
		border: 1px solid rgba(0,0,0,.1);
	}
	.currencies-list table tbody tr td {
	   text-align: center;
	   padding: 15px;
	   background: #fff;
	   border: 1px solid rgba(0,0,0,.1);
	}
	.currencies-list table tbody tr td a {
		text-decoration: none;
	}
	.currencies-list table tfoot {
		background-color: #f8f8f8;
	}
	.currencies-list table tfoot td {
		padding: 15px;
		border: 1px solid rgba(0,0,0,.1);
	}
	#dialog ul li {
		width: 100%;
		float: left;
	}
	#dialog .frm-label {
		float: left;
		min-width: 160px;
	}
	#dialog .frm-input {
		float: left;
	}
	.wp-core-ui .button, .wp-core-ui .button-secondary {
		border-radius: 5px;
		height: 34px;
		line-height: 32px;
		box-shadow: none;
		margin-left: 10px;
		padding: 0 20px;
	}
	.wp-core-ui .button.button-primary {
		border: none;
	}
</style>
<div class="currencies-container">
	<h2><?php _e( 'All Currencies', 'jsa' ); ?></h2>
	<div class="currencies-list">
		<?php $default = JAS_Addons_Currency::woo_currency(); ?>
		<table>
			<thead>
				<tr>
					<th><?php _e( 'Currency', 'jsa' ); ?></th>
					<th><?php _e( 'Currency Position', 'jsa' ); ?></th>
					<th><?php _e( 'Thousand Separator', 'jsa' ); ?></th>
					<th><?php _e( 'Decimal Separator', 'jsa' ); ?></th>
					<th><?php _e( 'Number of Decimals', 'jsa' ); ?></th>
					<th><?php printf( __( 'Exchange Rate(In %s)', 'jsa' ), $default['currency'] ); ?></th>
					<th><?php _e( 'Action', 'jsa' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr class="tr-not-found">
					<td colspan="7"><p style="text-align: center"> <?php _e( 'No currency found ...', 'jsa' ); ?> </p></td>
				</tr>
			</tbody>
			<tfoot>
			<tr class="currencies-list-footer">
				<td colspan="7">
					<div class="currency-action" style="text-align: right;">
						<a class="button button-secondary" id="update-currency-rate" href="javascript:void(0);"><?php _e( 'Update Rate', 'jsa' ); ?></a>
						<a class="button button-primary" id="add-new-currency" href="javascript:void(0);"><?php _e( 'New Currency', 'jsa' ); ?></a>
					</div>
				</td>
			</tr>
			</tfoot>
		</table>
	</div>
</div>
<div id="dialog" title="<?php _e( 'New Currency', 'jsa' ); ?>" style="display: none;">
	<?php
		$currency_code_options = get_woocommerce_currencies();

		foreach ( $currency_code_options as $code => $name ) {
			$currency_code_options[ $code ] = $name . '(' . get_woocommerce_currency_symbol( $code ) . ')';
		}
	?>
	<form id="currency-form">
		<input type="hidden" name="action" value="save-currency"/>
		<ul>
			<li>
				<div class="frm-label"><?php _e( 'Currency', 'jsa' ); ?></div>
				<div class="frm-input">
					<select name="currency">
						<?php foreach( $currency_code_options as $code => $name): ?>
							<option value="<?php echo esc_attr( $code ); ?>"><?php echo esc_html( $name ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</li>
			<li>
				<div class="frm-label"><?php _e( 'Currency Position', 'jsa' ); ?></div>
				<div class="frm-input">
					<select name="woocommerce_currency_pos" id="woocommerce_currency_pos"  class="wc-enhanced-select enhanced" tabindex="-1" title="Currency Position">
						<option value="left" selected="selected"><?php _e( 'Left ($99.99)', 'jsa' ); ?></option>
						<option value="right"><?php _e( 'Right (99.99$)', 'jsa' ); ?></option>
						<option value="left_space"><?php _e( 'Left with space ($ 99.99)', 'jsa' ); ?></option>
						<option value="right_space"><?php _e( 'Right with space (99.99 $)', 'jsa' ); ?></option>
					</select>
				</div>
			</li>
			<li>
				<div class="frm-label"><?php _e( 'Thousand Separator', 'jsa' ); ?></div>
				<div class="frm-input"><input name="woocommerce_price_thousand_sep" id="woocommerce_price_thousand_sep" type="text" style="width:50px;" value="," class="" placeholder=""></div>
			</li>
			<li>
				<div class="frm-label"><?php _e( 'Decimal Separator', 'jsa' ); ?></div>
				<div class="frm-input"><input name="woocommerce_price_decimal_sep" id="woocommerce_price_decimal_sep" type="text" style="width:50px;" value="." class="" placeholder=""></div>
			</li>
			<li>
				<div class="frm-label"><?php _e( 'Number of Decimals', 'jsa' ); ?></div>
				<div class="frm-input"><input name="woocommerce_price_num_decimals" id="woocommerce_price_num_decimals" type="number" style="width:50px;" value="2" class="" placeholder="" min="0" step="1"></div>
			</li>
			<li>
				<div class="frm-label"><?php _e( 'Exchange Rate', 'jsa' ); ?></div>
				<div class="frm-input"><input name="woocommerce_price_rate" id="woocommerce_price_num_decimals" type="text" style="width:100px;" value="1" class="" placeholder="" min="0" step="1"></div>
			</li>
			<li style="text-align: right;">
			   <input type="submit" id="currency-submit" value="<?php _e( 'Save', 'jsa' ); ?>">
			</li>
		</ul>
	</form>
</div>
<script>
	( function( $ ) {
		function loadCurrency() {
			$.ajax({
				url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
				type:'post',
				data: { action:'list-currency' },
				success:function( data ) {
					if( data.length > 5 ) {
						$( 'tr#tr-not-found' ).remove();
						$( '.currencies-list tbody' ).html( data );
					}
				}
			});
		}

		$(function() {
			loadCurrency();
			$( '#add-new-currency' ).click(function() {
				$( "#dialog" ).dialog({
					modal: true,
					minWidth: 500
				});
			});

			$( 'body' ).on( 'submit', '#currency-form',function( event ) {
				event.preventDefault();
				$.ajax({
					url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
					type:'post',
					data: $( 'form#currency-form' ).serialize(),
					dataType: 'json',
					success:function( data ) {
						if ( data.result == 0 ) {
							alert( 'Your data is incorrect. Please check it again.' );
						} else {
							$( '#dialog' ).dialog( 'close' );
							loadCurrency();
						}
					}
				});
			});

			$( 'body' ).on( 'click', '.remove-currency', function() {
				var currency = $(this).data( 'currency' );
				if ( confirm( 'are you sure ?' ) ) {
					$.ajax({
						url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
						type:'post',
						data: { action:'remove-currency', code: currency },
						dataType: 'json',
						success:function(data){
							loadCurrency();
						}
					});
				}
			});

			$( '#update-currency-rate' ).click( function() {
				if ( confirm( 'Are you sure ?' ) ) {
					$.ajax({
						url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
						type:'post',
						data: {action:'update-currency-rate'},
						dataType: 'json',
						success:function( data ) {
							loadCurrency();
							alert( 'Done' );
						}
					});
				}
			});
		});
	} )( jQuery );
</script>