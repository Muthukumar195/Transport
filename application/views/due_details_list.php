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
                                <h1 class="title">Due Details</h1>                            </div>


                        </div>
                    </div>
                    <div class="clearfix"></div>
 

                    <div class="col-lg-12">

                            <?php if($this->session->flashdata('success_msg')!=null){ ?>
                            <div class="alert alert-success alert-dismissable">
                              <a class="panel-close close" data-dismiss="alert">×</a> 
                              <i class="fa fa-check-square"></i>
                              <strong><?php echo $this->session->flashdata('success_msg'); ?></strong>
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
                                <h2 class="title pull-left">Due Details List </h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">


                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Vehicle Number</th>
                                            <th>Due Date</th>
                                            <th>Mutual Date</th>
                                            <th>Due Amount</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <?php } ?>
                                            
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Vehicle Number</th>
                                            <th>Due Date</th>
                                            <th>Mutual Date</th>
                                            <th>Due Amount</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <?php } ?>
                                            
                                        </tr>
                                    </tfoot>
 
                                    <tbody>
                                    <?php 
                                        $sno=1;                                          
                                        foreach ($due_details_list->result() as $row)
                                        { 
										                                                             
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td>
                                            <?php 
                                                echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank" alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
                                             ?>
                                             </td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Vehicle_due_dtl_due_date)); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Vehicle_due_dtl_mutual_date)); ?></td>
                                            <td><?php echo $row->Vehicle_due_dtl_amount; ?></td> 
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <td>
                                                <?php 
                                                if($row->Vehicle_due_dtl_status=='A')
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
												echo anchor('due_details/view_due_details?id='.$row->Vehicle_due_dtl_vehicle_no.'&vhl_no='.$row->Vehicle_dtl_number.'','View','class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Due Details" data-placement="bottom"');
												?>
                                                <i class="fa fa-ellipsis-v"></i>
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                 <!--<a href="edit_due_details?id=<?php //echo $row->Vehicle_due_dtl_id
; ?>"alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Due Detail" data-placement="bottom"> Edit </a> -->
                                          
                                                <?php 
                                                if($row->Vehicle_due_dtl_status
=='A')
                                                {
                                                   echo '<a href="deny_due?id='.$row->Vehicle_due_dtl_vehicle_no
.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Due" data-placement="bottom"  > Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_due?id='.$row->Vehicle_due_dtl_vehicle_no
.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a Due" data-placement="bottom" > Active </a>';
                                                }
                                                ?>   
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_due?id=<?php echo $row->Vehicle_due_dtl_vehicle_no
;?>" onclick="return confirm('Are you sure you want to delete?')" alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Due Detail" data-placement="bottom" > Delete </a>

                                            <?php } ?>
                                           </td> 
                                        </tr>
                                    <?php $sno++; }  ?>
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
        