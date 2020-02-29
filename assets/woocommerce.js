/*
* woocommerce
**/

;(function($) {
	'use strict'
	// Dom Ready
	$(function() {
		
		// When variable price is selected by default
                setTimeout( function(){
                    if( 0 < $('input.variation_id').val() && null != $('input.variation_id').val() ){
                        if($('.status-product').length){
                          $('.shopstore_variable_product_status').find('.status-product').remove();	
						}

                        $('.shopstore_variable_price').html($('div.woocommerce-variation-price > span.price').html());
						$('.shopstore_variable_price').next().append($('div.woocommerce-variation-availability').html());
                       
                    }
                }, 300 );

                // On live variation selection
                $('.variations select').blur( function(){
                    if( 0 < $('input.variation_id').val() && null != $('input.variation_id').val() ){
                        if($('.status-product') || $('.status-product p.stock') ){
							$('.shopstore_variable_product_status').find('.status-product').remove();	
						}
                            
                        $('.shopstore_variable_price').html($('div.woocommerce-variation-price > span.price').html());
						$('.shopstore_variable_price').next().append($('div.woocommerce-variation-availability').html());
                        
                    } else {
                        $('.shopstore_variable_price').html($('div.hidden-variable-price').html());
                        if($('.status-product').length){
                            $('.shopstore_variable_product_status').find('.status-product').remove();	
						}
                       
                    }
                });
	 
	 /* ============== Quantity buttons ============== */
		//$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<button type="button" class="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>' ).prepend( '<button type="button" class="minus"><i class="fa fa-minus" aria-hidden="true"></i></button>' );
		
		// Target quantity inputs on product pages
		$( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
			var min = parseFloat( $( this ).attr( 'min' ) );
		
			if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
				$( this ).val( min );
			}
		});
		
		$( document ).on( 'click', '.plus, .minus', function() {
		
			// Get values
			var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
				currentVal  = parseFloat( $qty.val() ),
				max         = parseFloat( $qty.attr( 'max' ) ),
				min         = parseFloat( $qty.attr( 'min' ) ),
				step        = $qty.attr( 'step' );
		
			// Format values
			if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
			if ( max === '' || max === 'NaN' ) max = '';
			if ( min === '' || min === 'NaN' ) min = 0;
			if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;
		
			// Change the value
			if ( $( this ).is( '.plus' ) ) {
		
				if ( max && ( max == currentVal || currentVal > max ) ) {
					$qty.val( max );
				} else {
					$qty.val( currentVal + parseFloat( step ) );
				}
		
			} else {
		
				if ( min && ( min == currentVal || currentVal < min ) ) {
					$qty.val( min );
				} else if ( currentVal > 0 ) {
					$qty.val( currentVal - parseFloat( step ) );
				}
		
			}
		
			// Trigger change event
			$qty.trigger( 'change' );
		});
	 
	});
})(jQuery);