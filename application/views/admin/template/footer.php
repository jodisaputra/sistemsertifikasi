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
  $('.uang').on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() {
      formatCurrency($(this), "blur");
    }
  });

  function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
  }

  function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
      return;
    }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(",") >= 0) {

      // // get position of first decimal
      // // this prevents multiple decimals from
      // // being entered
      // var decimal_pos = input_val.indexOf(",");

      // // split number by decimal point
      // var left_side = input_val.substring(0, decimal_pos);
      // var right_side = input_val.substring(decimal_pos);

      // // add commas to left side of number
      // left_side = formatNumber(left_side);

      // // validate right side
      // right_side = formatNumber(right_side);

      // // On blur make sure 2 numbers after decimal
      // if (blur === "blur") {
      //   right_side += "00";
      // }

      // // Limit decimal to only 2 digits
      // right_side = right_side.substring(0, 2);

      // // join number by .
      // input_val = "Rp " + left_side + "," + right_side;

    } else {
      // no decimal entered
      // add commas to number
      // remove all non-digits
      input_val = formatNumber(input_val);
      input_val = "Rp " + input_val;

    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
  }
</script>
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