@include('crm.CommanFiles.header') 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
       
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Customer
            <small>All Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <section class="col-lg-6 connectedSortable">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info" style="box-shadow: 10px 10px 5px grey;">
                 <div class="box-header with-border">
                   <h3 class="box-title">Customer Phones</h3>
           
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body">
                   <div class="table-responsive">
                     <table class="table no-margin">
                       <thead>
                       <tr>
                         <th>ID</th>
                         <th>Phone</th>
                       </tr>
                       </thead>
                       <tbody>
                       
                         @foreach($phones as $row)
                         <tr>
                         <td>{{ $row->id }}</td>
                         <td>{{ $row->phone}}</td>
                         </tr>
                         @endforeach
                      
                       </tbody>
                     </table>
                   </div>
                   <!-- /.table-responsive -->
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer clearfix">
                 </div>
                 <!-- /.box-footer -->
               </div>
               <!-- /.box -->
          <!-- /.row -->
              </section>
              <section section class="col-lg-6 connectedSortable">
                <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info" style="box-shadow: 10px 10px 5px grey;">
                  <div class="box-header with-border">
                    <h3 class="box-title">Customer Emails</h3>
            
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach($emails as $row)
                            <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->email}}</td>
                            </tr>
                            @endforeach
                          
                       
                       
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer clearfix">
                   </div>
                  <!-- /.box-footer -->
                </div>
                <!-- /.box -->
           <!-- /.row -->
        </section>
          </div>
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
         
           
            <section class="col-lg-6 connectedSortable">
                  <!-- PRODUCT LIST -->
              <div class="box box-primary" style="box-shadow: 10px 10px 5px grey;">
                  <div class="box-header with-border">
                    <h3 class="box-title">Analytics</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <ul class="products-list product-list-in-box">
                      <li class="item">
                        <div class="product-img">
                          <img src="{{asset('customer/dist/img/email.png')}}" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">Customer Emails
                            <span class="label label-info pull-right">{{count($emails)}}</span></a>
                          <span class="product-description">
                                You have ({{count($emails)}}) email added in the system 
                              </span>
                        </div>
                      </li>
                      <!-- /.item -->
                      <li class="item">
                        <div class="product-img">
                          <img src="{{asset('customer/dist/img/ticket.png')}}" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">Customer Tickets
                            <span class="label label-info pull-right">{{count($tickets)}}</span></a>
                          <span class="product-description">
                              You have ({{count($tickets)}}) ticket added in the system 
                              </span>
                        </div>
                      </li>
                       <!-- /.item -->
                       <li class="item">
                          <div class="product-img">
                            <img src="{{asset('customer/dist/img/phone.jpeg')}}" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">Customer Phones
                              <span class="label label-info pull-right">{{count($phones)}}</span></a>
                            <span class="product-description">
                                You have ({{count($phones)}}) Phone added in the system 
                                </span>
                          </div>
                        </li>
                     <!-- /.item -->
                     <li class="item">
                        <div class="product-img">
                          <img src="{{asset('customer/dist/img/project.png')}}" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">Customer Projects
                            <span class="label label-info pull-right">{{count($projects)}}</span></a>
                          <span class="product-description">
                              You have ({{count($projects)}}) Project added in the system 
                              </span>
                        </div>
                      </li>
                      <!-- /.item -->
                    </ul>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                      <div class="product-img">
                          <img src="{{asset('customer/dist/img/analytics.png')}}" alt="Product Image" style="max-width:100%;max-height:185px;">
                        </div>
                  </div>
                  <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </section>
            <!-- right col -->
            <section section class="col-lg-6 connectedSortable">
                    <!-- TABLE: LATEST ORDERS -->
                  <div class="box box-info" style="box-shadow: 10px 10px 5px grey;">
                      <div class="box-header with-border">
                        <h3 class="box-title">Customer Projects</h3>
                
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="table-responsive">
                          <table class="table no-margin">
                                <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Address</th>
                                          <th>Start Warantly</th>
                                          <th>End Warantly</th>
                                          <th>Show Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($projects as $row)
                                            <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->address}}</td>
                                            <td>{{$row->startWarantly}}</td>
                                            <td <?php 
                                                $toDay         = date('Y-m-d');
                                                $dateCompared  = $row->endWarantly;
                                                if($toDay > $dateCompared){
                                                  echo "class='alert alert-danger'";
                                                }
                                                ?> >
                                            {{$row->endWarantly}}
                                          </td>
                                            <td><a href="#" class="btn btn-info btn-icon" id="delete" onclick='loadModal({{$row}});'><span class="fa fa-eye"></span></a></td>
                                            </tr>
                                          @endforeach
                        
                                        </tbody>
                          </table>
                        </div>
                        <!-- /.table-responsive -->
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer clearfix">
                       </div>
                      <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
               <!-- /.row -->
                  </section>
            
        </div>
 
        
          <!-- /.row (main row) -->
    
        </section>
        <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('crm.CommanFiles.footer') 
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              <div class="table-responsive">          
                <table class="table">
                 
                  <tbody>
                    <tr class="success">
                      <th>ProjectName</th>
                      <td id="name"></td>
                    </tr>
                    <tr>
                      <th>StartWarantly</th>
                      <td id="StartWarantly"></td>
                    </tr>
                    <tr class="success">
                      <th>EndWarantly</th>
                      <td id="EndWarantly"></td>
                    </tr>
                    <tr>
                      <th>SystemStatus</th>
                      <td id="SystemStatus"></td>
                    </tr>
                    <tr class="success">
                      <th>Address</th>
                      <td id="Address"></td>
                    </tr>
                    <tr>
                      <th>SystemComponent</th>
                      <td id="SystemComponent"></td>
                    </tr>
                    <tr class="success">
                      <th>YearsCovered</th>
                      <td id="YearsCovered"></td>
                    </tr>
                    <tr>
                      <th>Notes</th>
                      <td id="Notes"></td>
                    </tr>
                  </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
      <script>
      function loadModal(data){
        console.log(data);
          $(".modal-title").html(data['name']);
          $("#name").html(data['name']);
          $("#StartWarantly").html(data['startWarantly']);
          $("#EndWarantly").html(data['endWarantly']);
          $("#SystemStatus").html(data['systemStatus']);
          $("#Address").html(data['address']);
          $("#SystemComponent").html(data['systemComponent']);
          $("#YearsCovered").html(data['yearsCovered']);
          $("#Notes").html(data['notes']);
          $("#modal-default").modal("show");
         
      }
      </script>