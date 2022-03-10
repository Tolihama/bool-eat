<template>
    <div id="home">
        <div class="container d-flex flex-column justify-content-center py-5">
            <Categories @apiFilter="updateFilter" :categoriesList="categories" />
            <Paginate :paginateData="paginateData" @currentPage="updateCurrentPage"/>
            <Restaurants :list="restaurants"/>
        </div>
        <PaymentConfirmed v-if="paymentSuccess" @closeAlert="closePaymentConfirmed" />
    </div>
</template>

<script>
// Components
import Categories from '../components/Categories';
import Restaurants from '../components/Restaurants';
import Paginate from '../components/Paginate';
import PaymentConfirmed from '../components/PaymentConfirmed';
import axios from 'axios';
export default {

    name: 'Home',
    components: {
        Restaurants,
        Categories,
        Paginate,
        PaymentConfirmed,
    },
    data() {
        return {
            restaurants: [],
            categories: [],
            paginateData: null,
            currentPage: 1,
            filter: ",",
            paymentSuccess: true,
        }
    },
    created() {

        this.getRestaurants();
        this.getCategories();
    },
    methods: {
        getRestaurants(page = 1) {
            axios.get(`http://127.0.0.1:8000/api/restaurants?page=${page}`)
                .then(res => {
                    this.restaurants = res.data.data;
                    this.paginateData = {
                        lastPage: res.data.last_page,
                        total: res.data.total,
                        currentPage: res.data.current_page,
                    };
                })
        },

        getCategories() {
            axios.get('http://127.0.0.1:8000/api/categories')
                .then(res => {
                    this.categories= res.data;
                })
        },

        apiFilter(filter = ",", page = 1){
            if(filter === ","){
                this.getRestaurants(page);
            }
            else {
                axios.get(`http://127.0.0.1:8000/api/restaurants/categories_filter/${filter}?page=${page}`)
                .then(res => {
                    this.restaurants = res.data.data;
                    this.paginateData = {
                        lastPage: res.data.last_page,
                        total: res.data.total,
                        currentPage: res.data.current_page,
                    };
                })
            }
        },

        updateCurrentPage(currentPage) {
            this.currentPage = currentPage;
            this.apiFilter(this.filter, currentPage);
        },

        updateFilter(filter) {
            this.currentPage = 1;
            this.filter = filter;
            this.apiFilter(filter, this.currentPage);
        },

        closePaymentConfirmed(){
            this.paymentSuccess = false
        },
    },
}
</script>

<style lang="scss" scoped>
    #home{
        position: relative;
        width: 100%;
    }
</style>