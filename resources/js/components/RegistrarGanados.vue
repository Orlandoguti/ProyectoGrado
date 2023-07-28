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
                            <div>REGISTRAR GANADO
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
                                <input type="text" v-model="buscar" @keyup.enter="listarRfid(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarRfid(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                <th class="text-center">Fecha Ingreso</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
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
                                                <span v-text="rfid.nombre" class="widget-subheading opacity-7"></span>
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
                                        <div class="badge bg-warning">Proceo de Faeneado</div>
                                    </div>
                                    <div v-if="rfid.estado == 2">
                                        <div class="badge bg-success">Ganado Carneado</div>
                                    </div>
                                </td>
                                <td v-text="rfid.fecha" class="text-center"></td>
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
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio,buscar,criterio)">Sig</a>
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
                                <form @submit="validacionForm($event)" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom01" class="form-label">ID Tarjeta:</label>
                                            <input v-model="rfidData" type="text" class="form-control" id="validationCustom01" placeholder="Registre la Tarjeta" required :disabled="!inputHabilitado">
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
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
                                            <input v-model="nombre" type="text" class="form-control" id="validationCustom03" placeholder="Nombre del Afiliado" required disabled>
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
                                            <div class="invalid-feedback">
                                                Porfavor Ingrese el Genero!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05" class="form-label">Estado del Ganado:</label>
                                            <input v-model="estado" type="text" class="form-control" id="validationCustom05" placeholder="Estado del Ganado" required disabled>
                                            <div class="invalid-feedback">
                                                No hay Estado.
                                            </div>
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
                            <button type="button" class="btn btn-primary" @click="registrarRfid()">Registrar Ganado</button>
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
      marca : '',
      nombre : '',
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
      criterio : 'marca',
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
    habilitarInput() {
      this.inputDeshabilitado = false; // Cambia el valor para habilitar el input
    },
enviarMensaje() {
  const telefono = '67023449'; // Número de teléfono
  const mensaje = '¡Hola! Este es mi mensaje predefinido.'; // Mensaje predefinido

  // Crear el enlace de WhatsApp
  const enlaceWhatsApp = `https://api.whatsapp.com/send?phone=${telefono}&text=${encodeURIComponent(mensaje)}`;

  // Abrir una nueva ventana o pestaña del navegador con el enlace de WhatsApp
  window.open(enlaceWhatsApp);
},
enviarMensajeGmail(){
    axios.post(`/enviar-correo`).then((response) => {
  });
},

getOpcionSeleccionada(idpersona) {
  // Realiza una solicitud HTTP a tu backend para obtener los detalles de la opción seleccionada
  axios.get(`/personas/ver/${idpersona}`).then((response) => {
    this.nombre = response.data.nombre;
  });
},

  listarRfid (page,buscar,criterio){
      let me=this;
      var url= '/rfid/index?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
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

  cambiarPagina(page,buscar,criterio){
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarRfid(page,buscar,criterio);
  },
    validacionForm(event) {

        event.preventDefault();
        event.stopPropagation();

        const form = event.currentTarget;

        if (form.checkValidity()) {
        this.formValidated = true;
        // Lógica adicional si el formulario es válido
        }

        form.classList.add('was-validated');
    },
    Validacion(){
        if (this.rfidData==0) {
            swal('Error!', `El ID RFID no puede estar vacio o estar en 0.`, 'warning');
        }
                this.errorValidacion=0;
                this.errorMostrarMsjValidacion =[];

                if (this.rfidData == 0) this.errorMostrarMsjValidacion.push("");
                if (!this.idgenero) this.errorMostrarMsjValidacion.push("");
                 if (!this.idpersona) this.errorMostrarMsjValidacion.push("");
                if (this.errorMostrarMsjValidacion.length) this.errorValidacion = 1;

                return this.errorValidacion;
            },
    registrarRfid() {
            let me = this;
            this.formValidated='true';
            // Verificar si hay un registro con el mismo RFID y estado 3

            if (this.Validacion()){
                    return;
                }else{
                axios.get('/rfid/verificar', {
                        params: {
                        rfidData: this.rfidData
                        }
                    })
                    .then(function(response) {
                        const registros = response.data.registros;

                        if (registros.length > 0) {
                        // Mostrar alerta de que ya existe un registro con el mismo RFID y estado 3
                        swal('Error!', `El ID RFID está registrado con una Marca.`, 'warning');
                        } else {
                        // No hay registros existentes, proceder con el registro
                        let formData = new FormData();
                        formData.append('idrfid', me.rfidData);
                        formData.append('idpersona', me.idpersona);
                        formData.append('marca', me.marca);
                        formData.append('idgenero', me.idgenero);
                        formData.append('estado', me.estado);
                        formData.append('fecha', me.fecha);

                        axios.post('/rfid/registrar', formData)
                        .then(function(response) {
                            me.cerrarModal();
                            me.listarRfid(1, '', 'idrfid');
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });

        }
       },
  cerrarModal(){
      this.modal= false;
      this.tituloModal='';
      this.idrfid= 0;
      this.idpersona = '';
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
                      this.estado=0;
                      this.tipoAccion = 1;
                      break;
                  }
                  case 'actualizar':
                  {
                      //console.log(data);
                      this.modal = true;
                      this.tituloModal='Actualizar Tarjeta RFID';
                      this.tipoAccion=2;
                      this.rfidData=data['idrfid'];
                      this.marca=data['marca'];
                      this.idgenero=data['idgenero'];
                      this.estado=data['estado'];
                      break;
                  }
              }
          }

      }
      this.selectPersona();
      this.selectGenero();
  },


  eliminarGanado(id){
    if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
        axios.delete(`/rfid/eliminar/${id}`)
            .then(response => {
            this.listarRfid(1,'','marca');
            console.error(error.response.data.message);
            });
        }
    },
  initializeWebSocket() {
  this.webSocket = new WebSocket('ws://192.168.100.117:81/', ['arduino']);

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
this.listarRfid(1,this.buscar,this.criterio);
setInterval(() => {
    this.listarRfid(this.pagination.current_page, this.buscar, this.criterio);
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
      content: "✔";
      left: 0;
      color: #000000;
    }

    &::after{
      transform: translateX(1.5rem);
    }
  }

</style>
