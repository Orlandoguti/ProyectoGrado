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
                                    <div>LISTA DE CLASIFICACION
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
                        <div class="card-header"># CLASIFICACION DE EGRESOS
                            <div class="btn-actions-pane-right">
                                <div class="input-group">
                                    <button type="button" class="btn btn-info" @click="abrirModal('clasegreso','registrar')" data-bs-toggle="modal" style="margin-left: 1%;">
                                        <i class="fa fa-plus-circle"></i>&nbsp; Crear clasificacion
                                    </button>
                                   </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"># ID</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Detalles</th>
                                    <th class="text-center">Fecha de Registro</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="clasegreso in arrayClasegreso" :key="clasegreso.id" v-if="clasegreso.id > 0">
                                    <td class="text-center text-muted"  v-text="clasegreso.id"></td>
                                    <td class="text-center text-muted"  v-text="clasegreso.nombre"></td>
                                    <td class="text-center text-muted"  v-text="clasegreso.detalle"></td>
                                    <td class="text-center text-muted"  v-text="clasegreso.fecharegistro"></td>
                                    <td class="text-center text-muted" >
                                      <button type="button" @click="abrirModal('clasegreso','actualizar',clasegreso)" class="btn btn-warning btn-sm">
                                            <i style="color: white;" class="fa fa-edit" aria-hidden="true"></i>
                                          </button> &nbsp;

                                            <button type="button" class="btn btn-danger btn-sm" @click="eliminarClasegreso(clasegreso.id)">
                                                <i class="pe-7s-trash"></i>
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
                    <div class="modal fade bd-example-modal-lg" :class="{'mostrar' : modal}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="margin-top: 10%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle" v-text="tituloModal"></h5>
                                    <button type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                                <div class="row" style="justify-content: center;">
                                                    <div class="col-md-4 mb-4">
                                                        <label class="form-label">Nombre: <span style="color: red;" v-show="nombre==''"></span></label>
                                                        <input type="text" value="0" class="form-control" v-model="nombre" placeholder="Ingrese Nombre de Clasegreso....">
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <label class="form-label">Detalle de Clasificacion: <span style="color: red;" v-show="detalle==''"></span></label>
                                                        <input type="text" value="0" class="form-control" v-model="detalle" placeholder="Ingrese Detalle de Clasificacion....">
                                                    </div>

                                                </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarClasegreso()">Registrar Clasificacion</button>
                                        <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarClasegreso()">Actualizar Clasificacion</button>
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
        nombre: '',
        detalle: '',
        arrayClasegreso: [],
        pagination: {
        total: 0,
        current_page: 1,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
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
    registrarClasegreso(){
                axios.post('/clasegresos/registrar', {
            'nombre': this.nombre,
            'detalle': this.detalle
        }).then(function(response) {
            Swal.fire(
                'Registrado!',
                'La Clasificacion ha sido registrado con éxito.',
                'success'
            );
        }).catch(function(error) {
            console.error(error);
            Swal.fire(
                'Error!',
                'Hubo un problema al registrar la Clasificacion.',
                'error'
            );
        });
            },
            eliminarClasegreso(id){
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
                        axios.delete(`/clasegreso/eliminarclasegreso/${id}`)
                            .then(response => {
                            this.indexClasEgreso(1);
                            Swal.fire(
                                        'Eliminado!',
                                        'El Registro se ha sido eliminado con éxito.',
                                        'warning'
                                        )
                            console.error(error.response.data.message);
                            });
                        } else if (
                                                /* Read more about handling dismissals below */
                                                result.dismiss === Swal.DismissReason.cancel
                                            ) {
                                            }
                                            })
            },
            actualizarClasegreso(){
        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn2 btn-success',
                                cancelButton: 'btn2 btn-danger'
                            },
                            buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                            title: 'Actualizar!',
                            text: "Estás Seguro de Actualizar esta Clasificacion?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Si, Actualizar!',
                            cancelButtonText: 'No, Cancelar!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
        let me= this;
        let formData = new FormData();
                        formData.append('id', me.id);
                        formData.append('nombre', me.nombre);
                        formData.append('detalle', me.detalle);

                        axios.post('/clasegreso/actualizar', formData)
                        .then(function(response) {
                            me.cerrarModal();                            
                            Swal.fire(
                                'Actualizado!',
                                'La Clasificacion ha sido actualizado con éxito.',
                                'success'
                            );
                            me.indexClasEgreso(1);
                        })
                        .catch(function(error) {
                            console.log(error);
                            Swal.fire(
                            'Error!',
                            'Hubo un problema al actualizar la Clasificacion.',
                            'error'
                        );
                        });
                    } else if (
                                                /* Read more about handling dismissals below */
                                                result.dismiss === Swal.DismissReason.cancel
                                            ) {
                                            }
                                            })
            },
    cambiarPagina(page) {
            let me = this;
            // Actualiza la página actual
            me.pagination.current_page = page;
            // Envía la petición para visualizar la data de esa página
            me.indexClasEgreso(page);
        },

    indexClasEgreso(page) {
    let me = this;
    var url = `/clasegresos/index`;
    axios
        .get(url)
        .then(function (response) {
        var respuesta = response.data;
        me.arrayClasegreso = respuesta.clasegresos.data;
        me.pagination = respuesta.pagination;
        })
        .catch(function (error) {
        console.log(error);
        });
    },

    abrirModal(modelo, accion,data = []) {
      switch (modelo) {
        case 'clasegreso': {
          switch (accion) {
            case 'registrar': {
              this.modal = 1;
              this.tituloModal = 'Crear Clasificacion';
              this.tipoAccion = 1;
              this.nombre = '';
              this.detalle = '';
              break;
            }
            case 'actualizar': {
              this.modal = 1;
              this.tituloModal = 'Actualizar Clasificacion';
              this.tipoAccion = 2;
              this.id = data['id'];
              this.nombre = data['nombre'];
              this.detalle = data['detalle'];
              break;
            }
          }
        }
        
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = '';
      this.nombre = '';
      this.detalle = '';
    },
  },
  mounted() {
    this.indexClasEgreso(1);
  },
};
</script>
