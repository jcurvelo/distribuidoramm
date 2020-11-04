const bus = new Vue();

fetch("../db_to_json.php")
  .then((response) => response.json())
  .then((data) => {
    const displayProducts = new Vue({
      el: "#display-products",
      data: {
        products: data,
        items: [],
      },
      mounted() {
        let arr = [{}];
        if (!localStorage.cartItems) {
          localStorage.setItem("carItems", JSON.stringify(arr));
          this.items = localStorage.cartItems;
        }
        console.log(this.items);
      },
      methods: {
        addItem: function (id) {
          this.items.push(id);
          // window.localStorage.setItem("cartItems", JSON.stringify(this.items));
          console.log(this.items);
          bus.$emit("actualizar", "yes");
        },
      },
    });
  });

const topbar = new Vue({
  el: "#shoppingbar",
  data: {
    items: 0,
  },
  mounted() {
    if (localStorage.cartItems) {
      this.items = JSON.parse(window.localStorage.getItem("cartItems")).length;
    }
  },
  created() {
    // this.items = this.cart.length;
    bus.$on("actualizar", (data) => {
      this.items = JSON.parse(window.localStorage.getItem("cartItems")).length;
    });
  },
});
