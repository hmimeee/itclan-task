import http from "@/service/http";
import {
  useStore
} from "vuex";

export default function useIdeas() {
  const vuexStore = useStore();

  const storeIdea = async (data) => {
    let res = await http.post("ideas", data);
    if (res.message) alert(res.message);
    return res;
  };

  const getIdeas = async () => {
    let res = await http.get("ideas");
    await vuexStore.dispatch("idea/setIdeas", res);
    return res;
  };

  return {
    storeIdea,
    getIdeas
  };
}