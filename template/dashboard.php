<?php require('template/import/head.php'); ?>

  <body class="hold-transition sidebar-mini">

    <div class="wrapper">

      <?php require('template/import/navbar.php'); ?>
      <?php require('template/import/aside.php'); ?>

      <div class="content-wrapper">

        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">ACHAT</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">dashboard</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <div class="content">

          

        </div>

      </div>

      <?php require('template/import/footer.php'); ?>

    </div>

    <script>
      const immobilisations = <?= json_encode($immobilisations) ?>
    </script>
    
    <?php require('template/import/foot.php'); ?>

  </body>
</html>
