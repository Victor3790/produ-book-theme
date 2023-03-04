<?php get_header(); ?>

    <?php if( is_home() ) : ?> 

        <!-- Home Page header -->
        <header class="py-5 bg-light border-bottom mb-4 hero">
            <div class="container">
                <div class="text-center my-5 hero__text">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>

    <?php elseif( is_search() ) : ?>

        <!-- Search results Page header -->
        <header class="py-5 mb-4">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Resultados para la búsqueda: <?php echo get_search_query(); ?></h1>
                        <p>
                            <?php

                                global $wp_query;
                                echo 'Entradas encontradas: ' . $wp_query->found_posts;

                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </header>

    <?php elseif( is_archive() ) : ?>

        <!-- Archive Page header -->
        <header class="py-5 mb-4">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1><?php echo get_the_archive_title(); ?></h1>
                    </div>
                </div>
            </div>
        </header>

    <?php endif; ?> 

    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Nested row for non-featured blog posts-->
                <div class="row">

                    <?php

                        if( have_posts() ) {

                            while( have_posts() ) {

                                the_post();
                                get_template_part( 'template-parts/post-card' );

                            }

                        }

                    ?>

                </div>
                        
                <?php get_template_part( 'template-parts/pagination' ); ?>

            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                
                <?php get_search_form(); ?>

                <?php get_template_part( 'template-parts/categories' ); ?>

            </div>
        </div>
    </div>
<?php get_footer(); ?>