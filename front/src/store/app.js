const state = () => {
  return {
    isLoading: false
  };
};

const getters = {
  setIsLoading: () => state.setIsLoading,
};

const mutations = {};

const actions = {
  async setIsLoading({ state }, status) {
    state.isLoading = status;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
