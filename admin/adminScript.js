fetch("../db_to_json.php")
  .then((response) => response.json())
  .then((data) => {
    // document.getElementById('loading').classList.replace('d-block','d-none');
    // document.getElementById('table').classList.remove('d-none');
    // document.getElementById('navTable').classList.remove('d-none');
    const autobus = new Vue();
    // console.log(data);
    const productTable = new Vue({
      el: "#productTable",
      data: {
        products: data,
        startSlice: 0,
        endSlice: 5
      },

      created(){
        autobus.$on('changePage',(data)=>{
          this.startSlice = data.startSlice;
          this.endSlice = data.endSlice;
        })
      }
    });
    
    let pages = [];
    for(let i=0;i<Math.ceil(data.length / 5);i++){
      pages.push(i+1);
    }
    
    const navTable = new Vue({
      el: '#navTable',
      data:{
        pages: pages
      },
      methods:{
        changePage: function(number){
          // console.log(this.pages);
          autobus.$emit('changePage',{startSlice: (number*5)-5,endSlice:number*5});
        }
      }
    });

    const dashboard = new Vue({
      el: "#dashboard",
      data:{
        totalPedidos: data.length
      }
    });

  });


