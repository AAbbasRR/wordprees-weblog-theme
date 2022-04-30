<?php get_header(); ?>

<div class="container">
    <!-- <div class="row">
        <div class="col">
            <?php echo (the_breadcrumb()); ?>
        </div>
    </div> -->

    <div class="row justify-content-center maincontent">
        <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-auto col-sm-auto col-xs-auto">

        </div>
        <div class="col-xxl-9 col-xl-9 col-lg-10 col-md-12 col-sm-12 col-xs-12 primary_container">
            <?php if (have_posts()) {
                while (have_posts()) {
                    the_post();
            ?>
                    <h1 class="text-center font-weight-bold"><?php the_title(); ?></h1>

                    <section class="single-post-icons">
                        <div class="row m-0 pb-4">
                            <div class="col-12 col-md-6 single-post-desctiption">
                                <div class="row  flex-column flex-md-row mb-0 ">
                                    <div class="col-12 col-md-auto p-0">
                                        <?php echo (the_category(' ')); ?>
                                    </div>
                                    <div class="col-12 col-md-auto">
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

                            <div class="col-12 col-md-6  social-icons-pack pt-2 pt-md-0">
                                <div class="col-md-12">
                                    <a class="social-icon" onclick='navigator.clipboard.writeText(<?php echo json_encode(get_permalink()); ?>);''>
                                        <i class="fab fas fa-clone fa-md m-1"></i>
                                    </a>
                                    <?php
                                    $telegram = ot_get_option('telegram', false);
                                    $instagram = ot_get_option('instagram', false);
                                    $twitter = ot_get_option('twitter', false);
                                    $facebook = ot_get_option('facebook', false);
                                    $whatsapp = ot_get_option('whatsapp', false);
                                    $linkdin = ot_get_option('linkdin', false);
                                    ?>
                                    <?php
                                    if ($telegram !== false) {
                                    ?>
                                        <a class="social-icon" href="<?php echo $telegram; ?>" target="_blank">
                                            <i class="fab fa-telegram-plane fa-md m-1"></i>
                                        </a>
                                    <?php
                                    }
                                    if ($instagram !== false) {
                                    ?>
                                        <a class="social-icon" href="<?php echo $instagram; ?>" target="_blank">
                                            <i class="fab fa-instagram fa-md m-1"></i>
                                        </a>
                                    <?php
                                    }
                                    if ($twitter !== false) {
                                    ?>
                                        <a class="social-icon" href="<?php echo $twitter; ?>" target="_blank">
                                            <i class="fab fa-twitter fa-md m-1"></i>
                                        </a>
                                    <?php
                                    }
                                    if ($facebook !== false) {
                                    ?>
                                        <a class="social-icon" href="<?php echo $facebook; ?>" target="_blank">
                                            <i class="fab fa-facebook fa-md m-1"></i>
                                        </a>
                                    <?php
                                    }
                                    if ($whatsapp !== false) {
                                    ?>
                                        <a class="social-icon" href="<?php echo $whatsapp; ?>" target="_blank">
                                            <i class="fab fa-whatsapp fa-md m-1"></i>
                                        </a>
                                    <?php
                                    }
                                    if ($linkdin !== false) {
                                    ?>
                                        <a class="social-icon" href="<?php echo $linkdin; ?>" target="_blank">
                                            <i class="fab fa-linkedin-in fa-md m-1"></i>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="post-image-thumbnail">
                        <?php the_post_thumbnail(null, array('class' => 'rounded')); ?>
                    </div>

                    <?php
                    if (esc_attr(get_post_meta(get_the_ID(), 'summary_field', true)) !== '') {
                    ?>
                        <div class="summary-content">
                            <span class="summery-title">خلاصه:</span>
                            <p>
                                <?php echo (esc_attr(get_post_meta(get_the_ID(), 'summary_field', true))); ?>
                            </p>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (shortcode_exists('toc')) {
                    ?>
                        <div class="list-content">
                            <?php echo(do_shortcode('[toc content=".toc"]')); ?>
                        </div>
                    <?php
                    }
                    ?>

                    <article class="main-content ">
                        <?php the_content(); ?>
                    </article>

                    <hr />

                    <div class="tag-content">
                        <h5>برچسب ها</h5>
                        <div class="tags-list">
                            <?php the_tags('', ' '); ?>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p><?php esc_html_e('متاسفانه محتوایی برای نمایش پیدا نشد'); ?></p>
            <?php
            }
            ?>
        </div>
        <div class="col-xxl-1 col-xl-1 col-lg-10 col-md-auto col-sm-auto col-xs-auto"></div>
    </div>
</div>

<?php
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);

if ($tags) {
    $tag_ids = array();
    foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

    $args = array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 3, // Number of related posts that will be shown.
        'ignore_sticky_posts' => 1
    );
    $my_query = new wp_query($args);
    if ($my_query->have_posts()) {
?>
        <div class="container related-posts mx-auto my-5" id="post-content-singl">
            <div class="row gy-5">
                <?php
                while ($my_query->have_posts()) {
                    $my_query->the_post();
                ?>
                    <div class="col-md-4">
                        <div class="col-md-12 flex-column p-0 position-relative paper post-paper-footer">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(null); ?>
                            </a>
                            <a class="post_card_title" href="<?php the_permalink(); ?>">
                                <h5 class="p-2 my-2 text-wrap"><?php the_title(); ?></h5>
                            </a>
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
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    if ($my_query->have_posts()) {
    ?>
        <div class="carousel-content">
            <div id="carouselExampleCaptions " class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $post_counter = 1;
                    while ($my_query->have_posts()) {
                        $my_query->the_post();
                    ?>
                        <div class="carousel-item <?php if ($post_counter == 1) {
                                                        echo ('active');
                                                    } ?>">
                            <div class="flex-column p-0 position-relative paper-carousel post-paper-footer">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(null); ?>
                                </a>
                                <a class="post_card_title" href="<?php the_permalink(); ?>">
                                    <h5 class="p-2 my-2 text-wrap text-center"><?php the_title(); ?></h5>
                                </a>
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
                        </div>
                    <?php
                        $post_counter++;
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
<?php
    }
}
?>

<!-- comment -->
<!-- <div class="container p-3 ">
    <div class="comment ">
        <h6>دیدگاه ها و پرسش های خود را بیان نمایید</h6>
        <form action="">
            <div class="row  d-xxl-flex d-xl-flex d-lg-flex d-md-flex  d-inline ">
                <div class="col">
                    <label>نام</label><br>
                    <input type="text" id="fname" name="fname">
                </div>
                <div class="col">
                    <label>ایمیل</label><br>
                    <input type="email" id="email" name="email">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>دیدگاه</label><br>
                    <textarea class="form-control" name="" id="" rows="6"></textarea>
                </div>
            </div>

            <div class="row justify-content-end mt-3">
                <div class="col-5 me-auto">
                    <p>سوال امنیتی</p>
                    <p> 1=<span><input type="text" style="width: 2.5rem;"></span>-3</dbi>
                    </p>
                </div>
                <div class="col-5 me-auto ">
                    <button type="submit" class="btn " style="background: #f0e122 ; width: 100%;">ارسال
                        دیدگاه</button>
                </div>
            </div>
        </form>
    </div>
</div> -->
<?php get_footer(); ?>