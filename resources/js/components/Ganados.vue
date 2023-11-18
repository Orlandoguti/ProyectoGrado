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
                                    <div class="textodiv">DASHBOARD
                                        <div class="page-title-subheading">UNIFRANZ S.A.
                                        </div>
                                    </div>
                                </div>
                                <div style="display: contents;">
                                    <p style="font-family: fantasy; font-size: 1.875rem; line-height: 1.5; text-align: center; max-width: 100%;">
                                        <span class="text" style=" white-space: nowrap;">UNIFRANZ S.A.</span><br><span class="text2" style="font-size: initial; white-space: nowrap;">Universidad Privada Franz Tamayo</span>
                                    </p>
                                </div>
                             <div class="imagelogopdf" style="width: 25%; text-align: center;">
                              <img src="/img/plantilla/logopdf2.png" style="width: 150px; max-width: 100%;">  
                             </div>
                            </div>
                        </div>
               </section>
            <div class="row">
                
               
                <div class="col-md-12 col-xl-12">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Materias Programadas</div>
                                    <div class="widget-subheading">Universidad Privada Franz Tamayo</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger">111</div>
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
                           <h5 class="card-title"><i class="pe-7s-graph" aria-hidden="true" title="Copy to use file-excel-o"></i> Total Progrmaciones por Carrera</h5>
                           <canvas id="polar-chart"></canvas>
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
    chartData : [],
  }

},
methods : {   
   
    fetchChartDataFromDatabase() {
        axios
            .get('/rfid/indexAdministrador')
            .then((response) => {
            this.chartData = response.data.chartData;
            this.polarChart();
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
                    data: this.chartData.map((data) => data.cantidad_materias), // Utilizamos los datos de la propiedad chartData aquí
                    backgroundColor: randomColors,
                    label: 'My dataset',
                },
                ],
                labels: this.chartData.map((data) => data.nombre_carrera), // Etiquetas del gráfico obtenidas de la propiedad chartData
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



},

mounted() {
this.fetchChartDataFromDatabase();
},
}
</script>
<style>
  .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        height: 120% !important;
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
</style>


