
<template>
    <div>
        <div class="mb-4 ml-3" v-if="paginateData">
            <!-- first -->
            <button 
                class="btn btn-primary" 
                :disabled="paginateData.currentPage === 1"
                @click="firstPage" 
            >
                <i class="fa-solid fa-angles-left"></i>
            </button>

            <!-- prev -->
            <button 
                class="btn btn-primary" 
                :disabled="paginateData.currentPage === 1"
                @click="prev"
            >
                <i class="fa-solid fa-angle-left"></i>
            </button>

            <span class="btn btn-primary">
                {{paginateData.currentPage}}
            </span>

            <!-- Next -->
            <button 
                class="btn btn-primary" 
                :disabled="paginateData.currentPage === paginateData.lastPage"
                @click="next"
            >
                <i class="fa-solid fa-angle-right"></i>
            </button>
            
            <!-- last -->
            <button 
            class="btn btn-primary" 
            @click="lastPage"
            :disabled="paginateData.currentPage === paginateData.lastPage"
            
            >
                <i class="fa-solid fa-angles-right"></i>
            </button>

            <span>
                {{paginateData.total}} ristoranti aperti
            </span>
        </div>
        <Loader v-else/>
    </div>
</template>

<script>
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

        updateCurrentPage() {
            this.currentPage = this.paginateData.currentPage ;
        },

        firstPage() {
            this.updateCurrentPage();
            if(this.currentPage > 1) {
                this.currentPage = 1;
                this.$emit('currentPage', this.currentPage);
            }
        },

        prev() {
            this.updateCurrentPage();
            if(this.currentPage > 1){
                this.currentPage -= 1;
                this.$emit('currentPage', this.currentPage);
            }
        },

        next() {
            this.updateCurrentPage();
            if(this.currentPage < this.paginateData.lastPage){
                this.currentPage += 1;
                this.$emit('currentPage', this.currentPage);

            }
        },

        lastPage() {
            this.updateCurrentPage();
            if(this.currentPage < this.paginateData.lastPage){
                this.currentPage = this.paginateData.lastPage;
                this.$emit('currentPage', this.currentPage);

            }
        },


    }
}
</script>

<style lang="scss" scoped>

</style>