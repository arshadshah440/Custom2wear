<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div class="summary entry-summary">
        <?php
        /**
         * Hook: woocommerce_single_product_summary.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         * @hooked WC_Structured_Data::generate_product_data() - 60
         */
        do_action('woocommerce_single_product_summary');
        ?>
        <div class="item_price">
            <div class="swatches_ar">
                <h5>Color</h5>
                <div class="innerwrap colorPicker">
                    <?php
                    $colors = get_field('color_swatches', get_the_ID());
                    if ($colors) {
                        foreach ($colors as $color) {
                            $color_name = esc_attr($color['color_name']);
                            $color_code = esc_attr($color['color_code']);
                            echo "<div class=\"{$color_name}\" style=\"background:{$color_code}\"></div>";
                        }
                    } else {
                        echo '<p>No colors available.</p>';
                    }
                    ?>
                </div>
            </div>


            <div class="sizes_ar">
                <div class="d-flex-between-spac-ar sizes_ar_headings_ar">
                    <h5>Size and Quantity</h5>
                    <h6>Quantity: <span id="main_quantity_ar"><b>0</b></span></h6>
                </div>
                <div class="quantity_and_info_ar">
                    <div class="innerwrap sizes_main_div_ar_ar">
                        <div class="size_column_ar">
                            <div class="size_name">
                                <h6>OSFA (One Size Fits All)</h6>
                            </div>
                            <div class="sizes_quantity">
                                <input type="number" placeholder="0" min="0" value="0" name="input_sizes" product-id="<?= the_ID(); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="freeoptions_progress_wrap">
                        <div class="progressbarwrapper_head">
                            <h3 id="addmore_headings_arprg">Add more <span id="quan_left_progress_ar">36</span> to avail offer</h3>
                            <div class="tooltip_info_ar" uk-tooltip="title: Hello World; pos: bottom-left">
                                <img src=" <?php echo esc_url(get_stylesheet_directory_uri() . '/assets/info.svg'); ?>" alt="" id="infoicon_ar_premium_setup">
                                <!-- <div class="tooltip_data_ar" id="tooltip_data_ar_premium_setup" >
                            <img src="https://custom2wear.mi6.global/wp-content/themes/astra-child/assets/arrowtip.svg" alt="" class="tooltip_arrow_ar"> 
                            <p id="premium_setup_tooltop_para_ar">Premium Artwork Setup $30 (Digital Mockup, Unlimited Revisions, Photo of physical patch sent for approval)    </p>
                        </div> -->
                            </div>
                        </div>
                        <div class="progressbarwrapper_quantity">
                            <div class="progressbar_quantity" style="width: 80.56%; background: rgb(170, 31, 34);"></div>

                        </div>

                        <?php
                        $artwork_text = get_field('free_premium_artwork_text');
                        $artwork_value = get_field('free_premium_artwork_value');

                        if ($artwork_text && $artwork_value !== '') {
                        ?>
                            <div class="progress_footer_arr">
                                <h2 id="heading_of_free_feature_ar" free-artwork-fee="<?php echo esc_html($artwork_value); ?>"><?php echo esc_html($artwork_text); ?> <span>$<?php echo esc_html($artwork_value); ?></span></h2>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="progress_footer_arr">
                                <h2 id="heading_of_free_feature_ar">Free Premium Artwork Setup <span>$36</span> </h2>
                            </div>
                        <?php
                        }
                        ?>


                    </div>
                </div>
            </div>
            <div class="addlogo_ar">

                <div class="d-flex-between-spac-ar heading_main_logo_ar">
                    <h5>Add Print Area</h5>
                    <h4 id="see_guide_ar">
                        <a href="#quixk_guides_ar">Quick Guide</a>
                    </h4>
                </div>
                <div class="allprintareas">
                    <div class="addlogo_colum restruct_the_columns_ar">
                        <div class="size_column_ar">
                            <div class="size_name first_with_tooltips">
                                <h6>
                                    Print Type<span>*</span>
                                    <div class="tooltip_info_ar">
                                        <img src=" <?php echo esc_url(get_stylesheet_directory_uri() . '/assets/info.svg'); ?>" alt="" id="infoicon_ar_premium_setup">
                                        <div class="tooltip_data_ar" id="tooltip_data_ar_puff_embroid" style="display: none;">
                                            <img src=" <?php echo esc_url(get_stylesheet_directory_uri() . '/assets/arrowtip.svg'); ?>" alt="" class="tooltip_arrow_ar">
                                            <div class="custom-print-type-main">
                                                <div class="custom-print-type">
                                                    <div class="custom-print-type-input custom-flex-box">
                                                        <div class="custom-print-type-input-text">
                                                            <div class="custom-print-type-input-text-title">
                                                                <h1 id="custom-print-type-input-text-title_ar">Leather patch </h1>
                                                            </div>
                                                            <div class="custom-print-type-input-text-description">
                                                                <p>
                                                                    This method creates a raised look that makes the design pop off the panel of the hat. Only certain designs or larger blocky elements inside a design are able to be puffed.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="custom-print-type-input-img">
                                                            <img src="https://custom2wear.mi6.global/wp-content/uploads/2024/06/Rectangle-10003-1.svg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-print-type">
                                                    <div class="custom-print-type-input custom-flex-box">
                                                        <div class="custom-print-type-input-text">
                                                            <div class="custom-print-type-input-text-title">
                                                                <h1 id="custom-print-type-input-text-title_ar">Embroidery</h1>
                                                            </div>
                                                            <div class="custom-print-type-input-text-description">
                                                                <p>
                                                                    This method is the most common embroidery type. It is what most customers choose and works well for smaller details and intricate designs.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="custom-print-type-input-img">
                                                            <img src="https://custom2wear.mi6.global/wp-content/uploads/2024/06/Rectangle-10004-1-1.svg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-print-type">
                                                    <div class="custom-print-type-input custom-flex-box">
                                                        <div class="custom-print-type-input-text">
                                                            <div class="custom-print-type-input-text-title">
                                                                <h1 id="custom-print-type-input-text-title_ar">Digital Print</h1>
                                                            </div>
                                                            <div class="custom-print-type-input-text-description">
                                                                <p>
                                                                    Digital printing is&nbsp;the process of printing digital-based images directly onto a variety of media substrates. There is no need for a printing plate, unlike with offset printing.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="custom-print-type-input-img">
                                                            <img src="https://custom2wear.mi6.global/wp-content/uploads/2024/06/Rectangle-10005.svg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </h6>
                            </div>
                            <div class="sizes_quantity _print_type custom_dropdown_wrapper_ar_ar z_index_tooltip_cc_ar">
                                <select id="print_type" name="print_type" class="printtype" current-cat="Hat">
                                    <option value="">Normal</option>
                                    <option value="leather_patch" product-id="<?= the_ID(); ?>">Leather Patch</option>
                                    <option value="embroidery" product-id="<?= the_ID(); ?>">Embroidery</option>
                                    <option value="digital_print" product-id="<?= the_ID(); ?>">Digital Print</option>
                                </select>

                                <div class="d_flex_justify_between_ar_ar custom_dropdown_ar_ar">
                                    <h6>Leather Patch</h6>
                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/dropdown.svg'); ?>" alt="">
                                </div>
                                <div class="custom_options_ar" value="" style="display: none;">
                                    <h6 values="leather_patch" product-id="<?= the_ID(); ?>">Leather Patch</h6>
                                    <h6 values="embroidery" product-id="<?= the_ID(); ?>">Embroidery</h6>
                                    <h6 values="digital_print" product-id="<?= the_ID(); ?>">Digital Print</h6>
                                </div>
                            </div>
                        </div>
                        <div class="size_column_ar">
                            <div class="size_name">
                                <h6>Print Area<span>*</span></h6>
                            </div>
                            <div class="sizes_quantity _print_area custom_dropdown_wrapper_ar_ar">
                                <select id="printarea" name="printarea" class="printarea" current-cat="Hat">
                                    <option value="">Choose</option>
                                    <option value="left" product-id="<?= the_ID(); ?>">Left</option>
                                    <option value="right" product-id="<?= the_ID(); ?>">Right</option>
                                    <option value="front" product-id="<?= the_ID(); ?>">Front</option>
                                </select>
                                <div class="d_flex_justify_between_ar_ar custom_dropdown_ar_ar">
                                    <h6>Front</h6>
                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/dropdown.svg'); ?>" alt="">
                                </div>
                                <div class="custom_options_ar" style="display: none;">
                                    <h6 values="left" product-id="<?= the_ID(); ?>">Left</h6>
                                    <h6 values="right" product-id="<?= the_ID(); ?>">Right</h6>
                                    <h6 values="front" product-id="<?= the_ID(); ?>">Front</h6>
                                </div>
                            </div>
                        </div>

                        <div class="size_column_ar patch_colors_selection_ar">
                            <div class="size_name">
                                <h6> Patch Shape<span>*</span></h6>
                            </div>
                            <div class="sizes_quantity">
                                <input type="text" name="patchshape" class="patchshape hidethisforever_ar" value="square | Yellow">
                                <div class="patch_colors_selection_ar">
                                    <div class="selections_names_ar">
                                        <div class="selected_color_shaped_ar">
                                            <div class="selected_shaped_color_wrapper">
                                                <div class="selected_shaped_color_rect" style="mask-image: url(&quot;&quot;); background-image: url(&quot;&quot;);">
                                                </div>
                                            </div>
                                            <p> <span class="selcted_shape_ar_ar"></span> | <span class="selcted_color_ar_ar"></span></p>
                                        </div>
                                        <div class="dropdown_icons_ar_shapes">
                                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/dropdown.svg'); ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="patch-shape-colors-main" style="display: none;">
                                    <div class="patch-shape-colors">
                                        <div class="patch-shape-heading">
                                            <h1>Select Shape</h1>
                                        </div>
                                        <div class="patch-shape">
                                            <div class="patch-shape-img-text ">
                                                <div class="patch_shape_masking_wrapper_ar_ar">
                                                    <div class="patch_shape_masking_ar_ar" style="mask-image: url(&quot;&quot;); background-image: url(&quot;&quot;);"></div>
                                                </div>
                                                <p> </p>
                                            </div>
                                        </div>
                                        <div class="patch-shape-heading patch-color">
                                            <h1>Select Color</h1>
                                        </div>
                                        <div class="patchesize_ar patch_colors_selection_list_ar">
                                            <div class="innerwrap">
                                                <div class="swatch_ar active_shapes_wraper" attr-name="" style="background-image:url()"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="size_column_ar no_patch hidethis_ar">
                            <div class="size_name">
                                <h6> No. of Colours<span>*</span></h6>
                            </div>
                            <div class="sizes_quantity custom_dropdown_wrapper_ar_ar">
                                <select name="printcolors" class="printcolors" current-cat="Hat" disabled="disabled">
                                    <option value="1" data-cost="0.25">1</option>
                                    <option value="2" data-cost="0.25">2</option>
                                    <option value="3" data-cost="0.25">3</option>
                                    <option value="4" data-cost="0.25">4</option>
                                    <option value="5" data-cost="0.25">5</option>
                                    <option value="6" data-cost="0.25">6</option>
                                    <option value="7" data-cost="0.25">7</option>
                                    <option value="8" data-cost="0.25">8</option>
                                    <option value="9" data-cost="0.25">9</option>
                                    <option value="10" data-cost="0.25">10</option>
                                    <option value="11" data-cost="0.25" style="display: none;">Full Color</option>
                                </select>
                                <div class="d_flex_justify_between_ar_ar custom_dropdown_ar_ar">
                                    <h6>Choose</h6>
                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/dropdown.svg'); ?>" alt="">
                                </div>
                                <div class="custom_options_ar" style="display: none;">
                                    <h6 values="1" data-cost="0.25">1</h6>
                                    <h6 values="2" data-cost="0.25">2</h6>
                                    <h6 values="3" data-cost="0.25">3</h6>
                                    <h6 values="4" data-cost="0.25">4</h6>
                                    <h6 values="5" data-cost="0.25">5</h6>
                                    <h6 values="6" data-cost="0.25">6</h6>
                                    <h6 values="7" data-cost="0.25">7</h6>
                                    <h6 values="8" data-cost="0.25">8</h6>
                                    <h6 values="9" data-cost="0.25">9</h6>
                                    <h6 values="10" data-cost="0.25">10</h6>
                                    <h6 values="11" data-cost="0.25">Full Color</h6>
                                </div>
                            </div>
                        </div>
                        <div class="size_column_ar dottedstylear">
                            <div class="size_name_upload" id="input_ar_0">
                                <img src="https://custom2wear.mi6.global/wp-content/uploads/2024/05/Frame-1000005041.svg" alt="">
                                <input type="text" name="file_art" class="inputfile_ar">
                            </div>
                        </div>
                        <div class="removerlist_ar_area">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/delete.svg'); ?>" alt="">
                        </div>
                    </div>
                </div>



                <div class="addanotherone_ar">
                    <div class="icons">
                        <img src="https://custom2wear.mi6.global/wp-content/themes/astra-child/assets/Mask group.svg" class="img-fluid ?>" alt="">
                    </div>
                    <div class="texticons">
                        <h6>Add another print area</h6>
                    </div>
                </div>


                <div class="premium_artwork_archeck">
                    <input type="checkbox" name="premium_artwork_ar" id="premium_artwork_ar" value="30">
                    <label for="premium_artwork_ar">Premium Artwork Setup $30 (Digital Mockup, Unlimited Revisions, Photo of physical patch sent for approval)</label>
                </div>

                <div class="premium_artwork_archeck" id="orderedthislogo_ar_wrapper">
                    <input type="checkbox" name="orderedthislogo_ar" id="orderedthislogo_ar">
                    <label for="orderedthislogo_ar">I have ordered with this logo before.</label>
                </div>

                <div id="add_instrution_ar_wrapper">
                    <div class="add_instrution_ar premium_artwork_archeck">
                        <input type="checkbox" name="add_instrution_ar" id="add_instrution_ar">
                        <label for="add_instrution_ar">Add Additional Instructions? (Optional)</label>
                    </div>
                    <textarea name="add_instrution_ar_text" id="add_instrution_ar_text" cols="30" rows="4" placeholder="Need something a certain Way? Let us know here"></textarea>
                </div>

                <!---MODAL--->
                <div class="drag_drop_zone_wrapper" style="display: none;" classtoadd="input_ar_0">
                    <div id="drag-and-drop-zone">
                        <button id="closerdrop_ar">×</button>
                        <label for="file-input" class="file_input_ar_ar"> <img src="https://custom2wear.mi6.global/wp-content/themes/astra-child/assets/cloud.svg" alt=""> <span class="heading_label_ar"> Drag and drop your files here </span><span class="subheading_label_ar">(Maximum file size is 5MB)</span> <span class="subheading_label_ar">(Please Check the checkbox below to enable the uploader)</span></label>
                        <input type="file" id="file-input" name="file-input" disabled="">
                        <div class="copyrightcheck_ar">
                            <input type="checkbox" name="copyright_art_ar" id="copyright_art_ar"> <label for="copyright_art_ar"> I OWN THE RIGHTS TO THE ARTWORK BEING USED OR HAVE PERMISSION FROM THE OWNER TO USE IT
                            </label>
                        </div>
                    </div>
                </div>
                <!---MODAL--->











            </div>




        </div>

        <div class="elementor-element elementor-element-471e56b5 elementor-icon-list--layout-inline elementor-widget__width-inherit elementor-hidden-mobile elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="471e56b5" data-element_type="widget" id="freeitemsrequir_ar" data-widget_type="icon-list.default">
            <div class="elementor-widget-container">
                <ul class="elementor-icon-list-items elementor-inline-items">
                    <li class="elementor-icon-list-item elementor-inline-item">
                        <span class="elementor-icon-list-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" style="fill: green;">
                                <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 48c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m140.204 130.267l-22.536-22.718c-4.667-4.705-12.265-4.736-16.97-.068L215.346 303.697l-59.792-60.277c-4.667-4.705-12.265-4.736-16.97-.069l-22.719 22.536c-4.705 4.667-4.736 12.265-.068 16.971l90.781 91.516c4.667 4.705 12.265 4.736 16.97.068l172.589-171.204c4.704-4.668 4.734-12.266.067-16.971z"></path>
                            </svg></span>
                        <span class="elementor-icon-list-text">Free Artwork Setup: <b>Min 12</b></span>
                    </li>
                    <li class="elementor-icon-list-item elementor-inline-item">
                        <span class="elementor-icon-list-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" style="fill: green;">
                                <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 48c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m140.204 130.267l-22.536-22.718c-4.667-4.705-12.265-4.736-16.97-.068L215.346 303.697l-59.792-60.277c-4.667-4.705-12.265-4.736-16.97-.069l-22.719 22.536c-4.705 4.667-4.736 12.265-.068 16.971l90.781 91.516c4.667 4.705 12.265 4.736 16.97.068l172.589-171.204c4.704-4.668 4.734-12.266.067-16.971z"></path>
                            </svg></span>
                        <span class="elementor-icon-list-text"> Free Shipping: <b>Min 24</b></span>
                    </li>
                    <li class="elementor-icon-list-item elementor-inline-item">
                        <span class="elementor-icon-list-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-times-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" style="fill: red;">
                                <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path>
                            </svg></span>
                        <span class="elementor-icon-list-text">Free Premium Setup: <b>Max 36</b></span>
                    </li>
                </ul>
            </div>
        </div>




    </div>
    <div style="clear:both"></div>

    <section class="uk-grid" uk-grid>

        <div class="uk-width-1-2 elementor-element elementor-widget" id="move_mobile">
            <div class="elementor-widget-container">
                <h2 id="price_calculator_ar_ar">Price calculator</h2>
                <div class="normal_price_table_ar_all" id="table_ar">
                    <div class="grid_tem_ar8">
                        <div class="title_ar_table">
                            <h6>Print Type</h6>
                        </div>
                        <?php $quantities = ['1', '12', '24', '48', '96', '144', '288']; ?>
                        <?php foreach ($quantities as $quantity) : ?>
                            <div class="price_column_ar" data-quantity="<?php echo esc_attr($quantity); ?>">
                                <div class="range_ar"><?php echo esc_html($quantity); ?> Item</div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php
                    $print_types = [
                        'normal' => 'Normal',
                        'leather_patch' => 'Leather Patch',
                        'embroidery' => 'Embroidery',
                        'digital_print' => 'Digital Print',
                        'print_area_cost' => 'Print Area Cost',
                        'd_3d' => '3D Puff'
                    ];

                    foreach ($print_types as $print_type_key => $print_type_label) :
                    ?>
                        <div class="grid_tem_ar8" id="<?= $print_type_key ?>_ar">
                            <div class="title_ar_table">
                                <h6 class="print_type_label"><?php echo esc_html($print_type_label); ?></h6>
                            </div>
                            <?php foreach ($quantities as $quantity) :
                                $price_field_name = 'field_' . $print_type_key . '_price_' . $quantity;
                                $price = get_field($price_field_name, get_the_ID());
                            ?>
                                <div class="price_column_ar" data-quantity="<?php echo esc_attr($quantity); ?>" data-price="<?php echo esc_attr($price); ?>">
                                    <div class="range_price_ar">
                                        <?php if ($price) : ?>
                                            $<?php echo esc_html($price); ?>
                                        <?php else : ?>
                                            N/A
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>


        <?php if (have_rows('accordion_sections')) : ?>
            <div class="accordion uk-width-1-2">
                <ul uk-accordion>
                    <?php
                    $first = true;
                    while (have_rows('accordion_sections')) : the_row();
                    ?>
                        <li class="<?php echo $first ? 'uk-open' : ''; ?>">
                            <a class="uk-accordion-title" href="#"><?php the_sub_field('section_title'); ?></a>
                            <div class="uk-accordion-content">
                                <p><?php the_sub_field('section_content'); ?></p>
                            </div>
                        </li>
                        <?php $first = false;
                        ?>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>


    </section>

    <script>
        jQuery(window).on('load', function() {
            var productId = $('input[name="input_sizes"]').attr('product-id');
            // Retrieve and validate saved values
            var savedQuantity = localStorage.getItem('product_quantity_' + productId);
            var savedPrintType = localStorage.getItem('selectedPrintType_' + productId) || 'normal';
            var savedPrintArea = localStorage.getItem('selectedPrintArea_' + productId) || '';
            savedQuantity = parseInt(savedQuantity, 10) || 0;
            $('.quantity').hide();
            $('#print_type').val(savedPrintType.replace('_ar', '') || 'normal');
            $('#printarea').val(savedPrintArea || '');

            if (savedQuantity) {
                var $input = $('input[name="input_sizes"]');
                $input.val(savedQuantity).trigger('change');
                $('#main_quantity_ar b').text(savedQuantity);

                var highlightQuantity = savedQuantity;
                if (savedQuantity > 1) {
                    highlightQuantity = [12, 24, 48, 96, 144, 288].filter(function(q) {
                        return savedQuantity <= q;
                    })[0];
                }

                $('.price_column_ar').removeClass('highlighted');
                $('.title_ar_table').removeClass('highlighted');

                var printTypeId = savedPrintType.endsWith('_ar') ? savedPrintType : savedPrintType + '_ar';
                var printTypeElement = $('#' + printTypeId);
                if (printTypeElement.length) {
                    printTypeElement.find('.print_type_label').each(function() {
                        $(this).closest('.title_ar_table').addClass('highlighted');
                    });

                    if (!isNaN(highlightQuantity)) {
                        var priceColumn = printTypeElement.find('.price_column_ar[data-quantity="' + highlightQuantity + '"]');
                        if (priceColumn.length) {
                            priceColumn.addClass('highlighted');
                        } else {
                            console.warn('Price column for quantity ' + highlightQuantity + ' not found.');
                        }
                    } else {
                        console.warn('Invalid highlightQuantity: ' + highlightQuantity);
                    }
                } else {
                    console.warn('Print type element for ' + printTypeId + ' not found.');
                }
            }

            // Progress bar logic remains unchanged
            var totalQuantityNeeded = $('#heading_of_free_feature_ar').attr("free-artwork-fee") || 36;
            var quantity = savedQuantity || 0;
            var remainingQuantity = Math.max(totalQuantityNeeded - quantity, 0);
            var progressPercentage = Math.min((quantity / totalQuantityNeeded) * 100, 100);

            $('#quan_left_progress_ar').text(remainingQuantity);
            $('.progressbar_quantity').css('width', progressPercentage + '%');
            if (progressPercentage === 100) {
                $('.progressbar_quantity').css('background-color', 'green');
                $('#heading_of_free_feature_ar').text('You have unlocked the Free Premium Artwork Setup!');
            } else {
                $('.progressbar_quantity').css('background-color', '#aa1f22');
                $('#heading_of_free_feature_ar').html('Free Premium Artwork Setup <span>$' + totalQuantityNeeded + '</span>');
            }
        });

        function updateVisibility() {
            var printType = $('#print_type').val();
            var patchColorsSelector = $('.size_column_ar.patch_colors_selection_ar');
            var noColorsSelector = $('.size_column_ar.no_patch');

            if (printType === 'leather_patch') {
                patchColorsSelector.show();
                noColorsSelector.hide();
            } else {
                patchColorsSelector.hide();
                noColorsSelector.show();
            }
        }

        jQuery(document).ready(function($) {

            var productId = $('input[name="input_sizes"]').attr('product-id');
            var savedQuantity = parseInt(localStorage.getItem('product_quantity_' + productId), 10) || 0;
            var savedPrintType = localStorage.getItem('selectedPrintType_' + productId) || 'normal';
            var savedPrintArea = localStorage.getItem('selectedPrintArea_' + productId) || '';

            const $swatches = $('.innerwrap div');
            const storedColor = localStorage.getItem('selectedColor');

            // Highlight the stored color if it exists
            if (storedColor) {
                const $selectedSwatch = $(`.${storedColor}`);
                if ($selectedSwatch.length) {
                    $selectedSwatch.addClass('selected');
                }
            }

            // Click event to highlight selected swatch
            $swatches.on('click', function() {
                const selectedColor = $(this).attr('class').split(' ')[0];
                if (selectedColor != "size_column_ar" && selectedColor !== "sizes_quantity") {
                    $swatches.removeClass('selected');
                    $(this).addClass('selected');
                    localStorage.setItem('selectedColor', selectedColor);
                }

            });

            // $('.addanotherone_ar').on('click', function() {
            //     var newPrintArea = $('#template_print_area').clone().removeAttr('id').removeClass('hidden');
            //     $('#print_areas_container').append(newPrintArea);
            // });

            function updateDropdowns() {
                // Update print type h6 text
                var printTypeText = {
                    'normal_ar': 'Normal',
                    'leather_patch_ar': 'Leather Patch',
                    'embroidery_ar': 'Embroidery',
                    'digital_print_ar': 'Digital Print'
                };

                $('#print_type').val(savedPrintType.replace('_ar', '')); // Update select value
                var printTypeTextToSet = printTypeText[savedPrintType] || 'Normal';
                $('._print_type .custom_dropdown_ar_ar h6').text(printTypeTextToSet);

                // Update print area h6 text
                var printAreaText = {
                    'left': 'Left',
                    'right': 'Right',
                    'front': 'Front'
                };

                $('#printarea').val(savedPrintArea); // Update select value
                var printAreaTextToSet = printAreaText[savedPrintArea] || 'Choose';
                $('._print_area.custom_dropdown_wrapper_ar_ar > .d_flex_justify_between_ar_ar h6').text(printAreaTextToSet);

                // Trigger change events to update any related UI or functionality
                $('#print_type').trigger('change');
                $('#printarea').trigger('change');
            }

            function updateHighlight() {
                var savedPrintType = localStorage.getItem('selectedPrintType_' + productId) || 'normal';
                var savedQuantity = parseInt(localStorage.getItem('product_quantity_' + productId), 10) || 0;
                var dropdownValue = savedPrintType.replace('_ar', '');
                $('#print_type').val(dropdownValue);

                var printTypeId = savedPrintType.endsWith('_ar') ? savedPrintType : savedPrintType + '_ar';
                var highlightQuantity = savedQuantity;

                if (savedQuantity > 1) {
                    highlightQuantity = [12, 24, 48, 96, 144, 288].filter(function(q) {
                        return savedQuantity <= q;
                    })[0];
                }


                $('.price_column_ar, .print_type_label').removeClass('highlighted');
                $('.title_ar_table').removeClass('highlighted');

                var printTypeElement = $('#' + printTypeId);
                if (printTypeElement.length) {
                    printTypeElement.find('.print_type_label').each(function() {
                        $(this).closest('.title_ar_table').addClass('highlighted');
                    });

                    if (!isNaN(highlightQuantity)) {
                        var priceColumn = printTypeElement.find('.price_column_ar[data-quantity="' + highlightQuantity + '"]');
                        if (priceColumn.length) {
                            priceColumn.addClass('highlighted');
                        } else {
                            console.warn('Price column for quantity ' + highlightQuantity + ' not found.');
                        }
                    } else {
                        console.warn('Invalid highlightQuantity: ' + highlightQuantity);
                    }
                } else {
                    console.warn('Print type element for ' + printTypeId + ' not found.');
                }
            }

            function saveToLocalStorage() {
                var printType = $('#print_type').val();
                var printArea = $('#printarea').val();
                var formattedPrintType = printType ? printType + '_ar' : 'normal_ar';
                // var quantity = parseInt($('input[name="input_sizes"]').val(), 10);

                localStorage.setItem('selectedPrintType_' + productId, formattedPrintType);
                //localStorage.setItem('product_quantity_' + productId, quantity);
                localStorage.setItem('selectedPrintArea_' + productId, printArea);
            }


            // Initialize visibility on page load
            function initializeVisibility() {
                var savedPrintType = localStorage.getItem('selectedPrintType_' + productId) || 'normal';
                $('#print_type').val(savedPrintType.replace('_ar', ''));
                updateVisibility();
            }

            $('input[name="input_sizes"]').on('input change', function() {
                //saveToLocalStorage();
                var quantity = parseInt($('input[name="input_sizes"]').val(), 10);

                localStorage.setItem('product_quantity_' + productId, quantity);

                updateHighlight();
            });

            $('#print_type, #printarea').on('change', function() {
                saveToLocalStorage();
                initializeVisibility();
                updateHighlight();

            });

            updateDropdowns();
            updateHighlight();
            initializeVisibility();
        });
    </script>



    <style>
        .hidden {
            display: none;
        }

        .cfvsw-swatches-container.cfvsw-product-container[swatches-attr="attribute_pa_print-type"] {
            display: none;
        }

        .swatches_ar .selected {
            border: 2px solid #ff7f50;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.8), 0 0 15px rgba(255, 127, 80, 0.6);
            transform: scale(1.1);
            transition: all 0.3s ease;
        }


        .price_column_ar.highlighted {
            background-color: #aa1f22;
            color: #ffffff;
        }

        .title_ar_table.highlighted {
            background-color: #aa1f22;
        }

        .title_ar_table.highlighted h6 {
            color: #ffffff;

        }
    </style>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
    <?php do_action('woocommerce_after_single_product'); ?>
    <style>
        .single-product .summary .price {
            display: none;
        }
    </style>