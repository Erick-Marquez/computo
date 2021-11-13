(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_modules_sales_quotations_pages_NewQuotation_vue"],{

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


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
    voucherType: String
  },
  created: function created() {
    this.getTypeDocuments();
    this.getUbigees();
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
                  _this2.customer.ubigee = response.data.ubigee;
                  _this2.responseApi = "HABIDO";
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
                  console.log(response.data);
                })["catch"](function (error) {
                  console.log(error.response);
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
      this.customer.ubigee = response.data.ubigee;
      this.customers = {};
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
      return this.responseApi == 'NO HABIDO' ? "text-sm font-weight-light text-danger" : "text-sm font-weight-light text-success";
    } // enableSearchDocument() {
    //   return true
    // },

  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=script&lang=js":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=script&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************/
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


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    BaseUrl: _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"],
    SearchCustomers: _components_SearchCustomers_vue__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  created: function created() {
    var _this = this;

    return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/identificationdocuments").then(function (resp) {
                _this.identificationDocuments = resp.data.data;
              });

            case 2:
              _context.next = 4;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/products").then(function (resp) {
                _this.products = resp.data.data;
              });

            case 4:
              _context.next = 6;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/igvtypes").then(function (resp) {
                _this.igvTypes = resp.data.data;
              });

            case 6:
              _context.next = 8;
              return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/sales/paymenttypes").then(function (resp) {
                _this.paymentTypes = resp.data.data;
                _this.quotationData.quotation.payment_type_id = _this.paymentTypes[0].id;
              });

            case 8:
              _this.getSeries();

            case 9:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }))();
  },
  data: function data() {
    return {
      series: {},
      currentNumber: 'Selecciona una serie',
      paymentTypes: null,
      productSearch: '',
      productSearchFilter: [],
      activateGlobalDiscount: false,
      activateDetailDiscount: false,
      identificationDocuments: [],
      igvTypes: [],
      products: {},
      quotationData: {
        customer: {
          id: null
        },
        quotation: {
          subtotal: 0,
          discount: 0,
          totalIgv: 0,
          totalExonerated: 0,
          totalUnaffected: 0,
          totalFree: 0,
          totalTaxed: 0,
          total: 0,
          discountItems: 0,
          observation: '',
          warranty: false,
          date_due: null,
          serie_id: '',
          payment_type_id: null
        },
        detail: []
      },
      errorsCreate: {}
    };
  },
  mounted: function mounted() {
    var _this2 = this;

    var contain = document.querySelector('.card');
    contain.addEventListener('click', function (e) {
      if (e.target.className != 'inputContent') {
        _this2.productSearchFilter = '';
      }
    });
  },
  methods: {
    getSeries: function getSeries() {
      var _this3 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].get("api/quotations/series").then(function (resp) {
                  _this3.series = resp.data.data;
                  _this3.quotationData.quotation.serie_id = _this3.series[0].id;

                  _this3.getCurrentNumber();
                });

              case 2:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    getCurrentNumber: function getCurrentNumber() {
      var _this4 = this;

      var serieBackup = this.series;
      var serieFilter = serieBackup.filter(function (series) {
        return series.id == _this4.quotationData.quotation.serie_id;
      });
      this.currentNumber = serieFilter[0].current_number + 1;
    },
    searchProducts: function searchProducts() {
      var produtsBackup = this.products;
      var wordFilter = this.productSearch.toLowerCase();

      if (wordFilter === '') {
        this.productSearchFilter = '';
      } else {
        this.productSearchFilter = produtsBackup.filter(function (products) {
          return products.name.toLowerCase().indexOf(wordFilter) !== -1;
        });
      }
    },
    priceOne: function priceOne(filSearch) {
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
        quantity: 1
      };
      this.quotationData.detail.push(product);
      this.productSearch = '';
      this.getTotals();
    },
    priceTwo: function priceTwo(filSearch) {
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
        quantity: 1
      };
      this.quotationData.detail.push(product);
      this.productSearch = '';
      this.getTotals();
    },
    priceThree: function priceThree(filSearch) {
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
        quantity: 1
      };
      this.quotationData.detail.push(product);
      this.productSearch = '';
      this.getTotals();
    },
    deleteItem: function deleteItem(index) {
      this.quotationData.detail.splice(index, 1);
    },
    activateOrDesactivateGlobalDiscount: function activateOrDesactivateGlobalDiscount() {
      // recorrer el array detalle en busca de un descuento
      var discount = 0;
      this.quotationData.detail.forEach(function (e) {
        discount += e.discount * 1;
      }); // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global

      this.activateGlobalDiscount = discount > 0 ? true : false;
    },
    activateOrDesactivateDetailDiscount: function activateOrDesactivateDetailDiscount() {
      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateDetailDiscount = this.quotationData.quotation.discount > 0 ? true : false;
    },
    getTotals: function getTotals() {
      var _this5 = this;

      this.quotationData.quotation.subtotal = 0;
      this.quotationData.quotation.totalIgv = 0;
      this.quotationData.quotation.totalExonerated = 0;
      this.quotationData.quotation.totalUnaffected = 0;
      this.quotationData.quotation.totalFree = 0;
      this.quotationData.quotation.totalTaxed = 0;
      this.quotationData.quotation.total = 0;
      this.quotationData.quotation.discountItems = 0; // igv constante

      var igv = 0.18;
      this.quotationData.detail.forEach(function (e) {
        _this5.quotationData.quotation.discountItems += e.discount;

        switch (parseInt(e.igv_type_id)) {
          case 10:
            //Gravado - Operación Onerosa
            // hallar el precio sin igv
            var priceWithoutIgv = e.sale_price / (1 + igv); // hallar el subtotal = (precio sin igv * cantidad) - descuento

            e.subtotal = parseFloat((priceWithoutIgv * e.quantity).toFixed(2)) - e.discount; // hallar el total = (subtotal * 1.18)

            e.total = parseFloat((e.subtotal * (1 + igv)).toFixed(2)); // Actualizar totales globales

            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalIgv += parseFloat((e.total - e.subtotal).toFixed(2));
            _this5.quotationData.quotation.totalTaxed += e.subtotal;
            _this5.quotationData.quotation.total += e.total;
            break;

          case 11:
            //[Gratuita] Gravado – Retiro por premio
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 12:
            //[Gratuita] Gravado – Retiro por donación
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 13:
            //[Gratuita] Gravado – Retiro
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 14:
            //[Gratuita] Gravado – Retiro por publicidad
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 15:
            //[Gratuita] Gravado – Bonificaciones
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 16:
            //[Gratuita] Gravado – Retiro por entrega a trabajadores
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 20:
            //Exonerado - Operación Onerosa
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalExonerated += e.subtotal;
            _this5.quotationData.quotation.total += e.total;
            break;

          case 30:
            //Inafecto - Operación Onerosa
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalUnaffected += e.subtotal;
            _this5.quotationData.quotation.total += e.total;
            break;

          case 31:
            //[Gratuita] Inafecto – Retiro por Bonificación
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 32:
            //[Gratuita] Inafecto – Retiro
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 33:
            //[Gratuita] Inafecto – Retiro por Muestras Médicas
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 34:
            //[Gratuita] Inafecto - Retiro por Convenio Colectivo
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 35:
            //[Gratuita] Inafecto – Retiro por premio
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 36:
            //[Gratuita] Inafecto - Retiro por publicidad
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalFree += e.total;
            break;

          case 40:
            //Exportación
            e.subtotal = parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount;
            e.total = e.subtotal;
            _this5.quotationData.quotation.subtotal += e.subtotal;
            _this5.quotationData.quotation.totalUnaffected += e.subtotal;
            _this5.quotationData.quotation.total += e.total;
            break;
        }
      });
      this.quotationData.quotation.total = this.quotationData.quotation.total - this.quotationData.quotation.discount;
    },
    createQuotation: function createQuotation() {
      var _this6 = this;

      _api_BaseUrl__WEBPACK_IMPORTED_MODULE_1__["default"].post("/api/quotations", this.quotationData).then(function (response) {
        console.log(response);
        _this6.errorsCreate = {};

        _this6.$router.push({
          name: "quotation-list"
        });

        Swal.fire("Cotización Creada", "Se ha creado la Cotización " + response.data, "success");
      })["catch"](function (error) {
        console.log(error.response);
        _this6.errorsCreate = error.response.data.errors;

        if (_this6.errorsCreate['detail'] != null) {
          Swal.fire("Algo salio mal", _this6.errorsCreate['detail'][0], "error");
        }
      });
    }
  }
});

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
  }, "Datos del Cliente", -1
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
    value: "6"
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
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Nombre/Razón Social:")], -1
  /* HOISTED */
  );
});

var _hoisted_28 = {
  "class": "row"
};
var _hoisted_29 = {
  "class": "col-md-6"
};
var _hoisted_30 = {
  "class": "form-group"
};

var _hoisted_31 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-map-marker-alt"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Dirección")], -1
  /* HOISTED */
  );
});

var _hoisted_32 = {
  "class": "col-md-3"
};
var _hoisted_33 = {
  "class": "form-group"
};

var _hoisted_34 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-globe"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Ubigeo")], -1
  /* HOISTED */
  );
});

var _hoisted_35 = ["value"];
var _hoisted_36 = {
  "class": "col-md-3"
};
var _hoisted_37 = {
  "class": "form-group"
};

var _hoisted_38 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-phone"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" N° Celular")], -1
  /* HOISTED */
  );
});

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [_hoisted_1, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" TIPO DOCUMENTO "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [_hoisted_5, $props.voucherType == 'FACTURA' || $props.voucherType == '01' ? (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)(((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("select", {
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
    "class": "form-control rounded-pill-left",
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
  }, null, 40
  /* PROPS, HYDRATE_EVENTS */
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
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", {
      "class": "item",
      onClick: function onClick($event) {
        return $options.setData(customerFind);
      },
      key: customerFind.id,
      onMousedown: _cache[10] || (_cache[10] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {}, ["prevent"]))
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(customerFind.document) + " - " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(customerFind.name), 41
    /* TEXT, PROPS, HYDRATE_EVENTS */
    , _hoisted_24);
  }), 128
  /* KEYED_FRAGMENT */
  ))])], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.toggle]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" NOMBRE/RAZON SOCIAL "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [_hoisted_27, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $props.customer.name = $event;
    }),
    type: "text",
    "class": "form-control rounded-pill"
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.customer.name]])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" DIRECCIÓN "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [_hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $props.customer.address = $event;
    }),
    type: "text",
    "class": "form-control rounded-pill",
    name: "",
    id: ""
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.customer.address]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" UBIGEO "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [_hoisted_34, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $props.customer.ubigee = $event;
    }),
    "class": "form-control rounded-pill",
    name: ""
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.ubigees, function (ubigee) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: ubigee.id,
      value: ubigee.cod
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(ubigee.place_description), 9
    /* TEXT, PROPS */
    , _hoisted_35);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $props.customer.ubigee]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" N° CELULAR "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [_hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $props.customer.phone = $event;
    }),
    type: "text",
    "class": "form-control rounded-pill",
    name: "",
    id: ""
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.customer.phone]])])])])], 64
  /* STABLE_FRAGMENT */
  );
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-00958cb4"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};

var _hoisted_1 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "content-header"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h3", null, "Registrar Nueva Cotizacion")], -1
  /* HOISTED */
  );
});

var _hoisted_2 = {
  "class": "card"
};
var _hoisted_3 = {
  "class": "card-body"
};

var _hoisted_4 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, "Cotización", -1
  /* HOISTED */
  );
});

var _hoisted_5 = {
  "class": "row"
};
var _hoisted_6 = {
  "class": "col-md-4"
};
var _hoisted_7 = {
  "class": "form-group"
};

var _hoisted_8 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-calendar-times"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Valido Hasta ")], -1
  /* HOISTED */
  );
});

var _hoisted_9 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_10 = {
  "class": "col-md-4"
};
var _hoisted_11 = {
  "class": "form-group"
};

var _hoisted_12 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-barcode"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Serie ")], -1
  /* HOISTED */
  );
});

var _hoisted_13 = ["value"];
var _hoisted_14 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_15 = {
  "class": "col-md-4"
};
var _hoisted_16 = {
  "class": "form-group"
};

var _hoisted_17 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-hashtag"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" N° de Cotización ")], -1
  /* HOISTED */
  );
});

var _hoisted_18 = {
  "class": "row"
};
var _hoisted_19 = {
  "class": "col-md"
};

var _hoisted_20 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-box"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Productos ")], -1
  /* HOISTED */
  );
});

var _hoisted_21 = {
  "class": ""
};
var _hoisted_22 = {
  "class": "option__relative"
};
var _hoisted_23 = {
  "class": "option__contenedor"
};
var _hoisted_24 = {
  table: "",
  "class": "table table-sm table-bordered table-hover bg-white shadow-lg"
};
var _hoisted_25 = {
  key: 0,
  "class": "thead-dark text-center"
};

var _hoisted_26 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Nombre"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Marca"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Precio 1"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Precio 2"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Precio 3"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "Stock")], -1
  /* HOISTED */
  );
});

var _hoisted_27 = [_hoisted_26];
var _hoisted_28 = {
  "class": "col-2 text-center"
};
var _hoisted_29 = {
  "class": "col-2 text-center"
};
var _hoisted_30 = ["value", "onClick"];
var _hoisted_31 = {
  "class": "col-2 text-center"
};
var _hoisted_32 = ["value", "onClick"];
var _hoisted_33 = {
  "class": "col-2 text-center"
};
var _hoisted_34 = ["value", "onClick"];
var _hoisted_35 = {
  "class": "col-1 text-center"
};
var _hoisted_36 = {
  "class": "row"
};
var _hoisted_37 = {
  "class": "col-12 table-responsive mt-4"
};
var _hoisted_38 = {
  "class": "table table-striped"
};

var _hoisted_39 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "40%"
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
      "width": "8%"
    }
  }, "Descuento"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "8%"
    }
  }, "Precio"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "8%"
    }
  }, "Sub Total"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "8%"
    }
  }, "Total"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    style: {
      "width": "3%"
    }
  })])], -1
  /* HOISTED */
  );
});

var _hoisted_40 = ["value"];
var _hoisted_41 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_42 = ["onUpdate:modelValue"];
var _hoisted_43 = ["value"];
var _hoisted_44 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_45 = ["onUpdate:modelValue"];
var _hoisted_46 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_47 = ["onUpdate:modelValue", "disabled"];
var _hoisted_48 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_49 = ["onUpdate:modelValue"];
var _hoisted_50 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_51 = ["value"];
var _hoisted_52 = ["value"];
var _hoisted_53 = ["onClick"];

var _hoisted_54 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-trash"
  }, null, -1
  /* HOISTED */
  );
});

var _hoisted_55 = [_hoisted_54];
var _hoisted_56 = {
  "class": "row"
};
var _hoisted_57 = {
  "class": "col-md-8"
};

var _hoisted_58 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h4", null, "Detalle Documento", -1
  /* HOISTED */
  );
});

var _hoisted_59 = {
  "class": "row"
};
var _hoisted_60 = {
  "class": "col-md"
};
var _hoisted_61 = {
  "class": "form-group"
};

var _hoisted_62 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-money-bill"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Tipo de pago ")], -1
  /* HOISTED */
  );
});

var _hoisted_63 = ["value"];
var _hoisted_64 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_65 = {
  "class": "col-md"
};
var _hoisted_66 = {
  "class": "form-group"
};

var _hoisted_67 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": ""
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-tags"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Descuento ")], -1
  /* HOISTED */
  );
});

var _hoisted_68 = ["disabled"];
var _hoisted_69 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_70 = {
  "class": "col-md-3"
};
var _hoisted_71 = {
  "class": "form-group text-center"
};

var _hoisted_72 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-file-contract"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" ¿Aplica garantía? ")], -1
  /* HOISTED */
  );
});

var _hoisted_73 = {
  "class": "custom-control custom-switch custom-switch-on-danger is-invalid"
};
var _hoisted_74 = {
  "class": "custom-control-label",
  "for": "customSwitchCreate"
};
var _hoisted_75 = {
  key: 0,
  "class": "invalid-feedback"
};
var _hoisted_76 = {
  "class": "row"
};
var _hoisted_77 = {
  "class": "col-md"
};
var _hoisted_78 = {
  "class": "form-group"
};

var _hoisted_79 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "text-danger fas fa-eye"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Observación ")], -1
  /* HOISTED */
  );
});

var _hoisted_80 = {
  "class": "col-md-4"
};
var _hoisted_81 = {
  "class": "table-responsive"
};
var _hoisted_82 = {
  "class": "table"
};

var _hoisted_83 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Descuento global:", -1
  /* HOISTED */
  );
});

var _hoisted_84 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Descuento por item:", -1
  /* HOISTED */
  );
});

var _hoisted_85 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Gravado:", -1
  /* HOISTED */
  );
});

var _hoisted_86 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Exonerado:", -1
  /* HOISTED */
  );
});

var _hoisted_87 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Inafecto:", -1
  /* HOISTED */
  );
});

var _hoisted_88 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Gratuita:", -1
  /* HOISTED */
  );
});

var _hoisted_89 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Igv (18%):", -1
  /* HOISTED */
  );
});

var _hoisted_90 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Total:", -1
  /* HOISTED */
  );
});

var _hoisted_91 = {
  "class": "row no-print"
};
var _hoisted_92 = {
  "class": "col-12"
};

var _hoisted_93 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "submit",
    "class": "btn btn-dark float-right"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("i", {
    "class": "far fa-credit-card"
  }), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Guardar Cotización ")], -1
  /* HOISTED */
  );
});

var _hoisted_94 = [_hoisted_93];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_SearchCustomers = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("SearchCustomers");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [_hoisted_1, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" TIPO DE COMPROBANTE "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "date",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['quotation.date_due'] == null ? '' : ' is-invalid')),
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.quotationData.quotation.date_due = $event;
    }),
    required: ""
  }, null, 2
  /* CLASS */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.quotationData.quotation.date_due]]), $data.errorsCreate['quotation.date_due'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['quotation.date_due'][0]), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" SERIE "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [_hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.quotationData.quotation.serie_id = $event;
    }),
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['quotation.serie_id'] == null ? '' : ' is-invalid')),
    onChange: _cache[2] || (_cache[2] = function ($event) {
      return $options.getCurrentNumber();
    })
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.series, function (serie) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: serie.id,
      value: serie.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(serie.serie), 9
    /* TEXT, PROPS */
    , _hoisted_13);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 34
  /* CLASS, HYDRATE_EVENTS */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.quotationData.quotation.serie_id]]), $data.errorsCreate['quotation.serie_id'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['quotation.serie_id'][0]), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" N° COMPROBANTE "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [_hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $data.currentNumber = $event;
    }),
    type: "text",
    "class": "form-control rounded-pill",
    disabled: ""
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.currentNumber]])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_SearchCustomers, {
    voucherType: 2,
    customer: $data.quotationData.customer
  }, null, 8
  /* PROPS */
  , ["customer"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" COMPONENTE PARA BUSCAR PRODUCTOS "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [_hoisted_20, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "search",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $data.productSearch = $event;
    }),
    onKeyup: _cache[5] || (_cache[5] = function () {
      return $options.searchProducts && $options.searchProducts.apply($options, arguments);
    }),
    "class": "form-control rounded-pill form-control rounded-pill-lg",
    placeholder: "Escribe tu producto o código"
  }, null, 544
  /* HYDRATE_EVENTS, NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.productSearch]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_24, [$data.productSearchFilter.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("thead", _hoisted_25, _hoisted_27)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.productSearchFilter, function (filSearch) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: filSearch
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSearch.name), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_28, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSearch.brand), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "btn btn-sm btn-success w-50",
      type: "button",
      value: filSearch.sale_price,
      onClick: function onClick($event) {
        return $options.priceOne(filSearch);
      }
    }, null, 8
    /* PROPS */
    , _hoisted_30)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_31, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "btn btn-sm btn-warning w-50",
      type: "button",
      value: filSearch.referential_sale_price_one,
      onClick: function onClick($event) {
        return $options.priceTwo(filSearch);
      }
    }, null, 8
    /* PROPS */
    , _hoisted_32)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "btn btn-sm btn-info w-50",
      type: "button",
      value: filSearch.referential_sale_price_two,
      onClick: function onClick($event) {
        return $options.priceThree(filSearch);
      }
    }, null, 8
    /* PROPS */
    , _hoisted_34)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_35, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(filSearch.stock), 1
    /* TEXT */
    )]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])])])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" VER PRODUCTOS SELECCIONADOS "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_38, [_hoisted_39, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.quotationData.detail, function (detail, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: detail
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['detail.' + index + '.product_id'] == null ? '' : ' is-invalid')),
      type: "text",
      value: detail.description + ' - ' + detail.brand + ' - ' + detail.cod,
      disabled: ""
    }, null, 10
    /* CLASS, PROPS */
    , _hoisted_40), $data.errorsCreate['detail.' + index + '.product_id'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_41, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['detail.' + index + '.product_id'][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.igv_type_id = $event;
      },
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['detail.' + index + '.igv_type_id'] == null ? '' : ' is-invalid')),
      onChange: _cache[6] || (_cache[6] = function ($event) {
        return $options.getTotals();
      })
    }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.igvTypes, function (igvType) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
        key: igvType.id,
        value: igvType.id
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(igvType.description), 9
      /* TEXT, PROPS */
      , _hoisted_43);
    }), 128
    /* KEYED_FRAGMENT */
    ))], 42
    /* CLASS, PROPS, HYDRATE_EVENTS */
    , _hoisted_42), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, detail.igv_type_id]]), $data.errorsCreate['detail.' + index + '.igv_type_id'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_44, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['detail.' + index + '.igv_type_id'][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['detail.' + index + '.quantity'] == null ? '' : ' is-invalid')),
      type: "number",
      min: "1",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.quantity = $event;
      },
      onInput: _cache[7] || (_cache[7] = function ($event) {
        return $options.getTotals();
      })
    }, null, 42
    /* CLASS, PROPS, HYDRATE_EVENTS */
    , _hoisted_45), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, detail.quantity]]), $data.errorsCreate['detail.' + index + '.quantity'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_46, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['detail.' + index + '.quantity'][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['detail.' + index + '.discount'] == null ? '' : ' is-invalid')),
      type: "number",
      min: "0",
      step: "0.001",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.discount = $event;
      },
      onChange: _cache[8] || (_cache[8] = function () {
        return $options.activateOrDesactivateGlobalDiscount && $options.activateOrDesactivateGlobalDiscount.apply($options, arguments);
      }),
      disabled: $data.activateDetailDiscount,
      onInput: _cache[9] || (_cache[9] = function ($event) {
        return $options.getTotals();
      })
    }, null, 42
    /* CLASS, PROPS, HYDRATE_EVENTS */
    , _hoisted_47), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, detail.discount]]), $data.errorsCreate['detail.' + index + '.discount'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_48, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['detail.' + index + '.discount'][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['detail.' + index + '.sale_price'] == null ? '' : ' is-invalid')),
      type: "text",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return detail.sale_price = $event;
      },
      disabled: ""
    }, null, 10
    /* CLASS, PROPS */
    , _hoisted_49), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, detail.sale_price]]), $data.errorsCreate['detail.' + index + '.sale_price'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_50, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['detail.' + index + '.sale_price'][0]), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control rounded-pill",
      type: "text",
      disabled: "",
      value: detail.subtotal
    }, null, 8
    /* PROPS */
    , _hoisted_51)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control rounded-pill",
      type: "text",
      disabled: "",
      value: detail.total
    }, null, 8
    /* PROPS */
    , _hoisted_52)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-flat bg-light",
      onClick: function onClick($event) {
        return $options.deleteItem(index);
      }
    }, _hoisted_55, 8
    /* PROPS */
    , _hoisted_53)])]);
  }), 128
  /* KEYED_FRAGMENT */
  ))])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Observación "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [_hoisted_58, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [_hoisted_62, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $data.quotationData.quotation.payment_type_id = $event;
    }),
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['quotation.payment_type_id'] == null ? '' : ' is-invalid'))
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.paymentTypes, function (paymentType) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: paymentType.id,
      value: paymentType.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(paymentType.description), 9
    /* TEXT, PROPS */
    , _hoisted_63);
  }), 128
  /* KEYED_FRAGMENT */
  ))], 2
  /* CLASS */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.quotationData.quotation.payment_type_id]]), $data.errorsCreate['quotation.payment_type_id'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_64, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['quotation.payment_type_id'][0]), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [_hoisted_67, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)('form-control rounded-pill' + ($data.errorsCreate['quotation.discount'] == null ? '' : ' is-invalid')),
    type: "number",
    min: "0",
    step: "0.001",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $data.quotationData.quotation.discount = $event;
    }),
    onChange: _cache[12] || (_cache[12] = function () {
      return $options.activateOrDesactivateDetailDiscount && $options.activateOrDesactivateDetailDiscount.apply($options, arguments);
    }),
    disabled: $data.activateGlobalDiscount,
    onInput: _cache[13] || (_cache[13] = function ($event) {
      return $options.getTotals();
    })
  }, null, 42
  /* CLASS, PROPS, HYDRATE_EVENTS */
  , _hoisted_68), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.quotationData.quotation.discount]]), $data.errorsCreate['quotation.discount'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_69, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['quotation.discount'][0]), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [_hoisted_72, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    "class": "custom-control-input",
    id: "customSwitchCreate",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $data.quotationData.quotation.warranty = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $data.quotationData.quotation.warranty]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_74, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.warranty ? 'Si' : 'No'), 1
  /* TEXT */
  )]), $data.errorsCreate['quotation.warranty'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_75, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.errorsCreate['quotation.warranty'][0]), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [_hoisted_79, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    cols: "30",
    rows: "4",
    "class": "form-control rounded-pill px-5",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $data.quotationData.quotation.observation = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.quotationData.quotation.observation]])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_80, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_82, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_83, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.discount), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.quotationData.quotation.discount > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_84, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.discountItems), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.quotationData.quotation.discountItems > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_85, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.totalTaxed), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.quotationData.quotation.totalTaxed > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_86, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.totalExonerated), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.quotationData.quotation.totalExonerated > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_87, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.totalUnaffected), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.quotationData.quotation.totalUnaffected > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_88, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.totalFree), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.quotationData.quotation.totalFree > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_89, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.totalIgv), 1
  /* TEXT */
  )], 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.quotationData.quotation.totalIgv > 0]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_hoisted_90, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "S/. " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotationData.quotation.total), 1
  /* TEXT */
  )])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Resumen de ventas "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_91, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
    onSubmit: _cache[16] || (_cache[16] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.createQuotation();
    }, ["prevent"]))
  }, _hoisted_94, 32
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
  baseURL: 'http://computo.test:82/'
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (baseUrl);

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
___CSS_LOADER_EXPORT___.push([module.id, "\n.autocomplete[data-v-27533446] {\r\n  position: relative;\r\n  cursor: pointer;\n}\n.list[data-v-27533446] {\r\n  position: absolute;\r\n  background: #fff;\r\n  width: 100%;\r\n  padding: 0;\r\n  z-index: 1000;\n}\n.item[data-v-27533446] {\r\n  border-bottom: 0.1rem solid rgb(180, 180, 180);\r\n  border-left: 0.1rem solid rgb(180, 180, 180);\r\n  border-right: 0.1rem solid rgb(180, 180, 180);\r\n  margin: 0;\r\n  padding: 0.5em 1em;\r\n  text-decoration: none;\r\n  list-style: none;\n}\n.item[data-v-27533446]:hover {\r\n  background: #f2f2f2;\n}\n.rounded-pill-left[data-v-27533446] {\r\n  border-top-left-radius: 50px;\r\n  border-bottom-left-radius: 50px;\n}\n.rounded-pill-right[data-v-27533446] {\r\n  border-top-right-radius: 50px;\r\n  border-bottom-right-radius: 50px;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
___CSS_LOADER_EXPORT___.push([module.id, "\n.btn.btn-dark[data-v-00958cb4] {\r\n  border-top-right-radius: 23px;\r\n  border-bottom-right-radius: 23px;\r\n  background: #536976; /* fallback for old browsers */ /* Chrome 10-25, Safari 5.1-6 */\r\n  background: linear-gradient(\r\n    to right,\r\n    #292e49,\r\n    #536976\r\n  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */\n}\nlabel[data-v-00958cb4] {\r\n  color: rgba(48, 48, 48, 0.774);\r\n  font-weight: 300;\n}\n.option__relative[data-v-00958cb4]{\r\n  position: relative;\r\n  z-index: 99;\n}\n.option__contenedor[data-v-00958cb4]{\r\n  box-sizing: border-box;\r\n  border-radius: 5px;\r\n  width: 100%;\r\n  max-height: 200px;\r\n  box-shadow: 0 0 2px 0 rgb(128,189,255);\r\n  background-color: #fff;\r\n  box-sizing: border-box;\r\n  cursor: pointer;\r\n  overflow-y: scroll;\r\n  position: absolute;\r\n  z-index: 100;\n}\n.option__contenedor input[data-v-00958cb4],.search input[data-v-00958cb4]{\r\n  display: block;\r\n  margin-left: auto;\r\n  margin-right: auto;\r\n  /*border-color: #93a8c3;*/\r\n  outline-color: rgb(128,189,255);\r\n  border-style: solid;\r\n  border-width: 1px;\r\n  /*color:rgb(172,173,182)*/\n}\n.option__contenedor table[data-v-00958cb4]{\r\n  width: 100%;\r\n  padding:8px 10px ;\r\n  margin: 0;\n}\n.option__contenedor[data-v-00958cb4]::-webkit-scrollbar{\r\n  width: 7px;\r\n  background-color: rgb(128,189,255)\n}\n.option__contenedor[data-v-00958cb4]::-webkit-scrollbar-thumb{\r\n  background-color: rgb(255, 255, 255);\r\n  border-radius: 10px;\r\n  border-right: 1px solid rgb(128,189,255);\r\n  border-left: 1px solid rgb(128,189,255);\n}\n.search .option__contenedor[data-v-00958cb4]{\r\n  top: 0;\n}\n.search input[data-v-00958cb4]{\r\n  width: 100%;\r\n  height: 40px;\r\n  border-radius: 5px;\n}\r\n", ""]);
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

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_style_index_0_id_00958cb4_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_style_index_0_id_00958cb4_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_style_index_0_id_00958cb4_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

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

/***/ "./resources/js/modules/sales/quotations/pages/NewQuotation.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/modules/sales/quotations/pages/NewQuotation.vue ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _NewQuotation_vue_vue_type_template_id_00958cb4_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true */ "./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true");
/* harmony import */ var _NewQuotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./NewQuotation.vue?vue&type=script&lang=js */ "./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=script&lang=js");
/* harmony import */ var _NewQuotation_vue_vue_type_style_index_0_id_00958cb4_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css */ "./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css");
/* harmony import */ var C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,C_laragon_www_computo_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_NewQuotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_NewQuotation_vue_vue_type_template_id_00958cb4_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-00958cb4"],['__file',"resources/js/modules/sales/quotations/pages/NewQuotation.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

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

/***/ "./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=script&lang=js":
/*!**********************************************************************************************!*\
  !*** ./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewQuotation.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=script&lang=js");
 

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

/***/ "./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true":
/*!****************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true ***!
  \****************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_template_id_00958cb4_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_template_id_00958cb4_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=template&id=00958cb4&scoped=true");


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

/***/ "./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css":
/*!******************************************************************************************************************************!*\
  !*** ./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css ***!
  \******************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NewQuotation_vue_vue_type_style_index_0_id_00958cb4_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/sales/quotations/pages/NewQuotation.vue?vue&type=style&index=0&id=00958cb4&scoped=true&lang=css");


/***/ })

}]);