<?php 

$categories = get_categories();
$items = count( $categories );
$chunkSize = ceil( $items / 2 );
$categoryGroups = array_chunk( $categories, $chunkSize );

?>
<!-- Categories widget-->
<div class="card mb-4">
    <div class="card-header">Categories</div>
    <div class="card-body">
        <div class="row">
            <?php foreach( $categoryGroups as $group ) : ?>
            <div class="col-sm-6">
                <ul class="list-unstyled mb-0">
                    <?php foreach( $group as $category ) : ?>
                    <li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo $category->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>