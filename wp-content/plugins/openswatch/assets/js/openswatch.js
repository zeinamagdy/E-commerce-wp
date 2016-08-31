/**
 * Created by Vu Anh on 8/26/2015.
 */
(function($) {
    "use strict";
    $(document).ready(function(){
        $('select.openswatch-filters').change(function(){
            $(this).closest('form').submit();
        });
        //price filter
        $('select#price_range').on('change',function(){
            var $form = $(this).closest('form');
            var val = $(this).val();
            if(val != '')
            {
                var tmp = val.split(',');
                if(tmp.length == 2)
                {
                    $('input[name="min_price"]').val(tmp[0]);
                    $('input[name="max_price"]').val(tmp[1]);
                }
            }

            $form.trigger('submit');
        });

        // colorswatch on list
        $('body').on( 'click', '.product-list-color-swatch a', function() {
            var src = $( this ).data( 'thumb' );
            if ( src != '' ) {
                $( this ).closest( 'div.product' ).find( 'img' ).removeAttr( 'srcset' ).attr( 'src', src );
            }
        });
        $( 'body' ).on( 'mouseenter', '.product-list-color-swatch a', function() {
            $( this ).closest( 'div.product' ).addClass( 'hidden-mask');
        }).on( 'mouseleave', '.product-list-color-swatch a', function() {
            $( this ).closest( 'div.product' ).removeClass( 'hidden-mask');
        });
    })
} )( jQuery );