<template>
    <div id="home" class="container py-5">
        <!-- <Categories /> -->
        <Restaurants :list="restaurants"/>
    </div>
</template>

<script>
// Components
// import Categories from '../components/Categories';
import Restaurants from '../components/Restaurants';
import axios from 'axios';
export default {

    name: 'Home',
    components: {
        Restaurants,
        // Categories,
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
                    // console.log(this.restaurants);
                })
        }
    },
}
</script>

<style lang="scss" scoped>

</style>