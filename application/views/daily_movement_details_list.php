<?php 
include('include/header.php');
?>

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Daily Movement Details</h1>                         
                            </div>


                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                            <?php if($this->session->flashdata('success_msg')!=null){ ?>
                            <div class="alert alert-success alert-dismissable">
                              <a class="panel-close close" data-dismiss="alert">×</a> 
                              <i class="fa fa-check-square"></i>
                              <?php echo $this->session->flashdata('success_msg'); ?>
                            </div>  
                            <?php } ?>
                        
                            <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Daily Movement Details List</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">


                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Transport Type</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>Place Name</th> 
                                            <th>Party Name</th> 
                                            <th>Driver Name</th> 
                                            <?php if($this->session->userdata('username')=='admin'){ ?>                                           
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                             <th>Transport Type</th>
                                            <th>Vehicle No</th>
                                            <th>Container No</th>
                                            <th>Place Name</th> 
                                            <th>Party Name</th> 
                                            <th>Driver Name</th>  
                                            <?php if($this->session->userdata('username')=='admin'){ ?>                                          
                                            <th>Status</th>
                                            <?php } ?>
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
                                            <td><a href="read_daily_movement_details?id=<?php echo $row->Daily_mvnt_dtl_id;?>" target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"><?php echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)); ?></a></td>
                                            <td>
                                            <?php
											if($row->Daily_mvnt_dtl_transport_type=="T"){
												echo "Thirumala Transport"; 
											}
											else{
												echo $row->Transport_dtl_name;
											}
											?>
                                            </td>
                                            <td>
											<?php 
                                                echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
                                             ?>                                                
                                            </td>
                                            <td> 
											<?php 
											if($row->Daily_mvnt_dtl_container_type=='NC'){
												
												echo $row->Daily_mvnt_dtl_new_container_no;
											}
											elseif($row->Daily_mvnt_dtl_container_type=='BC'){ 
											echo $row->Party_billing_container_no; }
											 ?></td> 
                                            <td>
                                                <?php 
                                                    echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Pay Rate Detail" data-placement="bottom" ' );
                                                 ?> 

                                            </td>
                                            <td><?php echo anchor('party_details/view_party_details?id='.$row->Daily_mvnt_dtl_party_name.'', $row->Party_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Party Detail" data-placement="bottom"' );
                                             ?></td>
                                            <td><?php 
												if($row->Daily_mvnt_dtl_transport_type=='O'){
													echo "--";
												}
												else{
											echo anchor('driver_details/view_driver_details?id='.$row->Daily_mvnt_dtl_driver_name.'', $row->Driver_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Detail" data-placement="bottom"' );
												}
                                             ?></td>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <td>
                                                <?php 
                                                if($row->Daily_mvnt_dtl_status=='A')
                                                {
                                                   echo '<strong class="fa fa-check" style="color:green;"> Active</strong>';   
                                                }
                                                else
                                                {
                                                    echo '<strong class="fa fa-times" style="color:red;"> Deny</strong>';
                                                }
                                                ?>                                               
                                                
                                            </td>
                                            <?php } ?>
                                            <td>
                                                <?php 
                                                echo anchor('daily_movement/read_daily_movement_details?id='.$row->Daily_mvnt_dtl_id.'', 'View', 'target="_blank" alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"' );
                                                ?>
                                                
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                 <i class="fa fa-ellipsis-v"></i>
                                                <a href="edit_daily_movement_details?id=<?php echo $row->Daily_mvnt_dtl_id; ?>" alt="Edit" target="_blank" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Daily Movement Detail" data-placement="bottom"> Edit </a><i class="fa fa-ellipsis-v"></i>
                                                <?php 
                                                if($row->Daily_mvnt_dtl_status=='A')
                                                {
                                                   echo '<a href="deny_daily_movement?id='.$row->Daily_mvnt_dtl_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Daily Movement" data-placement="bottom" > Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_daily_movement?id='.$row->Daily_mvnt_dtl_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a Daily Movement" data-placement="bottom"> Active </a>';
                                                }
                                                ?>   
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_daily_movement?id=<?php echo $row->Daily_mvnt_dtl_id; ?>" onclick="return confirm('Are you sure you want to delete?')" alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Daily Movement" data-placement="bottom" > Delete </a> 
                                                <?php } ?>
                                                <?php
												if($row->Daily_mvnt_dtl_transport_type=="T"){
												 if($row->Daily_mvnt_dtl_other_expences=="0"){?>
                                               <a href="add_other_expenses?id=<?php echo $row->Daily_mvnt_dtl_id; ?>" alt="Edit"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Add Driver Payment Detail" data-placement="bottom"> <button type="button" class="btn btn-primary">Add Driver Oth.Ex</button> </a> 
                                               <?php } else{ ?>
                                               <a href="add_other_expenses?id=<?php echo $row->Daily_mvnt_dtl_id; ?>" alt="Edit"  rel="tooltip" data-color-class = "purple" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Driver Payment Detail" data-placement="bottom"> <button type="button" class="btn btn-purple ">Edit Driver Oth.Ex</button> </a>
                                               <?php } }else{
												   if($row->Daily_mvnt_dtl_trp_expences=="0"){
												?>
                                                <a href="add_transport_expenses?id=<?php echo $row->Daily_mvnt_dtl_id; ?>" alt="Edit"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Add Transport Ex" data-placement="bottom"> <button type="button" class="btn btn-orange">Add Trans Oth.Ex</button> </a>                   			<?php }else{ ?>
                                               <a href="add_transport_expenses?id=<?php echo $row->Daily_mvnt_dtl_id; ?>" alt="Edit"  rel="tooltip" data-color-class = "purple" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Add Transport Ex" data-placement="bottom"> <button type="button" class="btn btn-info">Edit Trans Oth.Ex</button> </a>								
                                               <?php  }} ?>
                                            </td>
                                        </tr>
                                    <?php $sno++; } ?>
                                    </tbody>
                            </table>

                           </div>

                            </div>
                        




                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        