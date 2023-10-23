<template>
    <section>
           <section>
            <div class="app-page-title">
                    <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                        <div class="page-title-heading" style="width: 25%;">
                            <div class="page-title-icon">
                                <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                                </i>
                            </div>
                            <div class="textodiv">MIS GANADOS FAENEADOS
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
                <div class="col-md-12 col-xl-12">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total mis Ganados Faeneados</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success">{{ totalestado2 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"># LISTA DE GANADOS FAENEADOS
                        <div class="btn-actions-pane-right">
                            <div class="input-group">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Codigo Tarjeta</th>
                                <th class="text-center">Genero</th>
                                <th class="text-center">Grupo Carneo</th>
                                <th class="text-center">Carneado</th>                                
                                <th class="text-center">Carneado Por</th>
                                <th class="text-center">Estado</th>
                            </tr>
                            </thead>
                            <tbody v-if="arrayRfidlista.length">
                                <tr v-for="rfidlista in arrayRfidlista"  :key="rfidlista.id">
                                <td class="text-center text-muted"  v-text="rfidlista.idrfid"></td>
                                <td v-text="rfidlista.gnombre" class="text-center"></td>
                                <td v-text="rfidlista.grunombre" class="text-center"></td>                               
                                <td v-if="rfidlista.estado == 0" class="text-center">
                                <span>Registrado: {{rfidlista.fecha}}</span>
                                </td>
                                <td v-if="rfidlista.estado == 2" class="text-center">
                                    <span>{{rfidlista.fechaupdate}}</span>
                                </td>
                                <td v-text="rfidlista.idfaeneo" class="text-center"></td>
                                <td  class="text-center">
                                    <div v-if="rfidlista.estado == 0">
                                        <div class="badge bg-danger">Ganado en Corral</div>
                                    </div>
                                    <div v-if="rfidlista.estado == 1">
                                        <div class="badge bg-warning">Proceo de Faeneado</div>
                                    </div>
                                    <div v-if="rfidlista.estado == 2">
                                        <div class="badge bg-success">Ganado Carneado</div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                <img width="700" class="rounded-circle" src="/img/plantilla/sin_registros.png" alt="">
                                                <h5>No se Encontraron Registros</h5>
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
    <div>
</div>
</section>

</template>
<script>
export default {

data (){
  return {
      totalestado0:'',
      totalestado1:'',
      totalestado2:'',
      arrayRfidlista: [],
      pagination : {
          'total' : 0,
          'current_page' : 0,
          'per_page' : 0,
          'last_page' : 0,
          'from' : 0,
          'to' : 0,
      },
      offset : 3,
  }

},
components: {
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

methods : {

  listarRfidlista (page){
      let me=this;
      var url= '/rfid/indexlistaAfiliado?page=' + page;
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayRfidlista = respuesta.rfidslista.data;
          me.totalestado0 = respuesta.total_estado0;
          me.totalestado1 = respuesta.total_estado1;
          me.totalestado2 = respuesta.total_estado2;
          me.pagination= respuesta.pagination;
      })
      .catch(function (error) {
          console.log(error);
      });
  },

  cambiarPagina(page){
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarRfidlista(page);
  },
},
mounted() {
this.listarRfidlista(1);
},
}
</script>

