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
                                <h1 class="title">Vehicle Document</h1>                            
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
                                <h2 class="title pull-left">Vehicle Document Details List</h2>
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
                                            <th>M.Permit</th>
                                            <th>N.permit</th>
                                            <th>AP.permit</th>
                                            <th>Insurance</th>
                                            <th>FC</th>
                                            <th>Tax</th>
                                            <th>Pollution Certificate</th>
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
                                            <th>M.Permit</th>
                                            <th>N.permit</th>
                                            <th>AP.permit</th>
                                            <th>Insurance</th>
                                            <th>FC</th>
                                            <th>Tax</th>
                                            <th>Pollution Certificate</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <?php } ?>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        $sno=1; 
										                                            
                                        foreach ($vehicle_document_details_list->result() as $row)
                                        { 									                                           
                                    ?>
                                      <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td>
                                            <?php 
                                                echo anchor('vehicle_details/view_vehicle_details?id='.$row->Vehicle_dtl_id.'', $row->Vehicle_dtl_number, 'target="_blank"  alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Vehicle Detail" data-placement="bottom"' );
                                             ?>
                                            </td>
                                            <td><?php if($row->Vehicle_doc_dtl_m_permit_from=="1970-01-01"&&$row->Vehicle_doc_dtl_m_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_m_permit_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_m_permit_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_n_permit_from=="1970-01-01"&&$row->Vehicle_doc_dtl_n_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_n_permit_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_n_permit_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_ap_permit_from=="1970-01-01"&&$row->Vehicle_doc_dtl_ap_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_ap_permit_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_ap_permit_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_insurance_from=="1970-01-01"&&$row->Vehicle_doc_dtl_insurance_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_insurance_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_insurance_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_fc_from=="1970-01-01"&&$row->Vehicle_doc_dtl_fc_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_fc_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_fc_to)); } ?></td>
                                           <td><?php if($row->Vehicle_doc_dtl_tax_from=="1970-01-01"&&$row->Vehicle_doc_dtl_tax_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_tax_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_tax_to)); } ?></td>
                                            <td><?php if($row->Vehicle_doc_dtl_pc_from=="1970-01-01"&&$row->Vehicle_doc_dtl_pc_to=="1970-01-01"){ echo '--'; } else{ echo date('d-m-Y', strtotime($row->Vehicle_doc_dtl_pc_from)).' To '.date('d-m-Y', strtotime($row->Vehicle_doc_dtl_pc_to)); } ?></td>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>                          
                                            <td>
                                               <?php 
                                                 if($row->Vehicle_doc_dtl_status=='A')
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
                                                 <?php
												echo anchor('vehicle_document_details/view_vehicle_document_details?id='.$row->Vehicle_doc_dtl_id,'View','class="fa fa-search-plus" target="_blank" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View  Vehicle Document Details" data-placement="bottom"');
												?>
                                             <i class="fa fa-ellipsis-v"></i>
                                                <a href="edit_vehicle_document_details?id=<?php echo $row->Vehicle_doc_dtl_id; ?>" alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Vehicle Document Detail" data-placement="bottom"> Edit </a> 
                                                <i class="fa fa-ellipsis-v"></i>
                                                <?php 
                                                if($row->Vehicle_doc_dtl_status=='A')
                                                {
                                                   echo '<a href="deny_vehicle_document_details?id='.$row->Vehicle_doc_dtl_id.'"  alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Vehicle Document" data-placement="bottom" > Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_vehicle_document_details?id='.$row->Vehicle_doc_dtl_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a Vehicle Document" data-placement="bottom" > Active </a>';
                                                }
                                                ?>   
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_message?id=<?php echo $row->Vehicle_doc_dtl_id;?>" onclick="return confirm('Are you sure you want to delete?')" alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Vehicle Document" data-placement="bottom" > Delete </a>
                                                 </td>
                                                <?php } ?>
                                           
                                        </tr>
                                    <?php $sno++;   } ?>
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
        