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
                  <li class="breadcrumb-item active">Besoin</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        
        <div class="content">

          <div class="container-fluid invisible">
            
            <div class="row">

              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text"> Total </span>
                    <span class="info-box-number"> <?= $draft + $rejeter + $commander ?> </span>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text"> Draft </span>
                    <span class="info-box-number">
                      <?= $draft ?>
                    </span>
                  </div>
                </div>
              </div>
              
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-circle"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text"> Commandé </span>
                    <span class="info-box-number"> <?= $commander ?> </span>
                  </div>
                </div>
              </div>
                       
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-times"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text"> Rejeté </span>
                    <span class="info-box-number"><?= $rejeter ?> </span>
                  </div>
                </div>
              </div>
              
            </div>
            
          </div>

          <div class="container-fluid list_besoin">

            <div class="row">

              <div class="card col-12">

                <div class="card-header">

                  <div class="card-tools">
                    <button type="button" class="btn btn-dark btn-block font-weight-bold" onclick="back('.list_besoin','.add_besoin')"> <i class="fas fa-plus"></i> AJOUTER </button>
                  </div>

                </div>

                <div class="card-body">

                  <table class="table table-bordered tableordered table-stripper">

                      <thead>
                          <tr class="fts">
                              <th> Numero </th>
                              <th> Emmetteur </th>
                              <th> departement </th>
                              <th> Nature </th>
                              <th> Statut </th>
                              <th> ... </th>
                          </tr>
                      </thead>

                      <tbody class='fts'>
                        <?php
                          foreach ($fiches_besoins as $fiche) {
                        ?>

                          <tr>
                            <td> <?=  $fiche->fiche_id ?> </td>
                            <td> <?=  $fiche->emmetteur ?> </td>
                            <td> <?=  $fiche->departement ?> </td>
                            <td> <?=  $fiche->nature ?> </td>
                            <td> <?=  $fiche->statut ?> </td>
                            <td> 
                              <button class="btn btn-sm btn-secondary" onclick="showBesoin('<?= $fiche->fiche_id ?>')"> <i class="fas fa-search"></i> </button>
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

                  <form action="./?action=besoin&subaction=saveBesoin" method="post"  enctype="multipart/form-data">
                    <div class="card">
                    
                        <div class="card-body">
                          
                            <div class="row">

                              <div class="form-group col-4">
                                  <label for=""> Numero Fiche </label>
                                  <input type="hidden" class="form-control" name="numero" value = "FB/SIRSARL/<?=date("y")?>/<?=date("m")?>/<?=date("d")?>/0<?= sizeof($today_fiches_besoins)+1 ?>">
                                  <input type="text" class="form-control" name="numero" value = "FB/SIRSARL/<?=date("y")?>/<?=date("m")?>/<?=date("d")?>/0<?= sizeof($today_fiches_besoins)+1 ?>" disabled>
                              </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-4">
                                    <label for=""> Date </label>
                                    <input type="date" class="form-control" name="date_emmission" required>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Emmetteur </label>
                                    <select class="form-control select2" style="width: 100%;" name="emmetteur" required>
                                        <option selected="selected" disabled>Choisir Un Employé</option>
                                        <?php
                                            foreach ($employees as $employee) {
                                        ?>
                                            <option value="<?= $employee->matricule ?>"> <?= $employee->matricule." - ".$employee->noms." ".$employee->prenoms ?> </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Departement </label>
                                    <input type="text" class="form-control" name="departement" required>
                                </div>

                                <div class="form-group col-12">
                                    <label for=""> Nature </label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="nature" required></textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label for=""> Description </label>
                                    <textarea class="form-control" rows="6" placeholder="Enter ..." name="description" required></textarea>
                                </div>

                                <div class="form-group col-6">
                                    
                                    <!-- <div class="form-group">
                                        <label for="exampleInputFile">Joindre Un Ficher</label>
                                        <input type="file" accept="application/pdf" class="btn btn-outline-info btn-block btn-flat" id="exampleInputFile" name="fichier" required>
                                    </div> -->

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
                    <form action="./?action=besoin&subaction=deleteBesoin" method="post">
                      <input type="hidden" class="form-control fiche_id" name="fiche_id">
                      <button type="submit" class="btn btn-danger btn-sm btn-flat font-weight-bold"> <i class="fas fa-times"></i> SUPPRIMER </button>
                    </form>
                  </div>

                </div>

                <div class="card-body">

                  <form action="./?action=besoin&subaction=updateBesoin" method="post"  enctype="multipart/form-data">
                    <input type="hidden" class="form-control fiche_id" name="fiche_id">
                    <div class="card">
                    
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-6">
                                    <label for=""> Date </label>
                                    <input type="date" class="form-control date_emmission" name="date_emmission" required>
                                </div>

                                <div class="form-group col-12">
                                    <label for=""> Nature </label>
                                    <textarea class="form-control nature" rows="3" placeholder="Enter ..." name="nature" required></textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label for=""> Description </label>
                                    <textarea class="form-control description" rows="6" placeholder="Enter ..." name="description" required></textarea>
                                </div>

                                <div class="form-group col-6">
                                    <label for=""> STATUT </label>
                                    <input type="text" class="form-control statut" disabled>
                                </div>

                                <div class="form-group col-6 valign-wrapper">
                                  <div class="icheck-primary center d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" name="rejeter" class="rejeter">
                                    <label for="checkboxPrimary1"> REJETER </label>
                                  </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-outline-dark btn-flat font-weight-bold"> <i class="fas fa-save"></i> MODIFIER </button>
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
      const fiches_besoins = <?= json_encode($fiches_besoins) ?>
    </script>

    <?php require('template/import/foot.php'); ?>

  </body>
</html>
