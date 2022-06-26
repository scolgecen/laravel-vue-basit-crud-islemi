import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);
import Dashboard from "../pages/Dashboard";
import UserList from "../pages/user/UserList";
const routes = [
    { path: "/", name: "dashboard", component: Dashboard },
    { path: "/users", name: "users", component: UserList }
];
export default new VueRouter({
    routes,
    mode: "history"
});
