import Vue from "vue";

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
        login(store, data) {
            return new Promise((resolve, reject) => {
                axios.post('/api/login', data).then(response => {
                    localStorage.setItem('auth_token', response.data.data.token)
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token')
                    store.commit('SET_USER', response.data.data)
                    resolve(response)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        async getAuth(context) {
            try {
                let response = await axios.get('/api/auth/user')
                context.commit('SET_USER', response.data.data)
                return response.data.data;
            } catch (error) {
                console.log(error)
            }
        },
        async removeAuth(context) {
            try {
                context.commit('REMOVE_AUTH')
                localStorage.removeItem('auth_token')
                return {'success': 1}
            } catch (error) {
                console.log(error)
            }
        }

    },
    namespaced: true
})

export default store;
