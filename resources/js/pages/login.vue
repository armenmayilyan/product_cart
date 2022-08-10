<template>
    <div class="container d-flex justify-content-center p-3 mt-5">
        <div class="wrapper  mt-5 w-50">
            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Please login</h2>
                <div class="input-group mb-2">
                    <input type="email" v-model="form.loginemail" class="form-control" name="username"
                           placeholder="Email Address" required=""
                           autofocus=""/>
                </div>
                <p class="text-danger">{{ errors.loginEmailError }}</p>
                <div class="input-group mb-2">
                    <input type="password" v-model="form.loginpassword" class="form-control" name="password"
                           placeholder="Password" required=""/>
                </div>
                <p class="text-danger">{{ errors.loginPasswordError }}</p>
                <div>
                    <button class="btn btn-lg btn-primary btn-block" @click.prevent="userLogin" type="submit">Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "login",
    data() {
        return {
            form: {
                loginemail: '',
                loginpassword: '',
            },
            reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            errors: {
                loginEmailError: "",
                loginPasswordError: ""
            }
        }
    },
    computed: {
      authUser() {
          return this.$store.getters['login/user']
      }
    },
    watch: {
        'form.loginemail'(val) {
            if (!this.reg.test(val)) {
                this.errors.loginEmailError = 'Email is not correct'
            } else {
                this.errors.loginEmailError = ''
            }
        },
        'form.loginpassword'(val) {
            if (val.length < 6) {
                this.errors.loginPasswordError = 'Must be minimum 6'
            } else {
                this.errors.loginPasswordError = ""
            }
        },
    },
    methods: {
        async userLogin() {
            if (!this.reg.test(this.form.loginemail) || this.form.loginpassword.length < 6) {
                if (!this.reg.test(this.form.loginemail) || this.form.loginemail.length === 0) {
                    this.errors.loginEmailError = 'Email is not correct'
                }
                if (this.form.loginpassword.length < 6) {
                    this.errors.loginPasswordError = 'Must be minimum 6'
                }
                return
            }
            this.$store.dispatch('login/login', this.form).then(res => {
                    this.$router.push({path: '/home'})
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>

<style scoped>

.wrapper {
    margin-top: 80px;
    margin-bottom: 80px;
}

.form-signin {
    max-width: 380px;
    padding: 15px 35px 45px;
    margin: 0 auto;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.form-control {
    position: relative;
    font-size: 16px;

    height: auto;
    padding: 10px;

}

input {
    margin-bottom: 10px;
}

input[type="text"] {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

input[type="password"] {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}


</style>
