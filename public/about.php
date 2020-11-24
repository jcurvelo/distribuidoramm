<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require('../sharedHead.php');
  ?>
      <script src="./libraries/vue.js"></script>

</head>

<body>
  <?php
  require('../navbar.php');
  ?>
  <div class="container">
    <div class="content-area">
      <div class="container p-4">
        <div class="about-us">
          <div class="row">
            <div class="col-6">
              <div id="about_img_1"></div>
            </div>
            <div class="col-6 d-flex justify-content-center flex-column">
              <h3>Sobre Nosotros</h3><br><br>
              <p>
                Una Negocio familiar nacido entre una comunidad que nos vio crecer. Esta empresa ha conseguido desde su fundación, convertirse en un punto referente en la localidad de Ruiz Pineda, donde nuestros cliente tienen la seguridad de que pueden contar con nosotros para ofrecer calidad a buen precio
              </p>
            </div>
          </div>
          <br><br>
          <div class="row">
            <div class="col-6 d-flex justify-content-center flex-column">
              <h3>Nuestros Valores</h3><br><br>
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Consequuntur omnis labore in quos velit error culpa fugiat tempore
                ad, porro quasi sunt vero eius. Quos placeat incidunt aperiam
                corporis officiis. <br><br>

                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Consequuntur omnis labore in quos velit error culpa fugiat tempore
                ad, porro quasi sunt vero eius. Quos placeat incidunt aperiam
                corporis officiis.
              </p>
            </div>
            <div class="col-6">
              <div id="about_img_2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require('../footer.php');
  ?>
  <script>
    new Vue({
      el: "#shoppingbar",
      data: {
        cart: []
      },
      methods: {
        pagar: function() {
          bus.$emit('mostrarPagar', this.cart);
        }
      },
      created() {
        bus.$on("agregarProducto", (data) => {
          this.cart.push(data);
        });
        bus.$on("eliminarProducto", (data) => {
          for (const x in this.cart) {
            if (this.cart.hasOwnProperty(x)) {
              if (this.cart[x].id == data.id) {
                this.cart.splice(x, 1);
              }
            }
          }
        });
      },
    });
  </script>
</body>

</html>