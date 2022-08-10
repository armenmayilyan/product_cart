const store = ({
    state: {
        user: {}
    },
    getters: {
        user: state => state.user,
    },
    mutations: {
        SET_USER(state, data) {
            state.user = data.user
        },
        REMOVE_AUTH(state) {
            state.user = {}
        }
    },
    actions: {

    },
    namespaced: true
})

export default store;
