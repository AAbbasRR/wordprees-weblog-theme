<?php

function load_styles()
{
	wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css', false);
	wp_enqueue_style('bootstrap_style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css', false);
	wp_enqueue_style('base_style', get_template_directory_uri() . '/styles/style.css', false);
	wp_enqueue_style('responsive_style', get_template_directory_uri() . '/styles/responsive.css', false);
	wp_enqueue_style('second_style', get_template_directory_uri() . '/styles/csses.css', false);

	wp_enqueue_script('bootstrap_script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '1.0');
	wp_enqueue_script('bootstrap_script', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '1.0');
	wp_enqueue_script('bootstrap_script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js', array('jquery'), '1.0');
}
add_action('wp_enqueue_scripts', 'load_styles');

function set_nav_menus()
{
	register_nav_menus(
		array(
			'header-menu' => __('منوی هدر'),
		)
	);
}
add_action('init', 'set_nav_menus');

function set_widget()
{
	register_sidebar(array(
		'name'          => 'فوتر اول سمت راست',
		'id'            => 'home_right_1',
		'before_widget' => '<div class="col-lg-3 col-md-6 col-sm-12">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="mb-1 ">',
		'after_title'   => '</h5>',
	));
	register_sidebar(array(
		'name'          => 'فوتر دوم سمت راست',
		'id'            => 'home_right_2',
		'before_widget' => '<div class="col-lg-3 col-md-6 col-sm-12">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="mb-1">',
		'after_title'   => '</h5>',
	));
	register_sidebar(array(
		'name'          => 'فوتر سوم سمت راست',
		'id'            => 'home_right_3',
		'before_widget' => '<div class="col-lg-3 col-md-6 col-sm-12">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="mb-1">',
		'after_title'   => '</h5>',
	));
}
add_action('widgets_init', 'set_widget');

add_theme_support('post-thumbnails');

function call_us_widget()
{
?>
	<div class="d-flex flex-column align-items-center">
		<p>
			تهران، محمودیه، خیابان شادآور، خیابان دوم، پلاک 12
		</p>
		<div class="d-flex flx-row">
			<a href="tel:09054345730">
				09054345730
			</a>
			<span>&nbsp;-&nbsp;</span>
			<a href="tel:02126231908">
				02126231908
			</a>
			<span>&nbsp;-&nbsp;</span>
			<a href="tel:02172951000">
				02172951000
			</a>
		</div>
		<div class="d-flex flex-row mt-2 footer-social-icon-pack">
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
<?php
}
add_shortcode('call_us', 'call_us_widget');

function valmart_echange_widget()
{
?>
	<ul>
		<li>
			<a href="https://valmart.net" target="_blank">
				خرید بیتکوین
			</a>
		</li>
		<li>
			<a href="https://valmart.net" target="_blank">
				خرید اتریوم
			</a>
		</li>
		<li>
			<a href="https://valmart.net" target="_blank">
				خرید تتر
			</a>
		</li>
	</ul>
<?php
}
add_shortcode('valmart_echange', 'valmart_echange_widget');

function about_us_widget()
{
?>
	<ul>
		<li>
			<a href="https://support.valmart.net/" target="_blank">
				رهنمای ویدیویی
			</a>
		</li>
		<li>
			<a href="https://valmart.net/about-us" target="_blank">
				درباره ما
			</a>
		</li>
		<li>
			<a href="https://valmart.net/terms" target="_blank">
				قوانین و مقررات
			</a>
		</li>
	</ul>
<?php
}
add_shortcode('about_us', 'about_us_widget');

/*  Custom Field for Categories.
    ======================================== */

// Add new term page
function my_taxonomy_add_meta_fields($taxonomy)
{
?>
	<div class="form-field term-group">
		<label for="show_category">
			<?php _e('نمایش در صفحه اصلی؟', 'codilight-lite'); ?> <input type="checkbox" id="show_category" name="show_category" value="no" />
		</label>
	</div>
<?php
}
add_action('category_add_form_fields', 'my_taxonomy_add_meta_fields', 10, 2);

function my_taxonomy_add_meta_not_in_fields($taxonomy)
{
?>
	<div class="form-field term-group">
		<label for="hidden_category">
			<?php _e('پنهان کردن پست ها؟', 'codilight-lite'); ?> <input type="checkbox" id="hidden_category" name="hidden_category" value="no" />
		</label>
	</div>
<?php
}
add_action('category_add_form_fields', 'my_taxonomy_add_meta_not_in_fields', 10, 2);

// Edit term page
function my_taxonomy_edit_meta_fields($term, $taxonomy)
{
	$show_category = get_term_meta($term->term_id, 'show_category', true);
?>
	<tr class="form-field term-group-wrap">
		<th scope="row">
			<label for="show_category"><?php _e('نمایش در صفحه اصلی؟', 'codilight-lite'); ?></label>
		</th>
		<td>
			<input type="checkbox" id="show_category" name="show_category" value="yes" <?php echo ($show_category) ? checked($show_category, 'yes') : 'no'; ?> />
		</td>
	</tr>
<?php
}
add_action('category_edit_form_fields', 'my_taxonomy_edit_meta_fields', 10, 2);

function my_taxonomy_edit_meta_not_in_fields($term, $taxonomy)
{
	$hidden_category = get_term_meta($term->term_id, 'hidden_category', true);
?>
	<tr class="form-field term-group-wrap">
		<th scope="row">
			<label for="hidden_category"><?php _e('پنهان کردن پست ها؟', 'codilight-lite'); ?></label>
		</th>
		<td>
			<input type="checkbox" id="hidden_category" name="hidden_category" value="yes" <?php echo ($hidden_category) ? checked($hidden_category, 'yes') : 'no'; ?> />
		</td>
	</tr>
<?php
}
add_action('category_edit_form_fields', 'my_taxonomy_edit_meta_not_in_fields', 10, 2);

// Save custom meta
function my_taxonomy_save_taxonomy_meta($term_id, $tag_id)
{
	if (isset($_POST['show_category'])) {
		update_term_meta($term_id, 'show_category', 'yes');
	} else {
		update_term_meta($term_id, 'show_category', 'no');
	}
}
add_action('created_category', 'my_taxonomy_save_taxonomy_meta', 10, 2);
add_action('edited_category', 'my_taxonomy_save_taxonomy_meta', 10, 2);

function my_taxonomy_save_taxonomy_not_in_meta($term_id, $tag_id)
{
	if (isset($_POST['hidden_category'])) {
		update_term_meta($term_id, 'hidden_category', 'yes');
	} else {
		update_term_meta($term_id, 'hidden_category', 'no');
	}
}
add_action('created_category', 'my_taxonomy_save_taxonomy_not_in_meta', 10, 2);
add_action('edited_category', 'my_taxonomy_save_taxonomy_not_in_meta', 10, 2);

// Register meta boxes
function summary_register_meta_boxes()
{
	add_meta_box('summary-post', __('خلاصه مقاله:', 'summary'), 'summary_display_callback', 'post');
}
add_action('add_meta_boxes', 'summary_register_meta_boxes');

function summary_display_callback($post)
{
?>
	<input id="summary_field" name="summary_field" placeholder="خلاصه مقاله" type="text" value="<?php echo (esc_attr(get_post_meta(get_the_ID(), 'summary_field', true))); ?>" style="width: 100%;">
<?php
}

function summary_save($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if ($parent_id = wp_is_post_revision($post_id)) {
		$post_id = $parent_id;
	}
	$field_list = [
		'summary_field',
	];
	foreach ($field_list as $fieldName) {
		if (array_key_exists($fieldName, $_POST)) {
			update_post_meta(
				$post_id,
				$fieldName,
				sanitize_text_field($_POST[$fieldName])
			);
		}
	}
}
add_action('save_post', 'summary_save');

function the_breadcrumb()
{
	$sep = ' > ';
	if (!is_front_page()) {
		// Start the breadcrumb with a link to your homepage
		echo '<div class="breadcrumbs">';
		echo '<a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo '</a>' . $sep;
		// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
		if (is_category() || is_single()) {
			the_category(' | ');
		} elseif (is_archive() || is_single()) {
			if (is_day()) {
				printf(__('%s', 'text_domain'), get_the_date());
			} elseif (is_month()) {
				printf(__('%s', 'text_domain'), get_the_date(_x('F Y', 'monthly archives date format', 'text_domain')));
			} elseif (is_year()) {
				printf(__('%s', 'text_domain'), get_the_date(_x('Y', 'yearly archives date format', 'text_domain')));
			} else {
				_e('Blog Archives', 'text_domain');
			}
		}
		// If the current page is a single post, show its title with the separator
		if (is_single()) {
			echo $sep;
			the_title();
		}
		// If the current page is a static page, show its title.
		if (is_page()) {
			echo the_title();
		}
		// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
		if (is_home()) {
			global $post;
			$page_for_posts_id = get_option('page_for_posts');
			if ($page_for_posts_id) {
				$post = get_page($page_for_posts_id);
				setup_postdata($post);
				the_title();
				rewind_posts();
			}
		}
		echo '</div>';
	}
}

/**
 * Grab latest post title by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post title for the latest, * or null if none.
 */
function my_rest_api_func($data)
{
	$posts = get_posts(array(
		'category' => $data['id'],
	));

	if (empty($posts)) {
		return null;
	}
	$response = [];

	foreach ($posts as $value) {
		array_push($response, array(
			"id" => $value->ID,
			"title" => $value->post_title,
			"link" => get_permalink($value->ID),
			"image" => get_the_post_thumbnail_url($value->ID)
		));
	}

	return $response;
}

add_action('rest_api_init', function () {
	register_rest_route('exchange', '/news/(?P<id>\d+)', array(
		'methods' => 'GET',
		'callback' => 'my_rest_api_func',
	));
});

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
// add_filter( 'ot_theme_mode', '__return_true' );

// /**
// * Required: include OptionTree.
// */
// require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

// add_filter('ot_show_pages', '__return_false');
?>