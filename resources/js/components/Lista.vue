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
                                              <select class="form-control" v-model="fmarca" @click="listagrupo1(1)">
                                                <option value="">Ninguno</option>
                                                <option value="0" disabled>Filtro por Marca</option>
                                                <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.marca" v-text="persona.marca"></option>
                                            </select>
                                            <input type="date" v-model="fechaFiltro" class="form-control" placeholder="Fecha" @change="listagrupo1(1)">
                                            <button type="button" class="btn btn-info" @click="abrirModal('lista','registrar')" data-bs-toggle="modal" style="margin-left: 1%;">
                                                <i class="fa fa-plus-circle"></i>&nbsp; Generar Lista
                                            </button>
                                           </div>
                                    </div>
                                </div>
                                <div class="card-header" style="justify-content: center;">
                                    <div class="btn-actions-pane-center">
                                        <div class="input-group" style="width: 297px;">
                                            <button class="btn btn-focus" style="margin-right: 1%;" v-for="grupo in arrayGrupo" :key="grupo.id" @click="seleccionarGrupo(grupo.nombre)" :class="{ active: grupo === grupo.nombre }" v-if="grupo.id >= 1">
                                                {{ grupo.nombre }}
                                              </button>
                                           </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Marca</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Grupo Carneo</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Genero</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="lista in arrayListaFiltrada" :key="lista.id">
                                            <td class="text-center text-muted"  v-text="lista.marca"></td>
                                            <td class="text-center text-muted"  v-text="lista.nombre"></td>
                                            <td class="text-center text-muted"  v-text="lista.gnombre"></td>
                                            <td class="text-center text-muted"  v-text="lista.total_cantidad"></td>
                                            <td class="text-center text-muted"  v-text="lista.ganados"></td>
                                            <td v-text="lista.fecha" class="text-center"></td>
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
      arrayLista: [], // Array de objetos con los datos de las listas
      idpersona: 0,
      errorRegistro: '',
      nombre: '',
      marca: '',
      genombre: '',
      grupo: 'Grupo 1',
      fmarca: 0,
      idgrupo: '',
      cantidad: 0,
      estado: '',
      fecha: '',
      fechaFiltro: '',
      arrayGrupo: [],
      arrayPersona: [],
      modal: 0,
      tituloModal: '',
      tipoAccion: 0,
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
      formValidated: false,
      errorValidacion : 0,
      errorMostrarMsjValidacion : [],
    };
  },

  computed: {
    arrayListaFiltrada() {
      let listaFiltrada = this.arrayLista;

      if (this.grupo) {
        // Filtrar por grupo seleccionado
        listaFiltrada = listaFiltrada.filter(
          (lista) => lista.gnombre === this.grupo
        );
      }

      if (this.fechaFiltro) {
        // Filtrar por fecha seleccionada
        listaFiltrada = listaFiltrada.filter(
          (lista) => lista.fecha === this.fechaFiltro
        );
      }
      if (this.fmarca) {
        // Filtrar por marca seleccionado
        listaFiltrada = listaFiltrada.filter(
          (lista) => lista.marca === this.fmarca
        );
      }

      return listaFiltrada;
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
  watch: {
    idpersona(newVal) {
      if (newVal) {
        this.getOpcionSeleccionada(newVal);
      }
    },
  },
  methods: {
    Validacion(){

                this.errorValidacion=0;
                this.errorMostrarMsjValidacion =[];
                if (this.idpersona == 0) this.errorMostrarMsjValidacion.push(""),swal('Error!', `Seleccione una Marca!`, 'warning');
                if (this.cantidad <= 0) this.errorMostrarMsjValidacion.push(""), swal('Error!', `La cantidad no puede ser menor a 0 o igual!`, 'warning');
                 if (this.idgrupo == 0) this.errorMostrarMsjValidacion.push(""),swal('Error!', `Seleecione un grupo de Faeneado!`, 'warning');
                if (this.errorMostrarMsjValidacion.length) this.errorValidacion = 1;

                return this.errorValidacion;
            },
    seleccionarGrupo(grupoId) {
        this.grupo = grupoId;
        this.fechaFiltro = '';
        this.fmarca = 0;
        this.cambiarPagina(1);
    },
    getOpcionSeleccionada(idpersona) {
      // Realiza una solicitud HTTP a tu backend para obtener los detalles de la opción seleccionada
      axios.get(`/personas/ver/${idpersona}`).then((response) => {
        this.nombre = response.data.nombre;
      });
    },
    selectPersona() {
      let me = this;
      var url = '/persona/selectPersona';
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayPersona = respuesta.personas;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    selectGrupo() {
      let me = this;
      var url = '/grupo/selectGrupo';
      axios
        .get(url)
        .then(function (response) {
          var respuesta = response.data;
          me.arrayGrupo = respuesta.grupos;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    listagrupo1(page) {
    let me = this;
    var url = `/listagrupo1?page=${page}&grupo=${this.grupo}&fechaFiltro=${this.fechaFiltro}&fmarca=${this.fmarca}`;
    axios
        .get(url)
        .then(function (response) {
        var respuesta = response.data;
        me.arrayLista = respuesta.listas.data;
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
            me.listagrupo1(page);
        },
    registrarLista() {
        if (this.Validacion()){
                    return;
                }else{
        if (this.cantidad > 3) {
            swal('Error!', 'La cantidad solo puede ser menor o igual a 3.');
            return;
        }

        const datosLista = {
            cantidad: this.cantidad,
            idpersona: this.idpersona,
            idgrupo: this.idgrupo,
            estado: 0,
            fecha: this.fecha,
        };

        axios.post('/lista/store', datosLista)
            .then((response) => {
            if (response.data.errorRegistro) {
                this.errorRegistro = response.data.errorRegistro;
                swal('Error!', `Se ha superado el límite de cantidad permitido de Faeneo para esta marca!`, 'warning');
            } else if (response.data.success) {
                swal('Registrado!', `Registro Exitoso!`, 'success');
                this.cerrarModal();
                this.listagrupo1();
                // Lógica para manejar la respuesta exitosa
            }
            })
            .catch((error) => {
            console.log(error); // Mostrar el objeto de error en la consola

            });
          }
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
            case 'actualizar': {
              //console.log(data);
              this.modal = 1;
              this.tituloModal = 'Actualizar Lista';
              this.tipoAccion = 2;
              this.idpersona = data['idpersona'];
              this.idgrupo = data['idgrupo'];
              this.estado = data['estado'];
              this.cantidad = data['cantidad'];
              this.fecha = data['fecha'];
              break;
            }
          }
        }
      }
    },
  },
  mounted() {
    this.selectPersona();
    this.selectGrupo();
    this.listagrupo1(1);
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
