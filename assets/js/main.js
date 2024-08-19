jQuery(document).ready(function () {
    jQuery("#accordian_wrapper_ar").on("click",'.accordian_ar_mi_head',function(){
        jQuery(this).siblings(".accordian_ar_mi_desc").slideToggle();
        jQuery(this).find(".accord_icons_ar i").toggle();
    })
});