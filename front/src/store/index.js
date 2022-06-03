import { createStore } from 'vuex'
import auth from './auth'

const store = createStore({
  modules: {
    auth
  }
})

export function useStore() {
  return store
}

export default store