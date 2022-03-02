<template>
    <div id="home" class="container py-5">
        <Categories />
        <Restaurants />
    </div>
</template>

<script>
// Components
import Categories from '../components/Categories';
import Restaurants from '../components/Restaurants';

export default {
    name: 'Home',
    components: {
        Categories,
        Restaurants
    }
}
</script>

<style lang="scss" scoped>

</style>