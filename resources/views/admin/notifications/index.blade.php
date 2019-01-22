@include('crm.CommanFiles.header') 
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
        All System Notifications
        <small>All Tickets</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{url('admin/adminDashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">All Notifications</a></li>
        <li class="active">Notifications</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Notifications</h3>
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
                    <thead >
                        <tr>
                              <th style="text-align:center;"># </th>
                              <th style="text-align:center;">title </th>
                               <th style="text-align:center;">Description </th>
                               @if(session('role')=='developer' || session('role')=='admin')
                              <th style="text-align:center;">Delete</th>
                              @endif
                        </tr>
                    </thead>
                    <tbody>
                            
                        @foreach($notifications as $row)
                            <tr>
                                <td style="text-align:center;">{{$row->id}}</td>
                                <td style="text-align:center;">{{$row->title}}</td>
                                <td style="text-align:center;">{{$row->description}}</td>
                                @if(session('role')=='developer' || session('role')=='admin')
                                <td style="text-align:center;"><a href='{{url("admin/deleteNotification/$row->id")}}' class="btn btn-danger btn-icon"><span class="fa fa-trash"></span></a></td>
                                @endif
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
@include('crm.CommanFiles.footer')
</body>
</html>
