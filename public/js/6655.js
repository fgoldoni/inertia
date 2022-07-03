"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[6655,9372],{81798:(e,t,r)=>{function n(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return o(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}r.d(t,{G:()=>a});var a=(0,r(94865).ref)({multiple:!1,dragging:!1,media:[],error:null,doMediaFetchIds:function(){var e;return null===(e=this.media)||void 0===e?void 0:e.filter((function(e){return!e.error})).map((function(e){return e.id}))},doRemoveFile:function(e,t){var r=this;this.media.splice(e,1),t.id&&axios.delete(route("api.attachments.destroy",t.id)).catch((function(n){r.media.splice(e,0,t),r.media.error="Upload failed. Please try again later.",422===(null==n?void 0:n.response.status)&&(r.media.error=n.response.data.errors.file[0])}))},doLoadFiles:function(e){var t=this;this.multiple||(e=[e[0]]),e.forEach((function(e){t.push({id:e.id,file:e,url:e.url,progress:100,error:null,uploaded:!0})}))},push:function(e){this.media.unshift(e)},doDroppedFiles:function(e){this.dragging=!1;var t=n(e.dataTransfer.items).filter((function(e){return"file"===e.kind})).map((function(e){return e.getAsFile()}));this.doUploadFiles(t)},doSelectedFiles:function(e){var t=n(e.target.files);this.doUploadFiles(t)},doUploadFiles:function(e){var t=this;this.multiple||(e=[e[0]]),e.forEach((function(e){t.push({file:e,url:null,progress:0,error:null,uploaded:!1}),t.doSubmitFiles()}))},doSubmitFiles:function(){var e=this;this.media.filter((function(e){return!e.uploaded})).forEach((function(t,r){var n=new FormData;n.append("file",t.file),axios.post(route("api.attachments.store"),n,{onUploadProgress:function(e){t.progress=Math.round(100*e.loaded/e.total)}}).then((function(r){t.id=r.data.data.id,t.url=r.data.data.url,t.uploaded=!0,e.error=null})).catch((function(n){t.error="Upload failed. Please try again later.",422===(null==n?void 0:n.response.status)&&(t.error=n.response.data.errors.file[0]),e.multiple||(e.media.splice(r,1),e.error=t.error)}))}))}})},40280:(e,t,r)=>{r.d(t,{D:()=>a});var n=r(46461);r(90801);function o(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var a=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.errors={}}var t,r,a;return t=e,(r=[{key:"get",value:function(e){if(this.errors[e])return this.errors[e][0]}},{key:"getWithMutator",value:function(e,t){if(this.errors[e])return this.errors[e][0].replace(e,t)}},{key:"clear",value:function(e){void 0!==this.errors&&this.errors[e]&&delete this.errors[e]}},{key:"drop",value:function(){this.errors={}}},{key:"has",value:function(e){return this.errors.hasOwnProperty(e)}},{key:"first",value:function(e){if(this.errors[e])return this.errors[e]}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"all",value:function(){return this.any()?this.errors:[]}},{key:"record",value:function(e){this.errors=e}},{key:"getErrors",value:function(){var e="";for(var t in this.errors)e+=this.errors[t][0]+"<br/>";return e}},{key:"onFailed",value:function(e){void 0!==e.response&&e.response.hasOwnProperty("data")&&e.response.data.hasOwnProperty("errors")?this.record(e.response.data.errors):void 0!==e.response&&e.response.hasOwnProperty("data")&&e.response.data.hasOwnProperty("message")?(0,n.bM)({title:e.response.statusText,message:e.response.data.message,type:"error"}):e.hasOwnProperty("message")?(0,n.bM)({title:"Error !",message:e.message,type:"error"}):((0,n.bM)({title:"Error !",message:"Service not answer, Please contact your Support",type:"error"}),console.log(e))}}])&&o(t.prototype,r),a&&o(t,a),Object.defineProperty(t,"prototype",{writable:!1}),e}()},69230:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(18699),o=r.n(n);const a=function(e){return{input:e,init:function(){var e=document.querySelector(this.input);if(e){var t=o()(e,{nationalMode:!0,geoIpLookup:function(e,t){fetch("https://ipinfo.io").then((function(t){var r=t&&t.country?t.country:"CM";e(r)}))},utilsScript:"https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"}),r=function(){t.isValidNumber()&&(e.value=t.getNumber())};e.addEventListener("change",r),e.addEventListener("keyup",r)}}}}},94071:(e,t,r)=>{r.d(t,{Z:()=>u});var n=r(94865),o=r(54790),a=r(65633),l=r(63354),s={class:"-my-3 flow-root"},i={class:"font-medium text-gray-900"},c={class:"ml-6 flex items-center"};const u={__name:"BaseDisclosure",props:{title:String,defaultOpen:{type:Boolean,default:!1}},setup:function(e){var t=e;return function(e,r){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.pJ),{as:"div",defaultOpen:t.defaultOpen,key:"salary-disclosure",class:"border-t border-gray-200 p-6 bg-white rounded-lg shadow-md border-2 border-secondary-200 col-span-1 sm:col-span-2"},{default:(0,n.withCtx)((function(r){var u=r.open;return[(0,n.createElementVNode)("h3",s,[(0,n.createVNode)((0,n.unref)(o.lG),{class:"rounded-lg bg-secondary-100 px-4 py-3 w-full flex items-center justify-between text-sm text-secondary-500 hover:text-secondary-600"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",i,(0,n.toDisplayString)(t.title),1),(0,n.createElementVNode)("span",c,[u?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(l.Z),{key:1,class:"h-5 w-5","aria-hidden":"true"})):((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(a.Z),{key:0,class:"h-5 w-5","aria-hidden":"true"}))])]})),_:2},1024)]),(0,n.createVNode)(n.Transition,{"enter-active-class":"transition duration-100 ease-out","enter-from-class":"transform scale-95 opacity-0","enter-to-class":"transform scale-100 opacity-100","leave-active-class":"transition duration-75 ease-out","leave-from-class":"transform scale-100 opacity-100","leave-to-class":"transform scale-95 opacity-0"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(o.V2),{class:"pt-6"},{default:(0,n.withCtx)((function(){return[(0,n.renderSlot)(e.$slots,"default")]})),_:3})]})),_:3})]})),_:3},8,["defaultOpen"])}}}},20163:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Input",props:{modelValue:[String,Number],name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("input",{ref_key:"input",ref:a,name:e.name,placeholder:e.placeholder,class:"border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)})},null,40,o)}}}},78490:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o={class:"text-sm text-red-600"};const a={__name:"InputError",props:{message:String},setup:function(e){return function(t,r){return(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("p",o,(0,n.toDisplayString)(e.message),1)],512)),[[n.vShow,e.message]])}}}},25622:(e,t,r)=>{r.d(t,{Z:()=>c});var n=r(94865),o=r(20163),a=r(99672),l=r(78490),s=r(69230),i=(r(4033),{class:"col-span-1 sm:col-span-2"});const c={__name:"JetInputPhone",props:{modelValue:[String,Number],error:String,name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e){return(0,n.onMounted)((function(){(0,s.Z)("#phone").init()})),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",i,[(0,n.createVNode)(a.Z,{for:"phone",value:"Phone"}),(0,n.createVNode)(o.Z,{id:"phone",name:"phone",value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),type:"text",class:"mt-1 block w-full",placeholder:"Phone",required:""},null,8,["value"]),(0,n.createVNode)(l.Z,{message:e.error,class:"mt-2"},null,8,["message"])])}}}},99672:(e,t,r)=>{r.d(t,{Z:()=>u});var n=r(94865),o={class:"flex items-center justify-between"},a={class:"block font-medium text-sm text-gray-500"},l={key:0},s={key:0,class:"text-rose-500"},i={key:1},c={key:0,class:"text-secondary-500 text-sm leading-5 dark:text-secondary-400"};const u={__name:"Label",props:{value:String,required:{type:Boolean,default:!1},optional:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("label",a,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",l,[(0,n.createTextVNode)((0,n.toDisplayString)(e.value)+" ",1),e.required?((0,n.openBlock)(),(0,n.createElementBlock)("span",s,"*")):(0,n.createCommentVNode)("",!0)])):((0,n.openBlock)(),(0,n.createElementBlock)("span",i,[(0,n.renderSlot)(t.$slots,"default")]))]),e.optional?((0,n.openBlock)(),(0,n.createElementBlock)("span",c,(0,n.toDisplayString)(t.__("Optional")),1)):(0,n.createCommentVNode)("",!0)])}}}},87359:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Textarea",props:{modelValue:String,name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("textarea",{rows:"4",ref_key:"textarea",ref:a,name:e.name,placeholder:e.placeholder,value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),class:"shadow-sm focus:ring-indigo-300 focus:border-indigo-300 block w-full sm:text-sm border-gray-300 focus:ring-opacity-50 rounded-md"},null,40,o)}}}},76655:(e,t,r)=>{r.r(t),r.d(t,{default:()=>re});var n=r(94865),o=r(12331),a=r(52600),l=r(66257),s=r(77925),i=r(20163),c=r(99672),u=r(78490),d=r(25622),m=r(40280),p=r(32184),f=r(87359),g=r(46461),v=(r(90801),r(87523)),y=r(62974),h=r(63255),k=r(48614),V=r(4670),b=r(94071),x=(0,n.createElementVNode)("div",{class:"hidden fixed inset-0 bg-secondary-500 bg-opacity-75 transition-opacity md:block"},null,-1),N={class:"fixed z-10 inset-0 overflow-y-auto"},w={class:"flex items-stretch md:items-center justify-center min-h-full text-center md:px-2 lg:px-4"},E={class:"flex items-center justify-between"},B=(0,n.createElementVNode)("span",{class:"sr-only"},"Close",-1),_={class:"sm:hidden"},C=(0,n.createElementVNode)("label",{for:"tabs",class:"sr-only"},"Select a tab",-1),S=["value"],Z={class:"hidden sm:block"},D={class:"border-b border-secondary-200"},M={class:"px-4 -mb-px flex space-x-8","aria-label":"Tabs"},F=["onClick","aria-current"],j={key:0},G={class:"px-8 pt-5 pb-4 sm:p-6 sm:pb-4"},O={class:"grid grid-cols-1"},P={class:"col-span-1"},L={key:1},U=["onSubmit"],A={class:"px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},I={class:"grid grid-cols-1 gap-4 sm:grid-cols-3"},T={class:"col-span-1 sm:col-span-3"},z={class:"grid grid-cols-1 gap-6 sm:grid-cols-3"},$={class:"col-span-1 sm:col-span-2"},q={class:"grid grid-cols-1 gap-4 sm:grid-cols-2"},R={key:0,class:"col-span-1 sm:col-span-2"},H={class:"grid grid-cols-1 gap-4 sm:grid-cols-2"},Y={class:"col-span-1 sm:col-span-2"},J={class:"col-span-1 sm:col-span-2"},W={class:"col-span-1 sm:col-span-2"},K={class:"bg-secondary-100 col-span-1"},Q={class:"p-4 grid grid-cols-1 gap-4 sm:grid-cols-1"},X={class:"col-span-1"},ee=(0,n.createElementVNode)("span",{class:"text-sm font-medium text-gray-900 cursor-pointer"},"Online",-1),te={class:"bg-secondary-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"};const re={__name:"EditModal",props:{editing:Object,filters:Object,basePageRoute:String},setup:function(e){var t=e,r=[{name:"Edit Modal",key:"edit_modal",icon:v.Z},{name:"Logs",key:"logs",icon:y.Z}],re=(0,n.ref)("edit_modal"),ne=(0,n.ref)(!0),oe=(0,n.reactive)({id:t.editing.id,name:t.editing.name,content:t.editing.content,email:t.editing.email,phone:t.editing.phone,online:(0,n.ref)(t.editing.online),errors:new m.D,processing:!1}),ae=function(){oe.processing=!0,axios.put(route("admin.companies.update",oe.id),{name:oe.name,content:oe.content,email:oe.email,phone:oe.phone,online:oe.online}).then((function(e){oe.processing=!1,(0,g.bM)({title:"Great!",message:e.data.message,type:"success"}),document.querySelector("#cancelButtonRef").click()})).catch((function(e){oe.processing=!1,oe.errors.onFailed(e)}))};return function(e,m){var g=(0,n.resolveComponent)("Link");return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(a.Q),{as:"template",show:ne.value},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(l.Vq),{as:"div",class:"relative z-10"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(a.x),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"ease-in duration-200","leave-from":"opacity-100","leave-to":"opacity-0"},{default:(0,n.withCtx)((function(){return[x]})),_:1}),(0,n.createElementVNode)("div",N,[(0,n.createElementVNode)("div",w,[(0,n.createVNode)((0,n.unref)(a.x),{as:"template",enter:"ease-out duration-300","enter-from":"opacity-0 translate-y-4 md:translate-y-0 md:scale-95","enter-to":"opacity-100 translate-y-0 md:scale-100",leave:"ease-in duration-200","leave-from":"opacity-100 translate-y-0 md:scale-100","leave-to":"opacity-0 translate-y-4 md:translate-y-0 md:scale-95"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(l.EM),{class:"relative text-base bg-secondary-100 text-left transform transition w-full md:max-w-4xl md:px-4 md:my-8 lg:max-w-6xl"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",E,[(0,n.createVNode)(g,{href:t.basePageRoute,"preserve-state":"","preserve-scroll":"",class:"absolute top-0 right-4 text-secondary-400 hover:text-secondary-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8"},{default:(0,n.withCtx)((function(){return[B,(0,n.createVNode)((0,n.unref)(h.Z),{class:"h-6 w-6","aria-hidden":"true"})]})),_:1},8,["href"]),(0,n.createElementVNode)("div",_,[C,(0,n.withDirectives)((0,n.createElementVNode)("select",{id:"tabs",name:"tabs",class:"block w-full focus:ring-primary-500 focus:border-primary-500 border-secondary-300 rounded-md","onUpdate:modelValue":m[0]||(m[0]=function(e){return re.value=e})},[((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(r,(function(e){return(0,n.createElementVNode)("option",{key:e.name,value:e.key},(0,n.toDisplayString)(e.name),9,S)})),64))],512),[[n.vModelSelect,re.value]])]),(0,n.createElementVNode)("div",Z,[(0,n.createElementVNode)("div",D,[(0,n.createElementVNode)("nav",M,[((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(r,(function(e){return(0,n.createElementVNode)("a",{key:e.name,href:"javascript:;",onClick:function(t){return re.value=e.key},class:(0,n.normalizeClass)([e.key===re.value?"border-primary-500 text-primary-600":"border-transparent text-secondary-500 hover:text-secondary-700 hover:border-secondary-300","group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm"]),"aria-current":e.key===re.value?"page":void 0},[((0,n.openBlock)(),(0,n.createBlock)((0,n.resolveDynamicComponent)(e.icon),{class:(0,n.normalizeClass)([e.key===re.value?"text-primary-500":"text-secondary-400 group-hover:text-secondary-500","-ml-0.5 mr-2 h-5 w-5"]),"aria-hidden":"true"},null,8,["class"])),(0,n.createElementVNode)("span",null,(0,n.toDisplayString)(e.name),1)],10,F)})),64))])])])]),"logs"===re.value?((0,n.openBlock)(),(0,n.createElementBlock)("div",j,[(0,n.createElementVNode)("div",G,[(0,n.createElementVNode)("div",null,[(0,n.createElementVNode)("div",O,[(0,n.createElementVNode)("div",P,[(0,n.createVNode)((0,n.unref)(k.Z),{options:t.editing.logs},null,8,["options"])])])])])])):(0,n.createCommentVNode)("",!0),"edit_modal"===re.value?((0,n.openBlock)(),(0,n.createElementBlock)("div",L,[(0,n.createElementVNode)("form",{onSubmit:(0,n.withModifiers)(ae,["prevent"]),onKeydown:m[6]||(m[6]=function(e){return oe.errors.clear(e.target.name)})},[(0,n.createElementVNode)("div",A,[(0,n.createElementVNode)("div",null,[(0,n.createElementVNode)("div",I,[(0,n.createElementVNode)("div",T,[(0,n.createElementVNode)("div",z,[(0,n.createElementVNode)("div",$,[(0,n.createElementVNode)("div",q,[oe.errors.any()?((0,n.openBlock)(),(0,n.createElementBlock)("div",R,[(0,n.createVNode)((0,n.unref)(V.Z),{errors:oe.errors.all(),class:"mb-4"},null,8,["errors"])])):(0,n.createCommentVNode)("",!0),(0,n.createVNode)((0,n.unref)(b.Z),{title:e.__("Name & Description"),"default-open":""},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",H,[(0,n.createElementVNode)("div",Y,[(0,n.createVNode)(c.Z,{for:"name",value:"Name",required:""}),(0,n.createVNode)(i.Z,{id:"name",name:"name",modelValue:oe.name,"onUpdate:modelValue":m[1]||(m[1]=function(e){return oe.name=e}),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"]),(0,n.createVNode)(u.Z,{message:oe.errors.get("name"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",J,[(0,n.createVNode)(c.Z,{for:"content",value:"Description",optional:""}),(0,n.createVNode)((0,n.unref)(f.Z),{id:"content",name:"content",modelValue:oe.content,"onUpdate:modelValue":m[2]||(m[2]=function(e){return oe.content=e}),type:"text",class:"mt-1 block w-full"},null,8,["modelValue"]),(0,n.createVNode)(u.Z,{message:oe.errors.get("content"),class:"mt-2"},null,8,["message"])]),(0,n.createElementVNode)("div",W,[(0,n.createVNode)(c.Z,{for:"email",value:"Email"}),(0,n.createVNode)(i.Z,{id:"email",name:"email",modelValue:oe.email,"onUpdate:modelValue":m[3]||(m[3]=function(e){return oe.email=e}),type:"text",class:"mt-1 block w-full",required:""},null,8,["modelValue"]),(0,n.createVNode)(u.Z,{message:oe.errors.get("email"),class:"mt-2"},null,8,["message"])]),(0,n.createVNode)(d.Z,{error:oe.errors.get("phone"),modelValue:oe.phone,"onUpdate:modelValue":m[4]||(m[4]=function(e){return oe.phone=e})},null,8,["error","modelValue"])])]})),_:1},8,["title"])])]),(0,n.createElementVNode)("div",K,[(0,n.createElementVNode)("div",Q,[(0,n.createElementVNode)("div",X,[(0,n.createVNode)((0,n.unref)(s.Mv),{as:"div",class:"mt-2 flex items-center whitespace-nowrap"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(s.rs),{modelValue:oe.online,"onUpdate:modelValue":m[5]||(m[5]=function(e){return oe.online=e}),class:(0,n.normalizeClass)([oe.online?"bg-indigo-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"])},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",{"aria-hidden":"true",class:(0,n.normalizeClass)([oe.online?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"])},null,2)]})),_:1},8,["modelValue","class"]),(0,n.createVNode)((0,n.unref)(s.$A),{as:"span",class:"ml-3"},{default:(0,n.withCtx)((function(){return[ee]})),_:1})]})),_:1})]),(0,n.createVNode)((0,n.unref)(p.Z))])])])])])])]),(0,n.createElementVNode)("div",te,[(0,n.createVNode)((0,n.unref)(o.Z),{type:"submit",loading:oe.processing,class:"uppercase w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Save")),1)]})),_:1},8,["loading"]),(0,n.createVNode)(g,{href:t.basePageRoute,"preserve-state":"","preserve-scroll":"",class:"uppercase mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm",id:"cancelButtonRef",ref:"cancelButtonRef"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)(e.__("Cancel")),1)]})),_:1},8,["href"])])],40,U)])):(0,n.createCommentVNode)("",!0)]})),_:1})]})),_:1})])])]})),_:1})]})),_:1},8,["show"])}}}},32184:(e,t,r)=>{r.d(t,{Z:()=>E});var n=r(94865),o=r(89318),a=r(81798),l={class:"grid grid-cols-1 gap-4 sm:grid-cols-1"},s={key:0,class:"col-span-1"},i={class:"space-y-1 text-center"},c=(0,n.createElementVNode)("svg",{class:"mx-auto h-12 w-12 text-gray-400",stroke:"currentColor",fill:"none",viewBox:"0 0 48 48","aria-hidden":"true"},[(0,n.createElementVNode)("path",{d:"M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02","stroke-width":"2","stroke-linecap":"round","stroke-linejoin":"round"})],-1),u={class:"flex text-sm text-gray-600"},d={for:"fileUpload",class:"relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"},m=(0,n.createElementVNode)("span",null,"Upload a file",-1),p=["multiple"],f=(0,n.createElementVNode)("p",{class:"pl-1"},"or drag and drop",-1),g=(0,n.createElementVNode)("p",{class:"text-xs text-gray-500"},"PNG, JPG, GIF up to 10MB",-1),v={key:1,class:"col-span-1"},y={class:"relative w-full aspect-w-10 aspect-h-4 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden"},h=["src"],k=["onClick"],V={key:2,class:"w-full bg-gray-200 rounded-full h-3 shadow-inner overflow-hidden relative flex items-center justify-center"},b={class:"relative z-10 text-xs font-semibold text-center text-white drop-shadow text-shadow"},x={key:3,class:"text-xs text-rose-500"},N={key:2,class:"col-span-1"},w={key:0,class:"text-xs text-rose-500"};const E={__name:"ImageUpload",props:{multiple:Boolean,modelValue:[String,Number,Array]},setup:function(e){var t=e,r=(0,n.ref)(null);return(0,n.onMounted)((function(){a.G.value.multiple=t.multiple,Array.isArray(t.modelValue)&&t.modelValue.length&&a.G.value.doLoadFiles(t.modelValue)})),function(e,E){return(0,n.openBlock)(),(0,n.createElementBlock)("div",l,[t.multiple||!(0,n.unref)(a.G).media.length||(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",s,[(0,n.createElementVNode)("div",{onDrop:E[2]||(E[2]=(0,n.withModifiers)((function(){var e;return(0,n.unref)(a.G).doDroppedFiles&&(e=(0,n.unref)(a.G)).doDroppedFiles.apply(e,arguments)}),["prevent"])),onDragover:E[3]||(E[3]=(0,n.withModifiers)((function(e){return(0,n.unref)(a.G).dragging=!0}),["prevent"])),onDragleave:E[4]||(E[4]=(0,n.withModifiers)((function(e){return(0,n.unref)(a.G).dragging=!1}),["prevent"])),class:(0,n.normalizeClass)([(0,n.unref)(a.G).dragging?"border-indigo-500":"border-gray-400","mt-1 border-2 border-dashed rounded-md px-6 pt-5 pb-6 flex justify-center"])},[(0,n.createElementVNode)("div",i,[c,(0,n.createElementVNode)("div",u,[(0,n.createElementVNode)("label",d,[m,(0,n.createElementVNode)("input",{onInput:E[0]||(E[0]=function(e){return r.value=null}),onChange:E[1]||(E[1]=function(){var e;return(0,n.unref)(a.G).doSelectedFiles&&(e=(0,n.unref)(a.G)).doSelectedFiles.apply(e,arguments)}),id:"fileUpload",name:"files",ref_key:"fileUpload",ref:r,type:"file",class:"sr-only",multiple:t.multiple},null,40,p)]),f]),g])],34)])):(0,n.createCommentVNode)("",!0),(0,n.unref)(a.G).media.length?((0,n.openBlock)(),(0,n.createElementBlock)("div",v,[(0,n.createElementVNode)("ul",{role:"list",class:(0,n.normalizeClass)(["grid grid-cols-1 gap-x-4 gap-y-8",{"sm:grid-cols-2 sm:gap-x-6":(0,n.unref)(a.G).media.length>1}])},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(a.G).media,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},[(0,n.createElementVNode)("div",y,[e.uploaded?((0,n.openBlock)(),(0,n.createElementBlock)("img",{key:0,src:e.url,alt:"",class:"object-cover w-full pointer-events-none group-hover:opacity-75"},null,8,h)):(0,n.createCommentVNode)("",!0),e.uploaded?((0,n.openBlock)(),(0,n.createElementBlock)("button",{key:1,onClick:function(r){return(0,n.unref)(a.G).doRemoveFile(t,e)},type:"button",class:"absolute inset-0 top-0 left-0 h-4 w-4 rounded-full hover:bg-rose-500 hover:bg-opacity-25 focus:outline-none text-rose-500 transition duration-200 cursor-pointer"},[(0,n.createVNode)((0,n.unref)(o.Z),{class:"flex-shrink-0 h-4 w-4"})],8,k)):(0,n.createCommentVNode)("",!0),e.uploaded||e.error?(0,n.createCommentVNode)("",!0):((0,n.openBlock)(),(0,n.createElementBlock)("div",V,[(0,n.createElementVNode)("div",{class:"inline-block h-full bg-indigo-600 absolute top-0 left-0",style:(0,n.normalizeStyle)("width: ".concat(e.progress,"%"))},null,4),(0,n.createElementVNode)("div",b,(0,n.toDisplayString)(e.progress)+"%",1)])),e.error?((0,n.openBlock)(),(0,n.createElementBlock)("div",x,(0,n.toDisplayString)(e.error),1)):(0,n.createCommentVNode)("",!0)])])})),128))],2)])):(0,n.createCommentVNode)("",!0),(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",N,[(0,n.unref)(a.G).error?((0,n.openBlock)(),(0,n.createElementBlock)("div",w,(0,n.toDisplayString)((0,n.unref)(a.G).error),1)):(0,n.createCommentVNode)("",!0)])):(0,n.createCommentVNode)("",!0)])}}}},12331:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(94865),o=["disabled"],a={key:0,class:"btn-spinner mr-2"};const l={__name:"LoadingButton",props:{loading:Boolean},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{disabled:e.loading,class:"flex items-center"},[e.loading?((0,n.openBlock)(),(0,n.createElementBlock)("div",a)):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(t.$slots,"default")],8,o)}}}},48614:(e,t,r)=>{r.d(t,{Z:()=>u});var n=r(94865),o=r(27751),a=(r(89853),r(51285),{class:"grid grid-cols-1 w-full overflow-auto h-80"}),l={class:"px-8"},s={class:"capitalize"},i=(0,n.createTextVNode)(" : "),c=["innerHTML"];const u={__name:"Logs",props:{options:[Object,Array]},setup:function(e){var t=e;return function(e,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",a,[(0,n.createVNode)((0,n.unref)(o.eI),{data:t.options,stripe:"",size:"large"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(o.$Y),{type:"expand"},{default:(0,n.withCtx)((function(t){return[(0,n.createElementVNode)("div",l,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(t.row.properties,(function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("p",null,[(0,n.createElementVNode)("span",s,(0,n.toDisplayString)(e.__(r)),1),i,(0,n.createElementVNode)("span",{innerHTML:t},null,8,c)])})),256))])]})),_:1}),(0,n.createVNode)((0,n.unref)(o.$Y),{label:e.__("Date"),prop:"created_at",sortable:""},null,8,["label"]),(0,n.createVNode)((0,n.unref)(o.$Y),{label:e.__("User"),prop:"causer"},null,8,["label"]),(0,n.createVNode)((0,n.unref)(o.$Y),{label:e.__("Action"),prop:"description"},null,8,["label"])]})),_:1},8,["data"])])}}}},4670:(e,t,r)=>{r.d(t,{Z:()=>s});var n=r(94865),o={key:0},a=(0,n.createElementVNode)("div",{class:"font-medium text-red-600"}," Whoops! Something went wrong. ",-1),l={class:"mt-3 list-disc list-inside text-sm text-red-600"};const s={__name:"ValidationErrors",props:{errors:[Object,Array]},setup:function(e){var t=e,r=(0,n.computed)((function(){return Object.keys(t.errors).length>0}));return function(e,s){return(0,n.unref)(r)?((0,n.openBlock)(),(0,n.createElementBlock)("div",o,[a,(0,n.createElementVNode)("ul",l,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(t.errors,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},(0,n.toDisplayString)(e[0]),1)})),128))])])):(0,n.createCommentVNode)("",!0)}}}}}]);