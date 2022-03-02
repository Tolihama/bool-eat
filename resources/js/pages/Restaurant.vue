<template>
    <div class="w-100 d-flex flex-column">
        <div id="restaurant" v-if="restaurant">
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
                            class="category" 
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
                <Dishes />
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

export default {
    name: 'Restaurant',
    components: {
        Dishes,
        Loader,
    },
    data() {
        return {
            restaurant: null,
        }
    },
    created() {
        this.getRestaurant();
    },
    methods: {
        getRestaurant() {
            axios.get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`)
                .then(res => {
                    this.restaurant = res.data;
                })
                .catch(err => console.log(err));
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