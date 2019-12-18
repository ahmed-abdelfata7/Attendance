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
       Edit Account 
        <small>Edit Account</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">System users</a></li>
        <li class="active"> Edit Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> System users </h3>
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
               <form role="form" method="post" action="{{route('admins.update',[$admin->id])}}">
                <input type="hidden" name="_method" value="PATCH">
                {{csrf_field()}}
                <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Name</label>
                          <input type="text" class="form-control"  placeholder="Enter Name" name="name" required value="{{$admin->name}}">
                        </div>
             
                
                        <div class="form-group">
                          <label for="exampleInputPassword1">Email</label>
                          <input type="email" class="form-control"  placeholder="Enter Email" name="email" required value="{{$admin->email}}">
                        </div>
                 
                    
                        <div class="form-group">
                          <label for="exampleInputPassword1">ChangePassword</label>
                          <input type="password" class="form-control"  placeholder="Enter New password" name="password">
                        </div>
                        <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role">
                                @if(session('role')=='developer')
                                  <option value="admin" @if($admin->role=="admin") selected @endif >Admin</option>
                                @endif
                                  <option value="engineer"@if($admin->role=="engineer") selected @endif>Engineer</option>
                                </select>
                        </div>
                
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save</button>
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
