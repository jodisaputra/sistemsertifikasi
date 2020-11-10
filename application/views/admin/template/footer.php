<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- Default to the left -->
  <strong>Copyright &copy; <?php echo date('Y') ?> <a href="">UIB</a></strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/backend/dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/js/summernote/summernote-bs4.js"></script>
<!-- Sweetalert -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/sweetalert/sweetalert2.all.min.js"></script>

<script>
  <?php
  // Validasi error, jika username atau password tidak cocok
  if (validation_errors() || $this->session->flashdata('message')) {
    if ($this->session->flashdata('tipe') == 'success') {
  ?>

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2800,
        timerProgressBar: true,
      })

      Toast.fire({
        icon: "<?php echo $this->session->flashdata('tipe'); ?>",
        title: "<?php echo $this->session->flashdata('message'); ?>"
      })
    <?php
    } else {
    ?>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2800,
        timerProgressBar: true,
      })

      Toast.fire({
        icon: "<?php echo $this->session->flashdata('tipe'); ?>",
        title: 'Oops...',
        title: "<?php echo $this->session->flashdata('message'); ?>"
      })

  <?php
    }
  }
  ?>
</script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>

</html>