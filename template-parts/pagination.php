<?php
/**
 * Categories template.
 *
 * @package WordPress
 */

$links = paginate_links( array( 'type' => 'array' ) );

if ( empty( $links ) ) {
	return;
}

$new_links = str_replace( 'page-numbers', 'page-link', $links );

?>

<!-- Pagination-->
<nav aria-label="Pagination">
	<hr class="my-0" />
	<ul class="pagination justify-content-center my-4">

		<?php foreach ( $new_links as $page_link ) : ?>

			<li class="page-item <?php echo ( strpos( $page_link, 'current' ) ) ? ' active' : ''; ?>"><?php echo wp_kses_post( $page_link ); ?></li>

		<?php endforeach; ?> 

	</ul>
</nav>
