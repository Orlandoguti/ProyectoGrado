(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "../node_modules/babel-loader/lib/index.js?!../node_modules/vue-loader/lib/index.js?!../resources/js/components/RfidRead.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************************************!*\
  !*** /laragon/www/Proyecto_Grado/node_modules/babel-loader/lib??ref--4-0!/laragon/www/Proyecto_Grado/node_modules/vue-loader/lib??vue-loader-options!/laragon/www/Proyecto_Grado/resources/js/components/RfidRead.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! moment */ "../node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "../node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      webSocket: null,
      rfidData: '',
      grupo: 'Grupo 1',
      nombre: '',
      gnombre: '',
      estado: '',
      idgrupo: '',
      idgenero: '',
      fecha: '',
      marca: '',
      pagination: {
        'total': 0,
        'current_page': 0,
        'per_page': 0,
        'last_page': 0,
        'from': 0,
        'to': 0
      },
      offset: 3,
      arrayRfid: [],
      arrayLista: [],
      arrayGrupo: []
    };
  },
  computed: {
    arrayListaFiltrada: function arrayListaFiltrada() {
      var _this = this;
      var listaFiltrada = this.arrayLista;
      if (this.grupo) {
        // Filtrar por grupo seleccionado
        listaFiltrada = listaFiltrada.filter(function (lista) {
          return lista.gnombre === _this.grupo;
        });
      }
      if (this.fechaFiltro) {
        // Filtrar por fecha seleccionada
        listaFiltrada = listaFiltrada.filter(function (lista) {
          return lista.fecha === _this.fechaFiltro;
        });
      }
      return listaFiltrada;
    },
    isActived: function isActived() {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function pagesNumber() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  watch: {
    rfidData: function rfidData(newVal) {
      if (newVal) {
        this.autollenarCampos(newVal);
      }
    }
  },
  methods: {
    seleccionarGrupo: function seleccionarGrupo(grupoId) {
      this.grupo = grupoId;
      this.fechaFiltro = moment__WEBPACK_IMPORTED_MODULE_0___default()().format('YYYY-MM-DD');
      this.cambiarPagina(1);
    },
    autollenarCampos: function autollenarCampos() {
      var _this2 = this;
      var rfidId = this.rfidData;
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.post('/rfid/ver', {
        rfidData: rfidId
      }).then(function (response) {
        var data = response.data;
        if (data.estado == 1 || data.estado == 2) {
          // Mostrar estado de la Tarjeta.
          alert("El Registro de la tarjeta est\xE1 en proceso de Faneo. Estado: ".concat(data.estado));
          _this2.rfidData = 0;
          _this2.nombre = '';
          _this2.marca = '';
          _this2.gnombre = '';
          _this2.fecha = '';
        } else {
          _this2.estado = data.estado;
          _this2.idgenero = data.idgenero;
          _this2.idpersona = data.idpersona;
          _this2.gnombre = data.gnombre;
          _this2.nombre = data.nombre;
          _this2.marca = data.marca;
          _this2.fecha = data.fecha;
          // Realizar la verificación de marca en la lista
          _this2.verificarMarcaEnLista();
        }
      })["catch"](function (error) {
        console.error(error);
      });
    },
    verificarMarcaEnLista: function verificarMarcaEnLista() {
      var _this3 = this;
      // Verificar si la marca en la lista es la misma que la marca en la lectura RFID
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get('/listaVerificar', {
        params: {
          idpersona: this.idpersona
        }
      }).then(function (response) {
        var registros = response.data.arrayListaFiltrada;
        if (registros.length > 0) {
          _this3.registrarProceso();
          _this3.listaProceso1(1, _this3.fechaFiltro = moment__WEBPACK_IMPORTED_MODULE_0___default()().format('YYYY-MM-DD'));
        } else {
          _this3.rfidData = 0;
          _this3.nombre = '';
          _this3.marca = '';
          _this3.gnombre = '';
          _this3.fecha = '';
          alert("El registro No se encuentra en listas para Fanearlo.");
        }
      })["catch"](function (error) {
        console.error(error);
      });
    },
    selectGrupo: function selectGrupo() {
      var me = this;
      var url = '/grupo/selectGrupo';
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get(url).then(function (response) {
        //console.log(response);
        var respuesta = response.data;
        me.arrayGrupo = respuesta.grupos;
      })["catch"](function (error) {
        console.log(error);
      });
    },
    registrarProceso: function registrarProceso() {
      if (this.rfidData == 0) {
        return;
      }
      var me = this;
      var datosLista = {
        rfidData: this.rfidData,
        cantidad: this.cantidad,
        idpersona: this.idpersona,
        idgrupo: this.idgrupo,
        idgenero: this.idgenero,
        estado: this.estado,
        marca: this.marca,
        fecha: this.fecha
      };
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.post('/rfid/proceso1', datosLista).then(function (response) {
        // Encender el LED en el ESP8266
        me.webSocket.send('Encender LED');
        swal('Registrado!', 'Se ha actualizado la Lista.', 'warning');
        // Apagar el LED después de 1 segundo
        setTimeout(function () {
          me.webSocket.send('Apagar LED');
        }, 5000);
        axios__WEBPACK_IMPORTED_MODULE_1___default.a.post('/rfid/actualizarIdGeneroLista', datosLista);
        // Restablecer los valores
        me.rfidData = 0;
        me.nombre = '';
        me.marca = '';
        me.gnombre = '';
        me.fecha = '';
      })["catch"](function (error) {
        swal('Error!', 'No se ha podido actualizar la Lista.', 'warning');
        console.log(error);
      });
    },
    listaProceso1: function listaProceso1(page) {
      var me = this;
      var url = "/listaProceso1?page=".concat(page, "&grupo=").concat(this.grupo, "&fechaFiltro=").concat(this.fechaFiltro);
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get(url).then(function (response) {
        var respuesta = response.data;
        me.arrayLista = respuesta.listas.data;
        me.pagination = respuesta.pagination;
      })["catch"](function (error) {
        console.log(error);
      });
    },
    cambiarPagina: function cambiarPagina(page) {
      var me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listaProceso1(page);
    },
    initializeWebSocket: function initializeWebSocket() {
      var _this4 = this;
      this.webSocket = new WebSocket('ws://192.168.100.117:81/', ['arduino']);
      this.webSocket.onopen = function () {
        console.log('Connected to WebSocket server');
        _this4.webSocket.send('Connect ' + new Date());
      };
      this.webSocket.onerror = function (error) {
        console.error('WebSocket Error', error);
      };
      this.webSocket.onmessage = function (event) {
        console.log('Received message:', event.data);
        _this4.rfidData = event.data; // Asignar el mensaje del WebSocket a la variable rfidData
      };
    },
    closeWebSocket: function closeWebSocket() {
      if (this.webSocket) {
        this.webSocket.close(); // Cerrar el WebSocket
      }
    }
  },
  beforeDestroy: function beforeDestroy() {
    this.closeWebSocket(); // Cerrar el WebSocket antes de destruir el componente
  },
  mounted: function mounted() {
    this.initializeWebSocket();
    this.listaProceso1(1, this.fechaFiltro = moment__WEBPACK_IMPORTED_MODULE_0___default()().format('YYYY-MM-DD'), this.grupo);
    this.selectGrupo();
  }
});

/***/ }),

/***/ "../node_modules/moment/locale sync recursive ^\\.\\/.*$":
/*!****************************************************************************!*\
  !*** /laragon/www/Proyecto_Grado/node_modules/moment/locale sync ^\.\/.*$ ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var map = {
	"./af": "../node_modules/moment/locale/af.js",
	"./af.js": "../node_modules/moment/locale/af.js",
	"./ar": "../node_modules/moment/locale/ar.js",
	"./ar-dz": "../node_modules/moment/locale/ar-dz.js",
	"./ar-dz.js": "../node_modules/moment/locale/ar-dz.js",
	"./ar-kw": "../node_modules/moment/locale/ar-kw.js",
	"./ar-kw.js": "../node_modules/moment/locale/ar-kw.js",
	"./ar-ly": "../node_modules/moment/locale/ar-ly.js",
	"./ar-ly.js": "../node_modules/moment/locale/ar-ly.js",
	"./ar-ma": "../node_modules/moment/locale/ar-ma.js",
	"./ar-ma.js": "../node_modules/moment/locale/ar-ma.js",
	"./ar-sa": "../node_modules/moment/locale/ar-sa.js",
	"./ar-sa.js": "../node_modules/moment/locale/ar-sa.js",
	"./ar-tn": "../node_modules/moment/locale/ar-tn.js",
	"./ar-tn.js": "../node_modules/moment/locale/ar-tn.js",
	"./ar.js": "../node_modules/moment/locale/ar.js",
	"./az": "../node_modules/moment/locale/az.js",
	"./az.js": "../node_modules/moment/locale/az.js",
	"./be": "../node_modules/moment/locale/be.js",
	"./be.js": "../node_modules/moment/locale/be.js",
	"./bg": "../node_modules/moment/locale/bg.js",
	"./bg.js": "../node_modules/moment/locale/bg.js",
	"./bm": "../node_modules/moment/locale/bm.js",
	"./bm.js": "../node_modules/moment/locale/bm.js",
	"./bn": "../node_modules/moment/locale/bn.js",
	"./bn-bd": "../node_modules/moment/locale/bn-bd.js",
	"./bn-bd.js": "../node_modules/moment/locale/bn-bd.js",
	"./bn.js": "../node_modules/moment/locale/bn.js",
	"./bo": "../node_modules/moment/locale/bo.js",
	"./bo.js": "../node_modules/moment/locale/bo.js",
	"./br": "../node_modules/moment/locale/br.js",
	"./br.js": "../node_modules/moment/locale/br.js",
	"./bs": "../node_modules/moment/locale/bs.js",
	"./bs.js": "../node_modules/moment/locale/bs.js",
	"./ca": "../node_modules/moment/locale/ca.js",
	"./ca.js": "../node_modules/moment/locale/ca.js",
	"./cs": "../node_modules/moment/locale/cs.js",
	"./cs.js": "../node_modules/moment/locale/cs.js",
	"./cv": "../node_modules/moment/locale/cv.js",
	"./cv.js": "../node_modules/moment/locale/cv.js",
	"./cy": "../node_modules/moment/locale/cy.js",
	"./cy.js": "../node_modules/moment/locale/cy.js",
	"./da": "../node_modules/moment/locale/da.js",
	"./da.js": "../node_modules/moment/locale/da.js",
	"./de": "../node_modules/moment/locale/de.js",
	"./de-at": "../node_modules/moment/locale/de-at.js",
	"./de-at.js": "../node_modules/moment/locale/de-at.js",
	"./de-ch": "../node_modules/moment/locale/de-ch.js",
	"./de-ch.js": "../node_modules/moment/locale/de-ch.js",
	"./de.js": "../node_modules/moment/locale/de.js",
	"./dv": "../node_modules/moment/locale/dv.js",
	"./dv.js": "../node_modules/moment/locale/dv.js",
	"./el": "../node_modules/moment/locale/el.js",
	"./el.js": "../node_modules/moment/locale/el.js",
	"./en-au": "../node_modules/moment/locale/en-au.js",
	"./en-au.js": "../node_modules/moment/locale/en-au.js",
	"./en-ca": "../node_modules/moment/locale/en-ca.js",
	"./en-ca.js": "../node_modules/moment/locale/en-ca.js",
	"./en-gb": "../node_modules/moment/locale/en-gb.js",
	"./en-gb.js": "../node_modules/moment/locale/en-gb.js",
	"./en-ie": "../node_modules/moment/locale/en-ie.js",
	"./en-ie.js": "../node_modules/moment/locale/en-ie.js",
	"./en-il": "../node_modules/moment/locale/en-il.js",
	"./en-il.js": "../node_modules/moment/locale/en-il.js",
	"./en-in": "../node_modules/moment/locale/en-in.js",
	"./en-in.js": "../node_modules/moment/locale/en-in.js",
	"./en-nz": "../node_modules/moment/locale/en-nz.js",
	"./en-nz.js": "../node_modules/moment/locale/en-nz.js",
	"./en-sg": "../node_modules/moment/locale/en-sg.js",
	"./en-sg.js": "../node_modules/moment/locale/en-sg.js",
	"./eo": "../node_modules/moment/locale/eo.js",
	"./eo.js": "../node_modules/moment/locale/eo.js",
	"./es": "../node_modules/moment/locale/es.js",
	"./es-do": "../node_modules/moment/locale/es-do.js",
	"./es-do.js": "../node_modules/moment/locale/es-do.js",
	"./es-mx": "../node_modules/moment/locale/es-mx.js",
	"./es-mx.js": "../node_modules/moment/locale/es-mx.js",
	"./es-us": "../node_modules/moment/locale/es-us.js",
	"./es-us.js": "../node_modules/moment/locale/es-us.js",
	"./es.js": "../node_modules/moment/locale/es.js",
	"./et": "../node_modules/moment/locale/et.js",
	"./et.js": "../node_modules/moment/locale/et.js",
	"./eu": "../node_modules/moment/locale/eu.js",
	"./eu.js": "../node_modules/moment/locale/eu.js",
	"./fa": "../node_modules/moment/locale/fa.js",
	"./fa.js": "../node_modules/moment/locale/fa.js",
	"./fi": "../node_modules/moment/locale/fi.js",
	"./fi.js": "../node_modules/moment/locale/fi.js",
	"./fil": "../node_modules/moment/locale/fil.js",
	"./fil.js": "../node_modules/moment/locale/fil.js",
	"./fo": "../node_modules/moment/locale/fo.js",
	"./fo.js": "../node_modules/moment/locale/fo.js",
	"./fr": "../node_modules/moment/locale/fr.js",
	"./fr-ca": "../node_modules/moment/locale/fr-ca.js",
	"./fr-ca.js": "../node_modules/moment/locale/fr-ca.js",
	"./fr-ch": "../node_modules/moment/locale/fr-ch.js",
	"./fr-ch.js": "../node_modules/moment/locale/fr-ch.js",
	"./fr.js": "../node_modules/moment/locale/fr.js",
	"./fy": "../node_modules/moment/locale/fy.js",
	"./fy.js": "../node_modules/moment/locale/fy.js",
	"./ga": "../node_modules/moment/locale/ga.js",
	"./ga.js": "../node_modules/moment/locale/ga.js",
	"./gd": "../node_modules/moment/locale/gd.js",
	"./gd.js": "../node_modules/moment/locale/gd.js",
	"./gl": "../node_modules/moment/locale/gl.js",
	"./gl.js": "../node_modules/moment/locale/gl.js",
	"./gom-deva": "../node_modules/moment/locale/gom-deva.js",
	"./gom-deva.js": "../node_modules/moment/locale/gom-deva.js",
	"./gom-latn": "../node_modules/moment/locale/gom-latn.js",
	"./gom-latn.js": "../node_modules/moment/locale/gom-latn.js",
	"./gu": "../node_modules/moment/locale/gu.js",
	"./gu.js": "../node_modules/moment/locale/gu.js",
	"./he": "../node_modules/moment/locale/he.js",
	"./he.js": "../node_modules/moment/locale/he.js",
	"./hi": "../node_modules/moment/locale/hi.js",
	"./hi.js": "../node_modules/moment/locale/hi.js",
	"./hr": "../node_modules/moment/locale/hr.js",
	"./hr.js": "../node_modules/moment/locale/hr.js",
	"./hu": "../node_modules/moment/locale/hu.js",
	"./hu.js": "../node_modules/moment/locale/hu.js",
	"./hy-am": "../node_modules/moment/locale/hy-am.js",
	"./hy-am.js": "../node_modules/moment/locale/hy-am.js",
	"./id": "../node_modules/moment/locale/id.js",
	"./id.js": "../node_modules/moment/locale/id.js",
	"./is": "../node_modules/moment/locale/is.js",
	"./is.js": "../node_modules/moment/locale/is.js",
	"./it": "../node_modules/moment/locale/it.js",
	"./it-ch": "../node_modules/moment/locale/it-ch.js",
	"./it-ch.js": "../node_modules/moment/locale/it-ch.js",
	"./it.js": "../node_modules/moment/locale/it.js",
	"./ja": "../node_modules/moment/locale/ja.js",
	"./ja.js": "../node_modules/moment/locale/ja.js",
	"./jv": "../node_modules/moment/locale/jv.js",
	"./jv.js": "../node_modules/moment/locale/jv.js",
	"./ka": "../node_modules/moment/locale/ka.js",
	"./ka.js": "../node_modules/moment/locale/ka.js",
	"./kk": "../node_modules/moment/locale/kk.js",
	"./kk.js": "../node_modules/moment/locale/kk.js",
	"./km": "../node_modules/moment/locale/km.js",
	"./km.js": "../node_modules/moment/locale/km.js",
	"./kn": "../node_modules/moment/locale/kn.js",
	"./kn.js": "../node_modules/moment/locale/kn.js",
	"./ko": "../node_modules/moment/locale/ko.js",
	"./ko.js": "../node_modules/moment/locale/ko.js",
	"./ku": "../node_modules/moment/locale/ku.js",
	"./ku.js": "../node_modules/moment/locale/ku.js",
	"./ky": "../node_modules/moment/locale/ky.js",
	"./ky.js": "../node_modules/moment/locale/ky.js",
	"./lb": "../node_modules/moment/locale/lb.js",
	"./lb.js": "../node_modules/moment/locale/lb.js",
	"./lo": "../node_modules/moment/locale/lo.js",
	"./lo.js": "../node_modules/moment/locale/lo.js",
	"./lt": "../node_modules/moment/locale/lt.js",
	"./lt.js": "../node_modules/moment/locale/lt.js",
	"./lv": "../node_modules/moment/locale/lv.js",
	"./lv.js": "../node_modules/moment/locale/lv.js",
	"./me": "../node_modules/moment/locale/me.js",
	"./me.js": "../node_modules/moment/locale/me.js",
	"./mi": "../node_modules/moment/locale/mi.js",
	"./mi.js": "../node_modules/moment/locale/mi.js",
	"./mk": "../node_modules/moment/locale/mk.js",
	"./mk.js": "../node_modules/moment/locale/mk.js",
	"./ml": "../node_modules/moment/locale/ml.js",
	"./ml.js": "../node_modules/moment/locale/ml.js",
	"./mn": "../node_modules/moment/locale/mn.js",
	"./mn.js": "../node_modules/moment/locale/mn.js",
	"./mr": "../node_modules/moment/locale/mr.js",
	"./mr.js": "../node_modules/moment/locale/mr.js",
	"./ms": "../node_modules/moment/locale/ms.js",
	"./ms-my": "../node_modules/moment/locale/ms-my.js",
	"./ms-my.js": "../node_modules/moment/locale/ms-my.js",
	"./ms.js": "../node_modules/moment/locale/ms.js",
	"./mt": "../node_modules/moment/locale/mt.js",
	"./mt.js": "../node_modules/moment/locale/mt.js",
	"./my": "../node_modules/moment/locale/my.js",
	"./my.js": "../node_modules/moment/locale/my.js",
	"./nb": "../node_modules/moment/locale/nb.js",
	"./nb.js": "../node_modules/moment/locale/nb.js",
	"./ne": "../node_modules/moment/locale/ne.js",
	"./ne.js": "../node_modules/moment/locale/ne.js",
	"./nl": "../node_modules/moment/locale/nl.js",
	"./nl-be": "../node_modules/moment/locale/nl-be.js",
	"./nl-be.js": "../node_modules/moment/locale/nl-be.js",
	"./nl.js": "../node_modules/moment/locale/nl.js",
	"./nn": "../node_modules/moment/locale/nn.js",
	"./nn.js": "../node_modules/moment/locale/nn.js",
	"./oc-lnc": "../node_modules/moment/locale/oc-lnc.js",
	"./oc-lnc.js": "../node_modules/moment/locale/oc-lnc.js",
	"./pa-in": "../node_modules/moment/locale/pa-in.js",
	"./pa-in.js": "../node_modules/moment/locale/pa-in.js",
	"./pl": "../node_modules/moment/locale/pl.js",
	"./pl.js": "../node_modules/moment/locale/pl.js",
	"./pt": "../node_modules/moment/locale/pt.js",
	"./pt-br": "../node_modules/moment/locale/pt-br.js",
	"./pt-br.js": "../node_modules/moment/locale/pt-br.js",
	"./pt.js": "../node_modules/moment/locale/pt.js",
	"./ro": "../node_modules/moment/locale/ro.js",
	"./ro.js": "../node_modules/moment/locale/ro.js",
	"./ru": "../node_modules/moment/locale/ru.js",
	"./ru.js": "../node_modules/moment/locale/ru.js",
	"./sd": "../node_modules/moment/locale/sd.js",
	"./sd.js": "../node_modules/moment/locale/sd.js",
	"./se": "../node_modules/moment/locale/se.js",
	"./se.js": "../node_modules/moment/locale/se.js",
	"./si": "../node_modules/moment/locale/si.js",
	"./si.js": "../node_modules/moment/locale/si.js",
	"./sk": "../node_modules/moment/locale/sk.js",
	"./sk.js": "../node_modules/moment/locale/sk.js",
	"./sl": "../node_modules/moment/locale/sl.js",
	"./sl.js": "../node_modules/moment/locale/sl.js",
	"./sq": "../node_modules/moment/locale/sq.js",
	"./sq.js": "../node_modules/moment/locale/sq.js",
	"./sr": "../node_modules/moment/locale/sr.js",
	"./sr-cyrl": "../node_modules/moment/locale/sr-cyrl.js",
	"./sr-cyrl.js": "../node_modules/moment/locale/sr-cyrl.js",
	"./sr.js": "../node_modules/moment/locale/sr.js",
	"./ss": "../node_modules/moment/locale/ss.js",
	"./ss.js": "../node_modules/moment/locale/ss.js",
	"./sv": "../node_modules/moment/locale/sv.js",
	"./sv.js": "../node_modules/moment/locale/sv.js",
	"./sw": "../node_modules/moment/locale/sw.js",
	"./sw.js": "../node_modules/moment/locale/sw.js",
	"./ta": "../node_modules/moment/locale/ta.js",
	"./ta.js": "../node_modules/moment/locale/ta.js",
	"./te": "../node_modules/moment/locale/te.js",
	"./te.js": "../node_modules/moment/locale/te.js",
	"./tet": "../node_modules/moment/locale/tet.js",
	"./tet.js": "../node_modules/moment/locale/tet.js",
	"./tg": "../node_modules/moment/locale/tg.js",
	"./tg.js": "../node_modules/moment/locale/tg.js",
	"./th": "../node_modules/moment/locale/th.js",
	"./th.js": "../node_modules/moment/locale/th.js",
	"./tk": "../node_modules/moment/locale/tk.js",
	"./tk.js": "../node_modules/moment/locale/tk.js",
	"./tl-ph": "../node_modules/moment/locale/tl-ph.js",
	"./tl-ph.js": "../node_modules/moment/locale/tl-ph.js",
	"./tlh": "../node_modules/moment/locale/tlh.js",
	"./tlh.js": "../node_modules/moment/locale/tlh.js",
	"./tr": "../node_modules/moment/locale/tr.js",
	"./tr.js": "../node_modules/moment/locale/tr.js",
	"./tzl": "../node_modules/moment/locale/tzl.js",
	"./tzl.js": "../node_modules/moment/locale/tzl.js",
	"./tzm": "../node_modules/moment/locale/tzm.js",
	"./tzm-latn": "../node_modules/moment/locale/tzm-latn.js",
	"./tzm-latn.js": "../node_modules/moment/locale/tzm-latn.js",
	"./tzm.js": "../node_modules/moment/locale/tzm.js",
	"./ug-cn": "../node_modules/moment/locale/ug-cn.js",
	"./ug-cn.js": "../node_modules/moment/locale/ug-cn.js",
	"./uk": "../node_modules/moment/locale/uk.js",
	"./uk.js": "../node_modules/moment/locale/uk.js",
	"./ur": "../node_modules/moment/locale/ur.js",
	"./ur.js": "../node_modules/moment/locale/ur.js",
	"./uz": "../node_modules/moment/locale/uz.js",
	"./uz-latn": "../node_modules/moment/locale/uz-latn.js",
	"./uz-latn.js": "../node_modules/moment/locale/uz-latn.js",
	"./uz.js": "../node_modules/moment/locale/uz.js",
	"./vi": "../node_modules/moment/locale/vi.js",
	"./vi.js": "../node_modules/moment/locale/vi.js",
	"./x-pseudo": "../node_modules/moment/locale/x-pseudo.js",
	"./x-pseudo.js": "../node_modules/moment/locale/x-pseudo.js",
	"./yo": "../node_modules/moment/locale/yo.js",
	"./yo.js": "../node_modules/moment/locale/yo.js",
	"./zh-cn": "../node_modules/moment/locale/zh-cn.js",
	"./zh-cn.js": "../node_modules/moment/locale/zh-cn.js",
	"./zh-hk": "../node_modules/moment/locale/zh-hk.js",
	"./zh-hk.js": "../node_modules/moment/locale/zh-hk.js",
	"./zh-mo": "../node_modules/moment/locale/zh-mo.js",
	"./zh-mo.js": "../node_modules/moment/locale/zh-mo.js",
	"./zh-tw": "../node_modules/moment/locale/zh-tw.js",
	"./zh-tw.js": "../node_modules/moment/locale/zh-tw.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "../node_modules/moment/locale sync recursive ^\\.\\/.*$";

/***/ }),

/***/ "../node_modules/vue-loader/lib/loaders/templateLoader.js?!../node_modules/vue-loader/lib/index.js?!../resources/js/components/RfidRead.vue?vue&type=template&id=712c9120&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** /laragon/www/Proyecto_Grado/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!/laragon/www/Proyecto_Grado/node_modules/vue-loader/lib??vue-loader-options!/laragon/www/Proyecto_Grado/resources/js/components/RfidRead.vue?vue&type=template&id=712c9120& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("section", { staticClass: "responsive" }, [
    _c("ol", { staticClass: "breadcrumb" }),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "container-fluid" },
      [
        [
          _vm._m(0),
          _vm._v(" "),
          _c("div", { staticClass: "container-fluid" }, [
            _c("div", { staticClass: "card" }, [
              _vm._m(1),
              _vm._v(" "),
              _c("div", { attrs: { id: "show_user_data" } }, [
                _c(
                  "form",
                  {
                    staticClass: "form-horizontal",
                    attrs: {
                      action: "",
                      method: "post",
                      enctype: "multipart/form-data",
                    },
                  },
                  [
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-md-3 form-control-label",
                          attrs: { for: "text-input" },
                        },
                        [_vm._v("ID :")]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-md-5" }, [
                        _c("div", { attrs: { id: "app" } }, [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.rfidData,
                                expression: "rfidData",
                              },
                            ],
                            attrs: { type: "text" },
                            domProps: { value: _vm.rfidData },
                            on: {
                              input: [
                                function ($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.rfidData = $event.target.value
                                },
                                _vm.autollenarCampos,
                              ],
                            },
                          }),
                        ]),
                      ]),
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-md-3 form-control-label",
                          attrs: { for: "text-input" },
                        },
                        [_vm._v("Nombre :")]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-md-5" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.nombre,
                              expression: "nombre",
                            },
                          ],
                          staticClass: "form-control",
                          attrs: {
                            name: "nombre",
                            id: "nombre",
                            type: "text",
                            placeholder: "Nombre",
                            disabled: "",
                          },
                          domProps: { value: _vm.nombre },
                          on: {
                            input: function ($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.nombre = $event.target.value
                            },
                          },
                        }),
                      ]),
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-md-3 form-control-label",
                          attrs: { for: "text-input" },
                        },
                        [_vm._v("Marca :")]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-md-5" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.marca,
                              expression: "marca",
                            },
                          ],
                          staticClass: "form-control",
                          attrs: {
                            name: "marca",
                            id: "marca",
                            type: "text",
                            placeholder: "Marca",
                            disabled: "",
                          },
                          domProps: { value: _vm.marca },
                          on: {
                            input: function ($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.marca = $event.target.value
                            },
                          },
                        }),
                      ]),
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-md-3 form-control-label",
                          attrs: { for: "text-input" },
                        },
                        [_vm._v("Genero :")]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-md-5" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.gnombre,
                              expression: "gnombre",
                            },
                          ],
                          staticClass: "form-control",
                          attrs: {
                            name: "estado",
                            id: "estado",
                            type: "text",
                            placeholder: "Genero del Ganado",
                            disabled: "",
                          },
                          domProps: { value: _vm.gnombre },
                          on: {
                            input: function ($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.gnombre = $event.target.value
                            },
                          },
                        }),
                      ]),
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group row" }, [
                      _c(
                        "label",
                        {
                          staticClass: "col-md-3 form-control-label",
                          attrs: { for: "email-input" },
                        },
                        [_vm._v("Fecha :")]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-md-9" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.fecha,
                              expression: "fecha",
                            },
                          ],
                          staticClass: "form-control",
                          attrs: {
                            name: "date",
                            id: "date",
                            type: "date",
                            placeholder: "Fecha de Registro",
                            disabled: "",
                          },
                          domProps: { value: _vm.fecha },
                          on: {
                            input: function ($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.fecha = $event.target.value
                            },
                          },
                        }),
                      ]),
                    ]),
                  ]
                ),
              ]),
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "card-body" }, [
              _c("div", { staticClass: "form-group row" }, [
                _c("div", { staticClass: "col-md-9" }, [
                  _c(
                    "div",
                    { staticClass: "button-container" },
                    _vm._l(_vm.arrayGrupo, function (grupo) {
                      return grupo.id >= 1
                        ? _c(
                            "button",
                            {
                              key: grupo.id,
                              class: { active: grupo === grupo.nombre },
                              on: {
                                click: function ($event) {
                                  return _vm.seleccionarGrupo(grupo.nombre)
                                },
                              },
                            },
                            [
                              _vm._v(
                                "\n                        " +
                                  _vm._s(grupo.nombre) +
                                  "\n                      "
                              ),
                            ]
                          )
                        : _vm._e()
                    }),
                    0
                  ),
                ]),
              ]),
            ]),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass:
                  "mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop",
              },
              [
                _c("div", { staticClass: "table-responsive" }, [
                  _c(
                    "table",
                    {
                      staticClass:
                        "mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive",
                    },
                    [
                      _vm._m(2),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.arrayListaFiltrada, function (lista) {
                          return _c("tr", { key: lista.id }, [
                            _c("td", {
                              domProps: { textContent: _vm._s(lista.gnombre) },
                            }),
                            _vm._v(" "),
                            _c("td", {
                              domProps: { textContent: _vm._s(lista.marca) },
                            }),
                            _vm._v(" "),
                            _c("td", {
                              domProps: {
                                textContent: _vm._s(lista.total_cantidad),
                              },
                            }),
                            _vm._v(" "),
                            _c("td", {
                              domProps: { textContent: _vm._s(lista.gnombre) },
                            }),
                            _vm._v(" "),
                            _c("td", {
                              domProps: { textContent: _vm._s(lista.ganados) },
                            }),
                            _vm._v(" "),
                            _c("td", {
                              domProps: { textContent: _vm._s(lista.fecha) },
                            }),
                            _vm._v(" "),
                            _c("td", [
                              _c(
                                "button",
                                {
                                  staticClass: "btn btn-warning btn-sm",
                                  attrs: { type: "button" },
                                  on: {
                                    click: function ($event) {
                                      return _vm.abrirModal(
                                        "lista",
                                        "actualizar",
                                        lista
                                      )
                                    },
                                  },
                                },
                                [_c("i", { staticClass: "icon-pencil" })]
                              ),
                              _vm._v(
                                "  \n                                    "
                              ),
                            ]),
                          ])
                        }),
                        0
                      ),
                    ]
                  ),
                ]),
              ]
            ),
            _vm._v(" "),
            _c("nav", [
              _c(
                "ul",
                { staticClass: "pagination" },
                [
                  _vm.pagination.current_page > 1
                    ? _c("li", { staticClass: "page-item" }, [
                        _c(
                          "a",
                          {
                            staticClass: "page-link",
                            attrs: { href: "#" },
                            on: {
                              click: function ($event) {
                                $event.preventDefault()
                                return _vm.cambiarPagina(
                                  _vm.pagination.current_page - 1
                                )
                              },
                            },
                          },
                          [_vm._v("Ant")]
                        ),
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _vm._l(_vm.pagesNumber, function (page) {
                    return _c(
                      "li",
                      {
                        key: page,
                        staticClass: "page-item",
                        class: [page == _vm.isActived ? "active" : ""],
                      },
                      [
                        _c("a", {
                          staticClass: "page-link",
                          attrs: { href: "#" },
                          domProps: { textContent: _vm._s(page) },
                          on: {
                            click: function ($event) {
                              $event.preventDefault()
                              return _vm.cambiarPagina(page)
                            },
                          },
                        }),
                      ]
                    )
                  }),
                  _vm._v(" "),
                  _vm.pagination.current_page < _vm.pagination.last_page
                    ? _c("li", { staticClass: "page-item" }, [
                        _c(
                          "a",
                          {
                            staticClass: "page-link",
                            attrs: { href: "#" },
                            on: {
                              click: function ($event) {
                                $event.preventDefault()
                                return _vm.cambiarPagina(
                                  _vm.pagination.current_page + 1
                                )
                              },
                            },
                          },
                          [_vm._v("Sig")]
                        ),
                      ])
                    : _vm._e(),
                ],
                2
              ),
            ]),
          ]),
        ],
      ],
      2
    ),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("section", { staticClass: "full-width header-well" }, [
      _c("div", { staticClass: "full-width header-well-icon" }, [
        _c("img", {
          staticClass: "icono-fundi",
          attrs: { src: "/imagenes/icono.png", width: "60", height: "60" },
        }),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "full-width header-well-text" }, [
        _c("p", { staticClass: "text-condensedLight" }, [
          _vm._v(
            "\n                         Almacen Principal de Fundiciones Fundiacero S.A.\n                      "
          ),
        ]),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("i", { staticClass: "fa fa-align-justify" }),
      _vm._v(" Lectura de RFID\n            "),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Id")]),
        _vm._v(" "),
        _c("th", [_vm._v("Marca")]),
        _vm._v(" "),
        _c("th", [_vm._v("Cantidad")]),
        _vm._v(" "),
        _c("th", [_vm._v("Grupo")]),
        _vm._v(" "),
        _c("th", [_vm._v("Genero")]),
        _vm._v(" "),
        _c("th", [_vm._v("Fecha")]),
        _vm._v(" "),
        _c("th", [_vm._v("Opciones")]),
      ]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "../resources/js/components/RfidRead.vue":
/*!************************************************************************!*\
  !*** /laragon/www/Proyecto_Grado/resources/js/components/RfidRead.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _RfidRead_vue_vue_type_template_id_712c9120___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RfidRead.vue?vue&type=template&id=712c9120& */ "../resources/js/components/RfidRead.vue?vue&type=template&id=712c9120&");
/* harmony import */ var _RfidRead_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RfidRead.vue?vue&type=script&lang=js& */ "../resources/js/components/RfidRead.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "../node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _RfidRead_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _RfidRead_vue_vue_type_template_id_712c9120___WEBPACK_IMPORTED_MODULE_0__["render"],
  _RfidRead_vue_vue_type_template_id_712c9120___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/RfidRead.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "../resources/js/components/RfidRead.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** /laragon/www/Proyecto_Grado/resources/js/components/RfidRead.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RfidRead_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./RfidRead.vue?vue&type=script&lang=js& */ "../node_modules/babel-loader/lib/index.js?!../node_modules/vue-loader/lib/index.js?!../resources/js/components/RfidRead.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RfidRead_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "../resources/js/components/RfidRead.vue?vue&type=template&id=712c9120&":
/*!*******************************************************************************************************!*\
  !*** /laragon/www/Proyecto_Grado/resources/js/components/RfidRead.vue?vue&type=template&id=712c9120& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RfidRead_vue_vue_type_template_id_712c9120___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./RfidRead.vue?vue&type=template&id=712c9120& */ "../node_modules/vue-loader/lib/loaders/templateLoader.js?!../node_modules/vue-loader/lib/index.js?!../resources/js/components/RfidRead.vue?vue&type=template&id=712c9120&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RfidRead_vue_vue_type_template_id_712c9120___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RfidRead_vue_vue_type_template_id_712c9120___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);