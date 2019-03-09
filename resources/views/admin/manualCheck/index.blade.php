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
        All System Users 
        <small>All System Users</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">System users</a></li>
        <li class="active"> All System users </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> System Users </h3>
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
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Engineer</th>
                  <th>On/Off Check in</th>
                  <th>On/Off Check out</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($engineers as $row)
                    <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td style="text-align:center;"> 
                    @if($row->check_in==0)
                        <a href='{{ url("admin/toggleCheck/$row->id/in") }}' class="btn btn-default btn-icon" id="delete"><span class="fa fa-toggle-off"></span></a>
                    @else
                        <a href='{{ url("admin/toggleCheck/$row->id/in") }}' class="btn btn-default btn-icon" id="delete"><span class="fa fa-toggle-on"></span></a>
                    @endif
                    </td>
                    <td style="text-align:center;"> 
                    @if($row->check_out==0)
                        <a href='{{ url("admin/toggleCheck/$row->id/out") }}' class="btn btn-default btn-icon" id="delete"><span class="fa fa-toggle-off"></span></a>
                    @else
                        <a href='{{ url("admin/toggleCheck/$row->id/out") }}' class="btn btn-default btn-icon" id="delete"><span class="fa fa-toggle-on"></span></a>
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
</body>
</html>
