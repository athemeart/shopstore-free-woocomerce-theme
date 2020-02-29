/*
    * responsiveMenu
    * responsiveMenuMega
    * searchButton
  
**/

;(function($) {

   'use strict'
        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        }; // is Mobile

       
		var back_to_top_scroll = function() {
			
			$('#backToTop').on('click', function() {
				$("html, body").animate({ scrollTop: 0 }, 500);
				return false;
			});
			
			$(window).scroll(function() {
				if ( $(this).scrollTop() > 100 ) {
					
					$('#backToTop').addClass('active');
				} else {
				  
					$('#backToTop').removeClass('active');
				}
				
			});
			
		}; // Responsive Menu   
		
         
    // Dom Ready
    $(function() {
		
        back_to_top_scroll();
       
		if( $(".rd-navbar").length){
			$('.rd-navbar').RDNavbar({
				stickUpClone: false,
                stickUpOffset: 220
				
			});
			
		}
		if( $('.woocommerce-ordering .orderby').length ){
			$('.woocommerce-ordering .orderby').customSelect();
		}
		if( $('.owlGallery,.gallery-media ul.wp-block-gallery').length ){
			$(".owlGallery,.gallery-media ul.wp-block-gallery").owlCarousel({
				
				stagePadding: 0,
				loop: true,
				autoplay: true,
				autoplayTimeout: 2000,
				margin: 10,
				nav: false,
				dots: false,
				smartSpeed: 2000,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 1
					},
					1000: {
						items: 1
					}
				}
			});
		}
       
		   /* -- image-popup */
				if( $('.image-popup').length ){
					 $('.image-popup').magnificPopup({
						closeBtnInside : true,
						type           : 'image',
						mainClass      : 'mfp-with-zoom'
					});
				}
				
				if( $('.rd-navbar-static .rd-navbar-nav li > a').length ){
				$( ".rd-navbar-static .rd-navbar-nav li > a" ).keyup(function() {
					
					$(this).parent('li').prev('li').removeClass('focus');	
					
					if( $(this).parents('li.rd-navbar-submenu').length ){
						$(this).parent('li').addClass('focus');
					}
					
				});
				}
				if( $('.rd-navbar-fixed .rd-navbar-nav li > a').length ){
				$( ".rd-navbar-fixed .rd-navbar-nav li > a" ).keyup(function() {
					
					$(this).parent('li').prev('li').removeClass('opened');	
					
					if( $(this).parents('li.rd-navbar-submenu').length ){
					
						$(this).parent('li').addClass('opened');
					}
					
				});
				}
				
				$( ".rd-navbar-toggle.toggle-original" ).keyup(function() {
				$(this).addClass('active');
				$('.rd-navbar-nav-wrap.toggle-original-elements').addClass('active');
				});
				
				$('#static_header_banner,#content').on('keydown', function(event) {
				
				$('.rd-navbar-static .rd-navbar-nav li.menu-item-has-children').removeClass('opened').removeClass('focus');
				$('.rd-navbar-toggle.toggle-original').removeClass('active');
				$('.rd-navbar-nav-wrap.toggle-original-elements').removeClass('active');
				
				});
    });

})(jQuery);