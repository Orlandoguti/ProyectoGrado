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
                                    <div class="textodiv">PROGRAMACION
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
  <div v-if="section==1">      
    <div class="col-md-12" style="display: flex; justify-content: center;">
      <div class="col-md-6" style="text-align: -webkit-center;">
      <table style="width: 85%; border-collapse: separate; border-spacing: 5px; border: 3px solid #0000001f;">
      <thead style="background: white;"> 
        <tr>
          <th></th>
          <th style="background: coral; color: white; padding: 4px;" class="text-center" v-for="dia in arrayDia" :key="dia.id">{{ dia.nombre }}</th>
        </tr>
      </thead>
      <tbody style="background: white;">
        <tr v-for="periodo in arrayPeriodo" :key="periodo.id" :style="{ color: 'black ' , background:'white', textAlign:'center' }">{{ periodo.nombre }}
          <td class="text-center text-muted" 
            v-for="dia in arrayDia"
            :key="dia.id"
            :class="{
              'registro-seleccionado-buscar': isRegistroSeleccionadobuscar(periodo.id, dia.id),
            }"
            @click="toggleRegistrobuscar(periodo.id, dia.id)"
          >
          <span style="color: white;">x</span>
          </td>
        </tr>
      </tbody>
    </table> 
  </div>
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="align-middle mb-0 table table-borderless table-striped table-hover">
      <thead> 
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Aula</th>
          <th class="text-center">Capacidad</th>
          <th class="text-center">Tipo</th>
          <th class="text-center">Accesorio</th>
          <th class="text-center">Opciones</th>
        </tr>
      </thead>
      <tbody v-if="arrayAmbienteindex.length">
        <tr v-for="ambientes in arrayAmbienteindex" :key="ambientes.id">
          <td class="text-center text-muted" v-text="ambientes.id"></td>
          <td class="text-center text-muted" v-text="ambientes.nombre"></td>
          <td class="text-center text-muted" v-text="ambientes.capacidad"></td>
          <td class="text-center text-muted" v-text="ambientes.tipo"></td>
          <td class="text-center text-muted" v-text="ambientes.accesorio"></td>
          <td class="text-center text-muted" >
              <button type="button" @click="verAmbiente(ambientes.id)" class="btn btn-warning btn-sm">
                <i style="color: white;" class="fa fa-pencil" aria-hidden="true"></i>
              </button>              
          </td>
        </tr>
      </tbody>
      <tbody v-else>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                <img width="750" class="rounded-circle" src="/img/plantilla/sin_registros.png" alt="">
                                                <h5>No se Encontraron Registros</h5>
                                            </td>
                                        </tr>
                                      </tbody> 
    </table>
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
    <div class="col-md-12" style="display: flex; justify-content: center; margin-top: 2%; margin-bottom: 1%;"><button style="font-size: 17px;" type="button" class="btn btn-primary" @click="BuscarAulas(1)">Buscar Aulas</button></div>
  </div>
   <div v-else>
    
    <select class="form-control" style="font-weight: bold;font-size: 15px;text-align: center;" v-model="idambiente" @click="handleChangeSelect()">
       <option value="" disabled>Selecciona el Aula</option>
       <option v-for="ambiente in arrayAmbiente" :key="ambiente.id"  :value="ambiente.id" v-text="ambiente.nombre"></option>
    </select>
    <div class="row">
    <div class="col-md-12" style="display: flex; justify-content: center;">
      <div class="col-md-10" style="display: flex; justify-content: center;">
    <table class="tabla-estilizada" style="border-collapse: separate; border-spacing: 5px; border: 3px solid #0000001f;  width: 100%;">
      <thead style="background: white;"> 
        <tr>
          <th style=" border: white; background-color: #f3f3f3;"></th>
          <th style="background: coral; color: white; padding: 4px;" class="text-center" v-for="dia in arrayDia" :key="dia.id">{{ dia.nombre }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="periodo in arrayPeriodo" :key="periodo.id" :style="{ color: 'black ' , textAlign:'center', verticalAlign: 'baseline' }">{{ periodo.nombre }}
          <td
            v-for="dia in arrayDia"
            :key="dia.id"
            :class="{
              'registro-seleccionado': isRegistroSeleccionado(periodo.id, dia.id),
              'campo-ocupado': isCampoOcupado(periodo.id, dia.id),
            }"
            @click="isCampoOcupado(periodo.id, dia.id) ? null : toggleRegistro(periodo.id, dia.id)"
            :style="{ 'background-color': getCampoColor(periodo.id, dia.id) ,'color': 'white' ,textAlign: 'center'}"
            style="position: relative;"
          >
          <span v-if="isCampoOcupado(periodo.id, dia.id)" v-html="mostrarContenidoCampo(periodo.id, dia.id)"></span>
          <button
            v-if="isCampoOcupado(periodo.id, dia.id) && camposOcupados.some(campo => campo.idusuario === idusuarioget && campo.idperiodo === periodo.id && campo.iddia === dia.id)"
            @click="eliminarRegistro(periodo.id, dia.id)"
            class="btn btn-info"
            style="font-size: 9px; position: absolute; top: -1px; right: -1px;">
            X
          </button>
          </td>          
        </tr>
      </tbody>
    </table>
    </div>
    <div class="col-md-2" style="display: flex; justify-content: center; flex-direction: column; padding: 5%;">
      <button type="button" class="btn btn-primary" style=" margin-bottom: 2%; font-size: 17px; margin-right: 1%;" @click="abrirModal('programar','registrar')">Registrar</button>
      <button type="button" class="btn btn-secondary" style=" font-size: 17px;" @click="salir()">Salir</button>
    </div>
  </div>
  <div class="row" style="margin-top: 1%;">
    <div class="col-md-12" style="display: flex; justify-content: center;">
    
  </div>
 </div>
    <div class="modal fade bd-example-modal-lg" :class="{'mostrar' : modal}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-top: 10%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Agregar Clase</h5>
                            <button type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form @submit.prevent="guardarRegistros" ref="form" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01" class="form-label">Docente:</label>
                                                <input type="text" v-model="docente" class="form-control" placeholder="Docente" required>
                                                <div class="invalid-feedback"> Añada el Docente!</div>
                                            <div class="valid-feedback"> Correcto! </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                            <label for="validationCustom02" class="form-label">Seleccione La Materia:</label>
                                            <select name="select" v-model="idmateria" id="validationCustom02" class="form-select" placeholder="Materia" required @change="actualizarNombreMateria">
                                                <option value="" disabled>Seleccione la Materia</option>
                                                <option v-for="materia in arrayMateria" :key="materia.id" :value="materia.id" v-text="materia.codigo"></option>
                                            </select>
                                            <div class="invalid-feedback"> Selecciona una Materia!</div>
                                            <div class="valid-feedback"> Correcto!</div>
                                        </div>
                                        </div>
                                        <div class="row">                                          
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03" class="form-label">Materia:</label>
                                            <input v-model="materia" type="text" class="form-control" id="validationCustom03" placeholder="Materia" disabled>
                                        </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01" class="form-label">Paralelo:</label>
                                                <input type="number" v-model="paralelo" class="form-control" placeholder="Paralelo" required>
                                                <div class="invalid-feedback"> Añada el Paralelo!</div>
                                                <div class="valid-feedback"> Correcto! </div>
                                            </div>
                                        </div>
                                        <div class="row" style="text-align: center;">
                                          <label for="validationCustom01" class="form-label">Añadir Carrera</label>
                                        <div class="col-md-12 mb-3" style="display: flex; justify-content: center;">
                                            <input type="checkbox" class="inputcheck" @click="habilitarInput" v-model="inputHabilitado"/>
                                        </div>
                                    </div>
                                        <div v-if="inputHabilitado == true" class="row" style="display: flex; justify-content: center;">                                          
                                        <div class="col-md-12 mb-3" style="display: flex; justify-content: center;">
                                          <div style="text-align: center; margin-right: 2%;" v-for="(carrera, index) in arrayCarrera" :key="index" v-if="carrera.id !== 13 && idcarrerauser !== carrera.id">
                                          <input type="checkbox" :id="'option-' + carrera.id" :value="carrera.id" v-model="selectedOptions"/>
                                          <label :for="'option-' + carrera.nombre">{{ carrera.nombre }}</label>
                                        </div>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>                                                       
                            <div class="modal-footer">
                                <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="guardarRegistros()">Registrar Clase</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
  </div>
</div>
</div>
  
</section> 
</template>

<script>
export default {
  data() {
    return { 
      idusuarioget:'',
      idcarrerauser: '',     
      inputHabilitado: false,
      formValidated: false,
      materia:'',
      docente:'',
      paralelo:'',
      modal: 0,
      tituloModal: '',
      tipoAccion: 0,
      section:1,
      idambiente: '',
      arrayDia: [],
      arrayPeriodo: [],
      arrayAmbiente: [],
      arrayAmbienteindex: [],
      registroSeleccionado: {},
      camposOcupados: [],
      idmateria:'',
      registroSeleccionadobuscar: {},
      arrayMateria: [], 
      arrayCarrera: [],
    
      pagination: {
        total: 0,
        current_page: 1,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,      
      selectedOptions: [],
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
    
    habilitarInput() {
      this.inputDeshabilitado = false;
      this.selectedOptions=[];
    },
    addOption(carrera) {
      if (!this.selectedOptions.includes(carrera.id)) {
        this.selectedOptions.push(carrera.id);
      } else {
        const index = this.selectedOptions.indexOf(carrera.id);
        this.selectedOptions.splice(index, 1);
      }
    },
    actualizarNombreMateria() {
        // Encuentra la materia seleccionada por su ID en el arreglo arrayMateria
        const materiaSeleccionada = this.arrayMateria.find(materia => materia.id === this.idmateria);
        if (materiaSeleccionada) {
            this.materia = materiaSeleccionada.materia; // Actualiza el nombre de la materia en el campo de texto
        } else {
            this.materia = ''; // Si no se encuentra, se asigna un valor vacío al campo
        }
    },

    getCampoColor(periodoId, diaId) {
    const campoOcupado = this.camposOcupados.find(
      (campo) => campo.idperiodo === periodoId && campo.iddia === diaId
    );

    return campoOcupado ? campoOcupado.color : ''; // Devuelve el color o un valor predeterminado
  },
  cambiarPagina(page) {
            let me = this;
            // Actualiza la página actual
            me.pagination.current_page = page;
            // Envía la petición para visualizar la data de esa página
            me.BuscarAulas(page);
        },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = '';  
      this.docente = '';
      this.idmateria = '';
      this.paralelo = '';
      this.materia = '';
      this.selectedOptions = [];
      this.inputHabilitado = false;
    },
    salir() {
      this.BuscarAulas(1);
      this.arrayAmbienteindex = [];
      this.section = 1;
      this.registroSeleccionado = {};
      this.registroSeleccionadobuscar = {};
      this.idambiente = '';       
    },
    verAmbiente(id) {
      let me = this;
      me.section = 2;
      me.idambiente = id;
      me.obtenerCamposOcupados();      
    },
    handleChangeSelect() {
    this.registroSeleccionado = {};
    this.obtenerCamposOcupados();
  },
    async selectAmbiente() {
      try {
        const response = await axios.get('/selectAmbiente');
        this.arrayAmbiente = response.data.ambientes;
      } catch (error) {
        console.error('Error en selectAmbiente:', error);
      }
    },

    async indexPeriodo() {
      try {
        const response = await axios.get('/indexperiodo');
        this.arrayPeriodo = response.data.periodos;
      } catch (error) {
        console.error('Error en indexPeriodo:', error);
      }
    }, 
    async indexDia() {
      try {
        const response = await axios.get('/indexdia');
        this.arrayDia = response.data.dias;
      } catch (error) {
        console.error('Error en indexDia:', error);
      }
    },

    isRegistroSeleccionado(periodoId, diaId) {
      const campoSeleccionado = this.registroSeleccionado[periodoId] && this.registroSeleccionado[periodoId][diaId];
      const isCampoOcupado = this.isCampoOcupado(periodoId, diaId);
      
      // Devolver true solo si el campo está seleccionado y no está ocupado
      return campoSeleccionado && !isCampoOcupado;
    },
    isRegistroSeleccionadobuscar(periodoId, diaId) {
      return this.registroSeleccionadobuscar[periodoId] && this.registroSeleccionadobuscar[periodoId][diaId];
    },


    toggleRegistrobuscar(periodoId, diaId) {
      if (!this.registroSeleccionadobuscar[periodoId]) {
        this.$set(this.registroSeleccionadobuscar, periodoId, {});
      }
      this.$set(
        this.registroSeleccionadobuscar[periodoId],
        diaId,
        !this.registroSeleccionadobuscar[periodoId][diaId]
      );
    },

   async verificarselectCamposOcupados() {
  try {
    // Obtener los campos ocupados en tiempo real
    await this.obtenerCamposOcupados();

    for (const periodoId in this.registroSeleccionado) {
      for (const diaId in this.registroSeleccionado[periodoId]) {
        if (this.registroSeleccionado[periodoId][diaId]) {
          // Verificamos si el campo seleccionado está en la lista de campos ocupados
          const campoSeleccionado = this.camposOcupados.find(campo => {
            return (
              campo.idperiodo.toString() === periodoId &&
              campo.iddia.toString() === diaId
            );
          });

          // Si el campo está ocupado, lo deseleccionamos
          if (campoSeleccionado) {
            this.registroSeleccionado[periodoId][diaId] = false;
            console.log(`Campo en periodo ${periodoId} y día ${diaId} está ocupado y ha sido deseleccionado.`);
          }
        }
      }
    }
    } catch (error) {
      console.error('Error al verificar campos ocupados:', error);
  }
},

toggleRegistro(periodoId, diaId) {
      if (!this.registroSeleccionado[periodoId]) {
        this.$set(this.registroSeleccionado, periodoId, {});
      }
      this.$set(
        this.registroSeleccionado[periodoId],
        diaId,
        !this.registroSeleccionado[periodoId][diaId]
      );
    },


    async obtenerCamposOcupados() {
      try {
        if (this.idambiente) {
          const response = await axios.get(`/obtener-campos-ocupados/${this.idambiente}`);
          console.log('camposOcupados:', response.data.campos_ocupados);
          this.camposOcupados = response.data.campos_ocupados;
        }
      } catch (error) {
        console.error('Error en obtenerCamposOcupados:', error);
      }
    },

    isCampoOcupado(periodoId, diaId) {
      return this.camposOcupados.some(
        (campo) => campo.idperiodo === periodoId && campo.iddia === diaId
      );
    },

    async  guardarRegistros() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn2 btn-success',
            cancelButton: 'btn2 btn-danger'
        },
        buttonsStyling: false
    });

    await swalWithBootstrapButtons.fire({
        title: 'Registrar!',
        text: "Estás Seguro de Registrar esta Clase?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Registrar!',
        cancelButtonText: 'No, Cancelar!',
        reverseButtons: true
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await axios.post('/programa/store', {
                    registros: this.obtenerRegistrosSeleccionados(),
                    idcarrerauser: this.idcarrerauser,
                    selectedOptions: this.selectedOptions,
                    idmateria: this.idmateria,
                    docente: this.docente,
                    paralelo: this.paralelo,
                });
                Swal.fire('Registrado!', 'Registro Exitoso!', 'success');
                this.cerrarModal();
                this.obtenerCamposOcupados();
                this.registroSeleccionado = {};
                console.log(response.data);
            } catch (error) {
                console.error('Error en guardarRegistros:', error);
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Manejar el rechazo/cancelación aquí si es necesario
        }
    });
},

    async indexAmbiente(page) {
      try {
        const response = await axios.get('/indexambiente?page=' + page);
        this.arrayAmbienteindex = response.data.ambientes;
        this.pagination = response.pagination;
      } catch (error) {
        console.error('Error en indexAmbiente:', error);
      }
    },  
    async BuscarAulas(page) {
      try {
        const response = await axios.post('/buscarambiente?page=' + page, {
          registrosbuscar: this.obtenerRegistrosSeleccionadosbuscar(),
        });
        this.arrayAmbienteindex = response.data.ambientes.data;
        this.pagination = response.data.ambientes;
        console.log(response.data);
      } catch (error) {
        console.error('Error en BuscarAulas:', error);
      }
    },


    obtenerRegistrosSeleccionados() {
      const registros = [];

      for (const periodoId in this.registroSeleccionado) {
        for (const diaId in this.registroSeleccionado[periodoId]) {
          if (this.registroSeleccionado[periodoId][diaId]) {
            registros.push({
              idambiente: this.idambiente,
              iddia: diaId,
              idperiodo: periodoId,
            });
          }
        }
      }

      return registros;
    },

     obtenerRegistrosSeleccionadosbuscar() {
      const registrosbuscar = [];

      for (const periodoId in this.registroSeleccionadobuscar) {
        for (const diaId in this.registroSeleccionadobuscar[periodoId]) {
          if (this.registroSeleccionadobuscar[periodoId][diaId]) {
            registrosbuscar.push({
              iddia: diaId,
              idperiodo: periodoId,
            });
          }
        }
      }

      return registrosbuscar;
    },
    mostrarContenidoCampo(periodoId, diaId) {
      const campoOcupado = this.camposOcupados.find(
        (campo) => campo.idperiodo === periodoId && campo.iddia === diaId
      );

      if (campoOcupado) {
        const contenido = `
          ${campoOcupado.nombres_carreras}<br>
          ${campoOcupado.codigo}<br>
          ${campoOcupado.materia}<br>
          ${campoOcupado.docente}<br>
          P: ${campoOcupado.paralelo}<br>
        `;
        return contenido;
      } else {      
        return '';
      }
    },
    async obtenerMaterias() {
      try {
        const response = await axios.get('/selectMateria');
        this.arrayMateria = response.data.materias;
      } catch (error) {
        console.error(error);
      }
    },
    async obtenerCarreras() {
      try {
        const response = await axios.get('/selectCarrera');
        this.arrayCarrera = response.data.carreras;
      } catch (error) {
        console.error(error);
      }
    },
   
    validacion() {
      // Verificar si hay algún elemento con valor true en registroSeleccionado
      const tieneSeleccionados = Object.values(this.registroSeleccionado).some(
          periodo => Object.values(periodo).some(value => value === true)
        );

        if (!tieneSeleccionados) {
          Swal.fire('Error!', `Seleccione al menos un periodo`, 'warning');
        }

        return tieneSeleccionados; // Devolver true si hay elementos seleccionados, false en caso contrario
      },
    abrirModal(modelo, accion) {
      if (this.validacion()) {

      switch (modelo) {
        case 'programar': {
          switch (accion) {
            case 'registrar': {
              this.modal = 1;
              this.tituloModal = 'Programar Materia';
              this.tipoAccion = 1;
              break;
            }
          }
        }
       }
      }
    },
    obteneridcarrerauser() {
      axios.get('/idcarrerauser') // Reemplaza '/ruta/hacia/obtener-idcarrera' con tu ruta real
        .then(response => {
          this.idcarrerauser = response.data.idcarreras;
        })
        .catch(error => {
          console.error('Error al obtener el ID de la carrera:', error);
        });
    },
    obteneriduser() {
      axios.get('/iduserget') // Reemplaza '/ruta/hacia/obtener-idcarrera' con tu ruta real
        .then(response => {
          this.idusuarioget = response.data.idusuarioget;
        })
        .catch(error => {
          console.error('Error al obtener el ID de la carrera:', error);
        });
    },


    eliminarRegistro(idperiodo, iddia) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn2 btn-success',
            cancelButton: 'btn2 btn-danger'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: 'Eliminar!',
        text: "Estás Seguro de Eliminar esta Clase?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'No, Cancelar!',
        reverseButtons: true
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                await axios.delete('/eliminar-campo', {
                    data: {
                        idambiente: this.idambiente,
                        idperiodo: idperiodo,
                        iddia: iddia
                    }
                });
                Swal.fire('Eliminado!', 'Registro Eliminado!', 'success');
                this.obtenerCamposOcupados();
            } catch (error) {
                console.error('Error al eliminar el registro:', error);
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Manejar el rechazo/cancelación aquí si es necesario
        }
    });
}
  },
  mounted() {
    this.indexDia();    
    this.indexPeriodo();
    this.selectAmbiente();
    this.obtenerCamposOcupados(); 
    this.BuscarAulas(1);
    this.obtenerMaterias();
    this.obtenerCarreras();
    this.obteneridcarrerauser();
    this.obteneriduser();
    setInterval(async() => {   
      this.verificarselectCamposOcupados();
}, 1000);
  },
};
</script>

<style scoped>
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
.registro-seleccionado {
  background-color:rgb(0, 102, 255  );
  color: white;
}

.registro-seleccionado-buscar {
  background-color: rgb(0, 102, 255);
  color: white;
}

button:disabled {
  background-color: gray; /* Change this to the desired color for disabled buttons */
  color: white;
  cursor: not-allowed;
}
.tabla-estilizada {
  border-collapse: collapse;
  width: 100%;
}

/* Aplica los estilos a th y td dentro de la clase 'tabla-estilizada' */
.tabla-estilizada th, .tabla-estilizada td {
  border: 1px solid #000;
  padding: 8px;
  text-align: left;
  width: 100px; /* Establece el ancho deseado para tus celdas */
}
</style>
