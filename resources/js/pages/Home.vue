<template>
    <div id="home" class="container py-5">
        <Categories @apiFilter="apiFilter" :categoriesList="categories" />
        <Restaurants :list="restaurants"/>
    </div>
</template>

<script>
// Components
import Categories from '../components/Categories';
import Restaurants from '../components/Restaurants';
import axios from 'axios';
export default {

    name: 'Home',
    components: {
        Restaurants,
        Categories,
    },
    data() {
        return {
            restaurants: [],
            categories: [],
        }
    },
    created() {

        this.getRestaurants();
        this.getCategories();
    },
    methods: {
        getRestaurants(page=1) {
            axios.get(`http://127.0.0.1:8000/api/restaurants?page=${page}`)
                .then(res => {
                    this.restaurants = res.data.data;    
                })
        },
        getCategories() {
            axios.get('http://127.0.0.1:8000/api/categories')
                .then(res => {
                    this.categories= res.data;  
                })
        },
        apiFilter(filter, page=1){
            if(filter===","){
                this.getRestaurants(page);
            }else{
                axios.get(`http://127.0.0.1:8000/api/restaurants/categories_filter/${filter}?page=${page}`)
                .then(res => {
                    this.restaurants = res.data.data;    
                })
            }   
        }
    },
}
</script>

<style lang="scss" scoped>

</style>