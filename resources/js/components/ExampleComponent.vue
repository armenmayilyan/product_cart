<template>
    <div>
        <b-navbar class="text-center d-flex justify-content-center" toggleable="lg" type="dark" variant="info">

            <router-link v-show="isLoggedIn" to="/home" class="mx-2 nav-item ">home</router-link>
            <router-link to="/login" v-show="!isLoggedIn" class="mx-2 nav-item">login</router-link>
            <router-link v-show="!isLoggedIn" to="/register" class="mx-2 nav-item">register</router-link>
            <ul v-show="isLoggedIn" class="list-group logout">
                <li class="list-group-item list-group-item-primary"><a class="nav-link ms-5" @click="logout">Logout</a>
                </li>
            </ul>
        </b-navbar>
        <router-view></router-view>
    </div>

</template>
<script>
import register from "../pages/register";
import login from "../pages/login";
import home from "../pages/home";
export default {
    components: {
        register,
        login,
        home,
    },
    data() {
        return {
            isLoggedIn: false,
        }
    },
    async mounted() {

        let token = localStorage.getItem('auth_token');
        if (token != null) {
            this.$store.dispatch('login/getAuth')
        }
    },
    computed: {
        authUser() {
           return this.$store.getters['login/user']
        }

    },
    methods: {
        async logout() {
            let response = await axios.get('/api/logout');
            let success = response.data.success
            if (success === 1) {
                await this.$store.dispatch('login/removeAuth')
                this.isLoggedIn = false
                window.axios.defaults.headers.common['Authorization'] = ''
                await this.$router.push({path: '/login'})
            }

        }

    },
    watch: {
        authUser(val) {
            if (Object.keys(val)) {
                console.log(val)
                return this.isLoggedIn = true
            }else{
                console.log(false)
                return this.isLoggedIn = false

            }
        },
        isLoggedIn(val) {
            console.log(val)
        }
    }

}
</script>
<style>
.logout {
    cursor: pointer;
}

.nav-item {
    text-decoration: none;
    color: black;
    font-size: 18px;
}
</style>
