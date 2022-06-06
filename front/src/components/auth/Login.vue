<template>
  <div class="login-content">
    <div class="nk-block toggled" id="l-login">
      <div class="nk-form">
        <div class="input-group">
          <span class="input-group-addon nk-ic-st-pro"
            ><i class="notika-icon notika-support"></i
          ></span>
          <div class="nk-int-st">
            <input
              type="text"
              class="form-control"
              placeholder="Email"
              v-model="loginData.email"
            />
          </div>
        </div>
        <div class="input-group mg-t-15">
          <span class="input-group-addon nk-ic-st-pro"
            ><i class="notika-icon notika-edit"></i
          ></span>
          <div class="nk-int-st">
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="loginData.password"
            />
          </div>
        </div>
        <button
          class="btn btn-login btn-success btn-float"
          @click="attemptLogin()"
        >
          <i class="notika-icon notika-right-arrow right-arrow-ant"></i>
        </button>
      </div>

      <div class="nk-navigation nk-lg-ic">
        <router-link
          :to="'/register'"
          data-ma-action="nk-login-switch"
          data-ma-block="#l-register"
        >
          <i class="notika-icon notika-plus-symbol"></i>
          <span>Register</span>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import useAuthentication from "@/composable/auth";

export default {
  setup() {
    const loginData = ref({
      email: null,
      password: null,
    });
    const { login } = useAuthentication();

    const attemptLogin = async () => {
      await login(loginData.value);
    };

    return {
      loginData,
      attemptLogin,
    };
  },
};
</script>
