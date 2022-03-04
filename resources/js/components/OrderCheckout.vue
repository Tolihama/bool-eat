<template>
    <div class="transparent">
        <div class="box p-3">
            <div class="text-end">
                <button 
                    class="btn close-window"
                    @click="$emit('closeWindow')"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            
            <div 
                class="d-flex"
                v-for="dish in order"
                :key="`dish-${dish.id}`"
            >
                <div class="me-3">
                    {{ dish.name }}
                </div>
                <div class="me-3">
                    {{ dish.quantity }}
                </div>
                <div class="me-3">
                    {{ dish.price * dish.quantity }} €
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'OrderCheckout',
    props: {
        order: Array,
    }
}
</script>

<style lang="scss" scoped>
.transparent {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
    background: transparent;
    position: absolute;
    z-index: 2;

    .box {
        background: #fff;
        border: 2px solid red;
        width: 50%;
        height: 50%;
        position: relative;
        z-index: 3;

        .close-window {
            i {
                font-size: 3rem;
            }
        }
    }
}
</style>