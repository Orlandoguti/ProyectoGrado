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

               <div class="row" style="display: flex; justify-content: center; text-align: center;">
                <a  @click="toggleInputDisabled()"><span>Cantidad Maxima de Faeneo por Grupo</span></a>
                <div class="col-md-1">
                            <div class="main-card mb-3 card">
                            <input type="number" style="text-align: center; color: coral;" class="form-control" v-model="maxtotalfaeneo" @change="actualizarmaxfaeneo()" :disabled="inputDisabled">
                        </div>
                    </div>
                </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header"># LISTA DE GANADOS
                                    <div class="btn-actions-pane-right">
                                        <div class="input-group">
                                            <select class="form-control" v-model="grupo" @click="listagrupo1(1,date1,date2)">
                                                <option value="" disabled>Filtro por Grupo</option>
                                                <option value="">Ninguno</option>
                                                <option v-for="grupo in arrayGrupo" :key="grupo.id"  v-text="grupo.nombre" v-if="grupo.id >= 1"></option>
                                              </select>
                                              <select class="form-control" v-model="fmarca" @click="listagrupo1(1,date1,date2)">
                                                <option value="">Ninguno</option>
                                                <option value="0" disabled>Filtro por Marca</option>
                                                <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.marca" v-text="persona.marca"></option>
                                            </select>
                                            <input type="date" v-model="date1" @change="listagrupo1(1,date1,date2)"  class="form-control" placeholder="Ingrese la Fecha">
                                            <span style="display: flex; align-items: center;">-</span>
                                            <input type="date" v-model="date2" @change="listagrupo1(1,date1,date2)" class="form-control" placeholder="Ingrese la Fecha">
                                            <button type="button" class="btn btn-info" @click="abrirModal('lista','registrar')" data-bs-toggle="modal" style="margin-left: 1%;">
                                                <i class="fa fa-plus-circle"></i>&nbsp; Generar Lista
                                            </button>
                                            <button type="submit" @click="generarPDFLista(date1,date2,grupo,marca)" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Copy to use file-pdf-o"></i></button>
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
                                            <th class="text-center">Fecha de Registro</th>
                                        </tr>
                                        </thead>
                                        <tbody v-if="arrayListaFiltrada.length">
                                            <tr v-for="lista in arrayListaFiltrada" :key="lista.id">
                                            <td class="text-center text-muted"  v-text="lista.marca"></td>
                                            <td class="text-center text-muted">{{ lista.nombre + ' ' + lista.apellidoP + ' ' + lista.apellidoM }}</td>
                                            <td class="text-center text-muted"  v-text="lista.gnombre"></td>
                                            <td class="text-center text-muted"  v-text="lista.total_cantidad"></td>
                                            <td v-text="lista.fecha" class="text-center"></td>
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
                                    <form @submit.prevent="registrarLista" ref="form" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01" class="form-label">Marca:</label>
                                                <select class="form-control" v-model="idpersona" required>
                                                    <option value="" disabled>Seleccione al Afiliado</option>
                                                    <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id" v-text="persona.marca"></option>
                                                </select>
                                                <div class="invalid-feedback"> Seleccione el Afiliado!</div>
                                            <div class="valid-feedback"> Correcto! </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom02" class="form-label">Nombre del Afiliado:</label>
                                                <input :value="nombre + ' ' + apellidoP + ' ' + apellidoM" type="text" class="form-control" id="validationCustom03" placeholder="Nombre del Afiliado" required disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom05" class="form-label">Cantidad:</label>
                                                <input type="number" v-model="cantidad" class="form-control" placeholder="Cantidad" required>
                                                <div class="invalid-feedback"> Ingrese la Cantidad!</div>
                                            <div class="valid-feedback"> Correcto! </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom06" class="form-label">Fecha:</label>
                                                <input type="date" v-model="fecha" class="form-control" placeholder="Fecha" disabled>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01" class="form-label">Total a Pagar:</label>
                                                <input type="text" :value="total + ' Bs.'" class="form-control" placeholder="Total" disabled>
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
import toastr from 'toastr';
export default {
  data() {
    return {
      maxtotalfaeneo: 0,
      total: 0,
      arrayLista: [], // Array de objetos con los datos de las listas
      idpersona: '',
      errorRegistro: '',
      nombre: '',
      apellidoP: '',
      apellidoM: '',
      marca: '',
      genombre: '',
      grupo: '',
      fmarca: 0,
      idgrupo: '',
      cantidad: 0,
      estado: '',
      fecha: '',
      date1: '',
      date2: '',
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
      inputDisabled: true,
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

    cantidad: function(newCantidad) {
    // Multiplicar cantidad por 24 y actualizar this.total
    this.total = newCantidad * 24;
    },
    idpersona(newVal) {
      if (newVal) {
        this.getOpcionSeleccionada(newVal);
      }
    },
  },
  methods: {
    imprimirBaucher() {

      window.print();
    },
    toggleInputDisabled() {
            this.inputDisabled = !this.inputDisabled;
        },
    actualizarmaxfaeneo() {
    let formData = new FormData();
    formData.append("totalfaeneo", this.maxtotalfaeneo);

    axios
        .post("/variables/actualizarTotal", formData, {
            headers: {
                "Content-Type": "multipart/form-data"
            },
        })
        .then((response) => {
            toastr.options = {
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                preventDuplicates: false,
                onclick: null,
                showDuration: '500',
                hideDuration: '1000',
                timeOut: '5000',
                extendedTimeOut: '1000',
                showEasing: 'swing',
                hideEasing: 'linear',
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut',
            };
            toastr.success('Se ha actualizado la cantidad: ' + this.maxtotalfaeneo, 'Actualizado');
            this.inputDisabled=true;
        })
        .catch((error) => {
            toastr.error('No se ha podido actualizar.', 'Error');
            console.log(error);
        });
},

    generarPDFLista(date1, date2,) {
        const requestData = {
            date1: date1,
            date2: date2,
            grupo: this.grupo,
            fmarca: this.fmarca
        };

        axios.post('/generar-pdf-lista', requestData, { responseType: 'blob' })
            .then((response) => {
                const pdfBlob = new Blob([response.data], { type: 'application/pdf' });
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl, '_blank');
            })
            .catch((error) => {
                console.error('Error generating PDF:', error);
            });
    },

    Validacion(){

                this.errorValidacion=0;
                this.errorMostrarMsjValidacion =[];
                if (this.cantidad <= 0) this.errorMostrarMsjValidacion.push(""), Swal.fire('Error!', `La cantidad no puede ser menor a 0 o igual!`, 'warning');
                if (this.errorMostrarMsjValidacion.length) this.errorValidacion = 1;

                return this.errorValidacion;
            },
    seleccionarGrupo(grupoId) {
        this.grupo = grupoId;
        this.fmarca = 0;
        this.cambiarPagina(1);
    },
    getOpcionSeleccionada(idpersona) {
      // Realiza una solicitud HTTP a tu backend para obtener los detalles de la opción seleccionada
      axios.get(`/personas/ver/${idpersona}`).then((response) => {
        this.nombre = response.data.nombre;
        this.apellidoP = response.data.apellidoP;
        this.apellidoM = response.data.apellidoM;
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
    listagrupo1(page,date1,date2) {
    let me = this;
    var url = `/listagrupo1?page=${page}&date1=${date1}&date2=${date2}&grupo=${this.grupo}&fmarca=${this.fmarca}`;
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
    indextotalmaxfaeneo(maxtotalfaeneo) {
    let me = this;
    var url = `/variables/indexVariables?maxtotalfaeneo=${maxtotalfaeneo}`;
    axios
        .get(url)
        .then(function (response) {
        var respuesta = response.data;
        me.maxtotalfaeneo = respuesta.maxfaeneo;
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
            me.listagrupo1(page,this.date1,this.date2);
        },
        registrarLista() {
            if (this.$refs.form.checkValidity()) {
            if (this.Validacion()) {
                return;
            } else {
                if (this.cantidad > 3) {
                    Swal.fire('Error!', 'Solo se puede ingresar la cantidad igual o menor 3.', 'warning');
                    return;
                }
            const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Registrar!',
                    text: "Estás Seguro de Registrar este Ingreso?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Registrar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

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
                        Swal.fire('Error!', this.errorRegistro, 'warning');
                    } else if (response.data.success) {
                        window.open('/lista-pdf');
                        Swal.fire('Registrado!', 'Registro Exitoso!', 'success');
                        this.listagrupo1(1,this.date1,this.date2,this.grupo,this.fmarca);
                        this.cerrarModal();
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
                } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
                }
            } else {
              Swal.fire('Validacion!', 'Porfavor llena todos los campos!', 'warning');
              this.formValidated = true;
                    }
        },

    cerrarModal() {
      this.modal = 0;
      this.tituloModal = '';
      this.idpersona = '';
      this.nombre = '';
      this.apellidoP = '';
      this.apellidoM = '';
      this.idgrupo = '';
      this.estado = '';
      this.cantidad = '';
      this.fecha = '';
      this.errorLista = 0;
      this.this.formValidated = false;
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case 'lista': {
          switch (accion) {
            case 'registrar': {
              this.modal = 1;
              this.tituloModal = 'Registrar en la Lista';
              this.idpersona = '';
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
    this.listagrupo1(1,this.date1,this.date2);
    this.indextotalmaxfaeneo(this.maxtotalfaeneo);
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
