@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
       
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reports
            <small> All Reports</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports</li>
          </ol>
        </section>
    
      <!-- Main content -->
      <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"> Reports </h3>
                  </div>
                 
              <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead >
                       <tr>
                         <th>Name</th>
                         <th>Project</th>
                       </tr>
                       </thead>
                       <tbody>
                      
                        @foreach($engineers as $row)
                        <?php
                              $projects = DB::table('reports')
                                            ->where('engineer_id',$row->id)
                                            ->get();
                                          
                        ?>
                            <tr>
                            <td>{{$row->name}}</td>
                            <td>
                           
                            @if(!empty($projects))
                                <ul>
                                    @foreach($projects as $rr)
                                        <li><b>Project</b>
                                        <a href='{{url("admin/engineer_report_details/$rr->project_id/$rr->engineer_id")}}'>
                                       ( {{DB::table('projects')->where('id',$rr->project_id)->first()->name}} ) </a>
                                       <br>
                                        <b>Number Of Hours</b> : ( {{$rr->hours}} ) </li>
                                        <hr>
                                    @endforeach
                                </ul>
                            @else
                              Empty
                            @endif
                            </td>
                           
                            
                            </tr>
                         @endforeach
                        
                       </tbody>
                     </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
              <!-- /.row -->
      </section>
            <!-- /.content -->
</div>
        <!-- /.content-wrapper -->
@include('admin.CommanFiles.footer')
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