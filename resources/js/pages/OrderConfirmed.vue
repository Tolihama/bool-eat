<template>
    <div class="container pt-4" id="order-confirmed">
     <div class="cart my-4 p-3">
        <h1 class="mb-4">L'ordine è stato effettuato con successo!</h1>
        <div class="p-2 d-flex">
            <section class="mr-3 col">
                <h3 class="text-center mb-3">Dettagli Ordine</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Numero Ordine</th>
                            <th scope="col">{{ orderData.transaction_id }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dish in orderData.dishes" :key="`dish-${dish.id}`">
                            <td>
                                {{ dish.name }}
                            </td>
                            <td>
                                {{ dish.quantity }} x {{ dish.price }}€ = {{ dish.quantity * parseFloat(dish.price) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Totale</h4>
                            </td>
                            <td>{{ orderData.amount }}€</td>
                        </tr>
                         <tr>
                            <td>Pagato con:</td>
                            <td>Carta</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="p-2 col">
                <img class="ml-4" :src="orderData.restaurant.thumb" :alt="`Thumb ${orderData.restaurant.name}`">
                <div class="ml-4">
                    <h2>{{ orderData.restaurant.name }}</h2>
                    <ul>
                        <li class="text-info">
                            <i class="fa-solid fa-phone"></i>
                            (placeholder)
                        </li>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            {{ orderData.restaurant.address }}
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <hr>
        <div class="user p-2 d-flex">
            <section>
                <div>
                    <ul>
                        <li class="mb-2">
                            <i class="text-success fa-solid fa-circle-check"></i>
                            Ordine inviato 
                        </li>
                        <li>
                            <i class="fa-solid fa-motorcycle"></i>
                            Domicilio
                            <ul>
                                <li>{{ orderData.customer.customer_address }}</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <div class="d-flex justify-content-end">
             <button class="btn btn-success m-3" @click="removeOrderData">Home</button>
        </div>
     </div>
  </div>
</template>

<script>
export default {
    name: 'OrderConfirmed',

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
.cart {
    width: 70%;
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