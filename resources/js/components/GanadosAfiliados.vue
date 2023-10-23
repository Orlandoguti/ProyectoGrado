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
                                <div class="textodiv">MIS GANADOS
                                    <div class="page-title-subheading">F.U.T.E.C.R.A.
                                    </div>
                                </div>
                            </div>
                            <div style="display: contents;">
                                    <img src="/img/plantilla/toro2izq.png" style="width: 130px; max-width: 100%; min-width: 1%;">
                                    <p style="font-family: fantasy; font-size: 1.875rem; line-height: 1.5; text-align: center; max-width: 100%;">
                                        <span class="text" style=" white-space: nowrap;">F.U.T.E.C.R.A.</span><br><span class="text2" style="font-size: initial; white-space: nowrap;">Federacion Unica de Trabajadores en Carne y Ramas Anexas</span>
                                    </p>
                                    <img src="/img/plantilla/toro2der.png" style="width: 130px; max-width: 100%; min-width: 1%;">
                                </div>
                             <div class="imagelogopdf" style="width: 25%; text-align: center;">
                              <img src="/img/plantilla/logopdf2.png" style="width: 100px; max-width: 100%;">  
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
                                    <div class="widget-heading">Total Mis Ganados Faeneados</div>
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
                                    <div class="widget-heading">Total Mis Ganados Proceso de Carneo</div>
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
                                    <div class="widget-heading">Total Mis Ganados en Corral</div>
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
            <div style="text-align: center; font-weight: bold; color: chocolate; font-size: 1.5rem;">
                <p>{{ formattedDate }}</p>
            </div>
            <div v-if="arrayRfid.length" class="col-md-12">
                <div class="row justify-content-start">
                    <div style="text-align: center;" class="col-md-4" v-for="(rfid, index) in arrayRfid" :key="rfid.id">
                        <div class="cardafiliado">
                            <div class="cardafiliado_image">
                                <div v-if="rfid.gnombre == 'Toro'">
                                    <img src="/img/plantilla/toro.png" style="width: 250px;" alt="" />
                                </div>
                                <div v-if="rfid.gnombre == 'Vaca'">
                                    <img src="/img/plantilla/vaca.png" style="width: 250px;" alt="" />
                                </div>
                            </div>
                            <div class="cardafiliado_header">
                                <h2 class="cardafiliado_header__title"><span v-text="rfid.gnombre"></span></h2>
                            </div>
                            <div class="cardafiliado_description">
                                <div class="cardafiliado_description__content">
                                    <div v-if="rfid.estado == 0">
                                        <div class="badge bg-danger">Ganado en Corral</div>
                                    </div>
                                    <div v-if="rfid.estado == 1">
                                        <div class="badge bg-warning">Proceso de Faenado</div>
                                    </div>
                                    <div v-if="rfid.estado == 2">
                                        <div class="badge bg-success">Ganado Carneado</div>
                                    </div>
                                </div>
                                <span>Grupo de Carneo:</span> <span v-text="rfid.grunombre" class="text-center"></span> <br>
                                <span v-if="rfid.estado < 2">Fecha de Registro:</span> <span v-if="rfid.estado < 2" v-text="rfid.fecha" class="text-center"></span> <br>
                                <span v-if="rfid.estado == 2">Fecha y Hora de Faeneo:</span> <span v-if="rfid.estado == 2" v-text="rfid.fechaupdate" class="text-center"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="col-md-12" style="display: flex; justify-content: center; text-align: center;">
                <div>                    
                <img width="700" class="rounded-circle" src="/img/plantilla/sin_registros.png" alt="">
                                                <h5>No se Encontraron Registros</h5>
                </div>
            </div>      
        </div>
    <div>
</div>
</section>

</template>
<script>
import moment from 'moment';
export default {

data (){
  return {
      totalestado0:'',
      totalestado1:'',
      totalestado2:'',
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
      date1 : '',
      date2 : '',
  }

},
created() {
    moment.locale('es');
    const dayOfWeekLowerCase = moment().format("dddd");
    const dayOfWeekUpperCase = dayOfWeekLowerCase.toUpperCase();
    this.formattedDate = dayOfWeekUpperCase + " " + moment().format("DD-MM-YYYY");
  },
computed:{
totalRegistros() {
  const total0 = parseInt(this.totalestado0) || 0;
  const total1 = parseInt(this.totalestado1) || 0;
  const total2 = parseInt(this.totalestado2) || 0;

  return total0 + total1 + total2;
},

},
methods : {
  listarRfid (page,buscar,date1,date2){
      let me=this;
      var url= '/rfid/indexAfiliado';
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



},

mounted() {
this.listarRfid();
setInterval(() => {
    this.listarRfid();
}, 5000);
},
}
</script>

<style>
.cardafiliado {
    padding: 20px;
    background-color: #f1f3f4;
    font-family: "Roboto", sans-serif;
    border-radius: 5px;

    &_image {
      margin-bottom: 20px;
      width: 250px;
      img {
        width: 100%;
        height: 100%;
        object-fit: contain;
      }
    }

    &_header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      &__title {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
      }
      &__price {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        color: #14828c;
      }
    }

    &_description {
      margin-bottom: 20px;
      &__content {
        &-text {
          font-size: 14px;
          color: #787878;
          font-weight: 500;
        }
      }
    }
   }
</style>
