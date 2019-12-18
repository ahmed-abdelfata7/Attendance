@include('admin.CommanFiles.header')
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <center>
            <h1>
                Update Your Account 
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">Update Account </li>
            </ol>
            </center>
        
        </section>  
        <!-- Main content -->
        <section class="content">
                <!-- Info boxes -->
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            
                            <center>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
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
                   
      
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <center> <h3 class="box-title">Edit Your Account</h3></center>
                            </div><!-- /.box-header -->
                                <!-- form start -->
                            <form role="form" method="post" action="{{route('customers.update',[$user->id])}}">
                                <input type="hidden" name="_method" value="PATCH">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword3">Email</label>
                                            <input type="email" class="form-control" id="exampleInputPassword3" placeholder="Enter Your New Email" name="email" value="{{$user->email}}" >
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputPassword3">Phone</label>
                                                <input type="number" class="form-control" id="exampleInputPassword3" placeholder="Enter Your New Phone" name="phone" value="{{$user->phone}}" >
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputPassword3">Name</label>
                                                <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Enter Your New Name" name="name" value="{{$user->name}}" >
                                        </div>
                                        <div class="form-group">
                                                <label for="exampleInputPassword3">Address</label>
                                                <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Enter Your New Address " name="address" value="{{$user->address}}" >
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                            </form>
                                </div><!-- /.box -->
                    </div>
                
      
      
                </div>         
      </section>
</div>

<!-- /.content-wrapper -->
@include('admin.CommanFiles.footer')
