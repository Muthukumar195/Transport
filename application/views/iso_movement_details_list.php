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
                              <h1 class="title">Iso Movement Details</h1>                            
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
                                <h2 class="title pull-left">Iso Movement Details List</h2>
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
                                            <th>EY/LO</th>
                                            <th>Load Type</th>
                                            <th>Pick</th>
                                            <th>Drop</th>
                                            <th>Transport Name</th>
                                            <th>Transport Amount</th>
                                            <th>Iso Amount</th>
                                                
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
                                            <th>EY/LO</th>
                                            <th>Load Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Transport Name</th>
                                            <th>Transport Amount</th>
                                            <th>Amount</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>                                        
                                            <th>Status</th>
                                            <?php } ?>
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
                                            <td><a href="view_iso_movement_details?id=<?php echo $row->Iso_mvnt_id; ?>" target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View ISO Movement Detail" data-placement="bottom"><?php echo date('d-m-Y', strtotime($row->Iso_mvnt_date)); ?></a></td>
                                            <td>
                                            <?php 
											if($row->Iso_mvnt_vehicle_type=="T"){
												echo 'Thirumala Tansport';
											}
											else{
												
												echo 'Other Tansport';
											}
											?>
                                            </td>
                                            <td> <?php 
											if($row->Iso_mvnt_vehicle_type=='O'){
												
												echo $row->Iso_mvnt_other_vehicle_no;
												}
											else{
                                                    echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
											}
                                                 ?>  </td>
                                            <td> <?php
                                            echo  $row->Iso_mvnt_container_no;
                                            if($row->Iso_mvnt_container_no2){
                                                echo '-'.$row->Iso_mvnt_container_no2;
                                            }
											 ?>
											</td> 
                                            <td><?php if($row->Iso_mvnt_ey_lo=="E"){ echo 'Empty'; } else { echo 'Load'; } ?></td> 
                                            <td><?php if($row->Iso_mvnt_im_ex=="I"){ echo 'Import'; } else { echo 'Export'; }  ?></td> 
                                            <td><?php if($row->Iso_mvnt_pickup_place){ echo $row->Iso_mvnt_pickup_place; } else{ '--';} ?></td>
                                            <td><?php if($row->Iso_mvnt_drop_place){ echo $row->Iso_mvnt_drop_place; } else{ '--';} ?></td>
                                            <td><?php 
											if($row->Iso_mvnt_transport_name=="0"){
												echo '--';
											}else{
                                                    echo anchor('transport_details/view_transport_details?id='.$row->Transport_dtl_id.'', $row->Transport_dtl_name, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Transport Detail" data-placement="bottom"' );
											}
                                                 ?></td>
                                                 <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_tp_amount; ?></span></td>
                                            <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php echo $row->Iso_mvnt_amount; ?></span></td>
                                            
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <td>
                                                <?php 
                                                if($row->Iso_mvnt_status=='A')
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
                                             <a href="view_iso_movement_details?id=<?php echo $row->Iso_mvnt_id; ?>" target="_blank"  alt="View" class="fa fa-search-plus" title="view" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View ISO Movement Detail" data-placement="bottom"> View </a>
                                             <i class="fa fa-ellipsis-v"></i>
                                                
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                <a href="edit_iso_movement_details?id=<?php  echo $row->Iso_mvnt_id; ?>" alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Driver Detail" data-placement="bottom"> Edit </a> <i class="fa fa-ellipsis-v"></i>
                                                <?php 
                                               if($row->Iso_mvnt_status=='A')
                                                {
                                                   echo '<a href="deny_iso_movement_details?id='.$row->Iso_mvnt_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a ISO Movement" data-placement="bottom" > Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_iso_movement_details?id='.$row->Iso_mvnt_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a ISO Movement" data-placement="bottom" > Active </a>';
                                                }
                                                ?>   
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_iso_movement_details?id=<?php echo $row->Iso_mvnt_id;?>" onclick="return confirm('Are you sure you want to delete?')" alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a ISO Movement" data-placement="bottom" > Delete </a>
                                                <?php } ?>
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
        