webpackJsonp([10],{132:function(e,t,a){"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var n=function ListingSortable(){_classCallCheck(this,ListingSortable),$('[data-dewdrop~="listing-sortable"]').each(function(){var e=$(this).data("sort-url"),t=$(this).find("tbody"),a=function(){var a=[];t.find("td span[data-id]").each(function(e,t){a.push($(t).data("id"))}),$.ajax(e,{type:"POST",data:{sort_order:a},success:function(e){e.result&&"success"===e.result||alert("Could not save sort order.  Please try again")},error:function(){alert("Unexpected error occurred.  Please try again")}})};t.sortable({placeholder:"alert-info",forcePlaceholderSize:!0,handle:".handle",stop:function(e,t){a()},helper:function(e,t){return t.children().each(function(){$(this).width($(this).width())}),t}})})};t.default=n}});
//# sourceMappingURL=10.js.map