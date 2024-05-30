<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {

        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('astra-theme-css', 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general'));
        wp_enqueue_style('slick-css', trailingslashit(get_stylesheet_directory_uri()) . '/css/slick.css', array(), '1.0.0');
        wp_enqueue_style('cp-css', trailingslashit(get_stylesheet_directory_uri()) . '/css/singlepcustom.css', array(), '1.0.0');
        wp_enqueue_script('child-theme-js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), false, true);
        wp_enqueue_script('child-shop-js', get_stylesheet_directory_uri() . '/js/shop.js', array('jquery'), false, true);
        wp_enqueue_script('optcl-slick', get_stylesheet_directory_uri() . '/js/slick.min.js', array(), '1.0.0', true);
        wp_enqueue_script('optcl-zoom', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.6.1/jquery.zoom.min.js', array('jquery'), '1.0.0', true);
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// END ENQUEUE PARENT ACTION

// add_action('woocommerce_after_add_to_cart_form', 'bbloomer_shipping_rates_single_product');

// function bbloomer_shipping_rates_single_product()
// {
//     global $product;
//     if (!$product->needs_shipping()) return;
//     $zones = WC_Shipping_Zones::get_zones();
//     echo '<div><i class="fas fa-truck"></i> ' . __('Shipping', 'woocommerce');
//     echo '<table>';
//     foreach ($zones as $zone_id => $zone) {
//         echo '<tr><td>';
//         echo $zone['zone_name'] . '</td><td>';
//         $zone_shipping_methods = $zone['shipping_methods'];
//         foreach ($zone_shipping_methods as $index => $method) {
//             $instance = $method->instance_settings;
//             $cost = $instance['cost'] ? $instance['cost'] : $instance['min_amount'];
//             echo $instance['title'] . ' ' . wc_price($cost) . '<br>';
//         }
//         echo '</td></tr>';
//     }
//     echo '</table></div>';
// }


// shortcode

function private_products_carousel_shortcode($atts)
{
    ob_start();

    // Shortcode attributes

    global $product;

    $terms = $product->get_gallery_image_ids();

    // Output carousel HTML
    if (count($terms) > 0) {
?>
        <div class="pr_image_vslider" id="pr_image_vslider">
            <?php foreach ($terms as $term) { ?>
                <div class="item_ar vendor_loop_item">
                    <img src="<?php echo wp_get_attachment_url($term); ?>" alt="" srcset="<?php echo wp_get_attachment_image_srcset($term); ?>">
                </div>
            <?php }; ?>
        </div>
        <div class="slick_carousel_nav">
            <div class="slick-next-btn">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/up.svg" class="img-fluid w-40">
            </div>
            <div class="slick-prev-btn">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/down.svg" class="img-fluid w-40">
            </div>
        </div>

    <?php

    }

    return ob_get_clean();
}
add_shortcode('private_products_carousel', 'private_products_carousel_shortcode');

add_action('woocommerce_cart_calculate_fees', 'remove_shipping_cost_for_large_quantity');

function remove_shipping_cost_for_large_quantity()
{
    global $woocommerce;

    // Check if cart is empty to prevent errors
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    // Get the total quantity of items in the cart
    $total_quantity = $woocommerce->cart->get_cart_contents_count();

    // If the total quantity is more than 10, set shipping cost to zero
    if ($total_quantity > 24) {
        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
            $cart_item['data']->set_shipping_class_id(0);
        }
        // Remove shipping cost
        $woocommerce->cart->add_fee('Free Shipping', -$woocommerce->cart->shipping_total);
    }
}

function cart_calculator_shortcode($atts)
{
    ob_start();

    // Shortcode attributes

    global $product;

    $id = $product->get_id();

    $enable = get_field("enable_customization");
    // Output carousel HTML
    // get_price_table_ar('normal_product_prices_based_on_quantity', 'show_me_ar', 'normal price');
    // get_price_table_ar('product_price_based_on_quantity_for_the_leather_patch', 'show_me_ar', 'leather pitch');
    // get_price_table_ar('product_price_based_on_quantity_for_the_embroidery', 'show_me_ar', 'Embroidery pitch');
    // get_price_table_ar('product_price_based_on_quantity_for_the_digital_print', 'show_me_ar', 'Digital Print');
    // get_price_table_ar_all();
    //  global $product;
    //     if (!$product->needs_shipping()) return;
    //     $zones = WC_Shipping_Zones::get_zones();
    //     echo '<div><i class="fas fa-truck"></i> ' . __('Shipping', 'woocommerce');
    //     echo '<table>';
    //     foreach ($zones as $zone_id => $zone) {
    //         echo '<tr><td>';
    //         echo $zone['zone_name'] . '</td><td>';
    //         $zone_shipping_methods = $zone['shipping_methods'];
    //         foreach ($zone_shipping_methods as $index => $method) {
    //             $instance = $method->instance_settings;
    //             $cost = $instance['cost'] ? $instance['cost'] : $instance['min_amount'];
    //             echo $instance['title'] . ' ' . wc_price($cost) . '<br>';
    //         }
    //         echo '</td></tr>';
    //     }
    //     echo '</table></div>';
    get_swatches_ar('color');
    // Output carousel HTML
    //get sizes
    get_sizes_with_quantity();
    if ($enable) {

        getlogo_print();
    }
    // show_add_logo_print();

    return ob_get_clean();
}
add_shortcode('cart_calculator', 'cart_calculator_shortcode');

function cart_calculator_table_shortcode($atts)
{
    ob_start();

    // Shortcode attributes

    global $product;

    $id = $product->get_id();
    $enable = get_field("enable_customization");
    // Output carousel HTML
    if ($enable) {
        get_price_table_ar_all();
    }
    // show_add_logo_print();

    return ob_get_clean();
}
add_shortcode('cart_calculator_table', 'cart_calculator_table_shortcode');

function get_price_table_ar($repeaterfield, $displayset, $title)
{
    if (have_rows("$repeaterfield")) {
        $count = count(get_field("$repeaterfield"));
        $idofdiv = explode('_', $repeaterfield);
        $countofid = count($idofdiv);
    ?>
        <div class="normal_price_table_ar grid_tem_ar<?php echo $count + 1; ?> <?php echo $displayset; ?>" id="<?php echo $idofdiv[$countofid - 1] . '_ar'; ?>">
            <div class="title_ar_table">
                <h6><?php echo $title; ?></h6>
            </div>
            <?php
            while (have_rows("$repeaterfield")) {
                the_row();
                $range = get_sub_field('quantity_range');
                $price = get_sub_field('product_price_for_the_range');
            ?>

                <div class="price_column_ar" quantity-id="<?php echo $range; ?>">
                    <div class="range_ar"> <?php echo $range; ?> Item</div>
                    <div class="range_price_ar">$ <?php echo $price; ?></div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    }
}
function get_price_table_ar_all()
{
    if (have_rows("price_table")) {
        $count = count(get_field("price_table"));
        $idofdiv = explode('_', "price_table");
        $countofid = count($idofdiv);
        $fieldobj = get_field_object("price_table");
        $arrayskey = array_keys($fieldobj['value'][0]);
    ?>
        <h2 id="price_calculator_ar_ar">Price calculator</h2>
        <div class="normal_price_table_ar_all" id="<?php echo $idofdiv[$countofid - 1] . '_ar'; ?>">

            <div class="grid_tem_ar8">
                <div class="title_ar_table">
                    <h6>Print Type</h6>
                </div>
                <div class="price_column_ar">
                    <div class="range_ar"> <?php echo explode("_", $arrayskey[1])[2]; ?> Item</div>
                </div>
                <div class="price_column_ar">
                    <div class="range_ar"> <?php echo explode("_", $arrayskey[2])[2]; ?> Item</div>
                </div>
                <div class="price_column_ar">
                    <div class="range_ar"> <?php echo explode("_", $arrayskey[3])[2]; ?> Item</div>
                </div>
                <div class="price_column_ar">
                    <div class="range_ar"> <?php echo explode("_", $arrayskey[4])[2]; ?> Item</div>
                </div>
                <div class="price_column_ar">
                    <div class="range_ar"> <?php echo explode("_", $arrayskey[5])[2]; ?> Item</div>
                </div>
                <div class="price_column_ar">
                    <div class="range_ar"> <?php echo explode("_", $arrayskey[6])[2]; ?> Item</div>
                </div>
                <div class="price_column_ar">
                    <div class="range_ar"> <?php echo explode("_", $arrayskey[7])[2]; ?> Item</div>
                </div>
            </div>
            <?php
            while (have_rows("price_table")) {
                the_row();
                $title = get_sub_field('print_type');
                $price1 = get_sub_field('price_for_1_item');
                $price12 = get_sub_field('price_for_12_item');
                $price48 = get_sub_field('price_for_24_item');
                $price96 = get_sub_field('price_for_48_item');
                $price144 = get_sub_field('price_for_96_item');
                $price288 = get_sub_field('price_for_144_item');
                $price432 = get_sub_field('price_for_288_item');
                $id = '';
                if ($title == "Normal") {
                    $id = "quantity_ar";
                } else if ($title == "Leather Patch") {
                    $id = "patch_ar";
                } else if ($title == "Embroidery") {
                    $id = "embroidery_ar";
                } else if ($title == "Digital Print") {
                    $id = "print_ar";
                } else {
                    $id = "pa_additional_cost_ar";
                }
            ?>
                <div class="grid_tem_ar8" id="<?php echo $id; ?>">
                    <div class="title_ar_table">
                        <h6><?php echo $title; ?></h6>
                    </div>
                    <div class="price_column_ar" quantity-id="<?php echo explode("_", $arrayskey[1])[2]; ?>">
                        <div class="range_price_ar"><?php echo (!empty($price1) ? "$" . $price1 : ""); ?></div>
                    </div>
                    <div class="price_column_ar" quantity-id="<?php echo explode("_", $arrayskey[2])[2]; ?>">
                        <div class="range_price_ar"><?php echo (!empty($price12) ? "$" . $price12 : ""); ?></div>
                    </div>
                    <div class="price_column_ar" quantity-id="<?php echo explode("_", $arrayskey[3])[2]; ?>">
                        <div class="range_price_ar"><?php echo (!empty($price48) ? "$" . $price48 : ""); ?></div>
                    </div>
                    <div class="price_column_ar" quantity-id="<?php echo explode("_", $arrayskey[4])[2]; ?>">
                        <div class="range_price_ar"> <?php echo (!empty($price96) ? "$" . $price96 : ""); ?></div>
                    </div>
                    <div class="price_column_ar" quantity-id="<?php echo explode("_", $arrayskey[5])[2]; ?>">
                        <div class="range_price_ar"><?php echo (!empty($price144) ? "$" . $price144 : ""); ?></div>
                    </div>
                    <div class="price_column_ar" quantity-id="<?php echo explode("_", $arrayskey[6])[2]; ?>">
                        <div class="range_price_ar"><?php echo (!empty($price288) ? "$" . $price288 : ""); ?></div>
                    </div>
                    <div class="price_column_ar" quantity-id="<?php echo explode("_", $arrayskey[7])[2]; ?>">
                        <div class="range_price_ar"><?php echo (!empty($price432) ? "$" . $price432 : ""); ?></div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    <?php
    }
}
// get swatches 

function get_swatches_ar($color)
{
    global $product;

    $output = "<div class='swatches_ar'> <h5>Color</h5><div class='innerwrap'>";
    $color_terms = $product->get_attribute("$color");
    $detailed_terms = array();
    $color_termsa_ar =  explode(",", $color_terms);
    foreach ($color_termsa_ar as $color_term) {
        $term = get_term_by('name', $color_term, 'pa_color'); // Use 'pa_' prefix for WooCommerce attributes

        if ($term) {
            $output .= "<div class='swatch_ar' attr-name='" . $color_term . "' style='background-color:" . get_term_meta($term->term_id)['product_attribute_color'][0] . "'></div>";
        }
    }

    $output .= "</div></div>";
    echo $output;
}


function get_sizes_with_quantity()
{
    global $product;
    $sizes = $product->get_attribute('sizes');
    $output = "<div class='sizes_ar'> <div class='d-flex-between-spac-ar sizes_ar_headings_ar'> <h5>Size and Quantity</h5> <h6>Quantity: <span id='main_quantity_ar'><b>0</b></span></h6> </div><div class='innerwrap sizes_main_div_ar_ar'>";
    $sizes_ar =  explode(",", $sizes);
    foreach ($sizes_ar as $size) {
        $output .= "<div class='size_column_ar'> <div class='size_name'> <h6>" . $size . "</h6></div> <div class='sizes_quantity'><input type='number' placeholder='0' min='0' value='0' name='input_sizes' product-id='" . $product->get_id() . "'></div></div>";
    }

    $output .= "</div></div>";
    echo $output;
}

function getlogo_print()
{
    global $product;

    $terms = get_the_terms($product->get_id(), 'product_cat');
    $delurl = get_stylesheet_directory_uri() . '/assets/delete.svg';
    if (have_rows("print_area")) {
        // $count = count(get_field("printer_type_options_available"));
        // $arease = get_field_object("field_664db377bdc5d");
    ?>
        <div class="addlogo_ar">
            <div class="d-flex-between-spac-ar heading_main_logo_ar">
                <h5>Add Print Area</h5>
                <h4 id="see_guide_ar"><a href="#quixk_guides_ar">Quick Guide</a></h4>
            </div>
            <div class="allprintareas">


                <div class="addlogo_colum">
                    <div class='size_column_ar'>
                        <div class='size_name'>
                            <h6> Print Type<span>*</span></h6>
                        </div>
                        <div class='sizes_quantity'><select name='print_type' class='printtype' current-cat='<?php echo $terms[0]->name; ?>'>
                                <?php acf_select_options('field_664db377bdc5d', 'print_types'); ?>
                            </select>
                        </div>
                    </div>
                    <div class='size_column_ar'>
                        <div class='size_name'>
                            <h6> Print Area<span>*</span></h6>
                        </div>
                        <div class='sizes_quantity'><select name='printarea' class='printarea' current-cat='<?php echo $terms[0]->name; ?>'>
                                <?php acf_select_options('field_664db3ff9bd11', 'print_sides'); ?>
                            </select>
                        </div>
                    </div>
                    <div class='size_column_ar'>
                        <div class='size_name'>
                            <h6> No. of Colours<span>*</span></h6>
                        </div>
                        <div class='sizes_quantity'><select name='printcolors' class='printcolors' current-cat='<?php echo $terms[0]->name; ?>'>
                                <?php
                                $limit = 10;
                                for ($i = 1; $i <= $limit; $i++) {
                                ?>
                                    <option value="<?php echo $i; ?>" data-cost="<?php echo get_field("extra_color_fee"); ?>"><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='size_column_ar dottedstylear'>
                        <div class='size_name_upload'>
                            <img src="https://custom2wear.mi6.global/wp-content/uploads/2024/05/Frame-1000005041.svg" alt="">
                            <input type="text" name="file_art" class="inputfile_ar">
                        </div>
                    </div>
                    <div class="removerlist_ar_area">
                        <img src="<?php echo $delurl ?>" alt="">
                    </div>
                </div>

            </div>
            <div class="drag_drop_zone_wrapper">

                <div id="drag-and-drop-zone">
                    <button id="closerdrop_ar">&times;</button>
                    <label for="file-input" class="file_input_ar_ar"> <img src="<?php echo get_stylesheet_directory_uri() . '/assets/cloud.svg' ?>" alt=""> <span class="heading_label_ar"> Drag and drop your files here </span> <span class="subheading_label_ar">(Please Check the checkbox below to enable the uploader)</span></label>
                    <input type="file" id="file-input" name="file-input" disabled>
                    <div class="copyrightcheck_ar">
                        <input type="checkbox" name="copyright_art_ar" id="copyright_art_ar"> <label for="copyright_art_ar"> I OWN THE RIGHTS TO THE ARTWORK BEING USED OR HAVE PERMISSION FROM THE OWNER TO USE IT
                        </label>
                    </div>
                </div>

            </div>

            <div class="addanotherone_ar">
                <div class="icons">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Mask group.svg" class="img-fluid ?>" alt="">
                </div>
                <div class="texticons">
                    <h6>Add another print area</h6>
                </div>
            </div>
            <div class="premium_artwork_archeck">
                <input type="checkbox" name="premium_artwork_ar" id="premium_artwork_ar" value="<?php echo get_field('premium_artwork_setup_fee'); ?>">
                <label for="premium_artwork_ar">Premium Artwork Setup $30 (Digital Mockup, Unlimited Revisions, Photo of physical patch sent for approval)</label>

            </div>
        </div>
    <?php
    }
}

// function show_add_logo_print()
// {
//     $output = "<div class='addlogo_ar'> <div class='d-flex-between-spac-ar'> <h5>Size and Quantity</h5> <h6>Quantity: <span><b>60</b></span></h6> </div><div class='innerwrap'>";
//     if (have_rows('print_area')) {
//         $output = "<div class='size_column_ar'> <div class='size_name'> <h6> Print Type<span>*</span></h6></div> <div class='sizes_quantity'><select name='print_type'>";
//         while (have_rows('print_area')) {
//             the_row();
//             $printtypes = get_sub_field_object('print_types');
//             var_dump($printtypes);
//             $label = get_sub_field('print_type');
//             $labelv =  strtolower(str_replace(" ", "", $label));


//             $output .= "<option value='" . $labelv . "'>" . $label . "</option>";
//         }
//         $output .= "</select></div>";
//     }
//     if (have_rows('printer_area_options_available')) {
//         $output = "<div class='size_column_ar'> <div class='size_name'> <h6> Print Type<span>*</span></h6></div> <div class='sizes_quantity'><select name='print_type'>";
//         while (have_rows('printer_area_options_available')) {
//             the_row();
//             $label = get_sub_field('print_type');
//             $labelv =  strtolower(str_replace(" ", "", $label));


//             $output .= "<option value='" . $labelv . "'>" . $label . "</option>";
//         }
//         $output .= "</select></div>";
//     }
//     $output .= "</div></div>";
//     echo $output;
// }

function acf_select_options($fieldkey, $subfield)
{
    $currentid = get_the_ID();
    $arease = get_field_object("$fieldkey");

    if (have_rows("print_area")) {
        while (have_rows("print_area")) {
            the_row();
            $printtypes = get_sub_field("$subfield");
        }
    }

    if (count($arease) > 0) {
    ?>
        <option value="">Choose</option>
        <?php
        foreach ($arease['choices'] as $value => $label) {
            if (in_array($value, $printtypes)) {
        ?>
                <option value="<?php echo $value; ?>" product-id="<?php echo $currentid; ?>"><?php echo $label; ?></option>
<?php
            }
        }
    }
}


function changetheareas()
{
    if (isset($_POST['depid']) && !empty($_POST['depid'])) {
        $currenttype = $_POST['depid'];
        $pid = intval($_POST['pid']);
        $getfield = '';
        if (have_rows('print_area', $pid)) {
            while (have_rows('print_area', $pid)) {
                the_row();
                $printtypes = get_sub_field('print_types');
                $print_sides = get_sub_field('print_sides');
                $print_area_extra_charges = get_sub_field('print_area_extra_charges');

                if ($printtypes == $currenttype) {
                    $getfield = $print_area_extra_charges;
                }
            }
        }
    }

    echo $getfield;
    die();
}

add_action("wp_ajax_changetheareas", "changetheareas");
add_action("wp_ajax_nopriv_changetheareas", "changetheareas");

function addtocartar()
{

    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce is not active.'));
    }

    // Retrieve product ID, quantity, and custom price from the AJAX request
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $custom_price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $prod_color = isset($_POST['colors']) ? $_POST['colors'] : '';
    $prod_var = isset($_POST['sizear']) ? ($_POST['sizear']) : '';
    $prod_allareasdata = isset($_POST['allareasdata']) ? ($_POST['allareasdata']) : '';


    $custompriceperproduct = 0;

    if ($quantity < 24) {
        $custompriceperproduct = ($custom_price - 50) / $quantity;
    } else {
        $custompriceperproduct = ($custom_price) / $quantity;
    }



    // Store custom price in session to use it when adding to cart
    WC()->session->set('custom_price_' . $product_id, $custompriceperproduct);
    WC()->session->set('custom_color_' . $product_id, $prod_color);
    WC()->session->set('custom_variates_' . $product_id, $prod_var);
    WC()->session->set('custom_areas_' . $product_id, $prod_allareasdata);

    // Add the product to the cart
    $result = WC()->cart->add_to_cart($product_id, $quantity);

    // Check if the product was added successfully
    if ($result) {
        wp_send_json_success(array(
            'message' => 'Product added to cart.',
            'redirect_url' => wc_get_cart_url()
        ));
    } else {
        wp_send_json_error(array('message' => 'Failed to add product to cart.'));
    }
    echo $currenttype;
    die();
}

add_action("wp_ajax_addtocartar", "addtocartar");
add_action("wp_ajax_nopriv_addtocartar", "addtocartar");


function set_custom_price_in_cart($cart_object)
{
    if (!WC()->session->__isset('reload_checkout')) {
        foreach ($cart_object->get_cart() as $key => $value) {
            if (WC()->session->__isset('custom_price_' . $value['product_id'])) {
                $custom_price = WC()->session->get('custom_price_' . $value['product_id']);
                $value['data']->set_price($custom_price);
            }
        }
    }
}
add_action('woocommerce_before_calculate_totals', 'set_custom_price_in_cart');



function handle_file_upload()
{
    $response = array(
        'uploaded' => [],
        'failed' => []
    );

    if (!empty($_FILES['files'])) {
        $files = $_FILES['files'];
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

        foreach ($files['name'] as $key => $name) {
            if ($files['error'][$key] === 0) {
                $temp = $files['tmp_name'][$key];
                $ext = pathinfo($name, PATHINFO_EXTENSION);

                if (in_array($ext, $allowed)) {
                    $upload = wp_upload_bits($name, null, file_get_contents($temp));

                    if ($upload['error'] == false) {
                        $response['uploaded'][$key] = $upload['url'];
                    } else {
                        $response['failed'][$key] = "$name failed to upload.";
                    }
                } else {
                    $response['failed'][$key] = "$name file type is not allowed.";
                }
            } else {
                $response['failed'][$key] = "$name errored with code " . $files['error'][$key];
            }
        }
    }

    echo json_encode($response);
    wp_die(); // this is required to terminate immediately and return a proper response
}
add_action('wp_ajax_file_upload', 'handle_file_upload');
add_action('wp_ajax_nopriv_file_upload', 'handle_file_upload');


// adding custom field to products
// Display custom field on the product page
function enqueue_admin_custom_css()
{
    wp_enqueue_style('admin-custom', get_stylesheet_directory_uri() . '/admin/css/style.css', array(), '1.0.0');
}
add_action('admin_enqueue_scripts', 'enqueue_admin_custom_css');


function add_custom_data_to_order_items($item, $cart_item_key, $values, $order)
{
    $product_id = $item->get_product_id();

    // Retrieve session data
    $custom_price = WC()->session->get('custom_price_' . $product_id);
    $custom_color = WC()->session->get('custom_color_' . $product_id);
    $custom_var = WC()->session->get('custom_variates_' . $product_id);
    $custom_areas = WC()->session->get('custom_areas_' . $product_id);

    // Add session data to order item meta
    if (!empty($custom_color)) {
        $item->add_meta_data('_custom_color', $custom_color);
    }
    if (!empty($custom_var)) {
        $item->add_meta_data('_custom_variates', $custom_var);
    }
    if (!empty($custom_areas)) {
        $item->add_meta_data('_custom_areas', $custom_areas);
    }
}

add_action('woocommerce_checkout_create_order_line_item', 'add_custom_data_to_order_items', 10, 4);

// order details
add_filter('woocommerce_defer_transactional_emails', '__return_true');


// Display custom data in the order admin
function display_custom_data_in_order_admin($item_id, $item, $product)
{

    if ($custom_color = wc_get_order_item_meta($item_id, '_custom_color', true)) {
        echo '<h6><strong>Color:</strong> ' . esc_html($custom_color) . '</h6>';
    }
    if ($custom_variates = wc_get_order_item_meta($item_id, '_custom_variates', true)) {
        $output = '<div class="sizes_ar"><h6><strong>Sizes:</strong> </h6></div>';
        if (is_array($custom_variates) > 0) {
            foreach ($custom_variates as $variates) {
                $output .= "<h6 class='variations_on_cart_ar'>" . $variates['size'] . " * " . $variates['quantity'] . "</h6>";
            }
        }
        echo $output;
    }
    if ($custom_areas = wc_get_order_item_meta($item_id, '_custom_areas', true)) {
        if (is_array($custom_areas) > 0) {
            $output = "<div class='size_attr_ar_cart'><h6>Print Areas : </h6>";
            foreach ($custom_areas as $area) {
                $printtype = (!empty($area['printtype'])) ? "<span>" . $area['printtype'] . "</span> + " : "";
                $printarea = (!empty($area['areavalue'])) ? "<span>" . $area['areavalue'] . "</span> + " : "";
                $printcolor = (!empty($area['printcolors'])) ? "<span>" . $area['printcolors'] . "colors </span>  " : "";
                $artwork = (!empty($area['artworkurl'])) ? " + <a href='" . $area['artworkurl'] . "' target='_blank'>View Artwork</a></h6>" : "";

                $output .= "<h6>" . $printtype . $printarea . $printcolor . $artwork . "</h6>";
            }
            $output .= "</div>";
            echo $output;
        }
    }
}
add_action('woocommerce_admin_order_item_values', 'display_custom_data_in_order_admin', 10, 3);

// Display custom data in the customer order view
function display_custom_data_in_order_view($cart_item, $order_item, $order)
{

    if ($custom_color = wc_get_order_item_meta($order_item->get_id(), '_custom_color', true)) {
        echo '<h6><strong>Color:</strong> ' . esc_html($custom_color) . '</h6>';
    }
    if ($custom_variates = wc_get_order_item_meta($order_item->get_id(), '_custom_variates', true)) {
        $output = '<div class="sizes_ar"><h6><strong>Sizes :</strong> </h6></div>';
        if (is_array($custom_variates) > 0) {
            foreach ($custom_variates as $variates) {
                $output .= "<h5 class='variations_on_cart_ar'>" . $variates['size'] . " * " . $variates['quantity'] . "</h5>";
            }
        }
        echo $output;
    }
    if ($custom_areas = wc_get_order_item_meta($order_item->get_id(), '_custom_areas', true)) {
        if (is_array($custom_areas) > 0) {
            $output = "<div class='size_attr_ar_cart'><h6>Print Areas : </h6>";
            foreach ($custom_areas as $area) {
                $printtype = (!empty($area['printtype'])) ? "<span>" . $area['printtype'] . "</span> + " : "";
                $printarea = (!empty($area['areavalue'])) ? "<span>" . $area['areavalue'] . "</span> + " : "";
                $printcolor = (!empty($area['printcolors'])) ? "<span>" . $area['printcolors'] . "colors </span>  " : "";
                $artwork = (!empty($area['artworkurl'])) ? " + <a href='" . $area['artworkurl'] . "' target='_blank'>View Artwork</a></h6>" : "";

                $output .= "<h6>" . $printtype . $printarea . $printcolor . $artwork . "</h6>";
            }
            $output .= "</div>";
            echo $output;
        }
    }
}
add_action('woocommerce_order_item_meta_end', 'display_custom_data_in_order_view', 10, 3);
