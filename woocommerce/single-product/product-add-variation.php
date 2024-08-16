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