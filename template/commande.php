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
                  <li class="breadcrumb-item active">Commande</li>
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
                              <th> Date Emmission </th>
                              <th> Emmetteur </th>
                              <th> Fournisseur </th>
                              <th> Debours / Total </th>
                              <th> Commission </th>
                              <th> Total </th>
                              <th> Statut </th>
                              <th> ... </th>
                          </tr>
                      </thead>

                      <tbody class='fts'>
                        <?php
                          foreach ($commandes as $commande) {
                        ?>
                            <tr>
                              <td> <?= $commande->numero ?> </td>
                              <td> <?= $commande->date_emmission ?> </td>
                              <td> <?= $commande->emmetteur ?> </td>
                              <td> <?= $commande->fournisseur ?> </td>
                              <td> <?= $commande->debours ?> </td>
                              <td> <?= $commande->commission ?> </td>
                              <td> <?= $commande->debours + $commande->commission ?> </td>
                              <td> <?= $commande->statut ?> </td>
                              <td> 
                                <button class="btn btn-flat btn-outline-dark" onclick="showCommande('<?= $commande->numero ?>')"> <i class="fas fa-search"></i> </button>
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

                  <form action="./?action=commande&subaction=saveCommande" method="post">
                    <div class="card">
                    
                        <div class="card-body">

                            <div class="row">

                              <div class="form-group col-5">
                                  <label for=""> Numero BC </label>
                                  <input type="hidden" class="form-control" name="numero" value ="BC/SIRSARL/<?=date("Y")?>/<?=date("m")?>/<?=date("d")?>/0<?= sizeof($today_commandes)+1 ?>">
                                  <input type="text" class="form-control" name="numero" value ="BC/SIRSARL/<?=date("Y")?>/<?=date("m")?>/<?=date("d")?>/0<?= sizeof($today_commandes)+1 ?>" disabled>
                              </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-4">
                                    <label for=""> Date d'Emmision </label>
                                    <input type="date" class="form-control" name="date_emmission">
                                </div>

                                <div class="form-group col-4">
                                    <div class="form-group">
                                        <label> Fournisseur </label>
                                        <select class="form-control select2" style="width: 100%;" name="fournisseur">
                                            <option selected="selected" disabled>Choisir Un Fournisseur</option>
                                            <?php
                                                foreach ($fournisseurs as $fournisseur) {
                                            ?>
                                                <option value="<?= $fournisseur->code ?>"> <?= $fournisseur->code." - ".$fournisseur->denomination ?> </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-4">
                                    <div class="form-group">
                                        <label> Besoin </label>
                                        <select class="form-control select2 select2-dark" style="width: 100%;" name="besoin">
                                            <option selected="selected" disabled> Choisir le Besoin </option>

                                            <?php
                                              foreach ($fiches_besoins as $fiche) {
                                            ?>

                                              <option value="<?= $fiche->fiche_id ?>"> <?= $fiche->fiche_id ?></option>

                                            <?php
                                              }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row border border-danger">

                                <div class="form-group col-12 text-center">
                                    <label for=""> ITEMS </label>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Description </label>
                                    <input type="text" class="form-control" id="item">
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Quantite </label>
                                    <input type="number" class="form-control" id="quantite">
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> PU </label>
                                    <input type="number" class="form-control" id="pu">
                                </div>

                                <div class="form-group col-5 mx-auto">
                                    <button type="button" class="btn btn-block btn-dark btn-flat font-weight-bold" onclick="addItemCommande()"> <i class="fas fa-arrow-down"></i> AJOUTER </button>
                                </div>

                                <div class="form-group col-12">
                                    <input type="text" class="form-control itemcommande" disabled>
                                    <input type="hidden" class="form-control itemcommande" name="items">
                                </div>

                                <div class="col-12">

                                    <table class="table table-bordered table-stripper">

                                        <thead>
                                            <tr class="fts">
                                                <th> Item </th>
                                                <!-- <th> Description </th> -->
                                                <th> Qty </th>
                                                <th> P.U </th>
                                                <th> Total </th>
                                                <th> ... </th>
                                            </tr>
                                        </thead>

                                        <tbody class='fts ligneitemcommande'>
                                        
                                        </tbody>

                                    </table>

                                </div>
                                
                            </div>

                            <div class="row mt-2">

                                <div class="form-group col-6">
                                    <label for=""> Debours / Total HT </label>
                                    <input type="number" class="form-control" name="debours">
                                </div>

                                <div class="form-group col-6">
                                    <label for=""> Commission </label>
                                    <input type="number" class="form-control" name="commission">
                                </div>

                            </div>

                            <div class="row">

                              <div class="form-group col-4">
                                  <div class="form-group">
                                      <label> Monnaie </label>
                                      <select class="form-control select2" style="width: 100%;" name="monnaie">
                                          <option selected="selected" disabled>Choisir Une Monnaie</option>
                                          <option value="XAF">Franc CFA</option>
                                          <option value="USD">DOLLAR($)</option>
                                          <option value="EUR">EURO</option>
                                          <option value="DNR">DINAR</option>
                                      </select>
                                  </div>
                              </div>

                            </div>

                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-dark font-weight-bold"> <i class="fas fa-save"></i> ENREGISTRER </button>
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
                    <form action="./?action=commande&subaction=deleteCommande" method="post">
                      <input type="hidden" class="form-control numero" name="numero">
                      <button type="submit" class="btn btn-danger btn-flat btn-sm font-weight-bold"> <i class="fas fa-times"></i> SUPPRIMER </button>
                    </form>
                  </div>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-6">
                            <iframe src="bc.pdf" width="100%" height="600dvh" class="fichier"> </iframe>
                        </div>

                        <div class="col-6">

                            <form action="./?action=commande&subaction=updateCommande" method="post">
                              <input type="hidden" class="form-control numero" name="numero">
                                <div class="card">
                                
                                    <div class="card-body">

                                        <div class="row py-4">

                                            <div class="form-group col-4">
                                                <label for=""> Date d'Emmision </label>
                                                <input type="date" class="form-control date_emmission" disabled>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for=""> Fournisseur </label>
                                                <input type="text" class="form-control fournisseur" disabled>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for=""> Besoin </label>
                                                <input type="text" class="form-control besoin" disabled>
                                            </div>

                                        </div>

                                        <div class="row border">

                                          <table class="table table-bordered table-stripper">

                                            <thead>
                                                <tr class="fts">
                                                    <th> Item </th>
                                                    <th> Qty </th>
                                                    <th> P.U </th>
                                                    <th> Total </th>
                                                </tr>
                                            </thead>

                                            <tbody class='fts itemBonCommandes'>

                                            </tbody>

                                          </table>
                                            
                                        </div>

                                        <div class="row">

                                            <div class="form-group col-6">
                                                <label for=""> Debours </label>
                                                <input type="text" class="form-control debours" disabled>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for=""> Commission </label>
                                                <input type="text" class="form-control commission" disabled>
                                            </div>

                                        </div>

                                        <div class="row invisible">

                                          <div class="form-group col-6">
                                              <label for=""> STATUT </label>
                                              <input type="text" class="form-control statut" disabled>
                                          </div>

                                        </div>

                                        <div class="row py-4">

                                          <div class="form-group col-6 valign-wrapper">
                                            <div class="icheck-primary center d-inline">
                                              <input type="radio" name="statut" value="DRAFT" id="statut_draft" disabled>
                                              <label for="statut_draft"> DRAFT </label>
                                            </div>
                                          </div>

                                          <!-- <div class="form-group col-4 valign-wrapper">
                                            <div class="icheck-primary center d-inline">
                                              <input type="radio" name="statut" value="TRANSMIT" id="statut_transmit">
                                              <label for="statut_transmit"> TRANSMIT </label>
                                            </div>
                                          </div> -->

                                        </div>

                                        <div class="row py-4">

                                          <div class="form-group col-6 valign-wrapper">
                                            <div class="icheck-primary center d-inline">
                                              <input type="radio" name="statut" value="ABORT" id="statut_abort">
                                              <label for="statut_abort"> ABORT </label>
                                            </div>
                                          </div>

                                          <div class="form-group col-6">
                                            <label for=""> Date Abort </label>
                                            <input type="date" class="form-control date_abort" disabled>
                                          </div>

                                        </div>


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
      const commandes = <?= json_encode($commandes) ?>
    </script>
    
    <?php require('template/import/foot.php'); ?>

  </body>
</html>
