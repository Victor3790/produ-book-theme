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
		<!-- Post meta content-->
		<div class="text-muted fst-italic mb-2">Publicado el <?php the_date(); ?> por <?php the_author(); ?></div>
	</header>
	<!-- Preview image figure-->
	<figure class="mb-4"><?php the_post_thumbnail( 'my_theme_feature_image', array( 'class' => 'img-fluid' ) ); ?></figure>
	<!-- Post content-->
	<section class="mb-5">
		<?php the_content(); ?>
	</section>
</article>
