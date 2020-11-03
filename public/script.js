const bus = new Vue();

fetch('../db_to_json.php')
.then(response=>response.json())
.then((data)=>{
  const displayProducts = new Vue({
    el: "#display-products",
    data: {
      products: data
    },
    methods:{
      addItem: function(){
        bus.$emit('actualizar','yes');
      }
    },
  });

});


const topbar = new Vue({
  el: "#shoppingbar",
  data:{
    items: 0,
  },
  created(){
    bus.$on('actualizar',(data)=>{
      this.items += 1;
    })
  }
  
})



// const contact = new Vue({
//     el: "#contact",
//     data: {
//       products: allProducts
//     },
// });
