@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
       
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Customers
            <small> All Customers</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customers</li>
          </ol>
        </section>
    
      <!-- Main content -->
      <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"> Customers </h3>
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
                     <form role="form" method="post" action="{{route('customers.store')}}">
                      {{csrf_field()}}
                      <div class="box-body">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Name" name="name" required value="{{old('name')}}">
                              </div>
                              <div class="form-group">
                                      <label for="exampleInputPassword1">Email</label>
                                      <input type="text" class="form-control"  placeholder="Enter Email" name="email" required value="{{old('email')}}">
                              </div>
                              <div class="form-group">
                                      <label for="exampleInputPassword1">Phone</label>
                                      <input type="number" class="form-control"  placeholder="Enter Phone" name="phone" required value="{{old('phone')}}">
                              </div>
                              <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <input type="text" class="form-control"  placeholder="Enter Address" name="address" value="{{old('address')}}">
                              </div>
                             
                           
                      <div class="box-footer">
                          <button type="submit" class="btn btn-success">Save</button>
                      </div>
                    </form>
                  </div>
              <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead >
                       <tr>
                         <th>Customer ID</th>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Phone</th>
                         <th>Address</th>
                         <th>Edit</th>
                         @if(session('role')=='developer' || session('role')=='admin')
                         <th>Delete</th>
                         @endif
                       </tr>
                       </thead>
                       <tbody>
                         @foreach($users as $row)
                            <tr>
                            <td>{{$row->id}}</td>
                            <td><a href='{{url("admin/CustomerDetails/$row->id")}}'>{{$row->name}}</a></td>
                            <td>
                               {{$row->email}}
                            </td>
                            <td>
                                {{$row->phone}}
                            </td>
                            <td>
                                {{$row->address}}
                            </td>
                           
                            <td style="text-align:center;"> 
                                <a href="{{  route('customers.edit', [$row->id])}}" class="btn btn-success btn-icon" id="delete"><span class="fa fa-pencil"></span></a>
                            </td>
                            @if(session('role')=='developer' || session('role')=='admin')
                            <td style="text-align:center;"> 
                                    <form role="form" action="{{ route('customers.destroy',$row->id) }}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger"  @if(session('role') !='developer')) disabled @endif><i class="fa fa-trash"></i></button>
                                    </form>
                            </td>
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
@include('admin.CommanFiles.footer')
