<template>
    <section>
        <section>
            <div class="app-page-title">
                    <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                        <div class="page-title-heading" style="width: 25%;">
                            <div class="page-title-icon">
                                <i class="pe-7s-id icon-gradient bg-mean-fruit">
                                </i>
                            </div>
                            <div>PROCESO FINAL DE FAENEO
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
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <i class="fa fa-microchip" style="margin-right: 1%;"></i> LECTURA DE RFID
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row" style="justify-content: center;">                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Habilitar Edicion ID:</label>
                                <div style="display: flex; justify-content: center;">
                                <input type="checkbox" class="inputcheck" @click="habilitarInput" v-model="inputHabilitado"/>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ID Tarjeta:</label>
                                <input v-if="inputHabilitado === false" @input="autollenarCampos" type="text" v-model="rfidData" class="form-control" placeholder="Registre la Tarjeta" :disabled="!inputHabilitado">
                                <input v-else @keyup.enter="autollenarCampos" type="text" v-model="rfidData" class="form-control" placeholder="Registre la Tarjeta">
                            </div>
                        </div>
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre del Afiliado:</label>
                                <input name="nombre" id="nombre" type="text" v-model="nombre" class="form-control" placeholder="Nombre del Afiliado" disabled>
                            </div>
                        </div>
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Marca:</label>
                                <input name="marca" id="marca" type="text" v-model="marca" class="form-control" placeholder="Marca" disabled>
                            </div>
                        </div>
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Genero del Ganado:</label>
                                <input name="estado" id="estado" type="text" v-model="gnombre" class="form-control" placeholder="Genero del Ganado" disabled>
                            </div>
                        </div>
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha de Registro:</label>
                                <input name="date" id="date" type="date" v-model="fecha" class="form-control" placeholder="Fecha de Registro" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header"><i class="fa fa-list-ol" style="margin-right: 1%;"></i>LISTA DE GANADOS PARA CARNEAR
                    <div class="btn-actions-pane-right">
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
                                    <div class="badge bg-warning">Proceo de Faeneado</div>
                                </div>
                                <div v-if="rfid.estado == 2">
                                    <div class="badge bg-success">Ganado Carneado</div>
                                </div>
                            </td>
                            <td v-text="rfid.fecha" class="text-center"></td>
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
    </section>
</template>
<script>
import moment from 'moment';
import axios from 'axios';
import toastr from 'toastr';
export default {

  data (){
      return {
        inputHabilitado: false,
          webSocket: null,
          rfidData: '',
          nombre : '',
          apellidoP : '',
          apellidoM : '',
          gnombre : '',
          estado : '',
          idgrupo:'',
          idgenero:'',
          fecha : '',
          marca : '',
          pagination : {
              'total' : 0,
              'current_page' : 0,
              'per_page' : 0,
              'last_page' : 0,
              'from' : 0,
              'to' : 0,
          },
          offset : 3,
          arrayRfid: [],
      }

  },
  computed:{
    isActived: function () {
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
    rfidData(newVal) {
      if (newVal && this.inputHabilitado == false) {
        this.autollenarCampos(newVal);
      }
    },

    },
  methods : {

    habilitarInput() {
      this.inputDeshabilitado = false; // Cambia el valor para habilitar el input
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
          body: 'Señor(a): '+'*'+ rfid.nombre +' '+ rfid.apellidoP +' ' + rfid.apellidoM +'*'+ ' Tu ganado Ingresado: ' + rfid.fecha + ' ya fue carneado en el: ' + rfid.grunombre + ' Genero: ' +'*'+ rfid.gnombre +'*'+ ' Ya puedes venir a Recojerlo Att: F.U.T.E.C.R.A.'
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

    listarRfid (){
      let me=this;
      var url= '/procesofinal/index';
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayRfid = respuesta.rfids.data;
          me.pagination= respuesta.pagination;
      })
      .catch(function (error) {
          console.log(error);
      });
  },
    autollenarCampos() {
            const rfidId = this.rfidData;

            axios.post('/procesofinal/ver', { rfidData: rfidId })
                .then(response => {
                    const data = response.data;
                        this.estado = data.estado;
                        this.idgenero = data.idgenero;
                        this.idpersona = data.idpersona;
                        this.gnombre = data.gnombre;
                        this.nombre = data.nombre;
                        this.apellidoP = data.apellidoP;
                        this.apellidoM = data.apellidoM;
                        this.marca = data.marca;
                        this.fecha = data.fecha;
                        // Realizar la verificación de marca en la lista
                        this.verificarMarcaEnLista();
                })
                .catch(error => {
                    console.error(error);
                });
        },

        verificarMarcaEnLista() {
        // Verificar si la marca en la lista es la misma que la marca en la lectura RFID
        axios.get('/procesofinal/listaVerificar', {
            params: {
                idpersona: this.idpersona,
                idrfid: this.rfidData
            }
        })
            .then(response => {
            const registros = response.data.arrayListaFiltrada;

            if (registros.length > 0) {
                this.registrarProceso();
                this.listarRfid(1);
            }
            })
            .catch(error => {
            console.error(error);
            });
        },
        registrarProceso() {
            if (this.rfidData == 0) {
                return;
            }
            let me = this;
            const datosLista = {
                rfidData: this.rfidData,
                cantidad: this.cantidad,
                idpersona: this.idpersona,
                idgrupo: this.idgrupo,
                idgenero: this.idgenero,
                estado: this.estado,
                marca: this.marca,
                fecha: this.fecha,
            };

            axios.post('/procesofinal', datosLista)
                .then(function(response) {
                // Encender el LED en el ESP8266
                me.webSocket.send('Encender LED');
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
                toastr.info('Registrado se a actualizado la Lista.','Actualizado');
                // Apagar el LED después de 1 segundo
                setTimeout(function() {
                    me.webSocket.send('Apagar LED');
                }, 5000);
                // Restablecer los valores
                me.rfidData = 0;
                me.nombre = '';
                me.apellidoP = '';
                me.apellidoM = '';
                me.marca = '';
                me.gnombre = '';
                me.fecha = '';
                if (me.arrayRfid.length > 0) {
                    const rfidRecord = me.arrayRfid[0];
                    me.enviarMensajeWhatsApp(rfidRecord);
                }

                })
                .catch(function(error) {
                toastr.error('No se a registrado la Lista.','Error');
                console.log(error);
                });
            },
        cambiarPagina(page){
          let me = this;
          //Actualiza la página actual
          me.pagination.current_page = page;
          //Envia la petición para visualizar la data de esa página
          me.listarRfid(page);
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
beforeDestroy() {
    this.closeWebSocket(); // Cerrar el WebSocket antes de destruir el componente
  },
  mounted() {

    this.initializeWebSocket();
    this.listarRfid();
  },
}

</script>

