"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[5815],{25815:(e,t,a)=>{a.r(t),a.d(t,{default:()=>h});var n=a(94865),s=a(31182),l=a(25530),r=a(62545),c={class:"absolute bg-green-200 rounded-md p-3"},o={class:"ml-16 text-sm font-medium text-gray-500 truncate"},i={class:"ml-16 pb-6 flex items-baseline sm:pb-7"},d={class:"text-2xl font-semibold text-gray-900"},m={class:"sr-only"},p={class:"absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6"},u={class:"text-sm"},x={href:"#",class:"font-medium text-indigo-600 hover:text-indigo-500"},g=(0,n.createTextVNode)(" View all"),f={class:"sr-only"};const h={__name:"JobsComponent",props:{data:Object},setup:function(e){var t=[{id:1,name:"Total Jobs",stat:e.data.companies_count,change:"122",changeType:"increase"}];return function(e,a){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(t,(function(e){return(0,n.createElementVNode)("div",{key:e.id,class:"relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 w-full h-full shadow overflow-hidden"},[(0,n.createElementVNode)("dt",null,[(0,n.createElementVNode)("div",c,[(0,n.createVNode)((0,n.unref)(r.Z),{class:"h-6 w-6 text-green-700","aria-hidden":"true"})]),(0,n.createElementVNode)("p",o,(0,n.toDisplayString)(e.name),1)]),(0,n.createElementVNode)("dd",i,[(0,n.createElementVNode)("p",d,(0,n.toDisplayString)(e.stat),1),(0,n.createElementVNode)("p",{class:(0,n.normalizeClass)(["increase"===e.changeType?"text-green-600":"text-red-600","ml-2 flex items-baseline text-sm font-semibold"])},["increase"===e.changeType?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(s.Z),{key:0,class:"self-center flex-shrink-0 h-5 w-5 text-green-500","aria-hidden":"true"})):((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(l.Z),{key:1,class:"self-center flex-shrink-0 h-5 w-5 text-red-500","aria-hidden":"true"})),(0,n.createElementVNode)("span",m,(0,n.toDisplayString)("increase"===e.changeType?"Increased":"Decreased")+" by ",1),(0,n.createTextVNode)(" "+(0,n.toDisplayString)(e.change),1)],2),(0,n.createElementVNode)("div",p,[(0,n.createElementVNode)("div",u,[(0,n.createElementVNode)("a",x,[g,(0,n.createElementVNode)("span",f,(0,n.toDisplayString)(e.name)+" stats",1)])])])])])})),64)}}}}}]);