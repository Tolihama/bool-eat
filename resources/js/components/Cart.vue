<template>
    <div id="cart" class="p-3 d-flex flex-column">
        <h2>
            Il tuo ordine
        </h2>
        <div class="order flex-grow-1 overflow-auto">
            <!-- DISH DETAIL  -->
             <div class="dish d-flex justify-content-between p-2 align-items-center">

                <!-- DISH IMAGE  -->
                <div class="dish-img">
                    <img src="https://i0.wp.com/www.puntarellarossa.it/wp/wp-content/uploads/2018/12/Hot-dog-Fonzie.jpg?w=1000&ssl=1" alt="hot dog">
                </div>

                <!-- DISH INFO -->
                <div class="dish-info">
                    <h5>Nome piatto</h5>
                </div>

                <!-- SELECTED QUANTITY  -->
                <div class="quantity">
                    <span>3</span>
                </div>

                <!-- PRICE  -->
                <div class="price">
                    <span>prezzo€</span>
                </div>
                <!-- ACTIONS  -->
                <div class="cta">
                    <button class="btn">
                        <i class="fa-solid fa-circle-plus"></i>
                    </button>
                    <button class="btn">
                        <i class="fa-solid fa-circle-minus"></i>
                    </button>
                    <button class="btn">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>         
            </div>
           
        </div>
        <div class="cart-footer d-flex justify-content-around align-items-center p-3">
            <div class="order-detail">
                <h4>Totale: 44€</h4>
            </div>
            <div class="cta">
                <button class="btn btn-success mr-3">Conferma ordine</button>
                <button class="btn btn-danger">Svuota carrello</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cart',

}
</script>

<style lang="scss" scoped>

#cart {
    max-height: 450px;
    h2 {
        font-weight: bold;
    }
    img {
        max-width: 100px;
        border-radius: 20px;
    }
    
}

</style>