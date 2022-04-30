<?php get_header(); ?>
<div class="container page-404">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column align-items-center">
                <img src="<?php echo get_template_directory_uri() . '/assets/404.png'; ?>" alt="404 image">
                <h3>ای بابا، صفحه‌ای پیدا نشد</h3>
                <a href="<?php echo site_url(); ?>" class="btn btn-warning" role="button">
                    بازگشت به صفحه اصلی
                </a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>