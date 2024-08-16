<div class="item_price">
    <?php
    /** @var WC_Product_Variable $product */
    $product = wc_get_product(get_the_ID());
    $attributes = $product->get_attributes();

    if (isset($attributes['pa_color']) && $attributes['pa_color']->is_taxonomy()) {
        echo '<div class="swatches_ar"><h5>Color</h5><div class="innerwrap colorPicker">';

        $variation_term_ids = [];

        $variations = $product->get_available_variations();

        foreach ($variations as $variation) {
            if (isset($variation['attributes']['attribute_pa_color'])) {
                $term_slug = $variation['attributes']['attribute_pa_color'];
                $term = get_term_by('slug', $term_slug, 'pa_color');

                if ($term) {
                    $variation_term_ids[$term->term_id] = $variation['variation_id'];
                }
            }
        }

        if (!empty($variation_term_ids)) {
            $terms = get_terms(array(
                'taxonomy'   => 'pa_color',
                'hide_empty' => true,
                'orderby'    => 'name',
                'order'      => 'ASC',
                'include'    => array_keys($variation_term_ids),
            ));

            if (!is_wp_error($terms) && is_array($terms)) {
                foreach ($terms as $term) {
                    $color_name = esc_attr($term->name);
                    $color_code = get_term_meta($term->term_id, 'product_attribute_color', true);

                    if (!$color_code) {
                        $color_code = get_term_meta($term->term_id, 'cfvsw_color', true);
                    }

                    if (!$color_code) {
                        $color_code = '#cccccc'; // Default color if none is set
                    }

                    $variation_id = $variation_term_ids[$term->term_id]; // Get the variation ID

                    echo "<div class=\"color-swatch\" style=\"background:{$color_code}\" data-variation-id=\"{$variation_id}\" data-color=\"{$term->slug}\"></div>";
                }
            } else {
                echo '<p>No colors found.</p>';
            }
        }

        echo '</div></div>';
    }
    get_template_part('woocommerce/single-product/product-size');

    get_template_part('woocommerce/single-product/product-add-variation');
    ?>

</div>