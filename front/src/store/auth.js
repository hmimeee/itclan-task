import http from "@/service/http";
import { useRouter } from "vue-router";

const state = () => {
  return {
    token: localStorage.getItem("_token") || null,
    user: null,
    isAuthenticated: false,
  };
};

const getters = {
  token: (state) => state.token,
  user: (state) => state.user,
  isAuthenticated: (state) => state.isAuthenticated,
};

const mutations = {};

const actions = {
  async isAuthenticated({ dispatch, getters }) {
    const router = useRouter();
    
    try {
      if (!getters.token) throw { message: "Token Invalid", statusCode: 401 };

      let response = await http.get("user");
      if (response) {
        await dispatch("storeToken", localStorage.getItem("_token"));
        await dispatch("setUser", response);
        router.push({ name: "dashboard" });
      }
    } catch (error) {
        await dispatch("removeToken");
        await dispatch("removeUser");

      return false;
    }
  },

  async storeToken({ state }, token) {
    state.token = token;
    state.isAuthenticated = true;
    localStorage.setItem("_token", token);
  },

  async removeToken({ state }) {
    state.token = null;
    state.isAuthenticated = false;
    localStorage.removeItem("_token");
  },

  async setUser({ state }, data) {
    state.user = data;
  },

  async removeUser({ state }) {
    state.user = null;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
