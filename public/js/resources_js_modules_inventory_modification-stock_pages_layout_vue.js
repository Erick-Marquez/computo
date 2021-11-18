(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_modules_inventory_modification-stock_pages_layout_vue"],{

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=script&lang=js":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=script&lang=js ***!
  \*************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=script&lang=js":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=script&lang=js ***!
  \********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _api_BaseUrl_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../api/BaseUrl.js */ "./resources/js/api/BaseUrl.js");
/* harmony import */ var _components_Loader_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/Loader.vue */ "./resources/js/modules/inventory/modification-stock/components/Loader.vue");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

 // import datatable from "datatables.net";
// require("datatables.net-dt");
// require("datatables.net-buttons-dt");
// require("datatables.net-buttons/js/buttons.html5.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    BaseUrl: _api_BaseUrl_js__WEBPACK_IMPORTED_MODULE_1__["default"],
    Loader: _components_Loader_vue__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  emits: ["selection"],
  created: function created() {
    var _this = this;

    return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return _api_BaseUrl_js__WEBPACK_IMPORTED_MODULE_1__["default"].get("/stock").then(function (response) {
                _this.datos = response.data;
                _this.elementoFiltrado = response.data;
                $("#sampleTable").DataTable().destroy();

                _this.tabla();

                var ind = [];
                var datosRespaldo = _this.datos;
                datosRespaldo.map(function (element) {
                  if (!ind.includes(element.local)) {
                    ind.push(element.local);
                  }
                });
                _this.locales = ind;
              });

            case 2:
              _context.next = 4;
              return _api_BaseUrl_js__WEBPACK_IMPORTED_MODULE_1__["default"].get("/products").then(function (resp) {
                _this.selectSearch = resp.data;
              });

            case 4:
              _this.loader = false;

            case 5:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }))();
  },
  mounted: function mounted() {
    this.tabla();
  },
  data: function data() {
    return {
      idProduct: Number,
      datos: {},
      show: false,
      textoBusqueda: "",
      textoBusquedaDate: "",
      textoBusquedaUser: "",
      elementoFiltrado: {},
      locales: {},
      filtrado: "",
      selectSearch: {},
      elementoFiltradoSearch: {},
      producto: [],
      showProduct: false,
      selected: "",
      textArea: "",
      loader: true //   addProduct:{},
      //   signSelect:'',
      //   productQuantity:'',
      //   productResult:Number

    };
  },
  methods: {
    //   changeSign(i){
    //       this.producto
    //   },
    focusSelect: function focusSelect(e) {
      var label = e.target.previousElementSibling;
      label.classList.add("label--red");
    },
    blureSelect: function blureSelect(e) {
      var label = e.target.previousElementSibling;
      label.classList.remove("label--red");
      console.log(this.selected);
    },
    focus2: function focus2(e) {
      var label = e.target.parentElement.previousElementSibling;
      label.classList.add("label--red");
    },
    blur2: function blur2(e) {
      var label = e.target.parentElement.previousElementSibling;
      label.classList.remove("label--red");
    },
    DeleteProduct: function DeleteProduct(i) {
      this.producto.splice(i, 1);
    },
    cambio: function cambio(e, i) {
      console.log(e.target.value);

      if (this.producto[i].signSelect == "rest") {
        this.producto[i].productResult = this.producto[i].price - parseInt(this.producto[i].productQuantity);
      } else {
        this.producto[i].productResult = this.producto[i].price + parseInt(this.producto[i].productQuantity);
      }

      console.log(this.producto[i]);
    },
    tabla: function tabla() {
      this.$nextTick(function () {
        $("#sampleTable").DataTable({
          dom: "lfrtip",
          buttons: ["copy"]
        });
      });
    },
    regresar: function regresar() {
      this.$router.go(-1);
    },
    getUser: function getUser() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return _api_BaseUrl_js__WEBPACK_IMPORTED_MODULE_1__["default"].get("/stock").then(function (response) {
                  _this2.datos = response.data;
                  $("#sampleTable").DataTable().destroy();

                  _this2.tabla();
                });

              case 2:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    //  deleteElement(id){
    //          Swal.fire({
    //         title: '¿Estas seguro?',
    //         text: "No se podrá revertir",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Sí, borralo'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             BaseUrl.delete(`/products/${id}`).then(resp=>{
    //                 console.log(resp)
    //                 this.getUser()
    //             })
    //             Swal.fire(
    //             '¡Borrado!',
    //             'El dato fue borrado',
    //             )
    //         }
    //     })
    //   },
    showModal: function showModal() {
      this.show = !this.show;
    },
    filtrar: function filtrar() {
      var palabraFiltrar = this.textoBusqueda.toLowerCase() || this.textoBusquedaDate.toLowerCase() || this.textoBusquedaUser.toLowerCase();
      var clientesRespaldo = this.datos;
      console.log(this.datos);
      console.log(clientesRespaldo);
      var clientesFiltrados = clientesRespaldo.filter(function (clientes) {
        return clientes.local.toLowerCase().indexOf(palabraFiltrar) !== -1 || clientes.date.toLowerCase().indexOf(palabraFiltrar) !== -1 || clientes.user.toLowerCase().indexOf(palabraFiltrar) !== -1;
      } // (clientes.documento.toLowerCase().indexOf(palabraFiltrar) !== -1)
      );
      console.log(clientesFiltrados);
      this.elementoFiltrado = clientesFiltrados;
    },
    filtrarSearch: function filtrarSearch() {
      var clientesRespaldo = this.selectSearch;
      var palabraFiltrar = this.filtrado.toLowerCase();

      if (palabraFiltrar === "") {
        this.elementoFiltradoSearch = "";
      } else {
        this.elementoFiltradoSearch = clientesRespaldo.filter(function (clientes) {
          return clientes.name.toLowerCase().indexOf(palabraFiltrar) !== -1;
        });
      }
    },
    seleccionarSearch: function seleccionarSearch(e) {
      var products = {
        local: this.selected,
        obs: this.textArea,
        names: e.name,
        price: e.precio,
        signSelect: "",
        productQuantity: "",
        productResult: 0
      };
      this.producto.push(products);
      console.log(this.producto);

      if (this.producto != 0) {
        this.showProduct = true;
      }

      this.elementoFiltradoSearch = "";
      this.filtrado = "";
    } // crear(){
    //     BaseUrl.post(`/products/${id}`).then(resp=>{
    //         console.log(resp)
    //         this.getUser()
    //     })
    // }
    // async cargar(){
    //    console.log(this.datos)
    //     await BaseUrl.get(`/products?idLocal=${this.idProduct}`).then(response => {
    //         this.datos=response.data
    //     });
    // },

  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=template&id=e358b98a&scoped=true":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=template&id=e358b98a&scoped=true ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-e358b98a"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};

var _hoisted_1 = {
  "class": "body"
};

var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"loader\" data-v-e358b98a><div class=\"loader__bar\" data-v-e358b98a></div><div class=\"loader__bar\" data-v-e358b98a></div><div class=\"loader__bar\" data-v-e358b98a></div><div class=\"loader__bar\" data-v-e358b98a></div><div class=\"loader__bar\" data-v-e358b98a></div><div class=\"loader__ball\" data-v-e358b98a></div></div>", 1);

var _hoisted_3 = [_hoisted_2];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, _hoisted_3);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=template&id=67622794&scoped=true":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=template&id=67622794&scoped=true ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-67622794"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};

var _hoisted_1 = {
  "class": "pagina"
};
var _hoisted_2 = {
  key: 0,
  "class": "modal-overlay"
};
var _hoisted_3 = {
  key: 0,
  "class": "modal"
};

var _hoisted_4 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "subtitle"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", null, "Ajuste de stock")], -1
  /* HOISTED */
  );
});

var _hoisted_5 = {
  "class": "form"
};
var _hoisted_6 = {
  "class": "form__element flex"
};

var _hoisted_7 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Local", -1
  /* HOISTED */
  );
});

var _hoisted_8 = ["value"];
var _hoisted_9 = {
  "class": "form__element flex"
};

var _hoisted_10 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "observaciones", -1
  /* HOISTED */
  );
});

var _hoisted_11 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h3", null, "Agregar Producto", -1
  /* HOISTED */
  );
});

var _hoisted_12 = {
  "class": "form__element flex"
};

var _hoisted_13 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Codigo", -1
  /* HOISTED */
  );
});

var _hoisted_14 = {
  "class": "container"
};
var _hoisted_15 = {
  "class": "option__relative"
};
var _hoisted_16 = {
  "class": "option__contenedor"
};
var _hoisted_17 = ["onClick"];
var _hoisted_18 = {
  "class": "form__element form__product"
};
var _hoisted_19 = {
  "class": "products__name"
};
var _hoisted_20 = {
  "class": "products__price"
};
var _hoisted_21 = {
  "class": "products__result"
};
var _hoisted_22 = ["onUpdate:modelValue", "onChange"];

var _hoisted_23 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    disabled: "",
    value: ""
  }, "+", -1
  /* HOISTED */
  );
});

var _hoisted_24 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "sum",
    selected: ""
  }, "+", -1
  /* HOISTED */
  );
});

var _hoisted_25 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "rest"
  }, "-", -1
  /* HOISTED */
  );
});

var _hoisted_26 = [_hoisted_23, _hoisted_24, _hoisted_25];
var _hoisted_27 = ["onUpdate:modelValue", "onKeyup"];
var _hoisted_28 = ["onClick"];

var _hoisted_29 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-trash-alt"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_30 = [_hoisted_29];

var _hoisted_31 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", null, "Lista de stock", -1
  /* HOISTED */
  );
});

var _hoisted_32 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, "Nuevo", -1
  /* HOISTED */
  );
});

var _hoisted_33 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "boton__img"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-plus"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_34 = [_hoisted_32, _hoisted_33];
var _hoisted_35 = {
  "class": "newTable"
};

var _hoisted_36 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Producto"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Categoria"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Usuario")])], -1
  /* HOISTED */
  );
});

var _hoisted_37 = {
  "class": "firstTr"
};

var _hoisted_38 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, null, -1
  /* HOISTED */
  );
});

var _hoisted_39 = {
  "class": "td__content"
};

var _hoisted_40 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "i"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-search"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_41 = {
  "class": "td__content"
};

var _hoisted_42 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "i"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-search"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_43 = {
  "class": "td__content"
};

var _hoisted_44 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "i"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-search"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_45 = ["onClick"];

var _hoisted_46 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, null, -1
  /* HOISTED */
  );
});

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_loader = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("loader");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [$data.loader ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_loader, {
    key: 0
  })) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(vue__WEBPACK_IMPORTED_MODULE_0__.Transition, {
    name: "overlay"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [$data.show ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_2)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)];
    }),
    _: 1
    /* STABLE */

  }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(vue__WEBPACK_IMPORTED_MODULE_0__.Transition, {
    name: "fade"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [$data.show ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [_hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
        onFocus: _cache[0] || (_cache[0] = function ($event) {
          return $options.focusSelect($event);
        }),
        onBlur: _cache[1] || (_cache[1] = function ($event) {
          return $options.blureSelect($event);
        }),
        "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
          return $data.selected = $event;
        })
      }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.locales, function (ele) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
          key: ele,
          value: ele
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(ele), 9
        /* TEXT, PROPS */
        , _hoisted_8);
      }), 128
      /* KEYED_FRAGMENT */
      ))], 544
      /* HYDRATE_EVENTS, NEED_PATCH */
      ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.selected]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [_hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
        name: "",
        id: "",
        cols: "2",
        rows: "2",
        onFocus: _cache[3] || (_cache[3] = function ($event) {
          return $options.focusSelect($event);
        }),
        onBlur: _cache[4] || (_cache[4] = function ($event) {
          return $options.blureSelect($event);
        }),
        "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
          return $data.textArea = $event;
        })
      }, null, 544
      /* HYDRATE_EVENTS, NEED_PATCH */
      ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.textArea]])]), _hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [_hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
          return $data.filtrado = $event;
        }),
        onKeyup: _cache[7] || (_cache[7] = function () {
          return $options.filtrarSearch && $options.filtrarSearch.apply($options, arguments);
        }),
        onClick: _cache[8] || (_cache[8] = function () {
          return _ctx.ocultarSearch && _ctx.ocultarSearch.apply(_ctx, arguments);
        }),
        "class": "inputContent",
        onFocus: _cache[9] || (_cache[9] = function ($event) {
          return $options.focus2($event);
        }),
        onBlur: _cache[10] || (_cache[10] = function ($event) {
          return $options.blur2($event);
        })
      }, null, 544
      /* HYDRATE_EVENTS, NEED_PATCH */
      ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.filtrado]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.elementoFiltradoSearch, function (filSearch) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
          key: filSearch,
          onClick: function onClick($event) {
            return $options.seleccionarSearch(filSearch);
          }
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSearch.name), 1
        /* TEXT */
        )], 8
        /* PROPS */
        , _hoisted_17);
      }), 128
      /* KEYED_FRAGMENT */
      ))])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [$data.showProduct ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
        key: 0
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.producto, function (product, index) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
          "class": "products",
          key: product
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", _hoisted_19, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(product.names), 1
        /* TEXT */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_20, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(product.price), 1
        /* TEXT */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", _hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(product.productResult), 1
        /* TEXT */
        ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
          "class": "products__sign",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return product.signSelect = $event;
          },
          onChange: function onChange($event) {
            return $options.cambio($event, index);
          }
        }, _hoisted_26, 40
        /* PROPS, HYDRATE_EVENTS */
        , _hoisted_22), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, product.signSelect]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          type: "text",
          placeholder: "cantidad",
          "class": "products__quantity",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return product.productQuantity = $event;
          },
          onKeyup: function onKeyup($event) {
            return $options.cambio($event, index);
          }
        }, null, 40
        /* PROPS, HYDRATE_EVENTS */
        , _hoisted_27), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, product.productQuantity]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
          "class": "product__delete",
          onClick: function onClick($event) {
            return $options.DeleteProduct(index);
          }
        }, _hoisted_30, 8
        /* PROPS */
        , _hoisted_28)]);
      }), 128
      /* KEYED_FRAGMENT */
      )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": "form__element dashed",
        onClick: _cache[12] || (_cache[12] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
          return _ctx.$emit('selection');
        }, ["prevent"]))
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "submit",
        value: "Guardar",
        "class": "form__guardar",
        onClick: _cache[11] || (_cache[11] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
          return _ctx.crearFamilia && _ctx.crearFamilia.apply(_ctx, arguments);
        }, ["prevent"]))
      })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
        "class": "modal__cerrar",
        onClick: _cache[13] || (_cache[13] = function () {
          return $options.showModal && $options.showModal.apply($options, arguments);
        })
      })])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)];
    }),
    _: 1
    /* STABLE */

  }), _hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "boton",
    onClick: _cache[14] || (_cache[14] = function () {
      return $options.showModal && $options.showModal.apply($options, arguments);
    })
  }, _hoisted_34), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_35, [_hoisted_36, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", _hoisted_37, [_hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $data.textoBusqueda = $event;
    }),
    onKeyup: _cache[16] || (_cache[16] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withKeys)(function () {
      return $options.filtrar && $options.filtrar.apply($options, arguments);
    }, ["enter"])),
    "class": "inputContent",
    placeholder: "Busque por ciudad"
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.textoBusqueda]]), _hoisted_40])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $data.textoBusquedaDate = $event;
    }),
    onKeyup: _cache[18] || (_cache[18] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withKeys)(function () {
      return $options.filtrar && $options.filtrar.apply($options, arguments);
    }, ["enter"])),
    "class": "inputContent",
    placeholder: "Busque por fecha"
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.textoBusquedaDate]]), _hoisted_42])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $data.textoBusquedaUser = $event;
    }),
    onKeyup: _cache[20] || (_cache[20] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withKeys)(function () {
      return $options.filtrar && $options.filtrar.apply($options, arguments);
    }, ["enter"])),
    "class": "inputContent",
    placeholder: "Busque por nombre"
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.textoBusquedaUser]]), _hoisted_44])])]), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.elementoFiltrado, function (fill) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: fill,
      "class": "tr",
      onClick: function onClick($event) {
        return _ctx.seleccionar(fill);
      }
    }, [_hoisted_46, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fill.local), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fill.date), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(fill.user), 1
    /* TEXT */
    )], 8
    /* PROPS */
    , _hoisted_45);
  }), 128
  /* KEYED_FRAGMENT */
  ))])])])])], 64
  /* STABLE_FRAGMENT */
  );
}

/***/ }),

/***/ "./resources/js/api/BaseUrl.js":
/*!*************************************!*\
  !*** ./resources/js/api/BaseUrl.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);

var baseUrl = axios__WEBPACK_IMPORTED_MODULE_0___default().create({
  baseURL: 'http://computo.test/'
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (baseUrl);

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.body[data-v-e358b98a] {\r\n  height: 100vh;\r\n  width: 100%;\r\n  background-color: #EA4961;\r\n  display: flex;\r\n  align-items: center;\r\n  justify-content: center;\n}\n.loader[data-v-e358b98a] {\r\n  position: relative;\r\n  width: 75px;\r\n  height: 100px;\n}\n.loader__bar[data-v-e358b98a] {\r\n  position: absolute;\r\n  bottom: 0;\r\n  width: 10px;\r\n  height: 50%;\r\n  background: #fff;\r\n  transform-origin: center bottom;\r\n  box-shadow: 1px 1px 0 rgba(0, 0, 0, 0.2);\n}\n.loader__bar[data-v-e358b98a]:nth-child(1) {\r\n  left: 0px;\r\n  transform: scale(1, 0.2);\r\n  -webkit-animation: barUp1-e358b98a 4s infinite;\r\n          animation: barUp1-e358b98a 4s infinite;\n}\n.loader__bar[data-v-e358b98a]:nth-child(2) {\r\n  left: 15px;\r\n  transform: scale(1, 0.4);\r\n  -webkit-animation: barUp2-e358b98a 4s infinite;\r\n          animation: barUp2-e358b98a 4s infinite;\n}\n.loader__bar[data-v-e358b98a]:nth-child(3) {\r\n  left: 30px;\r\n  transform: scale(1, 0.6);\r\n  -webkit-animation: barUp3-e358b98a 4s infinite;\r\n          animation: barUp3-e358b98a 4s infinite;\n}\n.loader__bar[data-v-e358b98a]:nth-child(4) {\r\n  left: 45px;\r\n  transform: scale(1, 0.8);\r\n  -webkit-animation: barUp4-e358b98a 4s infinite;\r\n          animation: barUp4-e358b98a 4s infinite;\n}\n.loader__bar[data-v-e358b98a]:nth-child(5) {\r\n  left: 60px;\r\n  transform: scale(1, 1);\r\n  -webkit-animation: barUp5-e358b98a 4s infinite;\r\n          animation: barUp5-e358b98a 4s infinite;\n}\n.loader__ball[data-v-e358b98a] {\r\n  position: absolute;\r\n  bottom: 10px;\r\n  left: 0;\r\n  width: 10px;\r\n  height: 10px;\r\n  background: #fff;\r\n  border-radius: 50%;\r\n  -webkit-animation: ball-e358b98a 4s infinite;\r\n          animation: ball-e358b98a 4s infinite;\n}\n@-webkit-keyframes ball-e358b98a {\n0% {\r\n    transform: translate(0, 0);\n}\n5% {\r\n    transform: translate(8px, -14px);\n}\n10% {\r\n    transform: translate(15px, -10px);\n}\n17% {\r\n    transform: translate(23px, -24px);\n}\n20% {\r\n    transform: translate(30px, -20px);\n}\n27% {\r\n    transform: translate(38px, -34px);\n}\n30% {\r\n    transform: translate(45px, -30px);\n}\n37% {\r\n    transform: translate(53px, -44px);\n}\n40% {\r\n    transform: translate(60px, -40px);\n}\n50% {\r\n    transform: translate(60px, 0);\n}\n57% {\r\n    transform: translate(53px, -14px);\n}\n60% {\r\n    transform: translate(45px, -10px);\n}\n67% {\r\n    transform: translate(37px, -24px);\n}\n70% {\r\n    transform: translate(30px, -20px);\n}\n77% {\r\n    transform: translate(22px, -34px);\n}\n80% {\r\n    transform: translate(15px, -30px);\n}\n87% {\r\n    transform: translate(7px, -44px);\n}\n90% {\r\n    transform: translate(0, -40px);\n}\n100% {\r\n    transform: translate(0, 0);\n}\n}\n@keyframes ball-e358b98a {\n0% {\r\n    transform: translate(0, 0);\n}\n5% {\r\n    transform: translate(8px, -14px);\n}\n10% {\r\n    transform: translate(15px, -10px);\n}\n17% {\r\n    transform: translate(23px, -24px);\n}\n20% {\r\n    transform: translate(30px, -20px);\n}\n27% {\r\n    transform: translate(38px, -34px);\n}\n30% {\r\n    transform: translate(45px, -30px);\n}\n37% {\r\n    transform: translate(53px, -44px);\n}\n40% {\r\n    transform: translate(60px, -40px);\n}\n50% {\r\n    transform: translate(60px, 0);\n}\n57% {\r\n    transform: translate(53px, -14px);\n}\n60% {\r\n    transform: translate(45px, -10px);\n}\n67% {\r\n    transform: translate(37px, -24px);\n}\n70% {\r\n    transform: translate(30px, -20px);\n}\n77% {\r\n    transform: translate(22px, -34px);\n}\n80% {\r\n    transform: translate(15px, -30px);\n}\n87% {\r\n    transform: translate(7px, -44px);\n}\n90% {\r\n    transform: translate(0, -40px);\n}\n100% {\r\n    transform: translate(0, 0);\n}\n}\n@-webkit-keyframes barUp1-e358b98a {\n0% {\r\n    transform: scale(1, 0.2);\n}\n40% {\r\n    transform: scale(1, 0.2);\n}\n50% {\r\n    transform: scale(1, 1);\n}\n90% {\r\n    transform: scale(1, 1);\n}\n100% {\r\n    transform: scale(1, 0.2);\n}\n}\n@keyframes barUp1-e358b98a {\n0% {\r\n    transform: scale(1, 0.2);\n}\n40% {\r\n    transform: scale(1, 0.2);\n}\n50% {\r\n    transform: scale(1, 1);\n}\n90% {\r\n    transform: scale(1, 1);\n}\n100% {\r\n    transform: scale(1, 0.2);\n}\n}\n@-webkit-keyframes barUp2-e358b98a {\n0% {\r\n    transform: scale(1, 0.4);\n}\n40% {\r\n    transform: scale(1, 0.4);\n}\n50% {\r\n    transform: scale(1, 0.8);\n}\n90% {\r\n    transform: scale(1, 0.8);\n}\n100% {\r\n    transform: scale(1, 0.4);\n}\n}\n@keyframes barUp2-e358b98a {\n0% {\r\n    transform: scale(1, 0.4);\n}\n40% {\r\n    transform: scale(1, 0.4);\n}\n50% {\r\n    transform: scale(1, 0.8);\n}\n90% {\r\n    transform: scale(1, 0.8);\n}\n100% {\r\n    transform: scale(1, 0.4);\n}\n}\n@-webkit-keyframes barUp3-e358b98a {\n0% {\r\n    transform: scale(1, 0.6);\n}\n100% {\r\n    transform: scale(1, 0.6);\n}\n}\n@keyframes barUp3-e358b98a {\n0% {\r\n    transform: scale(1, 0.6);\n}\n100% {\r\n    transform: scale(1, 0.6);\n}\n}\n@-webkit-keyframes barUp4-e358b98a {\n0% {\r\n    transform: scale(1, 0.8);\n}\n40% {\r\n    transform: scale(1, 0.8);\n}\n50% {\r\n    transform: scale(1, 0.4);\n}\n90% {\r\n    transform: scale(1, 0.4);\n}\n100% {\r\n    transform: scale(1, 0.8);\n}\n}\n@keyframes barUp4-e358b98a {\n0% {\r\n    transform: scale(1, 0.8);\n}\n40% {\r\n    transform: scale(1, 0.8);\n}\n50% {\r\n    transform: scale(1, 0.4);\n}\n90% {\r\n    transform: scale(1, 0.4);\n}\n100% {\r\n    transform: scale(1, 0.8);\n}\n}\n@-webkit-keyframes barUp5-e358b98a {\n0% {\r\n    transform: scale(1, 1);\n}\n40% {\r\n    transform: scale(1, 1);\n}\n50% {\r\n    transform: scale(1, 0.2);\n}\n90% {\r\n    transform: scale(1, 0.2);\n}\n100% {\r\n    transform: scale(1, 1);\n}\n}\n@keyframes barUp5-e358b98a {\n0% {\r\n    transform: scale(1, 1);\n}\n40% {\r\n    transform: scale(1, 1);\n}\n50% {\r\n    transform: scale(1, 0.2);\n}\n90% {\r\n    transform: scale(1, 0.2);\n}\n100% {\r\n    transform: scale(1, 1);\n}\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.pagina[data-v-67622794] {\r\n  width: 95%;\r\n  margin-top: 50px;\r\n  margin-left: auto;\r\n  margin-right: auto;\r\n  background-color: rgb(255, 255, 255);\r\n  margin-bottom: 50px;\r\n  padding-top: 15px;\r\n  box-shadow: rgba(50, 50, 93, 0.25) 0px 3px 8px -2px,\r\n    rgba(0, 0, 0, 0.3) 0px 3px 8px -3px;\r\n  border-radius: 5px;\n}\n.pagina h1[data-v-67622794] {\r\n  font-size: 1.4rem;\r\n  border-bottom: 1px solid rgb(222, 34, 69);\r\n  color: rgb(172, 173, 182);\r\n  font-weight: bold;\r\n  transform: translateY(-10px);\r\n  margin-bottom: 25px;\r\n  width: 94%;\r\n  margin-left: auto;\r\n  margin-right: auto;\r\n  padding: 10px 0;\n}\ntable[data-v-67622794] {\r\n  width: 94%;\r\n  border-collapse: separate;\r\n  border-spacing: 0px 2px;\r\n  margin-left: auto;\r\n  margin-right: auto;\n}\nthead tr[data-v-67622794] {\r\n  color: rgb(172, 173, 182);\n}\ntbody tr[data-v-67622794] {\r\n  background-color: rgb(255, 255, 255);\r\n  transition: all 300ms;\r\n  color: rgb(65, 65, 65);\n}\ntd[data-v-67622794] {\r\n  padding: 10px 0 10px 10px;\r\n  border-bottom: 1px solid rgb(230, 230, 230);\n}\n.firstTr td[data-v-67622794] {\r\n  padding: 7px 0 7px 10px;\n}\nthead td[data-v-67622794] {\r\n  border-bottom: 1px solid rgb(173, 173, 173);\n}\n.newTable .tr[data-v-67622794]:hover {\r\n  background-color: rgb(214, 75, 100) !important;\r\n  color: #fff;\n}\nform[data-v-67622794] {\r\n  width: 100%;\n}\n.td__content[data-v-67622794] {\r\n  display: flex;\r\n  width: 100%;\n}\n.inputContent[data-v-67622794] {\r\n  border: none;\r\n  width: 80%;\r\n  outline: 1px solid rgb(212, 209, 209);\r\n  color: rgb(151, 149, 149);\r\n  font-size: 1.1rem;\r\n  font-weight: lighter;\r\n  padding-left: 5px;\n}\n.inputContent[data-v-67622794]:focus {\r\n  outline-color: rgb(214, 75, 100);\n}\n.i[data-v-67622794] {\r\n  display: flex;\r\n  justify-content: center;\r\n  align-items: center;\r\n  width: 15%;\r\n  outline: 1px solid rgb(197, 194, 194);\r\n  background-color: rgb(197, 194, 194);\r\n  cursor: pointer;\r\n  transition: all 300ms;\n}\n.i i[data-v-67622794] {\r\n  width: 50%;\r\n  margin-left: auto;\r\n  margin-right: auto;\r\n  color: #fff;\n}\n.inputContent:focus ~ .i[data-v-67622794] {\r\n  outline-color: rgb(214, 75, 100);\r\n  background-color: rgb(214, 75, 100);\n}\n.form__contenedor[data-v-67622794] {\r\n  width: 100%;\r\n  height: 75%;\r\n  display: flex;\r\n  flex-direction: column;\r\n  justify-content: space-around;\n}\n.form[data-v-67622794] {\r\n  padding: 20px;\n}\n.form__element[data-v-67622794] {\r\n  width: 100%;\r\n  display: flex;\r\n  flex-direction: column;\n}\n.form__element label[data-v-67622794] {\r\n  color: rgb(172, 173, 182);\n}\n.form__element select[data-v-67622794],\r\n.form__element textarea[data-v-67622794] {\r\n  border-color: rgb(172, 173, 182);\r\n  outline-color: rgb(172, 173, 182);\r\n  color: rgb(172, 173, 182);\n}\n.form__element option[data-v-67622794]:hover {\r\n  background-color: rgb(222, 34, 69);\n}\n.form__element select[data-v-67622794]:focus,\r\n.form__element textarea[data-v-67622794]:focus {\r\n  outline-color: rgb(222, 34, 69);\r\n  border-color: rgb(222, 34, 69);\n}\n.form__element .label--red[data-v-67622794] {\r\n  color: rgb(222, 34, 69);\n}\n.dashed[data-v-67622794] {\r\n  width: 100%;\r\n  padding-top: 20px;\r\n  border-top: 1px dashed rgb(222, 34, 69);\n}\n.form__element .form__guardar[data-v-67622794] {\r\n  border: none;\r\n  border-radius: 5px;\r\n  width: 25%;\r\n  padding: 10px 15px;\r\n  color: #fff;\r\n  font-weight: bold;\r\n  box-shadow: 0 0 40px 40px rgb(222, 34, 69) inset, 0 0 0 0 rgb(222, 34, 69);\r\n  transition: all 350ms ease-in-out;\n}\n.form__guardar[data-v-67622794]:hover {\r\n  color: rgb(222, 34, 69);\r\n  box-shadow: 0 0 3px 0 rgb(222, 34, 69) inset, 0 0 3px 1px rgb(222, 34, 69);\n}\n.footer[data-v-67622794] {\r\n  display: flex;\r\n  justify-content: space-between;\n}\n.buttons[data-v-67622794] {\r\n  display: inline-block;\r\n  text-align: end;\r\n  border: 1px solid black;\n}\n.button[data-v-67622794] {\r\n  padding: 10px 15px;\r\n  border: 1px solid black;\r\n  cursor: pointer;\n}\n.button[data-v-67622794]:hover {\r\n  background-color: rgb(222, 34, 69);\n}\n.boton[data-v-67622794] {\r\n  display: flex;\r\n  justify-content: space-between;\r\n  align-items: center;\r\n  width: 145px;\r\n  height: 50px;\r\n  border: none;\r\n  background-color: transparent;\r\n  transition: all 600ms;\r\n  margin-left: 27px;\n}\n.boton:hover p[data-v-67622794],\r\n.boton:hover .boton__img[data-v-67622794] {\r\n  box-shadow: 0 0 5px 0 rgb(222, 34, 69);\n}\n.boton p[data-v-67622794] {\r\n  border: 2px solid rgb(222, 34, 69);\r\n  padding: 5px 20px;\r\n  margin: 0;\r\n  border-top-left-radius: 15px;\r\n  font-size: bold;\r\n  background-color: #fff;\r\n  color: rgb(222, 34, 69);\n}\n.boton__img[data-v-67622794] {\r\n  width: 30%;\r\n  border: 2px solid rgb(222, 34, 69);\r\n  border-top-right-radius: 15px;\r\n  border-bottom-right-radius: 15px;\r\n  padding: 10px;\r\n  background-color: #fff;\n}\n.boton__img i[data-v-67622794] {\r\n  display: block;\r\n  width: 30%;\r\n  color: rgb(222, 34, 69);\n}\n.modal-overlay[data-v-67622794] {\r\n  height: 100%;\r\n  position: absolute;\r\n  top: 0;\r\n  left: 0;\r\n  bottom: 0;\r\n  right: 0;\r\n  z-index: 100;\r\n  background-color: rgba(0, 0, 0, 0.6);\r\n  -webkit-backdrop-filter: blur(3px);\r\n          backdrop-filter: blur(3px);\n}\n.modal[data-v-67622794] {\r\n  display: block;\r\n  overflow-y: scroll;\r\n  width: 40vw;\r\n  height: 80vh;\r\n  position: fixed;\r\n  top: 10%;\r\n  left: 30%;\r\n  background-color: #fff;\r\n  border-radius: 5px;\r\n  box-shadow: rgba(255, 255, 255, 0.5) 0px 30px 50px -20px,\r\n    rgba(255, 255, 255, 0.5) 0px 10px 30px -20px,\r\n    rgba(255, 255, 255, 0.5) 0px -2px 6px 0px inset;\r\n  z-index: 20000;\n}\n.modal__cerrar[data-v-67622794] {\r\n  width: 40px;\r\n  height: 40px;\r\n  position: absolute;\r\n  top: 0;\r\n  right: 0;\r\n  padding: 5px;\r\n  border-radius: 50%;\r\n  border: none;\r\n  display: flex;\r\n  justify-content: center;\r\n  align-items: center;\r\n  background-color: rgb(222, 34, 69);\n}\n.modal__cerrar img[data-v-67622794] {\r\n  display: block;\r\n  width: 50%;\n}\n.subtitle[data-v-67622794] {\r\n  width: 100%;\r\n  border-bottom: 1px solid rgba(222, 34, 68, 0.3);\r\n  padding: 20px;\n}\n.subtitle h2[data-v-67622794] {\r\n  font-size: 1.4rem;\r\n  margin: 0;\r\n  color: rgb(222, 34, 69);\n}\n.form h3[data-v-67622794] {\r\n  font-size: 1.4rem;\r\n  margin-bottom: 20px;\r\n  color: rgb(222, 34, 69);\r\n  padding-bottom: 10px;\r\n  border-bottom: 1px dashed rgba(222, 34, 68, 0.3);\n}\n.container input[data-v-67622794],\r\n.container .option__relative[data-v-67622794] {\r\n  width: 100%;\n}\n.option__relative[data-v-67622794] {\r\n  position: relative;\r\n  width: 100%;\n}\n.option__contenedor[data-v-67622794] {\r\n  position: absolute;\r\n  bottom: 0;\r\n  max-height: 250px;\r\n  width: 100%;\r\n  overflow-y: scroll;\r\n  background-color: #fff;\n}\n.option__contenedor p[data-v-67622794]:hover {\r\n  background-color: rgb(222, 34, 69);\n}\n.flex[data-v-67622794] {\r\n  width: 100%;\r\n  display: flex;\r\n  flex-direction: row;\r\n  justify-content: center;\r\n  margin-bottom: 15px;\n}\n.flex select[data-v-67622794],\r\n.flex textarea[data-v-67622794],\r\n.flex .container[data-v-67622794] {\r\n  width: 75%;\r\n  margin-left: 30px;\n}\n.flex label[data-v-67622794] {\r\n  flex: 1;\r\n  text-align: end;\n}\n.form__product[data-v-67622794] {\r\n  background-color: rgba(44, 187, 63, 0.65);\n}\n.products[data-v-67622794] {\r\n  display: flex;\r\n  justify-content: space-around;\r\n  align-items: center;\r\n  height: 60px;\n}\n.products .products__name[data-v-67622794] {\r\n  border: none;\r\n  background-color: rgb(209, 208, 208);\r\n  width: 120px;\r\n  height: 30px;\r\n  margin: 0;\r\n  font-size: 0.8rem;\n}\n.products .products__price[data-v-67622794] {\r\n  color: rgb(41, 131, 235);\r\n  height: 30px;\r\n  margin: 0;\n}\n.products .products__result[data-v-67622794] {\r\n  width: 30px;\r\n  height: 30px;\r\n  color: red;\r\n  margin: 0;\r\n  border: 1px solid black;\n}\n.products .products__sign[data-v-67622794] {\r\n  width: 50px;\r\n  height: 30px;\r\n  margin: 0;\n}\n.products__quantity[data-v-67622794] {\r\n  width: 100px;\r\n  height: 30px;\r\n  margin: 0;\n}\n.product__delete[data-v-67622794] {\r\n  display: flex;\r\n  justify-content: center;\r\n  align-items: center;\r\n  width: 30px;\r\n  height: 30px;\r\n  background-color: rgb(230, 89, 89);\r\n  cursor: pointer;\r\n  transition: all 300ms;\n}\n.product__delete[data-v-67622794]:hover {\r\n  background-color: #fff;\n}\n.product__delete i[data-v-67622794] {\r\n  color: #fff;\r\n  transition: all 300ms;\n}\n.product__delete i[data-v-67622794]:hover {\r\n  color: red;\n}\n.overlay-leave-active[data-v-67622794] {\r\n  transition: all;\r\n  transition-delay: 500ms;\n}\n.fade-leave-active[data-v-67622794],\r\n.fade-enter-active[data-v-67622794] {\r\n  transition: all 0.6s ease;\n}\n.overlay-leave-to[data-v-67622794] {\r\n  opacity: 0;\n}\n.fade-enter-from[data-v-67622794],\r\n.fade-leave-to[data-v-67622794] {\r\n  /* transform: scale(0); */\r\n  transform: translateY(-60px);\r\n  opacity: 0;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
/***/ ((module) => {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
// eslint-disable-next-line func-names
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = cssWithMappingToString(item);

      if (item[2]) {
        return "@media ".concat(item[2], " {").concat(content, "}");
      }

      return content;
    }).join("");
  }; // import a list of modules into the list
  // eslint-disable-next-line func-names


  list.i = function (modules, mediaQuery, dedupe) {
    if (typeof modules === "string") {
      // eslint-disable-next-line no-param-reassign
      modules = [[null, modules, ""]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var i = 0; i < this.length; i++) {
        // eslint-disable-next-line prefer-destructuring
        var id = this[i][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _i = 0; _i < modules.length; _i++) {
      var item = [].concat(modules[_i]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        // eslint-disable-next-line no-continue
        continue;
      }

      if (mediaQuery) {
        if (!item[2]) {
          item[2] = mediaQuery;
        } else {
          item[2] = "".concat(mediaQuery, " and ").concat(item[2]);
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/***/ ((module) => {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function define(obj, key, value) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
    return obj[key];
  }
  try {
    // IE 8 has a broken Object.defineProperty that only works on DOM objects.
    define({}, "");
  } catch (err) {
    define = function(obj, key, value) {
      return obj[key] = value;
    };
  }

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  define(IteratorPrototype, iteratorSymbol, function () {
    return this;
  });

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = GeneratorFunctionPrototype;
  define(Gp, "constructor", GeneratorFunctionPrototype);
  define(GeneratorFunctionPrototype, "constructor", GeneratorFunction);
  GeneratorFunction.displayName = define(
    GeneratorFunctionPrototype,
    toStringTagSymbol,
    "GeneratorFunction"
  );

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      define(prototype, method, function(arg) {
        return this._invoke(method, arg);
      });
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      define(genFun, toStringTagSymbol, "GeneratorFunction");
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return PromiseImpl.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return PromiseImpl.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new PromiseImpl(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
    return this;
  });
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    if (PromiseImpl === void 0) PromiseImpl = Promise;

    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList),
      PromiseImpl
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  define(Gp, toStringTagSymbol, "Generator");

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  define(Gp, iteratorSymbol, function() {
    return this;
  });

  define(Gp, "toString", function() {
    return "[object Generator]";
  });

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
   true ? module.exports : 0
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, in modern engines
  // we can explicitly access globalThis. In older engines we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_style_index_0_id_e358b98a_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_style_index_0_id_e358b98a_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_style_index_0_id_e358b98a_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_style_index_0_id_67622794_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_style_index_0_id_67622794_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_style_index_0_id_67622794_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var isOldIE = function isOldIE() {
  var memo;
  return function memorize() {
    if (typeof memo === 'undefined') {
      // Test for IE <= 9 as proposed by Browserhacks
      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
      // Tests for existence of standard globals is to allow style-loader
      // to operate correctly into non-standard environments
      // @see https://github.com/webpack-contrib/style-loader/issues/177
      memo = Boolean(window && document && document.all && !window.atob);
    }

    return memo;
  };
}();

var getTarget = function getTarget() {
  var memo = {};
  return function memorize(target) {
    if (typeof memo[target] === 'undefined') {
      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
        try {
          // This will throw an exception if access to iframe is blocked
          // due to cross-origin restrictions
          styleTarget = styleTarget.contentDocument.head;
        } catch (e) {
          // istanbul ignore next
          styleTarget = null;
        }
      }

      memo[target] = styleTarget;
    }

    return memo[target];
  };
}();

var stylesInDom = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDom.length; i++) {
    if (stylesInDom[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var index = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3]
    };

    if (index !== -1) {
      stylesInDom[index].references++;
      stylesInDom[index].updater(obj);
    } else {
      stylesInDom.push({
        identifier: identifier,
        updater: addStyle(obj, options),
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function insertStyleElement(options) {
  var style = document.createElement('style');
  var attributes = options.attributes || {};

  if (typeof attributes.nonce === 'undefined') {
    var nonce =  true ? __webpack_require__.nc : 0;

    if (nonce) {
      attributes.nonce = nonce;
    }
  }

  Object.keys(attributes).forEach(function (key) {
    style.setAttribute(key, attributes[key]);
  });

  if (typeof options.insert === 'function') {
    options.insert(style);
  } else {
    var target = getTarget(options.insert || 'head');

    if (!target) {
      throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
    }

    target.appendChild(style);
  }

  return style;
}

function removeStyleElement(style) {
  // istanbul ignore if
  if (style.parentNode === null) {
    return false;
  }

  style.parentNode.removeChild(style);
}
/* istanbul ignore next  */


var replaceText = function replaceText() {
  var textStore = [];
  return function replace(index, replacement) {
    textStore[index] = replacement;
    return textStore.filter(Boolean).join('\n');
  };
}();

function applyToSingletonTag(style, index, remove, obj) {
  var css = remove ? '' : obj.media ? "@media ".concat(obj.media, " {").concat(obj.css, "}") : obj.css; // For old IE

  /* istanbul ignore if  */

  if (style.styleSheet) {
    style.styleSheet.cssText = replaceText(index, css);
  } else {
    var cssNode = document.createTextNode(css);
    var childNodes = style.childNodes;

    if (childNodes[index]) {
      style.removeChild(childNodes[index]);
    }

    if (childNodes.length) {
      style.insertBefore(cssNode, childNodes[index]);
    } else {
      style.appendChild(cssNode);
    }
  }
}

function applyToTag(style, options, obj) {
  var css = obj.css;
  var media = obj.media;
  var sourceMap = obj.sourceMap;

  if (media) {
    style.setAttribute('media', media);
  } else {
    style.removeAttribute('media');
  }

  if (sourceMap && typeof btoa !== 'undefined') {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    while (style.firstChild) {
      style.removeChild(style.firstChild);
    }

    style.appendChild(document.createTextNode(css));
  }
}

var singleton = null;
var singletonCounter = 0;

function addStyle(obj, options) {
  var style;
  var update;
  var remove;

  if (options.singleton) {
    var styleIndex = singletonCounter++;
    style = singleton || (singleton = insertStyleElement(options));
    update = applyToSingletonTag.bind(null, style, styleIndex, false);
    remove = applyToSingletonTag.bind(null, style, styleIndex, true);
  } else {
    style = insertStyleElement(options);
    update = applyToTag.bind(null, style, options);

    remove = function remove() {
      removeStyleElement(style);
    };
  }

  update(obj);
  return function updateStyle(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
        return;
      }

      update(obj = newObj);
    } else {
      remove();
    }
  };
}

module.exports = function (list, options) {
  options = options || {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
  // tags it will allow on a page

  if (!options.singleton && typeof options.singleton !== 'boolean') {
    options.singleton = isOldIE();
  }

  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    if (Object.prototype.toString.call(newList) !== '[object Array]') {
      return;
    }

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDom[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDom[_index].references === 0) {
        stylesInDom[_index].updater();

        stylesInDom.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/components/Loader.vue":
/*!*********************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/components/Loader.vue ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Loader_vue_vue_type_template_id_e358b98a_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Loader.vue?vue&type=template&id=e358b98a&scoped=true */ "./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=template&id=e358b98a&scoped=true");
/* harmony import */ var _Loader_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Loader.vue?vue&type=script&lang=js */ "./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=script&lang=js");
/* harmony import */ var _Loader_vue_vue_type_style_index_0_id_e358b98a_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css */ "./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css");
/* harmony import */ var C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_Loader_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Loader_vue_vue_type_template_id_e358b98a_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-e358b98a"],['__file',"resources/js/modules/inventory/modification-stock/components/Loader.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/pages/layout.vue":
/*!****************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/pages/layout.vue ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _layout_vue_vue_type_template_id_67622794_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./layout.vue?vue&type=template&id=67622794&scoped=true */ "./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=template&id=67622794&scoped=true");
/* harmony import */ var _layout_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./layout.vue?vue&type=script&lang=js */ "./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=script&lang=js");
/* harmony import */ var _layout_vue_vue_type_style_index_0_id_67622794_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css */ "./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css");
/* harmony import */ var C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_layout_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_layout_vue_vue_type_template_id_67622794_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-67622794"],['__file',"resources/js/modules/inventory/modification-stock/pages/layout.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=script&lang=js":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=script&lang=js ***!
  \*********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Loader.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=script&lang=js":
/*!****************************************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=script&lang=js ***!
  \****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./layout.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=template&id=e358b98a&scoped=true":
/*!***************************************************************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=template&id=e358b98a&scoped=true ***!
  \***************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_template_id_e358b98a_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_template_id_e358b98a_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Loader.vue?vue&type=template&id=e358b98a&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=template&id=e358b98a&scoped=true");


/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=template&id=67622794&scoped=true":
/*!**********************************************************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=template&id=67622794&scoped=true ***!
  \**********************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_template_id_67622794_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_template_id_67622794_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./layout.vue?vue&type=template&id=67622794&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=template&id=67622794&scoped=true");


/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css":
/*!*****************************************************************************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css ***!
  \*****************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Loader_vue_vue_type_style_index_0_id_e358b98a_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/components/Loader.vue?vue&type=style&index=0&id=e358b98a&scoped=true&lang=css");


/***/ }),

/***/ "./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css":
/*!************************************************************************************************************************************!*\
  !*** ./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css ***!
  \************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_layout_vue_vue_type_style_index_0_id_67622794_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/inventory/modification-stock/pages/layout.vue?vue&type=style&index=0&id=67622794&scoped=true&lang=css");


/***/ })

}]);