<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shopstore
 */

?>

		<?php if ( is_active_sidebar( 'footer' ) ) { ?>
		<footer>
			<div class="container">
            	<?php if ( is_active_sidebar( 'footer' ) ) { ?>
                    <div class="row">
                        <?php dynamic_sidebar( 'footer' ); ?>
                    </div>
                <?php }?>
			</div><!-- /.container -->
		</footer><!-- /footer -->
 		<?php }?>
		<section class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<p class="copyright"> <?php
			/* translators: 1: Current Year, 2: Blog Name 3: Theme Developer 4: WordPress. */
		printf( esc_html__( 'Copyright &copy; %1$s %2$s , All Right Reserved. %3$s by aThemeArt - Proudly powered by %4$s', 'shopstore' ), esc_attr( date( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ), '<br/><a href="https://athemeart.com/downloads/shopstore/" title="WordPress store theme" target="_blank" rel="nofollow">Shop Store Theme</a>', '<a href="'.esc_attr( 'https://wordpress.org' ).'" target="_blank" rel="nofollow">'.esc_html_x( 'WordPress', 'credit to cms', 'shopstore' ).'</a>' );
		
	?></p>
    

					</div><!-- /.col-md-12 -->
                    <div class="col-md-5 text-right">
                    
                        <ul class="social-list">
                         <?php if ( get_theme_mod('shopstore_social_profile_link') != "" && count (  get_theme_mod('shopstore_social_profile_link') ) > 0 ) :?>	
                         <?php $social_link = get_theme_mod('shopstore_social_profile_link');?>
                   
						<?php 
						foreach ($social_link['social'] as $key => $link): 
							if( !empty( $link )):
							?>
							<li><a href="<?php echo esc_url( $link );?>" class="fa <?php echo esc_attr($key);?>" target="_blank"></a></li>
							<?php endif; 
                        endforeach;
						?>
                   		 <?php endif;?>
                          
                        </ul>

					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.footer-bottom -->
</div><!-- /.boxed -->

<a href="javascript:void(0)" id="backToTop" class="ui-to-top"><?php echo esc_html__( 'BACK TO TOP', 'shopstore' );?><i class="fa fa-long-arrow-up"></i></a>

<?php wp_footer(); ?>
</body>
</html>
