@include('admin.CommanFiles.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Engineer
          <small>Version 1.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Engineer Dashboard</li>
        </ol>
      </section>
    
        <!-- Main content -->
      <section class="content">
      <!-- /.content -->
      <div class="row">
      @if(session('check_out_ok'))
                        <div class="alert alert-success">
                            <center>
                                Check Out Done Successfully 
                           </center>
                        </div>
                    @endif   
                  
        <section class="col-lg-6 connectedSortable">
           <!-- quick ticket widget -->
           <div class="box box-info" style="box-shadow: 10px 10px 5px grey;">
                  <div class="box-header">
                    <i class="fa fa-ticket"></i>
      
                    <h3 class="box-title">Check in</h3>
                    <!-- tools box -->
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    <!-- /. tools -->
                  </div>
                  <div class="box-body">
                  @if ($errors->any())
                        <div class="alert alert-danger">
                            
                            <center>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </center>
                            
                        </div>
                    @endif
                    
                    @if(session('save'))
                        <div class="alert alert-success">
                            <center>
                                Check In Done Successfully
                            </center>
                        </div>
                    @endif   
                    @if(session('check_out'))
                        <div class="alert alert-danger">
                            <center>
                                Check Out From project Or return to admin to solve problem 
                           </center>
                        </div>
                    @endif   
                  <form action="{{url('admin/check_in')}}" method="post">
                    {{ csrf_field() }}
                  
                      <div class="form-group">
                          <label>Select Project (Required)</label>
                          <select class="form-control js-example-basic-single" name="project_id">
                            @foreach($projects as $row)
                              <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>  
                      </div>
                      
                       <div class="box-footer clearfix">
                          <button type="submit" class="pull-right btn btn-success btn-block btn-lg" id="sendEmail">Check In
                            <i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </form>
                  </div>
                 
              </div>
        </section>
         <!-- PRODUCT LIST -->
         <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">
                 <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info" style="box-shadow: 10px 10px 5px grey;">
            <div class="box-header with-border">
              <h3 class="box-title">Pending List</h3>
                   @if(session('admin_check'))
                        <div class="alert alert-danger">
                            <center>
                                You are not allowed to check out, Return to admin to solve problem 
                           </center>
                        </div>
                    @endif  
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Project</th>
                    <th>Check In</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($pending as $row)
                  <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->name}}</td>
                  <td>{{$row->check_in}}</td>
                  <td><span class="label label-danger">Not Checked Out</span></td>
                  <td>
                    <a href='{{url("admin/check_out/$row->id")}}' class="btn btn-success">Check Out</a>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      
</div>
      <!-- /.content-wrapper -->
@include('admin.CommanFiles.footer') 
