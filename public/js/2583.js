/*! For license information please see 2583.js.LICENSE.txt */
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2583],{36954:(e,t,r)=>{r.d(t,{Z:()=>i});var n=r(94865),o={class:"min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"},a={class:"w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"};const c={},i=(0,r(83744).Z)(c,[["render",function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("div",null,[(0,n.renderSlot)(e.$slots,"logo")]),(0,n.createElementVNode)("div",a,[(0,n.renderSlot)(e.$slots,"default")])])}]])},93903:(e,t,r)=>{r.d(t,{Z:()=>c});var n=r(94865),o=r(39038),a=(0,n.createElementVNode)("svg",{class:"w-16 h-16",viewBox:"0 0 48 48",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[(0,n.createElementVNode)("path",{d:"M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z",fill:"#6875F5"}),(0,n.createElementVNode)("path",{d:"M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z",fill:"#6875F5"})],-1);const c={__name:"AuthenticationCardLogo",setup:function(e){return function(e,t){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.rU),{href:"/"},{default:(0,n.withCtx)((function(){return[a]})),_:1})}}}},38680:(e,t,r)=>{r.d(t,{Z:()=>c});var n=r(94865),o=r(34374),a=["type"];const c={__name:"Button",props:{type:{type:String,default:"submit"},disabled:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:e.type,class:"inline-flex items-center px-4 py-2 bg-primary-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition"},[e.disabled?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.Z),{key:0,class:"animate-spin flex-shrink-0 h-5 w-5 text-white","aria-hidden":"true"})):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(t.$slots,"default")],8,a)}}}},20163:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Input",props:{modelValue:[String,Number],name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("input",{ref_key:"input",ref:a,name:e.name,placeholder:e.placeholder,class:"border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)})},null,40,o)}}}},99672:(e,t,r)=>{r.d(t,{Z:()=>s});var n=r(94865),o={class:"flex items-center justify-between"},a={class:"block font-medium text-sm text-gray-500"},c={key:0},i={key:0,class:"text-rose-500"},l={key:1},u={key:0,class:"text-secondary-500 text-sm leading-5 dark:text-secondary-400"};const s={__name:"Label",props:{value:String,required:{type:Boolean,default:!1},optional:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("label",a,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",c,[(0,n.createTextVNode)((0,n.toDisplayString)(e.value)+" ",1),e.required?((0,n.openBlock)(),(0,n.createElementBlock)("span",i,"*")):(0,n.createCommentVNode)("",!0)])):((0,n.openBlock)(),(0,n.createElementBlock)("span",l,[(0,n.renderSlot)(t.$slots,"default")]))]),e.optional?((0,n.openBlock)(),(0,n.createElementBlock)("span",u,(0,n.toDisplayString)(t.__("Optional")),1)):(0,n.createCommentVNode)("",!0)])}}}},6489:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(94865),o=r(39038),a={key:0},c=(0,n.createElementVNode)("div",{class:"font-medium text-red-600"}," Whoops! Something went wrong. ",-1),i={class:"mt-3 list-disc list-inside text-sm text-red-600"};const l={__name:"ValidationErrors",setup:function(e){var t=(0,n.computed)((function(){return(0,o.qt)().props.value.errors})),r=(0,n.computed)((function(){return Object.keys(t.value).length>0}));return function(e,o){return(0,n.unref)(r)?((0,n.openBlock)(),(0,n.createElementBlock)("div",a,[c,(0,n.createElementVNode)("ul",i,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(t),(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},(0,n.toDisplayString)(e),1)})),128))])])):(0,n.createCommentVNode)("",!0)}}}},2583:(e,t,r)=>{r.r(t),r.d(t,{default:()=>V});var n=r(94865),o=r(39038),a=r(36954),c=r(93903),i=r(38680),l=r(20163),u=r(99672),s=r(6489);function f(e){return f="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},f(e)}function d(){d=function(){return e};var e={},t=Object.prototype,r=t.hasOwnProperty,n="function"==typeof Symbol?Symbol:{},o=n.iterator||"@@iterator",a=n.asyncIterator||"@@asyncIterator",c=n.toStringTag||"@@toStringTag";function i(e,t,r){return Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}),e[t]}try{i({},"")}catch(e){i=function(e,t,r){return e[t]=r}}function l(e,t,r,n){var o=t&&t.prototype instanceof p?t:p,a=Object.create(o.prototype),c=new V(n||[]);return a._invoke=function(e,t,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return N()}for(r.method=o,r.arg=a;;){var c=r.delegate;if(c){var i=b(c,r);if(i){if(i===s)continue;return i}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var l=u(e,t,r);if("normal"===l.type){if(n=r.done?"completed":"suspendedYield",l.arg===s)continue;return{value:l.arg,done:r.done}}"throw"===l.type&&(n="completed",r.method="throw",r.arg=l.arg)}}}(e,r,c),a}function u(e,t,r){try{return{type:"normal",arg:e.call(t,r)}}catch(e){return{type:"throw",arg:e}}}e.wrap=l;var s={};function p(){}function m(){}function h(){}var y={};i(y,o,(function(){return this}));var v=Object.getPrototypeOf,g=v&&v(v(_([])));g&&g!==t&&r.call(g,o)&&(y=g);var w=h.prototype=p.prototype=Object.create(y);function k(e){["next","throw","return"].forEach((function(t){i(e,t,(function(e){return this._invoke(t,e)}))}))}function x(e,t){function n(o,a,c,i){var l=u(e[o],e,a);if("throw"!==l.type){var s=l.arg,d=s.value;return d&&"object"==f(d)&&r.call(d,"__await")?t.resolve(d.__await).then((function(e){n("next",e,c,i)}),(function(e){n("throw",e,c,i)})):t.resolve(d).then((function(e){s.value=e,c(s)}),(function(e){return n("throw",e,c,i)}))}i(l.arg)}var o;this._invoke=function(e,r){function a(){return new t((function(t,o){n(e,r,t,o)}))}return o=o?o.then(a,a):a()}}function b(e,t){var r=e.iterator[t.method];if(void 0===r){if(t.delegate=null,"throw"===t.method){if(e.iterator.return&&(t.method="return",t.arg=void 0,b(e,t),"throw"===t.method))return s;t.method="throw",t.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var n=u(r,e.iterator,t.arg);if("throw"===n.type)return t.method="throw",t.arg=n.arg,t.delegate=null,s;var o=n.arg;return o?o.done?(t[e.resultName]=o.value,t.next=e.nextLoc,"return"!==t.method&&(t.method="next",t.arg=void 0),t.delegate=null,s):o:(t.method="throw",t.arg=new TypeError("iterator result is not an object"),t.delegate=null,s)}function E(e){var t={tryLoc:e[0]};1 in e&&(t.catchLoc=e[1]),2 in e&&(t.finallyLoc=e[2],t.afterLoc=e[3]),this.tryEntries.push(t)}function B(e){var t=e.completion||{};t.type="normal",delete t.arg,e.completion=t}function V(e){this.tryEntries=[{tryLoc:"root"}],e.forEach(E,this),this.reset(!0)}function _(e){if(e){var t=e[o];if(t)return t.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var n=-1,a=function t(){for(;++n<e.length;)if(r.call(e,n))return t.value=e[n],t.done=!1,t;return t.value=void 0,t.done=!0,t};return a.next=a}}return{next:N}}function N(){return{value:void 0,done:!0}}return m.prototype=h,i(w,"constructor",h),i(h,"constructor",m),m.displayName=i(h,c,"GeneratorFunction"),e.isGeneratorFunction=function(e){var t="function"==typeof e&&e.constructor;return!!t&&(t===m||"GeneratorFunction"===(t.displayName||t.name))},e.mark=function(e){return Object.setPrototypeOf?Object.setPrototypeOf(e,h):(e.__proto__=h,i(e,c,"GeneratorFunction")),e.prototype=Object.create(w),e},e.awrap=function(e){return{__await:e}},k(x.prototype),i(x.prototype,a,(function(){return this})),e.AsyncIterator=x,e.async=function(t,r,n,o,a){void 0===a&&(a=Promise);var c=new x(l(t,r,n,o),a);return e.isGeneratorFunction(r)?c:c.next().then((function(e){return e.done?e.value:c.next()}))},k(w),i(w,c,"Generator"),i(w,o,(function(){return this})),i(w,"toString",(function(){return"[object Generator]"})),e.keys=function(e){var t=[];for(var r in e)t.push(r);return t.reverse(),function r(){for(;t.length;){var n=t.pop();if(n in e)return r.value=n,r.done=!1,r}return r.done=!0,r}},e.values=_,V.prototype={constructor:V,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(B),!e)for(var t in this)"t"===t.charAt(0)&&r.call(this,t)&&!isNaN(+t.slice(1))&&(this[t]=void 0)},stop:function(){this.done=!0;var e=this.tryEntries[0].completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var t=this;function n(r,n){return c.type="throw",c.arg=e,t.next=r,n&&(t.method="next",t.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],c=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var i=r.call(a,"catchLoc"),l=r.call(a,"finallyLoc");if(i&&l){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(i){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(e,t){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===e||"continue"===e)&&a.tryLoc<=t&&t<=a.finallyLoc&&(a=null);var c=a?a.completion:{};return c.type=e,c.arg=t,a?(this.method="next",this.next=a.finallyLoc,s):this.complete(c)},complete:function(e,t){if("throw"===e.type)throw e.arg;return"break"===e.type||"continue"===e.type?this.next=e.arg:"return"===e.type?(this.rval=this.arg=e.arg,this.method="return",this.next="end"):"normal"===e.type&&t&&(this.next=t),s},finish:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var r=this.tryEntries[t];if(r.finallyLoc===e)return this.complete(r.completion,r.afterLoc),B(r),s}},catch:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var r=this.tryEntries[t];if(r.tryLoc===e){var n=r.completion;if("throw"===n.type){var o=n.arg;B(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(e,t,r){return this.delegate={iterator:_(e),resultName:t,nextLoc:r},"next"===this.method&&(this.arg=void 0),s}},e}function p(e,t,r,n,o,a,c){try{var i=e[a](c),l=i.value}catch(e){return void r(e)}i.done?t(l):Promise.resolve(l).then(n,o)}var m={class:"mb-4 text-sm text-gray-600"},h=(0,n.createTextVNode)(" Please confirm access to your account by entering the authentication code provided by your authenticator application. "),y=(0,n.createTextVNode)(" Please confirm access to your account by entering one of your emergency recovery codes. "),v=["onSubmit"],g={key:0},w={key:1},k={class:"flex items-center justify-end mt-4"},x=["onClick"],b=(0,n.createTextVNode)(" Use a recovery code "),E=(0,n.createTextVNode)(" Use an authentication code "),B=(0,n.createTextVNode)(" Log in ");const V={__name:"TwoFactorChallenge",setup:function(e){var t=(0,n.ref)(!1),r=(0,o.cI)({code:"",recovery_code:""}),f=(0,n.ref)(null),V=(0,n.ref)(null),_=function(){var e,o=(e=d().mark((function e(){return d().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.value^=!0,e.next=3,(0,n.nextTick)();case 3:t.value?(f.value.focus(),r.code=""):(V.value.focus(),r.recovery_code="");case 4:case"end":return e.stop()}}),e)})),function(){var t=this,r=arguments;return new Promise((function(n,o){var a=e.apply(t,r);function c(e){p(a,n,o,c,i,"next",e)}function i(e){p(a,n,o,c,i,"throw",e)}c(void 0)}))});return function(){return o.apply(this,arguments)}}(),N=function(){r.post(route("two-factor.login"))};return function(e,d){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)((0,n.unref)(o.Fb),{title:"Two-factor Confirmation"}),(0,n.createVNode)(a.Z,null,{logo:(0,n.withCtx)((function(){return[(0,n.createVNode)(c.Z)]})),default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",m,[t.value?((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,{key:1},[y],64)):((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,{key:0},[h],64))]),(0,n.createVNode)(s.Z,{class:"mb-4"}),(0,n.createElementVNode)("form",{onSubmit:(0,n.withModifiers)(N,["prevent"])},[t.value?((0,n.openBlock)(),(0,n.createElementBlock)("div",w,[(0,n.createVNode)(u.Z,{for:"recovery_code",value:"Recovery Code"}),(0,n.createVNode)(l.Z,{id:"recovery_code",ref_key:"recoveryCodeInput",ref:f,modelValue:(0,n.unref)(r).recovery_code,"onUpdate:modelValue":d[1]||(d[1]=function(e){return(0,n.unref)(r).recovery_code=e}),type:"text",class:"mt-1 block w-full",autocomplete:"one-time-code"},null,8,["modelValue"])])):((0,n.openBlock)(),(0,n.createElementBlock)("div",g,[(0,n.createVNode)(u.Z,{for:"code",value:"Code"}),(0,n.createVNode)(l.Z,{id:"code",ref_key:"codeInput",ref:V,modelValue:(0,n.unref)(r).code,"onUpdate:modelValue":d[0]||(d[0]=function(e){return(0,n.unref)(r).code=e}),type:"text",inputmode:"numeric",class:"mt-1 block w-full",autofocus:"",autocomplete:"one-time-code"},null,8,["modelValue"])])),(0,n.createElementVNode)("div",k,[(0,n.createElementVNode)("button",{type:"button",class:"text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer",onClick:(0,n.withModifiers)(_,["prevent"])},[t.value?((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,{key:1},[E],64)):((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,{key:0},[b],64))],8,x),(0,n.createVNode)(i.Z,{class:(0,n.normalizeClass)(["ml-4",{"opacity-25":(0,n.unref)(r).processing}]),disabled:(0,n.unref)(r).processing},{default:(0,n.withCtx)((function(){return[B]})),_:1},8,["class","disabled"])])],40,v)]})),_:1})],64)}}}}}]);