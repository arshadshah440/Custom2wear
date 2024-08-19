<?php

?>
<div class="product_loop_ar">
    <div class="card_ar_mi">
        <div class="featured_image_ar">
            <a href="<?php echo $product->get_permalink(); ?>">
                <?php echo $product->get_image('thumbnail'); ?>
            </a>
        </div>
        <div class="product_details_ar">
            <a href="<?php echo $product->get_permalink(); ?>" class="product_name_ar">
                <h6> <?php echo $product->get_title(); ?></h6>
            </a>
            <div class="d_flex_price_button_ar">
                <div class="price_ar">
                    <?php echo $product->get_price_html(); ?>
                </div>
                <div class="loop_card_btn_ar">
                    <a href="<?php echo $product->get_permalink(); ?>" class="cart_btn_ar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/basket.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>