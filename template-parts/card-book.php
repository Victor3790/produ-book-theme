<?php
/**
 * Thumbnail post card.
 *
 * @package WordPress
 */

?>
<div class="col-lg-6">
	<!-- Blog post-->
	<div class="card mb-4">
		<div class="row">
			<div class="col-5">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'my_theme_book_thumbnail', array( 'class' => 'img-fluid' ) ); ?>
				</a>
			</div>
			<div class="col-7">
				<div class="card-body">
					<div class="small text-muted"><?php echo get_the_date(); ?></div>
					<h2 class="card-title h4"><?php the_title(); ?></h2>
					<p class="card-text"><?php the_excerpt(); ?></p>
					<a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more</a>
				</div>
			</div>
		</div>
	</div>
</div>
