"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Modules_Users_Datatables_CustomName_vue"],{

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _heroicons_vue_outline__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @heroicons/vue/outline */ "./node_modules/@heroicons/vue/outline/esm/ArrowRightIcon.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'CustomName',
  props: {
    row: Object
  },
  setup: function setup(__props, _ref) {
    var expose = _ref.expose;
    expose();
    var props = __props;
    var __returned__ = {
      props: props,
      ArrowRightIcon: _heroicons_vue_outline__WEBPACK_IMPORTED_MODULE_0__["default"]
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=template&id=61c03314":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=template&id=61c03314 ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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
var _hoisted_3 = ["src"];
var _hoisted_4 = {
  "class": "ml-4"
};
var _hoisted_5 = {
  "class": "group inline-flex space-x-2 truncate text-sm"
};
var _hoisted_6 = {
  "class": "font-medium text-gray-900 truncate group-hover:text-gray-900"
};
var _hoisted_7 = ["href"];
var _hoisted_8 = {
  "class": "text-sm leading-5 text-secondary-500 dark:text-secondary-400"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    "class": "h-10 w-10 rounded-full",
    src: $setup.props.row.image,
    alt: ""
  }, null, 8
  /* PROPS */
  , _hoisted_3)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.props.row.name), 1
  /* TEXT */
  ), $setup.props.row.can.impersonate && !(_ctx.$page.props.user.id === $setup.props.row.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
    key: 0,
    href: _ctx.route('impersonate', $setup.props.row.id),
    "class": "text-primary-500 group-hover:text-primary-700 transition ease-in-out delay-150 group-hover:scale-110 group-hover:shadow-2xl duration-300"
  }, " Login As → ", 8
  /* PROPS */
  , _hoisted_7)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, "Registered on " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.props.row.created_at), 1
  /* TEXT */
  )])]);
}

/***/ }),

/***/ "./resources/js/Pages/Modules/Users/Datatables/CustomName.vue":
/*!********************************************************************!*\
  !*** ./resources/js/Pages/Modules/Users/Datatables/CustomName.vue ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _CustomName_vue_vue_type_template_id_61c03314__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CustomName.vue?vue&type=template&id=61c03314 */ "./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=template&id=61c03314");
/* harmony import */ var _CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CustomName.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_CustomName_vue_vue_type_template_id_61c03314__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Modules/Users/Datatables/CustomName.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js ***!
  \*******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CustomName.vue?vue&type=script&setup=true&lang=js */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=template&id=61c03314":
/*!**************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=template&id=61c03314 ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_template_id_61c03314__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CustomName_vue_vue_type_template_id_61c03314__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CustomName.vue?vue&type=template&id=61c03314 */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Users/Datatables/CustomName.vue?vue&type=template&id=61c03314");


/***/ })

}]);