(function ($, Drupal) {
  ("use strict");

  /**
   *
   * Select Poll to update
   *
   */

  $(document).on("click", ".edit-poll-ajax", function (event) {
    var url = $(this).attr("data-url");
    $.ajax({
      url: url,
      type: "get",
      contentType: "application/json",
      dataType: "text",
      success: function (result) {
        var data = JSON.parse(result)["data"];
        $("input[data-selector-id='poll-id']").val(data.id);
        $("input[data-drupal-selector='edit-poll-question']").val(data.poll_question);
      },
      error: function (result) {},
    });

    event.preventDefault();
  });

  $(document).on("click", ".ui-widget-overlay.ui-front", function () {
    $(".ui-widget-overlay.ui-front").fadeOut(600, function () {
      $(this).remove();
    });

    $(".custom-class-modal").fadeOut(600, function () {
      $(this).remove();
    });
  });

  /**
   *
   * Delete a Poll
   *
   */

  $(document).on("click", ".remove-poll", function (event) {
    var tr = this;
    $.ajax({
      url: $(this).attr("data-url"),
      type: "get",
      contentType: "application/json",
      dataType: "text",
      success: function (result) {
        document.getElementById("poll-form").reset();
        $("input[data-selector-id='poll-id']").val("");
        $(tr).closest("tr").remove();
      },
      error: function (result) {},
    });
    event.preventDefault();
  });

  /**
   *
   * Allow multiple choice
   * Activate o page
   * Show results
   */

  $(document).on("click", ".poll-control-ajax", function (event) {
    var btn = this;
    $.ajax({
      url: $(this).attr("data-url"),
      type: "post",
      data: { id: $(this).attr("data-id") },
      dataType: "JSON",
      success: function (result) {
        if ($(btn).text() === "No") {
          $(btn).text("Yes");
          $(btn).removeClass("btn--danger");
          $(btn).addClass("btn--success");
          return false;
        }
        $(btn).text("No");
        $(btn).removeClass("btn--success");
        $(btn).addClass("btn--danger");
      },
      error: function (result) {},
    });
  });


  /**
   *
   * Dropdown
   *
   */


  $(document).on("click", ".action-dropdown", function (event) {

    if ($(this).hasClass("dropdown-active")) {
      $(".dropdown-active").find(".action-item-dropdown").stop().slideDown(400);
      $(".action-dropdown").removeClass("dropdown-active");

      $(this).find(".action-item-dropdown").stop().slideUp(400);
      $(this).removeClass("dropdown-active");
    }else{
       $(".dropdown-active").find(".action-item-dropdown").stop().slideUp(400);
       $(".action-dropdown").removeClass("dropdown-active");

       $(this).find(".action-item-dropdown").stop().slideDown(400);
       $(this).addClass("dropdown-active");
    }

    event.preventDefault();
  });

  $(document).on("mouseleave", ".action-dropdown .action-item-dropdown", function (event) {
    $(".dropdown-active").find(".action-item-dropdown").stop().slideUp(400);
    $(".action-dropdown").removeClass("dropdown-active");

    event.preventDefault();
  });
})(jQuery, Drupal);
