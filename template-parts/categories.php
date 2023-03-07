<?php
/**
 * Categories template.
 *
 * @package WordPress
 */

$categories      = get_categories();
$items           = count( $categories );
$chunk_size      = ceil( $items / 2 );
$category_groups = array_chunk( $categories, $chunk_size );
?>

<!-- Categories widget-->
<div class="card mb-4">
	<div class="card-header">Categorías en nuestro blog.</div>
	<div class="card-body">
		<div class="row">
			<?php foreach ( $category_groups as $group ) : ?>
			<div class="col-sm-6">
				<ul class="list-unstyled mb-0">
					<?php foreach ( $group as $category ) : ?>
					<li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo wp_kses_post( $category->name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
