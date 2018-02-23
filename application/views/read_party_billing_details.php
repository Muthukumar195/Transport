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
                                <h1 class="title">READ PARTY BILLING DETAILS</h1>                            
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                     <div class="col-lg-12">
                            <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">READ PARTY BILLING DETAILS</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                     <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> 
                                    <i class="box_close fa fa-times"></i>
                                    <?php foreach($read_party_billing->result() as $row){
										 $Par_id=$row->Party_billing_id;
									}
				 					?>
                                    <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/party_billing/read_party_billing_details_print?id=<?php echo $Par_id; ?>');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                                </div>
                            </header>
                            <div class="content-body">    
                             <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                               <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th>Sno</th>
                                        <th>Date</th>
                                        <th>Party Name</th>
                                        <th>Container Number</th>
                                        <th>Consignee</th>
                                        <th>Consignor</th>
                                        <th>material</th>
                                        <th>INV No</th>
                                        <th>PhoneNo</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Bill Received Date</th>
                                        <th>EY Vaild Date</th>
                                        <th>CNS No</th>
                                        <th>Train No</th>
                                        <th>U/L Date</th>
                                        <th>Last Date</th>
                                        <th>Empty</th>
                                        <th>Remark</th>                                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Sno</th>
                                        <th>Date</th>
                                        <th>Party Name</th>
                                        <th>Container Number</th>
                                        <th>Consignee</th>
                                        <th>Consignor</th>
                                        <th>material</th>
                                        <th>INV No</th>
                                        <th>PhoneNo</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Bill Received Date</th>
                                        <th>EY Vaild Date</th>
                                        <th>CNS No</th>
                                        <th>Train No</th>
                                        <th>U/L Date</th>
                                        <th>Last Date</th>
                                        <th>Empty</th>
                                        <th>Remark</th>   
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php  
										$sno=1;                                              
                                        foreach ($read_party_billing->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno;  ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Party_billing_date)); ?></td>
                                            <td><?php echo $row->Party_dtl_name; ?></td>
                                            <td><?php echo $row->Party_billing_container_no; ?></td>
                                            <td><?php echo $row->Party_billing_consignee; ?></td>
                                            <td><?php echo $row->Party_billing_consignor; ?></td>
                                            <td><?php echo $row->Party_billing_material; ?></td>
                                            <td><?php echo $row->Party_billing_ini_no; ?></td>
                                            <td><?php echo $row->Party_billing_ph_no; ?></td>
                                            <td><?php echo $row->Party_billing_from; ?></td>
                                            <td><?php echo $row->Party_billing_to; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Party_billing_bill_recd_dt)); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Party_billing_ey_valid_dt)); ?></td>
                                            <td><?php echo $row->Party_billing_cni_no; ?></td>
                                            <td><?php echo $row->Party_billing_train_no; ?></td>
                                            <td><?php if($row->Party_billing_ul_date=="1970-01-01"){ echo '--'; } else{ echo $row->Party_billing_ul_date; } ?></td>
                                            <td><?php if($row->Party_billing_last_date=="1970-01-01"){ echo '--'; } else{ echo $row->Party_billing_last_date; } ?></td>
                                            <td><?php echo $row->Party_billing_empty; ?></td>
                                             <td><?php echo $row->Party_billing_remark; ?></td>
                                        </tr>
                                   <?php   $sno++; }  ?>
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
  