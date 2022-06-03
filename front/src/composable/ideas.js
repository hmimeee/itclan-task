// import { useStore } from "vuex";
import http from "@/service/http";

export default function useIdeas() {
  // const vuexStore = useStore();

  const storeIdea = async (data) => {
    let res = await http.post("ideas", data);

    if (res) alert(res.message);
  };

  return {
    storeIdea
  };
}
