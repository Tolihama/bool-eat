<template>
    <div>
        <router-link :to="{name: 'restaurant',
        params: {
            slug: restaurant.slug,
        }
        }"
            class="row mb-3"
            v-for="(restaurant, i) in list"
            :key="`restaurant${i}`"
        >
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <div class="restaurant-images">
                            <div class="cover">
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
                    </div>
                    <div class="col-6">
                        <div class="info">
                            <h5>{{ restaurant.name }}</h5>
                            <span
                                class="mx-2"
                                v-for="(category, i) in restaurant.categories"
                                :key="`${restaurant.name}-category${i}`"
                            >
                                {{ category.name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">altre info</div>
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
    top: 32.5px;
    right: -50px;
}

img {
    height: 100%;
    width: 100%;
    border-radius: 20px;
    object-fit: cover;
    object-position: center;
}
</style>
