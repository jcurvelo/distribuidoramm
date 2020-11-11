fetch("../db_to_json.php")
  .then((response) => response.json())
  .then((data) => {
    const displayProducts = new Vue({
      el: "#display-products",
      data: {
        products: data,
        isPicked: false
      },
    });
  });

