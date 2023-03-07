<?php
/**
 * Post comments template.
 *
 * TODO: Add reply functionality.
 * TODO: Add pagination.
 *
 * @package WordPress
 */

$post_comments = get_comments(
	array(
		'post_id' => get_the_ID(),
		'number'  => 15, // Get the last 15 comments, pagination pending.
	)
);
?>

<section class="mb-5">
	<div class="card bg-light">
		<div class="card-body">
			<!-- Comment form-->
			<?php
			comment_form(
				array(
					'title_reply'         => __( 'Deja una reseña' ),
					'class_form'          => 'mb-5',
					// TODO: Add required field verification.
					'comment_field'       => '<textarea id="comment" name="comment" class="form-control mb-3" rows="3" placeholder="Deja un comentario" required="required"></textarea>',
					// TODO: Optimize star size for small screens.
					'comment_notes_after' => '<p>Tu puntuación para este libro: </p><div class="my-rating mb-3"></div><input type="hidden" name="book-rating" value="0">',
					'fields'              => array(
						'author' => '<label for="author" class="mt-3">Nombre <span class="required">*</span></label><input id="author" name="author" type="text" value="" size="30" maxlength="245" autocomplete="name" required="required" class="form-control">',
						'email'  => '<label for="email" class="mt-3">Correo electrónico <span class="required">*</span></label><input id="email" name="email" type="text" value="" size="30" maxlength="245" autocomplete="name" required="required" class="form-control mb-4">',
					),
				)
			);
			?>
			<!-- Comments-->

			<?php if ( empty( $post_comments ) ) : ?>

				<div class="d-flex">
					<h5>No comments yet</h5>
				</div>


			<?php else : ?>

				<?php foreach ( $post_comments as $post_comment ) : ?>

					<!-- Single comment-->
					<div class="d-flex mb-4">
						<div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
						<div class="ms-3">
							<div class="comment-rating" data-rating="<?php echo wp_kses_post( get_comment_meta( $post_comment->comment_ID, 'book-rating', true ) ); ?>"></div>
							<div class="fw-bold"><?php echo wp_kses_data( $post_comment->comment_author ); ?></div>
							<?php echo wp_kses_data( $post_comment->comment_content ); ?>
						</div>
					</div>

				<?php endforeach; ?>

			<?php endif; ?>


		</div>
	</div>
</section>
