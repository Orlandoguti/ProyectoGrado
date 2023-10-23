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
                            <div class="textodiv">REGISTRAR GANADO
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
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"># LISTA DE GANADOS
                        <div class="btn-actions-pane-right">
                            <div class="input-group">
                                <input type="text" v-model="buscar" @keyup.enter="listarRfid(1,buscar)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarRfid(1,buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                <button type="button" class="btn btn-info" @click="abrirModal('rfid','registrar')" data-bs-toggle="modal" style="margin-left: 1%;">
                                    <i class="fa fa-plus-circle"></i>&nbsp; Registrar Ganado
                                </button>
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
                                <th class="text-center">Fecha Registro</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody v-if="arrayRfid.length">
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
                                                <div>                                                    
                                                    <span v-text="rfid.nombre" class="widget-subheading opacity-7"></span>
                                                    <span v-text="rfid.apellidoP" class="widget-subheading opacity-7"></span>
                                                    <span v-text="rfid.apellidoM" class="widget-subheading opacity-7"></span>
                                                </div>
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
                                        <div class="badge bg-warning">Proceso de Faeneado</div>
                                    </div>
                                    <div v-if="rfid.estado == 2">
                                        <div class="badge bg-success">Ganado Carneado</div>
                                    </div>
                                </td>
                                <td v-text="rfid.fecha" class="text-center"></td>
                                <td class="text-center">
                                    <button v-if="rfid.estado == 2" type="button" @click="enviarMensajeWhatsApp(rfid)" class="btn btn-success btn-sm">
                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                      </button> &nbsp;

                                    <button type="button" @click="abrirModal('rfid','actualizar',rfid)" class="btn btn-warning btn-sm">
                                        <i style="color: white;" class="fa fa-edit" aria-hidden="true"></i>
                                      </button> &nbsp;

                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarGanado(rfid.id)">
                                            <i class="pe-7s-trash"></i>
                                        </button>
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
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar)">Sig</a>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Registrar Ganado</h5>
                        <button type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form @submit.prevent="registrarRfid" ref="form" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom01" class="form-label">ID Tarjeta:</label>
                                            <input v-model="rfidData" type="text" class="form-control" id="validationCustom01" placeholder="Registre la Tarjeta" required :disabled="!inputHabilitado">
                                            <div class="invalid-feedback"> Añada un ID Tarjeta!</div>
                                            <div class="valid-feedback"> Correcto! </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Habilitar Edicion ID:</label>
                                            <input type="checkbox" class="inputcheck" @click="habilitarInput" v-model="inputHabilitado"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02" class="form-label">Marca del Afiliado:</label>
                                            <select name="select" v-model="idpersona" id="validationCustom02" class="form-select" placeholder="Marca Afiliado" required>
                                                <option value="" disabled>Seleccione al Afiliado</option>
                                                <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id" v-text="persona.marca"></option>
                                            </select>
                                            <div class="invalid-feedback"> Selecciona un Afiliado!</div>
                                            <div class="valid-feedback"> Correcto!</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03" class="form-label">Nombre:</label>
                                            <input :value="nombre + ' ' + apellidoP + ' ' + apellidoM" type="text" class="form-control" id="validationCustom03" placeholder="Nombre del Afiliado" required disabled>
                                            <div class="invalid-feedback">
                                                Correcto!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04" class="form-label">Genero del Ganado:</label>
                                            <select name="select" v-model="idgenero" id="validationCustom04" class="form-select" placeholder="Marca Afiliado" required>
                                                <option value="" disabled>Seleccione el Genero</option>
                                                <option v-if="genero.id >= 1" v-for="genero in arrayGenero" :key="genero.id" :value="genero.id" v-text="genero.nombre" ></option>
                                            </select>
                                            <div class="invalid-feedback"> Porfavor Ingrese el Genero!</div>
                                            <div class="valid-feedback"> Correcto!</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05" class="form-label">Estado del Ganado:</label>
                                            <input v-model="estado" type="text" class="form-control" id="validationCustom05" placeholder="Estado del Ganado" required disabled>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom06" class="form-label">Fecha:</label>
                                            <input v-model="fecha" type="date" class="form-control" id="validationCustom06" placeholder="Fecha" required disabled>
                                            <div class="invalid-feedback">
                                                Fecha No ingresada.
                                            </div>
                                        </div>
                                    </div>
                                    <div v-show="errorValidacion"></div>
                                </form>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarRfid()">Registrar Ganado</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarRfid()">Actualizar Ganado</button>
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
import toastr from 'toastr';
export default {

data (){
  return {
      errorValidacion : 0,
      errorMostrarMsjValidacion : [],
      inputHabilitado: false,
      formValidated: false,
      totalestado0:'',
      totalestado1:'',
      totalestado2:'',
      webSocket: null,
      rfidData: '',
      idpersona : 0,
      fecha : '',
      fecharegistro:'',
      marca : '',
      nombre : '',
      apellidoP : '',
      apellidoM : '',
      telefono : '',
      id : 0,
      idgenero : 0,
      estado : 0,
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
watch: {
idpersona(newVal) {
  if (newVal) {
    this.getOpcionSeleccionada(newVal);
  }
},
},

methods : {
        enviarMensajeWhatsAppRegistrar() {
        let me = this;
        me.fecharegistro=moment().format("DD-MM-YYYY");
        if (me.estado == 0){
            me.estado = 'Ingresando al corral';
            var settings = {
                        async: true,
                        crossDomain: true,
                        url: "https://api.ultramsg.com/instance65365/messages/chat",
                        method: "POST",
                        data: {
                        token: "kwpdjhrs6i7owtjo",
                        to: me.telefono,
                        body: 'Tu ganado con el IDRFID: *' + me.rfidData + '* ya fue registrado en fecha: ' + me.fecharegistro + ' y esta '+ me.estado +' puedes monitorearlo en la pagina del Sistema. Att: F.U.T.E.C.R.A.'
                        }
                    };

                    // Realizar la solicitud POST
                    $.ajax(settings)
                        .done(function (response) {
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
                        toastr.success('Se ha informado al dueño del ganado. ','Mensaje Enviado');
                        console.log(response);
                        // Haz lo que necesites con la respuesta, como mostrar un mensaje de éxito
                        })
                        .fail(function (error) {
                        console.error("Error al enviar el mensaje de WhatsApp:", error);
                        // Manejar el error, si es necesario
                        });
                    }

                },


    enviarMensajeWhatsApp(rfid) {
      var settings = {
        async: true,
        crossDomain: true,
        url: "https://api.ultramsg.com/instance65365/messages/chat",
        method: "POST",
        data: {
          token: "kwpdjhrs6i7owtjo",
          to: rfid.telefono,
          body: 'Señor(a): ' + rfid.nombre + rfid.apellidoP + rfid.apellidoM + ' Tu ganado Ingresado: ' + rfid.fecha + ' ya fue carneado en el: ' + rfid.grunombre + ' Genero: ' + rfid.gnombre + ' Ya puedes Venir a Recojerlo Att: F.U.T.E.C.R.A.'
        }

      };
      $.ajax(settings).done(function (response) {
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
            toastr.success('Se ha enviado el mensaje','Enviado');
        console.log(response);
        // Haz lo que necesites con la respuesta, como mostrar un mensaje de éxito
      });
    },
    enviargmail() {
      var url= '/rfid/gmail';
      axios.post(url).then(function (response) {
      })
      .catch(function (error) {
          console.log(error);
      });
  },
    habilitarInput() {
      this.inputDeshabilitado = false; // Cambia el valor para habilitar el input
    },

    getOpcionSeleccionada(idpersona) {
    // Realiza una solicitud HTTP a tu backend para obtener los detalles de la opción seleccionada
    axios.get(`/personas/ver/${idpersona}`).then((response) => {
        this.nombre = response.data.nombre;
        this.apellidoP = response.data.apellidoP;
        this.apellidoM = response.data.apellidoM;
        this.telefono = response.data.telefono;
    });
    },

  listarRfid (page,buscar){
      let me=this;
      var url= '/rfid/index?page=' + page + '&buscar='+ buscar;
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

  selectPersona(){
      let me=this;
      var url= '/persona/selectPersona';
      axios.get(url).then(function (response) {
          //console.log(response);
          var respuesta= response.data;
          me.arrayPersona = respuesta.personas;
      })
      .catch(function (error) {
          console.log(error);
      });
  },
  selectGenero(){
      let me=this;
      var url= '/genero/selectGenero';
      axios.get(url).then(function (response) {
          //console.log(response);
          var respuesta= response.data;
          me.arrayGenero = respuesta.generos;
      })
      .catch(function (error) {
          console.log(error);
      });
  },

  cambiarPagina(page,buscar){
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarRfid(page,buscar);
  },
    Validacion(){
        if (this.rfidData==0) {
            Swal.fire('Error!', `El ID RFID no puede estar vacio o estar en 0.`, 'warning');
        }
                this.errorValidacion=0;
                this.errorMostrarMsjValidacion =[];

                if (this.rfidData == 0) this.errorMostrarMsjValidacion.push("");
                if (this.errorMostrarMsjValidacion.length) this.errorValidacion = 1;

                return this.errorValidacion;
            },
    registrarRfid() {
            let me = this;
            // Verificar si hay un registro con el mismo RFID y estado 3

            if (this.Validacion()){
                    return;
                }else{
                    if (this.$refs.form.checkValidity()) {
                axios.get('/rfid/verificar', {
                        params: {
                        rfidData: this.rfidData
                        }
                    })
                    .then(function(response) {
                        const registros = response.data.registros;

                        if (registros.length > 0) {
                        // Mostrar alerta de que ya existe un registro con el mismo RFID y estado 3
                        Swal.fire('Error!', `El ID Tarjeta está registrado con una Marca.`, 'warning');
                        } else {
                        // No hay registros existentes, proceder con el registro
                        let formData = new FormData();
                        formData.append('idrfid', me.rfidData);
                        formData.append('idpersona', me.idpersona);
                        formData.append('marca', me.marca);
                        formData.append('idgenero', me.idgenero);
                        formData.append('estado', me.estado=0);
                        formData.append('fecha', me.fecha);

                        axios.post('/rfid/registrar', formData)
                        .then(function(response) { 
                            me.cerrarModal(); 
                            toastr.info('Se ha registrado el ganado.','Registrado');                            
                            me.enviarMensajeWhatsAppRegistrar();
                            me.listarRfid(1,this.buscar);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                        }
                    })
                     } else {
                        Swal.fire('Validacion!', 'Porfavor llena todos los campos!', 'warning');
                    this.formValidated = true;
                }
        }
       },
       actualizarRfid() {
            let me = this;
            // Verificar si hay un registro con el mismo RFID y estado 3

            if (this.Validacion()){
                    return;
                }else{
                    if (this.$refs.form.checkValidity()) {

                        let formData = new FormData();
                        formData.append('id', me.id);
                        formData.append('idrfid', me.rfidData);
                        formData.append('idpersona', me.idpersona);
                        formData.append('marca', me.marca);
                        formData.append('idgenero', me.idgenero);
                        formData.append('fecha', me.fecha);

                        axios.post('/rfid/actualizar', formData)
                        .then(function(response) {
                            me.cerrarModal();
                            me.listarRfid(1,this.buscar);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                     } else {
                    this.formValidated = true;
                }
        }
       },
  cerrarModal(){
      this.inputHabilitado = false;
      this.modal= false;
      this.tituloModal='';
      this.idrfid= 0;
      this.idpersona = '';
      this.nombre = '';
      this.apellidoP = '';
      this.apellidoM = '';
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
                      this.estado='Ingresando al Corral';
                      this.tipoAccion = 1;
                      break;
                  }
                  case 'actualizar': {
                        this.modal = true;
                        this.tituloModal = 'Actualizar Tarjeta RFID';
                        this.tipoAccion = 2;
                        this.id=data['id'];
                        this.rfidData = data['idrfid'];
                        this.idpersona = data['idpersona'];
                        if (data['estado'] === 0 ) {
                            this.estado = 'GANADO EN EL CORRAL';
                        } else { if (data['estado'] === 1 ) {
                            this.estado = 'PROCESO DE FAENEADO';
                        }else{ if (data['estado'] === 2 ) {
                            this.estado = 'GANADO CARNEADO';
                        }}
                        }
                        this.idgenero = data['idgenero'];
                        this.fecha = data['fecha'];
                        break;
                        }
              }
          }

      }
      this.selectPersona();
      this.selectGenero();
  },


  eliminarGanado(id){
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
                axios.delete(`/rfid/eliminar/${id}`)
                    .then(response => {
                    this.listarRfid(1,'','marca');
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
  initializeWebSocket() {
  this.webSocket = new WebSocket('ws://192.168.100.116:81/', ['arduino']);

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
this.listarRfid(1,this.buscar);
setInterval(() => {
    this.listarRfid(this.pagination.current_page, this.buscar);
}, 5000);
},
}
</script>

<style>

.inputcheck{
    margin-top: 2.5%;
    display: flex;
    appearance: none;
    height: 1.5rem;
    width: 3rem;
    border-radius: 1rem;
    position: relative;
    background-color: #b9b9b9;
    transition: background-color .2s ease;

    &:hover{
      background-color: #009EE3;

      &::before{
        color: #fff;
      }
    }
  }

  .inputcheck::after{
    content: "";
    display: block;
    position: absolute;
    left: 0;
    height: 1rem;
    width: 1rem;
    background-color: #ffffff;
    border-radius: 50%;
    margin: .25rem;
    z-index: 9;
    will-change: transform;
    transition: transform .2s ease;
  }

  .inputcheck::before{
    display: block;
    position: absolute;
    margin: .25rem .5rem;
    right:0;
    color: red;
  }

  .inputcheck:checked{
    background-color: #009EE3;

    &:hover{
      background-color: #009EE3;
    }

    &::before{
      left: 0;
      color: #000000;
    }

    &::after{
      transform: translateX(1.5rem);
    }
  }

</style>
