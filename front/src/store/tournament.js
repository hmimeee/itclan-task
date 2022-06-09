const state = () => {
  return {
    tournaments: [],
    tournament: {}
  };
};

const getters = {
  tournaments: (state) => state.tournaments,
  tournament: (state) => state.tournament
};

const mutations = {};

const actions = {
  async setTournaments({ state }, tournaments) {
    state.tournaments = tournaments;
  },
  
  async setTournament({ state }, tournament) {
    state.tournament = tournament;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
