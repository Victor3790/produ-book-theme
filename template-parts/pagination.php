<?php 

    $links = paginate_links( array( 'type' => 'array' ) );

    if( empty( $links ) )
        return;

    $new_links = str_replace( 'page-numbers', 'page-link', $links );

?>

<!-- Pagination-->
<nav aria-label="Pagination">
    <hr class="my-0" />
    <ul class="pagination justify-content-center my-4">

        <?php foreach( $new_links as $link ) : ?>

            <li class="page-item <?php if( strpos( $link, 'current' ) ) echo ' active'; ?>"><?php echo $link; ?></li>

        <?php endforeach; ?> 

    </ul>
</nav>