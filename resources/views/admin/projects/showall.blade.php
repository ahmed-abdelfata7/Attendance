@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
       
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          All Projects
            <small>Report</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports</li>
          </ol>
        </section>
        <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Reports </h3>
            </div>
            <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                                  <thead >
                                      <tr>
                                      <th style="text-align:center;">Project</th>
                                      <th style="text-align:center;">Total hours</th>
                                      <th style="text-align:center;">Taken</th>
                                      </tr>
                                    </thead>
                                      <tbody>
                                          @foreach($projects as $row)
                                              <tr>
                                              <td style="text-align:center;">{{$row->name}}</td>
                                              <td style="text-align:center;">
                                                {{$row->hours_number}}
                                              </td>
                                             
                                              <td style="text-align:center;">
                                                {{$row->taken_hours}}
                                              </td>
                                            
                                          @endforeach
                                      </tbody>
                              </table>
              </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>
    
</div>
<!-- /.content-wrapper -->
@include('admin.CommanFiles.footer')

<script>
    $(function () {
      $('#example2').DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [0] } ],
        'searching'   : true,
        'scrollY'     : true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            
            {
                extend: 'pdfHtml5',
            },
            {
                extend: 'print',
            }
        ],
        'scrollY'     : true,
        'paging'      : true,
        'lengthChange': true,
        'info'        : true,
        'autoWidth'   : true,
      })
    })
</script>