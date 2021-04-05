import Vue from "vue";
import Router from "vue-router";
import Components from "./views/Components.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";

Vue.use(Router);

export default new Router({
  linkExactActiveClass: "active",
  routes: [
    {
      path: "/",
      name: "components",
      components: {
        default: Components,
      },
      props: {default: true}
    },
    {
      path: "/login",
      name: "login",
      components: {
        default: Login,
      },
      props: {default: true}
    },
    {
      path: "/register",
      name: "register",
      components: {
        default: Register,
      },
      props: {default: true}
    },
  ],
  scrollBehavior: to => {
    if (to.hash) {
      return { selector: to.hash };
    } else {
      return { x: 0, y: 0 };
    }
  }
});
