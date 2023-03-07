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

					get_template_part( 'template-parts/content', 'book' );

				}
			}

			get_template_part( 'template-parts/book-reviews' );

			?>

			<h3 class="my-5">También te puede interesar</h3>
			<div class="row">
			<?php

			$categories    = get_the_terms( $post, 'book_categories' );
			$book_category = $categories[0]->name;

			$args = array(
				'post_type'      => 'books',
				'post__not_in'   => array( $post->ID ),
				'posts_per_page' => 2,
				//phpcs:ignore
				'tax_query' => array(
					array(
						'taxonomy' => 'book_categories',
						'field'    => 'slug',
						'terms'    => $book_category,
					),
				),
			);

			$related_books_query = new WP_Query( $args );

			if ( $related_books_query->have_posts() ) {

				while ( $related_books_query->have_posts() ) {

					$related_books_query->the_post();

					get_template_part( 'template-parts/card', 'book' );

				}
			}

			?>
			</div>
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
