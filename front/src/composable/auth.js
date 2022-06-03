// import { computed } from 'vue'
import { useStore } from "vuex";
import http from "@/service/http";
import { useRouter } from "vue-router";

export default function useAuthentication() {
  const vuexStore = useStore();
  const router = useRouter();

  const login = async (data) => {
    let res = await http.post("login", data);

    if (res) {
      await vuexStore.dispatch("auth/storeToken", res.token);

      await vuexStore.dispatch("auth/setUser", res.user);

      router.push({ name: "dashboard" });
    } else {
      alert(res.message);
    }
    return false;
  };

  const logout = async () => {
    await vuexStore.dispatch("auth/removeToken");

    await vuexStore.dispatch("auth/removeUser");
    router.push({ name: "login" });
  };

  const authCheck = async () => {
    await vuexStore.dispatch("auth/isAuthenticated");
  };

  return {
    login,
    logout,
    authCheck,
  };
}
