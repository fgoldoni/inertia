"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[5214,4243],{65214:(e,r,t)=>{t.r(r),t.d(r,{default:()=>p});var a=t(94865),o=t(39038),n=t(7801),s=t(87523),l=t(35937),c=t.n(l),i={key:0,class:"group flex items-center flex-row-reverse text-sm leading-5 text-secondary-500 text-right dark:text-secondary-400"},u=(0,a.createElementVNode)("span",{class:"text-gray-500 truncate group-hover:text-gray-900"},"Me",-1),d={class:"sr-only"};const p={__name:"CustomActions",props:{row:Object},setup:function(e){var r=e;return function(e,t){return(0,a.openBlock)(),(0,a.createElementBlock)("div",null,[e.$page.props.user.id===r.row.id?((0,a.openBlock)(),(0,a.createElementBlock)("span",i,[u,(0,a.createVNode)((0,a.unref)(n.Z),{class:"flex-shrink-0 h-5 w-5 text-green-500 group-hover:text-green-700 mr-1","aria-hidden":"true"})])):!r.row.can.edit||r.row.isAdministrator||r.row.deleted_at?(0,a.createCommentVNode)("",!0):((0,a.openBlock)(),(0,a.createBlock)((0,a.unref)(o.rU),{key:1,href:e.route("admin.users.edit",{user:r.row.id}),"preserve-state":"","preserve-scroll":"",data:(0,a.unref)(c())(r.row.params),only:["editing","modal","basePageRoute"],class:"group flex flex-row-reverse items-center hover:shadow-2xl"},{default:(0,a.withCtx)((function(){return[(0,a.createVNode)((0,a.unref)(s.Z),{class:"flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 mr-1 transition ease-in-out delay-150 group-hover:-translate-y-1 group-hover:scale-125 duration-300","aria-hidden":"true"}),(0,a.createElementVNode)("span",d,", "+(0,a.toDisplayString)(r.row.name),1)]})),_:1},8,["href","data"]))])}}}}}]);