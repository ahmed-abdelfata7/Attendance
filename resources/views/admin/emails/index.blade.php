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
       Alert List
        <small>Alert List Emails</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Alert List</a></li>
        <li class="active">All Emails</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Emails</h3>
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
               <form role="form" method="post" action="{{route('emails.store')}}">
                {{csrf_field()}}
                <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control"  placeholder="Enter Email" name="email" required >
                      </div>
                </div><!-- /.box-body -->
            
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($emails as $row)
                    <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->email}}</td>
                    
                    <td style="text-align:center;"> 
                        <a href="{{  route('emails.edit', [$row->id])}}" class="btn btn-success btn-icon" id="delete"><span class="fa fa-pencil"></span></a>
                    </td>
                    <td style="text-align:center;"> 
                      <form role="form" action="{{route('emails.destroy',$row->id)}}" method="post">
                          {{csrf_field()}}
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
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