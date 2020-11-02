let allProducts = [
    {
      nombre: "Alas de Pollo",
      precio: 45000,
      unidad: "1Kg",
      img: `background-image:url('./img/alas_de_pollo.png')`,
    },
    {
      nombre: "Lomo de Res",
      precio: 50000,
      unidad: "1Kg",
      img: `background-image:url('./img/lomo_de_res.jpeg')`,
    },
    {
      nombre: "Muslos de Pollo",
      precio: 30000,
      unidad: "1Kg",
      img: `background-image:url('./img/muslo_de_pollo.jpg')`,
    },
    {
      nombre: "Pernil de cerdo",
      precio: 45000,
      unidad: "1Kg",
      img: `background-image:url('./img/pernil.jpg')`,
    },
    {
      nombre: "Salchichas Oscar Mayer",
      precio: 55000,
      unidad: "1 Paquete",
      img: `background-image:url('./img/salchichas_oscar_mayer.jpg')`,
    },
    {
      nombre: "Bistec de Res",
      precio: 35000,
      unidad: "1Kg",
      img: `background-image:url('./img/bistec_de_res.jpg')`,
    },
  ]

const displayProducts = new Vue({
  el: "#display-products",
  data: {
    products: allProducts
  },
  methods:{
    buy: function(nombre){
        window.scrollBy(0,innerHeight*4);
        document.getElementById('producto_de_interes').value = nombre;
    }
}
});

const contact = new Vue({
    el: "#contact",
    data: {
      products: allProducts
    },
});

document.addEventListener("scroll", () => {
  if (window.scrollY > 100) {
    document.getElementById("nav_ul").classList.replace("d-none", "d-flex");
    document.getElementById("topbar").classList.replace("d-flex", "d-none");
    document.getElementById("navigation-bar").style.top = "40%";
  } else {
    document.getElementById("nav_ul").classList.replace("d-flex", "d-none");
    document.getElementById("topbar").classList.replace("d-none", "d-flex");
    document.getElementById("navigation-bar").style.top = "0px";
  }
});
