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
                    <input type="number" placeholder="0" min="0" value="0" name="input_sizes" id="input_sizes" product-id="<?= the_ID(); ?>">
                </div>
            </div>
        </div>
        <div class="freeoptions_progress_wrap">
            <div class="progressbarwrapper_head">
                <h3 id="addmore_headings_arprg">Add more <span id="quan_left_progress_ar">36</span> to avail offer</h3>
                <div class="tooltip_info_ar" uk-tooltip="title: Hello World; pos: bottom-left">
                    <img src=" <?php echo esc_url(get_stylesheet_directory_uri() . '/assets/info.svg'); ?>" alt="" id="infoicon_ar_premium_setup">
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