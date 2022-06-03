<template>
  <div>
    <!-- Start Header Top Area -->
    <div class="header-top-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="logo-area">
              <a href="#"><img src="img/logo/logo.png" alt="" /></a>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="header-top-menu">
              <ul class="nav navbar-nav notika-top-nav">
                <li class="nav-item dropdown">
                  <a
                    @click="logout()"
                    href="#"
                    data-toggle="dropdown"
                    role="button"
                    aria-expanded="false"
                    class="nav-link dropdown-toggle"
                    ><span><i class="notika-icon notika-support"></i></span
                  ></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header Top Area -->

    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mobile-menu">
              <nav id="dropdown">
                <ul class="mobile-menu-nav">
                  <li>
                    <a href="#">Home</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-t-15 mg-b-15">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
              <li class="active">
                <a href="#Home"
                  ><i class="notika-icon notika-house"></i> Home</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Main Menu area End-->

    <div class="container">
      <router-view />
    </div>
  </div>
</template>

<script>
import { computed, onMounted } from "@vue/runtime-core";
import useAuthentication from "../composable/auth";
import { useRouter } from "vue-router";
import { useStore } from 'vuex';

export default {
  setup() {
  const vuexStore = useStore();
    const router = useRouter();
    const { logout } = useAuthentication();

    onMounted(async () => {
      const isAuthenticated = computed(
        () => vuexStore.getters["auth/isAuthenticated"]
      );

      if (!isAuthenticated) router.push({ name: "login" });
    });

    return {
      logout
    };
  },
};
</script>
