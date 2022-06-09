import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "home",
    redirect: "/login",
    component: () => import("../components/Layout.vue"),
    children: [
      {
        path: "dashboard",
        name: "dashboard",
        component: () => import("../components/Dashboard.vue")
      },
      {
        path: "tournament/:tournamentId",
        name: "tournament",
        component: () => import("../components/Tournament.vue"),
      },
    ],
  },

  {
    path: "/login",
    name: "login",
    component: () => import("../components/auth/Login.vue"),
  },
  {
    path: "/register",
    name: "register",
    component: () => import("../components/auth/Register.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return (
      savedPosition || {
        left: 0,
        top: 0,
      }
    );
  },
});

router.beforeEach((to, from, next) => {
  let isAuthenticated = localStorage.getItem("_token");
  if (!["login", "register"].includes(to.name) && !isAuthenticated)
    next({ name: "login" });

  next();

  return false;
});

export default router;
