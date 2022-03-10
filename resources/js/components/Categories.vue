<template>
 <ul class="mb-5 p-0 d-flex flex-wrap">
   <li v-for="(category, i) in categoriesList" :key="`category-${i}`" @click="updateFilter(category.id, `category-${i}`)" :id="`category-${i}`"
    class="col-6 col-sm-4 col-md-3 col-lg-1 d-flex flex-column justify-content-center align-items-center p-2"
   >
    <div class="img-container mb-1 p-1">
     <img :src="category.thumb" :alt="category.name">
    </div>
     <div class="text-center category"><strong> {{category.name}} </strong></div>
   </li>
 </ul>
</template>
<script>

  export default {
    name: 'Categories',
    data() {
      return {
        filter:",",
      }
    },
    props:{
      categoriesList:Array,
    },
    methods:{
      updateFilter(category, key){
        var currentCategory=document.getElementById(key);
        // add and remove active class and generationg the filter string 
        if(!currentCategory.classList.contains("active")){
          this.filter+=category+",";
          currentCategory.classList.add("active");
        }else{
          // deleting form the filter string the id of the category surrounded by ,
          this.filter=this.filter.replaceAll(`,${category},`,',');
          currentCategory.classList.remove("active");
        }
        
        this.$emit('apiFilter',this.filter);
      }
    }
  };
</script>
<style lang="scss" scoped>

ul{
  list-style: none;
  li{
    // height: 150px;
    cursor: pointer;
    // padding: 1%;
    .img-container {
      width: 85px;
      height: 85px;
    }

    .category {
      font-size: 1rem;
      min-height: 50px;
    }
    
    img{
      height: 100%;
      width: 100%;
      border-radius: 50%;
      border: 3px solid #fff;
      transition: all 0.2s ease-in-out;
    }
    span{
      display: block;
      width: 100%;
      text-align: center;
      transition: all 0.2s ease-in-out;
    }
  }
  li:hover img{
      border:4px solid #f9700c;
      transform: translateY(-20%);
    }
    li:hover span{
      // color:#888;
      font-weight: 700;
    }
  li.active img{
      border:4px solid #f9700c;
      transform: translateY(-20%);
  }
   li.active span{
     font-weight: 700;
   }
}
</style>
