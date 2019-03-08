 <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2019 <a href="#">College Admission</a>.</strong> All rights reserved.
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="inc/includes/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="inc/includes/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="inc/includes/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="inc/includes/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="inc/includes/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="inc/includes/dist/js/demo.js"></script>
<script src="inc/includes/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="inc/includes/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript">

    $(document).ready(function() {
        var url = window.location;
        var element = $('ul.navbar-nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');
        if (element.is('li')) {
             element.addClass('active').parent().parent('li').addClass('active')
         }
    });

</script>
</body>
</html>
