const state = () => {
  return {
    tournaments: [],
  };
};

const getters = {
  tournaments: (state) => state.tournaments,
};

const mutations = {};

const actions = {
  async setTournaments({ state }, tournaments) {
    state.tournaments = tournaments;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
