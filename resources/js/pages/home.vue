<template>
    <div>
        <section style="background-color: #eee;">
            <div class="cart">
            </div>
            <div class="container py-5">
                <div class="row ">
                    <div class="text-center" @click="productsname">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                             class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <p class="text-danger">{{count}}</p>
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 mt-3" v-for="product in products" :key="products.id">
                        <div class="card text-black" :id="product.id">
                            <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                            <img
                                src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHw%3D&w=1000&q=80"
                                class="card-img-top" alt="Apple Computer"/>
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="card-title">{{ product.name }}</h5>
                                    <p class="text-muted mb-4">{{ product.description }}</p>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                    <span>Price: </span>{{ product.price }}<span>$</span>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success" @click.stop.prevent="addInBasket(product.id)">Add in
                                        cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "home",
    data() {
        return {
            errors: [],
            basket: [],
            count: 0
        }
    },
    mounted() {
        this.$store.dispatch('product/getProducts')
    },
    computed: {
        products() {
            return this.$store.getters['product/products']
        }
    },
    methods: {
        addInBasket(id) {
            let product = this.products.find(elem => elem.id === id)
            let payload = {
                id: product.id,
                quantity: product.quantity,
                name: product.name
            }
            if (!this.basket.includes(payload.id)) {
                this.basket.push(payload.id)
            } else {
                for (let i = 0; i < this.basket.length; i++) {
                    if (this.basket[i] === payload.id) {
                        return this.basket.splice(i, 1)
                    }
                }
            }
        },
    },
    watch: {
        async basket() {
            let response = await this.$store.dispatch('home/storeProduct', this.basket)
            this.count = response.count
        }
    }

}
</script>

<style scoped>
.count{
    cursor: pointer;
}
</style>
