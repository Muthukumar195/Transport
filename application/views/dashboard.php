<?php 
include('include/header.php');
?>

        <!-- START CONTAINER -->
        <div class="page-container row-fluid"> 

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>
                    <div class='col-lg-2 col-md-2'>
                        <div class="page-title">
                            <div class="pull-left">
                                <h1 class="title">Dashboard</h1> 
                             </div>
                              </div>
                    </div>
                    <div class='col-lg-10 col-md-10' >
                        <marquee style="background-image: url('<?php echo base_url(); ?>/assets/images/truck_bg.jpg');  border-radius: 10px;">
                        <img src="<?php echo base_url(); ?>/assets/images/truck.png" alt="truck">
                        <img src="<?php echo base_url(); ?>/assets/images/truck1.png" alt="truck logo">
                        <img src="<?php echo base_url(); ?>/assets/images/truck2.png" alt="truck">
                          <img src="<?php echo base_url(); ?>/assets/images/truck.png" alt="truck">
                        <img src="<?php echo base_url(); ?>/assets/images/truck1.png" alt="truck logo">
                        <img src="<?php echo base_url(); ?>/assets/images/truck2.png" alt="truck">
                          <img src="<?php echo base_url(); ?>/assets/images/truck.png" alt="truck">
                        <img src="<?php echo base_url(); ?>/assets/images/truck1.png" alt="truck logo">
                        <img src="<?php echo base_url(); ?>/assets/images/truck2.png" alt="truck">
                        </marquee>
                    </div>
                    <div class="clearfix"></div>
					
                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">

                                <div class="row">
                                <?php 
                                if((in_array("Driver Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                {
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social facebook">
                                            <div class="social-icon">
                                                <i class='fa fa-user text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $driver_count; ?>" class="number_counter bold count text-light">0</h3>
                                      
                                                 <h4 class="counttype text-light">Total Drivers</h4>
                                   
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php } ?>
                                <?php 
                                  if((in_array("Driver Pay Rate", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                  { 
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social bg-primary">
                                            <div class="social-icon">
                                                <i class='fa fa-road text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $driver_pay_rate_count; ?>" class="number_counter bold count text-light">0</h3>
                                              
                                                 <h4 class="counttype text-light">Total Pay Rate</h4>
                                   
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php } ?>
                                <?php 
                                  if((in_array("Vehicle Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                  { 
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social bg-purple">
                                            <div class="social-icon">
                                                <i class='fa fa-bus text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $vehicle_count; ?>" class="number_counter bold count text-light">0</h3>
                                              
                                                 <h4 class="counttype text-light">Total Vehicle</h4>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php } ?>
                                <?php 
                                  if((in_array("Daily Movement", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                  { 
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social bg-orange">
                                            <div class="social-icon">
                                                <i class='fa fa-cubes text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $daily_movement_count; ?>" class="number_counter bold count text-light">0</h3>
                                              
                                                 <h4 class="counttype text-light">Daily Movements</h4>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php } ?>
                                </div> <!-- End .row -->	

                                <div class="row">
                                <?php 
                                  if((in_array("Party Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                  { 
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social bg-info">
                                            <div class="social-icon">
                                                <i class='fa fa-group  text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $party_count; ?>" class="number_counter bold count text-light">0</h3>
                                              
                                                 <h4 class="counttype text-light">Total Partys</h4>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php } ?>
                                <?php 
                                  if((in_array("ISO Movement", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                  { 
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social bg-success">
                                            <div class="social-icon">
                                                <i class='fa fa-newspaper-o text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $iso_movement_count; ?>" class="number_counter bold count text-light">0</h3>
                                              
                                                 <h4 class="counttype text-light"> ISO Movement</h4>
                                            </div>
                                        </div>
                                        
                                    </div> 
                                <?php } ?>
                                <?php 
                                  if((in_array("Transport Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                  { 
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social bg-danger">
                                            <div class="social-icon">
                                                <i class='fa fa-truck text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $transport_count; ?>" class="number_counter bold count text-light">0</h3>
                                              
                                                 <h4 class="counttype text-light">Total Transport</h4>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                <?php } ?>
                                <?php 
                                  if((in_array("Party Billing", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                                  { 
                                ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="wid-social bg-secondary">
                                            <div class="social-icon">
                                                <i class='fa fa-file-text-o text-light icon-xlg pull-right'></i>
                                            </div>
                                            <div class="social-info">
                                                <h3 data-speed="3000" data-from="0" data-to="<?php echo $party_billing_count; ?>" class="number_counter bold count text-light">0</h3>
                                              
                                                 <h4 class="counttype text-light">Total Party Bills</h4>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php } ?>
                                
                                </div> <!-- End .row -->    



                                 <!-- End .row -->

                                 <!-- start list latest daily movement details -->
                        <?php 
                          if((in_array("Daily Movement", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                                 <section class="box " style=" border-radius: 15px;">
                            <header class="panel_header">
                                <h2 class="title pull-left">Latest Daily Movement Details
                                &nbsp;&nbsp;&nbsp;<small>

                                    <?php
                                        echo anchor('daily_movement/daily_movement_details_list','<span  alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View All Daily Movement Details" data-placement="bottom">View All Details</span> 
                                        <i class="fa fa-angle-double-right"></i>','');
                                     ?>
                                    
                                </small>
                                </h2> 
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
								<div class="table-responsive">
                                        <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>Place Name</th> 
                                            <th>Party Name</th> 
                                            <th>Driver Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>Place Name</th> 
                                            <th>Party Name</th> 
                                            <th>Driver Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                            
                                        foreach ($daily_movement_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php 
                                                    echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)), 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"' );
                                                 ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
												
                                                 ?>                                                
                                            </td>
                                            <td>
                                                <?php 
												if($row->Daily_mvnt_dtl_container_type=="BC"){
                                                    echo $row->Party_billing_container_no;
												}else{
													echo $row->Daily_mvnt_dtl_new_container_no;
												}
													
                                                 ?>                                                 
                                            </td> 
                                            <td>
                                                <?php 
                                                    echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Pay Rate Detail" data-placement="bottom"' );
                                                 ?> 

                                            </td>
                                            <td><?php echo $row->Party_dtl_name; ?></td>
                                            <td><?php echo $row->Driver_dtl_name; ?></td>
                                            <td>
                                                <?php 
                                                echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', 'View', 'target="_blank"  alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"' );
                                                ?>                                              
                                            </td>
                                        </tr>
                                    <?php $sno++; } ?>
                                    </tbody>
                            </table> 
                                        </div>
                           </div>

                            </div>
                </section>
                <?php } ?>

                                 <!-- end list latest daily movement details -->

                    <!-- start latest iso movement details -->
                <?php 
                  if((in_array("ISO Movement", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                  { 
                ?>
                    <section class="box" style=" border-radius: 15px;">
                            <header class="panel_header">
                                <h2 class="title pull-left">Iso Movement Details List
                                    &nbsp;&nbsp;&nbsp;<small>

                                    <?php
                                        echo anchor('iso_movement_details/iso_movement_details_list','<span alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View All ISO Movement Details" data-placement="bottom">View All Details</span>
                                        <i class="fa fa-angle-double-right"></i>','');
                                     ?>                                    
                                </small>

                                </h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">

							<div class="table-responsive">
                               <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>EY/LO</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Transport Name</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>EY/LO</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Transport Name</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($iso_movement_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td>
											<?php 
                                                  echo anchor('iso_movement_details/view_iso_movement_details?id='.$row->Iso_mvnt_id.'', date('d-m-Y', strtotime($row->Iso_mvnt_date)), 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View ISO Movement Detail" data-placement="bottom"' );
												  
                                                 ?>
                                            </td>
                                            <td> <?php 
											       if($row->Iso_mvnt_vehicle_type=="O"){
													   echo $row->Iso_mvnt_other_vehicle_no;
												   }else{
                                                    echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
												   }
                                                 ?>  </td>
                                            <td> 
											<?php
                                             echo $row->Iso_mvnt_container_no;
											 if($row->Iso_mvnt_container_no2){
												 echo ' - '.$row->Iso_mvnt_container_no2;
											 }
                                             ?>
                                            </td> 
                                            <td><?php echo $row->Iso_mvnt_ey_lo; ?></td> 
                                            <td><?php echo $row->Iso_mvnt_from; ?></td>
                                            <td><?php echo $row->Iso_mvnt_to; ?></td>
                                            <td><?php 
											if($row->Iso_mvnt_transport_name=="0"){
												echo "--";
											}else{
                                                    echo anchor('transport_details/view_transport_details?id='.$row->Transport_dtl_id.'', $row->Transport_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Transport Detail" data-placement="bottom"' );
											}
                                                 ?></td>
                                            <td><?php echo $row->Iso_mvnt_amount; ?></td>
                                            <td>
                                            <?php
                                            echo anchor('iso_movement_details/view_iso_movement_details?id='.$row->Iso_mvnt_id.'','View', ' alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View ISO Movement Detail" data-placement="bottom" target="_blank"');
                                            ?> 
                                            </td>
                                        </tr>
                                    <?php $sno++; } ?>
                                    </tbody>
                            </table>
							</div>
                           </div>

                            </div>
                    </section>
                <?php } ?>
                    <!-- end latest iso movement details -->
                            </div>
                        </section></div>



                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>

		 <script src="<?php echo base_url(); ?>/assets/plugins/count-to/countto.js" type="text/javascript"></script> 