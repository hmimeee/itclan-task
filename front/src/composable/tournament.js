import http from "@/service/http";
import {
  useStore
} from "vuex";

export default function useTournaments() {
  const vuexStore = useStore();

  const storeTournament = async (data) => {
    let res = await http.post("tournaments", data);
    if (res.message) alert(res.message);
    return res;
  };

  const getTournaments = async () => {
    let res = await http.get("tournaments");
    await vuexStore.dispatch("tournament/setTournaments", res);
    return res;
  };

  const getTournament = async (tournamentId) => {
    let res = await http.get(`tournaments/${tournamentId}`);
    await vuexStore.dispatch("tournament/setTournament", res);
    return res;
  };

  return {
    storeTournament,
    getTournaments,
    getTournament
  };
}