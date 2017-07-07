webpackJsonp([2],{130:function(e,n,t){"use strict";function _classCallCheck(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var a=t(167),i=function InputFile(){var e=arguments.length<=0||void 0===arguments[0]?".btn-input-file":arguments[0];_classCallCheck(this,InputFile),e.length||(e=".btn-input-file"),$(e).each(function(e,n){var t,i=new a.a;if(n=$(n),t=$(n.data("value-input")),t.val()){var s=t.val();n.data("file-url")&&(s=n.data("file-url")),i.setValueInput(t).setFileThumbnail(n.data("file-thumbnail")).setFileUrl(n.data("file-url")).renderFileValue(s,n.data("file-thumbnail"))}}),$(document).on("click",e,function(e){var n=new a.a,t=$(this);e.preventDefault(),n.setValueInput($(t.data("value-input"))).setFileInputName(t.data("file-input-name")).setActionUrl(t.data("action-url")),document.body.appendChild(n.render().el)})};n.default=i},149:function(e,n){e.exports='<div class="input-file-status-ui">\n    <div class="alert alert-danger" role="alert">\n        <% _.each(messages, function (message) { %>\n        <div><%- message %></div>\n        <% }); %>\n    </div>\n</div>\n'},150:function(e,n){e.exports='<div class="input-file-status-ui">\n    <div class="progress">\n        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">\n            <span class="sr-only">Loading...</span>\n        </div>\n    </div>\n    <div class="progress-text text-muted">Loading.  Please wait...</div>\n</div>\n'},151:function(e,n){e.exports='<form class="input-file-upload-form" enctype="multipart/form-data" action="" method="POST">\n    <input class="input-file-uploader" type="file" name="<%- fileInputName %>" />\n</form>\n'},152:function(e,n){e.exports='<div class="input-file-status-ui">\n    <% if (thumbnail) { %>\n    <div class="panel panel-default">\n        <div class="panel-body">\n            <a target="_blank" href="<%- url %>">\n                <div class="thumbnail">\n                    <img src="<%- thumbnail %>" />\n                </div>\n\n                <span class="glyphicon glyphicon-file"></span>\n                <%- url.split(\'/\').pop() %>\n            </a>\n        </div>\n    </div>\n    <% } else { %>\n    <a target="_blank" href="<%- url %>">\n        <span class="glyphicon glyphicon-file"></span>\n        <%- url.split(\'/\').pop() %>\n    </a>\n    <% } %>\n\n\n    <div class="btn-group btn-group-justified" role="group">\n        <div class="btn-group" role="group">\n            <button type="button" class="btn btn-default btn-xs btn-remove"><span class="glyphicon glyphicon-remove"></span> Remove</button>\n        </div>\n        \x3c!--\n        <div class="btn-group" role="group">\n            <button type="button" class="btn btn-default btn-xs btn-copy"><span class="glyphicon glyphicon-copy"></span> Copy</button>\n        </div>\n        --\x3e\n    </div>\n</div>\n'},167:function(e,n,t){"use strict";var a=t(151),i=t.n(a),s=t(152),l=t.n(s),r=t(150),u=t.n(r),p=t(149),o=t.n(p),c=_.template(i.a),d=_.template(l.a),h=_.template(u.a),f=_.template(o.a),v=Backbone.View.extend({events:{"change input":"handleFileSelected"},setValueInput:function(e){return this.$valueInput=e,this.$wrapper=e.parent(),this},setFileInputName:function(e){return this.fileInputName=e,this},setFileThumbnail:function(e){return this.fileThumbnail=e,this},setFileUrl:function(e){return this.fileUrl=e,this},setActionUrl:function(e){return this.actionUrl=e,this},render:function(){if(this.$el.html(c({fileInputName:this.fileInputName})),this.$el.find("input").click(),this.$valueInput.val()){var e=this.$valueInput.val();this.fileUrl&&(e=this.fileUrl),this.renderFileValue(e,this.fileThumbnail)}return this},renderFileValue:function(e,n){this.clearStatusUi(),this.$wrapper.find(".value-wrapper").append(d({url:e,thumbnail:n})),this.$wrapper.on("click",".btn-remove",_.bind(function(e){e.preventDefault(),this.$valueInput.val(""),this.clearStatusUi()},this)),this.$wrapper.on("click",".btn-copy",_.bind(function(e){e.preventDefault(),this.$valueInput.val("")},this))},renderErrorMessages:function(e){this.clearStatusUi(),this.$wrapper.append(f({messages:e}))},renderProgressBar:function(){this.clearStatusUi(),this.$wrapper.find(".value-wrapper").append(h({}))},clearStatusUi:function(){this.$wrapper.find(".input-file-status-ui").remove()},handleFileSelected:function(e){var n=e.target.files,t=new FormData;_.each(n,function(e){t.append(this.$el.find("input").attr("name"),e)},this),this.renderProgressBar(),$.ajax({url:this.actionUrl,type:"POST",data:t,cache:!1,dataType:"json",processData:!1,contentType:!1,success:_.bind(function(e){e&&"success"===e.result?(this.$valueInput.val(e.value).trigger("change"),this.renderFileValue(e.url,e.thumbnail)):this.renderErrorMessages(e.messages)},this),error:_.bind(function(){this.renderErrorMessages(["There was an error uploading the selected file.  Please try again."])},this)})}});n.a=v}});
//# sourceMappingURL=2.js.map