import { createStore } from 'vuex'
import auth from './auth'
import app from './app'
import idea from './idea'
import tournament from './tournament'

const store = createStore({
  modules: {
    app,
    auth,
    idea,
    tournament
  }
})

export function useStore() {
  return store
}

export default store