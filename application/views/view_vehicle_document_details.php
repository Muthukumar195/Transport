<?php 
include('include/header.php');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />

        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">View Vehicle Document Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
<div id='printablediv'>

                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                                <?php                                                                                         
                                    foreach ($view_vehicle_document_details->result() as $row)
                                    {                                                               
                                ?>
                                    <div class="mail_content">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                 <a  style="float:right;" href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/vehicle_document_details/view_vehicle_document_details_print?id=<?php echo $row->Vehicle_doc_dtl_id;?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                                    <h3  style=" font-weight:bold;"><?php echo $row->Vehicle_dtl_number; ?></h3> 
                                                </div> 
                                            </div>
                                              <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                      <thead>
                                      <tbody>
                                      <tr>
									  <th>Vehicle Document </th>
                                      <th>From</th>
                                      <th>To </th>
                                      </tr>
                                      <tr>
                                      <td>M.Permit</td>
									  <td><?php if($row->Vehicle_doc_dtl_m_permit_from=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_m_permit_from)); } ?></td>
                                      <td><?php if($row->Vehicle_doc_dtl_m_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_m_permit_to)); } ?></td>
                                      </tr>
                                       <tr>
                                      <td>N.Permit</td>
									  <td><?php if($row->Vehicle_doc_dtl_n_permit_from=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_n_permit_from)); } ?></td>
                                      <td><?php if($row->Vehicle_doc_dtl_n_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_n_permit_to)); } ?></td>
                                      </tr>
                                       <tr>
                                      <td>AP.permit</td>
									  <td><?php if($row->Vehicle_doc_dtl_ap_permit_from=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_ap_permit_from)); } ?></td>
                                      <td><?php if($row->Vehicle_doc_dtl_ap_permit_to=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_ap_permit_to)); } ?></td>
                                      </tr>
                                       <tr>
                                      <td>Insurance</td>
									  <td><?php if($row->Vehicle_doc_dtl_insurance_from=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_insurance_from)); } ?></td>
                                      <td><?php if($row->Vehicle_doc_dtl_insurance_to=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_insurance_to)); } ?></td>
                                      </tr>
                                       <tr>
                                      <td>FC</td>
									  <td><?php if($row->Vehicle_doc_dtl_fc_from=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_fc_from)); } ?></td>
                                      <td><?php if($row->Vehicle_doc_dtl_fc_to=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_fc_to)); } ?></td>
                                      </tr>
                                      <tr>
                                      <td>Tax</td>
									  <td><?php if($row->Vehicle_doc_dtl_tax_from=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_tax_from)); } ?></td>
                                      <td><?php if($row->Vehicle_doc_dtl_tax_to=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_tax_to)); } ?></td>
                                      </tr>
                                        <tr>
                                      <td>Pollution Certificate</td>
									  <td><?php if($row->Vehicle_doc_dtl_pc_from=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_pc_from)); } ?></td>
                                      <td><?php if($row->Vehicle_doc_dtl_pc_to=="1970-01-01"){ echo '--'; } else{ echo date('d-M-Y', strtotime($row->Vehicle_doc_dtl_pc_to)); } ?></td>
                                      </tr>
                                      </tbody> 
                                      </thead>
                                      </table> 

                                        </div>

                                  <?php } ?>   
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                      </div>


                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        