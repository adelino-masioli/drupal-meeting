!function(t,e){"use strict";t(document).on("click",".answer-edit-ajax",function(e){var a=JSON.parse(t(this).attr("data-answer"));t("input[data-drupal-selector='edit-answer']").val(a.answer),t("input[data-selector-id='poll-answer-id']").val(a.id),e.preventDefault()}),t(document).on("click",".remove-answer-ajax",function(e){var a=this,n=JSON.parse(t(this).attr("data-answer"));t.ajax({url:t(this).attr("data-answer-url"),data:{id:n.id},type:"POST",dataType:"JSON",success:function(e){t(".poll-answer-form")[0].reset(),t("input[data-selector-id='poll-answer-id']").val(""),t(a).closest("tr").remove()},error:function(t){}}),e.preventDefault()})}(jQuery,Drupal),function(t,e){e.behaviors.meeting={attach:function(e,a){var n,o=document.getElementsByClassName("closebtn");for(n=0;n<o.length;n++)o[n].onclick=function(){var t=this.parentElement;t.style.opacity="0",t.style.display="none"};t(".component-color",e).once("click-color").click(function(){t(this).find("input",e).once("click-color").click(),t(e).find(".component-color",e).find("input").removeOnce("click-color")})}},t(document).on("click",".module-activate-ajax",function(e){var a=t(this).attr("data-id").split("|");t.ajax({url:t(this).attr("data-url"),type:"post",data:{meeting_id:a[0],module:a[1],order:a[2]},dataType:"JSON",success:function(t){},error:function(t){}})}),t(document).ready(function(){t(".action_ajax").click(function(t){t.preventDefault()})}),e.behaviors.AjaxLinkChange={attach:function(a){t(".turbolink",a).once().bind("click",function(a){a.preventDefault();var n={url:t(this).attr("href"),element:this};t(this).closest("tr").remove(),e.ajax(n).execute()})}},e.AjaxCommands.prototype.RemoveTr=function(t,e,a){},e.AjaxCommands.prototype.resetFormCommand=function(e,a,n){t(a.form).each(function(){t(this).find("[data-reset]").val("")})},e.AjaxCommands.prototype.load_partial=function(a,n,o){var i=n.div;t.ajax({url:n.url,type:"GET",contentType:"application/json",dataType:"text",success:function(a){t(i).html(a),a.clear&&(e.settings=a[0].settings,e.attachBehaviors(t(i)[0],e.settings))}}),n.form&&t(n.form)[0].reset()}}(jQuery,Drupal),function(t,e){t(document).on("click",".edit-poll-ajax",function(e){var a=JSON.parse(t(this).attr("data-poll"));t("input[data-drupal-selector='edit-poll-question']").val(a.poll_question),t("input[data-selector-id='poll-id']").val(a.id),e.preventDefault()}),t(document).on("click",".ui-widget-overlay.ui-front",function(){t(".ui-widget-overlay.ui-front").fadeOut(600,function(){t(this).remove()}),t(".custom-class-modal").fadeOut(600,function(){t(this).remove()})}),t(document).on("click",".remove-poll",function(e){var a=this;t.ajax({url:t(this).attr("data-url"),type:"get",contentType:"application/json",dataType:"text",success:function(e){document.getElementById("poll-form").reset(),t("input[data-selector-id='poll-id']").val(""),t(a).closest("tr").remove()},error:function(t){}}),e.preventDefault()}),t(document).on("click",".poll-control-ajax",function(e){var a=this;t.ajax({url:t(this).attr("data-url"),type:"post",data:{id:t(this).attr("data-id")},dataType:"JSON",success:function(e){if("No"===t(a).text())return t(a).text("Yes"),t(a).removeClass("btn--danger"),t(a).addClass("btn--success"),!1;t(a).text("No"),t(a).removeClass("btn--success"),t(a).addClass("btn--danger")},error:function(t){}})}),t(document).on("click",".action-dropdown",function(e){t(".dropdown-active").find(".action-item-dropdown").stop().slideUp(400),t(".action-dropdown").removeClass("dropdown-active"),t(this).find(".action-item-dropdown").stop().slideDown(400),t(this).addClass("dropdown-active"),e.preventDefault()}),t(document).on("mouseleave",".action-dropdown",function(e){t(".dropdown-active").find(".action-item-dropdown").stop().slideUp(400),t(".action-dropdown").removeClass("dropdown-active"),e.preventDefault()})}(jQuery,Drupal),function(t,e){"use strict";t(document).on("click",".update-question-ajax",function(e){var a=this,n=JSON.parse(t(this).attr("data-id")),o=JSON.parse(t(this).attr("data-status"));t.ajax({url:t(this).attr("data-url"),data:{id:n,status:o},type:"POST",dataType:"JSON",success:function(e){t(a).closest("tr").find(".update-question-ajax").attr("data-url",""),t(a).closest("tr").find(".update-question-ajax").removeClass("btn--primary"),t(a).closest("tr").find(".update-question-ajax").removeClass("update-question-ajax")},error:function(t){}}),e.preventDefault()}),t(document).on("click",".delete-question-ajax",function(e){var a=this,n=JSON.parse(t(this).attr("data-id")),o=JSON.parse(t(this).attr("data-status"));t.ajax({url:t(this).attr("data-url"),data:{id:n,status:o},type:"POST",dataType:"JSON",success:function(e){t(a).closest("tr").remove()},error:function(t){}}),e.preventDefault()})}(jQuery,Drupal);