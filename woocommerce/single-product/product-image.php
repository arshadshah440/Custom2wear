<style>
    .slick-prev {
        background: url('<?php bloginfo('stylesheet_directory'); ?>/assets/arr-up.png');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: 14px auto;
        border: 1px solid rgba(0, 0, 0, 0.05);
        left: 1px !important;
        top: -4% !important;
        width: 85px !important;
        height: 34px !important;
    }

    .slick-prev:hover {
        background: url('<?php bloginfo('stylesheet_directory'); ?>/assets/arr-up.png');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: 14px auto;
    }

    .slick-next::before {
        display: none;
    }

    .slick-next {
        background: url('<?php bloginfo('stylesheet_directory'); ?>/assets/arr-down.png');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: 14px auto;
        border: 1px solid rgba(0, 0, 0, 0.05);
        left: 1px !important;
        top: 110% !important;
        width: 85px !important;
        height: 34px !important;
    }

    .slick-next:hover {
        background: url('<?php bloginfo('stylesheet_directory'); ?>/assets/arr-down.png');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: 14px auto;
    }
</style>
<?php
defined('ABSPATH') || exit;

if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <div class="slick-slider-container">
        <!-- Slick Slider Thumbnails -->
        <div class="slick-slider-thumbs">
            <?php
            // Main image
            if ($post_thumbnail_id) {
                echo wc_get_gallery_image_html($post_thumbnail_id, true);
            } else {
                echo '<div class="woocommerce-product-gallery__image--placeholder">';
                echo sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
                echo '</div>';
            }

            // Display gallery images if they exist
            $attachment_ids = $product->get_gallery_image_ids();
            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                    echo wp_get_attachment_image($attachment_id, 'woocommerce_single', false, array('class' => 'slick-slide-image', 'data-attribute-id' => $attachment_id));
                }
            }
            ?>
        </div>

        <!-- Slick Slider Main Image -->
        <div class="slick-slider-main">
            <?php
            // Main image again (to sync with thumbnails)
            if ($post_thumbnail_id) {
                echo wc_get_gallery_image_html($post_thumbnail_id, true);
            } else {
                echo '<div class="woocommerce-product-gallery__image--placeholder">';
                echo sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
                echo '</div>';
            }

            // Display gallery images if they exist
            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                    echo wp_get_attachment_image($attachment_id, 'woocommerce_single', false, array('class' => 'slick-slide-image', 'data-attribute-id' => $attachment_id));
                }
            }
            ?>
        </div>
    </div>
    <div class="desktop_active">    <?php get_template_part('woocommerce/single-product/product-price-calculator'); ?>
    </div>
</div>

<style>
    /* Custom CSS for Slick slider layout */
    .slick-slider-container {
        display: flex;
        align-items: flex-start;
    }

    .slick-slider-thumbs {
        width: 20%;
        margin-right: 10px;
        position: relative;
    }

    .slick-slider-main {
        width: 80%;
    }

    .slick-slide-image {
        width: 100%;
        height: auto;
    }

    .slick-slider-thumbs .slick-slide {
        margin: 0 5px;
        cursor: pointer;
    }

    .slick-slider-thumbs .slick-slide img {
        height: 80px;
        object-fit: cover;
    }
</style>

<script>
    jQuery(document).ready(function($) {
        // Initialize Slick sliders
        $('.slick-slider-thumbs').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slick-slider-main',
            centerMode: true,
            focusOnSelect: true,
            vertical: true,
            infinite: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }]
        });

        $('.slick-slider-main').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.slick-slider-thumbs',
            arrows: false,
            fade: true,
            infinite: false
        });

        // Handle swatch click
        $('.color-swatch').on('click', function() {
            var variationID = $(this).data('variation-id');
            var color = $(this).data('color');

            // Find the corresponding select element for the color attribute
            var $form = $('form.variations_form');
            var $colorSelect = $form.find('select[name="attribute_pa_color"]');

            // Set the value of the color select to match the swatch
            $colorSelect.val(color).trigger('change');

            // Trigger WooCommerce to update the variation
            $form.trigger('woocommerce_variation_select_change');
            $form.trigger('check_variations');

            // Update Slick slider after variation is found
            $form.on('found_variation', function(event, variation) {
                var imageID = variation.image_id;

                if (imageID) {
                    var $thumbnail = $('.slick-slider-thumbs').find('[data-attribute-id="' + imageID + '"]');
                    var $mainImage = $('.slick-slider-main').find('[data-attribute-id="' + imageID + '"]');

                    if ($thumbnail.length) {
                        var thumbIndex = $thumbnail.index();
                        $('.slick-slider-thumbs').slick('slickGoTo', thumbIndex);

                        // Smooth scroll the thumbnail into view
                        $('.slick-slider-thumbs').slick('slickSetOption', 'centerMode', false, true);
                        $('.slick-slider-thumbs').slick('slickSetOption', 'centerMode', true, true);
                    }

                    if ($mainImage.length) {
                        var mainIndex = $mainImage.index();
                        $('.slick-slider-main').slick('slickGoTo', mainIndex);
                    }
                }
            });
        });
    });
</script>