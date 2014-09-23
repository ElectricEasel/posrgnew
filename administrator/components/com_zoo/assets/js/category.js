/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

(function($){var Plugin=function(){};$.extend(Plugin.prototype,{name:"SortCategories",initialize:function(form){var nestedList=$("#categories");if(!nestedList){return}nestedList.nestedSortable({forcePlaceholderSize:true,handle:"td.handle",items:"li",placeholder:"placeholder",tabSize:25,tolerance:"pointer",toleranceElement:"> div",listType:"ul",start:function(event,ui){ui.placeholder.height(ui.helper.height()-2);ui.helper.addClass("drag")},stop:function(event,ui){var post={};$.each(form.serializeArray(),function(i,field){post[field.name]=field.value});ui.item.addClass("loader").find("li").addClass("loader");$.post(form.attr("action"),$.param($.extend(post,{task:"saveorder",format:"raw"}))+"&"+nestedList.nestedSortable("serialize"),function(data){nestedList.find("li").removeClass("loader");$.Message(data,true);form.BrowseCategories("markCollapsibles")});ui.item.removeClass("drag")}})}});$.fn[Plugin.prototype.name]=function(){var args=arguments;var method=args[0]?args[0]:null;return this.each(function(){var element=$(this);if(Plugin.prototype[method]&&element.data(Plugin.prototype.name)&&method!="initialize"){element.data(Plugin.prototype.name)[method].apply(element.data(Plugin.prototype.name),Array.prototype.slice.call(args,1))}else if(!method||$.isPlainObject(method)){var plugin=new Plugin;if(Plugin.prototype["initialize"]){plugin.initialize.apply(plugin,$.merge([element],args))}element.data(Plugin.prototype.name,plugin)}else{$.error("Method "+method+" does not exist on jQuery."+Plugin.name)}})}})(jQuery);(function($){var Plugin=function(){};$.extend(Plugin.prototype,{name:"BrowseCategories",initialize:function(form){var $this=this;$("#categories").delegate("li.collapsible > div td.icon","click",function(){var li=$(this).closest("li");if(li.is(".collapsed")){li.removeClass("collapsed").children("ul").show()}else{li.addClass("collapsed").children("ul").hide()}});$("#categories-list .collapse-all").bind("click",function(){$("#categories li.collapsible").each(function(){$(this).addClass("collapsed").children("ul").hide()})});$("#categories-list .expand-all").bind("click",function(){$("#categories li.collapsible").each(function(){$(this).removeClass("collapsed").children("ul").show()})});$this.markCollapsibles()},markCollapsibles:function(){$("#categories").find("li").each(function(){$(this).removeClass("collapsible");if($(this).has("ul").length){$(this).addClass("collapsible")}})}});$.fn[Plugin.prototype.name]=function(){var args=arguments;var method=args[0]?args[0]:null;return this.each(function(){var element=$(this);if(Plugin.prototype[method]&&element.data(Plugin.prototype.name)&&method!="initialize"){element.data(Plugin.prototype.name)[method].apply(element.data(Plugin.prototype.name),Array.prototype.slice.call(args,1))}else if(!method||$.isPlainObject(method)){var plugin=new Plugin;if(Plugin.prototype["initialize"]){plugin.initialize.apply(plugin,$.merge([element],args))}element.data(Plugin.prototype.name,plugin)}else{$.error("Method "+method+" does not exist on jQuery."+Plugin.name)}})}})(jQuery);(function($){var Plugin=function(){};$.extend(Plugin.prototype,{name:"EditCategory",initialize:function(input){$.each(["apply","save","save-new"],function(i,task){$("#toolbar-"+task+" a, #toolbar-"+task+" button").bind("validate.adminForm",function(event){if(input.find('input[name="name"]').val()==""){input.find("span.message-name").css("display","block");event.preventDefault()}})})}});$.fn[Plugin.prototype.name]=function(){var args=arguments;var method=args[0]?args[0]:null;return this.each(function(){var element=$(this);if(Plugin.prototype[method]&&element.data(Plugin.prototype.name)&&method!="initialize"){element.data(Plugin.prototype.name)[method].apply(element.data(Plugin.prototype.name),Array.prototype.slice.call(args,1))}else if(!method||$.isPlainObject(method)){var plugin=new Plugin;if(Plugin.prototype["initialize"]){plugin.initialize.apply(plugin,$.merge([element],args))}element.data(Plugin.prototype.name,plugin)}else{$.error("Method "+method+" does not exist on jQuery."+Plugin.name)}})}})(jQuery);