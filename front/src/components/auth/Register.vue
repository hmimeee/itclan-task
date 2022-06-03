<template>
  <div class="login-content">
    <div class="nk-block toggled">
      <div class="nk-form">
        <div class="input-group">
          <span class="input-group-addon nk-ic-st-pro"
            ><i class="fa fa-user"></i
          ></span>
          <div class="nk-int-st">
            <input
              name="name"
              type="text"
              class="form-control"
              placeholder="Name"
            />
          </div>
        </div>

        <div class="input-group mg-t-15">
          <span class="input-group-addon nk-ic-st-pro"
            ><i class="fa fa-envelope"></i
          ></span>
          <div class="nk-int-st">
            <input
              name="email"
              type="text"
              class="form-control"
              placeholder="Email"
            />
          </div>
        </div>

        <div class="input-group mg-t-15">
          <span class="input-group-addon nk-ic-st-pro"
            ><i class="fa fa-lock"></i
          ></span>
          <div class="nk-int-st">
            <input
              name="password"
              type="password"
              class="form-control"
              placeholder="Password"
            />
          </div>
        </div>
        <button class="btn btn-login btn-success btn-float">
          <i class="notika-icon notika-right-arrow right-arrow-ant"></i>
        </button>
      </div>

      <div class="nk-navigation nk-lg-ic">
        <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-register"
          ><i class="notika-icon notika-right-arrow"></i>
          <span>Login</span></a
        >
        <a
          href="#"
          data-ma-action="nk-login-switch"
          data-ma-block="#l-forget-password"
          ><i>?</i> <span>Forgot Password</span></a
        >
      </div>
    </div>
  </div>
</template>
