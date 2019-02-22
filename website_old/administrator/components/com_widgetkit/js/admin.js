/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function(a){window.submitbutton=function(a){if(a=="cancel")window.location="index.php?option=com_widgetkit"};window.Joomla=window.Joomla||{};window.Joomla.submitbutton=window.submitbutton;a("#tabs").tabs().prev().append('<li class="version">'+a("#tabs").data("wkversion")+"</li>");a("#widgetkit").delegate(".box .deletable","click",function(){a(this).parent().trigger("delete",[a(this)])});a("input:text").placeholder();a(".actions .save").css("display","none").length&&(a("#toolbar tr").prepend('<td id="toolbar-apply"><a href="#"><span class="icon-32-apply"></span>Apply</a></td>'),
a("#toolbar ul").prepend('<li id="toolbar-apply"><a href="#"><span class="icon-32-apply"></span>Save</a></li>'),a("#toolbar-apply").bind("click",function(){a("#toolbar").addClass("saving");a(".actions .save").trigger("click")}),a(".actions .save").bind("complete",function(){a("#toolbar").removeClass("saving")}))});
(function(a){var e={get:function(a){return window.sessionStorage?sessionStorage.getItem(a):null},set:function(a,f){window.sessionStorage&&sessionStorage.setItem(a,f)}};a.fn.tabs=function(){return this.each(function(){var h=a(this).addClass("content").wrap('<div class="tabs-box" />').before('<ul class="nav" />'),f=a(this).prev("ul.nav");h.children("li").each(function(){f.append("<li><a>"+a(this).hide().attr("data-name")+"</a></li>")});f.children("li").bind("click",function(d){d.preventDefault();var d=
a("li",f).removeClass("active").index(a(this).addClass("active").get(0)),c=h.children("li").hide();a(c[d]).show();e.set("widgetkit-tab",d)});var g=parseInt(e.get("widgetkit-tab"));a(!isNaN(g)?f.children("li").get(g):f.children("li:first")).trigger("click")})}})(jQuery);
(function(a){var e=function(){};a.extend(e.prototype,{name:"finder",initialize:function(e,f){function g(c){c.preventDefault();var b=a(this).closest("li",e);b.length||(b=e);b.hasClass(d.options.open)?b.removeClass(d.options.open).children("ul").slideUp():(b.addClass(d.options.loading),a.post(d.options.url,{path:b.data("path")},function(c){b.removeClass(d.options.loading).addClass(d.options.open);c.length&&(b.children().remove("ul"),b.append("<ul>").children("ul").hide(),a.each(c,function(d,c){b.children("ul").append(a('<li><a href="#">'+
c.name+"</a></li>").addClass(c.type).data("path",c.path))}),b.find("ul a").bind("click",g),b.children("ul").slideDown())},"json"))}var d=this;this.options=a.extend({url:"",path:"",open:"open",loading:"loading"},f);e.data("path",this.options.path).bind("retrieve:finder",g).trigger("retrieve:finder")}});a.fn[e.prototype.name]=function(){var h=arguments,f=h[0]?h[0]:null;return this.each(function(){var g=a(this);if(e.prototype[f]&&g.data(e.prototype.name)&&f!="initialize")g.data(e.prototype.name)[f].apply(g.data(e.prototype.name),
Array.prototype.slice.call(h,1));else if(!f||a.isPlainObject(f)){var d=new e;e.prototype.initialize&&d.initialize.apply(d,a.merge([g],h));g.data(e.prototype.name,d)}else a.error("Method "+f+" does not exist on jQuery."+e.name)})}})(jQuery);
(function(a){function e(c){var b={},d=/^jQuery\d+$/;a.each(c.attributes,function(a,c){if(c.specified&&!d.test(c.name))b[c.name]=c.value});return b}function h(){var c=a(this);c.val()===c.attr("placeholder")&&c.hasClass("placeholder")&&(c.data("placeholder-password")?c.hide().next().show().focus():c.val("").removeClass("placeholder"))}function f(){var c,b=a(this);if(b.val()===""||b.val()===b.attr("placeholder")){if(b.is(":password")){if(!b.data("placeholder-textinput")){try{c=b.clone().attr({type:"text"})}catch(d){c=
a("<input>").attr(a.extend(e(b[0]),{type:"text"}))}c.removeAttr("name").data("placeholder-password",!0).bind("focus.placeholder",h);b.data("placeholder-textinput",c).before(c)}b=b.hide().prev().show()}b.addClass("placeholder").val(b.attr("placeholder"))}else b.removeClass("placeholder")}var g="placeholder"in document.createElement("input"),d="placeholder"in document.createElement("textarea");a.fn.placeholder=g&&d?function(){return this}:function(){return this.filter((g?"textarea":":input")+"[placeholder]").bind("focus.placeholder",
h).bind("blur.placeholder",f).trigger("blur.placeholder").end()};a(function(){a("form").bind("submit.placeholder",function(){var c=a(".placeholder",this).each(h);setTimeout(function(){c.each(f)},10)})});a(window).bind("unload.placeholder",function(){a(".placeholder").val("")})})(jQuery);
(function(a){var e=a(window),h=a(document),f=!1,g=!1,d=null,c=null;a.modalwin=function(b){f&&a.modalwin.close();if(typeof b==="object"){if(b=a(b),b.parent().length)this.persist=b,this.persist.data("modal-persist-parent",b.parent())}else b=typeof b==="string"||typeof b==="number"?a("<div></div>").html(b):a("<div></div>").html("Modalwin Error: Unsupported data type: "+typeof b);d=a('<div class="modalwin"><div class="inner"></div><div class="btnclose"></div>');d.find(".inner:first").append(b);d.css({position:"fixed",
"z-index":101}).find(".btnclose").click(a.modalwin.close);c=a('<div class="modal-overlay"></div>').css({position:"absolute",left:0,top:0,width:h.width(),height:h.height(),"z-index":100}).bind("click",a.modalwin.close);a("body").append(c).append(d.hide());d.show().css({left:e.width()/2-d.width()/2,top:e.height()/2-d.height()/2}).fadeIn();f=!0};a.modalwin.close=function(){f&&(g&&(g.appendTo(this.persist.data("modal-persist-parent")),g=!1),d.remove(),c.remove(),c=d=null,f=!1)};e.bind("resize",function(){f&&
(d.css({left:e.width()/2-d.width()/2,top:e.height()/2-d.height()/2}),c.css({width:h.width(),height:h.height()}))})})(jQuery);
