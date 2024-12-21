<?php
  function active_nav_link($nav_link)
  {
      if( !empty($_REQUEST['action']))
          if($_REQUEST['action'] == $nav_link)
              return 'active';
  }

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <div class="pb-2 w-100 text-center text-white">
    <a href="" class="w-100">
      <img src="template\dist\img\logosisas.jpg" alt="Logo" class="brand-image elevation-3" style="width: 100%; opacity: .8">
    </a>
    <span class="brand-text display-4"> ACHAT </span>
  </div>
  <div class="divider"></div>

  <div class="sidebar">

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="?action=dashboard" class="nav-link btn_nav_link <?= active_nav_link("dashboard") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              DASHBOARD
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=besoin" class="nav-link btn_nav_link <?= active_nav_link("besoin") ?> invisible">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              BESOIN
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=reponse" class="nav-link btn_nav_link <?= active_nav_link("reponse") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              CHOIX FSSE
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=commande" class="nav-link btn_nav_link <?= active_nav_link("commande") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              COMMANDE
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=livraison" class="nav-link btn_nav_link <?= active_nav_link("livraison") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              LIVRAISON
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=facture" class="nav-link btn_nav_link <?= active_nav_link("facture") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              FACTURE
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=journal" class="nav-link btn_nav_link <?= active_nav_link("journal") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              JOURNAL
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
  </div>
</aside>