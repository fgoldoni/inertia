"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Modules_Dashboard_Components_CompaniesComponent_vue"],{

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=script&setup=true&lang=js":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=script&setup=true&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @heroicons/vue/solid */ "./node_modules/@heroicons/vue/solid/esm/ArrowSmDownIcon.js");
/* harmony import */ var _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @heroicons/vue/solid */ "./node_modules/@heroicons/vue/solid/esm/ArrowSmUpIcon.js");
/* harmony import */ var _heroicons_vue_outline__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @heroicons/vue/outline */ "./node_modules/@heroicons/vue/outline/esm/CubeIcon.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'CompaniesComponent',
  props: {
    data: Object
  },
  setup: function setup(__props, _ref) {
    var expose = _ref.expose;
    expose();
    var props = __props;
    var stats = [{
      id: 1,
      name: 'Total Companies',
      stat: props.data.companies_count,
      change: '122',
      changeType: 'increase'
    }];
    var __returned__ = {
      props: props,
      stats: stats,
      ArrowSmDownIcon: _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_0__["default"],
      ArrowSmUpIcon: _heroicons_vue_solid__WEBPACK_IMPORTED_MODULE_1__["default"],
      CubeIcon: _heroicons_vue_outline__WEBPACK_IMPORTED_MODULE_2__["default"]
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=template&id=1a66917f":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=template&id=1a66917f ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "absolute bg-pink-200 rounded-md p-3"
};
var _hoisted_2 = {
  "class": "ml-16 text-sm font-medium text-gray-500 truncate"
};
var _hoisted_3 = {
  "class": "ml-16 pb-6 flex items-baseline sm:pb-7"
};
var _hoisted_4 = {
  "class": "text-2xl font-semibold text-gray-900"
};
var _hoisted_5 = {
  "class": "sr-only"
};
var _hoisted_6 = {
  "class": "absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6"
};
var _hoisted_7 = {
  "class": "text-sm"
};
var _hoisted_8 = {
  href: "#",
  "class": "font-medium text-indigo-600 hover:text-indigo-500"
};

var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" View all");

var _hoisted_10 = {
  "class": "sr-only"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.stats, function (item) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      key: item.id,
      "class": "relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 w-full h-full shadow overflow-hidden"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("dt", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["CubeIcon"], {
      "class": "h-6 w-6 text-pink-700",
      "aria-hidden": "true"
    })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.name), 1
    /* TEXT */
    )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("dd", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.stat), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([item.changeType === 'increase' ? 'text-green-600' : 'text-red-600', 'ml-2 flex items-baseline text-sm font-semibold'])
    }, [item.changeType === 'increase' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["ArrowSmUpIcon"], {
      key: 0,
      "class": "self-center flex-shrink-0 h-5 w-5 text-green-500",
      "aria-hidden": "true"
    })) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["ArrowSmDownIcon"], {
      key: 1,
      "class": "self-center flex-shrink-0 h-5 w-5 text-red-500",
      "aria-hidden": "true"
    })), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", _hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.changeType === 'increase' ? 'Increased' : 'Decreased') + " by ", 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.change), 1
    /* TEXT */
    )], 2
    /* CLASS */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", _hoisted_8, [_hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", _hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.name) + " stats", 1
    /* TEXT */
    )])])])])]);
  }), 64
  /* STABLE_FRAGMENT */
  );
}

/***/ }),

/***/ "./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue":
/*!********************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _CompaniesComponent_vue_vue_type_template_id_1a66917f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CompaniesComponent.vue?vue&type=template&id=1a66917f */ "./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=template&id=1a66917f");
/* harmony import */ var _CompaniesComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CompaniesComponent.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_CompaniesComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_CompaniesComponent_vue_vue_type_template_id_1a66917f__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=script&setup=true&lang=js":
/*!*******************************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=script&setup=true&lang=js ***!
  \*******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CompaniesComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CompaniesComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CompaniesComponent.vue?vue&type=script&setup=true&lang=js */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=template&id=1a66917f":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=template&id=1a66917f ***!
  \**************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CompaniesComponent_vue_vue_type_template_id_1a66917f__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CompaniesComponent_vue_vue_type_template_id_1a66917f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CompaniesComponent.vue?vue&type=template&id=1a66917f */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/CompaniesComponent.vue?vue&type=template&id=1a66917f");


/***/ })

}]);