<template>
    <main id="vue-spa">
        <!-- <Alert /> -->
        <router-view></router-view>
    </main>
</template>

<script>

// import Alert from '../components/Alert';

export default {
    name: 'App',
    components: {
        // Alert
    }
}
</script>

<style lang="scss">
#vue-spa {
    display: flex;
    flex-grow: 1;
    background-image: linear-gradient(to top, #ffc9aa, #ffc9aa, #ffc9aa, #fff);
}
</style>