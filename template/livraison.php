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
                  <li class="breadcrumb-item active">Livraison</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <div class="content">

          <div class="container-fluid invisible">
            
            <div class="row">

              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text"> TOTAL </span>
                    <span class="info-box-number">
                      <?= $draft + $transmit + $abort ?>
                    </span>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text"> DRAFT </span>
                    <span class="info-box-number"> <?= $draft ?> </span>
                  </div>
                </div>
              </div>

              <div class="clearfix hidden-md-up"></div>

              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">TRANSMIT</span>
                    <span class="info-box-number"> <?= $transmit ?> </span>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-dark elevation-0"><i class="fas fa-times"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">ABORT</span>
                    <span class="info-box-number"><?= $abort ?> </span>
                  </div>
                </div>
              </div>
              
            </div>
            
          </div>

          <div class="container-fluid list_commande">

            <div class="row">

              <div class="card col-12">

                <div class="card-header">

                  <div class="card-tools">
                    <button type="button" class="btn btn-dark btn-block btn-flat font-weight-bold" onclick="back('.list_commande','.add_commande')"> <i class="fas fa-plus"></i> AJOUTER </button>
                  </div>

                </div>

                <div class="card-body">

                  <table class="table table-bordered tableordered table-stripper">

                      <thead>
                          <tr class="fts">
                              <th> Numero </th>
                              <th> Emmetteur </th>
                              <th> Date Livraison </th>
                              <th> Type Livraison </th>
                              <th> Statut</th>
                              <th> ... </th>
                          </tr>
                      </thead>

                      <tbody class='fts'>
                        <?php
                          foreach ($livraisons as $livraison) {
                        ?>
                            <tr>
                              <td> <?= $livraison->numero ?> </td>
                              <td> <?= $livraison->emmetteur ?> </td>
                              <td> <?= $livraison->date_livraison ?> </td>
                              <td> <?= $livraison->statut_commande ?> </td>
                              <td> <?= $livraison->statut_execution ?> </td>
                              <td> 
                                <button class="btn btn-flat btn-outline-dark" onclick="showLivraison('<?= $livraison->numero ?>')"> <i class="fas fa-search"></i> </button>
                              </td>
                            </tr>
                        <?php
                          }
                        ?>
                      </tbody>

                    </table>

                </div>
                
              </div>

            </div>

          </div>

          <div class="container add_commande invisible">

            <div class="row">

              <div class="card col-12">

                <div class="card-header">

                  <button type="button" class="btn btn-dark btn-flat font-weight-bold" onclick="back('.add_commande','.list_commande')"> <i class="fas fa-arrow-left"></i> RETOUR </button>

                </div>

                <div class="card-body">

                  <form action="./?action=livraison&subaction=saveLivraison" method="post" enctype="multipart/form-data">
                    <div class="card">
                    
                        <div class="card-body">

                            <div class="row">

                              <div class="form-group col-5">
                                  <label for=""> Numero BL</label>
                                  <input type="text" class="form-control" name="numero">
                              </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-4">
                                    <label for=""> Date de Livraison </label>
                                    <input type="date" class="form-control" name="date_livraison" required>
                                </div>

                                <div class="form-group col-4">
                                    <div class="form-group">
                                        <label> N° Bon de Commande </label>
                                        <select class="form-control select2" style="width: 100%;" name="bon_commande">
                                            <option selected="selected" disabled>Choisir Un Bon de commande</option>
                                            <?php
                                                foreach ($commandes as $commande) {
                                            ?>
                                                <option value="<?= $commande->numero ?>"> <?= $commande->numero ?> </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-4">

                                    <div class="form-group">
                                        <label> Type de Livraison </label>
                                        <select class="form-control select2" style="width: 100%;" name="statut_commande" required>
                                          <option value="COMPLETE"> COMPLETE </option>
                                          <option value="PARTIEL"> PARTIEL </option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="row border border-info">

                                <div class="form-group col-12 text-center">
                                    <label for=""> ITEMS </label>
                                </div>

                                <div class="form-group col-6">
                                    <label for=""> Description </label>
                                    <input type="text" class="form-control" id="item">
                                </div>

                                <div class="form-group col-6">
                                    <label for=""> Quantite </label>
                                    <input type="number" class="form-control" id="quantite">
                                </div>

                                <div class="form-group col-5 mx-auto">
                                    <button type="button" class="btn btn-block btn-dark btn-flat font-weight-bold" onclick="addItemLivraison()"> <i class="fas fa-arrow-down"></i> AJOUTER </button>
                                </div>

                                <div class="form-group col-12">
                                    <input type="text" class="form-control itemlivraison" disabled>
                                    <input type="hidden" class="form-control itemlivraison" name="items">
                                </div>

                                <div class="col-12">

                                    <table class="table table-bordered table-stripper">

                                        <thead>
                                            <tr class="fts">
                                                <th> Item </th>
                                                <!-- <th> Description </th> -->
                                                <th> Quantite </th>
                                                <th> ... </th>
                                            </tr>
                                        </thead>

                                        <tbody class='fts ligneitemlivraison'>
                                        
                                        </tbody>

                                    </table>

                                </div>
                                
                            </div>

                            <div class="row py-4">

                              <div class="form-group col-6">     
                                  <div class="form-group">
                                      <label for="file_bl">Joindre Le Fichier </label>
                                      <input type="file" accept="application/pdf" class="btn btn-outline-info btn-block btn-flat" id="file_bl" name="fichier" required>
                                  </div>
                              </div>

                            </div>

                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-dark btn-flat font-weight-bold"> <i class="fas fa-save"></i> ENREGISTRER </button>
                        </div>
                    </div>
                  </form>
                  
                </div>
                
              </div>

            </div>

          </div>

          <div class="container-fluid mod_commande invisible">

            <div class="row">

              <div class="card col-12">

                <div class="card-header">

                  <button type="button" class="btn btn-dark btn-flat font-weight-bold" onclick="back('.mod_commande','.list_commande')"> <i class="fas fa-arrow-left"></i> RETOUR </button>

                  <div class="card-tools">
                    <form action="./?action=livraison&subaction=deleteLivraison" method="post">
                      <input type="hidden" class="form-control numero" name="numero">
                      <button type="submit" class="btn btn-danger btn-flat btn-sm font-weight-bold"> <i class="fas fa-times"></i> SUPPRIMER </button>
                    </form>
                  </div>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-6">
                            <iframe src="bc.pdf" width="100%" height="500px" class="fichier"> </iframe>
                        </div>

                        <div class="col-6">

                            <form action="./?action=livraison&subaction=updateLivraison" method="post">
                              <input type="hidden" class="form-control numero" name="numero">
                                <div class="card">
                                
                                    <div class="card-body">

                                      <div class="row ">

                                        <div class="form-group col-4">
                                            <label for=""> Date Livraison </label>
                                            <input type="date" class="form-control date_livraison" disabled>
                                        </div>

                                        <div class="form-group col-4">
                                            <div class="form-group">
                                                <label> N° Bon de Commande </label>
                                                <input type="text" class="form-control bon_commande" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group col-4">

                                            <div class="form-group">
                                                <label> Type de Livraison </label>
                                                <input type="text" class="form-control statut_commande" disabled>
                                            </div>

                                        </div>

                                      </div>

                                      <div class="row border border-info my-3">

                                        <div class="form-group col-12 text-center">
                                            <label for=""> ITEMS </label>
                                        </div>

                                        <div class="col-12">

                                            <table class="table table-bordered table-stripper">

                                                <thead>
                                                    <tr class="fts">
                                                        <th> Item </th>
                                                        <!-- <th> Description </th> -->
                                                        <th> Quantite </th>
                                                    </tr>
                                                </thead>

                                                <tbody class='fts ligneitemlivraisonmod'>
                                                
                                                </tbody>

                                            </table>

                                        </div>

                                      </div>

                                      <div class="row my-3 py-2">

                                        <div class="form-group col-6 valign-wrapper">
                                          <div class="icheck-primary center d-inline">
                                            <input type="radio" name="statut" value="DRAFT" id="statut_draft" disabled>
                                            <label for="statut_draft"> DRAFT </label>
                                          </div>
                                        </div>

                                        <div class="form-group col-6 valign-wrapper">
                                          <div class="icheck-danger center d-inline">
                                            <input type="radio" name="statut" value="ABORT" id="statut_abort">
                                            <label for="statut_abort"> ABORT </label>
                                          </div>
                                        </div>

                                      </div>

                                      <!-- <div class="row my-3 py-2">

                                        <div class="form-group col-4 valign-wrapper">
                                          <div class="icheck-danger center d-inline">
                                            <input type="radio" name="statut" value="ABORT" id="statut_abort">
                                            <label for="statut_abort"> ABORT </label>
                                          </div>
                                        </div>

                                        <div class="form-group col-6">
                                          <label for=""> Date Abort </label>
                                          <input type="date" class="form-control statut">
                                        </div>

                                      </div> -->

                                    </div>

                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-md btn-dark btn-flat font-weight-bold"> <i class="fas fa-save"></i> MODIFIER </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        
                    </div>
                  
                </div>
                
              </div>

            </div>

          </div>

        </div>

      </div>

      <?php require('template/import/footer.php'); ?>

    </div>

    <script>
      const livraisons = <?= json_encode($livraisons) ?>
    </script>
    
    <?php require('template/import/foot.php'); ?>

  </body>
</html>
