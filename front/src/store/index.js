import { createStore } from 'vuex'
import auth from './auth'
import app from './app'
import idea from './idea'

const store = createStore({
  modules: {
    app,
    auth,
    idea
  }
})

export function useStore() {
  return store
}

export default store