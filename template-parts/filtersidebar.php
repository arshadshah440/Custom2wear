<?php

/**
 * The template for displaying filter sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

?>
<div class="filter_wrapper_ar">
    <div class="filter_accordian_ar">
        <div class="filter_accordian_item_ar">
            <div class="filter_acc_head_ar">
                <h6 class="font_14_400 text_dark_ar">Categories</h6>
                <div class="filter_acc_icon_ar">
                    <i class="fa-solid fa-plus" id="filter_close_ar"></i>
                    <i class="fa-solid fa-minus" id="filter_open_ar"></i>
                </div>
            </div>
            <div class="filter_acc_body_ar" id="categories_wrapper_ar">
                <?php
                $terms = get_terms('product_cat', array(
                    'hide_empty' => false,
                ));
                if (!empty($terms)) {
                    foreach ($terms as $term) {
                ?>
                        <div class="filter_acc_body_item_ar">
                            <input type="checkbox" name="filter_cat" id="filter_cat<?php echo $term->term_id; ?>" class="filter_cat" value="<?php echo $term->term_id; ?>">
                            <label for="filter_cat<?php echo $term->term_id; ?>" class="font_14_400 text_dark_ar"><?php echo $term->name; ?></label>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="filter_accordian_item_ar">
            <div class="filter_acc_head_ar">
                <h6 class="font_14_400 text_dark_ar">Color</h6>
                <div class="filter_acc_icon_ar">
                    <i class="fa-solid fa-plus" id="filter_close_ar"></i>
                    <i class="fa-solid fa-minus" id="filter_open_ar"></i>
                </div>
            </div>
            <div class="filter_acc_body_ar" id="color_wrapper_ar">
                <?php
                $terms = get_terms('pa_color', array(
                    'hide_empty' => false,
                ));
                if (!empty($terms)) {
                    foreach ($terms as $term) {
                        $image = wp_get_attachment_image_url(get_term_meta($term->term_id)['attribute_image']);
                        $backdound = "";
                        $swatehcs = get_term_meta($term->term_id)['cfvsw_color'][0];
                        if (!empty($image)) {
                            $backdound = "background-image:url('$image')";
                        } else {
                            $backdound = "background-color:$swatehcs";
                        }
                ?>
                        <div class="filter_acc_body_item_ar">
                            <input type="checkbox" name="filter_cat" id="filter_cat<?php echo $term->term_id; ?>" class="filter_cat" value="<?php echo $term->term_id; ?> " style=<?php echo $backdound; ?>>
                            <label for="filter_cat<?php echo $term->term_id; ?>" class="font_14_400 text_dark_ar"><?php echo $term->name; ?></label>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="filter_accordian_item_ar">
            <div class="filter_acc_head_ar">
                <h6 class="font_14_400 text_dark_ar">Size</h6>
                <div class="filter_acc_icon_ar">
                    <i class="fa-solid fa-plus" id="filter_close_ar"></i>
                    <i class="fa-solid fa-minus" id="filter_open_ar"></i>
                </div>
            </div>
            <div class="filter_acc_body_ar" id="size_wrapper_ar">
                <?php
                $terms = get_terms('pa_size', array(
                    'hide_empty' => false,
                ));
                if (!empty($terms)) {
                    foreach ($terms as $term) {
                        $image = wp_get_attachment_image_url(get_term_meta($term->term_id)['attribute_image']);
                        $backdound = "";
                        $swatehcs = get_term_meta($term->term_id)['cfvsw_color'][0];
                        if (!empty($image)) {
                            $backdound = "background-image:url('$image')";
                        } else {
                            $backdound = "background-color:$swatehcs";
                        }
                ?>
                        <div class="filter_acc_body_item_ar">
                            <input type="checkbox" name="filter_cat" id="filter_cat<?php echo $term->term_id; ?>" class="filter_cat" value="<?php echo $term->term_id; ?> " style=<?php echo $backdound; ?>>
                            <label for="filter_cat<?php echo $term->term_id; ?>" class="font_14_400 text_dark_ar"><?php echo $term->name; ?></label>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="filter_accordian_item_ar">
            <div class="filter_acc_head_ar">
                <h6 class="font_14_400 text_dark_ar">Price</h6>
                <div class="filter_acc_icon_ar">
                    <i class="fa-solid fa-plus" id="filter_close_ar"></i>
                    <i class="fa-solid fa-minus" id="filter_open_ar"></i>
                </div>
            </div>
            <div class="filter_acc_body_ar" id="size_wrapper_ar">
                <div class="slider-container_ar">
                    <input type="range" min="0" max="5000" value="0" class="range-slider_ar" id="slider1_ar">
                    <input type="range" min="0" max="5000" value="5000" class="range-slider_ar" id="slider2_ar">
                    <div class="slider-track_ar" id="slider-track_ar"></div>
                    <div class="value-labels_ar">
                        <span id="min-value_ar">$0</span>
                        <span id="max-value_ar">$5,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>