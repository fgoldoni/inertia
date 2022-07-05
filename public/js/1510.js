"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[1510],{38680:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(94865),o=r(34374),a=["type"];const l={__name:"Button",props:{type:{type:String,default:"submit"},disabled:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:e.type,class:"inline-flex items-center px-4 py-2 bg-primary-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition"},[e.disabled?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.Z),{key:0,class:"animate-spin flex-shrink-0 h-5 w-5 text-white","aria-hidden":"true"})):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(t.$slots,"default")],8,a)}}}},62255:(e,t,r)=>{r.d(t,{Z:()=>i});var n=r(94865),o=r(35038),a={class:"md:grid md:grid-cols-3 md:gap-6"},l={class:"mt-5 md:mt-0 md:col-span-2"},s={class:"grid grid-cols-6 gap-6"},c={key:0,class:"flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"};const i={__name:"FormSection",emits:["submitted"],setup:function(e){var t=(0,n.computed)((function(){return!!(0,n.useSlots)().actions}));return function(e,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",a,[(0,n.createVNode)(o.Z,null,{title:(0,n.withCtx)((function(){return[(0,n.renderSlot)(e.$slots,"title")]})),description:(0,n.withCtx)((function(){return[(0,n.renderSlot)(e.$slots,"description")]})),_:3}),(0,n.createElementVNode)("div",l,[(0,n.createElementVNode)("form",{onSubmit:r[0]||(r[0]=(0,n.withModifiers)((function(t){return e.$emit("submitted")}),["prevent"]))},[(0,n.createElementVNode)("div",{class:(0,n.normalizeClass)(["px-4 py-5 bg-white sm:p-6 shadow",(0,n.unref)(t)?"sm:rounded-tl-md sm:rounded-tr-md":"sm:rounded-md"])},[(0,n.createElementVNode)("div",s,[(0,n.renderSlot)(e.$slots,"form")])],2),(0,n.unref)(t)?((0,n.openBlock)(),(0,n.createElementBlock)("div",c,[(0,n.renderSlot)(e.$slots,"actions")])):(0,n.createCommentVNode)("",!0)],32)])])}}}},20163:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o=["name","placeholder","value"];const a={__name:"Input",props:{modelValue:[String,Number],name:{type:String,default:""},placeholder:{type:String,default:""}},emits:["update:modelValue"],setup:function(e,t){var r=t.expose,a=(0,n.ref)(null);return(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),r({focus:function(){return a.value.focus()}}),function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("input",{ref_key:"input",ref:a,name:e.name,placeholder:e.placeholder,class:"border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)})},null,40,o)}}}},78490:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(94865),o={class:"text-sm text-red-600"};const a={__name:"InputError",props:{message:String},setup:function(e){return function(t,r){return(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("p",o,(0,n.toDisplayString)(e.message),1)],512)),[[n.vShow,e.message]])}}}},99672:(e,t,r)=>{r.d(t,{Z:()=>d});var n=r(94865),o={class:"flex items-center justify-between"},a={class:"block font-medium text-sm text-gray-500"},l={key:0},s={key:0,class:"text-rose-500"},c={key:1},i={key:0,class:"text-secondary-500 text-sm leading-5 dark:text-secondary-400"};const d={__name:"Label",props:{value:String,required:{type:Boolean,default:!1},optional:{type:Boolean,default:!1}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("label",a,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",l,[(0,n.createTextVNode)((0,n.toDisplayString)(e.value)+" ",1),e.required?((0,n.openBlock)(),(0,n.createElementBlock)("span",s,"*")):(0,n.createCommentVNode)("",!0)])):((0,n.openBlock)(),(0,n.createElementBlock)("span",c,[(0,n.renderSlot)(t.$slots,"default")]))]),e.optional?((0,n.openBlock)(),(0,n.createElementBlock)("span",i,(0,n.toDisplayString)(t.__("Optional")),1)):(0,n.createCommentVNode)("",!0)])}}}},35038:(e,t,r)=>{r.d(t,{Z:()=>d});var n=r(94865),o={class:"md:col-span-1 flex justify-between"},a={class:"px-4 sm:px-0"},l={class:"text-lg font-medium text-gray-900"},s={class:"mt-1 text-sm text-gray-600"},c={class:"px-4 sm:px-0"};const i={},d=(0,r(83744).Z)(i,[["render",function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.createElementVNode)("div",a,[(0,n.createElementVNode)("h3",l,[(0,n.renderSlot)(e.$slots,"title")]),(0,n.createElementVNode)("p",s,[(0,n.renderSlot)(e.$slots,"description")])]),(0,n.createElementVNode)("div",c,[(0,n.renderSlot)(e.$slots,"aside")])])}]])},81510:(e,t,r)=>{r.r(t),r.d(t,{default:()=>k});var n=r(94865),o=r(39038),a=r(38680),l=r(62255),s=r(20163),c=r(78490),i=r(99672),d=(0,n.createTextVNode)(" Team Details "),u=(0,n.createTextVNode)(" Create a new team to collaborate with others on projects. "),m={class:"col-span-6"},p={class:"flex items-center mt-2"},f=["src","alt"],g={class:"ml-4 leading-tight"},y={class:"text-sm text-gray-700"},x={class:"col-span-6 sm:col-span-4"},v=(0,n.createTextVNode)(" Create ");const k={__name:"CreateTeamForm",setup:function(e){var t=(0,o.cI)({name:""}),r=function(){t.post(route("teams.store"),{errorBag:"createTeam",preserveScroll:!0})};return function(e,o){return(0,n.openBlock)(),(0,n.createBlock)(l.Z,{onSubmitted:r},{title:(0,n.withCtx)((function(){return[d]})),description:(0,n.withCtx)((function(){return[u]})),form:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",m,[(0,n.createVNode)(i.Z,{value:"Team Owner"}),(0,n.createElementVNode)("div",p,[(0,n.createElementVNode)("img",{class:"object-cover w-12 h-12 rounded-full",src:e.$page.props.user.profile_photo_url,alt:e.$page.props.user.name},null,8,f),(0,n.createElementVNode)("div",g,[(0,n.createElementVNode)("div",null,(0,n.toDisplayString)(e.$page.props.user.name),1),(0,n.createElementVNode)("div",y,(0,n.toDisplayString)(e.$page.props.user.email),1)])])]),(0,n.createElementVNode)("div",x,[(0,n.createVNode)(i.Z,{for:"name",value:"Team Name"}),(0,n.createVNode)(s.Z,{id:"name",modelValue:(0,n.unref)(t).name,"onUpdate:modelValue":o[0]||(o[0]=function(e){return(0,n.unref)(t).name=e}),type:"text",class:"block w-full mt-1",autofocus:""},null,8,["modelValue"]),(0,n.createVNode)(c.Z,{message:(0,n.unref)(t).errors.name,class:"mt-2"},null,8,["message"])])]})),actions:(0,n.withCtx)((function(){return[(0,n.createVNode)(a.Z,{class:(0,n.normalizeClass)({"opacity-25":(0,n.unref)(t).processing}),disabled:(0,n.unref)(t).processing},{default:(0,n.withCtx)((function(){return[v]})),_:1},8,["class","disabled"])]})),_:1})}}}}}]);