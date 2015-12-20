$(document).ready(function(){$('#login-trigger').click(function(){$(this).next('#login-content').slideToggle();$(this).toggleClass('active');if($(this).hasClass('active'))$(this).find('span').html('▲')
else $(this).find('span').html('▼')})
$('#userlink-trigger').click(function(){$(this).next('#userlink_menu').slideToggle();$(this).toggleClass('active_userlink');if($(this).hasClass('active_userLink'))$(this).find('span').html('▲')
else $(this).find('span').html('▼')})
$('#alerts-trigger').click(function(){$(this).next('#alerts-content').slideToggle("slow");$(this).toggleClass('active_alerts');if($(this).hasClass('active_alerts'))$(this).find('span').html('▲')
else $(this).find('span').html('▼')})
$('#eledit_photo').click(function(){$(this).next('#eledit_photo_menu').slideToggle();$(this).toggleClass('active_edit_photo');if($(this).hasClass('active_edit_photo'))$(this).find('b').html('▲')
else $(this).find('b').html('▼')})
$('#remove_friend').click(function(){$(this).next('#friend_menu').slideToggle();$(this).toggleClass('active_friend_menu');if($(this).hasClass('active_friend_menu'))$(this).find('b').html('▲')
else $(this).find('b').html('▼')})
$('#usercptools-trigger').click(function(){$(this).next('#usercptools-content').slideToggle("slow");$(this).toggleClass('active_usercptools');if($(this).hasClass('active_usercptools'))$(this).find('span').html('▲')
else $(this).find('span').html('▼')})
$('#pages-trigger').click(function(){$(this).next('#pages-content').slideToggle("slow");$(this).toggleClass('active_pages');if($(this).hasClass('active_pages'))$(this).find('span').html('▲')
else $(this).find('span').html('▼')})
$(".w_toggle").click(function(){$(".writer_info").slideToggle("slow");})
$('#color_options').click(function(){$('#colors-content').show("fast");$("#colors-content").css('display','block');})
$('#colors-content').click(function(){$('#colors-content').hide("fast");$("#colors-content").css('display','none');location.reload();})
$('.pbboard_body').click(function(){$('#colors-content').hide("fast");$("#colors-content").css('display','none');})
$('.body_wrapper').click(function(){$('#colors-content').hide("fast");$("#colors-content").css('display','none');})
$('.pbb_content').click(function(){$('#colors-content').hide("fast");$("#colors-content").css('display','none');})
$('header').click(function(){$('#colors-content').hide("fast");$("#colors-content").css('display','none');})
$("#heading_up_static").click(function()
{$(this).next("#active_static").slideToggle("slow");$("#active_static").hide("slow");$("#heading_up_static").hide("slow");$("#heading_down_static").show("slow");$.cookie("collapsed_forum_static","1",{expires:365});});$("#heading_down_static").click(function()
{$(this).next("#active_static").slideToggle("slow")
$("#active_static").show("slow");$("#heading_up_static").show("slow");$("#heading_down_static").hide("slow");$.cookie("collapsed_forum_static","0",{expires:365});});if($.cookie("collapsed_forum_static")=="0"){$("#active_static").show();$("#heading_down_static").css('display','none');};if($.cookie("collapsed_forum_static")=="1"){$("#active_static").hide();$("#heading_up_static").css('display','none');};if(!$.cookie("collapsed_forum_static")){$("#heading_down_static").css('display','none');};$("#heading_up_statistics_list").click(function()
{$(this).next("#active_statistics_list").slideToggle("slow");$("#active_statistics_list").hide("slow");$("#heading_up_statistics_list").hide("slow");$("#heading_down_statistics_list").show("slow");$.cookie("collapsed_forum_statistics_list","1",{expires:365});});$("#heading_down_statistics_list").click(function()
{$(this).next("#active_statistics_list").slideToggle("slow")
$("#active_statistics_list").show("slow");$("#heading_up_statistics_list").show("slow");$("#heading_down_statistics_list").hide("slow");$.cookie("collapsed_forum_statistics_list","0",{expires:365});});if($.cookie("collapsed_forum_statistics_list")=="0"){$("#active_statistics_list").show();$("#heading_down_statistics_list").css('display','none');};if($.cookie("collapsed_forum_statistics_list")=="1"){$("#active_statistics_list").hide();$("#heading_up_statistics_list").css('display','none');};if(!$.cookie("collapsed_forum_statistics_list")){$("#heading_down_statistics_list").css('display','none');};});$(document).click(function(event){var target=$(event.target);if(!target.hasClass('active_alerts')&&target.parents('#alerts-trigger').length==0){$('#alerts-content').hide("slow");}
if(!target.hasClass('active_usercptools')&&target.parents('#usercptools-trigger').length==0){$('#usercptools-content').hide("slow");}
if(!target.hasClass('active_pages')&&target.parents('#pages-trigger').length==0){$('#pages-content').hide("slow");}
if(!target.hasClass('app_button Button_overlaid')&&target.parents('#eledit_photo').length==0){$('#eledit_photo_menu').hide("slow");$("#eledit_photo_menu").css('display','none');}
if(!target.hasClass('app_button Button_overlaid')&&target.parents('#remove_friend').length==0){$('#friend_menu').hide("slow");$("#friend_menu").css('display','none');}
if(!target.parents('.jscolor').click()){$('#colors-content').hide();}});function hexToRgb(r,t){var n=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(r),a=function(){return void 0==this.alpha?"rgb("+this.r+", "+this.g+", "+this.b+")":(this.alpha>1?this.alpha=1:this.alpha<0&&(this.alpha=0),"rgba("+this.r+", "+this.g+", "+this.b+", "+this.alpha+")")};return void 0==t?n?{r:parseInt(n[1],16),g:parseInt(n[2],16),b:parseInt(n[3],16),toString:a}:null:(t>1?t=1:0>t&&(t=0),n?{r:parseInt(n[1],16),g:parseInt(n[2],16),b:parseInt(n[3],16),alpha:t,toString:a}:null)}function rgbToHex(r,t,n){function a(r){var t=r.toString(16);return 1==t.length?"0"+t:t}if(void 0==t||void 0==n){if("string"==typeof r){var i=/^rgb[a]?\(([\d]+)[ \n]*,[ \n]*([\d]+)[ \n]*,[ \n]*([\d]+)[ \n]*,?[ \n]*([.\d]+)?[ \n]*\)$/i.exec(r);return rgbToHex(parseInt(i[1]),parseInt(i[2]),parseInt(i[3]))}return void 0==r.r||void 0==r.g||void 0==r.b?null:rgbToHex(r.r,r.g,r.b)}var e=r;return"#"+a(e)+a(t)+a(n)}