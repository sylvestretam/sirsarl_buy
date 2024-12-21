<div class="center row bg-white border border-warning text-center showProprietaire animation__transtop sect_error <?= showError($GLOBALS['error']) ?>">
  <div class="col-12 text-right p-3">
    <button type="button" class="btn btn-default btn-md"  onclick="back('.sect_error','')"> 
      <i class="fa fa-times" aria-hidden="true"></i>
    </button>
  </div>
  <div class="col-3">
    <i class="fas fa-exclamation-circle text-warning" style="font-size:100px"></i>
  </div>
  <div class="col-9 valign-wrapper">
    <span class="font-weight-bold">  </span>
    <span class="lead txt_message_error"> <?= (empty($GLOBALS['error']) ? "" : $GLOBALS['error']) ?> </span>
  </div>
</div>


<!-- function js -->
<script src="template/dist/js/function.js"></script>
<!-- jQuery -->
<script src="template/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="template/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="template/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="template/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="template/plugins/filterizr/jquery.filterizr.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<!-- Select2 -->
<script src="template/plugins/select2/js/select2.full.min.js"></script>

<script>
  $(function () {

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    // $("#example1").DataTable({
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });

    $('.tableordered').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });

  });
  
</script>

<!-- custum js -->
<script src="template/dist/js/commande.js"></script>
<script src="template/dist/js/livraison.js"></script>
<script src="template/dist/js/facture.js"></script>
<script src="template/dist/js/reponse.js"></script>
<script src="template/dist/js/besoin.js"></script>
<script src="template/dist/js/journal.js"></script>

</body>
</html>
