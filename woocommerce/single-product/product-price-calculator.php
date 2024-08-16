<?php

/** @var WC_Product_Variable $product */
$product = wc_get_product(get_the_ID());
$product_data_store = WC_Data_Store::load('product');
$desired_quantity_order = array('1-item', '12-items', '24-items', '48-items', '96-items', '144-items', '288-items');
$desired_print_type_order = array('normal', 'leather-patch', 'embroidery', 'digital-print');

// Get all quantity terms
$quantity_terms = get_terms(array(
    'taxonomy' => 'pa_quantity',
    'hide_empty' => false,
));
$quantities = array();
foreach ($quantity_terms as $term) {
    $quantities[$term->term_id] = $term->slug;
}

// Sort quantities by the desired order
uksort($quantities, function ($a, $b) use ($quantities, $desired_quantity_order) {
    $pos_a = array_search($quantities[$a], $desired_quantity_order);
    $pos_b = array_search($quantities[$b], $desired_quantity_order);
    return $pos_a - $pos_b;
});

// Get all print type terms
$print_types = get_terms(array(
    'taxonomy' => 'pa_print-type',
    'hide_empty' => false,
));

$print_type_terms = array();
foreach ($print_types as $term) {
    $print_type_terms[$term->term_id] = $term->slug;
}

// Sort print types by the desired order
uksort($print_type_terms, function ($a, $b) use ($print_type_terms, $desired_print_type_order) {
    $pos_a = array_search($print_type_terms[$a], $desired_print_type_order);
    $pos_b = array_search($print_type_terms[$b], $desired_print_type_order);
    return $pos_a - $pos_b;
});

// Get all variations and their attributes
$variations = $product->get_available_variations();

?>
<section class="uk-grid" uk-grid>
    <div class="uk-width elementor-element elementor-widget">
        <div class="elementor-widget-container">
            <h2 id="price_calculator_ar_ar">Price calculator</h2>
            <div class="normal_price_table_ar_all" id="table_ar">
                <div class="grid_tem_ar8">
                    <div class="title_ar_table">
                        <h6>Print Type</h6>
                    </div>
                    <?php foreach ($quantities as $quantity_id => $quantity_slug) : $qty = preg_replace('/[^0-9]/', '', $quantity_slug); ?>
                        <div class="price_column_ar quantity-item" data-quantity="<?php echo esc_attr($qty); ?>">
                            <div class="range_ar"><?php echo esc_html(str_replace('-', ' ', ucfirst($quantity_slug))); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($print_type_terms as $print_type_id => $print_type_slug) : ?>
                    <div class="grid_tem_ar8" id="<?php echo esc_attr($print_type_slug); ?>_ar">
                        <div class="title_ar_table">
                            <h6 class="print_type_label"><?php echo esc_html(str_replace('-', ' ', ucfirst($print_type_slug))); ?></h6>
                        </div>
                        <?php foreach ($quantities as $quantity_id => $quantity_slug) :
                            // Prepare attributes for the variation
                            $attributes = array(
                                'attribute_pa_print-type' => $print_type_slug,
                                'attribute_pa_quantity' => $quantity_slug,
                            );

                            // Find the variation ID using the updated logic
                            $variation_id = 0;
                            foreach ($variations as $variation) {
                                $variation_attributes = $variation['attributes'];
                                $match = true;
                                foreach ($attributes as $key => $value) {
                                    if (isset($variation_attributes[$key]) && $variation_attributes[$key] != $value) {
                                        $match = false;
                                        break;
                                    }
                                }
                                if ($match) {
                                    $variation_id = $variation['variation_id'];
                                    break;
                                }
                            }

                            // Check if a valid variation ID is found
                            $price = null;
                            if ($variation_id && $variation_id > 0) {
                                $variation_product = wc_get_product($variation_id);
                                if ($variation_product) {
                                    $price = $variation_product->get_price();
                                }
                            }

                            $qty = preg_replace('/[^0-9]/', '', $quantity_slug);
                        ?>
                            <div class="price_column_ar" data-quantity="<?php echo esc_attr($qty); ?>" data-price="<?php echo esc_attr($price); ?>" data-variation-id="<?php echo esc_attr($variation_id); ?>">
                                <div class="range_price_ar">
                                    <?php echo $price !== null ? '$' . esc_html($price) : 'N/A'; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>