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
					<h2 class="card-title h4"><?php the_title(); ?></h2>
					<?php if ( function_exists( 'the_field' ) ) : ?>
						<ul>
							<li>Autor: <?php the_field( 'autor' ); ?></li>
							<li>Editorial: <?php the_field( 'editorial' ); ?></li>
							<li>Precio: $ <?php the_field( 'precio' ); ?></li>
						</ul>
					<?php endif; ?>
					<a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more</a>
				</div>
			</div>
		</div>
	</div>
</div>
