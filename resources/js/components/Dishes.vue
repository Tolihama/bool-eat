<template>
  <div class="container">
      <h2 class="title mt-4 mb-4">Menù</h2>
    <div class="dishes__container row" v-for="dish in dishes" :key= "`dish-${dish.id}`">
        <ul class="col-md-6 col-sm">
            <li>
                 <h3 class="dish__name">{{ dish.name }}</h3>
            </li>

            <li>
                <p class="dish__description">{{dish.description}}</p>
            </li>

            <li>
                <p class="dish__price">{{dish.price}} €</p>
            </li>
        </ul>
        <div class="col-md-6 d-flex justify-content-between align-items-center px-3">
            <div class="cta">
                <button class="btn" @click="$emit('addDish', dish)">
                    <i class="fa-solid fa-circle-plus"></i>
                </button>
            </div>
            <div class="img-container ">
                <img :src="dish.thumb" :alt="dish.name">
            </div>
        </div>
    </div>
  </div>
</template>

<script>


export default {
    name: 'Dishes',
    props: {
        dishes: Array,
    },

}
</script>

<style lang="scss" scope>
    .title {
        font-weight: bold;
    }
    .dishes__container{
        background: #fff;
        border: 0.5px solid lightgrey;
        border-radius: 10px;
        padding: 20px 8px;
        margin-bottom: 20px;
        background-color: #fcfcfb;
        align-items: center;
        cursor: pointer;
        // cursor: pointer;
        &:hover{
            background-color: #f7f7f7;
        }
        ul{
            list-style: none;
            display: flex;
            flex-direction: column;

            li{
                .dish__name{
                    font-weight: bold;
                    font-size: 28px;
                }

                .dish__description{
                    font-size: 15px;
                    color: #817978;
                }

                .dish__price {
                    font-size: 18px;
                    font-weight: bold;
                }

            }
        }
        .img-container{
            height: 120px;
            img{
                width: 150px;
                height: 100%;
                border: 1px solid #efedea;
                border-radius: 8px;
            }
        }
        i {
            font-size: 2rem;
        }
    }
</style>