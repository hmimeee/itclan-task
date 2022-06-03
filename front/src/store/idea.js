const state = () => {
  return {
    ideas: []
  };
};

const getters = {
  ideas: (state) => state.ideas,
};

const mutations = {};

const actions = {
  async setIdeas({ state }, ideas) {
    state.ideas = ideas;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
