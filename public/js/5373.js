(self.webpackChunk=self.webpackChunk||[]).push([[5373,8736],{87525:(e,t,o)=>{"use strict";o.d(t,{Z:()=>i});var n=o(23645),r=o.n(n)()((function(e){return e[1]}));r.push([e.id,".layoutJSON{background:#ddd;border:1px solid #000;margin-top:10px;padding:10px}.columns{-moz-columns:120px;columns:120px}.remove{cursor:pointer;position:absolute;right:2px;top:0}.vue-grid-item:not(.vue-grid-placeholder){background:#ccc}.vue-grid-item .resizing{opacity:.9}.vue-grid-item .text{bottom:0;font-size:24px;left:0;margin:auto;position:absolute;right:0;text-align:center;top:0}.vue-grid-item .no-drag,.vue-grid-item .text{height:100%;width:100%}.vue-grid-item .minMax{font-size:12px}.vue-grid-item .add{cursor:pointer}.vue-draggable-handle{background:url(\"data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>\") no-repeat;background-origin:content-box;background-position:100% 100%;background-repeat:no-repeat;box-sizing:border-box;cursor:pointer;height:20px;left:0;padding:0 8px 8px 0;position:absolute;top:0;width:20px}",""]);const i=r},85373:(e,t,o)=>{"use strict";o.r(t),o.d(t,{default:()=>v});var n=o(94865),r=o(39038);function i(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,n)}return o}function a(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?i(Object(o),!0).forEach((function(t){u(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):i(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}function u(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}const c={__name:"Index",props:{rowData:Object,data:Object},setup:function(e){var t=e,i=(0,n.ref)(t.rowData.map((function(e){return e.layout}))),u=(0,n.ref)({}),c=(0,n.ref)(!0),l=(0,n.ref)(!0),s=(0,n.ref)(!0),p=(0,n.ref)(12),d=(0,n.ref)(0);(0,n.onMounted)((function(){d.value=i.value.length,axios.get(route("admin.dashboard.load.data")).then((function(e){return u.value=a(a({},e.data.data),t.data)})).catch((function(e){return console.log(e)})).finally((function(){}))}));var v=function(e){var t;axios.put(route("admin.dashboard.user.update",null===(t=(0,r.qt)().props.value.auth.user)||void 0===t?void 0:t.id),{layouts:e}).then((function(e){})).catch((function(e){})).finally((function(){}))};return function(e,t){var r=(0,n.resolveComponent)("Head"),a=(0,n.resolveComponent)("grid-item"),d=(0,n.resolveComponent)("grid-layout");return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)(r,{title:"Dashboard"}),(0,n.createElementVNode)("div",null,[(0,n.createVNode)(d,{layout:i.value,"col-num":p.value,"row-height":30,"is-draggable":c.value,"is-resizable":l.value,responsive:s.value,"vertical-compact":!0,"use-css-transforms":!0,onLayoutUpdated:v},{default:(0,n.withCtx)((function(){return[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(i.value,(function(e){return(0,n.openBlock)(),(0,n.createBlock)(a,{static:e.static,x:e.x,y:e.y,w:e.w,h:e.h,i:e.i},{default:(0,n.withCtx)((function(){return[u.value.jobs?((0,n.openBlock)(),(0,n.createBlock)((0,n.resolveDynamicComponent)((t=e.component,(0,n.defineAsyncComponent)({loader:function(){return o(75470)("./".concat(t,".vue"))},delay:500,timeout:3e3}))),(0,n.normalizeProps)((0,n.mergeProps)({key:0},{data:u.value})),null,16)):(0,n.createCommentVNode)("",!0)];var t})),_:2},1032,["static","x","y","w","h","i"])})),256))]})),_:1},8,["layout","col-num","is-draggable","is-resizable","responsive"])])],64)}}};var l=o(93379),s=o.n(l),p=o(87525),d={insert:"head",singleton:!1};s()(p.Z,d);p.Z.locals;const v=c},75470:(e,t,o)=>{var n={"./ActivitiesComponent.vue":[93182,8898,3182],"./ApplicationComponent.vue":[52165,8898,2165],"./CompaniesComponent.vue":[71519,8898,1519],"./JobsComponent.vue":[25815,8898,5815],"./JobsNotificationComponent.vue":[3319,8898,1723],"./RegisteredWithinDaysComponent.vue":[45031,8898,1005],"./ReviewComponent.vue":[18481,8898,8481],"./ShortlistedComponent.vue":[91541,8898,1541],"./TeamsComponent.vue":[11009,8898,1009],"./UsersComponent.vue":[64767,8898,4767]};function r(e){if(!o.o(n,e))return Promise.resolve().then((()=>{var t=new Error("Cannot find module '"+e+"'");throw t.code="MODULE_NOT_FOUND",t}));var t=n[e],r=t[0];return Promise.all(t.slice(1).map(o.e)).then((()=>o(r)))}r.keys=()=>Object.keys(n),r.id=75470,e.exports=r}}]);