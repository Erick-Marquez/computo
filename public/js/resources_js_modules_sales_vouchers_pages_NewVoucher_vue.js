(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_modules_sales_vouchers_pages_NewVoucher_vue"],{

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=script&lang=js":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=script&lang=js ***!
  \************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../api/BaseUrl */ "./resources/js/api/BaseUrl.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      toggle: false,
      loading: false,
      max_length: 8,
      assemblyName: null,
      searching: [],
      assembliesFound: []
    };
  },
  emits: ["setAssemblie"],
  props: {
    products: Object
  },
  methods: {
    getAssemblies: function getAssemblies() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("/api/assemblies?included=products&filter[name]=".concat(_this.assemblyName, "&perPage=10")).then(function (response) {
                  _this.assembliesFound = response.data.data;
                })["catch"](function (error) {
                  console.log(error.response);
                });

              case 2:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    // metodo para buscar Ensamblajes
    searchAssembly: function searchAssembly() {
      clearTimeout(this.searching);

      if (this.assemblyName !== "") {
        clearTimeout(this.searching);
        this.searching = setTimeout(this.getAssemblies, 300);
      }
    },
    setProducts: function setProducts(products) {
      this.assembliesFound = [];
      this.assemblyName = null;
      this.$emit("setAssemblie", products);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=script&lang=js":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=script&lang=js ***!
  \***********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../api/BaseUrl */ "./resources/js/api/BaseUrl.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    BaseUrl: _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  data: function data() {
    return {
      toggle: false,
      customers: [],
      type_documents: [],
      searching: {},
      ubigees: [],
      max_length: 8,
      loading: false,
      responseApi: null
    };
  },
  props: {
    customer: Object,
    voucherType: Number,
    errors: Array
  },
  created: function created() {
    this.getTypeDocuments();
    this.getUbigees();
    this.customer.identification_document_id = 6;
  },
  mounted: function mounted() {
    $("#select4").select2();
    $(".select2-selection.select2-selection--single").addClass("rounded-pill");
  },
  methods: {
    getTypeDocuments: function getTypeDocuments() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("/api/tipos-documentos").then(function (response) {
                  _this.type_documents = response.data;
                })["catch"](function (error) {
                  console.log(error.response);
                });

              case 2:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    getDataApi: function getDataApi() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _this2.loading = true;
                _context2.next = 3;
                return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("/api/data-document/".concat(_this2.customer.identification_document_id, "/").concat(_this2.customer.document)).then(function (response) {
                  console.log(response.data);
                  _this2.customer.phone = "";
                  _this2.customer.address = "";
                  _this2.customer.id = null;
                  _this2.customer.name = response.data.name;
                  _this2.customer.address = response.data.address;
                  _this2.customer.phone = response.data.phone;
                  _this2.customer.ubigee_id = null; //this.customer.ubigee_id = response.data.ubigee_id;

                  //this.customer.ubigee_id = response.data.ubigee_id;
                  _this2.responseApi = "HABIDO";
                  console.log(_this2.responseApi);
                  _this2.selectUbigee;
                })["catch"](function (error) {
                  console.log(error.response);
                  _this2.responseApi = "NO HABIDO";
                })["finally"](function () {
                  _this2.loading = false;
                });

              case 3:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    getUbigees: function getUbigees() {
      var _this3 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee3() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                _context3.next = 2;
                return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("/api/ubigees").then(function (response) {
                  _this3.ubigees = response.data.data;
                })["catch"](function (error) {
                  console.log(error.response);
                });

              case 2:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3);
      }))();
    },
    getcustomers: function getcustomers() {
      var _this4 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee4() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                _context4.next = 2;
                return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("/api/clientes?filter[document]=".concat(_this4.customer.document, "\n                            &filter[identification_document_id]=").concat(_this4.customer.identification_document_id, "\n                            &perPage=10")).then(function (response) {
                  _this4.customers = response.data.data;
                })["catch"](function (error) {
                  console.log(error.response.data);
                });

              case 2:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4);
      }))();
    },
    setData: function setData(customerFind) {
      this.customer.id = customerFind.id;
      this.customer.document = customerFind.document;
      this.customer.name = customerFind.name;
      this.customer.address = customerFind.address;
      this.customer.phone = customerFind.phone;
      this.customer.ubigee_id = customerFind.ubigee_id;
      this.customers = null;
      this.selectUbigee;
    },
    searchDocument: function searchDocument() {
      clearTimeout(this.searching);
      this.searching = setTimeout(this.getcustomers, 300);
    }
  },
  computed: {
    maxLenghDocument: function maxLenghDocument() {
      return this.customer.identification_document_id == 1 ? 8 : 11;
    },
    showSearchingData: function showSearchingData() {
      return this.customer.identification_document_id == 6 || this.customer.identification_document_id == 1 ? true : false;
    },
    responseApiClass: function responseApiClass() {
      return this.responseApi === "NO HABIDO" ? "text-sm font-weight-light text-danger" : "text-sm font-weight-light text-success";
    },
    selectUbigee: function selectUbigee() {
      $("#select4").val(this.customer.ubigee_id); // Select the option with a value of '1'

      $("#select4").trigger("change"); // Notify any JS components that the value changed
    } // enableSearchDocument() {
    //   return true
    // },

  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../api/BaseUrl */ "./resources/js/api/BaseUrl.js");
/* harmony import */ var _components_SearchCustomers_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/SearchCustomers.vue */ "./resources/js/modules/sales/components/SearchCustomers.vue");
/* harmony import */ var _components_SearchAssemblies_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../components/SearchAssemblies.vue */ "./resources/js/modules/sales/components/SearchAssemblies.vue");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    BaseUrl: _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"],
    SearchCustomers: _components_SearchCustomers_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
    SearchAssemblies: _components_SearchAssemblies_vue__WEBPACK_IMPORTED_MODULE_3__["default"]
  },
  created: function created() {
    var _this = this;

    return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/vouchertypes").then(function (resp) {
                _this.voucherTypes = resp.data.data;
                _this.saleData.voucher.document_type = _this.voucherTypes[0].id;

                _this.loadSeries();
              });

            case 2:
              _context.next = 4;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/identificationdocuments").then(function (resp) {
                _this.identificationDocuments = resp.data.data;
              });

            case 4:
              _context.next = 6;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/series/8").then(function (resp) {
                _this.quotationSeries = resp.data.data;
                _this.quotationSerieSelect = _this.quotationSeries[0].id;
              });

            case 6:
              _context.next = 8;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/series/9").then(function (resp) {
                _this.warrantySeries = resp.data.data;
                _this.saleData.voucher.warranty_serie_id = _this.warrantySeries[0].id;
              });

            case 8:
              _context.next = 10;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/paymenttypes").then(function (resp) {
                _this.paymentTypes = resp.data.data;
                _this.saleData.voucher.payments[0].payment_type_id = _this.paymentTypes[0].id;
              });

            case 10:
              _context.next = 12;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/igvtypes").then(function (resp) {
                _this.igvTypes = resp.data.data;
              });

            case 12:
              _context.next = 14;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/currencyexchange").then(function (resp) {
                _this.currencyExchange = resp.data.data;
              });

            case 14:
              _context.next = 16;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/products").then(function (resp) {
                _this.products = resp.data.data;

                _this.products.forEach(function (product) {
                  product.sale_price = (product.sale_price * _this.currencyExchange.change).toFixed(2);
                  product.referential_sale_price_one = (product.referential_sale_price_one * _this.currencyExchange.change).toFixed(2);
                  product.referential_sale_price_two = (product.referential_sale_price_two * _this.currencyExchange.change).toFixed(2);
                });
              });

            case 16:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }))();
  },
  data: function data() {
    return {
      errors: [],
      searchAssemblies: false,
      warrantySeries: {},
      currencyExchange: {},
      quotationSerieSelect: null,
      quotationSeries: {},
      numberQuotation: null,
      contador: 0,
      currentNumber: "Selecciona una serie",
      productSearch: "",
      productSearchFilter: [],
      productSerieSearchFilter: [],
      voucherTypes: {},
      series: {},
      activateGlobalDiscount: false,
      activateDetailDiscount: false,
      identificationDocuments: {},
      paymentTypes: [],
      igvTypes: [],
      products: [],
      productSeries: [],
      saleData: {
        customer: {
          id: null
        },
        voucher: {
          subtotal: 0,
          discount: 0,
          totalIgv: 0,
          totalExonerated: 0,
          totalUnaffected: 0,
          totalFree: 0,
          totalTaxed: 0,
          total: 0,
          discountItems: 0,
          document_type: 2,
          serie_id: "",
          moneda: "PEN",
          date_issue: "2021-10-17",
          //Año - mes - dia
          date_due: "2021-10-18",
          observation: "",
          received_money: 0,
          change: 0,
          warranty_serie_id: null,
          warranty: false,
          isMultiPayment: false,
          payments: [{
            payment_type_id: null,
            amount: 0
          }]
        },
        detail: []
      }
    };
  },
  mounted: function mounted() {
    var _this2 = this;

    var contain = document.querySelector(".card");
    contain.addEventListener("click", function (e) {
      if (e.target.className != "inputContent") {
        _this2.productSearchFilter = "";
      }
    });
  },
  methods: {
    loadSeries: function loadSeries() {
      var _this3 = this;

      _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/series/".concat(this.saleData.voucher.document_type)).then(function (resp) {
        _this3.series = resp.data.data;
        _this3.saleData.voucher.serie_id = _this3.series[0].id;

        _this3.loadCurrentNumber();
      });
    },
    loadCurrentNumber: function loadCurrentNumber() {
      var _this4 = this;

      var serieBackup = this.series;
      var serieFilter = serieBackup.filter(function (series) {
        return series.id == _this4.saleData.voucher.serie_id;
      });
      this.currentNumber = serieFilter[0].current_number + 1;
    },
    searchProducts: function searchProducts() {
      var produtsBackup = this.products;
      var wordFilter = this.productSearch.toLowerCase();

      if (wordFilter === "") {
        this.productSearchFilter = "";
      } else {
        this.productSearchFilter = produtsBackup.filter(function (products) {
          return products.name.toLowerCase().indexOf(wordFilter) !== -1;
        }).slice(0, 10);
      }
    },
    searchProductSeries: function searchProductSeries(i, j) {
      var produtSeriesBackup = this.productSeries[i];
      var wordFilter = this.saleData.detail[i].series[j].serie.toLowerCase();

      if (wordFilter === "") {
        this.productSerieSearchFilter[i][j] = "";
      } else {
        this.productSerieSearchFilter[i][j] = produtSeriesBackup.filter(function (productSeries) {
          return productSeries.serie.toLowerCase().indexOf(wordFilter) !== -1;
        });

        if (this.productSerieSearchFilter[i][j].length === 0) {
          this.productSerieSearchFilter[i][j] = [{
            serie: "No hay resultados"
          }];
        }
      }
    },
    setAssemblie: function setAssemblie(products) {
      var _this5 = this;

      products.forEach(function (product, index) {
        _this5.setProductAssembly(product, index);
      });
    },
    setProductAssembly: function setProductAssembly(productAssembly, index) {
      this.productSerieSearchFilter.push([]);
      var product = {
        discount: 0,
        subtotal: 0,
        total: 0,
        product_id: productAssembly.id,
        cod: productAssembly.cod,
        affect_icbper: false,
        igv_type_id: productAssembly.igv_type_id,
        description: productAssembly.name,
        brand: productAssembly.brand,
        sale_price: (productAssembly.sale_price * this.currencyExchange.change).toFixed(2),
        quantity: productAssembly.quantity,
        series: []
      };
      var series = {
        id: "",
        serie: ""
      };
      product.series.push(series);
      this.saleData.detail.push(product);
      this.getTotals();
      this.addSeries(index);
      this.getSeries(productAssembly.id); // Alertas para las notificaciones y calcular totales
      //   this.getQuotationDiscount(0);
    },
    priceOne: function priceOne(filSearch) {
      this.productSerieSearchFilter.push([]);
      var product = {
        discount: 0,
        subtotal: 0,
        total: 0,
        product_id: filSearch.id,
        cod: filSearch.cod,
        affect_icbper: false,
        igv_type_id: filSearch.igv_type_id,
        description: filSearch.name,
        brand: filSearch.brand,
        sale_price: filSearch.sale_price,
        quantity: 1,
        series: []
      };
      var series = {
        id: "",
        serie: ""
      };
      product.series.push(series);
      this.saleData.detail.push(product);
      this.productSearch = "";
      this.getTotals();
      this.getSeries(filSearch.id);
    },
    priceTwo: function priceTwo(filSearch) {
      this.productSerieSearchFilter.push([]);
      var product = {
        discount: 0,
        subtotal: 0,
        total: 0,
        product_id: filSearch.id,
        cod: filSearch.cod,
        affect_icbper: false,
        igv_type_id: filSearch.igv_type_id,
        description: filSearch.name,
        brand: filSearch.brand,
        sale_price: filSearch.referential_sale_price_one,
        quantity: 1,
        series: []
      };
      var series = {
        id: "",
        serie: ""
      };
      product.series.push(series);
      this.saleData.detail.push(product);
      this.productSearch = "";
      this.getTotals();
      this.getSeries(filSearch.id);
    },
    priceThree: function priceThree(filSearch) {
      this.productSerieSearchFilter.push([]);
      var product = {
        discount: 0,
        subtotal: 0,
        total: 0,
        product_id: filSearch.id,
        cod: filSearch.cod,
        affect_icbper: false,
        igv_type_id: filSearch.igv_type_id,
        description: filSearch.name,
        brand: filSearch.brand,
        sale_price: filSearch.referential_sale_price_two,
        quantity: 1,
        series: []
      };
      var series = {
        id: "",
        serie: ""
      };
      product.series.push(series);
      this.saleData.detail.push(product);
      this.productSearch = "";
      this.getTotals();
      this.getSeries(filSearch.id);
    },
    selectSerieSearch: function selectSerieSearch(filSerieSearch, i, j) {
      this.saleData.detail[i].series[j].id = filSerieSearch.id;
      this.saleData.detail[i].series[j].serie = filSerieSearch.serie;
      this.productSerieSearchFilter[i][j] = "";
    },
    deleteItem: function deleteItem(index) {
      this.saleData.detail.splice(index, 1);
      this.productSeries.splice(index, 1);
      this.productSerieSearchFilter.splice(index, 1);
      this.getTotals();
    },
    activateOrDesactivateGlobalDiscount: function activateOrDesactivateGlobalDiscount() {
      // recorrer el array detalle en busca de un descuento
      var discount = 0;
      this.saleData.detail.forEach(function (e) {
        discount += e.discount * 1;
      }); // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global

      this.activateGlobalDiscount = discount > 0 ? true : false;
    },
    activateOrDesactivateDetailDiscount: function activateOrDesactivateDetailDiscount() {
      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateDetailDiscount = this.saleData.voucher.discount > 0 ? true : false;
    },
    addSeries: function addSeries(index) {
      var temp = [];

      for (var i = 0; i < this.saleData.detail[index].quantity; i++) {
        var series = {
          id: "",
          serie: ""
        };
        temp.push(series);
      }

      this.saleData.detail[index].series = temp;
    },
    getSeries: function getSeries(id) {
      var _this6 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/products/series/".concat(id)).then(function (resp) {
                  _this6.productSeries.push(resp.data.data);
                });

              case 2:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    getTotals: function getTotals() {
      var _this7 = this;

      this.saleData.voucher.subtotal = 0;
      this.saleData.voucher.totalIgv = 0;
      this.saleData.voucher.totalExonerated = 0;
      this.saleData.voucher.totalUnaffected = 0;
      this.saleData.voucher.totalFree = 0;
      this.saleData.voucher.totalTaxed = 0;
      this.saleData.voucher.total = 0;
      this.saleData.voucher.discountItems = 0; // igv constante

      var igv = 0.18; // TODO: CORREGIR y redondear al final

      this.saleData.detail.forEach(function (e) {
        _this7.saleData.voucher.discountItems += e.discount;

        switch (parseInt(e.igv_type_id)) {
          case 10:
            //Gravado - Operación Onerosa
            // hallar el precio sin igv
            var priceWithoutIgv = e.sale_price / (1 + igv); // hallar el subtotal = (precio sin igv * cantidad) - descuento

            e.subtotal = parseFloat((priceWithoutIgv * e.quantity - e.discount).toFixed(2)); // hallar el total = (subtotal * 1.18)

            e.total = parseFloat((e.subtotal * (1 + igv)).toFixed(2)); // Actualizar totales globales

            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalIgv += parseFloat((e.total - e.subtotal).toFixed(2));
            _this7.saleData.voucher.totalTaxed += e.subtotal;
            _this7.saleData.voucher.total += e.total;
            break;

          case 11:
            //[Gratuita] Gravado – Retiro por premio
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 12:
            //[Gratuita] Gravado – Retiro por donación
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 13:
            //[Gratuita] Gravado – Retiro
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 14:
            //[Gratuita] Gravado – Retiro por publicidad
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 15:
            //[Gratuita] Gravado – Bonificaciones
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 16:
            //[Gratuita] Gravado – Retiro por entrega a trabajadores
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 20:
            //Exonerado - Operación Onerosa
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalExonerated += e.subtotal;
            _this7.saleData.voucher.total += e.total;
            break;

          case 30:
            //Inafecto - Operación Onerosa
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalUnaffected += e.subtotal;
            _this7.saleData.voucher.total += e.total;
            break;

          case 31:
            //[Gratuita] Inafecto – Retiro por Bonificación
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 32:
            //[Gratuita] Inafecto – Retiro
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 33:
            //[Gratuita] Inafecto – Retiro por Muestras Médicas
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 34:
            //[Gratuita] Inafecto - Retiro por Convenio Colectivo
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 35:
            //[Gratuita] Inafecto – Retiro por premio
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 36:
            //[Gratuita] Inafecto - Retiro por publicidad
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalFree += e.total;
            break;

          case 40:
            //Exportación
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this7.saleData.voucher.subtotal += e.subtotal;
            _this7.saleData.voucher.totalUnaffected += e.subtotal;
            _this7.saleData.voucher.total += e.total;
            break;
        }
      });
      this.saleData.voucher.total = this.saleData.voucher.total - this.saleData.voucher.discount;
      this.getChange();
    },
    getChange: function getChange() {
      if (this.saleData.voucher.payments[0].amount != 0) {
        this.saleData.voucher.change = this.saleData.voucher.payments[0].amount - this.saleData.voucher.total;
      }

      if (this.saleData.voucher.payments[0].amount == 0) {
        this.saleData.voucher.change = 0;
      }
    },
    createSale: function createSale() {
      var _this8 = this;

      this.saleData.voucher.received_money = 0;

      if (!this.saleData.voucher.isMultiPayment) {
        this.saleData.voucher.received_money = this.saleData.voucher.payments[0].amount;
      }

      _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].post("/api/sales", this.saleData).then(function (response) {
        _this8.errors = [];
        console.log(response);

        _this8.$router.push({
          name: "voucher-list"
        });

        Swal.fire("Comprobante Creado", response.data, "success");
      })["catch"](function (error) {
        _this8.errors = error.response.data.errors;
        console.log(error.response.data.errors);
        console.log(error.response);
        _this8.errors = error.response.data.errors;

        if (_this8.errors['detail'] != null) {
          Swal.fire("Algo salio mal", _this8.errors['detail'][0], "error");
        }

        _this8.getErrorDetailSerie(0, 0);
      });
    },
    // i = index1(detail) , j = index2(series)
    getErrorDetailSerie: function getErrorDetailSerie(i, j) {
      var _this9 = this;

      if (i < this.saleData.detail.length) {
        if (j < this.saleData.detail[i].quantity) {
          if (this.errors['detail.' + i + '.series.' + j + '.serie'] != null) {
            console.log('detail.' + i + '.series.' + j + '.serie');
            Swal.fire({
              title: "Algo salio mal",
              html: 'Exite un error en el producto  <b>' + this.saleData.detail[i].description + ' - ' + this.saleData.detail[i].brand + ' - ' + this.saleData.detail[i].cod + '</b>: </br>' + this.errors['detail.' + i + '.series.' + j + '.serie'][0],
              icon: "warning"
            }).then(function (result) {
              i++;

              _this9.getErrorDetailSerie(i, 0);
            });
          } else {
            j++;
            this.getErrorDetailSerie(i, j);
          }
        } else {
          i++;
          this.getErrorDetailSerie(i, 0);
        }
      }
    },
    getQuotation: function getQuotation() {
      var _this10 = this;

      this.saleData.detail = [];
      this.productSeries = [];
      _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/quotation/".concat(this.quotationSerieSelect, "/").concat(this.numberQuotation)).then(function (resp) {
        var quotation = resp.data.data;
        _this10.saleData.voucher.discount = quotation.discount;
        _this10.saleData.voucher.warranty = Boolean(quotation.have_warranty);
        _this10.saleData.voucher.observation = quotation.observation;
        _this10.saleData.voucher.payment_type_id = quotation.payment_type_id;
        quotation.quotation_details.forEach(function (e, index) {
          _this10.productSerieSearchFilter.push([]);

          var product = {
            discount: e.discount,
            subtotal: 0,
            total: 0,
            product_id: e.branch_product_id,
            cod: e.branch_product.product.cod,
            affect_icbper: false,
            igv_type_id: e.igv_type_id,
            description: e.branch_product.product.name,
            brand: e.branch_product.product.brand_line.brand.description,
            sale_price: e.price,
            quantity: e.quantity,
            series: []
          };

          _this10.saleData.detail.push(product); //Obtener y Añadir series


          _this10.getSeries(e.branch_product_id);

          _this10.addSeries(index); //Activar descuento


          _this10.activateOrDesactivateGlobalDiscount();

          _this10.activateOrDesactivateDetailDiscount();
        }); // Alertas para las notificaciones y calcular totales

        _this10.getQuotationDiscount(0);
      })["catch"](function (error) {
        if (error.response.status == 404) {
          Swal.fire({
            title: "No encontrado",
            html: "No existe la cotización",
            icon: "warning"
          });
        }
      });
    },
    getQuotationDiscount: function getQuotationDiscount(index) {
      var _this11 = this;

      if (index < this.saleData.detail.length) {
        if (this.saleData.detail[index].discount > 0) {
          Swal.fire({
            title: "¿Aceptar Descuento?",
            html: "El producto <b>" + this.saleData.detail[index].description + "</b> " + "tiene un precio <b>S/. " + this.saleData.detail[index].sale_price + "</b> " + "y tiene un descuento por un total de <b>S/. " + this.saleData.detail[index].discount + "</b> " + "el precio final es de <b>S/. " + (this.saleData.detail[index].sale_price - this.saleData.detail[index].discount) + "</b>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, adelante",
            cancelButtonText: "Cancelar",
            allowOutsideClick: false
          }).then(function (result) {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Confirmado",
                html: "El descuento para el producto <b>" + _this11.saleData.detail[index].description + "</b> " + "por un total de <b>S/. " + _this11.saleData.detail[index].discount + "</b> " + "ha sido aceptado el precio final es <b>S/. " + _this11.saleData.detail[index].sale_price + "</b>",
                icon: "success",
                allowOutsideClick: false
              }).then(function (result) {
                if (result.value) {
                  index++;

                  _this11.getQuotationDiscount(index);
                }
              });
            } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.backdrop) {
              var discount = _this11.saleData.detail[index].discount;
              _this11.saleData.detail[index].discount = 0;
              Swal.fire({
                title: "Cancelado",
                html: "El descuento para el producto <b>" + _this11.saleData.detail[index].description + "</b> " + "por un total de <b>S/. " + discount + "</b> " + "ha sido eliminado el precio final es <b>S/. " + _this11.saleData.detail[index].sale_price + "</b>",
                icon: "error",
                allowOutsideClick: false
              }).then(function (result) {
                if (result.value) {
                  index++;

                  _this11.getQuotationDiscount(index);
                }
              });
            }
          });
        } else {
          index++;
          this.getQuotationDiscount(index);
        }
      } else {
        //Activar descuento
        // if (this.saleData.voucher.discount > 0) {
        //   Swal.fire({
        //     title: "¿Aceptar Descuento?",
        //     html: 'El producto <b>' + this.saleData.detail[index].description + '</b> ' +
        //     'tiene un precio <b>S/. ' + this.saleData.detail[index].sale_price + '</b> ' +
        //     'y tiene un descuento por un total de <b>S/. ' + this.saleData.detail[index].discount + '</b> ' +
        //     'el precio final es de <b>S/. ' + (this.saleData.detail[index].sale_price - this.saleData.detail[index].discount) + '</b>',
        //     icon: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#3085d6",
        //     cancelButtonColor: "#d33",
        //     confirmButtonText: "Si, adelante",
        //     cancelButtonText: "Cancelar",
        //     allowOutsideClick: false
        //   })
        //   .then((result) => {
        //     if (result.isConfirmed) {
        //       Swal.fire({
        //         title: 'Confirmado',
        //         html: 'El descuento para el producto <b>' + this.saleData.detail[index].description + '</b> ' +
        //         'por un total de <b>S/. ' + this.saleData.detail[index].discount + '</b> '  +
        //         'ha sido aceptado el precio final es <b>S/. ' + this.saleData.detail[index].sale_price + '</b>',
        //         icon: 'success',
        //         allowOutsideClick: false
        //       }).then((result) => {
        //         if (result.value) {
        //           index++
        //           this.getQuotationDiscount(index)
        //         }
        //       })
        //     } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.backdrop) {
        //       let discount = this.saleData.detail[index].discount
        //       this.saleData.detail[index].discount = 0
        //       Swal.fire({
        //         title: 'Cancelado',
        //         html: 'El descuento para el producto <b>' + this.saleData.detail[index].description + '</b> ' +
        //         'por un total de <b>S/. ' + discount +  '</b> ' +
        //         'ha sido eliminado el precio final es <b>S/. ' + this.saleData.detail[index].sale_price + '</b>',
        //         icon: 'error',
        //         allowOutsideClick: false
        //       }).then((result) => {
        //         if (result.value) {
        //           index++
        //           this.getQuotationDiscount(index)
        //         }
        //       })
        //     }
        //   })
        // }
        // else {
        //   index++
        //   this.getQuotationDiscount(index)
        // }
        this.activateOrDesactivateGlobalDiscount();
        this.activateOrDesactivateDetailDiscount(); //calcular totales

        this.getTotals();
        console.log(this.saleData);
      }
    },
    addPayment: function addPayment() {
      var payment = {
        payment_type_id: this.paymentTypes[0].id,
        amount: 0
      };
      this.saleData.voucher.payments.push(payment);
    },
    deletePayment: function deletePayment(index) {
      this.saleData.voucher.payments.splice(index, 1);
    },
    clearMultipayment: function clearMultipayment() {
      if (!this.saleData.voucher.isMultiPayment) {
        this.saleData.voucher.payments = [];
      }

      this.addPayment();
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-38bafba8"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};

var _hoisted_1 = {
  "class": "autocomplete mt-0"
};
var _hoisted_2 = {
  "class": "table table-hover table-bordered list"
};

var _hoisted_3 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", {
    "class": "bg-danger"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "w-25"
  }, "cod"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "w-50"
  }, "Nombre"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "w-25"
  }, "Descripcion")])], -1
  /* HOISTED */
  );
});

var _hoisted_4 = ["onClick"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" COMPONENTE PARA BUSCAR Ensamblajes "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "search",
    "class": "form-control rounded-pill form-control rounded-pill-lg",
    placeholder: "Escribe el nombre de tu configuración o código",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.assemblyName = $event;
    }),
    onKeyup: _cache[1] || (_cache[1] = function () {
      return $options.searchAssembly && $options.searchAssembly.apply($options, arguments);
    }),
    onBlur: _cache[2] || (_cache[2] = function ($event) {
      return $data.toggle = false;
    }),
    onFocus: _cache[3] || (_cache[3] = function ($event) {
      return $data.toggle = true;
    })
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.assemblyName]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" AUTOCOMPLETE "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_2, [_hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.assembliesFound, function (assembly) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      "class": "item",
      key: assembly.id,
      onClick: function onClick($event) {
        return $options.setProducts(assembly.products);
      },
      onMousedown: _cache[4] || (_cache[4] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {}, ["prevent"])),
      tabindex: "0"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(assembly.cod), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(assembly.name), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(assembly.description), 1
    /* TEXT */
    )], 40
    /* PROPS, HYDRATE_EVENTS */
    , _hoisted_4);
  }), 128
  /* KEYED_FRAGMENT */
  ))])], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.assembliesFound.length]])], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.toggle]])], 64
  /* STABLE_FRAGMENT */
  );
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=template&id=27533446&scoped=true":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=template&id=27533446&scoped=true ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-27533446"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};

var _hoisted_1 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", {
    "class": "mb-3"
  }, "Datos del clientes", -1
  /* HOISTED */
  );
});

var _hoisted_2 = {
  "class": "row"
};
var _hoisted_3 = {
  "class": "col-md-3"
};
var _hoisted_4 = {
  "class": "form-group"
};

var _hoisted_5 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fas fa-address-card"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Tipo documento ")], -1
  /* HOISTED */
  );
});

var _hoisted_6 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "6",
    selected: ""
  }, "RUC", -1
  /* HOISTED */
  );
});

var _hoisted_7 = [_hoisted_6];
var _hoisted_8 = ["value"];
var _hoisted_9 = {
  "class": "col-md-4"
};
var _hoisted_10 = {
  "class": "form-group"
};
var _hoisted_11 = {
  "for": ""
};

var _hoisted_12 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fas fa-pen"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_13 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" N° Documento ");

var _hoisted_14 = {
  key: 0,
  "class": "input-group"
};
var _hoisted_15 = ["maxlength"];
var _hoisted_16 = {
  key: 0,
  "class": "input-group-append"
};

var _hoisted_17 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-search"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_18 = [_hoisted_17];
var _hoisted_19 = {
  key: 1,
  "class": "input-group-append"
};

var _hoisted_20 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-dark rounded-pill-right"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "spinner-border spinner-border-sm",
    role: "status"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "sr-only"
  }, "Loading...")])], -1
  /* HOISTED */
  );
});

var _hoisted_21 = [_hoisted_20];
var _hoisted_22 = {
  "class": "autocomplete mt-0"
};
var _hoisted_23 = {
  "class": "list"
};
var _hoisted_24 = ["onClick"];
var _hoisted_25 = {
  "class": "col-md-5"
};
var _hoisted_26 = {
  "class": "form-group"
};

var _hoisted_27 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-id-badge"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Nombre/Razón Social: ")], -1
  /* HOISTED */
  );
});

var _hoisted_28 = {
  key: 0,
  "class": "invalid-feedback ml-3"
};
var _hoisted_29 = {
  "class": "row"
};
var _hoisted_30 = {
  "class": "col-md-6"
};
var _hoisted_31 = {
  "class": "form-group"
};

var _hoisted_32 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-map-marker-alt"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Dirección")], -1
  /* HOISTED */
  );
});

var _hoisted_33 = {
  "class": "col-md-3"
};
var _hoisted_34 = {
  "class": "form-group"
};

var _hoisted_35 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-globe"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Ubigeo")], -1
  /* HOISTED */
  );
});

var _hoisted_36 = ["value"];
var _hoisted_37 = {
  "class": "col-md-3"
};
var _hoisted_38 = {
  "class": "form-group"
};

var _hoisted_39 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-phone"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" N° Celular")], -1
  /* HOISTED */
  );
});

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [_hoisted_1, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" TIPO DOCUMENTO "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [_hoisted_5, $props.voucherType == 'FACTURA' || $props.voucherType == '01' || $props.voucherType === 1 ? (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)(((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("select", {
    key: 0,
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $props.customer.identification_document_id = $event;
    }),
    "class": "form-control rounded-pill"
  }, _hoisted_7, 512
  /* NEED_PATCH */
  )), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $props.customer.identification_document_id]]) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)(((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("select", {
    key: 1,
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $props.customer.identification_document_id = $event;
    }),
    "class": "form-control rounded-pill"
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.type_documents, function (type_document) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: type_document.id,
      value: type_document.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(type_document.description), 9
    /* TEXT, PROPS */
    , _hoisted_8);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  )), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $props.customer.identification_document_id]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" N° DOCUMENTO "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_11, [_hoisted_12, _hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)($options.responseApiClass)
  }, " | " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.responseApi), 3
  /* TEXT, CLASS */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.responseApi]])]), $options.showSearchingData ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    id: "searchcustomer",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(_ctx.$errorsClass($props.errors['customer.document'])),
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $props.customer.document = $event;
    }),
    maxlength: $options.maxLenghDocument,
    onKeyup: _cache[3] || (_cache[3] = function () {
      return $options.searchDocument && $options.searchDocument.apply($options, arguments);
    }),
    onBlur: _cache[4] || (_cache[4] = function ($event) {
      return $data.toggle = false;
    }),
    onFocus: _cache[5] || (_cache[5] = function ($event) {
      return $data.toggle = true;
    })
  }, null, 42
  /* CLASS, PROPS, HYDRATE_EVENTS */
  , _hoisted_15), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.customer.document]]), !$data.loading ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_16, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-dark rounded-pill-right",
    onClick: _cache[6] || (_cache[6] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.getDataApi && $options.getDataApi.apply($options, arguments);
    }, ["prevent"]))
  }, _hoisted_18)])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_19, _hoisted_21))])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("input", {
    key: 1,
    type: "text",
    "class": "form-control rounded-pill",
    onKeyup: _cache[7] || (_cache[7] = function () {
      return $options.searchDocument && $options.searchDocument.apply($options, arguments);
    }),
    onBlur: _cache[8] || (_cache[8] = function ($event) {
      return $data.toggle = false;
    }),
    onFocus: _cache[9] || (_cache[9] = function ($event) {
      return $data.toggle = true;
    })
  }, null, 32
  /* HYDRATE_EVENTS */
  )), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Autocomplete "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_23, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.customers, function (customerFind) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)(((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", {
      "class": "item",
      onClick: function onClick($event) {
        return $options.setData(customerFind);
      },
      key: customerFind.id,
      onMousedown: _cache[10] || (_cache[10] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {}, ["prevent"]))
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(customerFind.document) + " - " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(customerFind.name), 41
    /* TEXT, PROPS, HYDRATE_EVENTS */
    , _hoisted_24)), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.customers]]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.toggle]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" NOMBRE/RAZON SOCIAL "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [_hoisted_27, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $props.customer.name = $event;
    }),
    type: "text",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(_ctx.$errorsClass($props.errors['customer.name']))
  }, null, 2
  /* CLASS */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.customer.name]]), _ctx.$errorsExists($props.errors['customer.name']) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_28, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.$errorsPrint($props.errors["customer.name"])), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" DIRECCIÓN "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_31, [_hoisted_32, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $props.customer.address = $event;
    }),
    type: "text",
    "class": "form-control rounded-pill",
    name: "",
    id: ""
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.customer.address]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" UBIGEO "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [_hoisted_35, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    id: "select4",
    "class": "js-states form-control rounded-pill",
    name: "",
    style: {
      "width": "100%"
    },
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $props.customer.ubigee_id = $event;
    })
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.ubigees, function (ubigee) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: ubigee.id,
      value: ubigee.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(ubigee.place_description), 9
    /* TEXT, PROPS */
    , _hoisted_36);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $props.customer.ubigee_id]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" N° CELULAR "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [_hoisted_39, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control rounded-pill",
    type: "text",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $props.customer.phone = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.customer.phone]])])])])], 64
  /* STABLE_FRAGMENT */
  );
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _img_add_product_png__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../img/add_product.png */ "./resources/img/add_product.png");



var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-3837e5aa"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};

var _hoisted_1 = {
  "class": "content-header"
};
var _hoisted_2 = {
  "class": "row mb-2"
};

var _hoisted_3 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "col-sm-8"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h3", null, "Registrar Nueva Venta")], -1
  /* HOISTED */
  );
});

var _hoisted_4 = {
  "class": "col-sm-2"
};
var _hoisted_5 = {
  "class": "row"
};

var _hoisted_6 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "",
    "class": "col-4 col-form-label col-form-label-sm"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-barcode"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Serie Cotización ")], -1
  /* HOISTED */
  );
});

var _hoisted_7 = {
  "class": "col-8"
};
var _hoisted_8 = ["value"];
var _hoisted_9 = {
  "class": "col-sm-2"
};
var _hoisted_10 = {
  "class": "input-group"
};
var _hoisted_11 = {
  "class": "input-group-append"
};

var _hoisted_12 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-search"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_13 = [_hoisted_12];
var _hoisted_14 = {
  "class": "card"
};
var _hoisted_15 = {
  "class": "card-body"
};

var _hoisted_16 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, "Comprobante", -1
  /* HOISTED */
  );
});

var _hoisted_17 = {
  "class": "row"
};
var _hoisted_18 = {
  "class": "col-md-4"
};
var _hoisted_19 = {
  "class": "form-group"
};

var _hoisted_20 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-file-invoice"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Tipo comprobante ")], -1
  /* HOISTED */
  );
});

var _hoisted_21 = ["value"];
var _hoisted_22 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_23 = {
  "class": "col-md-4"
};
var _hoisted_24 = {
  "class": "form-group"
};

var _hoisted_25 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-barcode"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Serie ")], -1
  /* HOISTED */
  );
});

var _hoisted_26 = ["value"];
var _hoisted_27 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_28 = {
  "class": "col-md-4"
};
var _hoisted_29 = {
  "class": "form-group"
};

var _hoisted_30 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-hashtag"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" N° Comprobante")], -1
  /* HOISTED */
  );
});

var _hoisted_31 = {
  "class": "row"
};
var _hoisted_32 = {
  "class": "col-md"
};
var _hoisted_33 = {
  "class": "d-flex bd-highlight"
};

var _hoisted_34 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "p-2 flex-grow-1"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-box"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Productos ")])], -1
  /* HOISTED */
  );
});

var _hoisted_35 = {
  "class": "p-2"
};
var _hoisted_36 = {
  "class": "custom-control custom-checkbox"
};

var _hoisted_37 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "searchAssemblies",
    "class": "custom-control-label"
  }, "Configuracion de PC", -1
  /* HOISTED */
  );
});

var _hoisted_38 = {
  key: 0,
  "class": ""
};
var _hoisted_39 = {
  "class": "option__relative"
};
var _hoisted_40 = {
  "class": "option__contenedor"
};
var _hoisted_41 = {
  table: "",
  "class": "table table-sm table-bordered table-hover bg-white shadow-lg"
};
var _hoisted_42 = {
  key: 0,
  "class": "thead-dark text-center"
};

var _hoisted_43 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Nombre"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Marca"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Precio 1"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Precio 2"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Precio 3"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Stock")], -1
  /* HOISTED */
  );
});

var _hoisted_44 = [_hoisted_43];
var _hoisted_45 = {
  "class": "col-2 text-center"
};
var _hoisted_46 = {
  "class": "col-2 text-center"
};
var _hoisted_47 = ["value", "onClick"];
var _hoisted_48 = {
  "class": "col-2 text-center"
};
var _hoisted_49 = ["value", "onClick"];
var _hoisted_50 = {
  "class": "col-2 text-center"
};
var _hoisted_51 = ["value", "onClick"];
var _hoisted_52 = {
  "class": "col-1 text-center"
};
var _hoisted_53 = {
  key: 1,
  "class": ""
};
var _hoisted_54 = {
  "class": "row"
};
var _hoisted_55 = {
  "class": "col-12 table-responsive mt-4 mb-4 table-product border rounded"
};
var _hoisted_56 = {
  "class": "table table-striped"
};

var _hoisted_57 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "36%"
    }
  }, "Descripción"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "20%"
    }
  }, "Tipo IGV"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "3%"
    }
  }, "Cantidad"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "9%"
    }
  }, "Descuento"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "9%"
    }
  }, "Precio"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "9%"
    }
  }, "Sub Total"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "9%"
    }
  }, "Total"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "5%"
    }
  }, "Series"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "3%"
    }
  })])], -1
  /* HOISTED */
  );
});

var _hoisted_58 = ["value"];
var _hoisted_59 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_60 = ["onUpdate:modelValue"];
var _hoisted_61 = ["value"];
var _hoisted_62 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_63 = ["onUpdate:modelValue", "onChange"];
var _hoisted_64 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_65 = ["onUpdate:modelValue", "disabled"];
var _hoisted_66 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_67 = ["onUpdate:modelValue"];
var _hoisted_68 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_69 = ["value"];
var _hoisted_70 = ["value"];
var _hoisted_71 = ["data-target"];
var _hoisted_72 = ["onClick"];

var _hoisted_73 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-trash"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_74 = [_hoisted_73];
var _hoisted_75 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_76 = ["id"];
var _hoisted_77 = {
  "class": "modal-dialog",
  role: "document"
};
var _hoisted_78 = {
  "class": "modal-content"
};
var _hoisted_79 = {
  "class": "modal-header"
};
var _hoisted_80 = {
  "class": "modal-title",
  id: "seriesModalLabel"
};

var _hoisted_81 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    "class": "close",
    "data-dismiss": "modal",
    "aria-label": "Close"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "aria-hidden": "true"
  }, "×")], -1
  /* HOISTED */
  );
});

var _hoisted_82 = {
  "class": "modal-body"
};
var _hoisted_83 = ["onUpdate:modelValue", "onKeyup"];
var _hoisted_84 = {
  "class": ""
};
var _hoisted_85 = {
  "class": ""
};
var _hoisted_86 = ["onClick"];

var _hoisted_87 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "modal-footer"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    "class": "btn btn-secondary",
    "data-dismiss": "modal"
  }, " Cerrar ")], -1
  /* HOISTED */
  );
});

var _hoisted_88 = {
  key: 0,
  "class": "image-without-products"
};

var _hoisted_89 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: _img_add_product_png__WEBPACK_IMPORTED_MODULE_1__["default"],
    alt: "",
    style: {
      "max-height": "120px"
    }
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_90 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", {
    "class": "display-4"
  }, "Agregue productos", -1
  /* HOISTED */
  );
});

var _hoisted_91 = [_hoisted_89, _hoisted_90];
var _hoisted_92 = {
  "class": "row"
};
var _hoisted_93 = {
  "class": "col-md-8"
};

var _hoisted_94 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, "Detalle Documento", -1
  /* HOISTED */
  );
});

var _hoisted_95 = {
  "class": "row"
};
var _hoisted_96 = {
  "class": "table-responsive"
};
var _hoisted_97 = {
  "class": "table",
  style: {
    "min-width": "600px"
  }
};

var _hoisted_98 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-money-bill"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Tipo de pago ")], -1
  /* HOISTED */
  );
});

var _hoisted_99 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Total Recibido S/.", -1
  /* HOISTED */
  );
});

var _hoisted_100 = {
  key: 0
};

var _hoisted_101 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "col-2 text-center"
  }, "¿Es multipago?", -1
  /* HOISTED */
  );
});

var _hoisted_102 = ["onUpdate:modelValue"];
var _hoisted_103 = ["value"];
var _hoisted_104 = ["onUpdate:modelValue", "onInput"];
var _hoisted_105 = {
  key: 0
};
var _hoisted_106 = {
  key: 1,
  "class": "text-center"
};
var _hoisted_107 = {
  "class": "custom-control custom-switch custom-switch-on-danger is-invalid"
};
var _hoisted_108 = {
  "class": "custom-control-label",
  "for": "customSwitchCreateIsMultiPayment"
};
var _hoisted_109 = {
  key: 2,
  "class": "text-center"
};

var _hoisted_110 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "fas fa-plus"
  })], -1
  /* HOISTED */
  );
});

var _hoisted_111 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Añadir ");

var _hoisted_112 = [_hoisted_110, _hoisted_111];
var _hoisted_113 = {
  key: 3,
  "class": "text-center"
};
var _hoisted_114 = ["onClick"];

var _hoisted_115 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-trash"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_116 = [_hoisted_115];
var _hoisted_117 = {
  "class": "row"
};
var _hoisted_118 = {
  "class": "col-md-6"
};
var _hoisted_119 = {
  "class": "form-group"
};

var _hoisted_120 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-tags"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Descuento ")], -1
  /* HOISTED */
  );
});

var _hoisted_121 = ["disabled"];
var _hoisted_122 = {
  key: 0,
  "class": "invalid-feedback ml-3"
};
var _hoisted_123 = {
  "class": "col-md-3"
};
var _hoisted_124 = {
  "class": "form-group text-center"
};

var _hoisted_125 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-file-contract"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" ¿Aplica garantía? ")], -1
  /* HOISTED */
  );
});

var _hoisted_126 = {
  "class": "custom-control custom-switch custom-switch-on-danger is-invalid"
};
var _hoisted_127 = {
  "class": "custom-control-label",
  "for": "customSwitchCreate"
};
var _hoisted_128 = {
  key: 0,
  "class": "col-md-3"
};
var _hoisted_129 = {
  "class": "form-group"
};

var _hoisted_130 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-barcode"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Serie Garantia ")], -1
  /* HOISTED */
  );
});

var _hoisted_131 = ["value"];
var _hoisted_132 = {
  "class": "row"
};
var _hoisted_133 = {
  "class": "col-md"
};
var _hoisted_134 = {
  "class": "form-group"
};

var _hoisted_135 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, "Observación", -1
  /* HOISTED */
  );
});

var _hoisted_136 = {
  "class": "col-md-4"
};
var _hoisted_137 = {
  "class": "table-responsive"
};
var _hoisted_138 = {
  "class": "table mt-5"
};

var _hoisted_139 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Descuento global:", -1
  /* HOISTED */
  );
});

var _hoisted_140 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Descuento por item:", -1
  /* HOISTED */
  );
});

var _hoisted_141 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Gravado:", -1
  /* HOISTED */
  );
});

var _hoisted_142 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Exonerado:", -1
  /* HOISTED */
  );
});

var _hoisted_143 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Inafecto:", -1
  /* HOISTED */
  );
});

var _hoisted_144 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Gratuita:", -1
  /* HOISTED */
  );
});

var _hoisted_145 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Igv (18%):", -1
  /* HOISTED */
  );
});

var _hoisted_146 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Total:", -1
  /* HOISTED */
  );
});

var _hoisted_147 = {
  "class": "row no-print"
};
var _hoisted_148 = {
  "class": "col-12"
};

var _hoisted_149 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "submit",
    "class": "btn btn-dark float-right"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "far fa-credit-card"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Guarda Documento Electronico ")], -1
  /* HOISTED */
  );
});

var _hoisted_150 = [_hoisted_149];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_SearchCustomers = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("SearchCustomers");

  var _component_search_assemblies = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("search-assemblies");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [_hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [_hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.quotationSerieSelect = $event;
    }),
    "class": "form-control rounded-pill"
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.quotationSeries, function (quotationSerie) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: quotationSerie.id,
      value: quotationSerie.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(quotationSerie.serie), 9
    /* TEXT, PROPS */
    , _hoisted_8);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.quotationSerieSelect]])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    placeholder: "n° cotización",
    "class": "form-control",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.numberQuotation = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.numberQuotation]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-danger rounded-pill-right",
    onClick: _cache[2] || (_cache[2] = function ($event) {
      return $options.getQuotation();
    })
  }, _hoisted_13)])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [_hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" TIPO DE COMPROBANTE "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [_hoisted_20, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errors['voucher.document_type'] == null ? '' : ' is-invalid')),
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $data.saleData.voucher.document_type = $event;
    }),
    onChange: _cache[4] || (_cache[4] = function ($event) {
      return $options.loadSeries();
    })
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.voucherTypes, function (voucherType) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: voucherType.id,
      value: voucherType.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(voucherType.description), 9
    /* TEXT, PROPS */
    , _hoisted_21);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 34
  /* CLASS, HYDRATE_EVENTS */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.saleData.voucher.document_type]]), $data.errors['voucher.document_type'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_22, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["voucher.document_type"][0]), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" SERIE "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [_hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errors['voucher.serie_id'] == null ? '' : ' is-invalid')),
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $data.saleData.voucher.serie_id = $event;
    }),
    onChange: _cache[6] || (_cache[6] = function () {
      return $options.loadCurrentNumber && $options.loadCurrentNumber.apply($options, arguments);
    })
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.series, function (serie) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: serie.id,
      value: serie.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(serie.serie), 9
    /* TEXT, PROPS */
    , _hoisted_26);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 34
  /* CLASS, HYDRATE_EVENTS */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.saleData.voucher.serie_id]]), $data.errors['voucher.serie_id'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_27, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["voucher.serie_id"][0]), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" N° COMPROBANTE "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [_hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $data.currentNumber = $event;
    }),
    type: "text",
    "class": "form-control rounded-pill",
    disabled: ""
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.currentNumber]])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.document_type) + " ", 1
  /* TEXT */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_SearchCustomers, {
    voucherType: $data.saleData.voucher.document_type,
    customer: $data.saleData.customer,
    errors: $data.errors
  }, null, 8
  /* PROPS */
  , ["voucherType", "customer", "errors"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.detail), 1
  /* TEXT */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" COMPONENTE PARA BUSCAR PRODUCTOS "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_31, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [_hoisted_34, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "custom-control-input custom-control-input-danger",
    type: "checkbox",
    id: "searchAssemblies",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $data.searchAssemblies = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $data.searchAssemblies]]), _hoisted_37])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div class=\"p-2\">Third flex item</div> ")]), !$data.searchAssemblies ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "search",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $data.productSearch = $event;
    }),
    onKeyup: _cache[10] || (_cache[10] = function () {
      return $options.searchProducts && $options.searchProducts.apply($options, arguments);
    }),
    "class": "form-control rounded-pill form-control rounded-pill-lg",
    placeholder: "Escribe tu producto o código"
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.productSearch]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_41, [$data.productSearchFilter.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("thead", _hoisted_42, _hoisted_44)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.productSearchFilter, function (filSearch) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: filSearch
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSearch.name), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_45, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSearch.brand), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "btn btn-sm btn-success w-50",
      type: "button",
      value: filSearch.sale_price,
      onClick: function onClick($event) {
        return $options.priceOne(filSearch);
      }
    }, null, 8
    /* PROPS */
    , _hoisted_47)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "btn btn-sm btn-warning w-50",
      type: "button",
      value: filSearch.referential_sale_price_one,
      onClick: function onClick($event) {
        return $options.priceTwo(filSearch);
      }
    }, null, 8
    /* PROPS */
    , _hoisted_49)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "btn btn-sm btn-info w-50",
      type: "button",
      value: filSearch.referential_sale_price_two,
      onClick: function onClick($event) {
        return $options.priceThree(filSearch);
      }
    }, null, 8
    /* PROPS */
    , _hoisted_51)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_52, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSearch.stock), 1
    /* TEXT */
    )]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])])])])])])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_search_assemblies, {
    products: $data.saleData.detail,
    onSetAssemblie: $options.setAssemblie
  }, null, 8
  /* PROPS */
  , ["products", "onSetAssemblie"])]))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" VER PRODUCTOS SELECCIONADOS "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_56, [_hoisted_57, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.saleData.detail, function (detail, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: detail
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errors['detail.' + index + '.product_id'] == null ? '' : ' is-invalid')),
      type: "text",
      value: detail.description + ' - ' + detail.brand + ' - ' + detail.cod,
      disabled: ""
    }, null, 10
    /* CLASS, PROPS */
    , _hoisted_58), $data.errors['detail.' + index + '.product_id'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_59, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["detail." + index + ".product_id"][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.igv_type_id = $event;
      },
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errors['detail.' + index + '.igv_type_id'] == null ? '' : ' is-invalid')),
      onChange: _cache[11] || (_cache[11] = function ($event) {
        return $options.getTotals();
      })
    }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.igvTypes, function (igvType) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
        key: igvType.id,
        value: igvType.id
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(igvType.description), 9
      /* TEXT, PROPS */
      , _hoisted_61);
    }), 128
    /* KEYED_FRAGMENT */
    ))], 42
    /* CLASS, PROPS, HYDRATE_EVENTS */
    , _hoisted_60), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, detail.igv_type_id]]), $data.errors['detail.' + index + '.igv_type_id'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_62, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["detail." + index + ".igv_type_id"][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errors['detail.' + index + '.quantity'] == null ? '' : ' is-invalid')),
      type: "number",
      min: "1",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.quantity = $event;
      },
      onChange: function onChange($event) {
        return $options.addSeries(index);
      },
      onInput: _cache[12] || (_cache[12] = function ($event) {
        return $options.getTotals();
      })
    }, null, 42
    /* CLASS, PROPS, HYDRATE_EVENTS */
    , _hoisted_63), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, detail.quantity]]), $data.errors['detail.' + index + '.quantity'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_64, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["detail." + index + ".quantity"][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errors['detail.' + index + '.discount'] == null ? '' : ' is-invalid')),
      type: "number",
      min: "0",
      step: "0.001",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.discount = $event;
      },
      onChange: _cache[13] || (_cache[13] = function ($event) {
        return $options.activateOrDesactivateGlobalDiscount();
      }),
      disabled: $data.activateDetailDiscount,
      onInput: _cache[14] || (_cache[14] = function ($event) {
        return $options.getTotals();
      })
    }, null, 42
    /* CLASS, PROPS, HYDRATE_EVENTS */
    , _hoisted_65), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, detail.discount]]), $data.errors['detail.' + index + '.discount'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_66, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["detail." + index + ".discount"][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errors['detail.' + index + '.sale_price'] == null ? '' : ' is-invalid')),
      type: "text",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.sale_price = $event;
      },
      disabled: ""
    }, null, 10
    /* CLASS, PROPS */
    , _hoisted_67), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, detail.sale_price]]), $data.errors['detail.' + index + '.sale_price'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_68, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["detail." + index + ".sale_price"][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control rounded-pill",
      type: "text",
      disabled: "",
      value: detail.subtotal
    }, null, 8
    /* PROPS */
    , _hoisted_69)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control rounded-pill",
      type: "text",
      disabled: "",
      value: detail.total
    }, null, 8
    /* PROPS */
    , _hoisted_70)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "button",
      "class": "btn btn-dark btn-sm",
      "data-toggle": "modal",
      "data-target": '#seriesModal' + index,
      value: "Series"
    }, null, 8
    /* PROPS */
    , _hoisted_71)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      type: "button",
      "class": "btn btn-flat bg-light",
      onClick: function onClick($event) {
        return $options.deleteItem(index);
      }
    }, _hoisted_74, 8
    /* PROPS */
    , _hoisted_72), $data.errors['detail.' + index + '.series'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_75, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errors["detail." + index + ".series"][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Modal Serie "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": "modal fade",
      id: 'seriesModal' + index,
      tabindex: "-1",
      role: "dialog",
      "aria-labelledby": "seriesModalLabel",
      "aria-hidden": "true"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", _hoisted_80, " Registrar series para " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(detail.description) + " - " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(detail.brand) + " - " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(detail.cod), 1
    /* TEXT */
    ), _hoisted_81]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_82, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(detail.series, function (obj, j) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
        "class": "row m-3",
        key: obj
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": "form-control",
        placeholder: "Serie",
        "onUpdate:modelValue": function onUpdateModelValue($event) {
          return obj.serie = $event;
        },
        onKeyup: function onKeyup($event) {
          return $options.searchProductSeries(index, j);
        }
      }, null, 40
      /* PROPS, HYDRATE_EVENTS */
      , _hoisted_83), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, obj.serie]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_84, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.productSerieSearchFilter[index][j], function (filSerieSearch) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", {
          key: filSerieSearch,
          onClick: function onClick($event) {
            return $options.selectSerieSearch(filSerieSearch, index, j);
          }
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSerieSearch.serie), 9
        /* TEXT, PROPS */
        , _hoisted_86);
      }), 128
      /* KEYED_FRAGMENT */
      ))])])])]);
    }), 128
    /* KEYED_FRAGMENT */
    ))]), _hoisted_87])])], 8
    /* PROPS */
    , _hoisted_76)]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])]), $data.saleData.detail.length == 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_88, _hoisted_91)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Observación "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_93, [_hoisted_94, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_96, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_97, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_98, _hoisted_99, !$data.saleData.voucher.isMultiPayment ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("th", _hoisted_100, "Vuelto S/.")) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), _hoisted_101])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.saleData.voucher.payments, function (payment, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: payment.id
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return payment.payment_type_id = $event;
      },
      "class": "form-control rounded-pill"
    }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.paymentTypes, function (paymentType) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
        key: paymentType.id,
        value: paymentType.id
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(paymentType.description), 9
      /* TEXT, PROPS */
      , _hoisted_103);
    }), 128
    /* KEYED_FRAGMENT */
    ))], 8
    /* PROPS */
    , _hoisted_102), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, payment.payment_type_id]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control rounded-pill",
      type: "number",
      min: "0",
      step: "0.01",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return payment.amount = $event;
      },
      onInput: function onInput($event) {
        return index == 0 ? $options.getChange() : null;
      }
    }, null, 40
    /* PROPS, HYDRATE_EVENTS */
    , _hoisted_104), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, payment.amount]])]), !$data.saleData.voucher.isMultiPayment ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", _hoisted_105, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control rounded-pill",
      type: "text",
      "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
        return $data.saleData.voucher.change = $event;
      }),
      disabled: ""
    }, null, 512
    /* NEED_PATCH */
    ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.saleData.voucher.change]])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), index == 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", _hoisted_106, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_107, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "checkbox",
      "class": "custom-control-input",
      id: "customSwitchCreateIsMultiPayment",
      "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
        return $data.saleData.voucher.isMultiPayment = $event;
      }),
      onChange: _cache[17] || (_cache[17] = function ($event) {
        return $options.clearMultipayment();
      })
    }, null, 544
    /* HYDRATE_EVENTS, NEED_PATCH */
    ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $data.saleData.voucher.isMultiPayment]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_108, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.isMultiPayment ? "Si" : "No"), 1
    /* TEXT */
    )])])) : index == 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", _hoisted_109, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      type: "button",
      "class": "btn btn-dark btn-sm",
      onClick: _cache[18] || (_cache[18] = function ($event) {
        return $options.addPayment();
      })
    }, _hoisted_112)])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", _hoisted_113, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      type: "button",
      "class": "btn btn-flat",
      onClick: function onClick($event) {
        return $options.deletePayment(index);
      }
    }, _hoisted_116, 8
    /* PROPS */
    , _hoisted_114)]))]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_117, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_118, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_119, [_hoisted_120, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(_ctx.$errorsClass($data.errors['voucher.discount'])),
    type: "number",
    min: "0",
    step: "0.01",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $data.saleData.voucher.discount = $event;
    }),
    onChange: _cache[20] || (_cache[20] = function () {
      return $options.activateOrDesactivateDetailDiscount && $options.activateOrDesactivateDetailDiscount.apply($options, arguments);
    }),
    disabled: $data.activateGlobalDiscount,
    onInput: _cache[21] || (_cache[21] = function ($event) {
      return $options.getTotals();
    })
  }, null, 42
  /* CLASS, PROPS, HYDRATE_EVENTS */
  , _hoisted_121), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.saleData.voucher.discount]]), _ctx.$errorsExists($data.errors['voucher.discount']) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_122, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.$errorsPrint($data.errors["voucher.discount"])), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_123, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_124, [_hoisted_125, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_126, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    "class": "custom-control-input",
    id: "customSwitchCreate",
    "onUpdate:modelValue": _cache[22] || (_cache[22] = function ($event) {
      return $data.saleData.voucher.warranty = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $data.saleData.voucher.warranty]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_127, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.warranty ? "Si" : "No"), 1
  /* TEXT */
  )])])]), $data.saleData.voucher.warranty ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_128, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_129, [_hoisted_130, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[23] || (_cache[23] = function ($event) {
      return $data.saleData.voucher.warranty_serie_id = $event;
    }),
    "class": "form-control rounded-pill"
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.warrantySeries, function (warrantySerie) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: warrantySerie.id,
      value: warrantySerie.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(warrantySerie.serie), 9
    /* TEXT, PROPS */
    , _hoisted_131);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.saleData.voucher.warranty_serie_id]])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_132, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_133, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_134, [_hoisted_135, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    cols: "30",
    rows: "4",
    "class": "form-control",
    "onUpdate:modelValue": _cache[24] || (_cache[24] = function ($event) {
      return $data.saleData.voucher.observation = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.saleData.voucher.observation]])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_136, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_137, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_138, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_139, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.discount), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.saleData.voucher.discount > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_140, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.discountItems), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.saleData.voucher.discountItems > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_141, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.totalTaxed), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.saleData.voucher.totalTaxed > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_142, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.totalExonerated), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.saleData.voucher.totalExonerated > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_143, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.totalUnaffected), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.saleData.voucher.totalUnaffected > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_144, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.totalFree), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.saleData.voucher.totalFree > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_145, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.totalIgv), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.saleData.voucher.totalIgv > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_146, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.saleData.voucher.total), 1
  /* TEXT */
  )])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Resumen de ventas "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_147, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_148, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
    onSubmit: _cache[25] || (_cache[25] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.createSale();
    }, ["prevent"]))
  }, _hoisted_150, 32
  /* HYDRATE_EVENTS */
  )])])])])], 64
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

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.autocomplete[data-v-38bafba8] {\r\n  position: relative;\r\n  cursor: pointer;\n}\n.list[data-v-38bafba8] {\r\n  position: absolute;\r\n  background: #fff;\r\n  width: 100%;\r\n  padding: 0;\r\n  z-index: 1000;\n}\n.rounded-pill-left[data-v-38bafba8] {\r\n  border-top-left-radius: 50px;\r\n  border-bottom-left-radius: 50px;\n}\n.rounded-pill-right[data-v-38bafba8] {\r\n  border-top-right-radius: 50px;\r\n  border-bottom-right-radius: 50px;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.autocomplete[data-v-27533446] {\n  position: relative;\n  cursor: pointer;\n}\n.list[data-v-27533446] {\n  position: absolute;\n  background: #fff;\n  width: 100%;\n  padding: 0;\n  z-index: 1000;\n}\n.item[data-v-27533446] {\n  border-bottom: 0.1rem solid rgb(180, 180, 180);\n  border-left: 0.1rem solid rgb(180, 180, 180);\n  border-right: 0.1rem solid rgb(180, 180, 180);\n  margin: 0;\n  padding: 0.5em 1em;\n  text-decoration: none;\n  list-style: none;\n}\n.item[data-v-27533446]:hover {\n  background: #f2f2f2;\n}\n.rounded-pill-left[data-v-27533446] {\n  border-top-left-radius: 50px;\n  border-bottom-left-radius: 50px;\n}\n.rounded-pill-right[data-v-27533446] {\n  border-top-right-radius: 50px;\n  border-bottom-right-radius: 50px;\n}\n#searchcustomer[data-v-27533446] {\n  border-top-right-radius: 0 !important;\n  border-bottom-right-radius: 0 !important;\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
___CSS_LOADER_EXPORT___.push([module.id, "\n.btn.btn-dark[data-v-3837e5aa] {\n  border-top-right-radius: 23px;\n  border-bottom-right-radius: 23px;\n  background: #536976; /* fallback for old browsers */ /* Chrome 10-25, Safari 5.1-6 */\n  background: linear-gradient(\n    to right,\n    #292e49,\n    #536976\n  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */\n}\nlabel[data-v-3837e5aa] {\n  color: rgba(48, 48, 48, 0.774);\n  font-weight: 300;\n}\n.option__relative[data-v-3837e5aa] {\n  position: relative;\n  z-index: 99;\n}\n.option__contenedor[data-v-3837e5aa] {\n  box-sizing: border-box;\n  border-radius: 5px;\n  width: 100%;\n  max-height: 200px;\n  box-shadow: 0 0 2px 0 rgb(128, 189, 255);\n  background-color: #fff;\n  box-sizing: border-box;\n  cursor: pointer;\n  overflow-y: scroll;\n  position: absolute;\n  z-index: 100;\n}\n.option__contenedor input[data-v-3837e5aa],\n.search input[data-v-3837e5aa] {\n  display: block;\n  margin-left: auto;\n  margin-right: auto;\n  /*border-color: #93a8c3;*/\n  outline-color: rgb(128, 189, 255);\n  border-style: solid;\n  border-width: 1px;\n  /*color:rgb(172,173,182)*/\n}\n.option__contenedor table[data-v-3837e5aa] {\n  width: 100%;\n  padding: 8px 10px;\n  margin: 0;\n}\n.option__contenedor[data-v-3837e5aa]::-webkit-scrollbar {\n  width: 7px;\n  background-color: rgb(128, 189, 255);\n}\n.option__contenedor[data-v-3837e5aa]::-webkit-scrollbar-thumb {\n  background-color: rgb(255, 255, 255);\n  border-radius: 10px;\n  border-right: 1px solid rgb(128, 189, 255);\n  border-left: 1px solid rgb(128, 189, 255);\n}\n.search .option__contenedor[data-v-3837e5aa] {\n  top: 0;\n}\n.search input[data-v-3837e5aa] {\n  width: 100%;\n  height: 40px;\n  border-radius: 5px;\n}\n.table-product[data-v-3837e5aa] {\n  min-height: 250px;\n}\n.table-product table[data-v-3837e5aa] {\n  min-width: 900px;\n}\n.image-without-products[data-v-3837e5aa] {\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  align-content: center;\n  opacity: 0.7;\n  height: 150px;\n  width: 100%;\n  min-width: 850px;\n}\n.image-without-products img[data-v-3837e5aa] {\n  margin-bottom: 0.5rem;\n  margin-right: 0.5rem;\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./resources/img/add_product.png":
/*!***************************************!*\
  !*** ./resources/img/add_product.png ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/add_product.png?b547ea736e0d588709628359637e19d6");

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

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_style_index_0_id_38bafba8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_style_index_0_id_38bafba8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_style_index_0_id_38bafba8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_style_index_0_id_27533446_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_style_index_0_id_27533446_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_style_index_0_id_27533446_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_style_index_0_id_3837e5aa_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_style_index_0_id_3837e5aa_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_style_index_0_id_3837e5aa_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/modules/sales/components/SearchAssemblies.vue":
/*!********************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchAssemblies.vue ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _SearchAssemblies_vue_vue_type_template_id_38bafba8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true */ "./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true");
/* harmony import */ var _SearchAssemblies_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SearchAssemblies.vue?vue&type=script&lang=js */ "./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=script&lang=js");
/* harmony import */ var _SearchAssemblies_vue_vue_type_style_index_0_id_38bafba8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css */ "./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css");
/* harmony import */ var C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_SearchAssemblies_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_SearchAssemblies_vue_vue_type_template_id_38bafba8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-38bafba8"],['__file',"resources/js/modules/sales/components/SearchAssemblies.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/sales/components/SearchCustomers.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchCustomers.vue ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _SearchCustomers_vue_vue_type_template_id_27533446_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SearchCustomers.vue?vue&type=template&id=27533446&scoped=true */ "./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=template&id=27533446&scoped=true");
/* harmony import */ var _SearchCustomers_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SearchCustomers.vue?vue&type=script&lang=js */ "./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=script&lang=js");
/* harmony import */ var _SearchCustomers_vue_vue_type_style_index_0_id_27533446_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css */ "./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css");
/* harmony import */ var C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_SearchCustomers_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_SearchCustomers_vue_vue_type_template_id_27533446_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-27533446"],['__file',"resources/js/modules/sales/components/SearchCustomers.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/sales/vouchers/pages/NewVoucher.vue":
/*!******************************************************************!*\
  !*** ./resources/js/modules/sales/vouchers/pages/NewVoucher.vue ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _NewVoucher_vue_vue_type_template_id_3837e5aa_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true */ "./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true");
/* harmony import */ var _NewVoucher_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./NewVoucher.vue?vue&type=script&lang=js */ "./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=script&lang=js");
/* harmony import */ var _NewVoucher_vue_vue_type_style_index_0_id_3837e5aa_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css */ "./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css");
/* harmony import */ var C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_NewVoucher_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_NewVoucher_vue_vue_type_template_id_3837e5aa_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-3837e5aa"],['__file',"resources/js/modules/sales/vouchers/pages/NewVoucher.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=script&lang=js":
/*!********************************************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=script&lang=js ***!
  \********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchAssemblies.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=script&lang=js":
/*!*******************************************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchCustomers.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=script&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=script&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewVoucher.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true ***!
  \**************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_template_id_38bafba8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_template_id_38bafba8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=template&id=38bafba8&scoped=true");


/***/ }),

/***/ "./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=template&id=27533446&scoped=true":
/*!*************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=template&id=27533446&scoped=true ***!
  \*************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_template_id_27533446_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_template_id_27533446_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchCustomers.vue?vue&type=template&id=27533446&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=template&id=27533446&scoped=true");


/***/ }),

/***/ "./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true":
/*!************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_template_id_3837e5aa_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_template_id_3837e5aa_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=template&id=3837e5aa&scoped=true");


/***/ }),

/***/ "./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css":
/*!****************************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css ***!
  \****************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchAssemblies_vue_vue_type_style_index_0_id_38bafba8_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader/dist/cjs.js!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchAssemblies.vue?vue&type=style&index=0&id=38bafba8&scoped=true&lang=css");


/***/ }),

/***/ "./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css":
/*!***************************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css ***!
  \***************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_SearchCustomers_vue_vue_type_style_index_0_id_27533446_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader/dist/cjs.js!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/components/SearchCustomers.vue?vue&type=style&index=0&id=27533446&scoped=true&lang=css");


/***/ }),

/***/ "./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css":
/*!**************************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css ***!
  \**************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewVoucher_vue_vue_type_style_index_0_id_3837e5aa_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/vouchers/pages/NewVoucher.vue?vue&type=style&index=0&id=3837e5aa&scoped=true&lang=css");


/***/ })

}]);