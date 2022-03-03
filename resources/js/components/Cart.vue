<template>
    <div id="cart" class="p-3 d-flex flex-column">
        <h2>
            Il tuo ordine
        </h2>
        <div class="order flex-grow-1 overflow-auto">
            <!-- DISH DETAIL  -->
             <div 
             class="dish d-flex justify-content-between p-2 align-items-center"
             v-for="dish in order"
             :key="dish.id"
             >

                <!-- DISH IMAGE  -->
                <div class="dish-img">
                    <img :src="dish.thumb" :alt="`thumb-${dish.name}`">
                </div>

                <!-- DISH INFO -->
                <div class="dish-info">
                    <h5>{{dish.name}}</h5>
                </div>

                <!-- SELECTED QUANTITY  -->
                <div class="quantity">
                    <span>{{dish.quantity}}</span>
                </div>

                <!-- PRICE  -->
                <div class="price">
                    <span>{{dish.price * dish.quantity}}€</span>
                </div>
                <!-- ACTIONS  -->
                <div class="cta">
                    <button class="btn"
                    @click="$emit('addMoreDish', dish)"
                    >
                        <i class="fa-solid fa-circle-plus"></i>
                    </button>
                    <button class="btn"
                    @click="subDishQuantity(dish)"
                    >
                        <i class="fa-solid fa-circle-minus"></i>
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
                <button class="btn btn-success mr-3">Conferma ordine</button>
                <button class="btn btn-danger"
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
            
            this.$emit('updateCart', []);
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

        }


    }
    

}
</script>

<style lang="scss" scoped>

#cart {
    max-height: 450px;
    h2 {
        font-weight: bold;
    }
    img {
        max-width: 100px;
        border-radius: 20px;
    }
    
}

</style>