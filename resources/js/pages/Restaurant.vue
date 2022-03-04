<template>
    <div class="w-100 d-flex flex-column">
        <div id="restaurant" v-if="restaurant">
            <OrderCheckout
                v-if="orderConfirmed"
                :order="selectedDishes"
                @closeWindow="closeConfirmOrderWindow"
            />
            <div class="cover">
                <img :src="restaurant.cover" :alt="`Cover ${restaurant.name}`">
            </div>
            <div class="container">
                <div class="info">
                    <div class="thumb">
                        <img :src="restaurant.thumb" :alt="`Thumb ${restaurant.name}`">
                    </div>
                    <div class="name">
                        <h1>{{ restaurant.name }}</h1>
                    </div>
                    <div class="categories py-3">
                        <span 
                            class="category mr-1" 
                            v-for="category in restaurant.categories"
                            :key="`${category.id}`"
                        >
                            {{ category.name }}
                        </span>
                    </div>
                    <div class="address">
                        <h2>{{ restaurant.address }}</h2>
                    </div>
                </div>
                <Cart 
                    v-if="checkRestaurantOrder && selectedDishes.length > 0"
                    :order="selectedDishes" 
                    @updateCart="updateCart"
                    @addMoreDish="addDishToOrder"
                    @confirmOrder="openConfirmOrderWindow"
                    class="my-3"
                />
                <Dishes :dishes="dishes" @addDish="addDishToOrder"/>
            </div>
        </div>
        <Loader v-else class="flex-grow-1 d-flex justify-content-center align-items-center" />
    </div>
</template>

<script>
import axios from 'axios';

// Components
import Dishes from '../components/Dishes';
import Loader from '../components/Loader';
import Cart from '../components/Cart';
import OrderCheckout from '../components/OrderCheckout';

export default {
    name: 'Restaurant',
    components: {
        Dishes,
        Loader,
        Cart,
        OrderCheckout
    },
    data() {
        return {
            restaurant: [],
            dishes: [],
            selectedDishes: [],
            orderConfirmed: false,
        }
    },
    created() {
        this.getRestaurant();
    },

    computed: {
        checkRestaurantOrder() {
             return this.selectedDishes.find(o => o.id === this.restaurant.id);
        }
    },

    mounted() {
        if (localStorage.getItem('selectedDishes')) {
            try {
            this.selectedDishes = JSON.parse(localStorage.getItem('selectedDishes'));
        } catch(e) {
            localStorage.removeItem('selectedDishes');
        }
    }
  },

    methods:{
        
        getRestaurant() {
            axios.get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`)
                .then(res => {
                    this.restaurant = res.data;
                    axios.get(`http://127.0.0.1:8000/api/${res.data.id}/dishes`)
                        .then( results => {
                            // console.log(results.data);
                            this.dishes = results.data;
                        })
                        .catch( err => console.error(err));
                })
                .catch(err => console.log(err));
            
        },
        updateCart(order) {
            
            this.selectedDishes = order;

            if(order.length === 0) {
                localStorage.removeItem('selectedDishes');
            } else {
                this.saveOrder();
            }
        },

        addDishToOrder(dish) {

            if(this.selectedDishes.length > 0 && !this.checkRestaurantOrder) {
                return alert('Puoi ordinare da un solo ristorante alla volta');
            }

            let alreadySelected = this.selectedDishes.find(o => o.name === dish.name);

            if(this.selectedDishes.includes(alreadySelected)) {
                this.selectedDishes = this.selectedDishes.slice();
                alreadySelected.quantity += 1;
            } else {
                dish.quantity = 1;
                this.selectedDishes.push(dish);
            }

            this.saveOrder();

            // console.log(this.selectedDishes);
        },

        saveOrder() {
            const parsed = JSON.stringify(this.selectedDishes);
            localStorage.setItem('selectedDishes', parsed);
        },

        openConfirmOrderWindow() {
            this.orderConfirmed = true;
        },

        closeConfirmOrderWindow() {
            this.orderConfirmed = false;
        }
    }
}
</script>

<style lang="scss" scoped>
#restaurant {
    position: relative;
    max-height: calc(100vh - 55px);
    overflow: auto;

    .cover {
        display: flex;
        justify-content: center;
        height: 300px;
        overflow: hidden;

        img {
            object-fit: cover;
            object-position: center;
        }
    }

    .info {
        box-shadow: 0 0 5px 1px #ccc;
        border-radius: 20px;
        padding: 70px 35px 35px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;

        .thumb {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border-radius: 10px;
            box-shadow: 0 0 3px 1px #ccc;
            overflow: hidden;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
            }
        }

        .categories {
            .category {
                padding: .2rem .5rem;
                border-radius: 100rem;
                background-color: aqua;
            }
        }
    }
}
</style>