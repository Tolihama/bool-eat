<template>
    <div id="checkout" class="d-flex flex-column w-100 py-5">
        <div class="container p-3" v-if="order">
            <div class="row">
                <section class="col-md-12 col-lg-6 px-2">
                    <div class="box py-3">
                        <h2 class="p-3">
                            Riepilogo ordine<span v-if="restaurantName"> da {{ restaurantName }}</span>
                        </h2>
                        <div 
                            class="dish row px-3"
                            v-for="dish in order"
                            :key="`dish-${dish.id}`"
                        >
                            <div class="col-6 py-1">
                                {{ dish.name }}
                            </div>
                            <div class="col-6 py-1">
                                {{ dish.quantity }} x {{ dish.price }}€ = {{ dish.price * dish.quantity }}€
                            </div>
                        </div>
                        <div class="total row px-3 fw-bold">
                            <div class="col-6 offset-6 py-1 fw-bold">
                                Totale: {{ totalOrder }}€
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-md-12 col-lg-6 px-2">
                    <div class="box py-3">
                        <h2 class="p-3">Dati del cliente</h2>
                        <form action="" class="px-3">
                            <label for="customer_name">Nome cliente</label>
                            <input 
                                type="text" 
                                id="customer_name" 
                                name="customer_name" 
                                class="form-control"
                                required 
                                maxlength="50"
                            >

                            <label for="customer_address">Indirizzo di consegna</label>
                            <input 
                                type="text" 
                                id="customer_address"
                                name="customer_address" 
                                class="form-control"
                                required 
                                maxlength="150"
                             >

                            <label for="customer_phone">Riferimento telefonico</label>
                            <input 
                                type="text" 
                                id="customer_phone" 
                                name="customer_phone" 
                                class="form-control"
                                required 
                                maxlength="255"
                            >

                            <label for="customer_email">Email</label>
                            <input 
                                type="email" 
                                id="customer_email" 
                                name="customer_email" 
                                class="form-control"
                                required
                                maxlength="255"
                            >

                            <label for="notes">Informazioni aggiuntive da comunicare al ristorante</label>
                            <input 
                                type="text" 
                                id="notes" 
                                name="notes" 
                                class="form-control"
                            >

                            <!-- Carta di credito -->
                            <h2 class="pt-3">Dati carta di credito</h2>

                            <!-- Credit card number -->
                            <label for="card_number">Numero di carta</label>
                            <input 
                                type="number" 
                                id="card_number" 
                                name="card_number" 
                                class="form-control"
                            >

                            <!-- Credit card expiry -->
                            <label for="expiry">Scadenza</label>
                            <input 
                                type="text" 
                                id="expiry" 
                                name="expiry" 
                                class="form-control"
                            >

                            <div class="text-center py-3">
                                <button type="submit" class="btn btn-success">
                                    Autorizza ordine e pagamento
                                </button>
                            </div>

                        </form>
                    </div>
                </section>
            </div>
        </div>

        <Loader v-else />
    </div>
</template>

<script>
// Components
import Loader from '../components/Loader';

export default {
    name: 'Checkout',

    components: {
        Loader
    },

    data() {
        return {
            order: null,
            restaurantName: null,
        }
    },

    computed: {
        totalOrder() {
            let total = 0;
            this.order.forEach(dish => {
                total += parseFloat(dish.price) * dish.quantity;
            });
            return total;
        }
    },

    mounted() {
        if (localStorage.getItem('currentOrder')) {
            try {
                this.order = JSON.parse(localStorage.getItem('currentOrder'));
            } catch(e) {
                localStorage.removeItem('currentOrder');
            }
        }

        if (localStorage.getItem('currentRestaurantOrder')) {
            try {
                this.restaurantName = JSON.parse(localStorage.getItem('currentRestaurantOrder')).restaurantName;
            } catch(e) {
                localStorage.removeItem('currentRestaurantOrder');
            }
        }
    }
}
</script>

<style lang="scss" scoped>
#checkout > .container section .box {
    border-radius: 20px;
    box-shadow: 0 0 5px 1px #ccc;
}
</style>