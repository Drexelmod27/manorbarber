var WFLinkBrowser=WFExtensions.add('LinkBrowser',{options:{element:'#link-options',onClick:$.noop},init:function(options){$.extend(this.options,options);this._createTree()},_createTree:function(){var self=this;$(this.options.element).tree({collapseTree:true,charLength:50,onInit:function(e,callback){if($.isFunction(callback)){callback.apply()}},onNodeClick:function(e,node){var v;if(!$('span.nolink',node).length){v=$('a',node).attr('href');if(v=='javascript:;')v=$(node).attr('id');if($.isFunction(self.options.onClick)){self.options.onClick.call(this,$.String.decode(v))}}if($('span',node).is('.folder')){$(this).tree('toggleNode',e,node)}e.preventDefault()},onNodeLoad:function(e,node){var self=this;$(this).tree('toggleLoader',node);var query=$.String.query($.String.unescape($(node).attr('id')));$.JSON.request('getLinks',{'json':query},function(o){if(o){if(!o.error){var ul=$('ul:first',node);if(ul){$(ul).remove()}$(self).tree('createNode',o.folders,node);$(self).tree('toggleNodeState',node,true)}else{$.Dialog.alert(o.error)}}$(self).tree('toggleLoader',node)},self)}})}});