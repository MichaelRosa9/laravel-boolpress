
 window.Vue = require('vue');
 
 import App from './App.vue';
 import router from './routes' /* have to export first in routes.js in order to import it here */

 const app = new Vue({
     el: '#app',
     router, 
     render: h => h(App) /* must have string so i can connect Vue (formula used in laravel case) */
 });
 