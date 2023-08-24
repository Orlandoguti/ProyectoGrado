<template>
    <section>
        <section>
                <div class="app-page-title">
                        <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                            <div class="page-title-heading" style="width: 25%;">
                                <div class="page-title-icon">
                                    <i class="pe-7s-display1 icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>CORRALES
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
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="pe-7s-graph" aria-hidden="true" title="Copy to use file-excel-o"></i> Total Toros</h5>
                            <canvas id="doughnut-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="pe-7s-graph" aria-hidden="true" title="Copy to use file-excel-o"></i> Total Vacas</h5>
                            <canvas id="doughnut-chart2"></canvas>
                        </div>
                    </div>
                </div>
         </div>
            <div class="row">
                <div class="col-md-6 col-xl-6">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Ganados Corral Toros</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers" style="color: rgba(25, 139, 201, 1)">{{ total_toros }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Ganados Corral Vacas</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers" style="color: rgb(225, 21, 128)">{{ total_vacas }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                     <div class="main-card mb-3 card">
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title">Nivel de Agua Corral de Toros</h5>
                            <div style="display: flex; justify-content: center;">
                                <canvas id="nivelagua"></canvas>
                            </div>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title">Temperatura y Humedad</h5>
                            <div style="display: flex; justify-content: center;">
                                <div id="gauge-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body" style="text-align: center;">
                                <h5 class="card-title">Nivel de Agua Corral de Vacas</h5>
                                <div style="display: flex; justify-content: center;">
                                    <canvas id="nivelagua2"></canvas>
                                </div>
                            </div>
                            <div class="card-body" style="text-align: center;">
                                <h5 class="card-title">Temperatura y Humedad</h5>
                                <div style="display: flex; justify-content: center;">
                                    <div id="gauge-chart2"></div>
                                </div>
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
      total_toros:'',
      total_vacas:'',
      webSocket: null,
      waterLevelStr: [],
      temperature: '', // Aquí almacenaremos las temperaturas
      humidity: '',    // Aquí almacenaremos las humedades
      chartData:[],
      chartData1:[],
      fecha : '',
  }

},
methods : {
    fetchChartDataFromDatabase() {
  // Obtener la fecha actual (opcional, si quieres mostrar los datos de la fecha actual por defecto)
        axios
            .get('/rfid/indexCorral')
            .then((response) => {
            this.chartData = response.data.chartData;
            this.chartData1 = response.data.chartData1;
            this.ChartDoughnut();
            this.ChartDoughnut1();
            })
            .catch((error) => {
            console.error('Error fetching data:', error);
            });
        },
        generateRandomColors(numColors, opacity) {
            var colors = [];

            for (let i = 0; i < numColors; i++) {
                // Generar un color hexadecimal aleatorio con la opacidad especificada
                var color = '#' + Math.floor(Math.random() * 16777215).toString(16);
                colors.push(color);
            }

            return colors;
        },

    ChartDoughnut() {
            var ctx = document.getElementById('doughnut-chart');

            if (ctx && this.chartData.length > 0) {
                var randomColors = this.generateRandomColors(this.chartData.length,1);

                var configDoughnut = {
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
                    display: true,
                    },
                    animation: {
                    animateRotate: false,
                    animateScale: true,
                    },
                },
                };

                new Chart(ctx, {
                type: 'doughnut',
                data: configDoughnut.data,
                options: configDoughnut.options,
                });
            }
            },
            ChartDoughnut1() {
            var ctx = document.getElementById('doughnut-chart2');

            if (ctx && this.chartData1.length > 0) {
                var randomColors = this.generateRandomColors(this.chartData1.length,1);

                var configDoughnut = {
                data: {
                    datasets: [
                    {
                        data: this.chartData1.map((data) => data.total), // Utilizamos los datos de la propiedad chartData aquí
                        backgroundColor: randomColors,
                        label: 'My dataset',
                    },
                    ],
                    labels: this.chartData1.map((data) => data.marca), // Etiquetas del gráfico obtenidas de la propiedad chartData
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
                type: 'doughnut',
                data: configDoughnut.data,
                options: configDoughnut.options,
                });
            }
            },

    datosChart() {
        document.addEventListener('temperatureUpdate', (event) => {
      this.temperature = event.detail;
        });
        document.addEventListener('humidityUpdate', (event) => {
        this.humidity = event.detail;
        });
        document.addEventListener('waterLevelUpdate', (event) => {
        this.waterLevelStr = event.detail;
        });

        },
    initializeWaterBubble() {
        const bubbleColor1 = "rgba(25, 139, 201, 1)";

        $('#nivelagua').waterbubble({
            waterColor: bubbleColor1
        });

        // Función para actualizar el valor de datos cada segundo
        const updateWaterLevel = () => {
            const interval = setInterval(() => {
            // Actualizar el valor de datos usando this.waterLevelStr
            const data = parseFloat(this.waterLevelStr) || 0; // Convertir a número y manejar NaN
            $('#nivelagua').waterbubble({
                radius: 100,
                lineWidth: undefined,
                textColor: 'rgba(06, 85, 128, 0.8)',
                data,
                waterColor: bubbleColor1,
                font: '',
                wave: true,
                txt: '',
                animation: true
            });
            }, 2000); // Actualizar cada segundo

            // Detener la actualización al destruir el componente
            this.$once('hook:beforeDestroy', () => {
            clearInterval(interval);
            });
        };

      updateWaterLevel();
    },

    initializeWaterBubble2() {
        const bubbleColor1 = "rgb(255, 139, 201)";

        $('#nivelagua2').waterbubble({
            waterColor: bubbleColor1
        });

        // Función para actualizar el valor de datos cada segundo
        const updateWaterLevel = () => {
            const interval = setInterval(() => {
            // Actualizar el valor de datos usando this.waterLevelStr
            const data = parseFloat(this.waterLevelStr) || 0; // Convertir a número y manejar NaN
            $('#nivelagua2').waterbubble({
                radius: 100,
                lineWidth: undefined,
                textColor: 'rgb(225, 21, 128)',
                data,
                waterColor: bubbleColor1,
                font: '',
                wave: true,
                txt: '',
                animation: true
            });
            }, 2000); // Actualizar cada segundo

            // Detener la actualización al destruir el componente
            this.$once('hook:beforeDestroy', () => {
            clearInterval(interval);
            });
        };

      updateWaterLevel();
    },

    drawChart() {
        if (this.temperature === '' && this.humidity === '') {

        const defaultData = google.visualization.arrayToDataTable([
          ["Label", "Value"],
          ["Temperatura", 0],
          ["Humedad", 0],
        ]);
        const options = {
          width: 420, height: 420,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        const chartContainer = document.getElementById('gauge-chart');
        const chart = new google.visualization.Gauge(chartContainer);

        chart.draw(defaultData, options);
      } else {
        const data = google.visualization.arrayToDataTable([
          ["Label", "Value"],
          ["Temperatura", this.temperature],
          ["Humedad", this.humidity],
        ]);


        const options = {
          width: 420, height: 420,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        const chartContainer = document.getElementById('gauge-chart');
        const chart = new google.visualization.Gauge(chartContainer);

        chart.draw(data, options);
      }
    },
    drawChart2() {
        if (this.temperature === '' && this.humidity === '') {

        const defaultData = google.visualization.arrayToDataTable([
        ["Label", "Value"],
        ["Temperatura", 0],
        ["Humedad", 0],
        ]);
        const options = {
        width: 420, height: 420,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5
        };

        const chartContainer = document.getElementById('gauge-chart2');
        const chart = new google.visualization.Gauge(chartContainer);

        chart.draw(defaultData, options);
        } else {
        const data = google.visualization.arrayToDataTable([
        ["Label", "Value"],
        ["Temperatura", this.temperature],
        ["Humedad", this.humidity],
        ]);


        const options = {
        width: 420, height: 420,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5
        };

        const chartContainer = document.getElementById('gauge-chart2');
        const chart = new google.visualization.Gauge(chartContainer);

        chart.draw(data, options);
        }
    },

    listarGanados (){
        let me=this;
        var url= '/rfid/indexCorral';
        axios.get(url).then(function (response) {
            var respuesta= response.data;
            me.total_toros = respuesta.total_toros;
            me.total_vacas = respuesta.total_vacas;
        })
        .catch(function (error) {
            console.log(error);
        });
    },
  },
  mounted() {
    this.datosChart(); // Inicializar WebSocket primero
    this.fecha = moment().format('HH:mm:ss');
    this.initializeWaterBubble();
    this.initializeWaterBubble2();
    this.listarGanados();
    this.fetchChartDataFromDatabase();


    setInterval(() => {
        this.listarGanados();
        google.charts.load("current", { packages: ["gauge"] });
        google.charts.setOnLoadCallback(() => {
        this.drawChart(); // Call your chart-related methods here
        this.drawChart2();
    });
      }, 1000);
},
};
</script>
