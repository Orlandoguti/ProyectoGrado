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
                                            <select class="form-control" v-model="idclasegreso" @click="listarEgreso(1,date1,date2)">
                                                <option value='' disabled>Filtro de Egreso</option>
                                                <option value=''>Ninguno</option>
                                                <option v-for="idclasegreso in arrayClasEgreso" :key="idclasegreso.id"  :value="idclasegreso.id"  v-text="idclasegreso.nombre"></option>
                                              </select>
                                            <input type="date" v-model="date1" @change="listarEgreso(1,date1,date2)"  class="form-control" placeholder="Ingrese la Fecha">
                                            <span style="display: flex; align-items: center;">-</span>
                                            <input type="date" v-model="date2" @change="listarEgreso(1,date1,date2)" class="form-control" placeholder="Ingrese la Fecha">
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
                                                <button type="button" class="btn btn-warning btn-sm" @click="verRespaldo(egreso.respaldo)">
                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
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
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
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
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                    <label for="validationCustom04" class="form-label">Clasificacion del Egreso:</label>
                                                    <select name="select" v-model="idclasegreso" id="validationCustom04" class="form-select" placeholder="Marca Afiliado" required>
                                                        <option value="" disabled>Seleccione la Clasificacion</option>
                                                        <option v-if="clasegreso.id >= 1" v-for="clasegreso in arrayClasEgreso" :key="clasegreso.id" :value="clasegreso.id" v-text="clasegreso.nombre" ></option>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Egreso: <span style="color: red;" v-show="egreso==0"></span></label>
                                                        <input type="text" value="0" class="form-control" v-model="egreso" placeholder="Ingrese Egreso....">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="validationCustom05" class="form-label">Monto:</label>
                                                        <input type="text" v-model="formattedMonto" @input="updateMonto" class="form-control" placeholder="Monto">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="validationCustom01" class="form-label">Descripcion:</label>
                                                        <input type="text" value="0" class="form-control" v-model="descripcion" placeholder="Ingrese Detalle...">
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                    <label for="validationCustom01" class="form-label">Respaldo:</label>
                                                    <input type="file" @change="handleFileChange" ref="respaldoInput" class="form-control" placeholder="Ingrese Respaldo...">
                                                </div>
                                                </div>
                                                <div class="row" style="display: flex; justify-content: center;">
                                                  <div class="col-md-2 mb-3">
                                                    <div class="form-group">
                                                        <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="fa fa-plus-circle"></i></button>
                                                    </div>
                                                </div>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                            <div class="table-responsive">
                                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Clasificacion</th>
                                                            <th class="text-center">Egreso</th>
                                                            <th class="text-center">Monto</th>
                                                            <th class="text-center">Descripcion</th>
                                                            <th class="text-center">Respaldo</th>
                                                            <th class="text-center">Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody v-if="arrayDetalle.length">
                                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                                          <td class="text-center text-muted">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left flex2">
                                                                        <span v-text="detalle.nombreClaseEgresos" class="widget-heading"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                          </td>
                                                          <td class="text-center text-muted" v-text="detalle.egreso"></td>
                                                          <td class="text-center text-muted" v-text="detalle.monto"></td>
                                                          <td class="text-center text-muted" v-text="detalle.descripcion"></td>
                                                          <td class="text-center text-muted">
                                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                          </td>
                                                          <td class="text-center text-muted">
                                                            <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                                <i class="fa-solid fa-x fa-spin"></i>
                                                            </button>
                                                          </td>
                                                        </tr>
                                                      </tbody>
                                                    <tbody v-else>
                                                        <tr>
                                                            <td class="text-center text-muted" colspan="6">
                                                                No hay Egresos agregados
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
        formattedMonto: 0
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
            idclasegreso: this.idclasegreso
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
    const formData = new FormData();

    formData.append('data', JSON.stringify(this.arrayDetalle)); // Convert array to JSON string
    for (const detalle of this.arrayDetalle) {
        formData.append('respaldo[]', detalle.respaldo); // Append each file to the FormData
    }

    axios.post('/egreso/registrar', formData, {
        headers: {
            'Content-Type': 'multipart/form-data', // Set the content type to multipart/form-data
        },
    }).then((response) => {
        swal(
            'Registrado!',
            'El Egreso ha sido registrado con éxito.',
            'success'
        );
        this.modal = 0;
        this.indexChart();
        this.listarEgreso(1,this.date1,this.date2);
    }).catch((error) => {
        console.error(error);
        swal(
            'Error!',
            'Hubo un problema al registrar el Egreso.',
            'error'
        );
    });
},

        handleFileChange(event) {
            const selectedFile = event.target.files[0]; // Get the selected file
            if (selectedFile) {
                this.nombrerespaldo = selectedFile.name; // Extract and store the filename
                this.respaldo = selectedFile; // Store the file in respaldo
            }
        },
        agregarDetalle() {
            let me = this;
            const selectedClasEgreso = me.arrayClasEgreso.find(clasegreso => clasegreso.id === me.idclasegreso);

            if (me.monto > me.total_saldo_efectivo || me.monto == 'NaN') {
                swal('Error!', 'El Monto Supera el Efectivo.', 'error');
            } else if(this.$refs.respaldoInput.value == ''){
                swal('Error!', 'Cargue el respaldo.', 'error');
            }else {
                me.arrayDetalle.push({
                    monto: me.monto,
                    idclasegreso: selectedClasEgreso.id,
                    nombreClaseEgresos: selectedClasEgreso.nombre,
                    descripcion: me.descripcion === "" ? "Sin Detalles" : me.descripcion,
                    egreso: me.egreso,
                    nombrerespaldo: me.nombrerespaldo, // Include the uploaded file in the object
                    respaldo: me.respaldo,
                });

                // Limpiar campos después de agregar el detalle
                me.idclasegreso = '';
                me.respaldo = null; // Reset the file input
                me.nombrerespaldo = '';
                me.descripcion = '';
                me.monto = 0;
                me.egreso = '';
                me.formattedMonto = 0;
                this.$refs.respaldoInput.value = '';
            }
        },
        eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
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
    listarEgreso(page,date1,date2) {
    let me = this;
    var url = `/IngresoEgreso/indexIngresoEgreso?page=${page}&date1=${date1}&date2=${date2}&idclasegreso=${this.idclasegreso}`;
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
      this.tituloModal = '';
      this.cantidad = '';
    },
  },
  mounted() {
    this.selectClasEgreso();
    this.listarEgreso(1,this.date1,this.date2);
    this.indexChart();
  },
};
</script>
