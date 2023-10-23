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
                                    <div class="textodiv">GENERAR LISTA
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
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header"># LISTA DE BOUCHERS DE INGRESOS
                                    <div class="btn-actions-pane-right">
                                        <div class="input-group">
                                            <input type="text" v-model="buscar" @keyup="detallelista(1,buscar)" class="form-control" placeholder="Texto a buscar">
                                            <button type="submit" @click="detallelista(1,buscar)" @change="fetchChartDataFromDatabase()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                            <button type="submit" @click="generatePdf(buscar)" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Copy to use file-pdf-o"></i></button>
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
                                            <td class="text-center text-muted">{{ detallelista.nombre + ' ' + detallelista.apellidoP + ' ' + detallelista.apellidoM }}</td>
                                            <td class="text-center text-muted"  v-text="detallelista.cantidad"></td>
                                            <td class="text-center text-muted"><span>{{detallelista.total}} Bs.</span></td>
                                            <td v-text="detallelista.fecha" class="text-center"></td>
                                            <td class="text-center">
                                                <button type="button" @click="generarPDF(detallelista.id)" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Copy to use file-pdf-o"></i></button>
                                                <button type="button" class="btn btn-info btn-sm" @click="eliminarIngreso(detallelista.id)">
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
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,this.buscar)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,this.buscar)">Sig</a>
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
export default {
  data() {
    return {
      arrayDetalleLista: [],
      cantidad:'',
      fecha:'',
      buscar:'',
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
      formValidated: false,
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
    eliminarIngreso(id){
        const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Eliminar!',
                    text: "Estás Seguro de Eliminar este Ingreso?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
        axios.delete(`/ingreso/eliminar/${id}`)
            .then(response => {
            this.detallelista(1,this.buscar);
             Swal.fire(
                        'Eliminado!',
                        'El Registro se ha sido eliminado con éxito.',
                        'warning'
                        )
            console.error(error.response.data.message);
            }); } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                            }
                            })
    },
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
    detallelista(page,buscar) {
    let me = this;
    var url = `/detallelista?page=${page}&buscar=${buscar}`;
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
    generatePdf(buscar) {
        const requestData = {
            buscar: buscar,
        };

        axios.post('/Detallelistapdfindex', requestData, { responseType: 'blob' })
            .then((response) => {
                const pdfBlob = new Blob([response.data], { type: 'application/pdf' });
                const pdfUrl = URL.createObjectURL(pdfBlob);
                window.open(pdfUrl, '_blank');
            })
            .catch((error) => {
                console.error('Error generating PDF:', error);
            });
    },
    cambiarPagina(page,buscar) {
            let me = this;
            // Actualiza la página actual
            me.pagination.current_page = page;
            // Envía la petición para visualizar la data de esa página
            me.detallelista(page,buscar);
        },

  },
  mounted() {
    this.detallelista(1,this.buscar);
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
