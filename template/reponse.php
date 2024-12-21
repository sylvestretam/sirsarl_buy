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
                  <li class="breadcrumb-item active">CHOIX FSSE</li>
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
                              <th> Code Besoin </th>
                              <th> Code Fournisseur </th>
                              <th> Note Emmetteur </th>
                              <th> Note Finance </th>
                              <th> Moyenne </th>
                              <th> ... </th>
                          </tr>
                      </thead>

                      <tbody class='fts'>
                        <?php
                          foreach ($postulants as $postulant) {
                        ?>

                          <tr>
                            <td> <?=  $postulant->besoin ?> </td>
                            <td> <?=  $postulant->fournisseur ?> </td>
                            <td> <?=  $postulant->note_emmetteur ?> </td>
                            <td> <?=  $postulant->note_financier ?> </td>
                            <td> <?=  ($postulant->note_emmetteur + 1*$postulant->note_financier)/2 ?> </td>
                            <td> 
                              <button class="btn btn-sm btn-secondary" onclick="showPostulant('<?= $postulant->besoin ?>','<?= $postulant->fournisseur ?>')"> <i class="fas fa-search"></i> </button>
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

                  <form action="./?action=reponse&subaction=savePostulant" method="post"  enctype="multipart/form-data">
                    <div class="card">
                    
                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-6">
                                    <label> Besoin </label>
                                    <select class="form-control select2" style="width: 100%;" name="besoin">
                                        <option selected="selected" disabled>Choisir Un Besoin</option>
                                        <?php
                                            foreach ($fiches_besoins as $fiche) {
                                        ?>
                                            <option value="<?= $fiche->fiche_id ?>"> <?= $fiche->fiche_id ?> </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for=""> Fournisseur </label>
                                    <select class="form-control select2" style="width: 100%;" name="fournisseur">
                                        <option selected="selected" disabled>Choisir Un Fournisseur</option>
                                        <?php
                                            foreach ($fournisseurs as $fournisseur) {
                                        ?>
                                            <option value="<?= $fournisseur->code ?>"> <?= $fournisseur->code."-".$fournisseur->denomination ?> </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Note Emmetteur </label>
                                    <input type="number" class="form-control" name="note_emmetteur" required>
                                </div>

                                <div class="form-group col-8">
                                    <label for=""> Motivation Emmetteur </label>
                                    <input type="text" class="form-control" name="motivation_emmetteur" required>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Note Resp Financier </label>
                                    <input type="number" class="form-control" name="note_financier" required>
                                </div>

                                <div class="form-group col-8">
                                    <label for=""> Motivation Resp Financier </label>
                                    <input type="text" class="form-control" name="motivation_financier" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="exampleInputFile">Joindre l'Offre Technique</label>
                                    <input type="file" accept="application/pdf" class="btn btn-outline-info btn-block btn-flat" id="exampleInputFile" name="offre_technique" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="exampleInputFile">Joindre l'Offre Financière</label>
                                    <input type="file" accept="application/pdf" class="btn btn-outline-info btn-block btn-flat" id="exampleInputFile2" name="offre_financiere" required>
                                </div>

                                <div class="form-group col-4">
                                    <label for=""> Date </label>
                                    <input type="date" class="form-control" name="date_postulat" required>
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
                    <form action="./?action=reponse&subaction=deletePostulant" method="post">
                      <input type="hidden" class="form-control besoin" name="besoin">
                      <input type="hidden" class="form-control fournisseur" name="fournisseur">
                      <button type="submit" class="btn btn-danger btn-sm btn-flat font-weight-bold"> <i class="fas fa-times"></i> SUPPRIMER </button>
                    </form>
                  </div>

                </div>

                <div class="card-body">

                    <form action="./?action=reponse&subaction=updateNotePostulant" method="post"  enctype="multipart/form-data">
                        <input type="hidden" class="form-control besoin" name="besoin">
                        <input type="hidden" class="form-control fournisseur" name="fournisseur">
                        <div class="card">
                        
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-6">
                                        <label> Besoin </label>
                                        <input type="text" class="form-control besoin" name="besoin" disabled>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for=""> Fournisseur </label>
                                        <input type="text" class="form-control fournisseur" name="fournisseur" disabled>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""> Note Emmetteur </label>
                                        <input type="number" class="form-control note_emmetteur" name="note_emmetteur" required>
                                    </div>

                                    <div class="form-group col-8">
                                        <label for=""> Motivation Emmetteur </label>
                                        <input type="text" class="form-control motivation_emmetteur" name="motivation_emmetteur" required>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""> Note Resp Financier </label>
                                        <input type="number" class="form-control note_financier" name="note_financier" required>
                                    </div>

                                    <div class="form-group col-8">
                                        <label for=""> Motivation Resp Financier </label>
                                        <input type="text" class="form-control motivation_financier" name="motivation_financier" required>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputFile">Offre Technique</label>
                                        <a href="" target="_blank" class="btn border btn-sm btn-outline-secondary btn-block btn-flat offre_technique"> VOIR <i class="fas fa-arrow-right"></i> </a>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputFile">Offre Financière</label>
                                        <a href="" target="_blank" class="btn border btn-sm btn-outline-secondary btn-block btn-flat offre_financiere"> VOIR <i class="fas fa-arrow-right"></i> </a>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""> Date </label>
                                        <input type="date" class="form-control date_postulat" name="date_postulat" required>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-md btn-outline-warning btn-flat font-weight-bold"> <i class="fas fa-save"></i> MODIFIER </button>
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
      const postulants = <?= json_encode($postulants) ?>
    </script>

    <?php require('template/import/foot.php'); ?>

  </body>
</html>
