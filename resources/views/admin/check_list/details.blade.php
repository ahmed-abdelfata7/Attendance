@include('admin.CommanFiles.header') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
       
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {{$project}}
            <small> Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Details</li>
          </ol>
        </section>
        <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> {{$project}} </h3>
            </div>
            <div class="box-body">
             
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                                  <thead >
                                      <tr>
                                        <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">Check In</th>
                                        <th style="text-align:center;">Check Out</th>
                                        <th style="text-align:center;">Report</th>
                                      </tr>
                                    </thead>
                                      <tbody>
                                      <?php
                                      $x=1;
                                      ?>
                                          @foreach($details as $row)
                                              <tr>
                                              <td style="text-align:center;">
                                              {{$x}}
                                              </td>
                                              <td style="text-align:center;">
                                              {{$row->check_in}}
                                              </td>
                                              <td style="text-align:center;">
                                              {{$row->check_out}}
                                              </td>
                                            
                                              <td style="text-align:center;"> 
                                              <?php echo $row->report; ?>
                                              </td>
                                            <?php 
                                                $x++;
                                            ?>
                                          @endforeach
                                         
                                        <tr style="background-color:#ecf0f5;">
                                        <td style="text-align:center;"><b>Number Of Hours</b></td>
                                        <td style="text-align:center;"><b>{{$total}}</b></td>
                                        <td style="text-align:center;"></td>
                                        <td style="text-align:center;"></td>

                                        </tr>
                                   
                                      
                                      </tbody>
                                     
                              </table>
              </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>
      
</div>
<!-- /.content-wrapper -->
@include('admin.CommanFiles.footer')
       