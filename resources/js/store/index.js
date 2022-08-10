import Vue from "vue";
import Vuex from "vuex";
import login from './login'
import register from './register'
import home from './home'
import product from './product'
import logout from './logout'


const storeObject = {
    modules : {
        login,
        register,
        home,
        product,
        logout
    }
}

Vue.use(Vuex)
export default new Vuex.Store(storeObject)
