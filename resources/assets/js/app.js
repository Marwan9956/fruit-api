
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import $ from "jquery";

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const componentsName = [
    'navigation',
    'notification'
];

for(var i = 0 ; i < componentsName.length; i++){
    Vue.component(componentsName[i], require('./components/'+ componentsName[i] + '.vue'));    
}

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
//Vue.component('navigation' , require('./components/navigation.vue') )

const app = new Vue({
    el: '#app'
});
