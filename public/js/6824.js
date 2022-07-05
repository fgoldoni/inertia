/*! For license information please see 6824.js.LICENSE.txt */
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[6824,2881],{94787:(e,t,r)=>{r.d(t,{i:()=>s});var n=r(94865);function o(e){return o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},o(e)}function a(){a=function(){return e};var e={},t=Object.prototype,r=t.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},i=n.iterator||"@@iterator",l=n.asyncIterator||"@@asyncIterator",s=n.toStringTag||"@@toStringTag";function c(e,t,r){return Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}),e[t]}try{c({},"")}catch(e){c=function(e,t,r){return e[t]=r}}function u(e,t,r,n){var o=t&&t.prototype instanceof p?t:p,a=Object.create(o.prototype),i=new E(n||[]);return a._invoke=function(e,t,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return B()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var l=k(i,r);if(l){if(l===f)continue;return l}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var s=d(e,t,r);if("normal"===s.type){if(n=r.done?"completed":"suspendedYield",s.arg===f)continue;return{value:s.arg,done:r.done}}"throw"===s.type&&(n="completed",r.method="throw",r.arg=s.arg)}}}(e,r,i),a}function d(e,t,r){try{return{type:"normal",arg:e.call(t,r)}}catch(e){return{type:"throw",arg:e}}}e.wrap=u;var f={};function p(){}function m(){}function h(){}var g={};c(g,i,(function(){return this}));var v=Object.getPrototypeOf,y=v&&v(v(_([])));y&&y!==t&&r.call(y,i)&&(g=y);var x=h.prototype=p.prototype=Object.create(g);function w(e){["next","throw","return"].forEach((function(t){c(e,t,(function(e){return this._invoke(t,e)}))}))}function b(e,t){function n(a,i,l,s){var c=d(e[a],e,i);if("throw"!==c.type){var u=c.arg,f=u.value;return f&&"object"==o(f)&&r.call(f,"__await")?t.resolve(f.__await).then((function(e){n("next",e,l,s)}),(function(e){n("throw",e,l,s)})):t.resolve(f).then((function(e){u.value=e,l(u)}),(function(e){return n("throw",e,l,s)}))}s(c.arg)}var a;this._invoke=function(e,r){function o(){return new t((function(t,o){n(e,r,t,o)}))}return a=a?a.then(o,o):o()}}function k(e,t){var r=e.iterator[t.method];if(void 0===r){if(t.delegate=null,"throw"===t.method){if(e.iterator.return&&(t.method="return",t.arg=void 0,k(e,t),"throw"===t.method))return f;t.method="throw",t.arg=new TypeError("The iterator does not provide a 'throw' method")}return f}var n=d(r,e.iterator,t.arg);if("throw"===n.type)return t.method="throw",t.arg=n.arg,t.delegate=null,f;var o=n.arg;return o?o.done?(t[e.resultName]=o.value,t.next=e.nextLoc,"return"!==t.method&&(t.method="next",t.arg=void 0),t.delegate=null,f):o:(t.method="throw",t.arg=new TypeError("iterator result is not an object"),t.delegate=null,f)}function V(e){var t={tryLoc:e[0]};1 in e&&(t.catchLoc=e[1]),2 in e&&(t.finallyLoc=e[2],t.afterLoc=e[3]),this.tryEntries.push(t)}function N(e){var t=e.completion||{};t.type="normal",delete t.arg,e.completion=t}function E(e){this.tryEntries=[{tryLoc:"root"}],e.forEach(V,this),this.reset(!0)}function _(e){if(e){var t=e[i];if(t)return t.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var n=-1,o=function t(){for(;++n<e.length;)if(r.call(e,n))return t.value=e[n],t.done=!1,t;return t.value=void 0,t.done=!0,t};return o.next=o}}return{next:B}}function B(){return{value:void 0,done:!0}}return m.prototype=h,c(x,"constructor",h),c(h,"constructor",m),m.displayName=c(h,s,"GeneratorFunction"),e.isGeneratorFunction=function(e){var t="function"==typeof e&&e.constructor;return!!t&&(t===m||"GeneratorFunction"===(t.displayName||t.name))},e.mark=function(e){return Object.setPrototypeOf?Object.setPrototypeOf(e,h):(e.__proto__=h,c(e,s,"GeneratorFunction")),e.prototype=Object.create(x),e},e.awrap=function(e){return{__await:e}},w(b.prototype),c(b.prototype,l,(function(){return this})),e.AsyncIterator=b,e.async=function(t,r,n,o,a){void 0===a&&(a=Promise);var i=new b(u(t,r,n,o),a);return e.isGeneratorFunction(r)?i:i.next().then((function(e){return e.done?e.value:i.next()}))},w(x),c(x,s,"Generator"),c(x,i,(function(){return this})),c(x,"toString",(function(){return"[object Generator]"})),e.keys=function(e){var t=[];for(var r in e)t.push(r);return t.reverse(),function r(){for(;t.length;){var n=t.pop();if(n in e)return r.value=n,r.done=!1,r}return r.done=!0,r}},e.values=_,E.prototype={constructor:E,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(N),!e)for(var t in this)"t"===t.charAt(0)&&r.call(this,t)&&!isNaN(+t.slice(1))&&(this[t]=void 0)},stop:function(){this.done=!0;var e=this.tryEntries[0].completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var t=this;function n(r,n){return i.type="throw",i.arg=e,t.next=r,n&&(t.method="next",t.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var l=r.call(a,"catchLoc"),s=r.call(a,"finallyLoc");if(l&&s){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(l){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!s)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(e,t){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===e||"continue"===e)&&a.tryLoc<=t&&t<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=e,i.arg=t,a?(this.method="next",this.next=a.finallyLoc,f):this.complete(i)},complete:function(e,t){if("throw"===e.type)throw e.arg;return"break"===e.type||"continue"===e.type?this.next=e.arg:"return"===e.type?(this.rval=this.arg=e.arg,this.method="return",this.next="end"):"normal"===e.type&&t&&(this.next=t),f},finish:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var r=this.tryEntries[t];if(r.finallyLoc===e)return this.complete(r.completion,r.afterLoc),N(r),f}},catch:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var r=this.tryEntries[t];if(r.tryLoc===e){var n=r.completion;if("throw"===n.type){var o=n.arg;N(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(e,t,r){return this.delegate={iterator:_(e),resultName:t,nextLoc:r},"next"===this.method&&(this.arg=void 0),f}},e}function i(e,t,r,n,o,a,i){try{var l=e[a](i),s=l.value}catch(e){return void r(e)}l.done?t(s):Promise.resolve(s).then(n,o)}function l(e){return function(){var t=this,r=arguments;return new Promise((function(n,o){var a=e.apply(t,r);function l(e){i(a,n,o,l,s,"next",e)}function s(e){i(a,n,o,l,s,"throw",e)}l(void 0)}))}}function s(){var e=(0,n.ref)({data:null,activities:null,users:null}),t=(0,n.ref)(!1),r=(0,n.ref)(!1),o=function(){var n=l(a().mark((function n(o){return a().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return r.value=!0,n.next=3,axios.get(o).then((function(t){return e.value=t.data})).catch((function(e){return t.value=e})).finally((function(){return r.value=!1}));case 3:case"end":return n.stop()}}),n)})));return function(e){return n.apply(this,arguments)}}(),i=function(){var n=l(a().mark((function n(o){return a().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return r.value=!0,n.next=3,axios.get(o).then((function(t){return e.value.activities=t.data})).catch((function(e){return t.value=e})).finally((function(){return r.value=!1}));case 3:case"end":return n.stop()}}),n)})));return function(e){return n.apply(this,arguments)}}(),s=function(){var n=l(a().mark((function n(o){return a().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return r.value=!0,n.next=3,axios.get(o).then((function(t){return e.value.users=t.data})).catch((function(e){return t.value=e})).finally((function(){return r.value=!1}));case 3:case"end":return n.stop()}}),n)})));return function(e){return n.apply(this,arguments)}}();return{processing:r,error:t,data:e,doInitData:function(t){return e.value.data=t},doFetchData:o,doFetchDataActivities:i,doFetchDataUsers:s}}},81798:(e,t,r)=>{function n(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return o(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}r.d(t,{G:()=>a});var a=(0,r(94865).ref)({multiple:!1,dragging:!1,media:[],error:null,doMediaFetchIds:function(){var e;return null===(e=this.media)||void 0===e?void 0:e.filter((function(e){return!e.error})).map((function(e){return e.id}))},doRemoveFile:function(e,t){var r=this;this.media.splice(e,1),t.id&&axios.delete(route("api.attachments.destroy",t.id)).catch((function(n){r.media.splice(e,0,t),r.media.error="Upload failed. Please try again later.",422===(null==n?void 0:n.response.status)&&(r.media.error=n.response.data.errors.file[0])}))},doLoadFiles:function(e){var t=this;this.multiple||(e=[e[0]]),e.forEach((function(e){t.push({id:e.id,file:e,url:e.url,progress:100,error:null,uploaded:!0})}))},push:function(e){this.media.unshift(e)},doDroppedFiles:function(e){this.dragging=!1;var t=n(e.dataTransfer.items).filter((function(e){return"file"===e.kind})).map((function(e){return e.getAsFile()}));this.doUploadFiles(t)},doSelectedFiles:function(e){var t=n(e.target.files);this.doUploadFiles(t)},doUploadFiles:function(e){var t=this;this.multiple||(e=[e[0]]),e.forEach((function(e){t.push({file:e,url:null,progress:0,error:null,uploaded:!1}),t.doSubmitFiles()}))},doSubmitFiles:function(){var e=this;this.media.filter((function(e){return!e.uploaded})).forEach((function(t,r){var n=new FormData;n.append("file",t.file),axios.post(route("api.attachments.store"),n,{onUploadProgress:function(e){t.progress=Math.round(100*e.loaded/e.total)}}).then((function(r){t.id=r.data.data.id,t.url=r.data.data.url,t.uploaded=!0,e.error=null})).catch((function(n){t.error="Upload failed. Please try again later.",422===(null==n?void 0:n.response.status)&&(t.error=n.response.data.errors.file[0]),e.multiple||(e.media.splice(r,1),e.error=t.error)}))}))}})},40280:(e,t,r)=>{r.d(t,{D:()=>a});var n=r(46461);r(90801);function o(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var a=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.errors={}}var t,r,a;return t=e,(r=[{key:"get",value:function(e){if(this.errors[e])return this.errors[e][0]}},{key:"getWithMutator",value:function(e,t){if(this.errors[e])return this.errors[e][0].replace(e,t)}},{key:"clear",value:function(e){void 0!==this.errors&&this.errors[e]&&delete this.errors[e]}},{key:"drop",value:function(){this.errors={}}},{key:"has",value:function(e){return this.errors.hasOwnProperty(e)}},{key:"first",value:function(e){if(this.errors[e])return this.errors[e]}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"all",value:function(){return this.any()?this.errors:[]}},{key:"record",value:function(e){this.errors=e}},{key:"getErrors",value:function(){var e="";for(var t in this.errors)e+=this.errors[t][0]+"<br/>";return e}},{key:"onFailed",value:function(e){void 0!==e.response&&e.response.hasOwnProperty("data")&&e.response.data.hasOwnProperty("errors")?(this.record(e.response.data.errors),e.response.data.hasOwnProperty("message")&&(0,n.bM)({title:e.response.statusText,message:e.response.data.message,type:"error"})):void 0!==e.response&&e.response.hasOwnProperty("data")&&e.response.data.hasOwnProperty("message")?(0,n.bM)({title:e.response.statusText,message:e.response.data.message,type:"error"}):e.hasOwnProperty("message")?(0,n.bM)({title:"Error !",message:e.message,type:"error"}):((0,n.bM)({title:"Error !",message:"Service not answer, Please contact your Support",type:"error"}),console.log(e))}}])&&o(t.prototype,r),a&&o(t,a),Object.defineProperty(t,"prototype",{writable:!1}),e}()},20163:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Input",props:{modelValue:[String,Number],name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("input",{ref_key:"input",ref:a,name:e.name,placeholder:e.placeholder,class:"border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)})},null,40,o)}}}},78490:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o={class:"text-sm text-red-600"};const a={__name:"InputError",props:{message:String},setup:function(e){return function(t,r){return(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("p",o,(0,n.toDisplayString)(e.message),1)],512)),[[n.vShow,e.message]])}}}},99672:(e,t,r)=>{r.d(t,{Z:()=>u});var n=r(94865),o={class:"flex items-center justify-between"},a={class:"block font-medium text-sm text-gray-500"},i={key:0},l={key:0,class:"text-rose-500"},s={key:1},c={key:0,class:"text-secondary-500 text-sm leading-5 dark:text-secondary-400"};const u={__name:"Label",props:{value:String,required:{type:Boolean,default:!1},optional:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("label",a,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",i,[(0,n.createTextVNode)((0,n.toDisplayString)(e.value)+" ",1),e.required?((0,n.openBlock)(),(0,n.createElementBlock)("span",l,"*")):(0,n.createCommentVNode)("",!0)])):((0,n.openBlock)(),(0,n.createElementBlock)("span",s,[(0,n.renderSlot)(t.$slots,"default")]))]),e.optional?((0,n.openBlock)(),(0,n.createElementBlock)("span",c,(0,n.toDisplayString)(t.__("Optional")),1)):(0,n.createCommentVNode)("",!0)])}}}},87359:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Textarea",props:{modelValue:String,name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("textarea",{rows:"4",ref_key:"textarea",ref:a,name:e.name,placeholder:e.placeholder,value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),class:"shadow-sm focus:ring-indigo-300 focus:border-indigo-300 block w-full sm:text-sm border-gray-300 focus:ring-opacity-50 rounded-md"},null,40,o)}}}},36824:(e,t,r)=>{r.r(t),r.d(t,{default:()=>M});var n=r(94865),o=r(39038),a=r(12331),i=r(52600),l=r(66257),s=r(77925),c=r(87359),u=r(20163),d=r(99672),f=r(78490),p=r(40280),m=r(2360),h=r(32184),g=(0,n.createElementVNode)("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1),v={class:"fixed z-10 inset-0 overflow-y-auto"},y={class:"flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0"},x=["onSubmit"],w={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},b={class:"mb-3"},k={class:"grid grid-cols-1 gap-4 sm:grid-cols-3"},V={class:"col-span-1 sm:col-span-3"},N={class:"grid grid-cols-1 gap-6 sm:grid-cols-3"},E={class:"col-span-1 sm:col-span-2"},_={class:"grid grid-cols-1 gap-4 sm:grid-cols-2"},B={class:"col-span-1 sm:col-span-2"},S={class:"col-span-1 sm:col-span-2"},C={class:"col-span-1 sm:col-span-2"},L={class:"col-span-1 sm:col-span-2"},j=(0,n.createElementVNode)("p",{class:"mt-2 text-sm text-gray-500"},"160 characters",-1),F={class:"bg-secondary-100 col-span-1"},D={class:"p-4 grid grid-cols-1 gap-4 sm:grid-cols-1"},G={class:"col-span-1"},O=(0,n.createElementVNode)("span",{class:"text-sm font-medium text-gray-900 cursor-pointer"},"Online",-1),P={class:"bg-secondary-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"};const M={__name:"CreateModal",props:{editing:Object,filters:Object,basePageRoute:String},setup:function(e){var t=e,r=(0,n.ref)(!0),M=(0,n.reactive)({id:t.editing.id,name:t.editing.name,parent_id:t.editing.parent_id,seo_title:t.editing.seo_title,seo_description:t.editing.seo_description,online:(0,n.ref)(t.editing.online),errors:new p.D,processing:!1}),Z=function(){r.value=!1,document.querySelector("#cancelButtonRef").click()},T=function(){M.processing=!0,axios.post(route("admin.categories.store"),{name:M.name,parent_id:M.parent_id,seo_title:M.seo_title,seo_description:M.seo_description,online:M.online}).then((function(){M.processing=!1,Z()})).catch((function(e){M.processing=!1,M.errors.record(e.response.data.errors)}))};return function(e,p){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(i.Q),{as:"template",show:r.value,enter:"transition-opacity duration-500","enter-from":"opacity-0","enter-to":"opacity-100",leave:"transition-opacity duration-500","leave-from":"opacity-100","leave-to":"opacity-0"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(l.Vq),{as:"div",class:"relative z-10",onClose:p[6]||(p[6]=function(e){return Z()})},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(i.x),{as:"template",enter:"transition-opacity ease-linear duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"transition-opacity ease-linear duration-300","leave-from":"opacity-100","leave-to":"opacity-0"},{default:(0,n.withCtx)((function(){return[g]})),_:1}),(0,n.createElementVNode)("div",v,[(0,n.createElementVNode)("div",y,[(0,n.createVNode)((0,n.unref)(i.x),{as:"template",enter:"transition ease-in-out duration-300 transform","enter-from":"-translate-x-full","enter-to":"translate-x-0",leave:"transition ease-in-out duration-300 transform","leave-from":"translate-x-0","leave-to":"-translate-x-full"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(l.EM),{class:"relative bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-5xl sm:w-full"},{default:(0,n.withCtx)((function(){var r;return[(0,n.createElementVNode)("form",{onSubmit:(0,n.withModifiers)(T,["prevent"]),onKeydown:p[5]||(p[5]=function(e){return M.errors.clear(e.target.name)})},[(0,n.createElementVNode)("div",w,[(0,n.createElementVNode)("div",null,[(0,n.createElementVNode)("div",b,[(0,n.createVNode)((0,n.unref)(l.$N),{as:"h3",class:"text-lg leading-6 font-medium text-gray-900"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Edit Modal")),1)]})),_:1})]),(0,n.createElementVNode)("div",k,[(0,n.createElementVNode)("div",V,[(0,n.createElementVNode)("div",N,[(0,n.createElementVNode)("div",E,[(0,n.createElementVNode)("div",_,[(0,n.createElementVNode)("div",B,[(0,n.createVNode)(d.Z,{for:"name",value:"Name",required:""}),(0,n.createVNode)(u.Z,{id:"name",name:"name",modelValue:M.name,"onUpdate:modelValue":p[0]||(p[0]=function(e){return M.name=e}),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"]),(0,n.createVNode)(f.Z,{message:M.errors.get("name"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",S,[(0,n.createVNode)((0,n.unref)(m.Z),{modelValue:M.parent_id,"onUpdate:modelValue":p[1]||(p[1]=function(e){return M.parent_id=e}),"country-id":M.country_id,placeholder:"No category","api-url":"api.categories.index",label:"Parent","default-value":null===(r=t.editing.parent)||void 0===r?void 0:r.name,key:"select-city"},null,8,["modelValue","country-id","default-value"]),(0,n.createVNode)(f.Z,{message:M.errors.get("parent_id"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",C,[(0,n.createVNode)(d.Z,{for:"seo_title",value:"Seo Title",optional:""}),(0,n.createVNode)(u.Z,{id:"seo_title",name:"seo_title",modelValue:M.seo_title,"onUpdate:modelValue":p[2]||(p[2]=function(e){return M.seo_title=e}),type:"text",class:"mt-1 block w-full"},null,8,["modelValue"]),(0,n.createVNode)(f.Z,{message:M.errors.get("seo_title"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",L,[(0,n.createVNode)(d.Z,{for:"seo_description",value:"Seo Description",optional:""}),(0,n.createVNode)((0,n.unref)(c.Z),{id:"seo_description",name:"seo_description",modelValue:M.seo_description,"onUpdate:modelValue":p[3]||(p[3]=function(e){return M.seo_description=e}),type:"text",class:"mt-1 block w-full"},null,8,["modelValue"]),j,(0,n.createVNode)(f.Z,{message:M.errors.get("seo_description"),class:"mt-2"},null,8,["message"])])])]),(0,n.createElementVNode)("div",F,[(0,n.createElementVNode)("div",D,[(0,n.createElementVNode)("div",G,[(0,n.createVNode)((0,n.unref)(s.Mv),{as:"div",class:"mt-2 flex items-center whitespace-nowrap"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(s.rs),{modelValue:M.online,"onUpdate:modelValue":p[4]||(p[4]=function(e){return M.online=e}),class:(0,n.normalizeClass)([M.online?"bg-indigo-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"])},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",{"aria-hidden":"true",class:(0,n.normalizeClass)([M.online?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"])},null,2)]})),_:1},8,["modelValue","class"]),(0,n.createVNode)((0,n.unref)(s.$A),{as:"span",class:"ml-3"},{default:(0,n.withCtx)((function(){return[O]})),_:1})]})),_:1})]),(0,n.createVNode)((0,n.unref)(h.Z))])])])])])])]),(0,n.createElementVNode)("div",P,[(0,n.createVNode)((0,n.unref)(a.Z),{type:"submit",loading:M.processing,class:"uppercase w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Save")),1)]})),_:1},8,["loading"]),(0,n.createVNode)((0,n.unref)(o.rU),{href:t.basePageRoute,"preserve-state":"","preserve-scroll":"",class:"uppercase mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm",id:"cancelButtonRef",ref:"cancelButtonRef"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Cancel")),1)]})),_:1},8,["href"])])],40,x)]})),_:1})]})),_:1})])])]})),_:1})]})),_:1},8,["show"])}}}},2360:(e,t,r)=>{r.d(t,{Z:()=>x});var n=r(94865),o=r(68133),a=r(71315),i=r(72648),l=r(23279),s=r.n(l),c=r(94787),u=r(35937),d=r.n(u),f={class:"grid grid-cols-1 gap-4 sm:grid-cols-1"},p={class:"col-span-1"},m={class:"relative mt-1"},h={class:"flex items-center"},g=["innerHTML"],v=["innerHTML"],y={class:"sr-only"};const x={__name:"BaseComboboxes",props:{label:{type:String,default:null},apiUrl:String,modelValue:[String,Number,Array],countryId:{type:Number,default:null},defaultValue:{type:String,default:null},placeholder:{type:String,default:"Select option"},multiple:Boolean,error:String},emits:["update:modelValue"],setup:function(e,t){var r=t.emit,l=e,u=(0,c.i)(),x=u.data,w=(u.doInitData,u.doFetchData),b=(0,n.ref)("");(0,n.watch)(b,s()((function(){return w(route(l.apiUrl,d()({search:b.value,country_id:l.countryId})))}),500),{deep:!0});var k=function(e){if(e)return x.value.data?x.value.data.filter((function(t){return Array.isArray(e)?e.includes(t.id):e===t.id})).map((function(e){return e.name})).join(", "):l.defaultValue};return function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",f,[(0,n.createElementVNode)("div",p,[(0,n.createVNode)((0,n.unref)(i.hQ),{as:"div","model-value":l.modelValue,"onUpdate:modelValue":t[1]||(t[1]=function(e){return r("update:modelValue",e)})},{default:(0,n.withCtx)((function(){return[l.label?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(i.NP),{key:0,class:"block text-sm font-medium text-gray-500"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)("--- "+l.label+" ---"),1)]})),_:1})):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("div",m,[(0,n.createVNode)((0,n.unref)(i.gA),{class:"w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm",placeholder:"--- "+l.placeholder+" ---",onChange:t[0]||(t[0]=function(e){return b.value=e.target.value}),"display-value":k,autocomplete:"off"},null,8,["placeholder"]),(0,n.createVNode)((0,n.unref)(i.Q$),{class:"absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(o.Z),{class:"h-5 w-5 text-gray-400","aria-hidden":"true"})]})),_:1}),(0,n.unref)(x).data?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(i.L5),{key:0,class:"absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"},{default:(0,n.withCtx)((function(){return[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(x).data,(function(e){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(i.O2),{key:e.id,value:e.id,as:"template"},{default:(0,n.withCtx)((function(t){var r,o,i=t.active,l=t.selected;return[(0,n.createElementVNode)("li",{class:(0,n.normalizeClass)(["relative cursor-default select-none py-2 pl-3 pr-9",i?"bg-indigo-600 text-white":"text-gray-900"])},[(0,n.createElementVNode)("div",h,[e.hasOwnProperty("online")?((0,n.openBlock)(),(0,n.createElementBlock)("span",{key:0,class:(0,n.normalizeClass)(["inline-block h-2 w-2 flex-shrink-0 rounded-full mr-3",e.online?"bg-green-400":"bg-gray-200"]),"aria-hidden":"true"},null,2)):(0,n.createCommentVNode)("",!0),e.emoji?((0,n.openBlock)(),(0,n.createElementBlock)("span",{key:1,class:"inline-block flex-shrink-0 mr-3","aria-hidden":"true",innerHTML:e.emoji},null,8,g)):(0,n.createCommentVNode)("",!0),e.country?((0,n.openBlock)(),(0,n.createElementBlock)("span",{key:2,class:"inline-block flex-shrink-0 mr-3","aria-hidden":"true",innerHTML:null===(r=e.country)||void 0===r?void 0:r.emoji},null,8,v)):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("span",{class:(0,n.normalizeClass)(["truncate",l&&"font-bold"])},[(0,n.createTextVNode)((0,n.toDisplayString)(e.name)+" ",1),(0,n.createElementVNode)("span",y," is "+(0,n.toDisplayString)(e.online?"online":"offline"),1)],2),e.division?((0,n.openBlock)(),(0,n.createElementBlock)("span",{key:3,class:(0,n.normalizeClass)(["ml-2 truncate text-gray-500",i?"text-indigo-200":"text-gray-500"])},(0,n.toDisplayString)(null===(o=e.division)||void 0===o?void 0:o.name),3)):(0,n.createCommentVNode)("",!0)]),l?((0,n.openBlock)(),(0,n.createElementBlock)("span",{key:0,class:(0,n.normalizeClass)(["absolute inset-y-0 right-0 flex items-center pr-4",i?"text-white":"text-indigo-600"])},[(0,n.createVNode)((0,n.unref)(a.Z),{class:"h-5 w-5","aria-hidden":"true"})],2)):(0,n.createCommentVNode)("",!0)],2)]})),_:2},1032,["value"])})),128))]})),_:1})):(0,n.createCommentVNode)("",!0)])]})),_:1},8,["model-value"])])])}}}},32184:(e,t,r)=>{r.d(t,{Z:()=>E});var n=r(94865),o=r(89318),a=r(81798),i={class:"grid grid-cols-1 gap-4 sm:grid-cols-1"},l={key:0,class:"col-span-1"},s={class:"space-y-1 text-center"},c=(0,n.createElementVNode)("svg",{class:"mx-auto h-12 w-12 text-gray-400",stroke:"currentColor",fill:"none",viewBox:"0 0 48 48","aria-hidden":"true"},[(0,n.createElementVNode)("path",{d:"M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})],-1),u={class:"flex text-sm text-gray-600"},d={for:"fileUpload",class:"relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"},f=(0,n.createElementVNode)("span",null,"Upload a file",-1),p=["multiple"],m=(0,n.createElementVNode)("p",{class:"pl-1"},"or drag and drop",-1),h=(0,n.createElementVNode)("p",{class:"text-xs text-gray-500"},"PNG, JPG, GIF up to 10MB",-1),g={key:1,class:"col-span-1"},v={class:"relative w-full aspect-w-10 aspect-h-4 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden"},y=["src"],x=["onClick"],w={key:2,class:"w-full bg-gray-200 rounded-full h-3 shadow-inner overflow-hidden relative flex items-center justify-center"},b={class:"relative z-10 text-xs font-semibold text-center text-white drop-shadow text-shadow"},k={key:3,class:"text-xs text-rose-500"},V={key:2,class:"col-span-1"},N={key:0,class:"text-xs text-rose-500"};const E={__name:"ImageUpload",props:{multiple:Boolean,modelValue:[String,Number,Array]},setup:function(e){var t=e,r=(0,n.ref)(null);return(0,n.onMounted)((function(){a.G.value.multiple=t.multiple,Array.isArray(t.modelValue)&&t.modelValue.length&&a.G.value.doLoadFiles(t.modelValue)})),function(e,E){return(0,n.openBlock)(),(0,n.createElementBlock)("div",i,[t.multiple||!(0,n.unref)(a.G).media.length||(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",l,[(0,n.createElementVNode)("div",{onDrop:E[2]||(E[2]=(0,n.withModifiers)((function(){var e;return(0,n.unref)(a.G).doDroppedFiles&&(e=(0,n.unref)(a.G)).doDroppedFiles.apply(e,arguments)}),["prevent"])),onDragover:E[3]||(E[3]=(0,n.withModifiers)((function(e){return(0,n.unref)(a.G).dragging=!0}),["prevent"])),onDragleave:E[4]||(E[4]=(0,n.withModifiers)((function(e){return(0,n.unref)(a.G).dragging=!1}),["prevent"])),class:(0,n.normalizeClass)([(0,n.unref)(a.G).dragging?"border-indigo-500":"border-gray-400","mt-1 border-2 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center"])},[(0,n.createElementVNode)("div",s,[c,(0,n.createElementVNode)("div",u,[(0,n.createElementVNode)("label",d,[f,(0,n.createElementVNode)("input",{onInput:E[0]||(E[0]=function(e){return r.value=null}),onChange:E[1]||(E[1]=function(){var e;return(0,n.unref)(a.G).doSelectedFiles&&(e=(0,n.unref)(a.G)).doSelectedFiles.apply(e,arguments)}),id:"fileUpload",name:"files",ref_key:"fileUpload",ref:r,type:"file",class:"sr-only",multiple:t.multiple},null,40,p)]),m]),h])],34)])):(0,n.createCommentVNode)("",!0),(0,n.unref)(a.G).media.length?((0,n.openBlock)(),(0,n.createElementBlock)("div",g,[(0,n.createElementVNode)("ul",{role:"list",class:(0,n.normalizeClass)(["grid grid-cols-1 gap-x-4 gap-y-8",{"sm:grid-cols-2 sm:gap-x-6":(0,n.unref)(a.G).media.length>1}])},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(a.G).media,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},[(0,n.createElementVNode)("div",v,[e.uploaded?((0,n.openBlock)(),(0,n.createElementBlock)("img",{key:0,src:e.url,alt:"",class:"object-cover w-full pointer-events-none group-hover:opacity-75"},null,8,y)):(0,n.createCommentVNode)("",!0),e.uploaded?((0,n.openBlock)(),(0,n.createElementBlock)("button",{key:1,onClick:function(r){return(0,n.unref)(a.G).doRemoveFile(t,e)},type:"button",class:"absolute inset-0 top-0 left-0 h-4 w-4 rounded-full hover:bg-rose-500 hover:bg-opacity-25 focus:outline-none text-rose-500 transition duration-200 cursor-pointer"},[(0,n.createVNode)((0,n.unref)(o.Z),{class:"flex-shrink-0 h-4 w-4"})],8,x)):(0,n.createCommentVNode)("",!0),e.uploaded||e.error?(0,n.createCommentVNode)("",!0):((0,n.openBlock)(),(0,n.createElementBlock)("div",w,[(0,n.createElementVNode)("div",{class:"inline-block h-full bg-indigo-600 absolute top-0 left-0",style:(0,n.normalizeStyle)("width: ".concat(e.progress,"%"))},null,4),(0,n.createElementVNode)("div",b,(0,n.toDisplayString)(e.progress)+"%",1)])),e.error?((0,n.openBlock)(),(0,n.createElementBlock)("div",k,(0,n.toDisplayString)(e.error),1)):(0,n.createCommentVNode)("",!0)])])})),128))],2)])):(0,n.createCommentVNode)("",!0),(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",V,[(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",N,(0,n.toDisplayString)((0,n.unref)(a.G).error),1)):(0,n.createCommentVNode)("",!0)])):(0,n.createCommentVNode)("",!0)])}}}},12331:(e,t,r)=>{r.d(t,{Z:()=>i});var n=r(94865),o=["disabled"],a={key:0,class:"btn-spinner mr-2"};const i={__name:"LoadingButton",props:{loading:Boolean},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{disabled:e.loading,class:"flex items-center"},[e.loading?((0,n.openBlock)(),(0,n.createElementBlock)("div",a)):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(t.$slots,"default")],8,o)}}}}}]);