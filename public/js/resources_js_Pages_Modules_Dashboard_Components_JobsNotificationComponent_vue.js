"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Pages_Modules_Dashboard_Components_JobsNotificationComponent_vue"],{

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var highcharts_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! highcharts-vue */ "./node_modules/highcharts-vue/dist/highcharts-vue.min.js");
/* harmony import */ var highcharts_vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(highcharts_vue__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'JobsNotificationComponent',
  props: {
    data: Object
  },
  setup: function setup(__props, _ref) {
    var expose = _ref.expose;
    expose();
    var props = __props;
    var tt = (0,vue__WEBPACK_IMPORTED_MODULE_1__.ref)([]);
    var chartOptions = {
      chart: {
        type: 'line'
      },
      title: {
        text: 'Monthly Average Temperature'
      },
      xAxis: {
        type: 'datetime'
      },
      yAxis: {
        title: {
          text: 'Temperature (°C)'
        }
      },
      series: [{
        name: 'Tokyo',
        data: [[Date.UTC(1970, 10, 25), 0], [Date.UTC(1970, 11, 6), 0.25], [Date.UTC(1970, 11, 20), 1.41], [Date.UTC(1970, 11, 25), 1.64], [Date.UTC(1971, 0, 4), 1.6], [Date.UTC(1971, 0, 17), 2.55], [Date.UTC(1971, 0, 24), 2.62], [Date.UTC(1971, 1, 4), 2.5], [Date.UTC(1971, 1, 14), 2.42], [Date.UTC(1971, 2, 6), 2.74], [Date.UTC(1971, 2, 14), 2.62], [Date.UTC(1971, 2, 24), 2.6], [Date.UTC(1971, 3, 1), 2.81], [Date.UTC(1971, 3, 11), 2.63], [Date.UTC(1971, 3, 27), 2.77], [Date.UTC(1971, 4, 4), 2.68], [Date.UTC(1971, 4, 9), 2.56], [Date.UTC(1971, 4, 14), 2.39], [Date.UTC(1971, 4, 19), 2.3], [Date.UTC(1971, 5, 4), 2], [Date.UTC(1971, 5, 9), 1.85], [Date.UTC(1971, 5, 14), 1.49], [Date.UTC(1971, 5, 19), 1.27], [Date.UTC(1971, 5, 24), 0.99], [Date.UTC(1971, 5, 29), 0.67], [Date.UTC(1971, 6, 3), 0.18], [Date.UTC(1971, 6, 4), 0]]
      }]
    };

    var generateData = function generateData(items) {
      var data = [];
      items.forEach(function (item, index) {
        data.push([moment(item[0], 'YYYY-MM-DD').utc(+1).valueOf(), item[1]]);
      });
      return data;
    };

    (0,vue__WEBPACK_IMPORTED_MODULE_1__.onMounted)(function () {});
    var __returned__ = {
      props: props,
      tt: tt,
      chartOptions: chartOptions,
      generateData: generateData,
      Chart: highcharts_vue__WEBPACK_IMPORTED_MODULE_0__.Chart,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_1__.onMounted,
      ref: vue__WEBPACK_IMPORTED_MODULE_1__.ref
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=template&id=6a98280f":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=template&id=6a98280f ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "relative w-full h-full overflow-auto"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)($setup["Chart"], {
    options: $setup.chartOptions
  })]);
}

/***/ }),

/***/ "./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue":
/*!***************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _JobsNotificationComponent_vue_vue_type_template_id_6a98280f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./JobsNotificationComponent.vue?vue&type=template&id=6a98280f */ "./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=template&id=6a98280f");
/* harmony import */ var _JobsNotificationComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_home_goldoni_www_inertia_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_JobsNotificationComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_JobsNotificationComponent_vue_vue_type_template_id_6a98280f__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js":
/*!**************************************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js ***!
  \**************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_JobsNotificationComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_JobsNotificationComponent_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=template&id=6a98280f":
/*!*********************************************************************************************************************!*\
  !*** ./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=template&id=6a98280f ***!
  \*********************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_JobsNotificationComponent_vue_vue_type_template_id_6a98280f__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_unplugin_dist_webpack_loaders_transform_js_ruleSet_1_rules_26_use_0_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_JobsNotificationComponent_vue_vue_type_template_id_6a98280f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./JobsNotificationComponent.vue?vue&type=template&id=6a98280f */ "./node_modules/unplugin/dist/webpack/loaders/transform.js??ruleSet[1].rules[26].use[0]!./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Pages/Modules/Dashboard/Components/JobsNotificationComponent.vue?vue&type=template&id=6a98280f");


/***/ })

}]);