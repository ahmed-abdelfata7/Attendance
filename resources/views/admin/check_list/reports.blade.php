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
                                        <th style="text-align:center;">Project Name</th>
                                        <th style="text-align:center;">Number of hours</th>
                                        <th style="text-align:center;">Details</th>
                                      </tr>
                                    </thead>
                                      <tbody>
                                          @foreach($reports as $row)
                                              <tr>
                                              <td style="text-align:center;">{{DB::table('projects')->where('id',$row->project_id)->first()->name}}</td>
                                              <td style="text-align:center;">
                                              {{$row->hours}}
                                              </td>
                                            
                                              <td style="text-align:center;"> 
                                                  <a href='{{url("admin/engineer_report_details/$row->project_id/$row->engineer_id")}}' class="btn btn-primary btn-icon"><span class="fa fa-list"></span></a>
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
