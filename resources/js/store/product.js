import axios from "axios";

const store = ( {
    state: {
        products: []
    },
    getters: {
        products: state => state.products
    },
    actions: {
       getProducts({commit, state}) {
           return new Promise((resolve, reject) => {
               axios.get('api/products').then(res => {
                   commit('SET_PRODUCTS', res.data.data)
                   resolve(res)
               })
           })
       }
    },
    mutations: {
      SET_PRODUCTS(state, data) {
          state.products = data
      }
    },
    namespaced: true
})

export default store
