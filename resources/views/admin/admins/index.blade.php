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
               <!-- form start -->
               <form role="form" method="post" action="{{route('admins.store')}}">
                {{csrf_field()}}
                <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Name</label>
                          <input type="text" class="form-control"  placeholder="Enter Name" name="name" required value="{{old('name')}}">
                        </div>
             
                     
                        <div class="form-group">
                          <label for="exampleInputPassword1">Email</label>
                          <input type="email" class="form-control"  placeholder="Enter Email" name="email" required value="{{old('email')}}">
                        </div>
                 
                        <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role">
                                  @if(session('role')=='developer')
                                  <option value="admin">Admin</option>
                                  @endif
                                  <option value="engineer">Engineer</option>
                                </select>
                        </div>
                            
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control"  placeholder="Enter password" name="password" required value="{{old('password')}}">
                        </div>
                
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($admins as $row)
                    <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->role}}</td>
                    <td style="text-align:center;"> 
                        <a href="{{  route('admins.edit', [$row->id])}}" class="btn btn-success btn-icon" id="delete"><span class="fa fa-pencil"></span></a>
                    </td>
                    <td style="text-align:center;"> 
                      <form role="form" action="{{route('admins.destroy',$row->id)}}" method="post">
                          {{csrf_field()}}
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-danger"  @if(session('role') !='developer')) disabled @endif><i class="fa fa-trash"></i></button>
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
