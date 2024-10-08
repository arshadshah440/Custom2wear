// global variable
var artsetupfreeze = jQuery("#freeartworksetup_ar_ar")
  .find("h2")
  .text()
  .replace(/\$/g, "");
var premiumartsetupe = jQuery("#premium_artwork_ar").attr("value");

var greeniconsvg =
  '<svg aria-hidden="true" class="e-font-icon-svg e-far-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 48c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m140.204 130.267l-22.536-22.718c-4.667-4.705-12.265-4.736-16.97-.068L215.346 303.697l-59.792-60.277c-4.667-4.705-12.265-4.736-16.97-.069l-22.719 22.536c-4.705 4.667-4.736 12.265-.068 16.971l90.781 91.516c4.667 4.705 12.265 4.736 16.97.068l172.589-171.204c4.704-4.668 4.734-12.266.067-16.971z"></path></svg>';

var rediconsvg =
  '<svg aria-hidden="true" class="e-font-icon-svg e-far-times-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path></svg>';
var ppcolorextras = jQuery(
  ".allprintareas .addlogo_colum:first-child .printcolors > option"
).attr("data-cost");
// main
jQuery(document).ready(function ($) {
  // zoom effect
  jQuery("#product_main_image_ae").zoom();

  /****************************** drage and drop zone sections ******************************/

  var artwork = 0;
  var dropZone = $("#drag-and-drop-zone");

  dropZone.on("dragover", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass("dragover");
  });

  dropZone.on("dragleave", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass("dragover");
  });

  dropZone.on("drop", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass("dragover");

    var files = e.originalEvent.dataTransfer.files;
    if ($("#copyright_art_ar").is(":checked")) {
      handleFiles(files);
    } else {
      alert("Please check the checkbox first!!");
    }
  });

  $("#drag-and-drop-zone").on("change", "#file-input", function (e) {
    var filesr = this.files;
    if ($("#copyright_art_ar").is(":checked")) {
      if (this.files[0].size > 5242880) {
        alert("File size should be less than 5 MB");
      } else {
        handleFiles(filesr);
      }
    } else {
      alert("Please check the checkbox first!!");
    }
  });
  jQuery("#closerdrop_ar").on("click", function (e) {
    jQuery(".drag_drop_zone_wrapper").css("display", "none");
  });
  jQuery("#copyright_art_ar").on("click", function (e) {
    if ($("#copyright_art_ar").is(":checked")) {
      jQuery("#file-input").removeAttr("disabled");
    } else {
      jQuery("#file-input").attr("disabled", "disabled");
    }
  });
  function handleFiles(files) {
    jQuery("#loader_mi_ar").css("display", "flex");
    var id = jQuery(".drag_drop_zone_wrapper").attr("classtoadd");
    var iid = `#${id}`;
    var formData = new FormData();
    $.each(files, function (i, file) {
      formData.append("files[]", file);
    });

    formData.append("action", "file_upload");

    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        response = JSON.parse(response);

        if (response.uploaded.length > 0) {
          $.each(response.uploaded, function (index, url) {
            jQuery(iid).find("img").attr("src", url);
          });
          jQuery(".drag_drop_zone_wrapper").css("display", "none");
          jQuery("#loader_mi_ar").css("display", "none");
        }

        if (response.failed.length > 0) {
          $.each(response.failed, function (index, error) {
            uploadStatus.append("<p>Error: " + error + "</p>");
          });
        }
      },
    });
  }

  jQuery(".allprintareas").on("click", ".size_name_upload", function () {
    jQuery(".drag_drop_zone_wrapper").attr("classtoadd", `input_ar_${artwork}`);
    jQuery(".drag_drop_zone_wrapper").find("input[type='file']").val("");
    jQuery(this).attr("id", `input_ar_${artwork}`);
    jQuery(".drag_drop_zone_wrapper").css("display", "flex");
    artwork = artwork + 1;
  });

  /****************************** drage and drop zone sections end ******************************/
  // file ajax end ------------------------------------------------
  /****************************** checkout page address sections wrapping in a div ******************************/
  var city = jQuery("#billing_city_field");
  var state = jQuery("#billing_state_field");
  var postcode = jQuery("#billing_postcode_field");
  var phone = jQuery("#billing_phone_field");

  setTimeout(function () {
    jQuery(
      "<div class='checkout_grid_ar' id='checkout_grid_ar'></div>"
    ).insertBefore("#billing_city_field");
    jQuery("#checkout_grid_ar").append(city);
    jQuery("#checkout_grid_ar").append(state);
    jQuery("#checkout_grid_ar").append(postcode);
    jQuery("#checkout_grid_ar").append(phone);
  }, 2000);

  /****************************** checkout page address sections wrapping in a div end ******************************/

  /****************************** singple product page image change on slides click ******************************/

  jQuery("#pr_image_vslider").on("click", ".slick-slide", function (e) {
    var ccurl = jQuery(this).find("img").attr("src");
    var scrcurl = jQuery(this).find("img").attr("srcset");
    jQuery("#product_main_image_ae").find("img").attr("src", ccurl);
    jQuery("#product_main_image_ae").find("img").attr("srcset", scrcurl);
  });

  /****************************** singple product page image change on slides click end ******************************/

  /****************************** singple product page quantity change ******************************/
  if ($(window).width() <= 768) {
    jQuery("#move_mobile").appendTo("#append_mobile");
  }

  jQuery(".sizes_ar").on("change", 'input[type="number"]', function (e) {
    e.preventDefault();
    var quantity = 0;
    $(".sizes_ar")
      .find('input[type="number"]')
      .each(function (index) {
        quantity = quantity + parseInt($(this).val());
      });
    if (quantity > 0) {
      jQuery(".warning_ar").remove();
    }
    localStorage.setItem("totalquantity", quantity);
    updatecolorsoffeatures(quantity);
    jQuery("#main_quantity_ar").text(quantity);
    var ptype = localStorage.getItem("pptype");

    if (ptype !== "" && ptype !== null) {
      if (ptype == "leather-patch") {
        uodatetable("#leather-patch");
      } else if (ptype == "embroidery") {
        uodatetable("#embroidery");
      } else if (ptype == "digital-print") {
        uodatetable("#digital-print");
      } else if (ptype == "normal") {
        uodatetable("#normal");
      }
      gettotalprice();
    }
  });

  /****************************** singple product page quantity change end ******************************/

  /****************************** singple product page color swatches selections ******************************/

  jQuery(".swatches_ar").on("click", ".swatch_ar", function (e) {
    e.preventDefault();
    jQuery(".swatch_ar").removeClass("active_swatch_ar");
    jQuery(this).addClass("active_swatch_ar");
    var value = jQuery(this).attr("attr-name");
    var pid = jQuery(this).attr("pid");
    jQuery.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "get_variations_price_image",
        color: value,
        product_id: pid,
      },
      success: function (response) {
        var responseData = JSON.parse(response);
        if (responseData["image_url"] !== "") {
          jQuery("#product_main_image_ae")
            .find("img")
            .attr("src", responseData["image_url"]);
          jQuery("#product_main_image_ae")
            .find("img")
            .attr("srcset", responseData["image_srcset"]);
        }

      },
      error: function (xhr, status, error) {
        // Handle error
        console.error("Error generating PDF");
      },
    });

    gettotalprice();
  });

  /****************************** function to update the visualize the current price in the price table end ******************************/

  /****************************** add a new print area list on click ******************************/

  jQuery(".addanotherone_ar").on("click", function (e) {
 
    var arrayval = [];
    jQuery(".addlogo_colum").each(function () {
      var value = jQuery(this).find("select.printarea").val();
      arrayval.push(value);
    });
    var quantity = parseInt(localStorage.getItem("totalquantity"));
    var firstvaluecat = jQuery(".addlogo_colum:first-child")
      .find("select.printtype")
      .attr("current-cat");
    var firstvalue = jQuery(".addlogo_colum:first-child")
      .find("select.printtype")
      .val();
    var firstvaluearea = jQuery(".addlogo_colum:first-child")
      .find("select.printarea")
      .val();
      console.log(firstvaluecat);
      console.log(firstvalue);
      console.log(firstvaluearea);
    if (
      arrayval.length < 4 &&
      firstvalue !== "" &&
      firstvaluecat !== null &&
      firstvalue !== undefined &&
      firstvaluearea !== undefined &&
      firstvaluearea !== "" &&
      firstvaluearea !== null 
    ) {
      jQuery(".addlogo_colum:last-child").clone().appendTo(".allprintareas");

      if (firstvaluecat == "polos" || firstvaluecat == "t-shirt") {
        if (firstvalue !== "digital-print") {
          jQuery(".addlogo_colum:last-child")
            .find(".printcolors")
            .find("option[value='11']")
            .hide();
        }
        jQuery(".addlogo_colum:last-child")
          .find("select.printtype")
          .val(firstvalue);
        jQuery(".addlogo_colum:last-child")
          .find("select.printtype")
          .attr("disabled", true);
      } else {
        show_patch_fields(
          firstvaluecat,
          jQuery(".addlogo_colum:last-child").find(".printcolors")
        );
        jQuery(".addlogo_colum:last-child")
          .find(".printcolors")
          .find("option[value='11']")
          .hide();
        jQuery(".addlogo_colum:last-child")
          .find(".custom_options_ar")
          .find("h6[values='11']")
          .hide();
        jQuery(".addlogo_colum:last-child")
          .find(".printcolors")
          .siblings(".custom_dropdown_ar_ar")
          .find("h6")
          .text("Choose");
        jQuery(".addlogo_colum:last-child")
          .find("select.printtype")
          .val("embroidery");
        jQuery(".addlogo_colum:last-child")
          .find("select.printtype")
          .attr("disabled", true);
        jQuery(".addlogo_colum:last-child")
          .find("select.printarea")
          .attr("disabled", false);
        jQuery(".addlogo_colum:last-child")
          .find("select.printtype")
          .siblings(".custom_options_ar")
          .find("h6[values='embroidery']")
          .trigger("click");
        jQuery(".addlogo_colum:last-child")
          .find("select.printtype")
          .siblings(".custom_dropdown_ar_ar")
          .addClass("disabled_ar_options_ar");
        jQuery(".addlogo_colum:last-child")
          .find("select.printarea")
          .siblings(".custom_dropdown_ar_ar")
          .removeClass("disabled_ar_options_ar");
      }
      jQuery(".addlogo_colum:last-child")
        .find("select.printarea option")
        .each(function () {
          if (arrayval.includes(jQuery(this).val())) {
            jQuery(this).attr("disabled", true);
            jQuery(".addlogo_colum:last-child")
              .find("select.printarea")
              .siblings(".custom_options_ar")
              .find("h6[values='" + jQuery(this).val() + "']")
              .addClass("disabled_ar_options_ar");
          }
        });
      jQuery(".addlogo_colum:last-child")
        .find(".printcolors")
        .attr("disabled", false);
      jQuery(".addlogo_colum:last-child")
        .find(".size_name_upload > img")
        .attr(
          "src",
          "https://custom2wear.mi6.global/wp-content/uploads/2024/05/Frame-1000005041.svg"
        );
      if (arrayval.length == 2) {
        jQuery(".addanotherone_ar").hide();
      }
      jQuery(".addlogo_colum:last-child").find(".printarea").val("");
      gettotalprice();
    } else {
      if (arrayval.length == 3) {
        if (jQuery(".warning_ar").length <= 0) {
          jQuery(".sizes_ar").append(
            "<h6 class='warning_ar'>you can't add more than 3 print areas</h6>"
          );
        } else {
          jQuery(".warning_ar").remove();
          jQuery(".sizes_ar").append(
            "<h6 class='warning_ar'>you can't add more than 3 print areas</h6>"
          );
        }
      } else if (
        firstvalue == "" ||
        firstvaluecat == null ||
        firstvalue == undefined ||
        firstvaluearea == undefined ||
        firstvaluearea == "" ||
        firstvaluearea == null
      ) {
        if (jQuery(".warning_ar").length <= 0) {
          jQuery(".sizes_ar").append(
            "<h6 class='warning_ar'>Please Select the all the values in first area..</h6>"
          );
        } else {
          jQuery(".warning_ar").remove();
          jQuery(".sizes_ar").append(
            "<h6 class='warning_ar'>Please Select the all the values in first area..</h6>"
          );
        }
      }
      //  else {
      //   if (jQuery(".warning_ar").length <= 0) {
      //     jQuery(".sizes_ar").append(
      //       "<h6 class='warning_ar'>Please Increase the quantity to add another print area..</h6>"
      //     );
      //   } else {
      //     jQuery(".warning_ar").remove();
      //     jQuery(".sizes_ar").append(
      //       "<h6 class='warning_ar'>Please Increase the quantity to add another print area..</h6>"
      //     );
      //   }
      // }
    }
  });

  /****************************** add a new print area list on click end ******************************/

  /****************************** listen to change in first row of the print logo area ******************************/

  jQuery(".allprintareas .addlogo_colum:first-child").on(
    "change",
    "select.printtype",
    function (e) {
      e.preventDefault();
      var value = jQuery(this).val();
      show_patch_fields(value, jQuery(this));
      if (value == "leather-patch") {
        uodatetable("#leather-patch");
        jQuery("#thread_colors_ar_ar_ar").hide();
        jQuery("#d_puff_embroidery_wrapper").hide();
        jQuery("#d_3d_ar").hide();
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .attr("disabled", true);
        localStorage.setItem("d_puff_embroidery", 0);
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .find("option[value='11']")
          .hide();
      } else if (value == "embroidery") {
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .find("option[value='11']")
          .hide();
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .siblings(".custom_options_ar")
          .find("h6[values='11']")
          .hide();
        uodatetable("#embroidery");
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .attr("disabled", false);
        jQuery("#thread_colors_ar_ar_ar").show();
        jQuery("#d_3d_ar").css("display", "grid");
        jQuery("#d_puff_embroidery_wrapper").css("display", "flex");
        var valex = jQuery("#d_puff_embroidery_wrapper")
          .find("input[type='checkbox']")
          .val();
        if (
          jQuery("#d_puff_embroidery_wrapper")
            .find("input[type='checkbox']")
            .is(":checked")
        ) {
          localStorage.setItem("d_puff_embroidery", valex);
        } else {
          localStorage.setItem("d_puff_embroidery", 0);
        }
      } else if (value == "digital-print") {
        uodatetable("#digital-print");
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .attr("disabled", false);
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .find("option[value='11']")
          .show();
        jQuery(this)
          .closest(".addlogo_colum")
          .find(".printcolors")
          .siblings(".custom_options_ar")
          .find("h6[values='11']")
          .show();
        jQuery("#thread_colors_ar_ar_ar").hide();
        jQuery("#d_3d_ar").hide();
        jQuery("#d_puff_embroidery_wrapper").hide();
        localStorage.setItem("d_puff_embroidery", 0);
      }
      localStorage.setItem("pptype", value);
      gettotalprice();
    }
  );

  /****************************** listen to change in first row of the print logo area  end******************************/

  // jQuery(".allprintareas .addlogo_colum:not(:first-child)").on(
  //   "change",
  //   "select.printtype",
  //   function (e) {
  //     e.preventDefault();
  //     var value = jQuery(this).val();
  //     if (value == "leather-patch") {
  //       uodatetable("#patch_ar");
  //     } else if (value == "embroidery") {
  //       uodatetable("#embroidery_ar");
  //     } else if (value == "digital-print") {
  //       uodatetable("#print_ar");
  //     }
  //     localStorage.setItem("pptype", value);
  //     var pid = parseInt(jQuery(this).find("option").attr("product-id"));
  //     var currentidss = jQuery(this).closest(".addlogo_colum");
  //     jQuery.ajax({
  //       type: "POST",
  //       url: "/wp-admin/admin-ajax.php",
  //       data: {
  //         action: "changetheareas",
  //         depid: value,
  //         pid: pid,
  //       },
  //       success: function (response) {
  //         var responseData = JSON.parse(response);
  //         var output = "";
  //         responseData["print_sides"].forEach(function (data) {
  //           output +=
  //             "<option value='" +
  //             data +
  //             "' extra='" +
  //             responseData["charges"] +
  //             "'>" +
  //             data +
  //             "</option>";
  //         });
  //         jQuery(
  //           `<p class='mt_10_ar'>this print area will cost you extra ${responseData["charges"]}$.</p>`
  //         ).insertAfter(jQuery(".allprintareas"));
  //         currentidss.find(".printarea").html(output);

  //         gettotalprice();
  //       },
  //       error: function (xhr, status, error) {
  //         // Handle error
  //         console.error("Error generating PDF");
  //       },
  //     });
  //   }
  // );

  /****************************** listen to change in print area input  of the print logo area ******************************/

  jQuery(".allprintareas").on("change", "select.printarea", function (e) {
    e.preventDefault();
    var value = jQuery(this).val();
    var prtype = jQuery(this)
      .closest(".addlogo_colum")
      .find("select.printtype")
      .val();
    var pids = parseInt(
      jQuery(this).find(`option[value='${value}']`).attr("product-id")
    );
    var quantity = localStorage.getItem("totalquantity");
    gettotalprice();

    // var thises = jQuery(this);
    // jQuery.ajax({
    //   type: "POST",
    //   url: "/wp-admin/admin-ajax.php",
    //   data: {
    //     action: "changetheareas",
    //     depid: prtype,
    //     pid: pids,
    //   },
    //   success: function (response) {
    //     thises.find("option").attr("extra", "");
    //     thises.find(`option[value='${value}']`).attr("extra", response);
    //     gettotalprice();
    //   },
    //   error: function (xhr, status, error) {
    //     // Handle error
    //     console.error("Error generating PDF");
    //   },
    // });
  });

  /****************************** listen to change in print area input  of the print logo area end ******************************/
  // printarea
  // jQuery(".allprintareas").on("change", "select.printarea", function () {
  //   var value = jQuery(this).val();
  //   var extra = jQuery(this)
  //     .find("option[value='" + value + "']")
  //     .attr("extra");

  // });
  /****************************** function to add vertical slider ******************************/
  function slickslideroptcl(selector) {
    jQuery(selector).slick({
      arrows: false,
      dots: false,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 3,
      verticalSwiping: true,
      infinite: true,
      vertical: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 3,
            dots: true,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
            vertical: true,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
            vertical: false,
          },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ],
    });
    $(".slick-prev-btn").click(function () {
      $(selector).slick("slickPrev");
    });

    $(".slick-next-btn").click(function () {
      $(selector).slick("slickNext");
    });
    $(".slick-prev-btn").addClass("slick-disabled");
    $(selector).on("afterChange", function () {
      if ($(".slick-prev").hasClass("slick-disabled")) {
        $(".slick-prev-btn").addClass("slick-disabled");
      } else {
        $(".slick-prev-btn").removeClass("slick-disabled");
      }
      if ($(".slick-next").hasClass("slick-disabled")) {
        $(".slick-next-btn").addClass("slick-disabled");
      } else {
        $(".slick-next-btn").removeClass("slick-disabled");
      }
    });
    jQuery(selector).css("display", "block");
  }

  //   for example
  slickslideroptcl("#pr_image_vslider");

  /****************************** function to add vertical slider end ******************************/
  // jQuery(".allprintareas > .addlogo_colum")
  //   .find(".printtype")
  //   .val("embroidery");
  // jQuery(".allprintareas > .addlogo_colum")
  //   .find(".printtype")
  //   .attr("disabled", true);

  /****************************** setting default values ******************************/

  // setting patches shapes and colors

  var imgsrc = jQuery(".patch-shape-colors-main")
    .find(".patch-shape-img-text:first-child")
    .find(".patch_shape_masking_ar_ar")
    .css("mask-image");
  var shapname = jQuery(".patch-shape-colors-main")
    .find(".patch-shape-img-text:first-child")
    .find("p")
    .text();
  var bgsrc = jQuery(".patch-shape-colors-main")
    .find(".patch_colors_selection_list_ar")
    .find(".swatch_ar:first-child")
    .attr("attr-name");
  var selectname = jQuery(".patch-shape-colors-main")
    .find(".patch_colors_selection_list_ar")
    .find(".swatch_ar:first-child")
    .attr("attr-name");
  jQuery(".patch_colors_selection_ar")
    .find(".selcted_shape_ar_ar")
    .text(shapname);
  jQuery(".patch_colors_selection_ar")
    .find(".selected_shaped_color_rect")
    .css("mask-image", imgsrc);
  jQuery(".patch_colors_selection_ar")
    .find(".selected_shaped_color_rect")
    .css("background-color", bgsrc);
  jQuery(".patch_colors_selection_ar")
    .find(".selcted_color_ar_ar")
    .text(selectname);
  jQuery(".patch-shape-colors-main")
    .find(".patch_colors_selection_list_ar")
    .find(".swatch_ar:first-child")
    .addClass("active_shapes_wraper");
  jQuery(".patch-shape-colors-main")
    .find(".patch-shape-img-text:first-child")
    .find("img")
    .addClass("active_shapes_wraper");

  if (
    jQuery(".allprintareas > .addlogo_colum")
      .find(".printarea")
      .find("option[value='front']").length > 0
  ) {
    jQuery(".allprintareas > .addlogo_colum").find(".printarea").val("front");
    jQuery(".allprintareas > .addlogo_colum")
      .find(".printarea")
      .attr("disabled", true);
    jQuery(".allprintareas > .addlogo_colum")
      .find(".printcolors")
      .attr("disabled", true);
  }

  localStorage.setItem("pptype", "");
  localStorage.setItem("totalquantity", 0);
  localStorage.setItem("checked_premium", false);
  localStorage.setItem("d_puff_embroidery", 0);
  jQuery(".sizes_ar").find("input[type='number']").val(0);
  if (jQuery("#price_calculator_ar_ar").length <= 0) {
    jQuery("#freeartworksetup_ar_ar").find("h2").text("0$");
  }
});

/****************************** function visualize the free features based on quantity ******************************/

function updatecolorsoffeatures(quantity) {
  check_premiumupdate(quantity);
  if (quantity >= 12 && quantity < 24) {
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:first-child")
      .find(".elementor-icon-list-icon")
      .html(greeniconsvg);
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:first-child")
      .find("svg")
      .css("fill", "green");

    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:nth-child(2)")
      .find(".elementor-icon-list-icon")
      .html(rediconsvg);

    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:nth-child(2)")
      .find("svg")
      .css("fill", "red");

    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:last-child")
      .find(".elementor-icon-list-icon")
      .html(rediconsvg);

    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:last-child")
      .find("svg")
      .css("fill", "red");

    jQuery("#freeartworksetup_ar_ar").find("h2").text(`0$`);
    jQuery("#shippingcst_ar_ar").find("h2").text(`50$`);
    if (jQuery("#premium_artwork_ar").is(":checked") && quantity < 36) {
      jQuery("#premiumart_ar_ar").find("h2").text(`${premiumartsetupe}$`);
    } else {
      jQuery("#premiumart_ar_ar").find("h2").text(`0$`);
    }
  } else if (quantity >= 24 && quantity < 36) {
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:first-child")
      .find(".elementor-icon-list-icon")
      .html(greeniconsvg);
    jQuery("#freeartworksetup_ar_ar").find("h2").text(`0$`);

    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:nth-child(2)")
      .find(".elementor-icon-list-icon")
      .html(greeniconsvg);

    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:last-child")
      .find(".elementor-icon-list-icon")
      .html(rediconsvg);
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:first-child")
      .find("svg")
      .css("fill", "green");
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:nth-child(2)")
      .find("svg")
      .css("fill", "green");
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:last-child")
      .find("svg")
      .css("fill", "red");
    jQuery("#shippingcst_ar_ar").find("h2").text(`0$`);
    if (jQuery("#premium_artwork_ar").is(":checked") && quantity < 36) {
      jQuery("#premiumart_ar_ar").find("h2").text(`${premiumartsetupe}$`);
    } else {
      jQuery("#premiumart_ar_ar").find("h2").text(`0$`);
    }
  } else if (quantity >= 36) {
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:nth-child(2)")
      .find(".elementor-icon-list-icon")
      .html(greeniconsvg);
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:first-child")
      .find(".elementor-icon-list-icon")
      .html(greeniconsvg);
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:last-child")
      .find(".elementor-icon-list-icon")
      .html(greeniconsvg);
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li")
      .find("svg")
      .css("fill", "green");
    jQuery("#shippingcst_ar_ar").find("h2").text(`0$`);
    jQuery("#freeartworksetup_ar_ar").find("h2").text(`0$`);
    if (jQuery("#premium_artwork_ar").is(":checked") && quantity < 36) {
      jQuery("#premiumart_ar_ar").find("h2").text(`${premiumartsetupe}$`);
    } else {
      jQuery("#premiumart_ar_ar").find("h2").text(`0$`);
    }
  } else {
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li")
      .find("svg")
      .css("fill", "red");
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:nth-child(2)")
      .find(".elementor-icon-list-icon")
      .html(rediconsvg);
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:first-child")
      .find(".elementor-icon-list-icon")
      .html(rediconsvg);
    jQuery("#freeitemsrequir_ar")
      .find("ul")
      .find("li:last-child")
      .find(".elementor-icon-list-icon")
      .html(rediconsvg);
    jQuery("#shippingcst_ar_ar").find("h2").text(`50$`);
    if (jQuery("#orderedthislogo_ar").is(":checked")) {
      jQuery("#freeartworksetup_ar_ar").find("h2").text(`0$`);
    } else {
      jQuery("#freeartworksetup_ar_ar").find("h2").text(`${artsetupfreeze}$`);
    }

    if (jQuery("#premium_artwork_ar").is(":checked") && quantity < 36) {
      jQuery("#premiumart_ar_ar").find("h2").text(`${premiumartsetupe}$`);
    } else {
      jQuery("#premiumart_ar_ar").find("h2").text(`0$`);
    }
  }
}

/****************************** function visualize the free features based on quantity end******************************/
jQuery("#premium_artwork_ar").on("click", function () {
  var quantity = localStorage.getItem("totalquantity");
  if (jQuery(this).is(":checked")) {
    localStorage.setItem("checked_premium", true);
  } else {
    localStorage.setItem("checked_premium", false);
  }
  updatecolorsoffeatures(quantity);
  gettotalprice();
});
/****************************** function visualize the d_puff_embroidery end******************************/
jQuery("#d_puff_embroidery").on("click", function () {
  gettotalprice();
});
/****************************** function visualize the orderedthislogo_ar end******************************/
jQuery("#orderedthislogo_ar").on("click", function () {
  var quantity = localStorage.getItem("totalquantity");
  if (jQuery(this).is(":checked")) {
    jQuery("#premium_artwork_ar").attr("checked", true);
    jQuery("#premium_artwork_ar").attr("disabled", true);
  } else {
    jQuery("#premium_artwork_ar").attr("checked", false);
    jQuery("#premium_artwork_ar").attr("disabled", false);
  }
  updatecolorsoffeatures(quantity);
  gettotalprice();
});
/****************************** function visualize the add_instrution_ar end******************************/
jQuery("#add_instrution_ar").on("click", function () {
  if (jQuery(this).is(":checked")) {
    jQuery("#add_instrution_ar_text").show();
  } else {
    jQuery("#add_instrution_ar_text").hide();
    jQuery("#add_instrution_ar_text").val("");
  }
  gettotalprice();
});
/****************************** function to do all the calculations ******************************/

function gettotalprice() {
  puffEmbroid("#d_3d_ar");
  getpricelist(totaldata);

  var totalprice = 0;
  var quantity = 0;
  var priceperproduct = 0;
  var sizesvar = []; // Initialize sizesvar as an empty array
  var shiipingcost = jQuery("#shippingcst_ar_ar").find("h2").text();
  var artsetupfree = jQuery("#freeartworksetup_ar_ar").find("h2").text();
  var premiumartsetup = jQuery("#premiumart_ar_ar").find("h2").text();

  shiipingcost = shiipingcost.replace(/\$/g, "");
  artsetupfree = artsetupfree.replace(/\$/g, "");
  premiumartsetup = premiumartsetup.replace(/\$/g, "");
  var totalsetup =
    parseInt(shiipingcost) + parseInt(artsetupfree) + parseInt(premiumartsetup);
  jQuery(".sizes_ar")
    .find("input[type='number']")
    .each(function () {
      if (jQuery(this).val() != "" && jQuery(this).val() > 0) {
        var value = jQuery(this).val();
        var size = jQuery(this)
          .closest(".size_column_ar")
          .find(".size_name > h6")
          .text();
        var sizevalue = { size: size, quantity: value };
        sizesvar.push(sizevalue); // Now this works because sizesvar is initialized
      }
      quantity = quantity + parseInt(jQuery(this).val());
    });
  pa_additional_cost_ar(quantity);
  // You can log sizesvar to see the collected data
  addextrachargesopt();
  update_progressbar();
  if (jQuery(".price_column_ar.bg-red").length > 0) {
    var pricepp = jQuery(".price_column_ar.bg-red")
      .find(".range_price_ar")
      .text();
    pricepp = pricepp.replace(/\$/g, "").trim();
    priceperproduct = parseFloat(pricepp);
  } else {
    var priceppa = parseFloat(
      jQuery("bdi.bg-red").text().replace(/\$/g, "").replace(/\,/g, "")
    );
    priceperproduct = priceppa;
  }

  var extraprice = 0;

  jQuery(".listinsideh_ar")
    .find("li")
    .each(function () {
      var extra = jQuery(this).find(".price_ar").text().replace(/\$/g, "");
      extraprice = extraprice + parseFloat(extra);
    });
  if (extraprice > 0) {
    extraprice = extraprice * quantity;
  } else {
    extraprice = 0;
  }

  if (
    priceperproduct !== 0 &&
    priceperproduct !== "" &&
    !isNaN(priceperproduct) &&
    quantity > 0
  ) {
    totalprice = priceperproduct * quantity + extraprice + totalsetup;
  }
  if (
    priceperproduct !== 0 &&
    priceperproduct !== "" &&
    priceperproduct !== null &&
    priceperproduct !== undefined &&
    isNaN(priceperproduct) !== true
  ) {
    jQuery("#productprice_per_ar").find("h2").text(`${priceperproduct}`);
  }
  var d3_puff = localStorage.getItem("d_puff_embroidery");
  totalprice = totalprice + parseFloat(d3_puff);
  totalprice = totalprice.toFixed(2);

  if (!isNaN(totalprice)) {
    jQuery("#totalprice_ar_product").find("#span_ar_product").text(totalprice);
    jQuery("#sticky_price_sector_ar_ar")
      .find(".span_ar_product")
      .text(totalprice);
    jQuery("#sticky_price_sector_ar_ar_mb")
      .find(".span_ar_product")
      .text(totalprice);
  }
  var output = "";
  for (var i = 0; i < sizesvar.length; i++) {
    output += sizesvar[i].size + " : " + sizesvar[i].quantity + ", ";
  }
  jQuery("#quanitiy_ar_ar").find("h2").html(output);
  var allareasdata = gettheprintareaarray();
  var add_instructions = jQuery("#add_instrution_ar_text").val();

  var totaldata = {
    quantity: quantity,
    priceperproduct: priceperproduct,
    extraprice: extraprice,
    totalprice: totalprice,
    sizees: sizesvar,
    allareasdata: allareasdata,
    d3_puff_embroidery: d3_puff,
    add_instructions: add_instructions,
  };
  if (
    quantity <= 0 ||
    jQuery(".active_swatch_ar").length <= 0 ||
    allareasdata.length <= 0 ||
    allareasdata[0].printtype == ""
  ) {
    jQuery("#single_add_to_cart_ar").addClass("disabled_ar_product");
    jQuery("#sticky_add_to_cart_ar_ar").addClass("disabled_ar_product");
  } else {
    jQuery("#single_add_to_cart_ar").removeClass("disabled_ar_product");
    jQuery("#sticky_add_to_cart_ar_ar").removeClass("disabled_ar_product");
  }
  jQuery("#heading_for_sub_total_ar")
    .find("h2")
    .find(".vairation_added_ar")
    .text(sizesvar.length);
  jQuery("#sticky_vairations_sector_ar_ar")
    .find("h2")
    .find(".vairation_added_ar")
    .text(sizesvar.length);
  jQuery("#sticky_vairations_sector_ar_ar_mb")
    .find("h2")
    .find(".vairation_added_ar")
    .text(sizesvar.length);
  jQuery("#heading_for_sub_total_ar")
    .find("h2")
    .find(".quantity_added_ar")
    .text(quantity);
  jQuery("#sticky_vairations_sector_ar_ar")
    .find("h2")
    .find(".quantity_added_ar")
    .text(quantity);
  jQuery("#sticky_vairations_sector_ar_ar_mb")
    .find("h2")
    .find(".quantity_added_ar")
    .text(quantity);
  return totaldata;
}

/****************************** function to do all the calculations end******************************/

/****************************** listen to the change in the color input in print logo area ******************************/

jQuery(".allprintareas").on("change", ".printcolors", function () {
  var printtype = jQuery(this)
    .closest(".addlogo_colum")
    .find(".printtype")
    .val();
  var printarea = jQuery(this)
    .closest(".addlogo_colum")
    .find(".printarea")
    .val();

  if (printtype == "" || printarea == "") {
    if (jQuery(".warning_ar").length <= 0) {
      jQuery(".sizes_ar").append(
        "<h6 class='warning_ar'>you can't add more than 3 print areas</h6>"
      );
    } else {
      jQuery(".warning_ar").remove();
      jQuery(".sizes_ar").append(
        "<h6 class='warning_ar'>you can't add more than 3 print areas</h6>"
      );
    }
    jQuery(this).val(1);
  } else {
    gettotalprice();
  }
});

/****************************** listen to click on add to cart button ******************************/

jQuery("#single_add_to_cart_ar").on("click", function (e) {
  e.preventDefault();
  var pcolor = jQuery(".active_swatch_ar").attr("attr-name");
  var productid = jQuery(".sizes_main_div_ar_ar > .size_column_ar")
    .find("input[type='number']")
    .attr("product-id");

  var alldata = gettotalprice();
  var totalprice = alldata.totalprice;
  var quantity = alldata.quantity;
  jQuery.ajax({
    type: "POST",
    url: "/wp-admin/admin-ajax.php",
    data: {
      action: "addtocartar",
      price: totalprice,
      quantity: quantity,
      product_id: productid,
      colors: pcolor,
      sizear: alldata.sizees, // Pass the sizees
      allareasdata: alldata.allareasdata,
      add_instructions: alldata.add_instructions,
      d3_puff_embroidery: alldata.d3_puff_embroidery,

    },
    success: function (response) {
      if (response.success) {
        // Redirect to cart page on success
        window.location.href = response.data.redirect_url;
      } else {
        alert(response.data.message);
      }
    },
    error: function (xhr, status, error) {
      // Handle error
      console.error("Error generating PDF");
    },
  });
});

/****************************** listen to click on add to cart button end ******************************/

/****************************** function to show extra charges based on print area selections ******************************/
function addextrachargesopt() {
  var totalextra = 0;
  var output = '<ul class="listinsideh_ar">';
  jQuery(".addlogo_colum").each(function (index) {
    var pptypes = jQuery(this).find("select.printtype").val();
    var ppareas = jQuery(this).find("select.printarea").val();
    var ppcolors = jQuery(this).find("select.printcolors").val();
    var ppcolorextrases = parseInt(ppcolors) - 3;
    var pppricess = parseFloat(ppcolorextras * ppcolorextrases).toFixed(2);
    var extra = jQuery(this)
      .find("select.printarea")
      .find("option[value='" + ppareas + "']")
      .attr("extra");
    if (extra !== undefined && extra !== null && extra !== "") {
      if (ppcolors > 3) {
        extra = parseInt(extra) + parseFloat(pppricess);
      }
      output += `<li><span>${pptypes} + ${ppareas} + ${ppcolors}</span><span class='price_ar'>${extra}$</span></li>`;
    } else {
      if (ppcolors > 3) {
        if (ppcolors == 11) {
          ppcolors = "full_color";
        }
        output += `<li><span>${pptypes} + ${ppareas} + ${ppcolors}</span><span  class='price_ar'>${pppricess}$</span></li>`;
      }
    }
  });
  output += "</ul>";
  jQuery("#extracharges_ar_ar").find("h2").html(output);
}
/****************************** function to show extra charges based on print area selections end ******************************/

function pa_additional_cost_ar(quantity) {

  if (
    jQuery(".allprintareas .addlogo_colum:not(:first-child)").find(".printarea")
      .length > 0
  ) {
    jQuery("#pa_additional_cost_ar")
      .find(".price_column_ar")
      .each(function () {
        var currentElement = parseInt(jQuery(this).attr("quantity-id"));
        var nextElement = jQuery(this)
          .next(".price_column_ar")
          .attr("quantity-id");
        if (quantity > currentElement && quantity < nextElement) {
          jQuery(".price_column_ar").removeClass("pa_ar_bg_red");
          jQuery(this).next(".price_column_ar").addClass("pa_ar_bg_red");
          return;
        } else if (nextElement == "" || quantity == currentElement) {
          jQuery(".price_column_ar").removeClass("pa_ar_bg_red");
          jQuery(this).addClass("pa_ar_bg_red");
          return;
        }
      });

    jQuery(".allprintareas .addlogo_colum:not(:first-child)")
      .find(".printarea")
      .each(function () {
        var value = jQuery(this).val();
        if (value !== "") {
          var extraresponse = jQuery(".pa_ar_bg_red")
            .text()
            .replace(/\$/g, "")
            .trim();
          jQuery(this).find("option").attr("extra", "");
          jQuery(this)
            .find(`option[value='${value}']`)
            .attr("extra", extraresponse);
        }
      });
  }
}

function gettheprintareaarray() {
  var printareasall = [];
  jQuery(".allprintareas")
    .find(".addlogo_colum")
    .each(function () {
      var areavalue = jQuery(this).find("select.printarea").val();
      areavalue = jQuery(this)
        .find("select.printarea")
        .find("option[value='" + areavalue + "']")
        .text();
      var printtype = jQuery(this).find("select.printtype").val();
      printtype = jQuery(this)
        .find("select.printtype")
        .find("option[value='" + printtype + "']")
        .text();

      var printcolors = jQuery(this).find("select.printcolors").val();
      if (jQuery(this).find("select.printtype").val() == "leather-patch") {
        printcolors = jQuery(this).find("input[name='patchshape']").val();
      }
      var artworkurl = jQuery(this).find(".size_name_upload > img").attr("src");
      if (artworkurl.includes("Frame-1000005041.svg")) {
        artworkurl = "";
      }
      if (printtype.toLowerCase() !== "choose") {
        var newarea = {
          areavalue: areavalue,
          printtype: printtype,
          printcolors: printcolors,
          artworkurl: artworkurl,
        };
        printareasall.push(newarea);
      }
    });

  return printareasall;
}

jQuery(".allprintareas").on("click", ".removerlist_ar_area", function () {
  jQuery(this).closest(".addlogo_colum").remove();
  jQuery(".addanotherone_ar").show();
  gettotalprice();
  addextrachargesopt();
});
/****************************** singple product page color swatches selections end ******************************/

/****************************** function to update the visualize the current price in the price table ******************************/

function uodatetable(selector) {
  var quantity = parseInt(localStorage.getItem("totalquantity"));
  jQuery(".title_ar_table").removeClass("bg-red");
  jQuery(`${selector}`).find(".title_ar_table").addClass("bg-red");
  jQuery(`${selector}`)
    .find(".price_column_ar")
    .each(function () {
      var currentElement = parseInt(jQuery(this).attr("quantity-id"));

      var nextElement = jQuery(this)
        .next(".price_column_ar")
        .attr("quantity-id");
      if (quantity > currentElement && quantity < nextElement) {
        jQuery(".price_column_ar").removeClass("bg-red");
        jQuery(this).next(".price_column_ar").addClass("bg-red");
        return;
      } else if (nextElement == "" || quantity == currentElement) {
        jQuery(".price_column_ar").removeClass("bg-red");
        jQuery(this).addClass("bg-red");
        return;
      } else if (quantity == 0) {
        jQuery(".price_column_ar").removeClass("pa_ar_bg_red");
        jQuery(".price_column_ar").removeClass("bg-red");
        jQuery(".title_ar_table").removeClass("bg-red");
      }
    });
}
function getpricelist() {
  var sizesvar = [];
  var allareasdata = gettheprintareaarray();

  jQuery(".sizes_ar")
    .find("input[type='number']")
    .each(function () {
      if (jQuery(this).val() != "" && jQuery(this).val() > 0) {
        var value = jQuery(this).val();
        var size = jQuery(this)
          .closest(".size_column_ar")
          .find(".size_name > h6")
          .text();
        var sizevalue = { size: size, quantity: value };
        sizesvar.push(sizevalue); // Now this works because sizesvar is initialized
      }
    });
  if (
    sizesvar.length > 0 &&
    jQuery(".active_swatch_ar").length > 0 &&
    allareasdata.length > 0 &&
    allareasdata[0].printtype !== ""
  ) {
    var pcolor = jQuery(".active_swatch_ar").attr("attr-name");
    var productid = jQuery(".sizes_main_div_ar_ar > .size_column_ar")
      .find("input[type='number']")
      .attr("product-id");
    jQuery.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "addtocartar",
        product_id: productid,
        allareasdata: allareasdata,
        colors: pcolor,
        sizear: sizesvar, // Pass the sizees
        notcart: true,
      },
      success: function (response) {
        if (response.success) {
          // Redirect to cart page on success
          // window.location.href = response.data.redirect_url;
          var id = "#" + response.data.list_id;
          jQuery(id).html(response.data.price_list);
          uodatetable(id);
        } else {
          alert(response.data.message);
        }
      },
      error: function (xhr, status, error) {
        // Handle error
        console.error("Error generating PDF");
      },
    });
  }
}
function check_premiumupdate(quantity) {
  var checked = localStorage.getItem("checked_premium");
  if (checked == "true") {
    if (quantity >= 36) {
      jQuery("#premium_artwork_ar").attr("checked", true);
      jQuery("#premium_artwork_ar").attr("disabled", true);
    } else {
      jQuery("#premium_artwork_ar").attr("checked", true);
      jQuery("#premium_artwork_ar").attr("disabled", false);
    }
  } else {
    if (quantity >= 36) {
      jQuery("#premium_artwork_ar").attr("checked", true);
      jQuery("#premium_artwork_ar").attr("disabled", true);
    } else {
      jQuery("#premium_artwork_ar").attr("checked", false);
      jQuery("#premium_artwork_ar").attr("disabled", false);
    }
  }
}

function puffEmbroid(selector) {
  var quantity = parseInt(localStorage.getItem("totalquantity"));
  jQuery(`${selector}`).find(".title_ar_table").removeClass("bg-red");
  jQuery(`${selector}`).find(".price_column_ar").removeClass("bg-red");
  var dispstatus = jQuery("#d_puff_embroidery_wrapper").css("display");
  if (jQuery("#d_puff_embroidery").is(":checked") && dispstatus !== "none") {
    jQuery(`${selector}`).find(".title_ar_table").addClass("bg-red");

    jQuery(`${selector}`)
      .find(".price_column_ar")
      .each(function () {
        var currentElement = parseInt(jQuery(this).attr("quantity-id"));

        var nextElement = jQuery(this)
          .next(".price_column_ar")
          .attr("quantity-id");
        if (quantity > currentElement && quantity < nextElement) {
          jQuery(`${selector}`).find(".price_column_ar").removeClass("bg-red");
          jQuery(this).next(".price_column_ar").addClass("bg-red");
          return;
        } else if (nextElement == "" || quantity == currentElement) {
          jQuery(`${selector}`).find(".price_column_ar").removeClass("bg-red");
          jQuery(this).addClass("bg-red");
          return;
        } else if (quantity == 0) {
          jQuery(`${selector}`).find(".title_ar_table").removeClass("bg-red");
          jQuery(`${selector}`).find(".price_column_ar").removeClass("bg-red");
        }
      });

    var puffprices = jQuery(`${selector}`)
      .find(".price_column_ar.bg-red")
      .text()
      .replace(/\$/g, "")
      .trim();
    localStorage.setItem("d_puff_embroidery", puffprices);
  } else {
    localStorage.setItem("d_puff_embroidery", 0);
  }
}

function show_patch_fields(patches, thisis) {
  if (patches == "leather-patch") {
    thisis
      .closest(".addlogo_colum")
      .find(".patches_column_ar")
      .removeClass("hidethis_ar");
    thisis
      .closest(".addlogo_colum")
      .find(".size_column_ar:has(.patchshape)")
      .removeClass("hidethis_ar");
    thisis
      .closest(".addlogo_colum")
      .find(".size_column_ar:has(.printcolors)")
      .addClass("hidethis_ar");
    thisis.closest(".addlogo_colum").addClass("restruct_the_columns_ar");
  } else {
    thisis
      .closest(".addlogo_colum")
      .find(".patches_column_ar")
      .addClass("hidethis_ar");
    thisis
      .closest(".addlogo_colum")
      .find(".size_column_ar:has(.patchshape)")
      .addClass("hidethis_ar");
    thisis
      .closest(".addlogo_colum")
      .find(".size_column_ar:has(.printcolors)")
      .removeClass("hidethis_ar");
    thisis.closest(".addlogo_colum").removeClass("restruct_the_columns_ar");
  }
}

/******************************** function to update free premium setup progress bar actions*/

function update_progressbar() {
  var quantity = parseInt(localStorage.getItem("totalquantity"));
  var totalnumbersrequired = 36;
  var progressbar = parseFloat((quantity / totalnumbersrequired) * 100).toFixed(
    2
  );
  var remainingquanityt = totalnumbersrequired - quantity;
  if (quantity < 36) {
    jQuery(".progressbar_quantity").css("width", progressbar + "%");
    jQuery("#quan_left_progress_ar").text(remainingquanityt);
    jQuery(".progressbar_quantity").css("background", "#aa1f22");
  } else {
    jQuery(".progressbar_quantity").css("background", "green");
    jQuery(".progressbar_quantity").css("width", "100%");
    jQuery("#quan_left_progress_ar").text(0);
  }
}

/*************************************** handling the tooltips */

jQuery("body").on("mouseenter mouseleave", ".tooltip_info_ar", function (e) {
  jQuery(this).find(".tooltip_data_ar").toggle();
  jQuery(this).toggleClass("z_index_tooltip_cc_ar");
});

/*********************************** handle patch shape and colors input ***********/
jQuery(".allprintareas").on(
  "click",
  ".patch_colors_selection_ar",
  function (e) {
    jQuery(this).siblings(".patch-shape-colors-main").toggle();
  }
);

/******************************** handle the patch size and colors selections */

jQuery(".patch-shape-colors-main").on(
  "click",
  ".patch-shape-img-text",
  function () {
    var imgsrc = jQuery(this)
      .find(".patch_shape_masking_ar_ar")
      .css("mask-image");
    var shapename = jQuery(this).find("p").text();
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selcted_shape_ar_ar")
      .text(shapename);
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selected_shaped_color_rect")
      .css("mask-image", imgsrc);
    var bgsrc = jQuery(this)
      .closest(".sizes_quantity")
      .find(".patch_colors_selection_list_ar")
      .find(".active_shapes_wraper")
      .css("background-image");
    var colorname = jQuery(this)
      .closest(".sizes_quantity")
      .find(".patch_colors_selection_list_ar")
      .find(".active_shapes_wraper")
      .attr("attr-name");
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selected_shaped_color_rect")
      .css("background-image", bgsrc);
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selcted_color_ar_ar")
      .text(colorname);
    jQuery(".patch-shape-img-text").removeClass("active_shapes_wraper");
    jQuery(this).addClass("active_shapes_wraper");
  }
);

jQuery(".patch_colors_selection_list_ar").on(
  "click",
  ".swatch_ar",
  function () {
    var imgsrc = jQuery(this)
      .closest(".sizes_quantity")
      .find(".patch-shape-img-text.active_shapes_wraper")
      .find(".patch_shape_masking_ar_ar")
      .css("mask-image");
    var shapename = jQuery(this)
      .closest(".sizes_quantity")
      .find(".patch-shape-img-text.active_shapes_wraper")
      .find("p")
      .text();
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selcted_shape_ar_ar")
      .text(shapename);
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selected_shaped_color_rect")
      .css("mask-image", imgsrc);
    var bgsrc = jQuery(this).css("background-image");
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".patch-shape-img-text")
      .find(".patch_shape_masking_ar_ar")
      .css("background-image", bgsrc);
    var coloname = jQuery(this).attr("attr-name");
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selected_shaped_color_rect")
      .css("background-image", bgsrc);
    jQuery(this)
      .closest(".sizes_quantity")
      .find(".selcted_color_ar_ar")
      .text(coloname);
    jQuery(".patch_colors_selection_list_ar")
      .find(".swatch_ar")
      .removeClass("active_shapes_wraper");
    jQuery(this).addClass("active_shapes_wraper");
  }
);

jQuery("body").on("click", function (e) {
  if (
    e.target.className !== "patch-shape-colors-main" &&
    e.target.className !== "patch_colors_selection_ar" &&
    e.target.closest(".patch_colors_selection_ar") == null &&
    e.target.closest(".patch-shape-colors-main") == null
  ) {
    jQuery(".patch-shape-colors-main").hide();
  }
  if (e.target.closest(".custom_dropdown_wrapper_ar_ar") == null) {
    jQuery(".custom_options_ar").hide();
  }
});

/******************************* Handling the custom options  */

jQuery(".allprintareas").on("click", ".custom_dropdown_ar_ar", function (e) {
  e.preventDefault();
  jQuery(".custom_options_ar").hide();
  jQuery(this).siblings(".custom_options_ar").toggle();
  jQuery(".custom_dropdown_wrapper_ar_ar").removeClass("z_index_tooltip_cc_ar");
  jQuery(this)
    .closest(".custom_dropdown_wrapper_ar_ar")
    .addClass("z_index_tooltip_cc_ar");
});

jQuery(".allprintareas").on("click", ".custom_options_ar h6", function (e) {
  e.preventDefault();
  var values = jQuery(this).attr("values");
  var text = jQuery(this).text();
  jQuery(this)
    .closest(".custom_dropdown_wrapper_ar_ar")
    .find(".custom_dropdown_ar_ar h6")
    .text(text);
  jQuery(this)
    .closest(".custom_dropdown_wrapper_ar_ar")
    .find("select")
    .val(values)
    .change();
  jQuery(this).closest(".custom_options_ar").hide();
});

// Cache selectors
var $window = jQuery(window);
var $addToCartWrapper = jQuery("#addtocarwrappere_ar");
var $showOnScroll = jQuery("#showmeonscroll_ar_ar");
var offsetDiv = $addToCartWrapper.offset().top;
var deviceHeight = $window.height();

// Debounce function
function debounce(func, wait) {
  var timeout;
  return function () {
    var context = this,
      args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      timeout = null;
      func.apply(context, args);
    }, wait);
  };
}

// Scroll event handler
var handleScroll = debounce(function () {
  var scrollFromTop = $window.scrollTop();
  var totalView = deviceHeight - 150 + scrollFromTop;

  // console.log(totalView, offsetDiv, deviceHeight, scrollFromTop);

  if (totalView > offsetDiv) {
    if (
      $showOnScroll.css("display") === "flex" &&
      $addToCartWrapper.hasClass("makeitstick_ar_ar")
    ) {
      $addToCartWrapper.removeClass("makeitstick_ar_ar");
      $showOnScroll.slideUp();
    }
  } else {
    if (
      $showOnScroll.css("display") === "none" &&
      !$addToCartWrapper.hasClass("makeitstick_ar_ar")
    ) {
      $addToCartWrapper.addClass("makeitstick_ar_ar");
      $showOnScroll.css("display", "flex");
    }
  }
}, 100); // Adjust the debounce wait time as needed

// Bind the scroll event
$window.scroll(handleScroll);
jQuery("body").on("click", "#sticky_add_to_cart_ar_ar", function (e) {
  e.preventDefault();
  jQuery("#single_add_to_cart_ar").trigger("click");
});

jQuery(".close_icon_floating").on("click", function (e) {
  jQuery("#showmeonscroll_ar_ar").slideUp();
});
jQuery(".floating_icons_viewer").on("click", function (e) {
  var display = jQuery("#showmeonscroll_ar_ar").css("display");
  if (display == "none") {
    jQuery("#showmeonscroll_ar_ar").css("display", "flex");
  } else {
    jQuery("#showmeonscroll_ar_ar").slideUp();
  }
});
