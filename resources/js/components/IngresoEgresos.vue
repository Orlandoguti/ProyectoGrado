<template>
            <section>
                <section>
                    <div class="app-page-title">
                            <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                                <div class="page-title-heading" style="width: 25%;">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-cash icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>GENERAR EGRESOS
                                        <div class="page-title-subheading">F.U.T.E.C.R.A.
                                        </div>
                                    </div>
                                </div>
                               <div style="display: contents;">
                                <img src="/img/plantilla/toro2izq.png" style="height: 100px;width: auto;">
                               <p style="font-family: fantasy;font-size: 1.875rem;line-height: 1.5;text-align: center;">
                                 <span>F.U.T.E.C.R.A.</span><br> <span style="font-size: initial;">Federacion Unica de Trabajadores en Carne y Ramas Anexas</span>
                               </p>
                                <img src="/img/plantilla/toro2der.png" style="height: 100px;width: auto;">
                             </div>
                             <div style="width: 25%; text-align: center;">
                                <img src="/img/plantilla/logopdf2.png" style="width: 100px; height: auto; overflow: visible;">
                             </div>
                            </div>
                        </div>
               </section>
                     <div class="row" style="justify-content: center;">
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Ingresos</div>
                                        <div class="widget-subheading">Ingresos de F.U.T.E.C.R.A.</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-primary"><span>Bs. {{ total_ingreso }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Egresos</div>
                                        <div class="widget-subheading">Egresos de F.U.T.E.C.R.A.</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-danger"><span>Bs. {{ total_egreso }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Saldo</div>
                                        <div class="widget-subheading">Total Dinero F.U.T.E.C.R.A.</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-success"><span>Bs. {{ total_saldo }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 2%; display: flex; justify-content: center;">
                            <button v-if="verDetalleChart ==0" type="button" class="btn btn-info" @click="verDetalleChartnoGrafico()">
                                <i class="fa fa-eye"></i>&nbsp; Ver Detalles
                            </button>
                            <button v-if="verDetalleChart ==1" type="button" class="btn btn-info" @click="verDetalleChartGrafico()">
                                <i class="fa fa-eye"></i>&nbsp; Ver Detalles Graficos
                            </button>
                       </div>
                    </div>
                    <div class="row" v-if="verDetalleChart == 0">
                        <div class="col-md-12" style="margin-bottom: 2%;">
                            <div id="chartContainer" style="width: 100%; height: 370px;"></div>
                       </div>
                    </div>
                <div class="row" v-if="verDetalleChart == 1">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div style="display: flex; justify-content: center;" class="card-header"># DETALLES DE GRAFICO #
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">Mes</th>
                                    <th class="text-center">Ingreso</th>
                                    <th class="text-center">Egreso</th>
                                    <th class="text-center">Saldo</th>
                                    <th class="text-center">Saldo Acumulado</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="results in chartData" :key="results.mes" v-if="results.mes">
                                    <td class="text-center text-muted"  v-if="results.mes == 1">Enero</td><td class="text-center text-muted"  v-if="results.mes == 2">Febrero</td><td class="text-center text-muted"  v-if="results.mes == 3">Marzo</td><td class="text-center text-muted"  v-if="results.mes == 4">Abril</td><td class="text-center text-muted"  v-if="results.mes == 5">Mayo</td><td class="text-center text-muted"  v-if="results.mes == 6">Junio</td>
                                    <td class="text-center text-muted"  v-if="results.mes == 7">Julio</td><td class="text-center text-muted"  v-if="results.mes == 8">Agosto</td><td class="text-center text-muted"  v-if="results.mes == 9">Septiembre</td><td class="text-center text-muted"  v-if="results.mes == 10">Octubre</td><td class="text-center text-muted"  v-if="results.mes == 11">Noviembre</td><td class="text-center text-muted"  v-if="results.mes == 12">Diciembre</td>
                                    <td class="text-center text-muted"  v-text="results.ingreso"></td>
                                    <td class="text-center text-muted"  v-text="results.egreso"></td>
                                    <td class="text-center text-muted"  v-text="results.ingreso - results.egreso"></td>
                                    <td class="text-center text-muted"  v-text="results.saldo"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-block text-center card-footer">
                        </div>
                       </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header"># LISTA DE EGRESOS
                                    <div class="btn-actions-pane-right">
                                        <div class="input-group">
                                            <input type="text" v-model="buscar" @keyup="listarEgreso(1,buscar,date1,date2)" class="form-control" placeholder="Texto a buscar">
                                            <select class="form-control" v-model="idclasegreso" @click="listarEgreso(1,buscar,date1,date2)">
                                                <option value='' disabled>Filtro de Egreso</option>
                                                <option value=''>Ninguno</option>
                                                <option v-for="idclasegreso in arrayClasEgreso" :key="idclasegreso.id"  :value="idclasegreso.id"  v-text="idclasegreso.nombre"></option>
                                              </select>
                                            <input type="date" v-model="date1" @change="listarEgreso(1,buscar,date1,date2)"  class="form-control" placeholder="Ingrese la Fecha">
                                            <span style="display: flex; align-items: center;">-</span>
                                            <input type="date" v-model="date2" @change="listarEgreso(1,buscar,date1,date2)" class="form-control" placeholder="Ingrese la Fecha">
                                            <button type="button" class="btn btn-info" @click="abrirModal('egreso','registrar')" data-bs-toggle="modal" style="margin-left: 1%;">
                                                <i class="fa fa-plus-circle"></i>&nbsp; Generar Egreso
                                            </button>
                                            <button type="submit" @click="generarPDFEgreso(date1,date2,idclasegreso)" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Copy to use file-pdf-o"></i></button>
                                           </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#ID</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Egreso</th>
                                            <th class="text-center">Monto</th>
                                            <th class="text-center">Detalles</th>
                                            <th class="text-center">Fecha de Registro</th>
                                            <th class="text-center">Respaldo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="egreso in arrayEgreso" :key="egreso.id" v-if="egreso.id">
                                            <td class="text-center text-muted"  v-text="egreso.id"></td>
                                            <td class="text-center text-muted"  >
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <span v-text="egreso.nombre" class="widget-heading"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center text-muted"  v-text="egreso.egreso"></td>
                                            <td class="text-center text-muted"  v-text="egreso.monto"></td>
                                            <td class="text-center text-muted"  v-text="egreso.descripcion"></td>
                                            <td class="text-center text-muted"  v-text="egreso.fecha"></td>
                                            <td class="text-center text-muted">
                                                <button type="button" class="btn btn-warning btn-sm" title="Abrir Respaldo" @click="verRespaldo(egreso.respaldo)">
                                                    <i class="fa fa-regular fa-folder-open" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" title="Eliminar Registro" @click="eliminarEgreso(egreso.id)">
                                                    <i class="pe-7s-trash" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-block text-center card-footer">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" v-if="pagination.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,date1,date2)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,date1,date2)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,date1,date2)">Sig</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-lg" :class="{'mostrar' : modal}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="margin-top: 10%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div><h5 class="modal-title" id="exampleModalLongTitle">Generar Egreso</h5></div>
                                    <div style="margin-right: 15%;"><h5 class="modal-title" style="text-align: center;width: 244px;padding: 2%;border-style: double;font-weight: bolder;color: #377d15;">Total Efectivo Bs. {{ total_saldo_efectivo }}</h5></div>
                                    <div> <button type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button></div>
                                </div>
                                <div class="modal-body">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <form @submit.prevent="registrarEgreso" ref="form" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                    <label for="validationCustom04" class="form-label">Clasificacion del Egreso:</label>
                                                    <select name="select" v-model="idclasegreso" id="validationCustom04" class="form-select" placeholder="Marca Afiliado" required>
                                                        <option value="" disabled>Seleccione la Clasificacion</option>
                                                        <option v-if="clasegreso.id >= 1" v-for="clasegreso in arrayClasEgreso" :key="clasegreso.id" :value="clasegreso.id" v-text="clasegreso.nombre" ></option>
                                                    </select>
                                                    <div class="invalid-feedback"> Seleccione la Clasificacion!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Egreso: <span style="color: red;" v-show="egreso==0"></span></label>
                                                        <input type="text" value="0" class="form-control" v-model="egreso" placeholder="Ingrese Egreso...." required>
                                                        <div class="invalid-feedback"> Ingrese Nombre de Egreso!</div>
                                                        <div class="valid-feedback"> Correcto! </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="validationCustom05" class="form-label">Monto:</label>
                                                        <input type="text" v-model="formattedMonto" @input="updateMonto" class="form-control" placeholder="Monto" style="border: 1px solid #ced4da; background-repeat: no-repeat; background-position: right calc(0.35em + 0.1875rem) center; background-image: url(/public/fonts/binoculars-solid.svg);" required>
                                                        <div class="invalid-feedback"> Ingrese el Monto!</div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="validationCustom01" class="form-label">Descripcion:</label>
                                                        <input type="text" value="0" class="form-control" v-model="descripcion" placeholder="Ingrese Detalle..." required>
                                                        <div class="invalid-feedback"> Ingrese la Descripcion del Egreso!</div>
                                                        <div class="valid-feedback"> Correcto! </div>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                    <label for="validationCustom01" class="form-label">Respaldo:</label>
                                                    <input type="file" ref="respaldoInput" @change="onFileChange" class="form-control" placeholder="Ingrese Respaldo..." required>
                                                    <div class="invalid-feedback">Suba el Respaldo!</div>
                                                    <div class="valid-feedback">Correcto!</div>
                                                  </div>
                                                </div>
                                            </form>
                                         </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" @click="registrarEgreso()">Registrar Egreso</button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </section>
</template>

<script>
import moment from 'moment';
export default {
  data() {
    return {
        verDetalleChart:0,
        respaldo: null,
        total_egreso:'',
        total_ingreso:'',
        total_efectivo:'',
        modal: 0,
        date1:'',
        date2:'',
        tituloModal: '',
        tipoAccion: 0,
        egreso: '',
        monto: 0,
        buscar: '',
        clasegreso:'',
        idclasegreso:'',
        descripcion: '',
        arrayClasEgreso : [],
        arrayEgreso : [],
        pagination: {
        total: 0,
        current_page: 1,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
        },
        offset: 3,
        arrayDetalle : [],
        chartData: [],
        formattedMonto: 0,
        formValidated: false,
    };
  },

  computed: {
    total_saldo() {
    const total_egreso = parseInt(this.total_egreso) || 0;
    const total_ingreso = parseInt(this.total_ingreso) || 0;

    return total_ingreso - total_egreso;
    },

    total_saldo_efectivo() {
        const total_efectivo = parseInt(this.total_efectivo) || 0;
        let total_monto = 0; // Inicializamos la suma de montos

        // Recorremos el arrayDetalle y sumamos los montos
        for (const detalle of this.arrayDetalle) {
            total_monto += parseInt(detalle.monto) || 0;
        }

        return total_efectivo - total_monto;
    },

    isActived: function () {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function () {
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
    },
  },
  methods: {
    onFileChange(event) {
      // Actualiza la propiedad 'respaldo' con el archivo seleccionado
      this.respaldo = event.target.files[0];
    },

    verDetalleChartGrafico() {
      this.verDetalleChart = 0;
      this.indexChart();
    },
    verDetalleChartnoGrafico() {
      this.verDetalleChart = 1;
    },
    verRespaldo(respaldo) {
      const url = `/respaldos/sueldos/${respaldo}`;
      window.open(url, "_blank");
    },
    generarPDFEgreso(date1, date2,) {
        const requestData = {
            date1: date1,
            date2: date2,
            idclasegreso: this.idclasegreso,
            buscar: this.buscar
        };

        axios.post('/generar-pdf-egreso', requestData, { responseType: 'blob' })
            .then((response) => {
                const pdfBlob = new Blob([response.data], { type: 'application/pdf' });
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl, '_blank');
            })
            .catch((error) => {
                console.error('Error generating PDF:', error);
            });
    },
    updateMonto() {
        // Eliminar puntos y comas del valor
        const plainValue = this.formattedMonto.replace(/[^\d]/g, "");

        // Convertir el valor a número
        this.monto = parseInt(plainValue, 10);

        // Formatear el valor con separadores de miles y actualizar formattedMonto
        const parts = this.monto.toLocaleString().split(".");
        this.formattedMonto = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".") + (parts[1] ? "." + parts[1] : "");
    },
        registrarEgreso() {
            if (this.$refs.form.checkValidity()) {
                if (this.monto > this.total_saldo_efectivo || this.monto == 'NaN') {
                    Swal.fire('Error!', 'El Monto Supera el Efectivo.', 'error');
                } else{
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Registrar!',
                    text: "Estás Seguro de Registrar este Egreso?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Registrar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        let me = this;
                        let formData = new FormData();
                        formData.append('idclasegreso', me.idclasegreso);
                        formData.append('egreso', me.egreso);
                        formData.append('monto', me.monto);
                        formData.append('descripcion', me.descripcion);
                        formData.append('respaldo', this.respaldo);

                        axios.post('/egreso/registrar', formData).then((response) => {
                            Swal.fire(
                                'Registrado!',
                                'Se ha registrado el Egreso!',
                                'success'
                            );
                            this.cerrarModal();
                            this.listarEgreso(1, this.date1, this.date2);
                        }).catch((error) => {
                            console.log(error);
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                    })
                }
            } else {
                Swal.fire('Validacion!', 'Porfavor llena todos los campos!', 'warning');
                this.formValidated = true;
             }
            },

    indexChart() {
  // Obtener la fecha actual (opcional, si quieres mostrar los datos de la fecha actual por defecto)
        axios
            .get('/IngresoEgreso/indexIngresoEgreso')
            .then((response) => {
            this.chartData = response.data.results;
            this.renderChart();
            })
            .catch((error) => {
            console.error('Error fetching data:', error);
            });
        },
    listarEgreso(page,buscar,date1,date2) {
    let me = this;
    var url = `/IngresoEgreso/indexIngresoEgreso?page=${page}&buscar=${buscar}&date1=${date1}&date2=${date2}&idclasegreso=${this.idclasegreso}`;
    axios
        .get(url)
        .then(function (response) {
        var respuesta = response.data;
        me.arrayEgreso = respuesta.egresos.data;
        me.total_ingreso = respuesta.total_ingreso;
        me.total_egreso = respuesta.total_egreso;
        me.total_efectivo = respuesta.total_efectivo;
        me.pagination = respuesta.pagination;
        })
        .catch(function (error) {
        console.log(error);
        });
    },
    selectClasEgreso() {
      let me = this;
      var url = '/clasegresos/selectClasEgresos';
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayClasEgreso = respuesta.clasegresos;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    renderChart() {
        var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title: {
	},
	axisX: {
		valueFormatString: "MMM"
	},
	axisY: {
		prefix: "Bs ",
		labelFormatter: addSymbols
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
	{
		type: "column",
		name: "Ingreso",
		showInLegend: true,
		xValueFormatString: "MMMM YYYY",
		yValueFormatString: "Bs #,##0",
        dataPoints: this.chartData.map((data) => ({
            x: new Date(data.anio,data.mes-1), // Crear fecha usando el mes como número
            y: parseInt(data.ingreso),
        })),
	},
    {
        type: "area",
        name: "Egreso",
		markerBorderColor: "white",
        color: 'LightCoral',
        showInLegend: true,
        yValueFormatString: "Bs #,##0",
        dataPoints: this.chartData.map((data) => ({
            x: new Date(data.anio,data.mes-1), // Crear fecha usando el mes como número
            y: parseInt(data.egreso),
        })),
    },
	{
		type: "line",
		name: "Saldo",
		markerBorderColor: "white",
        color: "#58D68D",
		markerBorderThickness: 2,
		showInLegend: true,
		yValueFormatString: "Bs #,##0",
        dataPoints: this.chartData.map((data) => ({
            x: new Date(data.anio,data.mes-1), // Crear fecha usando el mes como número
            y: parseInt(data.saldo ),
        })),
	},]
});
    chart.render();
    function addSymbols(e) {
        var suffixes = ["", "K", "M", "B"];
        var order = Math.max(Math.floor(Math.log(Math.abs(e.value)) / Math.log(1000)), 0);

        if(order > suffixes.length - 1)
            order = suffixes.length - 1;

        var suffix = suffixes[order];
        return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
    }

    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }

    },
    cambiarPagina(page,buscar) {
            let me = this;
            // Actualiza la página actual
            me.pagination.current_page = page;
            // Envía la petición para visualizar la data de esa página
            me.listarEgreso(page,buscar,this.date1,this.date2);
        },
    abrirModal(modelo, accion, data = []) {
        this.selectClasEgreso();
      switch (modelo) {
        case 'egreso': {
          switch (accion) {
            case 'registrar': {
                this.arrayDetalle =[];
              this.modal = 1;
              this.tituloModal = 'Registrar Egreso';
              this.tipoAccion = 1;
              break;
            }
          }
        }
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.formValidated = false;
      this.tituloModal = '';
      this.cantidad = '';
      this.idclasegreso = '';
      this.egreso = '';
      this.formattedMonto = 0;
      this.descripcion = '';
      this.$refs.respaldoInput.value = '';
    },

    eliminarEgreso(id){
        const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Eliminar!',
                    text: "Estás Seguro de Eliminar este Registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
            axios.delete(`/egreso/eliminar/${id}`)
                .then(response => {
                this.listarEgreso(1,this.buscar='',this.date1='',this.date2='');
                Swal.fire(
                            'Eliminado!',
                            'El Registro se ha sido eliminado con éxito.',
                            'warning'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else if (
                                        /* Read more about handling dismissals below */
                                        result.dismiss === Swal.DismissReason.cancel
                                    ) {
                    }
                })
            },
  },
  mounted() {
    this.selectClasEgreso();
    this.listarEgreso(1,this.buscar,this.date1,this.date2);
    this.indexChart();
  },
};
</script>
