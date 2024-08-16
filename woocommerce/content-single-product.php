<?php
defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <div class="woocommerce-product-gallery">
        <?php
        // Display the product images
        do_action('woocommerce_before_single_product_summary');
        ?>
    </div>

    <div class="summary entry-summary">
        <?php
        // Display the product title
        the_title('<h1 class="product_title entry-title">', '</h1>');

        // Custom price display for variable products
        if ($product->is_type('variable')) {
            $variation_prices = $product->get_variation_prices();
            $max_price = max($variation_prices['price']);
            echo '<p class="price" data-default-price="' . $max_price . '">' . wc_price($max_price) . '</p>';
        } else {
            // Display the regular price
            echo '<p class="price">' . $product->get_price_html() . '</p>';
        }

        // Display product rating, SKU, categories, and tags
        woocommerce_template_single_meta();

        // Display the short description
        woocommerce_template_single_excerpt();

        get_template_part('woocommerce/single-product/product-variation-swatches');

        get_template_part('woocommerce/single-product/product-artwork');

        ?>
        <div style="clear:both"></div>
        <section class="uk-grid mobile_active" uk-grid>

            <div class="uk-width-1-1 elementor-element elementor-widget">
                <?php get_template_part('woocommerce/single-product/product-price-calculator'); ?>
            </div>
        </section>

        <?php

        // Display the add to cart button
        woocommerce_template_single_add_to_cart();


        // Display product sharing options
        woocommerce_template_single_sharing();

        if (function_exists('get_field')) : ?>
            <div class="accordion uk-width-1-1">
                <ul uk-accordion>
                    <?php
                    $accordion_sections = get_field('accordion_sections', 'option');
                    if ($accordion_sections) : ?>
                        <?php foreach ($accordion_sections as $index => $section) : ?>
                            <li class="<?php echo $index === 0 ? 'uk-open' : ''; ?>">
                                <a class="uk-accordion-title" href="javascript:void(0)"><?php echo esc_html($section['section_title']); ?></a>
                                <div class="uk-accordion-content"><?php echo wp_kses_post($section['section_content']); ?></div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>




    </div>


    <div class="woocommerce-tabs wc-tabs-wrapper">
        <?php
        // Display the product tabs (description, additional information, reviews)
        woocommerce_output_product_data_tabs();
        ?>
    </div>

    <div class="related products">
        <?php
        // Display related products
        woocommerce_output_related_products();
        ?>
    </div>

</div>

<style>
    .woocommerce div.quantity,
    .woocommerce .quantity input.qty {
        display: none !important;
    }

    .cfvsw-swatches-container.cfvsw-product-container[swatches-attr="attribute_pa_color"],
    .cfvsw-swatches-container.cfvsw-product-container[swatches-attr="attribute_pa_quantity"] {
        display: none !important;
    }

    .cfvsw-swatches-container.cfvsw-product-container[swatches-attr="attribute_pa_print-type"],
    .woocommerce-variation-price {
        display: none;
    }
</style>

<script>
    jQuery(document).ready(function($) {
        function addPrintAreaRow() {
            var newRow = $('.allprintareas:last').clone();
            newRow.find('[id]').removeAttr('id');
            newRow.find('select, input').val('');
            newRow.find('.color-swatch').removeClass('selected');
            newRow.insertAfter('.allprintareas:last');

            // Apply select functionality or event listeners to the newRow
            newRow.find('select.printtype').on('change', function() {
                // Handle change event
                console.log('Print type changed in a cloned row');
            });
        }

        $(document).on('click', '.addanotherone_ar', function() {
            addPrintAreaRow();
        });



        function updatePrice(printType, quantity) {
            var adjustedPrintType = printType.replace(/_/g, '-');
            var priceElement = $('#' + adjustedPrintType + '_ar .price_column_ar[data-quantity="' + quantity + '"]');
            var defaultPrice = $('.price').data('default-price');

            if (priceElement.length) {
                var priceText = priceElement.find('.range_price_ar').text();
                var priceMatch = priceText.match(/\d+(\.\d{1,2})?/);

                if (priceMatch) {
                    $('.price').text('Price: ' + priceMatch[0]).show();
                } else {
                    $('.price').text('Price: ' + defaultPrice).show();
                }
            } else {
                $('.price').text('Price: ' + defaultPrice).show();
            }
        }

        function highlightPriceAndPrintArea() {
            var selectedPrintType = $('#print_type').val();
            var selectedQuantity = $('#input_sizes').val();
            var highlightQuantity = selectedQuantity;

            if (selectedQuantity > 1) {
                highlightQuantity = [12, 24, 48, 96, 144, 288].filter(function(q) {
                    return selectedQuantity <= q;
                })[0];
            }

            $('.title_ar_table').removeClass('bg-red');
            $('.price_column_ar').removeClass('bg-red');

            var adjustedPrintType = selectedPrintType ? selectedPrintType.replace(/_/g, '-') : '';
            if (adjustedPrintType) {
                $('#' + adjustedPrintType + '_ar .title_ar_table').addClass('bg-red');

                if (selectedQuantity) {
                    $('#' + adjustedPrintType + '_ar .price_column_ar').each(function() {
                        if ($(this).data('quantity') == highlightQuantity) {
                            $(this).addClass('bg-red');
                        }
                    });
                }
            }

            updatePrice(selectedPrintType, highlightQuantity);
        }

        // Initial highlighting on page load
        highlightPriceAndPrintArea();

        // Event listener for changes in print type and quantity
        $(document).on('change', '#print_type, #input_sizes', function() {
            highlightPriceAndPrintArea();
            checkSelections();
        });

        // Event listener for color swatch selection
        $(document).on('click', '.color-swatch', function() {
            $('.color-swatch').removeClass('selected');
            $(this).addClass('selected');
            highlightPriceAndPrintArea();
            checkSelections();
        });

        // Helper function to enable or disable Add to Cart button
        function checkSelections() {
            var colorSelected = $('.color-swatch.selected').length > 0;
            var printTypeSelected = $('#print_type').val();
            var quantitySelected = $('#input_sizes').val() && $('#input_sizes').val() > 0;

            if (colorSelected && printTypeSelected && quantitySelected) {
                $('.single_add_to_cart_button').prop('disabled', false).removeClass('disabled');
            } else {
                $('.single_add_to_cart_button').prop('disabled', true).addClass('disabled');
            }
        }

        // Initial check when the page loads
        checkSelections();

        // On Add to Cart button click, set the custom attributes in the form
        $(document).on('click', '.single_add_to_cart_button', function(e) {
            e.preventDefault();

            var $form = $(this).closest('form.cart');

            var color = $('.color-swatch.selected').data('color');
            var printType = $('#print_type').val();
            var quantity = $('#input_sizes').val();
            var variationId = $('.price_column_ar.bg-red').data('variation-id');
            var adjustedPrintType = printType ? printType.replace(/_/g, '-') : '';

            if (color) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'color',
                    value: color
                }).appendTo($form);
            }

            if (printType) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'print_type',
                    value: adjustedPrintType
                }).appendTo($form);
            }

            if (quantity) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'input_sizes',
                    value: quantity
                }).appendTo($form);
            }

            if (variationId) {
                $('<input>').attr({
                    type: 'hidden',
                    name: '_variation_id',
                    value: variationId
                }).appendTo($form);
            }

            $form.submit();
        });

    });
</script>



<?php do_action('woocommerce_after_single_product'); ?>