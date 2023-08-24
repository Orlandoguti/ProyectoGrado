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
                            <div>FAENEO DE GANADO
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
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <i class="fa fa-microchip" style="margin-right: 1%;"></i> LECTURA DE RFID
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ID Tarjeta:</label>
                                <input @input="autollenarCampos"  type="text" v-model="rfidData" class="form-control" placeholder="Registre la Tarjeta" disabled>
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
            <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title"><i class="fa fa-tasks" style="margin-right: 1%;"></i>SELECCIONE EL GRUPO DE CARNEO</h5>

                            <button  v-for="grupo in arrayGrupo" :key="grupo.id"  @click="seleccionarGrupo(grupo.nombre)"  :class="{ active: grupo === grupo.nombre }" v-if="grupo.id >= 1"
                            class="mb-2 me-2 btn btn-success"><i class="fa fa-cubes"></i> {{ grupo.nombre }}<span class="badge rounded-pill bg-light">
                              <!-- Mostrar el total de registros del grupo si existe en totalesPorGrupo, de lo contrario, mostrar 0 -->
                              {{ totalesPorGrupo[grupo.nombre] || 0 }}
                            </span>
                          </button>
                          </div>
                    </div>
            <div class="main-card mb-3 card">
                <div class="card-header"><i class="fa fa-list-ol" style="margin-right: 1%;"></i>LISTA DE GANADOS AUTORIZADOS PARA CARNEAR
                    <div class="btn-actions-pane-right">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Grupo Carneo</th>
                            <th class="text-center">Marca</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Generos</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="lista in arrayListaFiltrada" :key="lista.id">
                                <td v-text="lista.gnombre" class="text-center"></td>
                                <td v-text="lista.marca" class="text-center"></td>
                                <td v-text="lista.total_cantidad" class="text-center"></td>
                                <td v-text="lista.ganados" class="text-center"></td>
                                <td v-text="lista.fecha" class="text-center"></td>
                                <td class="text-center">
                                    <button type="button" @click="abrirModal('lista','actualizar',lista)" class="btn btn-warning btn-sm">
                                      <i class="fa fa-pencil-square-o" style="margin-right: 1%;"> </i>
                                    </button> &nbsp;
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
          webSocket: null,
          rfidData: '',
          grupo:'Grupo 1',
          totalesPorGrupo: {},
          nombre : '',
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
          arrayLista: [],
          arrayListaHoy: [],
          arrayGrupo: [],
      }

  },
  computed:{
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


      return listaFiltrada;
    },
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
      if (newVal) {
        this.autollenarCampos(newVal);
      }
    },

    },
  methods : {

    seleccionarGrupo(grupoId) {
        this.grupo = grupoId;
        this.fechaFiltro = moment().format('YYYY-MM-DD')
        this.cambiarPagina(1);
    },
    autollenarCampos() {
            const rfidId = this.rfidData;

            axios.post('/rfid/ver', { rfidData: rfidId })
                .then(response => {
                    const data = response.data;
                    if (data.estado == 1 ) {
                        // Mostrar estado de la Tarjeta.
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
                        toastr.info('El ID Rfid escaneado esta en Proceso de Faeneado.' , 'Verificado');
                        this.rfidData = 0;
                        this.nombre = '';
                        this.marca = '';
                        this.gnombre = '';
                        this.fecha = '';
                    }else{
                        this.estado = data.estado;
                        this.idgenero = data.idgenero;
                        this.idpersona = data.idpersona;
                        this.gnombre = data.gnombre;
                        this.nombre = data.nombre;
                        this.marca = data.marca;
                        this.fecha = data.fecha;
                        // Realizar la verificación de marca en la lista
                        this.verificarMarcaEnLista();
                        }
                })
                .catch(error => {
                    console.error(error);
                });
        },

        verificarMarcaEnLista() {
        // Verificar si la marca en la lista es la misma que la marca en la lectura RFID
        axios.get('/listaVerificar', {
            params: {
                idpersona: this.idpersona
            }
        })
            .then(response => {
            const registros = response.data.arrayListaFiltrada;

            if (registros.length > 0) {
                this.registrarProceso();
                this.listaProceso1(1,this.fechaFiltro = moment().format('YYYY-MM-DD'));
            }else{
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
                toastr.warning('No se an encontrado registros en la Lista.','Error');
                this.rfidData = '';
                this.nombre = '';
                this.marca = '';
                this.gnombre = '';
                this.fecha = '';

            }
            })
            .catch(error => {
            console.error(error);
            });
        },

        selectGrupo(){
                let me=this;
                var url= '/grupo/selectGrupo';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayGrupo = respuesta.grupos;
                })
                .catch(function (error) {
                    console.log(error);
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

            axios.post('/rfid/proceso1', datosLista)
                .then(function(response) {
                // Encender el LED en el ESP8266
                me.webSocket.send('Encender LED');
                swal('Registrado!', 'Se ha actualizado la Lista.', 'warning');
                // Apagar el LED después de 1 segundo
                setTimeout(function() {
                    me.webSocket.send('Apagar LED');
                }, 5000);
                axios.post('/rfid/actualizarIdGeneroLista', datosLista)
                // Restablecer los valores
                me.rfidData = 0;
                me.nombre = '';
                me.marca = '';
                me.gnombre = '';
                me.fecha = '';
                })
                .catch(function(error) {
                swal('Error!', 'No se ha podido actualizar la Lista.', 'warning');
                console.log(error);
                });
            },


            listaProceso1 (page){
                let me = this;
                var url = `/listaProceso1?page=${page}&grupo=${this.grupo}&fechaFiltro=${this.fechaFiltro}`;
                axios
                    .get(url)
                    .then(function (response) {
                    var respuesta = response.data;
                    me.arrayLista = respuesta.listas.data;
                    me.arrayListaHoy = respuesta.listashoy.data;
                    me.pagination = respuesta.pagination;
                            me.totalesPorGrupo = me.arrayListaHoy.reduce((acc, lista) => {
                        if (!acc[lista.gnombre]) {
                            acc[lista.gnombre] = 0;
                        }
                        acc[lista.gnombre]++;
                        return acc;
                        }, {});
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
          me.listaProceso1(page);
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
    this.listaProceso1(1,this.fechaFiltro = moment().format('YYYY-MM-DD'),this.grupo);
    this.selectGrupo();
  },
}

</script>

