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
                                <h1 class="title">View Party Details</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                                <?php                                                                                         
                                    foreach ($view_party_details->result() as $row)
                                    {                                                               
                                ?>
                                    <div class="mail_content">

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="mail_head" style="margin-bottom:2%; font-weight:bold;"><?php echo $row->Party_dtl_name; ?></h3>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h4><strong >Phone Number</strong> : <?php echo $row->Party_dtl_phone_no; ?></h4>
                                                    <h4><strong>Address</strong> : <?php echo $row->Party_dtl_address; ?></h4>
                                                    
                                    <?php /*?>  <table class="table table-bordered" style="width:50%"; >
                                      <thead>
                                      <tbody>
                                      <tr>
									  <th>Place Name</th>
                                      <th>Advance Date</th>
                                      <th>party Advance</th>
                                      <th>Party Balance</th>
                                      <th>&nbsp;Rent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                      </tr>
                                       <?php
									   	$grnd_bal_amt=0;
										$grnd_adt_amt=0;
										$grnd_tot_amt=0;
									    foreach ($view_party_advance->result() as $adv) { ?>
                                      <tr>
									  <td><?php echo $adv->Driver_pay_rate_place_name; ?></td>
                                      <td><?php echo date('d-M-Y', strtotime($adv->Daily_mvnt_dtl_date)); ?></td>
                                      <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php
									  $grnd_adt_amt=$grnd_adt_amt+intval($adv->Daily_mvnt_dtl_party_adv);
									   
									  echo  $adv->Daily_mvnt_dtl_party_adv; ?></span></td>
                                      <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php 
									  $bal_amnt=intval($adv->Daily_mvnt_dtl_rent)-intval($adv->Daily_mvnt_dtl_party_adv);
									  $grnd_bal_amt = $grnd_bal_amt+$bal_amnt;
									  echo  $bal_amnt; ?></span></td>
                                      <td><span class="text-primary"><i class="fa fa-inr"></i>&nbsp;<?php 
									 $grnd_tot_amt=$grnd_tot_amt+intval($adv->Daily_mvnt_dtl_rent);
									 echo $adv->Daily_mvnt_dtl_rent;
									  ?></span></td>
                                      
                                      </tr>
                                       <?php } ?>
                                      </tbody> 
                                      </thead>
                                      </table>
                                       <h4><strong>Party Total Rent</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $grnd_tot_amt; ?></span></h4>
                                       <h4><strong>Party Total Advance</strong> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $grnd_adt_amt; ?></span></h4>
                                      <h4><span style='color:green;'><strong>Party Net Balance</strong></span> :&nbsp;<span class="text-primary"><i class="fa fa-inr"></i> <?php echo $grnd_bal_amt; ?></span></h4><?php */?>
                                      
                                                </div>
                                            </div> 

                                        </div>

                                    <?php } ?>
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                            


                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        