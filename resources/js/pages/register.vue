<template>
    <div class="container d-flex justify-content-center p-3 mt-5">
        <div class="wrapper mt-5 w-50">
            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Please Register</h2>
                <p class="text-danger">{{ errors.massegeError }}</p>
                <div class="input-group ">
                    <input type="email" v-model="form.email" class="form-control" name="username"
                           placeholder="Email Address" required=""
                           autofocus=""/>
                </div>
                <p class="text-danger">{{ errors.emailError }}</p>
                <div class="input-group ">
                    <input type="text" class="form-control" v-model="form.name" name="name" placeholder="name"
                           required=""/>
                </div>
                <p class="text-danger">{{ errors.nameError }}</p>
                <div class="input-group">
                    <input type="password" class="form-control" v-model="form.password" name="password"
                           placeholder="Password" required=""/>
                </div>
                <p class="text-danger">{{ errors.passwordError }}</p>
                <div class="input-group ">
                    <input type="password" class="form-control" v-model="form.confirmation_password"
                           name="confirmation_password"
                           placeholder="confirmation Password" required=""/>
                </div>
                <p class="text-danger">{{ errors.confirmationError }}</p>
                <button class="btn btn-lg btn-primary btn-block" @click.prevent="userRegister" type="submit">Register
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import {router} from "../router";

export default {
    name: "register",
    data() {
        return {
            form: {
                email: '',
                name: '',
                password: '',
                confirmation_password: '',

            },
            reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            errors: {
                emailError: "",
                nameError: "",
                passwordError: "",
                confirmationError: '',
                massegeError:''
            },

        }
    },
    watch: {
        'form.email'(val) {
            if (!this.reg.test(val)) {
                this.errors.emailError = 'Email is not correct'
            } else {
                this.errors.emailError = ''
            }
        },
        'form.name'(val) {
            if (val.length < 2 || val.length > 9) {
                this.errors.nameError = 'Must be minimum 2 and maximum 9'
            } else {
                this.errors.nameError = ''
            }
        },
        'form.password'(val) {
            if (val.length < 6) {
                this.errors.passwordError = 'Must be minimum 6'
            } else {
                this.errors.passwordError = ''
            }
        },
        'form.confirmation'(val) {
            if (this.form.password !== val) {
                this.errors.confirmationError = 'Must be match'
            } else {
                this.errors.confirmationError = ''
            }
        }
    },
    methods: {
        async userRegister() {

            if (this.form.password.length < 6 || this.form.password !== this.form.confirmation_password || this.form.name.length < 2 || this.form.name.length > 9 || !this.reg.test(this.form.email) || this.form.password.length < 6) {
                if (!this.reg.test(this.form.email) || this.form.email.length === 0) {
                    this.errors.emailError = 'Email is not correct'
                }
                if (this.form.name.length < 2 || this.form.name.length > 9) {
                    this.errors.nameError = 'Must be minimum 2 and maximum 9'
                }
                if (this.form.password.length < 6) {
                    this.errors.passwordError = 'Must be minimum 6'
                }
                if (this.form.password !== this.form.confirmation_password) {
                    this.errors.confirmationError = 'Must be match'
                }
                return false
            }
            let response = await this.$store.dispatch('register/registerUser',this.form)

            if (response.success){
                 router.push({ path: '/login'})
            }else{
               console.log(1111)
            }
        }
    },
}
</script>

<style scoped>


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
