const store = ( {
    state: {
        state: {
            success: 0
        },
    },
    getters: {},
    actions: {
        async registerUser(context,data) {
            try{
                let response = await axios.post('/api/register', data)
                console.log(response)
                context.commit('SET_SUCCESS',response.data)
                return response.data;
            } catch (error) {
                console.log(error)
            }
        }
    },
    mutations: {
        SET_SUCCESS(state, data) {
            state.success = data.success
        }
    },
    namespaced: true
})

export default store
