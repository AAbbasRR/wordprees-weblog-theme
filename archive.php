<?php get_header(); ?>

<div class="container-fluid container-md px-0">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-6 text-sm-right mt-5 mb-sm-0">
                <h2><?php wp_title(); ?></h2>
                <!-- <span>تعداد مطالب: <?php echo $GLOBALS['wp_query']->post_count; ?></span> -->
            </div>
            <?php
            $search = ot_get_option('search_in_categories', false);
            if ($search == "on") {
            ?>
                <div class="col-12 col-sm-6 d-flex justify-content-end p-0 my-auto">
                    <form class="d-flex flex-row" id="archive-search">
                        <input class="form-control" style="width:fit-content;" type="search" placeholder="جستجوی مطالب" aria-label="Search">
                        <button class="btn btn-warning form-control" type="submit"><i class="fas fa-search fa-lg" style="color: #8b8b8b;"></i></button>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="row justify-content-center maincontent">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
        ?>
                <div class="col-12 px-0 system-display">
                    <div class="row my-4 mx-0 p-0 archive_card">
                        <div class="col-4 p-0">
                            <a href="<?php the_permalink(); ?>" class="d-flex justify-content-start rounded-start float-start archive-image-box">
                                <?php the_post_thumbnail(null); ?>
                            </a>
                        </div>
                        <div class="col-8 p-0 position-relative">
                            <div class="archive-card-content-box px-3 py-1">
                                <div class="row flex-column">
                                    <div class="col m-0 pt-2 archive-title">
                                        <a class="post_card_title" href="<?php the_permalink(); ?>">
                                            <h5 class="my-0 p-0" id="title-categori">
                                                <?php the_title(); ?>
                                            </h5>
                                        </a>
                                    </div>
                                    <div class="col m-0 p-0 d-inline-block position-relative">
                                        <p class="limit-char px-3 m-0 mt-2">
                                            <?php echo the_content_rss(); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex flex-row px-3 my-1 bottom-0 position-absolute archive-tools">
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
                </div>

                <div class="col-10 my-3 mx-auto rounded mobile-display p-0">
                    <div class="flex-column archive_card mx-0 position-relative paper">
                        <a href="<?php the_permalink(); ?>" class="rounded-top">
                            <?php the_post_thumbnail(null, array('class' => 'rounded-top')); ?>
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
        } else {
            ?>
            <p><?php esc_html_e('متاسفانه پستی وجود ندارد'); ?></p>
        <?php
        }
        ?>
    </div>

    <div class="d-flex justify-content-end archive-pagination" id="paging">
        <?php
        the_posts_pagination(array(
            'mid-size' => 3,
            'prev_text' => __('قبلی', 'textdomain'),
            'next_text' => __('بعدی', 'textdomain'),
            'screen_reader_text' => __('&nbsp;')
        ))
        ?>
    </div>
</div>


</div>


<?php get_footer(); ?>