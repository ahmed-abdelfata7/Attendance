@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>Check in</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Check in</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Check in</h3>
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
               @if(session('check_out'))
                        <div class="alert alert-danger">
                            <center>
                                Check Out From project Or return to admin to solve problem 
                           </center>
                        </div>
                @endif   
               <!-- form start -->
               <form role="form" method="post" action="{{url('admin/do_manually_checkin')}}">
                {{csrf_field()}}
                <div class="box-body">
                      <div class="form-group">
                      <label>check in day</label>
                      <input type="date" name="checkin_date" class="form-control" required placeholder="Enter checkout date" value="{{old('checkout_date')}}">
                      </div>
                      <div class="form-group">
                      <label>check in time</label>
                      <input type="time" name="checkin_time" class="form-control" required placeholder="Enter checkout time" value="{{old('checkout_time')}}">
                      </div>
                      <div class="form-group">
                          <label>Select Project (Required)</label>
                          <select class="form-control" name="project_id">
                            @foreach($projects as $row)
                              <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>  
                      </div>
                      <div class="form-group">
                      <label>Report</label>
                      <textarea class="textarea" placeholder="Enter Your Report" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="report" value="{{old('report')}}"></textarea>
                      </div>
                </div><!-- /.box-body -->
            
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Check in</button>
                </div>
              </form>
            </div>
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
