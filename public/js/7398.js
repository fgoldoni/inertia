"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[7398],{36954:(e,t,r)=>{r.d(t,{Z:()=>c});var n=r(94865),o={class:"min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"},l={class:"w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"};const a={},c=(0,r(83744).Z)(a,[["render",function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("div",null,[(0,n.renderSlot)(e.$slots,"logo")]),(0,n.createElementVNode)("div",l,[(0,n.renderSlot)(e.$slots,"default")])])}]])},93903:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=r(39038),l=(0,n.createElementVNode)("svg",{class:"w-16 h-16",viewBox:"0 0 48 48",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[(0,n.createElementVNode)("path",{d:"M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z",fill:"#6875F5"}),(0,n.createElementVNode)("path",{d:"M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z",fill:"#6875F5"})],-1);const a={__name:"AuthenticationCardLogo",setup:function(e){return function(e,t){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.rU),{href:"/"},{default:(0,n.withCtx)((function(){return[l]})),_:1})}}}},38680:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(94865),o=["type"];const l={__name:"Button",props:{type:{type:String,default:"submit"}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:e.type,class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"},[(0,n.renderSlot)(t.$slots,"default")],8,o)}}}},38106:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(94865),o=["value"];const l={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{type:String,default:null}},emits:["update:checked"],setup:function(e,t){var r=t.emit,l=e,a=(0,n.computed)({get:function(){return l.checked},set:function(e){r("update:checked",e)}});return function(t,r){return(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("input",{"onUpdate:modelValue":r[0]||(r[0]=function(e){return(0,n.isRef)(a)?a.value=e:null}),type:"checkbox",value:e.value,class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,8,o)),[[n.vModelCheckbox,(0,n.unref)(a)]])}}}},20163:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(94865),o=["name","placeholder","value"];const l={__name:"Input",props:{modelValue:[String,Number],name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,l=(0,n.ref)(null);return(0,n.onMounted)((function(){l.value.hasAttribute("autofocus")&&l.value.focus()})),r({focus:function(){return l.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("input",{ref_key:"input",ref:l,name:e.name,placeholder:e.placeholder,class:"border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)})},null,40,o)}}}},99672:(e,t,r)=>{r.d(t,{Z:()=>i});var n=r(94865),o={class:"flex items-center justify-between"},l={class:"block font-medium text-sm text-gray-500"},a={key:0},c={key:0,class:"text-rose-500"},u={key:1},s={key:0,class:"text-secondary-500 text-sm leading-5 dark:text-secondary-400"};const i={__name:"Label",props:{value:String,required:{type:Boolean,default:!1},optional:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("label",l,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",a,[(0,n.createTextVNode)((0,n.toDisplayString)(e.value)+" ",1),e.required?((0,n.openBlock)(),(0,n.createElementBlock)("span",c,"*")):(0,n.createCommentVNode)("",!0)])):((0,n.openBlock)(),(0,n.createElementBlock)("span",u,[(0,n.renderSlot)(t.$slots,"default")]))]),e.optional?((0,n.openBlock)(),(0,n.createElementBlock)("span",s,(0,n.toDisplayString)(t.__("Optional")),1)):(0,n.createCommentVNode)("",!0)])}}}},6489:(e,t,r)=>{r.d(t,{Z:()=>u});var n=r(94865),o=r(39038),l={key:0},a=(0,n.createElementVNode)("div",{class:"font-medium text-red-600"}," Whoops! Something went wrong. ",-1),c={class:"mt-3 list-disc list-inside text-sm text-red-600"};const u={__name:"ValidationErrors",setup:function(e){var t=(0,n.computed)((function(){return(0,o.qt)().props.value.errors})),r=(0,n.computed)((function(){return Object.keys(t.value).length>0}));return function(e,o){return(0,n.unref)(r)?((0,n.openBlock)(),(0,n.createElementBlock)("div",l,[a,(0,n.createElementVNode)("ul",c,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(t),(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},(0,n.toDisplayString)(e),1)})),128))])])):(0,n.createCommentVNode)("",!0)}}}},87398:(e,t,r)=>{r.r(t),r.d(t,{default:()=>B});var n=r(94865),o=r(39038),l=r(36954),a=r(93903),c=r(38680),u=r(20163),s=r(38106),i=r(99672),d=r(6489);function m(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function p(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?m(Object(r),!0).forEach((function(t){f(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):m(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function f(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var g={key:0,class:"mb-4 font-medium text-sm text-green-600"},y=["onSubmit"],b={class:"mt-4"},k={class:"block mt-4"},v={class:"flex items-center"},h=(0,n.createElementVNode)("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),w={class:"flex items-center justify-end mt-4"},V=(0,n.createTextVNode)(" Forgot your password? "),x=(0,n.createTextVNode)(" Log in ");const B={__name:"Login",props:{canResetPassword:Boolean,status:String},setup:function(e){var t=(0,o.cI)({email:"",password:"",remember:!1}),r=function(){t.transform((function(e){return p(p({},e),{},{remember:t.remember?"on":""})})).post(route("login"),{onFinish:function(){return t.reset("password")}})};return function(m,p){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)((0,n.unref)(o.Fb),{title:"Log in"}),(0,n.createVNode)(l.Z,null,{logo:(0,n.withCtx)((function(){return[(0,n.createVNode)(a.Z)]})),default:(0,n.withCtx)((function(){return[(0,n.createVNode)(d.Z,{class:"mb-4"}),e.status?((0,n.openBlock)(),(0,n.createElementBlock)("div",g,(0,n.toDisplayString)(e.status),1)):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("form",{onSubmit:(0,n.withModifiers)(r,["prevent"])},[(0,n.createElementVNode)("div",null,[(0,n.createVNode)(i.Z,{for:"email",value:"Email"}),(0,n.createVNode)(u.Z,{id:"email",modelValue:(0,n.unref)(t).email,"onUpdate:modelValue":p[0]||(p[0]=function(e){return(0,n.unref)(t).email=e}),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),(0,n.createElementVNode)("div",b,[(0,n.createVNode)(i.Z,{for:"password",value:"Password"}),(0,n.createVNode)(u.Z,{id:"password",modelValue:(0,n.unref)(t).password,"onUpdate:modelValue":p[1]||(p[1]=function(e){return(0,n.unref)(t).password=e}),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"])]),(0,n.createElementVNode)("div",k,[(0,n.createElementVNode)("label",v,[(0,n.createVNode)(s.Z,{checked:(0,n.unref)(t).remember,"onUpdate:checked":p[2]||(p[2]=function(e){return(0,n.unref)(t).remember=e}),name:"remember"},null,8,["checked"]),h])]),(0,n.createElementVNode)("div",w,[e.canResetPassword?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.rU),{key:0,href:m.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:(0,n.withCtx)((function(){return[V]})),_:1},8,["href"])):(0,n.createCommentVNode)("",!0),(0,n.createVNode)(c.Z,{class:(0,n.normalizeClass)(["ml-4",{"opacity-25":(0,n.unref)(t).processing}]),disabled:(0,n.unref)(t).processing},{default:(0,n.withCtx)((function(){return[x]})),_:1},8,["class","disabled"])])],40,y)]})),_:1})],64)}}}}}]);