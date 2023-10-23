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
                                    <div class="textodiv">NOTICIAS
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
               <div style="text-align: center; font-weight: bold; color: chocolate; font-size: 1.5rem;">
                    <p>NOTICIAS</p>
                </div>
                     <div class="row" style="justify-content: center;">
                        <div class="col-md-11">
                            <div class="main-card mb-3 card">
                                <div class="card-body" style="padding: 0;">
                                    <div id="carouselExampleControls1" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div v-for="(noticia, index) in arrayNoticias" :key="index" class="carousel-item" :class="{ active: index === 0 }">
                                                <div class="slider-container">
                                                    <div class="slider-overlay"></div>
                                                    <div class="slide__overlay">
                                                        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" fill-opacity="0.5" />
                                                        </svg>
                                                    </div>
                                                    <div class="slider-image">
                                                        <img :src="'/img/noticias/' + noticia.imagen" class="d-block w-100" alt="Noticia Image">
                                                    </div>
                                                    <div class="carousel-caption">
                                                        <h3>{{ noticia.titulo }}</h3>
                                                        <p>{{ noticia.descripcion }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" data-bs-target="#carouselExampleControls1" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" data-bs-target="#carouselExampleControls1" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="font-size: 1rem; justify-content: center; text-align: center;">
                        <div class="col-lg-5 col-xl-5">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading" style="text-decoration: underline; color: coral;">Mision</div>
                                        <div class="widget-subheading">Producir de forma sostenible carne y productos cárnicos saludables para la alimentación humana a escala departamental con la mayor seguridad del 100% de efectividad y conformidad.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-5">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading" style="text-decoration: underline; color: coral;">Vision</div>
                                        <div class="widget-subheading">Generar trabajo, riqueza y bienestar para nuestros afiliados, proveedores, trabajadores y para la sociedad en general demostrando respeto,confianza y efectividad.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center; font-weight: bold; color: chocolate; font-size: 1.5rem;">
                        <p>AVISOS</p>
                    </div>
                    <div class="row" style="display: flex; justify-content: center;">
                        <div class="col-md-5">
                            <div class="main-card mb-3 card">
                                <div v-for="informacion in arrayInformacion" :key="informacion.titulo" class="card-body"><h5 class="card-title" style="font-size: 1rem; text-decoration: underline; text-align: center; color: coral;">PANEL DE INFORMACION</h5>
                                        <div class="position-relative mb-3" style="text-align: center;">
                                            <span style="font-size: 1rem; font-weight: bold;">{{ informacion.titulo }}</span>
                                        </div>
                                        <div class="position-relative mb-3" style="text-align: center;">
                                            <label for="exampleText" class="form-label" style="font-size: 1rem; font-weight: bold; text-decoration: underline;">CONTENIDO</label><br>
                                            <span>{{ informacion.contenido }}</span>
                                        </div>
                                        <div style="text-align: center;">
                                            <img src="/img/plantilla/logopdf2.png" style="width: 150px; height: auto; overflow: visible;">
                                        </div>
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
      imagenmin:'',
      imagen:'',
      titulo:'',
      tituloinf:'',
      informacion:'',
      contenido:'',
      esEditable: false,
      descripcion:'',
      arrayNoticias: [],
      arrayInformacion: [],
      modal: 0,
      tituloModal: '',
      pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
    };
  },

  computed: {
    imagenm(){
                return this.imagenmin;
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
  created() {
    moment.locale('es');
    const dayOfWeekLowerCase = moment().format("dddd");
    const dayOfWeekUpperCase = dayOfWeekLowerCase.toUpperCase();
    this.formattedDate = dayOfWeekUpperCase + " " + moment().format("DD-MM-YYYY");
  },
  methods: {

    obtimage(e){
                let file = e.target.files[0];
                this.imagen = file;
                this.cargarImagen(file);
            },
    cargarImagen(file){
                let reader = new FileReader();
                reader.onload = (e) =>{
                    this.imagenmin = e.target.result;
                }
                reader.readAsDataURL(file);
            },
            cambiarPagina(page){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.verNoticias(page);
            },
    verNoticias(page) {
      // Enviar la nueva imagen al backend y guardarla en la base de datos
      let me=this;
      var url= '/noticias/index?page=' + page;
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayNoticias = respuesta.noticias.data;
          me.pagination= respuesta.pagination;
          // Reinicia el formulario para agregar otra imagen
        })
        .catch((error) => {
          console.error(error);
        });
    },
    verInformacion(page) {
      // Enviar la nueva imagen al backend y guardarla en la base de datos
      let me=this;
      var url= '/informaciones/indexInformacion?page=' + page;
      axios.get(url).then(function (response) {
          var respuesta= response.data;
          me.arrayInformacion = respuesta.informacion.data;
          me.pagination= respuesta.pagination;
          // Reinicia el formulario para agregar otra imagen
        })
        .catch((error) => {
          console.error(error);
        });
    },
    actualizarInformacion(tituloinf,contenido) {
      let me = this;

      let formData = new FormData();
        formData.append("tituloinf", this.tituloinf);
        formData.append("contenido", this.contenido);

      axios
        .post("/actualizarInformacion", formData, {
          headers: {
            "Content-Type": "multipart/form-data", // Configurar el encabezado adecuado para enviar un archivo
          },
        })
        .then(function (response) {
          me.esEditable=false;
          swal("Registrado!", "La Informacion se ha sido registrada con éxito.", "success");
        })
        .catch(function (error) {
          swal("Error!", "No se ha podido actualizar la Informacion.", "warning");
          console.log(error);
        });
    },
    registrarNoticias() {
      let me = this;

      let formData = new FormData();
      formData.append("imagen", this.imagen);
      formData.append("titulo", this.titulo);
      formData.append("descripcion", this.descripcion);

      axios
        .post("/noticia/registrar", formData, {
          headers: {
            "Content-Type": "multipart/form-data", // Configurar el encabezado adecuado para enviar un archivo
          },
        })
        .then(function (response) {
          me.cerrarModal();
          me.verNoticias(1);
          swal("Registrado!", "La Noticia ha sido registrada con éxito.", "success");
        })
        .catch(function (error) {
          swal("Error!", "No se ha podido registrar la Noticia.", "warning");
          console.log(error);
        });
    },
eliminarNoticia(id) {
  let me = this;

  axios
    .delete('/noticia/eliminar', { data: { id: id } })
    .then(function (response) {
      me.verNoticias(1);
      swal('Eliminado!', 'El registro ha sido eliminado con éxito.', 'success');
    })
    .catch(function (error) {
      console.log(error);
    });
},


    cerrarModal() {
      this.modal = 0;
      this.tituloModal = '';
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case 'noticia': {
          switch (accion) {
            case 'registrar': {
              this.modal = 1;
              this.tituloModal = 'Registrar Noticia';
              this.imagen = '';
              this.titulo = '';
              this.descripcion = '';
              break;
            }
          }
        }
      }
    },
  },
  mounted() {
    this.verInformacion(1);
    this.verNoticias(1);
  },
};
</script>
<style scoped>
.slide__overlay-container {
    position: relative; /* Asegura que los elementos internos se posicionen en relación a este contenedor */
    width: 100%;
    height: 100%;
    background-color: black; /* Establece el fondo negro */
}

.slide__overlay {
    width: 100%;
    height: 100%;
    position: absolute; /* Asegura que el svg se posicione correctamente dentro del contenedor */
    top: 0;
    left: 0;
}

.slide__overlay-path {
    fill-opacity: 0.5;
}

.slider-image img {
    object-fit: cover;
    width: 100%;
    height: 100;
    max-height: 650px;
}
.carousel-caption {
    position: absolute;
    top: 60%;
    left: 25%;
    transform: translate(-50%, -50%);
    color: white;
    text-align: center;
    width: 34%;
    z-index: 2;
  }
  .carousel-caption h3 {
    font-size: 300%;
    color: coral;
    font-family: "Roboto", sans-serif;
    margin-bottom: 1rem;
  }

</style>
