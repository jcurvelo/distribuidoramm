function sortByProperty(property, isNumeric = false) {
  if (isNumeric == true) {
    return function (a, b) {
      if (parseInt(a[property]) > parseInt(b[property])) return 1;
      else if (parseInt(a[property]) < parseInt(b[property])) return -1;

      return 0;
    };
  } else {
    return function (a, b) {
      if (a[property] > b[property]) return 1;
      else if (a[property] < b[property]) return -1;

      return 0;
    };
  }
}

fetch("../db_to_json.php")
  .then((response) => response.json())
  .then((data) => {
    // console.log(data);
    // document.getElementById('loading').classList.replace('d-block','d-none');
    // document.getElementById('table').classList.remove('d-none');
    // document.getElementById('navTable').classList.remove('d-none');
    const autobus = new Vue();
    // console.log(data);
    const productTable = new Vue({
      el: "#productTable",
      data: {
        products: data.sort(sortByProperty("id_product", true)),
        startSlice: 0,
        endSlice: 5,
        totalInfo: false,
      },
      methods: {
        sortByCategory: function () {
          this.products = data.sort(sortByProperty("id_product", true));
        },
      },
      created() {
        autobus.$on("changePage", (data) => {
          this.startSlice = data.startSlice;
          this.endSlice = data.endSlice;
        });
      },
    });

    let pages = [];
    for (let i = 0; i < Math.ceil(data.length / 5); i++) {
      pages.push(i + 1);
    }

    const navTable = new Vue({
      el: "#navTable",
      data: {
        pages: pages,
      },
      methods: {
        changePage: function (number) {
          // console.log(this.pages);
          autobus.$emit("changePage", {
            startSlice: number * 5 - 5,
            endSlice: number * 5,
          });
        },
      },
    });

    const dashboard = new Vue({
      el: "#dashboard",
      data: {
        totalPedidos: data.length,
      },
    });
  });
