<template>
            <section>

                <section>
                    <div class="app-page-title">
                            <div class="page-title-wrapper" style="width: 100%;justify-content: center;display: flex;">
                                <div class="page-title-heading" style="width: 25%;">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>LISTA DE USUARIOS
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
                        <div class="card-header"># LISTA DE USUARIOS
                            <div class="btn-actions-pane-right">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="nombre">Nombre o Rol</option>
                                        <option value="num_documento">CI</option>
                                        <option value="marca">Marca</option>
                                        <option value="telefono">Celular</option>
                                      </select>
                                      <input type="text" v-model="buscar" @keyup="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                      <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                      <button type="button" class="btn btn-info" @click="abrirModal('persona','registrar')" data-bs-toggle="modal" style="margin-left: 1%;">
                                        <i class="fa fa-plus-circle"></i>&nbsp; Registrar Usuario
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">CI</th>
                                    <th class="text-center">Direccion</th>
                                    <th class="text-center">Celular</th>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="persona in arrayPersona" :key="persona.id">
                                    <td v-text="persona.id" class="text-center"></td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper " style="margin-left:22%;">
                                                <div class="widget-content-left me-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" :src="'/img/usuarios/' + persona.imagen" alt="">
                                                    </div>
                                                </div>
                                                <div v-if="persona.idrol == 3">
                                                    <div class="widget-content-left flex2">
                                                        <span v-text="persona.marca" class="widget-heading"></span>
                                                        <div>                                                            
                                                            <span v-text="persona.nombre" class="widget-subheading opacity-7"></span>
                                                            <span v-text="persona.apellidoP" class="widget-subheading opacity-7"></span>
                                                            <span v-text="persona.apellidoM" class="widget-subheading opacity-7"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else>
                                                    <span v-text="persona.nombre" class="widget-subheading opacity-7"></span>                                                    
                                                    <span v-text="persona.apellidoP" class="widget-subheading opacity-7"></span>
                                                    <span v-text="persona.apellidoM" class="widget-subheading opacity-7"></span>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td v-text="persona.num_documento" class="text-center"></td>
                                    <td v-text="persona.direccion" class="text-center"></td>
                                    <td v-text="persona.telefono" class="text-center"></td>
                                    <td v-text="persona.rol" class="text-center"></td>
                                    <td class="text-center">
                                        <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                            <i style="color: white;" class="fa fa-edit" aria-hidden="true"></i>
                                        </button> &nbsp;
                                            <button v-if="persona.condicion == 1" type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(persona.id)">
                                                <i class="fa fa-solid fa-xmark"></i>
                                            </button>
                                            <button v-if="persona.condicion == 0" type="button" class="btn btn-success btn-sm" @click="activarUsuario(persona.id)">
                                                <i class="fa fa-solid fa-circle-check"></i>
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
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
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
                <div v-if="this.vermodal == 1" class="modal-content">
                    <div class="modal-body">
                        <div class="main-card mb-3 card">
                            <form @submit.prevent="registrarPersona" ref="form" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                        <div class="user-card">
                                            <button style="margin-right: -94%; margin-top: -4%; position: absolute;" type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        <div class="row" style="margin-left: -14%; width: 40%; margin-top: 4.5%;">
                                            <div v-if="tipoAccion==1" style="margin-top: -15%;">
                                                <label style="color:white;" class="form-label">Cambiar Tipo de Usuario:</label>
                                                <input type="checkbox" class="inputcheck" @click="cambiarmodal">
                                            </div>
                                            <div class="user-card-img" style="display: block;">
                                                <div class="row" style="margin-left: -11%;">
                                                    <div  v-if="imagen=='' && tipoAccion == 1|| imagen==undefined && tipoAccion == 1">
                                                            <img src="/img/usuarios/avatartrabajador.png" alt="">
                                                        </div>
                                                    <div v-else-if="tipoAccion==1">
                                                        <img :src="imagenm" alt="">
                                                    </div>
                                                    <div  v-if="imagenm=='' && tipoAccion == 2">
                                                        <img :src="'/img/usuarios/' + this.imagen" alt="">
                                                    </div>
                                                    <div v-else-if="tipoAccion==2 || imagen==undefined">
                                                        <img :src="imagenm" alt="">
                                                    </div>
                                                </div>
                                              <div class="row">
                                                <div class="col-md-12 mb-3" style="margin-left: -10%;">
                                                    <span style="color: antiquewhite;"> Nombre:</span><input type="text" v-model="nombre" class="form-control" placeholder="Nombre..."  required>
                                                    <div class="invalid-feedback"> Añada un Nombre</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%;">
                                                    <span style="color: antiquewhite;"> ApellidoP:</span><input type="text" v-model="apellidoP" class="form-control" placeholder="Apellido P" required>
                                                    <div class="invalid-feedback"> Añada Apellido P!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%;">
                                                    <span style="color: antiquewhite;"> ApellidoP:</span><input type="text" v-model="apellidoM" class="form-control" placeholder="Apellido M" required>
                                                    <div class="invalid-feedback"> Añada Apellido M!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%; margin-top: -5.4%;">
                                                    <span style="color: antiquewhite;"> Cargo:</span> <select v-model="idcargo" class="form-control" required><option value="" disabled>Seleccione el Cargo</option><option v-for="cargo in arrayCargo" :key="cargo.id" :value="cargo.id" v-text="cargo.nombre" v-if="cargo.id>0"></option></select>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-right: -15%;width: 60%;">
                                            <div class="user-card-info">
                                              <h2 v-text="tituloModal"></h2> <h2>Trabajador</h2>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                   <span style="font-weight: 700;"> CI:</span> <input type="text" v-model="num_documento" class="form-control" placeholder="Número de CI" pattern="^[0-9]{8,}$" title="Solo numeros y Debe contener al menos 8 caracteres" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> Celular:</span><input type="text" v-model="telefono" class="form-control" placeholder="Celular" pattern="^[0-9]{8,}$" title="Solo numeros y Debe contener al menos 8 caracteres" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                   <span style="font-weight: 700;"> Direccion:</span> <input type="text" v-model="direccion" class="form-control" placeholder="Dirección" pattern=".{8,}" title="Debe contener al menos 8 caracteres" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Rol:</span>  <select v-model="idrol" class="form-control" disabled><option value="0" disabled>Seleccione</option><option v-for="role in arrayRol" :key="role.id" :value="role.id" v-text="role.nombre"></option></select></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <span style="font-weight: 700;"> Email:</span> <input type="email" id="email" v-model="email" class="form-control" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> Password:</span> <input type="password" v-model="password" class="form-control" placeholder="password del usuario" pattern=".{8,}" title="Debe contener al menos 8 caracteres" required>
                                                    <div class="invalid-feedback"> Ingresa al menos 8 Caracteres!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> Confirm Password:</span> <input type="password" v-model="password2" class="form-control" placeholder="password del usuario" pattern=".{8,}" title="Debe contener al menos 8 caracteres" required>
                                                </div>
                                             </div>
                                             <form enctype="multipart/form-data">
                                                <div class="row">
                                                  <div class="col-md-12 mb-3">
                                                    <p><span> Seleecione la Imagen:</span> <input ref="fileInput" type="file" class="form-control" @change="obtimage" style="border: 1px solid #ced4da; background-repeat: no-repeat; background-position: right calc(0.35em + 0.1875rem) center; background-image: url(../fonts/binoculars-solid.svg);"></p>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                        </div>
                                        </div>
                                        <div style="margin-top: -6%; display: flex; justify-content: center;">
                                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" v-if="tipoAccion==1" style="margin-left: 2%;" class="btn btn-primary" @click="registrarPersona()" @onclick="funciones()">Registrar</button>
                                            <button type="button" v-if="tipoAccion==2" style="margin-left: 2%;" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                                        </div>
                                </form>
                            </div>
                    </div>
                </div>

                <div  v-if="this.vermodal == 2" class="modal-content">
                    <div class="modal-body">
                        <div class="main-card mb-3 card">
                                <form @submit.prevent="registrarPersona" ref="form" enctype="multipart/form-data" :class="['needs-validation', { 'was-validated': formValidated }]">
                                        <div class="user-card">
                                            <button style="margin-right: -94%; margin-top: -4%; position: absolute;" type="button" @click="cerrarModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        <div class="row" style="margin-left: -14%; width: 40%; margin-top: 4.5%;">
                                            <div v-if="tipoAccion==1" style="margin-top: -15%;">
                                                <label style="color:white;" class="form-label">Cambiar Tipo de Usuario:</label>
                                                <input type="checkbox" class="inputcheck" @click="cambiarmodal1" v-model="inputHabilitado">
                                            </div>
                                            <div class="user-card-img" style="display: block;">
                                                <div class="row" style="margin-left: -11%;">
                                                    <div  v-if="imagen=='' && tipoAccion == 1|| imagen==undefined && tipoAccion == 1">
                                                            <img src="/img/usuarios/avatarafiliado.png" alt="">
                                                        </div>
                                                    <div v-else-if="tipoAccion==1">
                                                        <img :src="imagenm" alt="">
                                                    </div>
                                                    <div  v-if="imagenm=='' && tipoAccion == 2">
                                                        <img :src="'/img/usuarios/' + this.imagen" alt="">
                                                    </div>
                                                    <div v-else-if="tipoAccion==2 || imagen==undefined">
                                                        <img :src="imagenm" alt="">
                                                    </div>
                                                </div>
                                              <div class="row">
                                                <div class="col-md-12 mb-3" style="margin-left: -10%;">
                                                    <span style="color: antiquewhite;"> Nombre:</span><input type="text" v-model="nombre" class="form-control" placeholder="Nombre..."  required>
                                                    <div class="invalid-feedback"> Añada un Nombre</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%;">
                                                    <span style="color: antiquewhite;"> ApellidoP:</span><input type="text" v-model="apellidoP" class="form-control" placeholder="Apellido P" required>
                                                    <div class="invalid-feedback"> Añada Apellido P!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%;">
                                                    <span style="color: antiquewhite;"> ApellidoP:</span><input type="text" v-model="apellidoM" class="form-control" placeholder="Apellido M" required>
                                                    <div class="invalid-feedback"> Añada Apellido M!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%; margin-top: -5.4%;">
                                                    <span style="color: antiquewhite;"> Marca:</span> <input type="text" v-model="marca" class="form-control" pattern=".{2,}" title="Debe contener al menos 2 caracteres" placeholder="Marca de la persona" required>
                                                    <div class="invalid-feedback"> Añada una Marca!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-right: -15%;width: 60%;">
                                            <div class="user-card-info">
                                              <h2 v-text="tituloModal"></h2> <h2>Afiliado</h2>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> CI:</span> <input type="text" v-model="num_documento" class="form-control" pattern="^[0-9]{8,}$" title="Solo numeros y Debe contener al menos 8 caracteres" placeholder="Número de CI" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> Celular:</span><input type="text" v-model="telefono" class="form-control" pattern="^[0-9]{8,}$" title="Solo numeros y Debe contener al menos 8 caracteres" placeholder="Celular" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> Direccion:</span> <input type="text" v-model="direccion" class="form-control" pattern=".{8,}" title="Debe contener al menos 8 caracteres" placeholder="Dirección" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Rol:</span>  <select v-model="idrol" class="form-control" disabled><option value="0" disabled>Seleccione</option><option v-for="role in arrayRol" :key="role.id" :value="role.id" v-text="role.nombre"></option></select></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <span style="font-weight: 700;"> Email:</span> <input type="email" id="email" v-model="email" class="form-control" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" required>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> Password:</span> <input type="password" v-model="password" class="form-control" placeholder="password del usuario" pattern=".{8,}" title="Debe contener al menos 8 caracteres" required>
                                                    <div class="invalid-feedback"> Ingresa al menos 8 Caracteres!</div>
                                                    <div class="valid-feedback"> Correcto! </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span style="font-weight: 700;"> Confirm Password:</span> <input type="password" v-model="password2" class="form-control" placeholder="password del usuario" pattern=".{8,}" title="Debe contener al menos 8 caracteres" required>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <p><span> Seleecione la Imagen:</span> <input ref="fileInput" type="file" class="form-control" @change="obtimage" style="border: 1px solid #ced4da; background-repeat: no-repeat; background-position: right calc(0.35em + 0.1875rem) center; background-image: url(/public/fonts/binoculars-solid.svg);"></p>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div style="margin-top: -6%; display: flex; justify-content: center;">
                                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" v-if="tipoAccion==1" style="margin-left: 2%;" class="btn btn-primary" @click="verificarMarca()" @onclick="funciones()">Registrar</button>
                                            <button type="button" v-if="tipoAccion==2" style="margin-left: 2%;" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                                        </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
            <!--Fin del modal-->
            </section>
</template>

<script>

    export default {

        data (){
            return {
                inputHabilitado : false,
                idcargo:'',
                vermodal:1,
                ing:'',
                persona_id: 0,
                nombre : '',
                apellidoP : '',
                apellidoM : '',
                marca : '',
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '',
                password:'',
                password2:'',
                idrol: '',
                formValidated: false,
                imagen: '',
                imagenmin:'',
                arrayPersona : [],
                arrayRol : [],
                arrayCargo : [],
                modal : 0,
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
                criterio : 'nombre',
                buscar : ''
            }

        },

        computed:{
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
        watch: {
        idcargo: function(newIdCargo, oldIdCargo) {
            if (newIdCargo === 1) {
            this.idrol = 1; // Cambiar idrol a 1
            } else {
            // Otra lógica si idcargo no es igual a 1
            }
            }
        },

        methods : {
            cambiarmodal() {
            this.inputHabilitado = 'false';
            this.formValidated = false;
            this.vermodal = 2;
            this.idrol = 3;
            this.email = '';
            this.password = '';
            this.imagen = '';
            this.$refs.fileInput.value = '';  // Cambia el valor para habilitar el input
            },
            cambiarmodal1() {
            this.inputHabilitado = 'true';
            this.formValidated = false;
            this.vermodal = 1;
            this.idrol = 2;
            this.email = '';
            this.password = '';
            this.imagen = '';
            this.$refs.fileInput.value = ''; // Cambia el valor para habilitar el input
            },

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
            listarPersona (page,buscar,criterio){
                let me=this;
                var url= '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRol(){
                let me=this;
                var url= '/rol/selectRol';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectCargo(){
                let me=this;
                var url= '/cargo/selectCargo';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCargo = respuesta.cargos;
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
                me.listarPersona(page,buscar,criterio);
            },
            verificarMarca() {
                axios.post('/user/verificarMarca', { marca: this.marca })
                    .then((response) => {
                        if (response.data.exists) {
                            Swal.fire('Error', 'La marca ya existe en la base de datos.', 'error');
                        } else {
                            // Marca no existe, continuar con el registro
                            this.registrarPersona();
                        }
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            registrarPersona(){
                if (this.$refs.form.checkValidity()) {                    
                    const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });                
                swalWithBootstrapButtons.fire({
                    title: 'Registrar!',
                    text: "Estás Seguro de Registrar este Usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Registrar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {                      
                let me = this;
                let formData = new FormData();
                formData.append('nombre', this.nombre);
                formData.append('apellidoP', this.apellidoP);
                formData.append('apellidoM', this.apellidoM);
                formData.append('marca', this.marca);
                formData.append('num_documento', this.num_documento);
                formData.append('direccion', this.direccion);
                formData.append('telefono', this.telefono);
                formData.append('email', this.email);
                formData.append('idrol', this.idrol);
                formData.append('idcargo', this.idcargo);
                formData.append('password', this.password);
                formData.append('imagen', this.imagen);

                axios.post('/user/registrar',formData)
                .then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
               Swal.fire(
                        'Registrado!',
                        'El Usuario ha sido Registrado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        Swal.fire(
                        'Error!',
                        'No se a podido Registrar el Usuario Verifique los Datos.',
                        'warning'
                        )
                        console.log(error);
                    });
                    } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                        }
                    })
                } else {
                        Swal.fire('Validacion!', 'Porfavor llena todos los campos!', 'warning');
                    this.formValidated = true;
                }
            },

            actualizarPersona(){

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Actualizar!',
                    text: "Estás Seguro de Actualizar este Usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Actualizar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

            let me = this;
            let formData = new FormData();

                formData.append('id', this.persona_id);
                formData.append('nombre', this.nombre);                
                formData.append('apellidoP', this.apellidoP);
                formData.append('apellidoM', this.apellidoM);
                formData.append('marca', this.marca);
                formData.append('num_documento', this.num_documento);
                formData.append('direccion', this.direccion);
                formData.append('telefono', this.telefono);
                formData.append('email', this.email);
                formData.append('idrol', this.idrol);
                formData.append('idcargo', this.idcargo);
                formData.append('password', this.password);
                formData.append('imagen', this.imagen);


                axios.post('/user/actualizar',formData).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                  Swal.fire(
                        'Actualizado!',
                        'El Usuario ha sido Actualizado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                        }
                    })
            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.apellidoP='';
                this.apellidoM='';
                this.formValidated=false;
                this.inputHabilitado = 'false';
                this.vermodal=1;
                this.marca='';
                this.num_documento='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.usuario='';
                this.password='';
                this.password2='';
                this.idcargo='';
                this.idrol=0;
                this.imagen = '';
                this.imagenmin = '';
                this.$refs.fileInput.value = '';
                this.errorPersona=0;
            },
            abrirModal(modelo, accion, data = []){
                this.selectRol();
                this.selectCargo();
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Usuario';
                                this.nombre= '';
                                this.apellidoP='';
                                this.apellidoM='';
                                this.marca='';
                                this.num_documento='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.usuario='';
                                this.password='';
                                this.password2='';
                                this.idrol=2;
                                this.idcargo='';
                                this.imagen = '';
                                this.imagenmin = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Usuario';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.idrol=data['idrol'];
                                this.idcargo=data['idcargo'];
                                if(data['idrol']==1 || data['idrol']==2){
                                this.vermodal = 1;
                                }else{
                                this.vermodal = 2;
                                }
                                this.nombre = data['nombre'];
                                this.apellidoP = data['apellidoP'];
                                this.apellidoM = data['apellidoM'];
                                this.marca = data['marca'];
                                this.num_documento = data['num_documento'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.email = data['email'];
                                this.usuario = data['usuario'];
                                this.password=data['password'];
                                this.password2=data['password'];
                                this.imagen=data['imagen'];
                                break;
                            }
                        }
                    }
                }
            },

            activarUsuario(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Activar!',
                    text: "Estás Seguro de Activar este Usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                    let me = this;

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        Swal.fire(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });  } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
        },
            desactivarUsuario(id){

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn2 btn-success',
                        cancelButton: 'btn2 btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Desactivar!',
                    text: "Estás Seguro de Desactivar este Usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                    let me = this;

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        Swal.fire(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
                }
            },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
        }
    }
</script>
<style scoped>
.wrapper{
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 12%;
  }
  .user-card {
     display: flex;
     flex-direction: column;
     align-items: center;
     justify-content: center;
     background-color: #fff;
     border-radius: 10px;
     padding: 40px;
     width: 700px;
     position: relative;
     overflow: hidden;
     box-shadow: 0 2px 20px -5px rgba(0,0,0,0.5);
 }

 .user-card:before {
    content: '';
    position: absolute;
    height: 300%;
    width: 173px;
    background: #262626;
    top: -60px;
    left: -125px;
    z-index: 0;
    transform: rotate(17deg);
  }

  .user-card-img {
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 3;
  }

  .user-card-img img {
    width: 230px;
    height: 230px;
    object-fit: cover;
        border-radius: 50%;
  }

  .user-card-info {
    text-align: center;
  }

  .user-card-info h2 {
    font-size: 24px;
    margin: 0;
    margin-bottom: 10px;
    font-family: fantasy;
    text-align: center;
    color: darkred;
    letter-spacing: 3px;
  }

  .user-card-info p {
    font-size: 14px;
    margin-bottom: 2px;
  }
  .user-card-info p span {
     font-weight: 700;
     margin-right: 10px;
 }
  @media only screen and (min-width: 768px) {
    .user-card {
     width: 100%;
      flex-direction: row;
      align-items: flex-start;
    }
    .user-card-img {
      margin-right: 20px;
      margin-bottom: 0;
    }

    .user-card-info {
      text-align: left;
    }
  }

  @media (max-width: 767px){
    .wrapper{
       padding-top: 3%;
    }
    .user-card:before {
       width: 300%;
       height: 200px;
       transform: rotate(0);
    }
    .user-card-info h2 {
       margin-top: 25px;
       font-size: 35px;
    }
    .user-card-info p span {
       display: block;
       margin-bottom: 15px;
       font-size: 18px;
    }
  }
</style>
