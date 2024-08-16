jQuery(document).ready(function ($) {
  function updateCount() {
    var liCount = $("#chips_mi .wpc-filter-chips-list li").length - 1;
    console.log("Number of <li> tags:", liCount);
    $("#filter_counter p").text(liCount);
  }

  $("#filtersidebar_ar").on(
    "click",
    'input[type="checkbox"]',
    function (event) {
      event.preventDefault();
      console.log("yessss");
      setTimeout(function () {
        updateCount();
      }, 4000);
    }
  );
  $("#filtersidebar_ar").on("change", 'input[type="number"]', function () {
    // event.preventDefault();
    console.log("yessss");
    setTimeout(function () {
      updateCount();
    }, 4000);
  });

  $(document).ready(function () {
    var divCount = $(
      ".shop_pr_main_container #grid_view_mi .elementor-grid div"
    ).length;
    console.log("Number of divs in the specific section:", divCount);
  });

  // jQuery("#show_mi").on("change", function (e) {
  //   // e.preventDefault();
  //   jQuery("#postlimiter_ar")
  //     .find(`a[data-type="${jQuery(this).val()}"]`)
  //     .trigger("click");
  //   localStorage.setItem("numbofpost", jQuery(this).val());
  // });
  // if (window.location.href.indexOf("shop") > -1) {
  //   var numofpost = localStorage.getItem("numbofpost");
  //   if (numofpost) {
  //     jQuery("#show_mi").val(numofpost);
  //     jQuery("#show_mi")
  //       .find("option[value=" + numofpost + "]")
  //       .attr("selected", "selected");
  //     jQuery("#showing_values_mi").find("span").text(numofpost);
  //   }
  // }

  jQuery("#show_mi").on("change", function (e) {
    e.preventDefault();
    console.log(jQuery(this).val());
    jQuery("#postlimiter_ar")
      .find(`a[data-type="${jQuery(this).val()}"]`)
      .trigger("click");
    localStorage.setItem("numbofpost", jQuery(this).val());

    // Update the displayed text based on the selected value
    var selectedValue = jQuery(this).val();
    if (selectedValue === "all") {
      jQuery("#showing_values_mi").find("p").html("Showing all results");
    } else {
      jQuery("#showing_values_mi")
        .find("p")
        .html(`Showing all <span>${selectedValue}</span> results`);
    }
  });

  jQuery("#filter_mobile_view_ar").on("click",function(e){
    jQuery("#filter_everything_mi").toggle();
  })
  
  if (window.location.href.indexOf("shop") > -1 ) {
    var numofpost = localStorage.getItem("numbofpost");
    if (numofpost) {
      jQuery("#show_mi").val(numofpost);
      jQuery("#show_mi")
        .find("option[value=" + numofpost + "]")
        .attr("selected", "selected");

      // Update the displayed text based on the stored value
      if (numofpost === "all") {
        jQuery("#showing_values_mi").find("p").html("Showing all results");
      } else {
        jQuery("#showing_values_mi")
          .find("p")
          .html(`Showing all <span>${numofpost}</span> results`);
      }
    }
  }

  // document.addEventListener('DOMContentLoaded', function() {
  //     const gridView = document.getElementById('grid_view_mi');
  //     const listView = document.getElementById('list_view_mi');
  //     const gridIcon = document.getElementById('grid_icon');
  //     const listIcon = document.getElementById('list_icon');

  //     function showGridView() {
  //         listView.style.display = 'none';
  //         gridView.style.display = 'block';
  //         gridIcon.classList.add('active');
  //         listIcon.classList.remove('active');
  //     }

  //     function showListView() {
  //         gridView.style.display = 'none';
  //         listView.style.display = 'block';
  //         listIcon.classList.add('active');
  //         gridIcon.classList.remove('active');
  //     }

  //     // Initially set the grid view as active
  //     showGridView();

  //     gridIcon.addEventListener('click', showGridView);
  //     listIcon.addEventListener('click', showListView);
  // });

  //   document.getElementById('show').addEventListener('change', function() {
  //     var selectedValue = this.value;
  //     var url = new URL(window.location.href);
  //     url.searchParams.set('products_per_page', selectedValue);
  //     window.location.href = url.href;
  // });
});

// jQuery(document).ready(function($) {
//   const $gridView = $('#grid_view_mi');
//   const $listView = $('#list_view_mi');
//   const $gridIcon = $('#grid_icon');
//   const $listIcon = $('#list_icon');

//   function showGridView() {
//       $listView.hide();
//       $gridView.show();
//       $gridIcon.addClass('active');
//       $listIcon.removeClass('active');
//   }

//   function showListView() {
//       $gridView.hide();
//       $listView.show();
//       $listIcon.addClass('active');
//       $gridIcon.removeClass('active');
//   }

//   // Initially set the grid view as active
//   showGridView();

//   $gridIcon.on('click', showGridView);
//   $listIcon.on('click', showListView);
// });
jQuery(document).ready(function ($) {
  const $gridView = $("#grid_view_mi");
  const $gridIcon = $("#grid_icon");
  const $listIcon = $("#list_icon");

  function showGridView() {
    $gridView.removeClass("list_view_ar_active");
    $gridIcon.addClass("active");
    $listIcon.removeClass("active");
    localStorage.setItem("viewMode", "grid");
  }

  function showListView() {
    $gridView.addClass("list_view_ar_active");
    $listIcon.addClass("active");
    $gridIcon.removeClass("active");
    localStorage.setItem("viewMode", "list");
  }

  // Retrieve the view mode from localStorage and set the view accordingly
  const viewMode = localStorage.getItem("viewMode");
  if(window.innerWidth > 768){
  if (viewMode === "list") {
    showListView();
  } else {
    showGridView(); // Default to grid view if no preference is stored
  }
}

  $gridIcon.on("click", showGridView);
  $listIcon.on("click", showListView);
});
