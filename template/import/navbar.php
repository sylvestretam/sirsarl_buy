<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
  <img class=".animation_shake" src="template/dist/img/Eneo_logo.jpg" alt="Logo" />
</div> -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">SIGNATURE IMMO</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link"> <?= "TAM Sylvestre"//$_SESSION['noms']." ".$_SESSION['prenoms']  ?> </a>
    </li>

    <li class="nav-item">
      <a class="nav-link active"  role="button">
        <i><?= "" ?></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link"  href="./?action=logout" role="button">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li>

  </ul>
</nav>