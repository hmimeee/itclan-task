import store from '@/store/index'


const setIsLoading = async (status) => {
    store.dispatch('app/setIsLoading', status)
}

const $h = {
    setIsLoading
};

export default $h;