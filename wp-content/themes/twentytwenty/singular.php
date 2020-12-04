<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<main id="site-content" role="main">
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>
<button onclick="open_mercury_form()" style="margin: 0 40%;">Download</button>	
<div id='idg-widget-container' style='width: 40%; margin: 0 auto;display: none;'>&nbsp;</div>
<br /><br /><br />
</main><!-- #site-content -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src='https://register-qa.idgcommunications.net/js/script.js'" type="text/javascript"></script>
<script>
var $ = jQuery.noConflict();
</script>
<script type = "text/javascript" charset = "utf-8" >
	var baseUrl = 'https://register-qa.idgcommunications.net/';
function open_mercury_form(){
	$("#idg-widget-container").show();
}	
//	jQuery(document).ready(function(){
//  alert('test');
//});
 </script>
<?php // get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer();
 the_field('widget'); ?>
