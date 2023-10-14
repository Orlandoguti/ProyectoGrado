<template>
    <section>
        <section>
                <div class="app-page-title">
                        <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                            <div class="page-title-heading" style="width: 25%;">
                                <div class="page-title-icon">
                                    <i class="pe-7s-graph icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>DASHBOARD
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
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Ganados Faeneados</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success">{{ totalestado2 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Ganados Proceso de Faeneado</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning">{{ totalestado1 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Ganados en Corral</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger">{{ totalestado0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Ganados</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-focus">{{ totalRegistros }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="pe-7s-display1" aria-hidden="true" title="Copy to use file-excel-o"></i> Total Ganados Carneados por Grupo</h5>
                            <canvas id="verticalChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="pe-7s-display1" aria-hidden="true" title="Copy to use file-excel-o"></i> Total Ganados Carneados por Mes</h5>
                        <canvas id="stacked-bars-chart"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                       <div class="card-body">
                           <h5 class="card-title"><i class="pe-7s-graph" aria-hidden="true" title="Copy to use file-excel-o"></i> Total Ganados por Marca</h5>
                           <canvas id="polar-chart"></canvas>
                       </div>
                   </div>
               </div>
            </div>
            <div class="row">
             <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="pe-7s-graph" aria-hidden="true" title="Copy to use file-excel-o"></i> Total Marcas Carneadas </h5>
                        <canvas id="chart-area"></canvas>
                    </div>
                </div>
                     </div>
                     <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="pe-7s-display1" aria-hidden="true" title="Copy to use file-excel-o"></i> Toros y Vacas Carneados por Mes</h5>
                                <canvas id="line-chart"></canvas>
                            </div>
                        </div>
                    </div>

                 </div>
                 <div style="text-align: center; font-weight: bold; color: chocolate; font-size: 1.5rem;">
                    <p>------ GANADOS ------</p>
                </div>
           <div class="row">
            <section v-if="ver==0">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"><i class="pe-7s-note2" aria-hidden="true"></i> LISTA DE GANADOS
                        <div class="btn-actions-pane-right">
                            <div class="input-group">
                                <input type="date" v-model="date1"  class="form-control" placeholder="Ingrese la Fecha">
                                <span style="display: flex; align-items: center;">-</span>
                                <input type="date" v-model="date2" @change="listarRfid(1,buscar,date1,date2)" class="form-control" placeholder="Ingrese la Fecha">
                                <input type="text" v-model="buscar" @keyup="listarRfid(1,buscar,date1,date2)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarRfid(1,buscar,date1='',date2='')" @change="fetchChartDataFromDatabase()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                <button type="submit" @click="generatePdf(date1,date2,buscar)" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Copy to use file-pdf-o"></i></button>
                                <button type="submit" @click="excelVenta(date1,date2,buscar)" class="btn btn-success"><i class="fa fa-download" aria-hidden="true" title="Copy to use file-excel-o"></i></button>
                           </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Codigo Tarjeta</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Genero</th>
                                <th class="text-center">Grupo Faeneo</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Fecha Ingreso</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody v-if="arrayRfid.length">
                                <tr v-for="rfid in arrayRfid"  :key="rfid.id">
                                <td class="text-center text-muted"  v-text="rfid.idrfid"></td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left me-3">
                                                <div class="widget-content-left">
                                                    <img width="40" class="rounded-circle" src="/img/plantilla/torologo.png" alt="">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <span v-text="rfid.marca" class="widget-heading"></span>
                                                <span v-text="rfid.nombre" class="widget-subheading opacity-7"></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td v-text="rfid.gnombre" class="text-center"></td>
                                <td v-text="rfid.grunombre" class="text-center"></td>
                                <td  class="text-center">
                                    <div v-if="rfid.estado == 0">
                                        <div class="badge bg-danger">Ganado en Corral</div>
                                    </div>
                                    <div v-if="rfid.estado == 1">
                                        <div class="badge bg-warning">Proceo de Faeneado</div>
                                    </div>
                                    <div v-if="rfid.estado == 2">
                                        <div class="badge bg-success">Ganado Carneado</div>
                                    </div>
                                </td>
                                <td v-text="rfid.fecha" class="text-center"></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" @click="verGanado(rfid.id)">
                                        <i style="color: black;" class="fa fa-eye" aria-hidden="true" title="Copy to use file-excel-o"></i>
                                    </button>
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarGanado(rfid.id)">
                                            <i class="pe-7s-trash" aria-hidden="true" title="Copy to use file-excel-o"></i>
                                        </button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        No hay Registros
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
        </section>
        <section v-if="ver==1">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="main-card mb-3 card">
                        <div class="card-body" style="text-align: center;">
                            <h5 style="color: coral;" class="card-title"> Informacion Del Ganado ID: {{ id }}</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Codigo Tarjeta</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Genero</th>
                                <th class="text-center">Grupo Faeneo</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Fecha Ingreso</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="text-center text-muted"  v-text="idrfid"></td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left me-3">
                                                <div class="widget-content-left">
                                                    <img width="40" class="rounded-circle" src="/img/plantilla/torologo.png" alt="">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <span v-text="marca" class="widget-heading"></span>
                                                <span v-text="nombre" class="widget-subheading opacity-7"></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td v-text="gnombre" class="text-center"></td>
                                <td v-text="grunombre" class="text-center"></td>
                                <td  class="text-center">
                                    <div v-if="estado == 0">
                                        <div class="badge bg-danger">Ganado en Corral</div>
                                    </div>
                                    <div v-if="estado == 1">
                                        <div class="badge bg-warning">Proceo de Faeneado</div>
                                    </div>
                                    <div v-if="estado == 2">
                                        <div class="badge bg-success">Ganado Carneado</div>
                                    </div>
                                </td>
                                <td v-text="fecha" class="text-center"></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Registrado Por</th>
                                <th class="text-center">Sacado del Corral Por</th>
                                <th class="text-center">Faeneado Por</th>
                                <th class="text-center">Hora de Faeneo</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="text-center text-muted"  v-text="idregistro"></td>
                                <td class="text-center text-muted"  v-text="idprocesofaeneo"></td>
                                <td v-text="idfaeneo" class="text-center"></td>
                                <td v-text="updated_at" class="text-center"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="justify-content: center; display: flex; margin-top: 2%; margin-bottom: 2%;">
                            <div> <button type="button" @click="cerrarModal()"  class="btn btn-info">Cerrar Informacion</button></div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        </div>
    <div>
</div>
</section>

</template>
<script>
import moment from 'moment';
import Chart from 'chart.js';
export default {

data (){
  return {
    ver:0,
    id:'',
    idrfid:'',
    grunombre:'',
    gnombre:'',
    updated_at:'',
    idregistro:'',
    idprocesofaeneo:'',
    idfaeneo:'',
    chartData : [],
        chartData2 : [],
        chartData3 : [],
        chartData4 : [],
        chartData5 : [],
      totalestado0:'',
      totalestado1:'',
      totalestado2:'',
      webSocket: null,
      rfidData: '',
      idpersona : 0,
      fecha : '',
      marca : '',
      nombre : '',
      idgenero : 0,
      estado : 0,
      arrayPersona : [],
      arrayRfid: [],
      arrayGenero: [],
      modal : false,
      tituloModal : '',
      tipoAccion : 0,
      pagination : {
          'total' : 0,
          'current_page' : 0,
          'per_page' : 0,
          'last_page' : 0,
          'from' : 0,
          'to' : 0,
      },
      offset : 3,
      buscar : '',
      date1 : '',
      date2 : '',
  }

},
computed:{
totalRegistros() {
  const total0 = parseInt(this.totalestado0) || 0;
  const total1 = parseInt(this.totalestado1) || 0;
  const total2 = parseInt(this.totalestado2) || 0;

  return total0 + total1 + total2;
},

  isActived: function(){
      return this.pagination.current_page;
  },
  //Calcula los elementos de la paginación
  pagesNumber: function() {
      if(!this.pagination.to) {
          return [];
      }

      var from = this.pagination.current_page - this.offset;
      if(from < 1) {
          from = 1;
      }

      var to = from + (this.offset * 2);
      if(to >= this.pagination.last_page){
          to = this.pagination.last_page;
      }

      var pagesArray = [];
      while(from <= to) {
          pagesArray.push(from);
          from++;
      }
      return pagesArray;

  }
},
watch: {
  date1: function(newDate1) {
    this.fetchChartDataFromDatabase(this.date1, this.date2);
  },

  date2: function(newDate2) {
    // Aquí puedes llamar a la función para actualizar los gráficos con la nueva fecha date2
    this.fetchChartDataFromDatabase(this.date1, this.date2);
  },
},
methods : {

    generatePdf(date1, date2, buscar) {
        const requestData = {
            date1: date1,
            date2: date2,
            buscar: buscar,
        };

        axios.post('/rfid/pdf', requestData, { responseType: 'blob' })
            .then((response) => {
                const pdfBlob = new Blob([response.data], { type: 'application/pdf' });
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl, '_blank');
            })
            .catch((error) => {
                console.error('Error generating PDF:', error);
            });
    },

    excelVenta(date1,date2,buscar){
                window.open('rfid/excel?'+ 'date1='+ date1 + '&date2='+ date2 + '&buscar='+ buscar,'_blank');
            },
    fetchChartDataFromDatabase(date1,date2) {
  // Obtener la fecha actual (opcional, si quieres mostrar los datos de la fecha actual por defecto)

        axios
            .get('/rfid/indexAdministrador?&date1=' + date1 + '&date2='+ date2)
            .then((response) => {
            this.chartData = response.data.chartData;
            this.chartData2 = response.data.chartData2;
            this.chartData3 = response.data.chartData3;
            this.chartData4 = response.data.chartData4;
            this.chartData5 = response.data.chartData5;
            this.polarChart();
            this.PieChart();
            this.BarChart();
            this.LineChart();
            this.BarVerticalChart();
            })
            .catch((error) => {
            console.error('Error fetching data:', error);
            });
        },

        generateRandomSolidColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 3; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
            },
        generateRandomColors(numColors, opacity) {
            var colors = [];

            // Generar un valor hexadecimal para el canal alfa basado en la opacidad deseada
            var alphaHex = Math.floor(opacity * 255).toString(16).toUpperCase();

            // Asegurar que el valor del canal alfa tenga dos dígitos
            if (alphaHex.length === 1) {
                alphaHex = '0' + alphaHex;
            }

            for (let i = 0; i < numColors; i++) {
                // Generar un color hexadecimal aleatorio con la opacidad especificada
                var color = '#' + alphaHex + Math.floor(Math.random() * 16777215).toString(16);
                colors.push(color);
            }

            return colors;
        },
    polarChart() {
        var ctx = document.getElementById('polar-chart');

        if (ctx && this.chartData.length > 0) {
            var randomColors = this.generateRandomColors(this.chartData.length, 1);

            var configPolar = {
            data: {
                datasets: [
                {
                    data: this.chartData.map((data) => data.total), // Utilizamos los datos de la propiedad chartData aquí
                    backgroundColor: randomColors,
                    label: 'My dataset',
                },
                ],
                labels: this.chartData.map((data) => data.marca), // Etiquetas del gráfico obtenidas de la propiedad chartData
            },
            options: {
                responsive: true,
                legend: {
                position: 'right',
                },
                title: {
                display: false,
                text: 'Chart.js Polar Area Chart',
                },
                scale: {
                ticks: {
                    beginAtZero: true,
                },
                reverse: false,
                },
                animation: {
                animateRotate: false,
                animateScale: true,
                },
            },
            };

            new Chart(ctx, {
            type: 'polarArea',
            data: configPolar.data,
            options: configPolar.options,
            });
        }
        },
        PieChart() {
            let ctx1 = document.getElementById('chart-area');

            if (ctx1 && this.chartData2.length > 0) {
                let randomColors = this.generateRandomColors(this.chartData2.length,0);

                let configPie = {
                data: {
                    datasets: [
                    {
                        data: this.chartData2.map((data) => data.total), // Utilizamos los datos de la propiedad chartData aquí
                        backgroundColor: randomColors,
                        label: 'My dataset',
                    },
                    ],
                    labels: this.chartData2.map((data) => data.marca), // Etiquetas del gráfico obtenidas de la propiedad chartData
                },
                options: {
                    responsive: true,
                    legend: {
                    position: 'right',
                    },
                    title: {
                    display: true,
                    },
                    animation: {
                    animateRotate: false,
                    animateScale: true,
                    },
                },
                };

                new Chart(ctx1, {
                type: 'pie',
                data: configPie.data,
                options: configPie.options,
                });
            }
            },
            BarChart() {
                var ctx = document.getElementById('stacked-bars-chart');

                if (ctx && this.chartData3.length > 0) {
                    // Código para agrupar los totales por mes
                    var groupedData = {};

                    this.chartData3.forEach((data) => {
                    if (!groupedData[data.mes]) {
                        groupedData[data.mes] = {};
                    }
                    if (!groupedData[data.mes][data.marca]) {
                        groupedData[data.mes][data.marca] = 0;
                    }
                    groupedData[data.mes][data.marca] += data.total;
                    });

                    // Convertir los datos agrupados en un arreglo de objetos para el gráfico
                    var dataForChart = Object.keys(groupedData).map((mes) => {
                    var totalsByMarca = groupedData[mes];
                    return {
                        mes: mes,
                        totalsByMarca: totalsByMarca,
                    };
                    });

                    // Nombres completos de los meses
                    var monthNames = [
                    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ];

                    var marcaLabels = Object.keys(this.chartData3.reduce((acc, curr) => {
                    acc[curr.marca] = true;
                    return acc;
                    }, {}));
                    var randomColors = marcaLabels.map(() => this.generateRandomSolidColor());
                    var datasets = marcaLabels.map((marca, index) => ({
                    data: dataForChart.map((data) => data.totalsByMarca[marca] || 0),
                    backgroundColor: randomColors[index],
                    label: marca,
                    stack: 'stack1', // Establecemos el mismo valor para agrupar los datos
                    }));

                    var configmyBar = {
                    data: {
                        datasets: datasets,
                        labels: dataForChart.map((data) => monthNames[Number(data.mes) - 1]), // Usamos los nombres completos de los meses
                    },
                    options: {
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        responsive: true,
                        legend: {
                        position: 'right',
                        },
                        title: {
                        display: true,
                        },
                        animation: {
                        animateRotate: false,
                        animateScale: true,
                        },
                        scales: {
                        x: {
                            stacked: true, // Hacer que los datos estén apilados en el eje X
                        },
                        y: {
                            stacked: true,
                            ticks: {
                                beginAtZero: true, // Comenzar el eje Y desde el valor 0
                                stepSize: 1, // Mostrar valores enteros en el eje Y
                            },
                        },
                        },
                    },
                    };

                    new Chart(ctx, {
                    type: 'bar',
                    data: configmyBar.data,
                    options: configmyBar.options,
                    });
                }
            },

            BarVerticalChart() {
                var ctx = document.getElementById('verticalChart');

                if (ctx && this.chartData5.length > 0) {
                    var monthNames = [
                        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ];
                    var datasets = [];
                    // Crear un objeto para agrupar los totales por grupo
                    var totalsByGroup = {};

                    this.chartData5.forEach((data) => {
                        var group = data.grupo;
                        var monthIndex = Number(data.mes) - 1;

                        if (!totalsByGroup[group]) {
                            totalsByGroup[group] = {
                                label: group,
                                data: new Array(12).fill(0), // Crear un array para los totales de cada mes (inicialmente lleno de ceros)
                                backgroundColor: this.generateRandomSolidColor() // Obtener un color aleatorio del array
                            };
                        }

                        // Agregar el total al mes correspondiente
                        totalsByGroup[group].data[monthIndex] = data.total;
                    });

                    // Convertir el objeto de totales por grupo en un array de datasets
                    for (var group in totalsByGroup) {
                        if (totalsByGroup.hasOwnProperty(group)) {
                            datasets.push(totalsByGroup[group]);
                        }
                    }


                    var configmyBar = {
                        data: {
                            datasets: datasets,
                            labels: monthNames,
                        },
                        options: {
                            responsive: true,
                            legend: {
                                position: 'right',
                            },
                            title: {
                                display: false,
                                text: ''
                            }
                        }
                    };

                    new Chart(ctx, {
                        type: 'bar',
                        data: configmyBar.data,
                        options: configmyBar.options,
                    });
                }
            },

            LineChart() {
                console.log(this.chartData4); // Verifica que los datos estén llegando correctamente

                var ctx = document.getElementById('line-chart');

                if (ctx && this.chartData4.length > 0) {
                    // Código para agrupar los totales por mes y género
                    var groupedData = {};

                    this.chartData4.forEach((data) => {
                        if (!groupedData[data.mes]) {
                            groupedData[data.mes] = {
                                Toro: 0,
                                Vaca: 0
                            };
                        }
                        groupedData[data.mes][data.genero] = data.total;
                    });

                    console.log(groupedData); // Verifica los datos agrupados

                    // Convertir los datos agrupados en un arreglo de objetos para el gráfico
                    var dataForChart = Object.keys(groupedData).map((mes) => {
                        return {
                            mes: mes,
                            ...groupedData[mes]
                        };
                    });

                    console.log(dataForChart); // Verifica los datos para el gráfico

                    // Nombres de los meses (solo las primeras tres letras)
                    var monthNames = [
                        "Ene", "Feb", "Mar", "Abr", "May", "Jun",
                        "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
                    ];

                    // Filtrar los datos para obtener solo los de "toro" y "vaca"
                    var toroData = dataForChart.map((data) => data.Toro || 0);
                    var vacaData = dataForChart.map((data) => data.Vaca || 0);

                    console.log(toroData); // Verifica los datos de toro para el gráfico
                    console.log(vacaData); // Verifica los datos de vaca para el gráfico

                    // Colores fijos para cada género (rojo para toros, azul para vacas)
                    var colorToro = '#FF0000'; // Rojo
                    var colorVaca = '#0000FF'; // Azul

                    var configLine = {
                        data: {
                            labels: dataForChart.map((data) => monthNames[Number(data.mes) - 1]), // Usamos las primeras tres letras de los meses
                            datasets: [
                                {
                                    label: 'Toro',
                                    data: toroData,
                                    backgroundColor: colorToro,
                                    borderColor: colorToro,
                                    fill: false,
                                },
                                {
                                    label: 'Vaca',
                                    data: vacaData,
                                    backgroundColor: colorVaca,
                                    borderColor: colorVaca,
                                    fill: false,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: false, // Puedes establecer esto a "false" si deseas ocultar la leyenda del gráfico
                                position: 'right',
                            },
                            title: {
                                display: true,
                            },
                            scales: {
                                yAxes: [
                                    {
                                        display: false, // Establecer esto a "false" ocultará el eje y (parte izquierda)
                                    },
                                ],
                                xAxes: [{
                                display: true,
                                }]
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: false
                            },
                            animation: {
                                animateRotate: false,
                                animateScale: true,
                            },
                        },
                    };

                    new Chart(ctx, {
                        type: 'line', // Cambiamos el tipo de gráfico a línea
                        data: configLine.data,
                        options: configLine.options,
                    });
                }
            },


  listarRfid (page,buscar,date1,date2){
      let me=this;
      var url= '/rfid/indexAdministrador?page=' + page + '&buscar='+ buscar + '&date1=' + date1 + '&date2='+ date2 ;
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayRfid = respuesta.rfids.data;
          me.totalestado0 = respuesta.total_estado0;
          me.totalestado1 = respuesta.total_estado1;
          me.totalestado2 = respuesta.total_estado2;
          me.pagination= respuesta.pagination;
      })
      .catch(function (error) {
          console.log(error);
      });
  },


  cambiarPagina(page,buscar,date1,date2){
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarRfid(page,buscar,date1,date2);
  },

  cerrarModal(){
      this.ver= 0;
      this.id= '';
      this.idrfid= '';
      this.idpersona = '';
      this.idregistro = '';
      this.idprocesofaeneo = '';
      this.idfaeneo = '';
      this.estado= '';
      this.fecha = '';
      this.updated_at = '';
  },
  verGanado(id){
                let me=this;
                me.ver=1;

               var arrayRfid=[];
                var url= '/rfid/verInformacion?id=' + id;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayRfid = respuesta.rfids;

                    me.id = arrayRfid[0]['id'];
                    me.idrfid = arrayRfid[0]['idrfid'];
                    me.nombre = arrayRfid[0]['persona_nombre'];
                    me.marca = arrayRfid[0]['marca'];
                    me.grunombre = arrayRfid[0]['grunombre'];
                    me.gnombre = arrayRfid[0]['gnombre'];
                    me.estado = arrayRfid[0]['estado'];
                    me.fecha = arrayRfid[0]['fecha'];
                    me.updated_at = arrayRfid[0]['updated_at'];
                    me.idregistro = arrayRfid[0]['idregistro'];
                    me.idprocesofaeneo = arrayRfid[0]['idprocesofaeneo'];
                    me.idfaeneo = arrayRfid[0]['idfaeneo'];
                })
                .catch(function (error) {
                    console.log(error);
                });
            },


  eliminarGanado(id){
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
                axios.delete(`/rfid/eliminar/${id}`)
                    .then(response => {
                    this.listarRfid(1,this.buscar='',this.date1='',this.date2='');
                    this.fetchChartDataFromDatabase(this.date1,this.date2);
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
this.fetchChartDataFromDatabase(this.date1,this.date2);
this.listarRfid(1,this.buscar='',this.date1='',this.date2='');
setInterval(() => {
    this.listarRfid(this.pagination.current_page, this.buscar,this.date1,this.date2);
}, 5000);
},
}
</script>


