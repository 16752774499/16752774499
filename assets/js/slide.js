var cx=cx||function(p,j){var h={},m=h.lib={},n=m.Base=function(){function a(){}return{extend:function(d){a.prototype=this;var c=new a;d&&c.mixIn(d);c.$super=this;return c},create:function(){var a=this.extend();a.init.apply(a,arguments);return a},init:function(){},mixIn:function(a){for(var c in a)a.hasOwnProperty(c)&&(this[c]=a[c]);a.hasOwnProperty("toString")&&(this.toString=a.toString)},clone:function(){return this.$super.extend(this)}}}(),b=m.WordArray=n.extend({init:function(a,d){a=this.words=a||[];this.sigBytes=d!=j?d:4*a.length},toString:function(a){return(a||q).stringify(this)},concat:function(a){var d=this.words,c=a.words,g=this.sigBytes,a=a.sigBytes;this.clamp();if(g%4)for(var f=0;f<a;f++)d[g+f>>>2]|=(c[f>>>2]>>>24-8*(f%4)&255)<<24-8*((g+f)%4);else if(65535<c.length)for(f=0;f<a;f+=4)d[g+f>>>2]=c[f>>>2];else d.push.apply(d,c);this.sigBytes+=a;return this},clamp:function(){var a=this.words,d=this.sigBytes;a[d>>>2]&=4294967295<<32-8*(d%4);a.length=p.ceil(d/4)},clone:function(){var a=n.clone.call(this);a.words=this.words.slice(0);return a},random:function(a){for(var d=[],c=0;c<a;c+=4)d.push(4294967296*p.random()|0);return b.create(d,a)}}),i=h.enc={},q=i.Hex={stringify:function(a){for(var d=a.words,a=a.sigBytes,c=[],g=0;g<a;g++){var f=d[g>>>2]>>>24-8*(g%4)&255;c.push((f>>>4).toString(16));c.push((f&15).toString(16))}return c.join("")},parse:function(a){for(var d=a.length,c=[],g=0;g<d;g+=2)c[g>>>3]|=parseInt(a.substr(g,2),16)<<24-4*(g%8);return b.create(c,d/2)}},k=i.Latin1={stringify:function(a){for(var d=a.words,a=a.sigBytes,c=[],g=0;g<a;g++)c.push(String.fromCharCode(d[g>>>2]>>>24-8*(g%4)&255));return c.join("")},parse:function(a){for(var d=a.length,c=[],g=0;g<d;g++)c[g>>>2]|=(a.charCodeAt(g)&255)<<24-8*(g%4);return b.create(c,d)}},l=i.Utf8={stringify:function(a){try{return decodeURIComponent(escape(k.stringify(a)))}catch(d){throw Error("Malformed UTF-8 data");}},parse:function(a){return k.parse(unescape(encodeURIComponent(a)))}},e=m.BufferedBlockAlgorithm=n.extend({reset:function(){this._data=b.create();this._nDataBytes=0},_append:function(a){"string"==typeof a&&(a=l.parse(a));this._data.concat(a);this._nDataBytes+=a.sigBytes},_process:function(a){var d=this._data,c=d.words,g=d.sigBytes,f=this.blockSize,o=g/(4*f),o=a?p.ceil(o):p.max((o|0)-this._minBufferSize,0),a=o*f,g=p.min(4*a,g);if(a){for(var e=0;e<a;e+=f)this._doProcessBlock(c,e);e=c.splice(0,a);d.sigBytes-=g}return b.create(e,g)},clone:function(){var a=n.clone.call(this);a._data=this._data.clone();return a},_minBufferSize:0});m.Hasher=e.extend({init:function(){this.reset()},reset:function(){e.reset.call(this);this._doReset()},update:function(a){this._append(a);this._process();return this},finalize:function(a){a&&this._append(a);this._doFinalize();return this._hash},clone:function(){var a=e.clone.call(this);a._hash=this._hash.clone();return a},blockSize:16,_createHelper:function(a){return function(d,c){return a.create(c).finalize(d)}},_createHmacHelper:function(a){return function(d,c){return r.HMAC.create(a,c).finalize(d)}}});var r=h.algo={};return h}(Math);(function(p){function j(e,b,a,d,c,g,f){e=e+(b&a|~b&d)+c+f;return(e<<g|e>>>32-g)+b}function h(e,b,a,d,c,g,f){e=e+(b&d|a&~d)+c+f;return(e<<g|e>>>32-g)+b}function m(e,b,a,d,c,g,f){e=e+(b^a^d)+c+f;return(e<<g|e>>>32-g)+b}function n(e,b,a,d,c,g,f){e=e+(a^(b|~d))+c+f;return(e<<g|e>>>32-g)+b}var b=cx,i=b.lib,q=i.WordArray,i=i.Hasher,k=b.algo,l=[];(function(){for(var e=0;64>e;e++)l[e]=4294967296*p.abs(p.sin(e+1))|0})();k=k.MD5=i.extend({_doReset:function(){this._hash=q.create([1732584193,4023233417,2562383102,271733878])},_doProcessBlock:function(e,b){for(var a=0;16>a;a++){var d=b+a,c=e[d];e[d]=(c<<8|c>>>24)&16711935|(c<<24|c>>>8)&4278255360}for(var d=this._hash.words,c=d[0],g=d[1],f=d[2],o=d[3],a=0;64>a;a+=4)16>a?(c=j(c,g,f,o,e[b+a],7,l[a]),o=j(o,c,g,f,e[b+a+1],12,l[a+1]),f=j(f,o,c,g,e[b+a+2],17,l[a+2]),g=j(g,f,o,c,e[b+a+3],22,l[a+3])):32>a?(c=h(c,g,f,o,e[b+(a+1)%16],5,l[a]),o=h(o,c,g,f,e[b+(a+6)%16],9,l[a+1]),f=h(f,o,c,g,e[b+(a+11)%16],14,l[a+2]),g=h(g,f,o,c,e[b+a%16],20,l[a+3])):48>a?(c=m(c,g,f,o,e[b+(3*a+5)%16],4,l[a]),o=m(o,c,g,f,e[b+(3*a+8)%16],11,l[a+1]),f=m(f,o,c,g,e[b+(3*a+11)%16],16,l[a+2]),g=m(g,f,o,c,e[b+(3*a+14)%16],23,l[a+3])):(c=n(c,g,f,o,e[b+3*a%16],6,l[a]),o=n(o,c,g,f,e[b+(3*a+7)%16],10,l[a+1]),f=n(f,o,c,g,e[b+(3*a+14)%16],15,l[a+2]),g=n(g,f,o,c,e[b+(3*a+5)%16],21,l[a+3]));d[0]=d[0]+c|0;d[1]=d[1]+g|0;d[2]=d[2]+f|0;d[3]=d[3]+o|0},_doFinalize:function(){var b=this._data,i=b.words,a=8*this._nDataBytes,d=8*b.sigBytes;i[d>>>5]|=128<<24-d%32;i[(d+64>>>9<<4)+14]=(a<<8|a>>>24)&16711935|(a<<24|a>>>8)&4278255360;b.sigBytes=4*(i.length+1);this._process();b=this._hash.words;for(i=0;4>i;i++)a=b[i],b[i]=(a<<8|a>>>24)&16711935|(a<<24|a>>>8)&4278255360}});b.MD5=i._createHelper(k);b.HmacMD5=i._createHmacHelper(k)})(Math);(function(){window.addEventListener("load",(function(){var key=window.slideValue;function md5encode(word){return cx.MD5(word).toString()};var slider=new SliderTools({el:document.querySelector(".slider"),});slider.on("complete",function(){c.get("./?defender_type=slide&defender_key="+key+"&defender_hash="+md5encode(key)+"",(function(t){if(t=='success')window.location.reload();else{alert(t);window.location.reload()}}))})}));var c={get:function(t,n){var e=new XMLHttpRequest;e.open("GET",t,!0),e.setRequestHeader('X-Requested-With','XMLHttpRequest'),e.onreadystatechange=function(){(4==e.readyState&&200==e.status||304==e.status)&&n.call(this,e.responseText)},e.send()}}})();(function webpackUniversalModuleDefinition(root,factory){if(typeof exports==="object"&&typeof module==="object")module.exports=factory();else if(typeof define==="function"&&define.amd)define([],factory);else if(typeof exports==="object")exports["SliderTools"]=factory();else root["SliderTools"]=factory()})(self,function(){return(function(){"use strict";var __webpack_exports__={};function _typeof(obj){"@babel/helpers - typeof";if(typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"){_typeof=function _typeof(obj){return typeof obj}}else{_typeof=function _typeof(obj){return obj&&typeof Symbol==="function"&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj}}return _typeof(obj)}function EventEmitter(){this._events={}}EventEmitter.prototype.on=function(eventName,listener){if(!eventName||!listener)return;if(!util.isValidListener(listener)){throw new TypeError("listener must be a function");}var events=this._events;var listeners=events[eventName]=events[eventName]||[];var listenerIsWrapped=_typeof(listener)==="object";if(util.indexOf(listeners,listener)===-1){listeners.push(listenerIsWrapped?listener:{listener:listener,once:false})}return this};EventEmitter.prototype.once=function(eventName,listener){return this.on(eventName,{listener:listener,once:true})};EventEmitter.prototype.off=function(eventName,listener){var listeners=this._events[eventName];if(!listeners)return;var index;for(var i=0,len=listeners.length;i<len;i++){if(listeners[i]&&listeners[i].listener===listener){index=i;break}}if(typeof index!=="undefined"){listeners.splice(index,1,null)}return this};EventEmitter.prototype.emit=function(eventName,args){var listeners=this._events[eventName];if(!listeners)return;for(var i=0;i<listeners.length;i++){var listener=listeners[i];if(listener){listener.listener.apply(this,args||[]);if(listener.once){this.off(eventName,listener.listener)}}}return this};var util={extend:function extend(target){for(var i=1,len=arguments.length;i<len;i++){for(var prop in arguments[i]){if(arguments[i].hasOwnProperty(prop)){target[prop]=arguments[i][prop]}}}return target},setClassName:function setClassName(selector,className){selector.className=className},addClass:function addClass(selector,className){selector.classList.add(className)},setInlineStyle:function setInlineStyle(selector,attr,content){var length=selector.length;for(var i=0;i<length;i++){selector[i].style[attr]=content}},isValidListener:function isValidListener(listener){if(typeof listener==="function"){return true}else if(listener&&_typeof(listener)==="object"){return util.isValidListener(listener.listener)}else{return false}},addCSS:function addCSS(cssText){var style=document.createElement("style"),head=document.head||document.getElementsByTagName("head")[0];style.type="text/css";if(style.styleSheet){var func=function func(){try{style.styleSheet.cssText=cssText}catch(e){}};if(style.styleSheet.disabled){setTimeout(func,10)}else{func()}}else{var textNode=document.createTextNode(cssText);style.appendChild(textNode)}head.appendChild(style)},indexOf:function indexOf(array,item){if(array.indexOf){return array.indexOf(item)}else{var result=-1;for(var i=0,len=array.length;i<len;i++){if(array[i]===item){result=i;break}}return result}}};function SliderTools(options){this.options=util.extend({},this.constructor.defaultOptions,options);this.init();this.bindEvents();this.diffX=0;this.flag=false}SliderTools.defaultOptions={el:document.body};var proto=SliderTools.prototype=new EventEmitter();proto.constructor=SliderTools;proto.init=function(){this.createSlider();this.getElements()};proto.createSlider=function(){this.options.el.innerHTML='<div id="slider"><div class="drag_bg"></div><div class="drag_text" onselectstart="return false;" unselectable="on">拖动滑块验证</div><div class="handler handler_bg"></div></div>';util.addCSS('ul, li {    list-style: none;    }    a {    text-decoration: none;    }    .wrap {    width: 300px;    height: 350px;    text-align: center;    margin: 150px auto;    }    .inner {    padding: 15px;    }    .clearfix {    overflow: hidden;    _zoom: 1;    }    .none {    display: none;    }    #slider {    position: relative;    background-color: #e8e8e8;    width: 300px;    height: 34px;    line-height: 34px;    text-align: center;    }    #slider .handler {    position: absolute;    top: 0px;    left: 0px;    width: 40px;    height: 32px;    border: 1px solid #ccc;    cursor: move; transition: all .2s ease}    .handler_bg {    background: #fff    url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3hpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo0ZDhlNWY5My05NmI0LTRlNWQtOGFjYi03ZTY4OGYyMTU2ZTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTEyNTVEMURGMkVFMTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTEyNTVEMUNGMkVFMTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2MTc5NzNmZS02OTQxLTQyOTYtYTIwNi02NDI2YTNkOWU5YmUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NGQ4ZTVmOTMtOTZiNC00ZTVkLThhY2ItN2U2ODhmMjE1NmU2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+YiRG4AAAALFJREFUeNpi/P//PwMlgImBQkA9A+bOnfsIiBOxKcInh+yCaCDuByoswaIOpxwjciACFegBqZ1AvBSIS5OTk/8TkmNEjwWgQiUgtQuIjwAxUF3yX3xyGIEIFLwHpKyAWB+I1xGSwxULIGf9A7mQkBwTlhBXAFLHgPgqEAcTkmNCU6AL9d8WII4HOvk3ITkWJAXWUMlOoGQHmsE45ViQ2KuBuASoYC4Wf+OUYxz6mQkgwAAN9mIrUReCXgAAAABJRU5ErkJggg==")    no-repeat center;    }    .handler_ok_bg {    background: #fff    url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3hpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo0ZDhlNWY5My05NmI0LTRlNWQtOGFjYi03ZTY4OGYyMTU2ZTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDlBRDI3NjVGMkQ2MTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDlBRDI3NjRGMkQ2MTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDphNWEzMWNhMC1hYmViLTQxNWEtYTEwZS04Y2U5NzRlN2Q4YTEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NGQ4ZTVmOTMtOTZiNC00ZTVkLThhY2ItN2U2ODhmMjE1NmU2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+k+sHwwAAASZJREFUeNpi/P//PwMyKD8uZw+kUoDYEYgloMIvgHg/EM/ptHx0EFk9I8wAoEZ+IDUPiIMY8IN1QJwENOgj3ACo5gNAbMBAHLgAxA4gQ5igAnNJ0MwAVTsX7IKyY7L2UNuJAf+AmAmJ78AEDTBiwGYg5gbifCSxFCZoaBMCy4A4GOjnH0D6DpK4IxNSVIHAfSDOAeLraJrjgJp/AwPbHMhejiQnwYRmUzNQ4VQgDQqXK0ia/0I17wJiPmQNTNBEAgMlQIWiQA2vgWw7QppBekGxsAjIiEUSBNnsBDWEAY9mEFgMMgBk00E0iZtA7AHEctDQ58MRuA6wlLgGFMoMpIG1QFeGwAIxGZo8GUhIysmwQGSAZgwHaEZhICIzOaBkJkqyM0CAAQDGx279Jf50AAAAAABJRU5ErkJggg==")    no-repeat center;    }    #slider .drag_bg {    background-color: #7ac23c;    height: 34px;    width: 0px;transition:all .2s ease       }    #slider .drag_text {    position: absolute;    top: 0px;    width: 300px;    -moz-user-select: none;    -webkit-user-select: none;    user-select: none;    -o-user-select: none;    -ms-user-select: none;    }    .unselect {    -moz-user-select: none;    -webkit-user-select: none;    -ms-user-select: none;    }    .slide_ok {    color: #fff;    }')};proto.getElements=function(){this.slider=document.querySelector("#slider");this.drag_bg=document.querySelector(".drag_bg");this.handler=document.querySelector(".handler")};proto.bindEvents=function(){var self=this;self.handler.onmousedown=function(e){self.diffX=e.clientX-self.handler.offsetLeft;util.setClassName(self.slider,"unselect");util.setInlineStyle([self.handler,self.drag_bg],"transition","none");document.onmousemove=function(e){var deltaX=e.clientX-self.diffX;if(deltaX>=self.slider.offsetWidth-self.handler.offsetWidth){deltaX=self.slider.offsetWidth-self.handler.offsetWidth;self.flag=true}else if(deltaX<=0){deltaX=0;self.flag=false}else{self.flag=false}util.setInlineStyle([self.handler],"left",deltaX+"px");util.setInlineStyle([self.drag_bg],"width",deltaX+"px")};document.onmouseup=function(){util.setInlineStyle([self.handler,self.drag_bg],"transition","all .2s ease");util.setClassName(self.slider,"");if(self.flag){util.setClassName(self.slider,"slide_ok");util.addClass(self.handler,"handler_ok_bg");self.handler.onmousedown=null;self.emit("complete")}else{util.setInlineStyle([self.handler],"left",0+"px");util.setInlineStyle([self.drag_bg],"width",0+"px")}document.onmousemove=null;document.onmouseup=null}};self.handler.ontouchstart=function(e){self.diffX=e.touches[0].clientX-self.handler.offsetLeft;util.setClassName(self.slider,"unselect");util.setInlineStyle([self.handler,self.drag_bg],"transition","none");e.preventDefault();document.ontouchmove=function(e){var deltaX=e.touches[0].clientX-self.diffX;if(deltaX>=self.slider.offsetWidth-self.handler.offsetWidth){deltaX=self.slider.offsetWidth-self.handler.offsetWidth;self.flag=true}else if(deltaX<=0){deltaX=0;self.flag=false}else{self.flag=false}util.setInlineStyle([self.handler],"left",deltaX+"px");util.setInlineStyle([self.drag_bg],"width",deltaX+"px");e.preventDefault()};document.ontouchend=function(){util.setInlineStyle([self.handler,self.drag_bg],"transition","all .2s ease");util.setClassName(self.slider,"");if(self.flag){util.setClassName(self.slider,"slide_ok");util.addClass(self.handler,"handler_ok_bg");self.handler.onmousedown=null;self.emit("complete")}else{util.setInlineStyle([self.handler],"left",0+"px");util.setInlineStyle([self.drag_bg],"width",0+"px")}document.ontouchmove=null;document.ontouchend=null;e.preventDefault()}}};__webpack_exports__["default"]=(SliderTools);__webpack_exports__=__webpack_exports__.default;return __webpack_exports__})()});