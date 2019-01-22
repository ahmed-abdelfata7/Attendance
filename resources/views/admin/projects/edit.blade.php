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
                     <form role="form" method="post" action="{{route('projects.update',[$project->id])}}">
                     <input type="hidden" name="_method" value="PATCH">
                                    {{csrf_field()}}
                      <div class="box-body">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Name" name="name" required value="{{$project->name}}">
                              </div>
    
                              <div class="form-group">
                                      <label for="exampleInputPassword1">So Number</label>
                                      <input type="text" class="form-control"  placeholder="Enter So Number" name="so_number" required value="{{$project->so_number}}">
                              </div>

                              <div class="form-group">
                                      <label for="exampleInputPassword1">Project Hours</label>
                                      <input type="number" class="form-control"  placeholder="Enter Number Of Hours" name="hours_number" required value="{{$project->hours_number}}">
                              </div>
                              <div class="form-group">
                                      <label for="exampleInputPassword1">Project Start</label>
                                      <input type="date" class="form-control"  placeholder="Enter Project Start" name="project_start" required value="{{$project->project_start}}">
                              </div>
                              <div class="form-group">
                                      <label for="exampleInputPassword1">Project End</label>
                                      <input type="date" class="form-control"  placeholder="Enter Project End" name="project_end" required value="{{$project->project_end}}">
                              </div>
                              <div class="form-group">
                                    <label for="exampleInputPassword1">Customer</label>
                                    <select class="form-control" name="customer_id">
                                        @foreach($customers as $row)
                                            
                                            <option value="{{$row->id}}"@if ($row->id==$project->customer_id) selected @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                              </div>
                             
                           
                      <div class="box-footer">
                          <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </form>
                  </div>
            
              <!-- /.row -->
      </section>
            <!-- /.content -->
</div>
        <!-- /.content-wrapper -->
@include('admin.CommanFiles.footer')
       