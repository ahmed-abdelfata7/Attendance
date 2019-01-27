@include('admin.CommanFiles.header')
<style>
th,td{
  text-align:center;
}
</style>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Generate Reports 
        <small>Reports</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">System Reports</a></li>
        <li class="active"> All System Reports </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> System Reports </h3>
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
                        Saved Successfully
                    </center>
                </div>
               @endif   
               @if(session('update'))
                <div class="alert alert-success">
                    <center>
                        Updated Successfully
                    </center>
                </div>
               @endif   
               @if(session('delete'))
                <div class="alert alert-success">
                    <center>
                        Deleted Successfully
                    </center>
                </div>
               @endif   
               <!-- form start -->
               <form role="form" method="post" action="{{url('admin/do_generate_report')}}">
                {{csrf_field()}}
                <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Date From</label>
                          <input type="date" class="form-control"  placeholder="Enter Date From" name="from" required value="{{old('from')}}">
                        </div>
             
                     
                        <div class="form-group">
                          <label for="exampleInputPassword1">Date To</label>
                          <input type="date" class="form-control"  placeholder="Enter Date To" name="to" required value="{{old('to')}}">
                        </div>
                 
                        <div class="form-group">
                                <label>Engineer</label>
                                <select class="form-control" name="engineer_id">
                                @foreach($engineers as $row)
                                  <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                                </select>
                        </div>
                        
                
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">View Report</button>
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
</body>
</html>
