<template>
    <div class="cart p-3 d-flex flex-column">
        <h2>
            Il tuo ordine
        </h2>
        <div class="order flex-grow-1 overflow-auto">
            <!-- DISH DETAIL  -->
             <div 
             class="dish row g-0 p-3 align-items-center"
             v-for="dish in order"
             :key="dish.id"
             >

                <!-- DISH IMAGE  -->
                <div class="dish-img d-none d-md-block col-2 p-1">
                    <img :src="dish.thumb" :alt="`thumb-${dish.name}`">
                </div>

                <!-- DISH INFO -->
                <div class="dish-info col-12 col-md-2 p-1">
                    <h5>{{dish.name}}</h5>
                </div>

                <!-- SELECTED QUANTITY  -->
                <div class="quantity col-4 col-md-2 offset-md-2 p-1">
                    <span>× {{dish.quantity}}</span>
                </div>

                <!-- PRICE  -->
                <div class="price col-4 col-md-2 p-1">
                    <span>{{dish.price * dish.quantity}}€</span>
                </div>
                <!-- ACTIONS  -->
                <div class="cta col-4 col-md-2 p-1">
                    
                    <button class="btn"
                    @click="subDishQuantity(dish)"
                    >
                        <i class="fa-solid fa-circle-minus"></i>
                    </button>
                    <button class="btn"
                    @click="$emit('addMoreDish', dish)"
                    >
                        <i class="fa-solid fa-circle-plus"></i>
                    </button>
                    <button class="btn"
                    @click="removeDishFromOrder(dish)"
                    >
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>         
            </div>
           
        </div>
        <div class="cart-footer d-flex justify-content-around align-items-center p-3">
            <div class="order-detail">
                <h4>Totale: {{priceSum}}€</h4>
            </div>
            <div class="cta">
<!--                 <button 
                    class="btn btn-success mr-3"
                    @click="$emit('confirmOrder')"
                >
                    Conferma ordine
                </button> -->
                <router-link
                    :to="{ name: 'checkout' }"
                    class="btn btn-success"
                >
                    Conferma ordine
                </router-link>
                <button 
                    class="btn btn-danger"
                    @click="emptyCart()"
                >
                    Svuota carrello
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cart',

    props: {
        order: Array,
    }, 

    computed: {
        priceSum() {
            let sum = 0;
            this.order.forEach(el => {
                sum += el.price * el.quantity;
            })

            return sum;
        }
    },

    methods: {
        emptyCart() {
            this.$emit('updateCart', null);
        },

        subDishQuantity(dish) {
            const updatedOrder = [...this.order];
            const selectedDish = updatedOrder.find(o => o.id === dish.id);
            const selectedDishIndex = updatedOrder.findIndex(o => o.id === dish.id);
            selectedDish.quantity -= 1;
            if (selectedDish.quantity === 0) {
                this.removeDishFromOrder(dish);
                return
            }
            updatedOrder[selectedDishIndex] = selectedDish;

            this.$emit('updateCart', updatedOrder) 
        },

        removeDishFromOrder(dish) {
            const updatedOrder = [...this.order];
            const selectedDishIndex = updatedOrder.findIndex(o => o.id === dish.id);

            updatedOrder.splice(selectedDishIndex, 1)

            this.$emit('updateCart', updatedOrder);
        },
    }
}
</script>

<style lang="scss" scoped>

.cart {
    border-radius: 15px;
    max-height: 450px;
    box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -webkit-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -moz-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    -o-box-shadow: inset 0px 1px 8px 3px #ABABAB,5px 5px 5px -100px #DDDDDD;
    h2 {
        font-weight: bold;
    }
    img {
        max-width: 100px;
        border-radius: 20px;
    }

    i {
        color: rgb(184, 17, 17);
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
    
}

</style>