<template>
    <div id="spa" class="d-flex justify-content-center align-items-center flex-grow-1">
        
        <Restaurants :list="restaurants"/>
    </div>
</template>

<script>

import Restaurants from './components/Restaurants.vue';
import axios from 'axios';
export default {
    name: 'App',
    components: {
        Restaurants,
    },
    data() {
        return {
            restaurants: [],
        }
    },
    created() {
        this.getRestaurants();
    },
    methods: {
        getRestaurants() {
            axios.get('http://127.0.0.1:8000/api/restaurants')
                .then(res => {
                    this.restaurants = res.data;
                    console.log(this.restaurants);
                })
        }
    },
}
</script>

<style lang="scss">
#spa {
    // background-image: url('https://www.theromanpost.com/wp-content/uploads/2019/03/MOyarzabal-Terme-Saturnia-Italy.jpg');
    // background-repeat: no-repeat;
    // background-size: cover;
    // filter: brightness(.9);

    h1 {
        font-size: 5rem;
        flex-wrap: 700;
        color: white;
        text-shadow: 0 0 3px #aaa;
    }
}
</style>