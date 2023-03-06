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
	<!-- Post content-->
	<section class="mb-5">
		<?php the_content(); ?>
	</section>
</article>
