/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import moment from "moment";
import VueProgressBar from "vue-progressbar";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";



import { Form, HasError, AlertError } from "vform";

import Gate from "./Gate";
//to have access to this anywhere in the js file
Vue.prototype.$gate = new Gate(window.user);

import swal from "sweetalert2";
window.swal = swal;

import router from "./router";



Vue.component("v-select", vSelect);

Vue.filter("upText", function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter("myDate", function (created) {
    return moment(created).format("Do-MMM-YYYY");
});

const toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});

window.toast = toast;

const options = {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300,
    },
    autoRevert: true,
    location: "left",
    inverse: false,
};

Vue.use(VueProgressBar, options);

window.Fire = new Vue();

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("pagination", require("laravel-vue-pagination"));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    data: {
        search: "",
    },
    methods: {
        searchit: _.debounce(() => {
            Fire.$emit("searching");
        }, 1000),
    },
});
