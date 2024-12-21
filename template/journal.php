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
                  <li class="breadcrumb-item active">JOURNAL</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <div class="content">
          
          <div class="container-fluid list_besoin">

            <div class="row">

              <div class="card col-12">

                <div class="card-header">

                  <div class="card-tools">
                    <button type="button" class="btn btn-dark btn-block btn-flat font-weight-bold" onclick="back('.list_besoin','.add_besoin')"> <i class="fas fa-plus"></i> AJOUTER </button>
                  </div>

                </div>

                <div class="card-body">

                    <table class="table table-bordered tableordered table-stripper">

                      <thead>
                          <tr class="fts">
                              <th> N° PJA </th>
                              <th> Date Facturation </th>
                              <th> N° Facture </th>
                              <th> Montant Total </th>
                              <th> Motif </th>
                              <th> Libelle </th>
                              <th> ... </th>
                          </tr>
                      </thead>

                      <tbody class='fts'>
                        <?php
                          foreach ($logs as $log) {
                        ?>

                          <tr>
                            <td> <?=  $log->numero_pja ?> </td>
                            <td> <?=  $log->date_facturation ?> </td>
                            <td> <?=  $log->facture ?> </td>
                            <td> <?=  $log->montant_total ?> </td>
                            <td> <?=  $log->motif ?> </td>
                            <td> <?=  $log->libelle ?> </td>
                            <td> 
                              <button class="btn btn-sm btn-secondary" onclick="showJournal('<?= $log->numero_pja ?>')"> <i class="fas fa-search"></i> </button>
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

          <div class="container add_besoin invisible">

            <div class="row">

              <div class="card col-12">

                <div class="card-header">

                  <button type="button" class="btn btn-dark btn-sm btn-flat font-weight-bold" onclick="back('.add_besoin','.list_besoin')"> <i class="fas fa-arrow-left"></i> RETOUR </button>

                </div>

                <div class="card-body">

                  <form action="./?action=journal&subaction=saveJournal" method="post">
                    <div class="card">
                    
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-4">
                                    <label> N° Facture </label>
                                    <select class="form-control select2" style="width: 100%;" name="facture" onchange="feedJournal(this)">
                                        <option selected="selected" disabled>Choisir Numero Facture</option>
                                        <?php
                                            foreach ($factures as $facture) {
                                        ?>
                                            <option value="<?= $facture->numero ?>"> <?= $facture->numero ?> </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Date Facturation </label>
                                    <input type="text" class="form-control date_facturation" name="date_facturation" disabled>
                                    <input type="hidden" class="form-control date_facturation" name="date_facturation">
                                    <!-- <input type="date" class="form-control" name="date_facturation" required> -->
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Fournisseur </label>
                                    <input type="text" class="form-control fournisseur" name="fournisseur" disabled>
                                    <input type="hidden" class="form-control fournisseur" name="fournisseur">
                                </div>

                                <div class="form-group col-8">
                                    <label for=""> Libelle </label>
                                    <input type="text" class="form-control libelle" name="libelle" disabled>
                                    <input type="hidden" class="form-control libelle" name="libelle">
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Montant Total </label>
                                    <input type="number" class="form-control montant_total" name="montant_total" disabled>
                                    <input type="hidden" class="form-control montant_total" name="montant_total">
                                </div>

                                
                                <div class="form-group col-12">
                                    <label for=""> Motif </label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="motif" required></textarea>
                                </div>

                                <div class="row border border-2 border-info">

                                    <div class="form-group col-12 text-center">
                                        <label for=""> ITEMS </label>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""> Compte </label>
                                        <select class="form-control select2" style="width: 100%;" id="compte">
                                          <option selected="selected" disabled>Choisir Un Compte</option>
                                          <?php
                                              foreach ($comptes as $compte) {
                                          ?>
                                              <option value="<?= $compte->numero ?>"> <?= $compte->numero."-".$compte->designation ?> </option>
                                          <?php
                                              }
                                          ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""> type </label>
                                        <select class="form-control select2" style="width: 100%;" id="type_operation">
                                          <option value="DEBIT"> DEBIT </option>
                                          <option value="CREDIT"> CREDIT </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""> Montant </label>
                                        <input type="number" class="form-control" id="montant">
                                    </div>

                                    <div class="form-group col-5 mx-auto">
                                        <button type="button" class="btn btn-block btn-dark btn-flat font-weight-bold" onclick="addItemJournal()"> <i class="fas fa-arrow-down"></i> AJOUTER </button>
                                    </div>

                                    <div class="form-group col-12">
                                        <input type="text" class="form-control itemjournal" disabled>
                                        <input type="hidden" class="form-control itemjournal" name="items">
                                    </div>

                                    <div class="col-12">

                                        <table class="table table-bordered table-stripper">

                                            <thead>
                                                <tr class="fts">
                                                    <th> Compte </th>
                                                    <th> Type </th>
                                                    <th> Montant </th>
                                                    <th> ... </th>
                                                </tr>
                                            </thead>

                                            <tbody class='fts ligneitemjournal'>
                                            
                                            </tbody>

                                        </table>

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

          <div class="container mod_besoin invisible">

            <div class="row">

              <div class="card col-12">

                <div class="card-header">

                  <button type="button" class="btn btn-dark btn-flat btn-sm font-weight-bold" onclick="back('.mod_besoin','.list_besoin')"> <i class="fas fa-arrow-left"></i> RETOUR </button>

                  <div class="card-tools">
                    <form action="./?action=journal&subaction=deleteJournal" method="post">
                      <input type="hidden" class="form-control numero_pja" name="numero_pja">
                      <button type="submit" class="btn btn-danger btn-sm btn-flat font-weight-bold"> <i class="fas fa-times"></i> SUPPRIMER </button>
                    </form>
                  </div>

                </div>

                <div class="card-body">

                    <form action="./?action=journal&subaction=updateJournal" method="post">
                      <input type="hidden" class="form-control numero_pja" name="numero_pja">
                      <div class="card">
                      
                          <div class="card-body">
                            <div class="row">

                                <div class="form-group col-4">
                                    <label> N° PJA </label>
                                    <input type="text" class="form-control facture" name="facture" disabled>
                                </div>

                                <div class="form-group col-4">
                                    <label> N° Facture </label>
                                    <input type="text" class="form-control facture" name="facture" disabled>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Date Facturation </label>
                                    <input type="date" class="form-control date_facturation" name="date_facturation" disabled>
                                </div>

                                <div class="form-group col-5">
                                    <label for=""> Code Fournisseur </label>
                                    <input type="text" class="form-control fournisseur" name="fournisseur" disabled>
                                </div>

                                <div class="form-group col-8">
                                    <label for=""> Libelle </label>
                                    <input type="text" class="form-control libelle" name="libelle" disabled>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Montant Total </label>
                                    <input type="number" class="form-control montant_total" name="montant_total" disabled>
                                </div>

                                
                                <div class="form-group col-12">
                                    <label for=""> Motif </label>
                                    <textarea class="form-control motif" rows="3" placeholder="Enter ..." name="motif" disabled></textarea>
                                </div>
                              </div>

                              <div class="row border border-2 border-info">

                                  <div class="col-12 text-center">
                                      <label for=""> ITEMS </label>
                                  </div>

                                  <div class="col-6 p-1">

                                      <div class="card card-primary">

                                        <div class="card-header">
                                          <h3 class="card-title"> DEBIT</h3>
                                        </div>

                                        <div class="card-body">
                                          <table class="table table-bordered table-stripper">

                                            <thead>
                                                <tr class="fts">
                                                    <th> Compte </th>
                                                    <th> Montant </th>
                                                </tr>
                                            </thead>

                                            <tbody class='fts ligneitemjournaldebit'>

                                            </tbody>

                                          </table>
                                        </div>
                                      </div>

                                  </div>

                                  <div class="col-6 p-1">

                                      <div class="card card-dark">

                                        <div class="card-header">
                                          <h3 class="card-title"> CREDIT </h3>
                                        </div>

                                        <div class="card-body">
                                          <table class="table table-bordered table-stripper">

                                            <thead>
                                                <tr class="fts">
                                                    <th> Compte </th>
                                                    <th> Montant </th>
                                                </tr>
                                            </thead>

                                            <tbody class='fts ligneitemjournalcredit'>

                                            </tbody>

                                          </table>
                                        </div>
                                      </div>

                                  </div>
                                  
                              </div>

                          </div>

                          <div class="card-footer text-center">MODIFIER </button>
                          </div>
                      </div>
                    </form>
                  
                </div>
                
              </div>

            </div>

          </div>

        </div>

      </div>

      <?php require('template/import/footer.php'); ?>

    </div>

    <script>
      const logs = <?= json_encode($logs) ?>;
      const factures = <?= json_encode($factures) ?>;
    </script>

    <?php require('template/import/foot.php'); ?>

  </body>
</html>
