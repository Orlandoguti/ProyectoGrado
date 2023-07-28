<template>
    <section>
        <section>
                <div class="app-page-title">
                        <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                            <div class="page-title-heading" style="width: 25%;">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>PRINCIPAL
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
                                    <div class="widget-heading">Total Ganados Carneados</div>
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
                                    <div class="widget-heading">Total Ganados Proceso de Carneo</div>
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
                <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Total Ganados Carneados por Mes</h5>
                        <canvas id="stacked-bars-chart"></canvas>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Toros y Vacas Carneados por Mes</h5>
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Total Ganados por Marca</h5>
                            <canvas id="polar-chart"></canvas>
                        </div>
                    </div>
                </div>
             <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Total Marcas Carneadas </h5>
                        <canvas id="chart-area"></canvas>
                    </div>
                </div>
                     </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">
                                <div class="d-flex justify-content-center"> <!-- Utilizamos d-flex y justify-content-center para centrar horizontalmente -->
                                    <span># GENERAR REPORTE #</span>
                                </div>
                                <div class="btn-actions-pane-right">
                                    <div class="input-group">
                                        <input type="date" v-model="date1"  class="form-control" placeholder="Ingrese la Fecha">
                                        <div>-</div>
                                        <input type="date" v-model="date2" @change="listarRfid(1,buscar,date1,date2)" class="form-control" placeholder="Ingrese la Fecha">
                                        <button type="submit" @click="generatePdf(date1,date2)" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Copy to use file-pdf-o"></i></button>
                                        <button type="submit" @click="excelVenta(date1,date2)" class="btn btn-success"><i class="fa fa-download" aria-hidden="true" title="Copy to use file-excel-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

           <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"># LISTA DE GANADOS
                        <div class="btn-actions-pane-right">
                            <div class="input-group">
                                <input type="text" v-model="buscar" @keyup="listarRfid(1,buscar,date1,date2)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarRfid(1,buscar,date1='',date2='')" @change="fetchChartDataFromDatabase()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                <th class="text-center">Grupo Carneo</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Fecha Ingreso</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
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
                                <td>
                                    <button type="button" @click="abrirModal('rfid','actualizar',articulo)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;

                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarGanado(rfid.id)">
                                            <i class="icon-trash"></i>
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
      chartData: [],
      chartData2: [],
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
    // Aquí puedes llamar a la función para actualizar los gráficos con la nueva fecha date1
    this.fetchChartDataFromDatabase(this.date1, this.date2);
  },

  date2: function(newDate2) {
    // Aquí puedes llamar a la función para actualizar los gráficos con la nueva fecha date2
    this.fetchChartDataFromDatabase(this.date1, this.date2);
  },
},
methods : {

    generatePdf(date1, date2) {
        const requestData = {
            date1: date1,
            date2: date2
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
            this.polarChart();
            this.PieChart();
            this.BarChart();
            this.LineChart();
            })
            .catch((error) => {
            console.error('Error fetching data:', error);
            });
        },
        generateRandomSolidColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
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
            var ctx = document.getElementById('chart-area');

            if (ctx && this.chartData2.length > 0) {
                var randomColors = this.generateRandomColors(this.chartData2.length,0);

                var configPie = {
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

                new Chart(ctx, {
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
                    backgroundColor: randomColors[index], // Generamos un color sólido aleatorio para cada marca
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
      this.modal= false;
      this.tituloModal='';
      this.idrfid= 0;
      this.idpersona = '';
      this.estado= 0;
      this.fecha = '';
      this.closeWebSocket();
  },
  abrirModal(modelo, accion, data = []){
      switch(modelo){
          case "rfid":
          {
              switch(accion){
                  case 'registrar':
                    this.initializeWebSocket();

                  {
                      this.modal = true;
                      this.formValidated = false;
                      this.tituloModal = 'Registrar Tarjeta RFID';
                      this.rfidData = '',
                      this.idpersona='';
                      this.idgenero='';
                      this.fecha = moment().format('YYYY-MM-DD');
                      this.estado=0;
                      this.tipoAccion = 1;
                      break;
                  }
                  case 'actualizar':
                  {
                      //console.log(data);
                      this.modal = true;
                      this.tituloModal='Actualizar Tarjeta RFID';
                      this.tipoAccion=2;
                      this.rfidData=data['idrfid'];
                      this.marca=data['marca'];
                      this.idgenero=data['idgenero'];
                      this.estado=data['estado'];
                      break;
                  }
              }
          }

      }
  },


  eliminarGanado(id){
    if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
        axios.delete(`/rfid/eliminar/${id}`)
            .then(response => {
            this.listarRfid(1,'','marca');
            console.error(error.response.data.message);
            });
        }
    },
  initializeWebSocket() {
  this.webSocket = new WebSocket('ws://192.168.100.117:81/', ['arduino']);

  this.webSocket.onopen = () => {
    console.log('Connected to WebSocket server');
    this.webSocket.send('Connect ' + new Date());
  };

  this.webSocket.onerror = (error) => {
    console.error('WebSocket Error', error);
  };

  this.webSocket.onmessage = (event) => {
    console.log('Received message:', event.data);
    this.rfidData = event.data; // Asignar el mensaje del WebSocket a la variable rfidData
  };
},
closeWebSocket() {
  if (this.webSocket) {
    this.webSocket.close(); // Cerrar el WebSocket
  }
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


