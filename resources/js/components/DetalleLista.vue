<template>
            <section>
                <section>
                    <div class="app-page-title">
                            <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                                <div class="page-title-heading" style="width: 25%;">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>GENERAR LISTA
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
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header"># LISTA DE GANADOS
                                    <div class="btn-actions-pane-right">
                                        <div class="input-group">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#Baucher</th>
                                            <th class="text-center">Marca</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Fecha Registro</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="detallelista in arrayDetalleLista" :key="detallelista.id">
                                            <td class="text-center text-muted"  v-text="detallelista.id"></td>
                                            <td class="text-center text-muted"  v-text="detallelista.marca"></td>
                                            <td class="text-center text-muted"  v-text="detallelista.nombre"></td>
                                            <td class="text-center text-muted"  v-text="detallelista.cantidad"></td>
                                            <td class="text-center text-muted"><span>{{detallelista.total}} Bs.</span></td>
                                            <td v-text="detallelista.fecha" class="text-center"></td>
                                            <td class="text-center">
                                                <button @click="generarPDF(detallelista.id)">Generar PDF</button>
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
                <!-- Fin ejemplo de tabla Listado -->
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade bd-example-modal-lg" :class="{'mostrar' : modal}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-top: 10%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Generar Lista</h5>
                            <button type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form @submit="validacionForm($event)" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01" class="form-label">Marca:</label>
                                                <select class="form-control" v-model="idpersona">
                                                    <option value="0" disabled>Seleccione al Afiliado</option>
                                                    <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id" v-text="persona.marca"></option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom02" class="form-label">Nombre del Afiliado:</label>
                                                <input type="text" v-model="nombre" class="form-control" placeholder="Marca de la persona" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom04" class="form-label">Grupo del Ganado:</label>
                                                <select class="form-control" v-model="idgrupo">
                                                    <option value="0" disabled>Seleccione el grupo de Faeneado</option>
                                                    <option v-for="grupo in arrayGrupo" :key="grupo.id" :value="grupo.id" v-text="grupo.nombre" v-if="grupo.id >= 1"></option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom05" class="form-label">Cantidad:</label>
                                                <input type="number" v-model="cantidad" class="form-control" placeholder="Cantidad">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom06" class="form-label">Fecha:</label>
                                                <input type="date" v-model="fecha" class="form-control" placeholder="Fecha" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-3 mb-3">
                                                <label for="validationCustom01" class="form-label">Total:</label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                  <input type="text" :value="total" class="form-control" placeholder="Total" disabled>
                                            </div>
                                        </div>
                                        <div v-show="errorValidacion"></div>
                                    </form>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarLista()">Registrar Lista</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin del modal-->
            </section>
</template>

<script>
import moment from 'moment';
export default {
  data() {
    return {
      arrayDetalleLista: [],
      cantidad:'',
      fecha:'',
      total:'',
      pagination: {
        total: 0,
        current_page: 1,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      buscar:'',
    };
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
  methods: {
        generarPDF(id) {
        const requestData ={
            id: id
        };

        axios.post('/generar-pdf-detallelista', requestData, { responseType: 'blob' })
            .then((response) => {
                const pdfBlob = new Blob([response.data], { type: 'application/pdf' });
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl, '_blank');
            })
            .catch((error) => {
                console.error('Error generating PDF:', error);
            });
    },
    detallelista(page) {
    let me = this;
    var url = `/detallelista?page=${page}`;
    axios
        .get(url)
        .then(function (response) {
        var respuesta = response.data;
        me.arrayDetalleLista = respuesta.detalleListas.data;
        me.pagination = respuesta.pagination;
        })
        .catch(function (error) {
        console.log(error);
        });
    },
    cambiarPagina(page) {
            let me = this;
            // Actualiza la página actual
            me.pagination.current_page = page;
            // Envía la petición para visualizar la data de esa página
            me.detallelista(page);
        },

    cerrarModal() {
      this.modal = 0;
      this.tituloModal = '';
      this.idpersona = '';
      this.idgrupo = '';
      this.estado = '';
      this.cantidad = '';
      this.fecha = '';
      this.errorLista = 0;
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case 'lista': {
          switch (accion) {
            case 'registrar': {
              this.modal = 1;
              this.tituloModal = 'Registrar Lista';
              this.idpersona = 0;
              this.idgrupo = 0;
              this.cantidad = 0;
              this.fecha = moment().format('YYYY-MM-DD');
              this.tipoAccion = 1;
              break;
            }
          }
        }
      }
    },
  },
  mounted() {
    this.detallelista(1);
  },
};
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
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: rgb(13, 123, 240) !important;
        font-weight: bold;
    }

</style>
