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
                                        <option value="nombre">Nombre</option>
                                        <option value="num_documento">CI</option>
                                        <option value="marca">Marca</option>
                                        <option value="telefono">Celular</option>
                                      </select>
                                      <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
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
                                                        <span v-text="persona.nombre" class="widget-subheading opacity-7"></span>
                                                    </div>
                                                </div>
                                                <div v-else>
                                                    <span v-text="persona.nombre" class="widget-subheading opacity-7"></span>
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
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="persona.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(persona.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(persona.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-block text-center card-footer">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,date1,date2)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,date1,date2)" v-text="page"></a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,date1,date2)">Sig</a>
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
                                <form method="post" enctype="multipart/form-data">
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
                                                    <p><span style="color: antiquewhite;"> Nombre:</span><input type="text" v-model="nombre" class="form-control" placeholder="Nombre y Apellido"></p>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%; margin-top: -5.4%;">
                                                    <p><span style="color: antiquewhite;"> Cargo:</span> <select v-model="idcargo" class="form-control"><option value="0" disabled>Seleccione el Cargo</option><option v-for="cargo in arrayCargo" :key="cargo.id" :value="cargo.id" v-text="cargo.nombre" v-if="cargo.id>0"></option></select></p>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-right: -15%;width: 60%;">
                                            <div class="user-card-info">
                                              <h2 v-text="tituloModal"></h2> <h2>Trabajador</h2>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><span> CI:</span> <input type="text" v-model="num_documento" class="form-control" placeholder="Número de CI"></p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Celular:</span><input type="text" v-model="telefono" class="form-control" placeholder="Celular"></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Direccion:</span> <input type="text" v-model="direccion" class="form-control" placeholder="Dirección"></p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Rol:</span>  <select v-model="idrol" class="form-control" disabled><option value="0" disabled>Seleccione</option><option v-for="role in arrayRol" :key="role.id" :value="role.id" v-text="role.nombre"></option></select></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <p><span> Email:</span> <input type="email" id="email" v-model="email" class="form-control" placeholder="Email" required></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Password:</span> <input type="password" v-model="password" class="form-control" placeholder="password del usuario" required></p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Confirm Password:</span> <input type="password" v-model="password2" class="form-control" placeholder="password del usuario" required></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <p><span> Seleecione la Imagen:</span> <input ref="fileInput" type="file" class="form-control" @change="obtimage"></p>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
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
                                <form method="post" enctype="multipart/form-data">
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
                                                    <p><span style="color: antiquewhite;"> Nombre:</span><input type="text" v-model="nombre" class="form-control" placeholder="Nombre y Apellido"></p>
                                                </div>
                                                <div class="col-md-12 mb-3" style="margin-left: -10%; margin-top: -5.4%;">
                                                    <p><span style="color: antiquewhite;"> Marca:</span> <input type="text" v-model="marca" class="form-control" placeholder="Marca de la persona"></p>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-right: -15%;width: 60%;">
                                            <div class="user-card-info">
                                              <h2 v-text="tituloModal"></h2> <h2>Afiliado</h2>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><span> CI:</span> <input type="text" v-model="num_documento" class="form-control" placeholder="Número de CI"></p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Celular:</span><input type="text" v-model="telefono" class="form-control" placeholder="Celular"></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Direccion:</span> <input type="text" v-model="direccion" class="form-control" placeholder="Dirección"></p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Rol:</span>  <select v-model="idrol" class="form-control" disabled><option value="0" disabled>Seleccione</option><option v-for="role in arrayRol" :key="role.id" :value="role.id" v-text="role.nombre"></option></select></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <p><span> Email:</span> <input type="email" id="email" v-model="email" class="form-control" placeholder="Email" required></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Password:</span> <input type="password" v-model="password" class="form-control" placeholder="password del usuario" required></p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><span> Confirm Password:</span> <input type="password" v-model="password2" class="form-control" placeholder="password del usuario" required></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <p><span> Seleecione la Imagen:</span> <input ref="fileInput" type="file" class="form-control" @change="obtimage"></p>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
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
                idcargo:0,
                vermodal:1,
                ing:'',
                persona_id: 0,
                nombre : '',
                marca : '',
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '',
                password:'',
                password2:'',
                idrol: '',
                imagen: '',
                imagenmin:'',
                arrayPersona : [],
                arrayRol : [],
                arrayCargo : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
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
        methods : {
            cambiarmodal() {
            this.inputHabilitado = 'false';
            this.vermodal = 2;
            this.idrol = 3;
            this.imagen = '';
            this.$refs.fileInput.value = '';  // Cambia el valor para habilitar el input
            },
            cambiarmodal1() {
            this.inputHabilitado = 'true';
            this.vermodal = 1;
            this.idrol = 2;
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
            registrarPersona(){
                if (this.validarPersona()){
                    return;
                }

                let me = this;

                let formData = new FormData();

                formData.append('nombre', this.nombre);
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
               swal(
                        'Registrado!',
                        'El Usuario ha sido Registrado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        swal(
                        'Error!',
                        'No se a podido Registrar el Usuario.',
                        'warning'
                        )
                        console.log(error);
                    });
            },

            actualizarPersona(){
               if (this.validarPersona()){
                    return;
                }

            let me = this;
            let formData = new FormData();

                formData.append('id', this.persona_id);
                formData.append('nombre', this.nombre);
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
                  swal(
                        'Actualizado!',
                        'El Usuario ha sido Actualizado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];
                if (this.password2 != this.password) this.errorMostrarMsjPersona.push(""),swal ( 'Error!', 'La Contraseñas no coinciden!','warning');
                if (!this.password) this.errorMostrarMsjPersona.push(""),swal ( 'Error!', '¡El Password del Usuario no puede estar Vacio!','warning');
                if (this.email=='') this.errorMostrarMsjPersona.push(""),swal ( 'Error!','¡Ingrese el Email del Usuario!','warning');
                if (this.idrol==0) this.errorMostrarMsjPersona.push(""),swal ( 'Error!', '¡Seleccione un Rol!','warning' );
                if (this.direccion=='') this.errorMostrarMsjPersona.push(""), swal ( 'Error!','¡Ingrese Una Direccion!','warning');
                if (this.telefono==0) this.errorMostrarMsjPersona.push(""),swal ( 'Error!','¡Ingrese Un Numero de Telefono!','warning');
                if (this.num_documento=='') this.errorMostrarMsjPersona.push(""),swal ( 'Error!','¡Ingrese el numero de Documento!','warning');
                if (this.idcargo==0 && this.vermodal == 1) this.errorMostrarMsjPersona.push(""),swal ( 'Error!', '¡Seleccione un Cargo!','warning' );
                if (this.marca=='' && this.vermodal == 2) this.errorMostrarMsjPersona.push(""),swal ( 'Error!','¡Ingrese la Marca de la Persona!','warning');
                if (!this.nombre) this.errorMostrarMsjPersona.push(""),swal (  'Error!','El Nombre no puede estar vacio.','warning' );

                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
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
                this.idcargo=0;
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
                                this.marca='';
                                this.num_documento='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.usuario='';
                                this.password='';
                                this.idrol=2;
                                this.idcargo=0;
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
                                this.marca = data['marca'];
                                this.num_documento = data['num_documento'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.email = data['email'];
                                this.usuario = data['usuario'];
                                this.password=data['password'];
                                this.imagen=data['imagen'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarUsuario(id){

                    let me = this;

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            activarUsuario(id){

                    let me = this;

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
        }
    }
</script>
<style>
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
     height: 550px;
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
