<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Projects</b> System 1.0.0
        </div>
        <strong>Copyright &copy;<a href="https://www.itv-me.com">ITVME</a>.</strong> All rights
        reserved.
      </footer>
     
    <!-- ./wrapper -->
    
    <!-- jQuery 3 -->
    <script src="{{asset('dashboard/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('dashboard/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
   
    <script src="{{asset('dashboard/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('dashboard/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('dashboard/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('dashboard/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('dashboard/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- CK Editor -->
    <script src="{{asset('dashboard/bower_components/ckeditor/ckeditor.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('dashboard/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('dashboard/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('dashboard/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('dashboard/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('dashboard/dist/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('dashboard/dist/js/demo.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
     <!-- Morris.js charts -->
     <script src="{{asset('dashboard/bower_components/raphael/raphael.min.js')}}"></script>
     <script src="{{asset('dashboard/bower_components/morris.js/morris.min.js')}}"></script>
     <!-- Sparkline -->
     <script>
    $(function () {
      $('#example1').DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [0] } ],
        'searching'   : true,
        'scrollY'     : true,
        'scrollY'     : true,
        'paging'      : true,
        'lengthChange': true,
        'info'        : true,
        'autoWidth'   : true,
      })
      
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
    </body>
    </html>
    