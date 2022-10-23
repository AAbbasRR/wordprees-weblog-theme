<?php get_header(); ?>

<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => '8',
);
$new_posts_query = new WP_Query($args);
if ($new_posts_query->have_posts()) {
?>
    <div class="container-fluid container-lg first-posts">
        <div class="row mt-1 gy-5">
            <?php
            $index_post = 1;
            while ($new_posts_query->have_posts()) {
                $new_posts_query->the_post();
            ?>
                <div class="carousel-system-display col-md-6">
                    <div class="col-12 position-relative image-index">
                        <?php the_post_thumbnail(null, array('class' => 'index-first-images')); ?>
                        <div class="d-flex flex-column position-absolute w-100 bottom-0 first-posts-title">
                            <a class="post_title d-flex mt-auto px-3 pb-3" href=<?php the_permalink(); ?>>
                                <h5 class="post-title"><?php the_title(); ?></h5>
                            </a>
                            <!-- <div class="d-flex flex-row mt-3 category_items">
                                <?php the_category(' '); ?>
                            </div> -->
                        </div>
                    </div>
                </div>
            <?php
                if ($index_post == 2) {
                    break;
                }
                $index_post++;
            }
            ?>
        </div>
    </div>
<?php
}
?>

<?php
$new_posts_query = new WP_Query($args);
if ($new_posts_query->have_posts()) {
?>
    <div class="container-fluid container-lg first-posts">
        <div class="row pt-3 gy-5">
            <div class="index-carousel m-0 carousel-mobile-display d-none">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $index_post = 1;
                        while ($new_posts_query->have_posts()) {
                            $new_posts_query->the_post();
                        ?>
                            <div class="col-12 carousel-item rounded-3 position-relative index-carousel-content <?php if ($index_post == 1) {
                                                                                                                    echo ('active');
                                                                                                                } ?>">
                                <?php the_post_thumbnail(null, array('class' => 'rounded')); ?>
                                <div class="d-flex flex-column position-absolute w-100 bottom-0 first-posts-title">
                                    <a class="post_title d-flex mt-auto px-3 pb-3" href=<?php the_permalink(); ?>>
                                        <h3 class="post-title"><?php the_title(); ?></h3>
                                    </a>
                                    <!-- <div class="d-flex flex-row mt-3 category_items">
                                        <?php the_category(' '); ?>
                                    </div> -->
                                </div>
                            </div>
                        <?php
                            if ($index_post == 2) {
                                break;
                            }
                            $index_post++;
                        }
                        ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">قبلی</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">بعدی</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>


<!-- category buttons  -->
<?php
$args = array(
    'taxonomy' => 'category',
    'meta_query' => array(
        array(
            'key'     => 'show_category',
            'value'   => 'yes',
            'compare' => '==',
        ),
    ),
    'orderby' => 'ID'
);
$category_query = new WP_Term_Query($args);
if (!empty($category_query->get_terms())) {
?>
    <div class="container categories">
        <div class="row justify-content-center">
            <?php
            $button_category = 1;
            $terms_lenght = count($category_query->get_terms());
            foreach ($category_query->get_terms() as $term) {
            ?>
                <div class="<?php if ($terms_lenght > 4) {
                                echo 'col-md-2';
                            } else {
                                echo 'col-md-3';
                            } ?>">
                    <div class="col-md-12">
                        <a href=<?php echo (get_category_link($term)); ?> class="col py-3 d-flex justify-content-center category-link">
                            <?php echo ($term->name); ?>
                        </a>
                    </div>
                </div>
            <?php
                $button_category++;
                if (($terms_lenght > 6 && $button_category == 7) || ($terms_lenght <= 4 && $button_category == 5)) {
                    break;
                }
            }
            ?>
        </div>
    </div>
<?php
}
?>

<!-- 6 last posts -->
<?php
if ($new_posts_query->have_posts()) {
?>
    <div class="d-flex flex-column my-1">
        <div class="container-fluid container-md category-section-card p-0 mt-4">
            <h3 class="mx-2 mb-3">آخرین مطالب</h3>
            <div class="row gy-5">
                <?php
                while ($new_posts_query->have_posts()) {
                    $new_posts_query->the_post();
                ?>
                    <div class="col-md-4 col-sm-6 col-12 mx-0" id="list-index-content">
                        <div class="col-md-12 flex-column p-0 position-relative paper mx-5 mx-sm-1 mx-md-0 post-paper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(null, array('class' => 'post-paper-image')); ?>
                            </a>
                            <a class="post_card_title" href="<?php the_permalink(); ?>">
                                <h6 class="mx-3 my-2 text-wrap post-title"><?php the_title(); ?></h6>
                            </a>
                            <div class="d-flex flex-row py-3 position-absolute bottom-0 px-2">
                                <span class="post-description-icon"><i class="far fa-calendar"></i><?php the_time('F Y'); ?></span>
                                <?php
                                if (shortcode_exists('rt_reading_time')) {
                                ?>
                                    <span class="post-description-icon"><i class="far fa-clock"></i><?php echo do_shortcode('[rt_reading_time postfix="دقیقه" postfix_singular="دقیقه"]'); ?></span>
                                <?php
                                }
                                ?>
                                <?php
                                if (function_exists('the_views')) {
                                ?>
                                    <span class="post-description-icon"><i class="far fa-eye"></i><?php the_views(); ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
<?php
}
?>

<!-- 1 category section -->
<?php
if (!empty($category_query->get_terms())) {
    foreach ($category_query->get_terms() as $term) {
?>
        <div class="d-flex flex-column my-4">
            <div class="container-fluid container-md category-section-card p-0 mt-4">
                <div class="section-header mt-4 mb-5 d-flex flex-row align-items-center position-relative">
                    <h3 class="position-absolute end-0 title-category-btn">
                        <a href=<?php echo (get_category_link($term)); ?>>
                            <?php echo ($term->name); ?>
                        </a>
                    </h3>
                    <div class="position-absolute seprator"></div>
                    <h6 class="position-absolute start-0 more-category-btn">
                        <a href=<?php echo (get_category_link($term)); ?>>مشاهده همه</a>
                    </h6>
                </div>
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => '4',
                    'cat' => $term->term_id,
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                ?>
                    <div class="row gy-5 mt-2">
                        <?php
                        $index_post = 1;
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                        ?>
                            <?php
                            if ($index_post == 1) {
                            ?>
                                <div class="col-md-12 p-0 flex-row first-section-paper position-relative d-flex mx-auto" style="max-width:98%">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-5">
                                                <a class="post_card_title" href="<?php the_permalink(); ?>">
                                                    <h5 class="mx-3 mt-3 text-wrap post-title">
                                                        <?php the_title(); ?>
                                                    </h5>
                                                </a>
                                                <div class="first-section-content mx-3 my-4">
                                                    <?php echo the_content_rss(); ?>
                                                </div>
                                                <div class="d-flex flex-row p-3 position-absolute bottom-0">
                                                    <span class="post-description-icon"><i class="far fa-calendar"></i><?php the_time('F Y'); ?></span>
                                                    <?php
                                                    if (shortcode_exists('rt_reading_time')) {
                                                    ?>
                                                        <span class="post-description-icon"><i class="far fa-clock"></i><?php echo do_shortcode('[rt_reading_time postfix="دقیقه" postfix_singular="دقیقه"]'); ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (function_exists('the_views')) {
                                                    ?>
                                                        <span class="post-description-icon"><i class="far fa-eye"></i><?php the_views(); ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <a href="<?php the_permalink(); ?>" class="d-flex justify-content-start float-start first-section-paper-image">
                                                    <?php the_post_thumbnail(null); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12 first-section-paper-responsiv">
                                    <div class="col-md-12 flex-column p-0 position-relative paper mx-5 mx-sm-1 mx-md-0 post-paper">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail(null, array('class' => 'post-paper-image')); ?>
                                        </a>
                                        <a class="post_card_title" href="<?php the_permalink(); ?>">
                                            <h6 class=" mx-3 my-2 text-wrap post-title"><?php the_title(); ?></h6>
                                        </a>
                                        <div class="d-flex flex-row py-3 position-absolute bottom-0 px-2">
                                            <span class="post-description-icon"><i class="far fa-calendar"></i><?php the_time('F Y'); ?></span>
                                            <?php
                                            if (shortcode_exists('rt_reading_time')) {
                                            ?>
                                                <span class="post-description-icon"><i class="far fa-clock"></i><?php echo do_shortcode('[rt_reading_time postfix="دقیقه" postfix_singular="دقیقه"]'); ?></span>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (function_exists('the_views')) {
                                            ?>
                                                <span class="post-description-icon"><i class="far fa-eye"></i><?php the_views(); ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="col-md-12 flex-column p-0 position-relative paper mx-5 mx-sm-1 mx-md-0 post-paper">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail(null, array('class' => 'post-paper-image')); ?>
                                        </a>
                                        <a class="post_card_title" href="<?php the_permalink(); ?>">
                                            <h6 class=" mx-3 my-2 text-wrap post-title"><?php the_title(); ?></h6>
                                        </a>
                                        <div class="d-flex flex-row py-3 position-absolute bottom-0 px-2">
                                            <span class="post-description-icon"><i class="far fa-calendar"></i><?php the_time('F Y'); ?></span>
                                            <?php
                                            if (shortcode_exists('rt_reading_time')) {
                                            ?>
                                                <span class="post-description-icon"><i class="far fa-clock"></i><?php echo do_shortcode('[rt_reading_time postfix="دقیقه" postfix_singular="دقیقه"]'); ?></span>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if (function_exists('the_views')) {
                                            ?>
                                                <span class="post-description-icon"><i class="far fa-eye"></i><?php the_views(); ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        <?php
                            $index_post++;
                        }
                        ?>
                    </div>
                <?php
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
<?php
}
?>

<?php get_footer(); ?>