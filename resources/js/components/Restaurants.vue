<template>
    <div>
        <router-link 
            :to="{
                name: 'restaurant',
                params: {
                    slug: restaurant.slug,
                }
            }"
            class="row mb-4 p-3 p-md-3 mx-2 restaurant"
            v-for="(restaurant, i) in list"
            :key="`restaurant${i}`"
        >
            <div class="restaurant-images col-12 mb-4 mb-md-0 col-md-6 d-flex justify-content-center justify-content-lg-start">
                <div class="cover flex-shrink-0">
                    <img
                        :src="restaurant.cover"
                        :alt="restaurant.name"
                    />
                    <div class="thumb">
                        <img
                            :src="restaurant.thumb"
                            :alt="restaurant.thumb"
                        />
                    </div>
                </div>
            </div>

            <div class="info d-flex flex-column justify-content-center col-12 text-center text-md-left col-md-6">
                <h5>{{ restaurant.name }}</h5>
                <span
                    class="mx-2"
                    v-for="(category, i) in restaurant.categories"
                    :key="`${restaurant.name}-category${i}`"
                >
                    {{ category.name }}
                </span>
            </div>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "Restaurants",
    props: {
        list: Array,
    },
};
</script>



<style lang="scss" scoped>
.cover {
    width: 200px;
    height: 150px;
    // border-radius: 20px;
    // overflow: hidden;
    position: relative;
}


.thumb {
    width: 100px;
    height: 75px;
    // border-radius: 20px;
    // overflow: hidden;
    position: absolute;
    top: 50%;
    right: -50px;
    transform: translateY(-50%);
}

img {
    height: 100%;
    width: 100%;
    border-radius: 20px;
    object-fit: cover;
    object-position: center;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
}

a {
    color: inherit;
    text-decoration: none;
}

.restaurant {
    border-radius: 20px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
    background: #fff;
    transition: all .3s ease-in-out;
    &:hover {
        background: #fd954b;
    }
}
</style>
