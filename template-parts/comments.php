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
		'status'  => 'approve',
		'number'  => 10,
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
					'class_form'          => 'mb-5',
					'comment_field'       => '<textarea id="comment" name="comment" class="form-control mb-3" rows="3" placeholder="Deja tu comentario aquí"></textarea>',
					'comment_notes_after' => '<p>Todos los comentarios deben ser aprobados antes de su publicación.</p>',
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
							<div class="fw-bold"><?php echo wp_kses_data( $post_comment->comment_author ); ?></div>
							<?php echo wp_kses_data( $post_comment->comment_content ); ?>
						</div>
					</div>

				<?php endforeach; ?>

			<?php endif; ?>


		</div>
	</div>
</section>
