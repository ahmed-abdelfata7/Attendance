@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alert List
        <small>Edit Email</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Alert List</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Email</h3>
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
               <form role="form" method="post" action="{{route('emails.update',$email->id)}}">
                <input type="hidden" name="_method" value="PATCH">
                {{csrf_field()}}
                <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                      <input type="email" class="form-control"  placeholder="Enter Email" name="email" required value="{{$email->email}}">
                      </div>
                </div><!-- /.box-body -->
            
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Update</button>
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
