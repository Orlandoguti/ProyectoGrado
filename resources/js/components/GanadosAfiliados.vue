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
                                <div class="textodiv">MIS MATERIAS
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
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Mis Ganados en Corral</div>
                                    <div class="widget-subheading">Federacion Unica de Trabajadores en Carne y Ramas Anexas.</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger">10</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header"># LISTA DE MATERIAS
                                    <div class="btn-actions-pane-right">
                                        <div class="input-group">
                                           </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Codigo</th>
                                            <th class="text-center">Materia</th>
                                            <th class="text-center">Docente</th>
                                            <th class="text-center">Paralelo</th>
                                            <th class="text-center">Aula</th>
                                        </tr>
                                        </thead>
                                        <tbody v-if="arrayMaterias.length">
                                            <tr v-for="materia in arrayMaterias" :key="materia.id">                                                
                                            <td class="text-center text-muted"  v-text="materia.codigo"></td>
                                            <td class="text-center text-muted"  v-text="materia.materia"></td>
                                            <td class="text-center text-muted" v-text="materia.docente"></td>
                                            <td class="text-center text-muted"  v-text="materia.paralelo"></td>
                                            <td class="text-center text-muted"  v-text="materia.nombre"></td>
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
import moment from 'moment';
export default {

data (){
  return {
      totalestado0:'',
      arrayMaterias : [],      
      pagination: {
        total: 0,
        current_page: 1,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,      
  }

},
computed: {
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

methods : {
    cambiarPagina(page) {
            let me = this;
            // Actualiza la página actual
            me.pagination.current_page = page;
            // Envía la petición para visualizar la data de esa página
            me.listarMateria(page);
        },
    listarMateria (page){
      let me=this;
      var url= '/indexMateria?page=' + page;
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayMaterias = respuesta.materias.data;
          me.pagination= respuesta.pagination;
      })
      .catch(function (error) {
          console.log(error);
      });
  },



},

mounted() {
this.listarMateria();
},
}
</script>
