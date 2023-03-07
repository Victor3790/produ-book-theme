<?php
/**
 * Categories template.
 *
 * @package WordPress
 */

?>

<!-- Post content-->
<article>
	<!-- Post header-->
	<header class="mb-4">
		<!-- Post title-->
		<h1 class="fw-bolder mb-1"><?php the_title(); ?></h1>
	</header>
	<div class="row">
		<div class="col-12 col-md-5">
			<!-- Preview image figure-->
			<figure class="mb-4"><?php the_post_thumbnail( 'my_theme_book_feature_image', array( 'class' => 'img-fluid' ) ); ?></figure>
		</div>
		<div class="col-12 col-md-7">
			<!-- Post content-->
			<section class="mb-5">
				<?php the_content(); ?>
			</section>
			<?php if ( function_exists( 'the_field' ) ) : ?>
				<ul>
					<li>Autor: <?php the_field( 'autor' ); ?></li>
					<li>Fecha de publicación: <?php the_field( 'fecha_de_publicacion' ); ?></li>
					<li>Editorial: <?php the_field( 'editorial' ); ?></li>
					<li>Precio: $ <?php the_field( 'precio' ); ?></li>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</article>
