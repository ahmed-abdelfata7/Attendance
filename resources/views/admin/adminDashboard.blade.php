@include('admin.CommanFiles.header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Projects</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin" id="example2">
                  <thead>
                  <tr>
                    <th>Project</th>
                    <th>Number Of Hours</th>
                    <th>Hours Taken</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($projects as $row)
                  <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->hours_number}}</td>
                    @if($row->taken_hours < $row->hours_number)
                    <td style="background-color:lightgray;"><b>{{$row->taken_hours}}</b></td>
                    @else
                    <td  style="background-color:red;"><b>{{$row->taken_hours}}</b></td>
                    @endif
                    <td>
                    <a href='{{url("admin/admin_report_details/$row->id")}}' class="btn btn-primary btn-icon"><span class="fa fa-list"></span></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
         
          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Alerts</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
              @foreach($alerts as $row)
                <li class="item">
                  <div class="product-info">
                    <a href='{{url("admin/admin_check_out/$row->id")}}' class="btn btn-primary">Click to check-Out </a>
                    <p>
                         {{$row->userName}} has been Check-in {{$row->check_in}} in {{$row->name}} without Check Out.
                    </p>
                  </div>
                </li> 
              @endforeach
              </ul>
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

</div>
<!-- ./wrapper -->

@include('admin.CommanFiles.footer')
