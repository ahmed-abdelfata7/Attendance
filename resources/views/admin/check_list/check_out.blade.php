@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$check[0]->name}}
        <small>Check Out</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">{{$check[0]->name}}</a></li>
        <li class="active">Check Out</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Check Out</h3>
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
               <!-- form start -->
               <form role="form" method="post" action="{{url('admin/do_check_out')}}">
                {{csrf_field()}}
                <div class="box-body">
                <input type="hidden" name="check_id" value="{{$check[0]->id}}">
                    @if($user->check_out == 1)
                    <div class="form-group">
                      <label>check in day</label>
                      <input type="date" name="checkout_date" class="form-control" required placeholder="Enter checkout date" value="{{old('checkout_date')}}">
                      </div>
                      <div class="form-group">
                      <label>check in time</label>
                      <input type="time" name="checkout_time" class="form-control" required placeholder="Enter checkout time" value="{{old('checkout_time')}}">
                      </div>
                   
                      <div class="form-group">
                      <label>Report</label>
                      <textarea class="textarea" placeholder="Enter Your Report" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="report">
                      @if(empty($check->report))
                          you Report
                      @endif
                      </textarea>   
                      </div>
                    @else
                    <div class="form-group">
                      <label>Report</label>
                      <textarea class="textarea" placeholder="Enter Your Report" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="report">
                      </textarea>   
                      </div>
                      @endif
                </div><!-- /.box-body -->
            
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Check Out</button>
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
