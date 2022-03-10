<template>
    <div id="restaurant" class="d-flex flex-column w-100">
        <Alert 
            v-if="alertVisible"
            @closeAlert="closeAlert"
            :link="activeRestaurantSlug"
            />
        <div v-if="restaurant">
<!--             <OrderCheckout
                v-if="orderConfirmed"
                :order="selectedDishes"
                @closeWindow="closeConfirmOrderWindow"
            /> -->
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
                    v-if="isActiveRestaurant && selectedDishes"
                    :order="selectedDishes"
                    @updateCart="updateCart"
                    @addMoreDish="addDishToOrder"
                    class="my-3"
                />
                
                <Dishes :dishes="dishes" @addDish="addDishToOrder"/>
            </div>
        </div>
        <Loader v-else />
    </div>
</template>

<script>
import axios from 'axios';

// Components
import Dishes from '../components/Dishes';
import Loader from '../components/Loader';
import Cart from '../components/Cart';
import OrderCheckout from '../components/OrderCheckout';
import Alert from '../components/Alert';

export default {
    name: 'Restaurant',

    components: {
        Dishes,
        Loader,
        Cart,
        OrderCheckout,
        Alert
    },

    data() {
        return {
            restaurant: null,
            dishes: null,
            selectedDishes: null,
            thereIsActiveRestaurant: false,
            isActiveRestaurant: false,
            alertVisible: false,
            activeRestaurantSlug: '',
        }
    },

    created() {
        this.getRestaurant();
        this.$watch(
        () => this.$route.params,
        () => {
            this.getRestaurant();
            this.alertVisible = false;
            this.isActiveRestaurant = true;
      }
    )
    },

    mounted() {
        if (localStorage.getItem('currentOrder')) {
            try {
                this.selectedDishes = JSON.parse(localStorage.getItem('currentOrder'));
            } catch(e) {
                localStorage.removeItem('currentOrder');
            }
        }

        const currentRestaurantOrder = JSON.parse(localStorage.getItem('currentRestaurantOrder'));

        this.activeRestaurantSlug = currentRestaurantOrder.restaurantSlug;
        this.thereIsActiveRestaurant = currentRestaurantOrder ? true : false;

        if (this.thereIsActiveRestaurant) {
            this.isActiveRestaurant = currentRestaurantOrder.restaurantSlug === this.$route.params.slug ? true : false;
        }

        
    },

    methods: {
        getRestaurant() {
            axios.get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`)
                .then(res => {
                    this.restaurant = res.data;
                    axios.get(`http://127.0.0.1:8000/api/${res.data.id}/dishes`)
                        .then( results => {
                            this.dishes = results.data;
                        })
                        .catch( err => console.error(err));
                })
                .catch(err => console.log(err));
        },

        addDishToOrder(dish) {
            if (this.selectedDishes && !this.isActiveRestaurant && this.thereIsActiveRestaurant) {
                this.alertVisible = true;
                return
            }

            if (this.selectedDishes) {
                const alreadySelected = this.selectedDishes.find(o => o.name === dish.name);

                if(this.selectedDishes.includes(alreadySelected)) {
                    this.selectedDishes = this.selectedDishes.slice();
                    alreadySelected.quantity += 1;
                } else {
                    dish.quantity = 1;
                    this.selectedDishes.push(dish);
                }
            } else {
                this.selectedDishes = [];
                dish.quantity = 1;
                this.selectedDishes.push(dish);
            }

            this.saveOrder();
        },

        updateCart(order) {
            if (order === null) {
                localStorage.removeItem('currentOrder');
                localStorage.removeItem('currentRestaurantOrder');
            }
            
            this.selectedDishes = order;

            this.saveOrder();
        },

        saveOrder() {
            localStorage.setItem('currentOrder', JSON.stringify(this.selectedDishes));
            localStorage.setItem('currentRestaurantOrder', JSON.stringify({
                restaurantName: this.restaurant.name,
                restaurantSlug: this.restaurant.slug,
                restaurantId: this.restaurant.id
            }));
            this.checkThereIsActiveRestaurant();
            this.checkIsActiveRestaurant();
        },

        checkThereIsActiveRestaurant() {
            this.thereIsActiveRestaurant = localStorage.getItem('currentRestaurantOrder') ? true : false;
        },

        checkIsActiveRestaurant() {
            if (this.thereIsActiveRestaurant) {
                const currentRestaurantOrder = JSON.parse(localStorage.getItem('currentRestaurantOrder'));
                this.isActiveRestaurant = currentRestaurantOrder.restaurantSlug === this.$route.params.slug;
            } else {
                this.isActiveRestaurant = false;
            }
        },

        closeAlert() {
            this.updateCart(null);
            this.alertVisible = false;

        }
    }
}
</script>

<style lang="scss" scoped>
#restaurant {
    .cover {
        display: flex;
        justify-content: center;
        height: 300px;
        overflow: hidden;
        position: relative;

        img {
            object-fit: cover;
            object-position: center;
        }
    }

    .info {
        background: #fff;
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