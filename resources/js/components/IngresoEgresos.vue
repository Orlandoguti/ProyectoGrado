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
                                        <div class="widget-heading">Ingresos</div>
                                        <div class="widget-subheading">Ingresos de F.U.T.E.C.R.A.</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-success"><span>Bs. 1896M</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Egresos</div>
                                        <div class="widget-subheading">Egresos de F.U.T.E.C.R.A.</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-primary"><span>Bs. 568</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Dinero</div>
                                        <div class="widget-subheading">Total Dinero F.U.T.E.C.R.A.</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning"><span>Bs. 14M</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <button type="button" class="btn btn-info" @click="abrirModal('egreso','registrar')" data-bs-toggle="modal" style="margin-left: 1%;">
                        <i class="fa fa-plus-circle"></i>&nbsp; Generar Egreso
                    </button>
                    <div class="modal fade bd-example-modal-lg" :class="{'mostrar' : modal}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="margin-top: 10%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Generar Egreso</h5>
                                    <button type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Egreso: <span style="color: red;" v-show="egreso==0"></span></label>
                                                        <input type="text" value="0" class="form-control" v-model="egreso" placeholder="Ingrese Egreso....">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="validationCustom05" class="form-label">Monto:</label>
                                                        <input type="number" v-model="monto" class="form-control" placeholder="Monto">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="validationCustom01" class="form-label">Detalles:</label>
                                                        <input type="text" value="0" class="form-control" v-model="detalleEgreso" placeholder="Ingrese Detalle...">
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
                                                            <th class="text-center">Egreso</th>
                                                            <th class="text-center">Monto</th>
                                                            <th class="text-center">Detalles</th>
                                                            <th class="text-center">Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody v-if="arrayDetalle.length">
                                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                                           <td class="text-center text-muted" v-text="detalle.egreso"></td>
                                                            <td class="text-center text-muted" v-text="detalle.monto"></td>
                                                            <td class="text-center text-muted" v-text="detalle.detalleEgreso"></td>
                                                            <td class="text-center text-muted">
                                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                                    <i class="icon-close"></i>
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
        modal: 0,
        tituloModal: '',
        tipoAccion: 0,
        egreso: '',
        fecha: '',
        monto: 0,
        detalleEgreso: '',
        arrayPedido : [],
        arrayDetalle : [],
        chartData: [],
    };
  },

  computed: {

  },
  methods: {
    registrarEgreso(){
                axios.post('/egreso/registrar', {
            'fecha': this.fecha = moment().format('YYYY-MM-DD'),
            'data': this.arrayDetalle
        }).then(function(response) {
            swal(
                'Registrado!',
                'El Egreso ha sido registrado con éxito.',
                'success'
            );
        }).catch(function(error) {
            console.error(error);
            swal(
                'Error!',
                'Hubo un problema al registrar el Egreso.',
                'error'
            );
        });
            },
    agregarDetalle(){

                 let me=this;
                 if(me.detalleEgreso==0){
                       if(me.egreso==0){
                      swal({
                             type: 'error',
                             title: 'Error...',
                             text: 'Ingrese Nombre del Egreso!',
                         })
                     }else{
                          if(me.monto==0){
                      swal({
                             type: 'error',
                             title: 'Error...',
                             text: 'Ingrese Monto del Egreso!',
                         })
                     }else{
                     me.arrayDetalle.push({
                             monto: me.monto,
                             detalleEgreso:'No Hay detalle',
                             egreso: me.egreso,
                             });
                             me.egreso='';
                             me.monto=0;
                             me.detalleEgreso='';
                     }
                 }
                 }else{
                     if(me.detalleEgreso != 0){

                          if(me.egreso==0){
                      swal({
                             type: 'error',
                             title: 'Error...',
                             text: 'Ingrese Nombre del Egreso!',
                         })
                     }else{
                          if(me.monto==0){
                      swal({
                             type: 'error',
                             title: 'Error...',
                             text: 'Ingrese Monto del Egreso!',
                         })
                     }else{
                             me.arrayDetalle.push({
                             monto: me.monto,
                             detalleEgreso: me.detalleEgreso,
                             egreso: me.egreso,
                             });
                             me.egreso='';
                             me.monto=0;
                             me.detalleEgreso='';
                     }
                  }
                  }
                 }
             },


    indexIngresoEgreso() {
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

    renderChart() {
        var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "INGRESOS Y EGRESOS"
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
		name: "Saldo",
		showInLegend: true,
		xValueFormatString: "MMMM YYYY",
		yValueFormatString: "Bs #,##0",
		dataPoints: [
			{ x: new Date(2023, 0), y: 30 },
			{ x: new Date(2023, 1), y: 25 },
			{ x: new Date(2023, 2), y: 70 },
			{ x: new Date(2023, 3), y: 50 },
			{ x: new Date(2023, 4), y: 35 },
			{ x: new Date(2023, 5), y: 30 },
			{ x: new Date(2023, 6), y: 43 },
			{ x: new Date(2023, 7), y: 35 },
			{ x: new Date(2023, 8), y:  30},
			{ x: new Date(2023, 9), y: 40 },
			{ x: new Date(2023, 10), y: 50 },
            { x: new Date(2023, 11), y: 20 }
		]
	},
    {
        type: "line",
        name: "Total Ingresos",
        showInLegend: true,
        yValueFormatString: "Bs #,##0",
        dataPoints: this.chartData.map((data) => ({
            x: new Date(data.anio,data.mes-1), // Crear fecha usando el mes como número
            y: parseInt(data.totalCantidad),
        })),
    },
	{
		type: "area",
		name: "Egresos",
		markerBorderColor: "white",
		markerBorderThickness: 2,
		showInLegend: true,
		yValueFormatString: "Bs #,##0",
		dataPoints: [
			{ x: new Date(2023, 0), y: 7 },
			{ x: new Date(2023, 1), y: 60},
			{ x: new Date(2023, 2), y: 30 },
			{ x: new Date(2023, 3), y: 20 },
			{ x: new Date(2023, 4), y: 15 },
			{ x: new Date(2023, 5), y: 13 },
			{ x: new Date(2023, 6), y: 20 },
			{ x: new Date(2023, 7), y: 15 },
			{ x: new Date(2023, 8), y:  10},
			{ x: new Date(2023, 9), y: 19 },
			{ x: new Date(2023, 10), y: 22 },
            { x: new Date(2023, 11), y: 50 }
		]
	}]
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
      switch (modelo) {
        case 'egreso': {
          switch (accion) {
            case 'registrar': {
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
    this.indexIngresoEgreso();
  },
};
</script>
