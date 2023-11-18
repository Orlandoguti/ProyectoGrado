
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./main');

window.Vue = require('vue');
window.$ = window.jQuery = require('jquery');
import Vue from 'vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)
import User from './Helpers/User'
window.User = User
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('ganados', require('./components/Ganados.vue').default);
Vue.component('afiliado-ganado', require('./components/GanadosAfiliados.vue').default);
Vue.component('noticias', require('./components/Noticias.vue').default);
Vue.component('user', require('./components/User.vue').default);

const app = new Vue({
    el: '#app',
    data:{
        menu:0

    },
});

//Salir
$('.btn-exit').on('click', function(){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn2 btn-danger',
            confirmButton: 'btn2 btn-info'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: 'Salir!',
        text: 'Quieres salir del sistema y cerrar la sesión actual',
        imageUrl: './fonts/exit-icon.png',
        showCancelButton: true,
        cancelButtonText: 'No, Salir!',
        confirmButtonText: 'Si, Salir!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'logout';

            Swal.fire(
                'Sesion Cerrada!',
                'Gracias Por Ingresar al Sistema',
                'success'
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // El usuario canceló la acción
        }
    });
});

