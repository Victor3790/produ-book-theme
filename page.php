<?php
/**
 * Template for the single book custom type.
 *
 * @package WordPress
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<?php get_header(); ?>
<!-- Page content-->
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-8">
			<?php

			if ( have_posts() ) {

				while ( have_posts() ) {

					the_post();

					get_template_part( 'template-parts/content', 'page' );

				}
			}

			?>
		</div>
		<!-- Side widgets-->
		<div class="col-lg-4">

			<?php get_search_form(); ?>

			<?php get_template_part( 'template-parts/categories', 'post' ); ?>

			<?php get_template_part( 'template-parts/categories', 'book' ); ?>

		</div>
	</div>
</div>
<?php get_footer(); ?>
