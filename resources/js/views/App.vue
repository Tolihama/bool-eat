<template>
    <main id="vue-spa">
        <router-view></router-view>
    </main>
</template>

<script>
export default {
    name: 'App'
}
</script>

<style lang="scss">
#vue-spa {
    display: flex;
    flex-grow: 1;
}
</style>