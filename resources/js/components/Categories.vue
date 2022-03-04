<template>
 <ul class="mb-5 d-flex">
   <li v-for="(category, i) in categoriesList" :key="`category-${i}`" @click="updateFilter(category.id, `category-${i}`)" :id="`category-${i}`">
     <img :src="category.thumb" :alt="category.name">
     <span>{{category.name}}</span>
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
    width: calc(100%/11);
    height:width;
    padding: 1%;
    
    img{
      height: 100%;
      width: 100%;
      border-radius: 50%;
      border: 4px solid transparent;
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
      border:4px solid #888;
      transform: translateY(-20%);
    }
    li:hover span{
      // color:#888;
      font-weight: 700;
    }
  li.active img{
      border:4px solid #888;
      transform: translateY(-20%);
  }
   li.active span{
     font-weight: 700;
   }
}
</style>
