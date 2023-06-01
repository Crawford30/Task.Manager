import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

let routes = [
    {
        path: "/task",
        component: require("./components/pages/Tasks.vue").default,
    },





    // { path: '/profile', component: require('./components/Profile.vue') },
    // { path: '*', component: require('./components/NotFound.vue') }
];

const router = new VueRouter({
    mode: "history",
    routes, // short for `routes: routes`
});

export default router;
