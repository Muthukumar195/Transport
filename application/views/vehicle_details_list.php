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
                                <h1 class="title">Vehicle Details</h1>                            </div>


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
                                <h2 class="title pull-left">Vehicle Details List</h2>
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
                                            <th>Vehicle Number</th>
                                            <th>Make</th>
                                            <th>Permit</th>
                                            <th>Transports</th>
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
                                            <th>Make</th>
                                            <th>Permit</th>
                                            <th>Transports</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <?php } ?>
                                            
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($vehicle_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo $row->Vehicle_dtl_number; ?></td>
                                            <td><?php if($row->Vehicle_dtl_transport=="T"){ echo $row->Vehicle_dtl_make; }else{ echo '--'; } ?></td>
                                            <td><?php if($row->Vehicle_dtl_transport=="T"){echo $row->Vehicle_dtl_permit; }else{ echo '--'; } ?></td>
                                            <td><?php if($row->Vehicle_dtl_transport=="T"){ echo 'Thirumala'; }else{ echo $row->Transport_dtl_name; } ?></td>
                                             <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <td>
                                                <?php 
                                                if($row->Vehicle_dtl_status=='A')
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
                                           
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                 <td>
                                                <a href="edit_vehicle_details?id=<?php echo $row->Vehicle_dtl_id; ?>" alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Vehicle Detail" data-placement="bottom"> Edit </a> 
                                                <i class="fa fa-ellipsis-v"></i>
                                                <?php 
                                                if($row->Vehicle_dtl_status=='A')
                                                {
                                                   echo '<a href="deny_vehicle?id='.$row->Vehicle_dtl_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Vehicle" data-placement="bottom"> Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_vehicle?id='.$row->Vehicle_dtl_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a Vehicle" data-placement="bottom"> Active </a>';
                                                }
                                                ?>   
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_vehicle?id=<?php echo $row->Vehicle_dtl_id;?>" onclick="return confirm('Are you sure you want to delete?')" alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Vehicle" data-placement="bottom" > Delete </a>
                                                </td>
                                                <?php } ?>
                                            
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
        