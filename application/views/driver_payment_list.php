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
                                <h1 class="title">Driver Payment</h1>                            
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
                            <?php if($this->session->flashdata('failear_msg')){ ?>
                                <div class="alert alert-error alert-dismissible fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong><?php echo $this->session->flashdata('failear_msg'); ?></strong>
                                </div>
                            <?php } ?>
                        
                            <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Driver Payment List</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                             <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        	<th>Sno</th>
                                            <th>Movement Date</th>
                                            <th>Driver Name</th>
                                            <th>Place Name</th>
                                            <th>Vehicle Number</th>
                                            <th>Other Expenses</th>
                                            <th><i class="fa fa-inr"></i>Rent</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         	<th>Sno</th>
                                            <th>Movement Date</th>
                                            <th>Driver Name</th>
                                            <th>Place Name</th>
                                            <th>Vehicle Number</th>
                                            <th>Other Expenses</th>
                                            <th><i class="fa fa-inr"></i>Rent</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php  
										 $sno=1;                                                   
                                        foreach ($driver_payment_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                        	<td><?php echo $sno ?></td>
                                            <td><?php echo anchor('daily_movement/read_daily_movement_details?id='.$row->	Daily_mvnt_dtl_id.'', date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date)), 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Daily Movement Detail" data-placement="bottom"' );
                                             ?></td>
                                              <td><?php
											
											   echo anchor('driver_details/view_driver_details?id='.$row->Daily_mvnt_dtl_driver_name.'', $row->Driver_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Detail" data-placement="bottom"' );
											
                                             ?></td>
                                            <td><?php echo anchor('driver_pay_rate/view_driver_pay_details?id='.$row->Daily_mvnt_dtl_place.'', $row->Driver_pay_rate_place_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Pay Rate Detail" data-placement="bottom"' );
                                             ?></td>
                                            <td><?php
											 echo $row->Vehicle_dtl_number; ?></td>
                                            
                                             
                                           
                                            <td><?php  echo $row->Daily_mvnt_dtl_other_expences;  ?></td>
                                             <td><?php  echo $row->	Daily_mvnt_dtl_driver_total_pay;  ?></td>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                           
                                            <?php } ?>
                                            <td>
                             <a href="view_driver_payment?id=<?php echo $row->Driver_pymnt_di_driver_name.'&dr_name='.$row->	Driver_dtl_name; ?>" target="_blank" alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Detail" data-placement="bottom"> View </a>
                            
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                 <!-- <a href="edit_driver_payment?id=<?php echo $row->Driver_pymnt_id; ?>"  alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Driver Payment Detail" data-placement="bottom"> Edit </a> <i class="fa fa-ellipsis-v"></i>-->
                                                  
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_message?id=<?php echo $row->Driver_pymnt_id;?>" onclick="return confirm('Are you sure you want to delete?')"alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Driver Payment" data-placement="bottom" > Delete </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                   <?php  $sno++; } ?>
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
        