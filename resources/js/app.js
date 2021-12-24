

require('./bootstrap');

window.Vue = require('vue').default;


import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Welcome from './components/Welcome.vue';

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


let routes = [


    { path: '/', component: require('./components/Dashboard.vue').default },

    { path: '/Dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/Calendar', component: require('./components/Calendar.vue').default },
    { path: '/ToDo', component: require('./components/ToDo.vue').default },

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

