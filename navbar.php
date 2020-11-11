<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <!-- <img src="/docs/4.5/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy"> -->
    Distribuidora MM
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="store.php"><i class="fas fa-shopping-basket"></i> Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php"><i class="fas fa-store"></i> Sobre Nosotros</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php"><i class="fas fa-mail-bulk"></i> Contáctanos</a>
      </li>
    </ul>
  </div>
  <button @click="pagar" id="shoppingbar" class="btn btn-warning boton-carrito">
        <i class="fas fa-shopping-cart"></i>
        {{ cart.length }}
      </button>
</nav>

<!-- <nav id="navigation-bar">
      <div id="topbar" class="topbar d-flex">
        <a href="index.php"><i class="fas fa-home"></i> Inicio</a>
        <a href="store.php"><i class="fas fa-shopping-basket"></i> Productos</a>
        <a href="about.php"><i class="fas fa-store"></i> Sobre Nosotros</a>
        <a href="contact.php"><i class="fas fa-mail-bulk"></i> Contáctanos</a>
        <div id="shoppingbar" class="spans d-flex flex-column align-self-end">
          <button class="btn btn-warning">
            <i class="fas fa-shopping-cart"></i>
            {{ items }}
          </button>

        </div>
      </div>
    </nav> -->