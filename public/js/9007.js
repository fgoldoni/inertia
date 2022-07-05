"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[9007,4666],{81798:(e,t,r)=>{function n(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return o(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}r.d(t,{G:()=>a});var a=(0,r(94865).ref)({multiple:!1,dragging:!1,media:[],error:null,doMediaFetchIds:function(){var e;return null===(e=this.media)||void 0===e?void 0:e.filter((function(e){return!e.error})).map((function(e){return e.id}))},doRemoveFile:function(e,t){var r=this;this.media.splice(e,1),t.id&&axios.delete(route("api.attachments.destroy",t.id)).catch((function(n){r.media.splice(e,0,t),r.media.error="Upload failed. Please try again later.",422===(null==n?void 0:n.response.status)&&(r.media.error=n.response.data.errors.file[0])}))},doLoadFiles:function(e){var t=this;this.multiple||(e=[e[0]]),e.forEach((function(e){t.push({id:e.id,file:e,url:e.url,progress:100,error:null,uploaded:!0})}))},push:function(e){this.media.unshift(e)},doDroppedFiles:function(e){this.dragging=!1;var t=n(e.dataTransfer.items).filter((function(e){return"file"===e.kind})).map((function(e){return e.getAsFile()}));this.doUploadFiles(t)},doSelectedFiles:function(e){var t=n(e.target.files);this.doUploadFiles(t)},doUploadFiles:function(e){var t=this;this.multiple||(e=[e[0]]),e.forEach((function(e){t.push({file:e,url:null,progress:0,error:null,uploaded:!1}),t.doSubmitFiles()}))},doSubmitFiles:function(){var e=this;this.media.filter((function(e){return!e.uploaded})).forEach((function(t,r){var n=new FormData;n.append("file",t.file),axios.post(route("api.attachments.store"),n,{onUploadProgress:function(e){t.progress=Math.round(100*e.loaded/e.total)}}).then((function(r){t.id=r.data.data.id,t.url=r.data.data.url,t.uploaded=!0,e.error=null})).catch((function(n){t.error="Upload failed. Please try again later.",422===(null==n?void 0:n.response.status)&&(t.error=n.response.data.errors.file[0]),e.multiple||(e.media.splice(r,1),e.error=t.error)}))}))}})},40280:(e,t,r)=>{r.d(t,{D:()=>a});var n=r(46461);r(90801);function o(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var a=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.errors={}}var t,r,a;return t=e,(r=[{key:"get",value:function(e){if(this.errors[e])return this.errors[e][0]}},{key:"getWithMutator",value:function(e,t){if(this.errors[e])return this.errors[e][0].replace(e,t)}},{key:"clear",value:function(e){void 0!==this.errors&&this.errors[e]&&delete this.errors[e]}},{key:"drop",value:function(){this.errors={}}},{key:"has",value:function(e){return this.errors.hasOwnProperty(e)}},{key:"first",value:function(e){if(this.errors[e])return this.errors[e]}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"all",value:function(){return this.any()?this.errors:[]}},{key:"record",value:function(e){this.errors=e}},{key:"getErrors",value:function(){var e="";for(var t in this.errors)e+=this.errors[t][0]+"<br/>";return e}},{key:"onFailed",value:function(e){void 0!==e.response&&e.response.hasOwnProperty("data")&&e.response.data.hasOwnProperty("errors")?(this.record(e.response.data.errors),e.response.data.hasOwnProperty("message")&&(0,n.bM)({title:e.response.statusText,message:e.response.data.message,type:"error"})):void 0!==e.response&&e.response.hasOwnProperty("data")&&e.response.data.hasOwnProperty("message")?(0,n.bM)({title:e.response.statusText,message:e.response.data.message,type:"error"}):e.hasOwnProperty("message")?(0,n.bM)({title:"Error !",message:e.message,type:"error"}):((0,n.bM)({title:"Error !",message:"Service not answer, Please contact your Support",type:"error"}),console.log(e))}}])&&o(t.prototype,r),a&&o(t,a),Object.defineProperty(t,"prototype",{writable:!1}),e}()},69230:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(18699),o=r.n(n);const a=function(e){return{input:e,init:function(){var e=document.querySelector(this.input);if(e){var t=o()(e,{nationalMode:!0,geoIpLookup:function(e,t){fetch("https://ipinfo.io").then((function(t){var r=t&&t.country?t.country:"CM";e(r)}))},utilsScript:"https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"}),r=function(){t.isValidNumber()&&(e.value=t.getNumber())};e.addEventListener("change",r),e.addEventListener("keyup",r)}}}}},20163:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Input",props:{modelValue:[String,Number],name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("input",{ref_key:"input",ref:a,name:e.name,placeholder:e.placeholder,class:"border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)})},null,40,o)}}}},78490:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o={class:"text-sm text-red-600"};const a={__name:"InputError",props:{message:String},setup:function(e){return function(t,r){return(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("p",o,(0,n.toDisplayString)(e.message),1)],512)),[[n.vShow,e.message]])}}}},99672:(e,t,r)=>{r.d(t,{Z:()=>c});var n=r(94865),o={class:"flex items-center justify-between"},a={class:"block font-medium text-sm text-gray-500"},l={key:0},i={key:0,class:"text-rose-500"},s={key:1},u={key:0,class:"text-secondary-500 text-sm leading-5 dark:text-secondary-400"};const c={__name:"Label",props:{value:String,required:{type:Boolean,default:!1},optional:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("label",a,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",l,[(0,n.createTextVNode)((0,n.toDisplayString)(e.value)+" ",1),e.required?((0,n.openBlock)(),(0,n.createElementBlock)("span",i,"*")):(0,n.createCommentVNode)("",!0)])):((0,n.openBlock)(),(0,n.createElementBlock)("span",s,[(0,n.renderSlot)(t.$slots,"default")]))]),e.optional?((0,n.openBlock)(),(0,n.createElementBlock)("span",u,(0,n.toDisplayString)(t.__("Optional")),1)):(0,n.createCommentVNode)("",!0)])}}}},87359:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Textarea",props:{modelValue:String,name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("textarea",{rows:"4",ref_key:"textarea",ref:a,name:e.name,placeholder:e.placeholder,value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),class:"shadow-sm focus:ring-indigo-300 focus:border-indigo-300 block w-full sm:text-sm border-gray-300 focus:ring-opacity-50 rounded-md"},null,40,o)}}}},59007:(e,t,r)=>{r.r(t),r.d(t,{default:()=>P});var n=r(94865),o=r(12331),a=r(52600),l=r(66257),i=r(77925),s=r(20163),u=r(99672),c=r(78490),d=r(40280),m=r(32184),p=r(87359),f=r(69230),g=(r(4033),(0,n.createElementVNode)("div",{class:"fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"},null,-1)),h={class:"fixed z-10 inset-0 overflow-y-auto"},v={class:"flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0"},y=["onSubmit"],x={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},V={class:"mb-3"},b={class:"grid grid-cols-1 gap-4 sm:grid-cols-3"},k={class:"col-span-1 sm:col-span-3"},w={class:"grid grid-cols-1 gap-6 sm:grid-cols-3"},N={class:"col-span-1 sm:col-span-2"},E={class:"grid grid-cols-1 gap-4 sm:grid-cols-2"},B={class:"col-span-1 sm:col-span-2"},S={class:"col-span-1 sm:col-span-2"},C={class:"col-span-1 sm:col-span-2"},_={class:"col-span-1 sm:col-span-2"},M={class:"bg-secondary-100 col-span-1"},Z={class:"p-4 grid grid-cols-1 gap-4 sm:grid-cols-1"},G={class:"col-span-1"},F=(0,n.createElementVNode)("span",{class:"text-sm font-medium text-gray-900 cursor-pointer"},"Online",-1),D={class:"bg-secondary-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"};const P={__name:"CreateModal",props:{editing:Object,filters:Object,basePageRoute:String},setup:function(e){var t=e,r=(0,n.ref)(!0),P=(0,n.reactive)({name:t.editing.name,content:t.editing.content,email:t.editing.email,phone:t.editing.phone,online:(0,n.ref)(t.editing.online),errors:new d.D,processing:!1}),j=function(){r.value=!1,document.querySelector("#cancelButtonRef").click()};(0,n.onMounted)((function(){(0,f.Z)("#phone").init()}));var U=function(){P.processing=!0,axios.post(route("admin.companies.store"),{name:P.name,content:P.content,email:P.email,phone:P.phone,online:P.online}).then((function(){P.processing=!1,j()})).catch((function(e){P.processing=!1,P.errors.record(e.response.data.errors)}))};return function(e,d){var f=(0,n.resolveComponent)("Link");return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(a.Q),{as:"template",show:r.value,enter:"transition-opacity duration-500","enter-from":"opacity-0","enter-to":"opacity-100",leave:"transition-opacity duration-500","leave-from":"opacity-100","leave-to":"opacity-0"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(l.Vq),{as:"div",class:"relative z-10",onClose:d[6]||(d[6]=function(e){return j()})},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(a.x),{as:"template",enter:"transition-opacity ease-linear duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"transition-opacity ease-linear duration-300","leave-from":"opacity-100","leave-to":"opacity-0"},{default:(0,n.withCtx)((function(){return[g]})),_:1}),(0,n.createElementVNode)("div",h,[(0,n.createElementVNode)("div",v,[(0,n.createVNode)((0,n.unref)(a.x),{as:"template",enter:"transition ease-in-out duration-300 transform","enter-from":"-translate-x-full","enter-to":"translate-x-0",leave:"transition ease-in-out duration-300 transform","leave-from":"translate-x-0","leave-to":"-translate-x-full"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(l.EM),{class:"relative bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-5xl sm:w-full"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("form",{onSubmit:(0,n.withModifiers)(U,["prevent"]),onKeydown:d[5]||(d[5]=function(e){return P.errors.clear(e.target.name)})},[(0,n.createElementVNode)("div",x,[(0,n.createElementVNode)("div",null,[(0,n.createElementVNode)("div",V,[(0,n.createVNode)((0,n.unref)(l.$N),{as:"h3",class:"text-lg leading-6 font-medium text-gray-900"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Edit Modal")),1)]})),_:1})]),(0,n.createElementVNode)("div",b,[(0,n.createElementVNode)("div",k,[(0,n.createElementVNode)("div",w,[(0,n.createElementVNode)("div",N,[(0,n.createElementVNode)("div",E,[(0,n.createElementVNode)("div",B,[(0,n.createVNode)(u.Z,{for:"name",value:"Name",required:""}),(0,n.createVNode)(s.Z,{id:"name",name:"name",modelValue:P.name,"onUpdate:modelValue":d[0]||(d[0]=function(e){return P.name=e}),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"]),(0,n.createVNode)(c.Z,{message:P.errors.get("name"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",S,[(0,n.createVNode)(u.Z,{for:"content",value:"Description",optional:""}),(0,n.createVNode)((0,n.unref)(p.Z),{id:"content",name:"content",modelValue:P.content,"onUpdate:modelValue":d[1]||(d[1]=function(e){return P.content=e}),type:"text",class:"mt-1 block w-full"},null,8,["modelValue"]),(0,n.createVNode)(c.Z,{message:P.errors.get("content"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",C,[(0,n.createVNode)(u.Z,{for:"email",value:"Email"}),(0,n.createVNode)(s.Z,{id:"email",name:"email",modelValue:P.email,"onUpdate:modelValue":d[2]||(d[2]=function(e){return P.email=e}),type:"text",class:"mt-1 block w-full",required:""},null,8,["modelValue"]),(0,n.createVNode)(c.Z,{message:P.errors.get("email"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",_,[(0,n.createVNode)(u.Z,{for:"phone",value:"Phone"}),(0,n.createVNode)(s.Z,{id:"phone",name:"phone",modelValue:P.phone,"onUpdate:modelValue":d[3]||(d[3]=function(e){return P.phone=e}),type:"text",class:"mt-1 block w-full",placeholder:"Phone",required:"",autofocus:""},null,8,["modelValue"]),(0,n.createVNode)(c.Z,{message:P.errors.get("phone"),class:"mt-2"},null,8,["message"])])])]),(0,n.createElementVNode)("div",M,[(0,n.createElementVNode)("div",Z,[(0,n.createElementVNode)("div",G,[(0,n.createVNode)((0,n.unref)(i.Mv),{as:"div",class:"mt-2 flex items-center whitespace-nowrap"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(i.rs),{modelValue:P.online,"onUpdate:modelValue":d[4]||(d[4]=function(e){return P.online=e}),class:(0,n.normalizeClass)([P.online?"bg-indigo-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"])},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",{"aria-hidden":"true",class:(0,n.normalizeClass)([P.online?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"])},null,2)]})),_:1},8,["modelValue","class"]),(0,n.createVNode)((0,n.unref)(i.$A),{as:"span",class:"ml-3"},{default:(0,n.withCtx)((function(){return[F]})),_:1})]})),_:1})]),(0,n.createVNode)((0,n.unref)(m.Z))])])])])])])]),(0,n.createElementVNode)("div",D,[(0,n.createVNode)((0,n.unref)(o.Z),{type:"submit",loading:P.processing,class:"uppercase w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Save")),1)]})),_:1},8,["loading"]),(0,n.createVNode)(f,{href:t.basePageRoute,"preserve-state":"","preserve-scroll":"",class:"uppercase mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm",id:"cancelButtonRef",ref:"cancelButtonRef"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Cancel")),1)]})),_:1},8,["href"])])],40,y)]})),_:1})]})),_:1})])])]})),_:1})]})),_:1},8,["show"])}}}},32184:(e,t,r)=>{r.d(t,{Z:()=>E});var n=r(94865),o=r(89318),a=r(81798),l={class:"grid grid-cols-1 gap-4 sm:grid-cols-1"},i={key:0,class:"col-span-1"},s={class:"space-y-1 text-center"},u=(0,n.createElementVNode)("svg",{class:"mx-auto h-12 w-12 text-gray-400",stroke:"currentColor",fill:"none",viewBox:"0 0 48 48","aria-hidden":"true"},[(0,n.createElementVNode)("path",{d:"M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})],-1),c={class:"flex text-sm text-gray-600"},d={for:"fileUpload",class:"relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"},m=(0,n.createElementVNode)("span",null,"Upload a file",-1),p=["multiple"],f=(0,n.createElementVNode)("p",{class:"pl-1"},"or drag and drop",-1),g=(0,n.createElementVNode)("p",{class:"text-xs text-gray-500"},"PNG, JPG, GIF up to 10MB",-1),h={key:1,class:"col-span-1"},v={class:"relative w-full aspect-w-10 aspect-h-4 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden"},y=["src"],x=["onClick"],V={key:2,class:"w-full bg-gray-200 rounded-full h-3 shadow-inner overflow-hidden relative flex items-center justify-center"},b={class:"relative z-10 text-xs font-semibold text-center text-white drop-shadow text-shadow"},k={key:3,class:"text-xs text-rose-500"},w={key:2,class:"col-span-1"},N={key:0,class:"text-xs text-rose-500"};const E={__name:"ImageUpload",props:{multiple:Boolean,modelValue:[String,Number,Array]},setup:function(e){var t=e,r=(0,n.ref)(null);return(0,n.onMounted)((function(){a.G.value.multiple=t.multiple,Array.isArray(t.modelValue)&&t.modelValue.length&&a.G.value.doLoadFiles(t.modelValue)})),function(e,E){return(0,n.openBlock)(),(0,n.createElementBlock)("div",l,[t.multiple||!(0,n.unref)(a.G).media.length||(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",i,[(0,n.createElementVNode)("div",{onDrop:E[2]||(E[2]=(0,n.withModifiers)((function(){var e;return(0,n.unref)(a.G).doDroppedFiles&&(e=(0,n.unref)(a.G)).doDroppedFiles.apply(e,arguments)}),["prevent"])),onDragover:E[3]||(E[3]=(0,n.withModifiers)((function(e){return(0,n.unref)(a.G).dragging=!0}),["prevent"])),onDragleave:E[4]||(E[4]=(0,n.withModifiers)((function(e){return(0,n.unref)(a.G).dragging=!1}),["prevent"])),class:(0,n.normalizeClass)([(0,n.unref)(a.G).dragging?"border-indigo-500":"border-gray-400","mt-1 border-2 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center"])},[(0,n.createElementVNode)("div",s,[u,(0,n.createElementVNode)("div",c,[(0,n.createElementVNode)("label",d,[m,(0,n.createElementVNode)("input",{onInput:E[0]||(E[0]=function(e){return r.value=null}),onChange:E[1]||(E[1]=function(){var e;return(0,n.unref)(a.G).doSelectedFiles&&(e=(0,n.unref)(a.G)).doSelectedFiles.apply(e,arguments)}),id:"fileUpload",name:"files",ref_key:"fileUpload",ref:r,type:"file",class:"sr-only",multiple:t.multiple},null,40,p)]),f]),g])],34)])):(0,n.createCommentVNode)("",!0),(0,n.unref)(a.G).media.length?((0,n.openBlock)(),(0,n.createElementBlock)("div",h,[(0,n.createElementVNode)("ul",{role:"list",class:(0,n.normalizeClass)(["grid grid-cols-1 gap-x-4 gap-y-8",{"sm:grid-cols-2 sm:gap-x-6":(0,n.unref)(a.G).media.length>1}])},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(a.G).media,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},[(0,n.createElementVNode)("div",v,[e.uploaded?((0,n.openBlock)(),(0,n.createElementBlock)("img",{key:0,src:e.url,alt:"",class:"object-cover w-full pointer-events-none group-hover:opacity-75"},null,8,y)):(0,n.createCommentVNode)("",!0),e.uploaded?((0,n.openBlock)(),(0,n.createElementBlock)("button",{key:1,onClick:function(r){return(0,n.unref)(a.G).doRemoveFile(t,e)},type:"button",class:"absolute inset-0 top-0 left-0 h-4 w-4 rounded-full hover:bg-rose-500 hover:bg-opacity-25 focus:outline-none text-rose-500 transition duration-200 cursor-pointer"},[(0,n.createVNode)((0,n.unref)(o.Z),{class:"flex-shrink-0 h-4 w-4"})],8,x)):(0,n.createCommentVNode)("",!0),e.uploaded||e.error?(0,n.createCommentVNode)("",!0):((0,n.openBlock)(),(0,n.createElementBlock)("div",V,[(0,n.createElementVNode)("div",{class:"inline-block h-full bg-indigo-600 absolute top-0 left-0",style:(0,n.normalizeStyle)("width: ".concat(e.progress,"%"))},null,4),(0,n.createElementVNode)("div",b,(0,n.toDisplayString)(e.progress)+"%",1)])),e.error?((0,n.openBlock)(),(0,n.createElementBlock)("div",k,(0,n.toDisplayString)(e.error),1)):(0,n.createCommentVNode)("",!0)])])})),128))],2)])):(0,n.createCommentVNode)("",!0),(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",w,[(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",N,(0,n.toDisplayString)((0,n.unref)(a.G).error),1)):(0,n.createCommentVNode)("",!0)])):(0,n.createCommentVNode)("",!0)])}}}},12331:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(94865),o=["disabled"],a={key:0,class:"btn-spinner mr-2"};const l={__name:"LoadingButton",props:{loading:Boolean},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{disabled:e.loading,class:"flex items-center"},[e.loading?((0,n.openBlock)(),(0,n.createElementBlock)("div",a)):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(t.$slots,"default")],8,o)}}}}}]);