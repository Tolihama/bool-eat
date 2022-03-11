
<template>
    <div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center w-100 paginate-ctn" v-if="paginateData">
                <!-- first -->
                <button 
                    class="btn-paginate" 
                    :class="{'disabled-paginate' : paginateData.currentPage === 1}"
                    @click="firstPage" 
                >
                    <i class="fa-solid fa-angles-left"></i>
                </button>

                <!-- prev -->
                <button 
                    class="btn-paginate" 
                    :class="{'disabled-paginate' : paginateData.currentPage === 1}"
                    @click="prev"
                >
                    <i class="fa-solid fa-angle-left"></i>
                </button>

                <span class="paginate-number d-none d-md-block btn-paginate">
                    {{paginateData.currentPage}}
                </span>

                <!-- Next -->
                <button 
                    class="btn-paginate" 
                    :class="{ 'disabled-paginate' : paginateData.currentPage === paginateData.lastPage}"
                    @click="next"
                >
                    <i class="fa-solid fa-angle-right"></i>
                </button>
                
                <!-- last -->
                <button 
                class="btn-paginate" 
                @click="lastPage"
                :class="{ 'disabled-paginate' : paginateData.currentPage === paginateData.lastPage}"
                >
                    <i class="fa-solid fa-angles-right"></i>
                </button>

                <div class="total-restaurant flex-grow-1 text-end d-none d-sm-block">
                    Ristoranti aperti:
                    <strong class="total-number">
                        {{paginateData.total}}
                    </strong>
                </div>
            </div>
            <Loader v-else/>
        </div>
    </div>
</template>

<script>
// Components
import Loader from './Loader';

export default {
    name: 'Paginate',

    components: {
        Loader,
    },

    props: {
        paginateData: Object,
    },

    data() {
        return {
            currentPage: 1,
        }
    },

    methods: {
        firstPage() {
            this.currentPage = this.paginateData.currentPage;
            if(this.currentPage > 1) {
                this.currentPage = 1;
                this.$emit('currentPage', this.currentPage);
            }
        },

        prev() {
            this.currentPage = this.paginateData.currentPage;
            if(this.currentPage > 1){
                this.currentPage -= 1;
                this.$emit('currentPage', this.currentPage);
            }
        },

        next() {
            this.currentPage = this.paginateData.currentPage;
            if(this.currentPage < this.paginateData.lastPage){
                this.currentPage += 1;
                this.$emit('currentPage', this.currentPage);

            }
        },

        lastPage() {
            this.currentPage = this.paginateData.currentPage;
            if(this.currentPage < this.paginateData.lastPage){
                this.currentPage = this.paginateData.lastPage;
                this.$emit('currentPage', this.currentPage);

            }
        },
    }
}
</script>

<style lang="scss" scoped>
    .paginate-ctn{
        padding: 20px 40px;
    }

    .btn-paginate {
        background-color: #f5f3f1;
        border: 0;
        border-radius: 50rem;
        box-shadow: 0 2px 4px -1px rgba(0,0,0,.06),0 1px 10px 1px rgba(0,0,0,.07),0 4px 5px 0 rgba(0,0,0,.03);
        padding: 18px;
        top: 50%;
        margin-right: 10px;
        cursor: pointer;
        &:hover {
            background-color: #f9700b;
            i {
                color: #ffff;
            }
        }

        i {
            color: #f9700b;
            font-size: 20px
        }
    }

    .disabled-paginate{
       opacity: 0.7;
       pointer-events:none;
       background: #ebe9e7;
       i{
           color: #ca7509;
       }
    }

    .paginate-number {
        color: #ec6909;
        font-weight: 900;
        cursor: default;
        &:hover {
            color: #fff;
        }
    }

    .total-restaurant {
        font-size: 18px;
        .total-number {
            color: #ec6909;
        }
    }

    @media screen and (max-width: 579px){
        .paginate-ctn{
            padding: 20px 0px;
            justify-content: center;
        }
    }

</style>