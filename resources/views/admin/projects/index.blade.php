@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
       
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Projects
            <small> All Projects</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Projects</li>
          </ol>
        </section>
    
      <!-- Main content -->
      <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"> Projects </h3>
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
                     <form role="form" method="post" action="{{route('projects.store')}}">
                      {{csrf_field()}}
                      <div class="box-body">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Name" name="name" required value="{{old('name')}}">
                              </div>
    
                              <div class="form-group">
                                      <label for="exampleInputPassword1">So Number</label>
                                      <input type="text" class="form-control"  placeholder="Enter So Number" name="so_number" required value="{{old('so_number')}}">
                              </div>

                              <div class="form-group">
                                      <label for="exampleInputPassword1">Project Hours</label>
                                      <input type="number" class="form-control"  placeholder="Enter Number Of Hours" name="hours_number" required value="{{old('hours_number')}}">
                              </div>
                              <div class="form-group">
                                      <label for="exampleInputPassword1">Project Start</label>
                                      <input type="date" class="form-control"  placeholder="Enter Project Start" name="project_start" required value="{{old('project_start')}}">
                              </div>
                              <div class="form-group">
                                      <label for="exampleInputPassword1">Project End</label>
                                      <input type="date" class="form-control"  placeholder="Enter Project End" name="project_end" required value="{{old('project_end')}}">
                              </div>
                              <div class="form-group">
                                    <label for="exampleInputPassword1">Customer</label>
                                    <select class="form-control" name="customer_id">
                                        @foreach($customers as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
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
                         <th>Project ID</th>
                         <th>Name</th>
                         <th>Start</th>
                         <th>End</th>
                         <th>Number Of Hours</th>
                         <th>Edit</th>
                         @if(session('role')=='developer' || session('role')=='admin')
                         <th>Delete</th>
                         @endif
                       </tr>
                       </thead>
                       <tbody>
                         @foreach($projects as $row)
                            <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>
                               {{$row->project_start}}
                            </td>
                            <td>
                                {{$row->project_end}}
                            </td>
                            <td>
                                {{$row->hours_number}}
                            </td>
                           
                            <td style="text-align:center;"> 
                                <a href="{{  route('projects.edit', [$row->id])}}" class="btn btn-success btn-icon" id="delete"><span class="fa fa-pencil"></span></a>
                            </td>
                            @if(session('role')=='developer' || session('role')=='admin')
                            <td style="text-align:center;"> 
                                    <form role="form" action="{{ route('projects.destroy',$row->id) }}" method="post">
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