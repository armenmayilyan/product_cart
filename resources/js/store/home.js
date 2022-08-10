const store = ( {
    state: {
        count: 0,
    },
    getters: {
        count: state => state.count
    },
    actions: {
        async storeProduct(context,data) {
            try{
                let response = await axios.post('/api/products',data)
                context.commit('SET_BASKET_COUNT', response.data.data.count)

                return response.data.data
            } catch (error) {
                console.log(error)
            }
        },
    },
    mutations: {
        SET_BASKET_COUNT(state, count) {
            return state.count = count
        }
    },
    namespaced: true
})

export default store
