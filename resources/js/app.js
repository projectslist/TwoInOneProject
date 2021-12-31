

require('./bootstrap');

window.Vue = require('vue').default;


import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Welcome from './components/Welcome.vue';


//added for vform

window.Form = Form;
import Form from 'vform'
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
} from 'vform/src/components/bootstrap4'
// 'vform/src/components/bootstrap5'
// 'vform/src/components/tailwind'

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)


//  ending for vform



//swall starting
import Swal from 'sweetalert2';
import Vue from 'vue';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})



window.Toast = Toast;
//swall import ending


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


let routes = [


    { path: '/', component: require('./components/Dashboard.vue').default },

    { path: '/Dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/Calendar', component: require('./components/Calendar.vue').default },
    { path: '/ToDo', component: require('./components/ToDo.vue').default },
    { path: '/*', component: require('./components/NotFound.vue').default }


]


const router = new VueRouter({
    mode:'history',
    routes
})



const welcome = new Vue({
    el: '#welcome',
    render: h => h(Welcome),
    router,
});

