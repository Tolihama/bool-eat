<template>
    <div class="container pt-4" id="order-confirmed">
        <div class="cart p-5" v-if="orderData">
            <h1 class="mb-4">L'ordine è stato effettuato con successo!</h1>
            <div class="p-2 d-flex">
                <section class="p-5 col-8">
                    <div class="container d-flex flex-column">
                        <h4 class=" mb-4">Dettagli Ordine: {{ orderData.transaction_id }}</h4>
                        <div v-for="dish in orderData.dishes" :key="`dish-${dish.id}`" class="row mb-3">
                            <span class="d-flex align-items-center w-50">{{ dish.name }}</span>
                            <span class="d-flex align-items-center justify-content-end w-50">{{ dish.quantity }} x {{ dish.price }}€</span>
                        </div>
                        <div class="row mb-3">
                            <span class="d-flex align-items-center w-50">Totale</span>
                            <span class="d-flex align-items-center justify-content-end w-50">{{ orderData.amount }}€</span>
                        </div>
                        <div class="row mb-3">
                            <span class="my-3">
                                <i class="fa-solid fa-motorcycle"></i>
                                    Spedito in: {{ orderData.customer.customer_address }}
                            </span>
                            <span class="mb-3">
                                <i class="text-success fa-solid fa-circle-check"></i>
                                    Ordine inviato 
                            </span>
                        </div>
                    </div>
                </section>
                <section class="p-5 col-4">
                    <img class="mb-3" :src="orderData.restaurant.thumb" :alt="`Thumb ${orderData.restaurant.name}`">
                    <div>
                        <h2 class="mb-3">{{ orderData.restaurant.name }}</h2>
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            {{ orderData.restaurant.address }}
                        </span>
                    </div>
                </section>
            </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-booleat m-3" @click="removeOrderData">Home</button>
                </div>
        </div>
     <Loader v-else/>
    </div>
</template>

<script>
import Loader from '../components/Loader';
export default {
    name: 'OrderConfirmed',
    components: {
        Loader
    },
    data() {
        return {
            orderData: null,
        }
    },

    mounted() {
        if (localStorage.getItem('orderConfirmedData')) {
            try {
                this.orderData = JSON.parse(localStorage.getItem('orderConfirmedData'));
            } catch(e) {
                localStorage.removeItem('orderConfirmedData');
            }
        } else {
            this.$router.push({ name: 'home' });
        }

        localStorage.removeItem('orderConfirmedData');
    },

    methods: {
        removeOrderData() {
            this.$router.push({ name: 'home' });
        }
    }
}
</script>

<style lang="scss" scoped>
#order-confirmed{
    min-height:90vh;
}
.cart {
    max-width: 70%;
    margin: auto;
    background: #fff;
    border-radius: 15px;
    box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -webkit-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -moz-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -o-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    h1 {
        font-weight: bold;
        text-align: center;
    }
    img {
        max-width: 200px;
        border-radius: 20px;
    }

    .dish {
        width: 95%;
        margin: 0 auto;
        font-size: 14px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
        h5 {
            font-size: 1rem;
        }
    }

    li{
        list-style: none;
    }
    
}
</style>