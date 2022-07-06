(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Modules_Teams_Datatables_CustomName_vue"],{

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/vue-loader/dist/index.js):\nTypeError: Cannot read properties of null (reading 'content')\n    at selectBlock (/home/goldoni/www/inertia/node_modules/vue-loader/dist/select.js:23:45)\n    at Object.loader (/home/goldoni/www/inertia/node_modules/vue-loader/dist/index.js:67:41)");

/***/ }),

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=template&id=2bdd5d7c":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=template&id=2bdd5d7c ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "flex items-center"
};
var _hoisted_2 = {
  "class": "h-10 w-10 flex-shrink-0"
};
var _hoisted_3 = ["alt"];
var _hoisted_4 = {
  "class": "ml-4"
};
var _hoisted_5 = {
  "class": "group inline-flex space-x-2 truncate text-sm"
};
var _hoisted_6 = {
  "class": "flex items-center truncate space-x-2 font-medium text-gray-900 truncate group-hover:text-gray-900"
};
var _hoisted_7 = {
  key: 0,
  "class": "inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800"
};
var _hoisted_8 = {
  key: 0,
  "class": "text-sm leading-5 text-secondary-500 dark:text-secondary-400"
};
var _hoisted_9 = {
  key: 1,
  "class": "text-sm leading-5 text-secondary-500 dark:text-secondary-400"
};
function render(_ctx, _cache) {
  var _component_ExternalLinkIcon = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ExternalLinkIcon");

  var _component_Link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Link");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    "class": "h-10 w-10 rounded-full",
    src: "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    alt: _ctx.props.row.name
  }, null, 8
  /* PROPS */
  , _hoisted_3)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([_ctx.props.row.belongsToTeam ? 'bg-green-400' : 'bg-secondary-200', 'flex-shrink-0 w-2.5 h-2.5 rounded-full']),
    "aria-hidden": "true"
  }, null, 2
  /* CLASS */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.props.row.name), 1
  /* TEXT */
  )]), _ctx.props.row.isCurrentTeam ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_7, " Current ")) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Link, {
    href: _ctx.route('admin.teams.edit', _ctx.props.row.id),
    "preserve-state": "",
    "preserve-scroll": "",
    data: _ctx.pickBy(_ctx.props.row.params),
    only: ['editing', 'modal', 'basePageRoute', 'availableRoles']
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_ExternalLinkIcon, {
        "class": "flex-shrink-0 h-5 w-5 text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300",
        "aria-hidden": "true"
      })];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["href", "data"])]), _ctx.props.row.ownsTeam ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_8, "Owner")) : _ctx.props.row.belongsToTeam ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_9, "Member")) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]);
}

/***/ }),

/***/ "./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue":
/*!********************************************************************!*\
  !*** ./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _CustomName_vue_vue_type_template_id_2bdd5d7c__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CustomName.vue?vue&type=template&id=2bdd5d7c */ "./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=template&id=2bdd5d7c");
/* harmony import */ var _CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CustomName.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_CustomName_vue_vue_type_template_id_2bdd5d7c__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Modules/Teams/Datatables/CustomName.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js ***!
  \*******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CustomName.vue?vue&type=script&setup=true&lang=js */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=template&id=2bdd5d7c":
/*!**************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=template&id=2bdd5d7c ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_template_id_2bdd5d7c__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_template_id_2bdd5d7c__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CustomName.vue?vue&type=template&id=2bdd5d7c */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Teams/Datatables/CustomName.vue?vue&type=template&id=2bdd5d7c");


/***/ })

}]);