<?php
/**
 * Categories template.
 *
 * @package WordPress
 */

$categories = get_categories( array( 'taxonomy' => 'book_categories' ) );
$items      = count( $categories );

if ( $items > 0 ) {

	$chunk_size      = ceil( $items / 2 );
	$category_groups = array_chunk( $categories, $chunk_size );

}
?>

<!-- Categories widget-->
<div class="card mb-4">
	<div class="card-header">Categorías de libros.</div>
	<div class="card-body">
		<div class="row">
			<?php if ( 0 === $items ) : ?>
				<p>No categories found!</p>
			<?php else : ?>
				<?php foreach ( $category_groups as $group ) : ?>
				<div class="col-sm-6">
					<ul class="list-unstyled mb-0">
						<?php foreach ( $group as $category ) : ?>
						<li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo wp_kses_post( $category->name ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
