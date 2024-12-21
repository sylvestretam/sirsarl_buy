<?php require('template/import/head.php'); ?>
<body class=" pt-5">
<div class="error-page  pt-5">

    <h2 class="headline text-warning"> 
        <i class="fas fa-exclamation-triangle text-warning"></i>
    </h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! <?=$ERROR?>.</h3>

        <p>
            Vous pouvez <a  href="<?= $GLOBALS["PORTAL_PATH"] ?>">retourner au portail</a> ou contacter l'administrateur.
        </p>
    </div>
</div>
<!-- /.error-content -->

<?php require('template/import/foot.php'); ?>