!function(t,a){"use strict";t(document).on("click",".answer-edit-ajax",function(a){var e=JSON.parse(t(this).attr("data-answer"));t("input[data-drupal-selector='edit-answer']").val(e.answer),t("input[data-selector-id='poll-answer-id']").val(e.id),a.preventDefault()}),t(document).on("click",".remove-answer-ajax",function(a){var e=this,n=JSON.parse(t(this).attr("data-answer"));t.ajax({url:t(this).attr("data-answer-url"),data:{id:n.id},type:"POST",dataType:"JSON",success:function(a){t(".poll-answer-form")[0].reset(),t("input[data-selector-id='poll-answer-id']").val(""),t(e).closest("tr").remove()},error:function(t){}}),a.preventDefault()})}(jQuery,Drupal),function(t,a){a.behaviors.meeting={attach:function(a,e){var n,o=document.getElementsByClassName("closebtn");for(n=0;n<o.length;n++)o[n].onclick=function(){var t=this.parentElement;t.style.opacity="0",t.style.display="none"};t(".component-color",a).once("click-color").click(function(){t(this).find("input",a).once("click-color").click(),t(a).find(".component-color",a).find("input").removeOnce("click-color")})}},t(document).on("click",".module-activate-ajax",function(a){var e=t(this).attr("data-id").split("|");t.ajax({url:t(this).attr("data-url"),type:"post",data:{meeting_id:e[0],module:e[1],order:e[2]},dataType:"JSON",success:function(t){},error:function(t){}})}),t(document).ready(function(){t(".action_ajax").click(function(t){t.preventDefault()})}),a.behaviors.AjaxLinkChange={attach:function(e){t(".turbolink",e).once().bind("click",function(e){e.preventDefault();var n={url:t(this).attr("href"),element:this};t(this).closest("tr").remove(),a.ajax(n).execute()})}},a.AjaxCommands.prototype.RemoveTr=function(t,a,e){},a.AjaxCommands.prototype.load_partial=function(e,n,o){var i=n.div;t.ajax({url:n.url,type:"GET",contentType:"application/json",dataType:"text",success:function(e){t(i).html(e),a.settings=e[0].settings,a.attachBehaviors(t(i)[0],a.settings)}}),n.form&&t(n.form)[0].reset()}}(jQuery,Drupal),function(t,a){t(document).on("click",".edit-poll-ajax",function(a){var e=JSON.parse(t(this).attr("data-poll"));t("input[data-drupal-selector='edit-poll-question']").val(e.poll_question),t("input[data-selector-id='poll-id']").val(e.id),a.preventDefault()}),t(document).on("click",".remove-poll",function(a){var e=this;t.ajax({url:t(this).attr("data-url"),type:"get",contentType:"application/json",dataType:"text",success:function(a){document.getElementById("poll-form").reset(),t("input[data-selector-id='poll-id']").val(""),t(e).closest("tr").remove()},error:function(t){}}),a.preventDefault()}),t(document).on("click",".poll-control-ajax",function(a){var e=this;t.ajax({url:t(this).attr("data-url"),type:"post",data:{id:t(this).attr("data-id")},dataType:"JSON",success:function(a){if("No"===t(e).text())return t(e).text("Yes"),t(e).removeClass("btn--danger"),t(e).addClass("btn--success"),!1;t(e).text("No"),t(e).removeClass("btn--success"),t(e).addClass("btn--danger")},error:function(t){}})}),t(document).on("click",".action-dropdown",function(a){t(".dropdown-active").find(".action-item-dropdown").stop().slideUp(400),t(".action-dropdown").removeClass("dropdown-active"),t(this).find(".action-item-dropdown").stop().slideDown(400),t(this).addClass("dropdown-active"),a.preventDefault()}),t(document).on("mouseleave",".action-dropdown",function(a){t(".dropdown-active").find(".action-item-dropdown").stop().slideUp(400),t(".action-dropdown").removeClass("dropdown-active"),a.preventDefault()})}(jQuery,Drupal),function(t,a){"use strict";t(document).on("click",".update-question-ajax",function(a){var e=this,n=JSON.parse(t(this).attr("data-id")),o=JSON.parse(t(this).attr("data-status"));t.ajax({url:t(this).attr("data-url"),data:{id:n,status:o},type:"POST",dataType:"JSON",success:function(a){t(e).closest("tr").find(".update-question-ajax").attr("data-url",""),t(e).closest("tr").find(".update-question-ajax").removeClass("btn--primary"),t(e).closest("tr").find(".update-question-ajax").removeClass("update-question-ajax")},error:function(t){}}),a.preventDefault()}),t(document).on("click",".delete-question-ajax",function(a){var e=this,n=JSON.parse(t(this).attr("data-id")),o=JSON.parse(t(this).attr("data-status"));t.ajax({url:t(this).attr("data-url"),data:{id:n,status:o},type:"POST",dataType:"JSON",success:function(a){t(e).closest("tr").remove()},error:function(t){}}),a.preventDefault()})}(jQuery,Drupal);