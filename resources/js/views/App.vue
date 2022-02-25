<template>
    <div id="spa" class="d-flex justify-content-center align-items-center flex-grow-1">
        <h1>SPA da costruire</h1>
    </div>
</template>

<script>
export default {
    name: 'App'
}
</script>

<style lang="scss">
#spa {
    background-image: url('https://www.theromanpost.com/wp-content/uploads/2019/03/MOyarzabal-Terme-Saturnia-Italy.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    filter: brightness(.9);

    h1 {
        font-size: 5rem;
        flex-wrap: 700;
        color: white;
        text-shadow: 0 0 3px #aaa;
    }
}
</style>