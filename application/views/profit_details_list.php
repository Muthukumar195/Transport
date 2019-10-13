<?php 
include('include/header.php');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/print_script.js" ></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/printer.css" />


        <!-- START CONTAINER -->
        <div class="page-container row-fluid" >

            <?php include('include/sidebar.php');?>
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title" >Profit  Report</h1>       
                                <p id="demo"></p>                
                            </div>
                            <div class="pull-right">
                              <a href="profit_details_list"><button class="btn btn-info">Reset Search</button> </a>            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('profit/profit_details_list', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4"  >
                <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">From date:</label>
                <div class="col-lg-8 col-md-8 col-sm-8"  >              
                   <?php  
					$data1 = array(
							'name'        => 'from_date',
							'id'          => 'from_date',
							'value'       => set_value('from_date'),
							'maxlength'   => '20',
							'class'       => 'form-control datepicker',
							'data-format' => 'dd MM yyyy',
							'placeholder' => 'Select from Date',
							'readonly'    => 'readonly'
						  ); 
					echo form_input($data1);?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">To date:</label>
                <div class="col-lg-8 col-md-8 col-sm-8" >              
                   <?php  
					$data1 = array(
							'name'        => 'to_date',
							'id'          => 'to_date',
							'value'       => set_value('to_date'),
							'maxlength'   => '20',
							'class'       => 'form-control datepicker',
							'data-format' => 'dd MM yyyy',
							'placeholder' => 'Select to Date',
							'readonly'    => 'readonly'
						  ); 
					echo form_input($data1);?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">Transport:</label>
                <div class="col-lg-8 col-md-8 col-sm-8" >                 
                    <?php                
                $options_transport_nme['']='Select Transport Name';
                foreach($transport_name_list->result() as $transport_nme)
                {                  
                  $options_transport_nme[$transport_nme->Transport_dtl_id] = $transport_nme->Transport_dtl_name;                   
                } 
                echo form_dropdown('transport', $options_transport_nme, set_value('transport'), 'class="form-control" id="transport_name"');
              ?> 
                </div>
              </div> 
            </div>
            </div>
            <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4"  >
                <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">Driver Name:</label>
                <div class="col-lg-8 col-md-8 col-sm-8"  >              
                   <?php                
                $options_driver_nme['']='Select Driver Name';
                foreach($driver_list->result() as $driver_nme)
                {                  
                  $options_driver_nme[$driver_nme->Driver_dtl_id] = $driver_nme->Driver_dtl_name;                   
                } 
                echo form_dropdown('driver', $options_driver_nme, set_value('driver'), 'class="form-control" id="driver_name"');
              ?> 
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">Party Name:</label>
                <div class="col-lg-8 col-md-8 col-sm-8" >              
                     <?php                
                $options_party_nme['']='Select Party Name';
                foreach($party_name_list->result() as $party_nme)
                {                  
                  $options_party_nme[$party_nme->Party_dtl_id] = $party_nme->Party_dtl_name;                   
                } 
                echo form_dropdown('party', $options_party_nme, set_value('party'), 'class="form-control" id="party_name"');
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">Place Name:</label>
                <div class="col-lg-8 col-md-8 col-sm-8" >              
                     <?php                
                $options_place['']='Select Place Name';
                foreach($place_name_list->result() as $place)
                {                  
                  $options_place[$place->Driver_pay_rate_id] = $place->Driver_pay_rate_place_name;                   
                } 
                echo form_dropdown('place', $options_place, set_value('place'), 'class="form-control" id="place_name"');
              ?> 
                </div>
              </div> 
            </div>
            </div>
            <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">Vehicle No:</label>
                <div class="col-lg-8 col-md-8 col-sm-8" >              
                     <?php                
                $options_veh_no['']='Select Vehicle No';
                foreach($daily_movement_details_list->result() as $veh_no)
                {                  
                  $options_veh_no[$veh_no->Vehicle_dtl_id] = $veh_no->Vehicle_dtl_number;                   
                } 
                echo form_dropdown('veh_no', $options_veh_no, set_value('veh_no'), 'class="form-control" id="veh_no"');
              ?> 
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-4 col-md-4 col-sm-4 control-label">Transport Type:</label>
                <div class="col-lg-8 col-md-8 col-sm-8" >              
                   <input type="radio" name="trans_type" value="T"> Thirumala  
                    <input type="radio" name="trans_type" value="O">Other 
                </div>
              </div> 
            </div>
            </div>

            <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4"  >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label"></label>
                <div class="col-lg-6 col-md-6 col-sm-6"  >
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label"></label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                    <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>  
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
               
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                 
                </div>
              </div> 
            </div>
          </div>
      </form>  
       <div id='printablediv'>
         <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Daily Movement details</h2>
                                <div class="actions panel_actions pull-right">
                                 <a  href='#' onclick='javascript:printDiv("printablediv")'style="float:right; text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' >&nbsp;Print</a>
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
								
                                        <div class="table-responsive" data-pattern="priority-columns">
                                            <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped" style="font-size:11px;">
                                                <thead>
                                                    <tr>
                                                        <th>S. No</th>
                                                        <th>Movement Date</th>
                                                        <th data-priority="1">Transport Type</th>
                                                        <th data-priority="1">Vehicle No</th>
                                                        <th data-priority="1">Place Name</th>
                                                        <th data-priority="3">Party name</th>
                                                        <th data-priority="3">Driver Name</th>
                                                        <th data-priority="6">Party Rent</th>
                                                        <th data-priority="6">Driver rent</th>
                                                        <th data-priority="6">Transport rent</th>
                                                        <th data-priority="6">Expences</th>
                                                        <th data-priority="6">Mamul</th>
                                                        <th data-priority="6">Profit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sno=1; 
												$p_rent='';  $d_rent=''; $t_rent='';  $o_ex='';  $tot_profit='';  $d_rent_cal=''; $mamul='';                                            
											      foreach ($daily_movement_details_list->result() as $row){                                                               
										         ?>
                                                    <tr>
                                                        <td> <?php  echo $sno; ?></td>
                                                        <th><?php 
														 echo date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date));
														  ?></th>
                                                        <td>
														<?php if($row->Daily_mvnt_dtl_transport_type=="T"){ echo "Thirumala";}
																	else{ echo $row->Transport_dtl_name;} ?>
                                                        </td>
                                                        <td><?php 
                                                    echo  $row->Vehicle_dtl_number; ?> 
                                                       </td>
                                                        <td><?php 
                                                    echo $row->Driver_pay_rate_place_name; ?> 
                                                    	</td>
                                                        <td><?php echo  $row->Party_dtl_name;  ?>
                                                        </td>
                                                        <td><?php 
														if(empty($row->Daily_mvnt_dtl_driver_name)=='True'){
															echo "--";
														}
														else{
													echo $row->Driver_dtl_name;	} ?>
                                                    	</td>
                                                        <td><span class="text-info"> 
														<?php echo $row->Daily_mvnt_dtl_rent?></span></td>
                                                        <td><span class="text-purple">
                                                         <?php 
														if(empty($row->Daily_mvnt_dtl_driver_name)=='True'){
															echo "--"; $d_rent_cal=0;
														}else{
														 echo $d_rent_cal = $row->Daily_mvnt_dtl_driver_total_pay;
														}
												 		 ?></span></td>
                                                         <td><span class="text-orange">
                                                         <?php echo $row->Daily_mvnt_dtl_trp_rent; ?></span></td>
                                                        <td><span class="text-purple">
                                                         <?php
														 if(($row->Daily_mvnt_dtl_driver_name=='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															 $expences = 'T:'.$row->Daily_mvnt_dtl_trp_expences;
														 }
														 if(($row->Daily_mvnt_dtl_driver_name!='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															$expences = 'D:'.$row->Daily_mvnt_dtl_trp_expences.'/ T:'.$row->Daily_mvnt_dtl_trp_expences; 
														 }
														 if($row->Daily_mvnt_dtl_transport_type=="T"){
														 $expences ='D:'.$row->Daily_mvnt_dtl_other_expences;
														 }
														 echo $expences;
														   ?></span></td>
                                                            <td><span class="text-info">
                                                         <?php echo $row->Daily_mvnt_dtl_party_mamul; ?></span></td>
                                                        <td><span class="text-success">
														<?php
														//other Transport
														if(($row->Daily_mvnt_dtl_driver_name=='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															if($row->Daily_mvnt_dtl_trp_sum=='A'){
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_expences);
															}else{
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)+intval($row->Daily_mvnt_dtl_trp_expences);
															}
														}
														if(($row->Daily_mvnt_dtl_driver_name!='')&&($row->Daily_mvnt_dtl_transport_type=="O")){
															if($row->Daily_mvnt_dtl_trp_sum=='A'){
																$trns_cal = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_expences);
															}else{
																$trns_cal = intval($row->Daily_mvnt_dtl_trp_rent)+intval($row->Daily_mvnt_dtl_trp_expences);
															}
															
															$dr_cal = intval($row->Daily_mvnt_dtl_driver_total_pay)+intval($row->Daily_mvnt_dtl_other_expences);
															$balance = intval($trns_cal)+intval($dr_cal);
														}
														//Thirumala Transport
														if($row->Daily_mvnt_dtl_transport_type=="T"){
														 $balance = intval($row->Daily_mvnt_dtl_driver_total_pay)+intval($row->Daily_mvnt_dtl_other_expences);
														}
														
														 
														 
														 //sabari and murugan transport
														 if(($row->Daily_mvnt_dtl_transport_type=="O")&&($row->Daily_mvnt_dtl_trp_name=="13")||($row->Daily_mvnt_dtl_trp_name=="14")){
															if($row->Daily_mvnt_dtl_trp_sum=='A'){
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_trp_expences);
															}else{
															 $balance = intval($row->Daily_mvnt_dtl_trp_rent)+intval($row->Daily_mvnt_dtl_trp_expences);																																						                                                                 } 															
														   }
														 $tot_rent = intval($row->Daily_mvnt_dtl_rent)-intval($balance);  
														echo $profit = intval($tot_rent)+intval($row->Daily_mvnt_dtl_party_mamul)
														 ?></span></td>
                                                    </tr> 
                                                    <?php 
													$p_rent = intval($p_rent)+intval($row->Daily_mvnt_dtl_rent);
													$d_rent = intval($d_rent)+intval($d_rent_cal);
													$t_rent = intval($t_rent)+intval($row->Daily_mvnt_dtl_trp_rent);
													$o_ex = intval($o_ex)+intval($row->Daily_mvnt_dtl_other_expences)+intval($row->Daily_mvnt_dtl_trp_expences);
													$mamul = intval($mamul)+intval($row->Daily_mvnt_dtl_party_mamul);
													$tot_profit = intval($tot_profit)+intval($profit);
													?>
                                                    <?php $sno++; } ?>
                                                </tbody>
                                            </table>
                                         
                                        </div>
                                           <table class="table table-bordered table-striped">
                                             <tr>
                                               <th ><span style="float:right;"  class="text-success">Total </span></th>
                                                <th><span class="text-info">Party = &nbsp;<?php if($p_rent!=''){ echo number_format($p_rent);} else{ echo '0';}?></span></th>
                                                <th><span class="text-purple">Driver = &nbsp;<?php if($d_rent!=''){ echo number_format($d_rent);} else{ echo '0';}?></span></th>
                                                <th><span class="text-orange">Tranport = &nbsp;<?php if($t_rent!=''){ echo number_format($t_rent);} else{ echo '0';}?></span></th>
                                                <th><span class="text-purple">Other Ex = &nbsp;<?php if($o_ex!=''){ echo number_format($o_ex);} else{ echo '0';}?></span></th>
                                                <th><span class="text-info">Mamul = &nbsp;<?php if($mamul!=''){ echo number_format($mamul);} else{ echo '0';}?></span></th>
                                                <th><span class="text-success">Profit = &nbsp;<?php if($tot_profit!=''){ echo number_format($tot_profit);} else{ echo '0';} ?></span></th>
                                                </tr>
                                            </table>

                                    </div>
                                </div>
                            </div>
                        </section>
                       </div>
                        <div id='prinsmtablediv'>
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Sabari & Murugan Transport Details</h2>
                                <div class="actions panel_actions pull-right">
                                 <a  href='#' onclick='javascript:printDiv("prinsmtablediv")'style="float:right; text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' >&nbsp;Print</a>
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="table-responsive" data-pattern="priority-columns">
                                            <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Movement Date</th>
                                                        <th data-priority="1">Transport</th>
                                                        <th data-priority="1">Party name</th>
                                                        <th data-priority="3">Driver Name</th>
                                                        <th data-priority="3">Party Rent</th>
                                                        <th data-priority="6">Driver Rent</th>
                                                        <th data-priority="6">Transport rent</th>
                                                        <th data-priority="6">Sabari profit</th>
                                                        <th data-priority="6">Murugan profit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sno=1;  
												$pr=''; $tr=''; $dr=''; $st_total=''; $mt_total='';                     
											      foreach ($sm_transport_list->result() as $row){                                                               
										         ?>
                                                    <tr>
                                                        <td><?php  echo $sno; ?></td>
                                                        <th><?php 
														 echo  date('d-m-Y', strtotime($row->Daily_mvnt_dtl_date));
														  ?></th>
                                                        <td>
														<?php  echo $row->Transport_dtl_name; ?>
                                                        </td>
                                                        <td>
                                                        <?php echo $row->Party_dtl_name; ?>
                                                       </td>
                                                        <td><?php  echo $row->Driver_dtl_name; ?></td>
                                            			<td><span class="text-info"> <?php echo $row->Daily_mvnt_dtl_rent; ?></span></td>
                                                        
                                                        <td><span class="text-purple"> 
														<?php echo $row->Daily_mvnt_dtl_driver_total_pay; ?></span></td>
                                                         <td><span class="text-orange">
                                                         <?php echo $row->Daily_mvnt_dtl_trp_rent; ?></span></td>
                                                         <td><span class="text-success">
														<?php													
														$st='';
														if($row->Daily_mvnt_dtl_trp_name==13){
															$st = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_driver_total_pay);
															echo $st;
														}
														else{ echo '--'; }?>
														</span></td>
                                                        <td><span class="text-success">
														<?php
														
														$mt='';
														if($row->Daily_mvnt_dtl_trp_name==14){
															$mt = intval($row->Daily_mvnt_dtl_trp_rent)-intval($row->Daily_mvnt_dtl_driver_total_pay);
															echo $mt;
														}
														else{ echo '--'; }?></span></td>
                                                    </tr> 
                                                    <?php 
													$pr = intval($pr)+intval($row->Daily_mvnt_dtl_rent);
													$tr = intval($tr)+intval($row->Daily_mvnt_dtl_trp_rent);
													$dr = intval($dr)+intval($row->Daily_mvnt_dtl_driver_total_pay);
													$st_total = intval($st_total)+intval($st);
													$mt_total = intval($mt_total)+intval($mt);
													?>
                                                    <?php $sno++; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                         <table class="table table-bordered table-striped">
                                             <tr>
                                               <th ><span style="float:right;"  class="text-success">Total </span></th>
                                                <th><span class="text-info">Party = &nbsp;<?php  if($pr!=''){ echo number_format($pr);} else{ echo '0';}?></span></th>
                                                <th><span class="text-purple">Driver = &nbsp;<?php  if($dr!=''){ echo number_format($dr);} else{ echo '0';}?></span></th>
                                                <th><span class="text-orange">Tranport = &nbsp;<?php  if($tr!=''){ echo number_format($tr);} else{ echo '0';}?></span></th>
                                                <th><span class="text-info">Sahabari Profit = &nbsp;<?php  if($st_total!=''){ echo number_format($st_total);} else{ echo '0';}?></span></th>
                                                <th><span class="text-success">Murugan Profit = &nbsp;<?php  if($mt_total!=''){ echo number_format($mt_total);} else{ echo '0';}?></span></th>
                                               
                                              
                                                </tr>
                                            </table>

                                    </div>
                                </div>
                            </div>
                        </section>
                        </div>
                         <div id='prinisotablediv'>
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Iso Movement Details</h2>
                                <div class="actions panel_actions pull-right">
                                 <a  href='#' onclick='javascript:printDiv("prinisotablediv")'style="float:right; text-decoration:none; color:#000000;" ><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' >&nbsp;Print</a>
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div class="content-body">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="table-responsive" data-pattern="priority-columns">
                                            <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Movement Date</th>
                                                        <th data-priority="1">Transport Type</th>
                                                        <th data-priority="1">Vehicle No</th>
                                                        <th data-priority="3">Pickup</th>
                                                        <th data-priority="3">Drop</th>
                                                        <th data-priority="6">Iso Amount</th>
                                                        <th data-priority="6">Transport rent</th>
                                                        <th data-priority="6">Profit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sno=1; 
												$i_rent =''; $t_rent='';  $tot_profit_1='';                                            
											      foreach ($iso_movement_details_list->result() as $row){                                                               
										         ?>
                                                    <tr>
                                                        <td><?php  echo $sno; ?></td>
                                                        <th><?php 
														 echo date('d-m-Y', strtotime($row->Iso_mvnt_date));
														  ?></th>
                                                        <td>
														<?php if($row->Iso_mvnt_vehicle_type=="T"){ echo "Thirumala";}
																	else{ echo $row->Transport_dtl_name;} ?>
                                                        </td>
                                                        <td> <?php 
											if($row->Iso_mvnt_vehicle_type=='O'){
												
												echo $row->Iso_mvnt_other_vehicle_no;
												}
											else{ 
                                                    echo  $row->Vehicle_dtl_number; 
												}?> 
                                                       </td>
                                                        <td><?php if($row->Iso_mvnt_pickup_place){ echo $row->Iso_mvnt_pickup_place; } else{ '--';} ?></td>
                                            			<td><?php if($row->Iso_mvnt_drop_place){ echo $row->Iso_mvnt_drop_place; } else{ '--';} ?></td>
                                                        
                                                        <td><span class="text-info"> 
														<?php echo $row->Iso_mvnt_amount?></span></td>
                                                         <td><span class="text-orange">
                                                         <?php echo $row->Iso_mvnt_tp_amount; ?></span></td>
                                                        
                                                        <td><span class="text-success">
														<?php
														echo $profit_1 = intval($row->Iso_mvnt_amount)-intval($row->Iso_mvnt_tp_amount)
														 ?></span></td>
                                                    </tr> 
                                                    <?php 
													$i_rent = intval($i_rent)+intval($row->Iso_mvnt_amount);
													$t_rent = intval($t_rent)+intval($row->Iso_mvnt_tp_amount);
													$tot_profit_1 = intval($tot_profit_1)+intval($profit_1);
													?>
                                                    <?php $sno++; } ?>
                                                </tbody>
                                                 <tfoot>
                                                <tr>
                                                   <th colspan="5" align="right"><span style="float:right;"  class="text-success">Total </span></th>
                                                    <th><span class="text-info"><i class="fa fa-inr"></i> <?php echo $i_rent;?></span></th>
                                                    <th><span class="text-orange"><i class="fa fa-inr"></i> <?php echo $t_rent;?></span></th>
                                                    <th><span class="text-success"><i class="fa fa-inr"></i> <?php echo $tot_profit_1;?></span></th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                        </div>
                                         <table class="table table-bordered table-striped">
                                             <tr>
                                               <th ><span style="float:right;"  class="text-success">Total </span></th>
                                                <th><span class="text-info">Iso = &nbsp;<?php if($i_rent!=''){ echo number_format($i_rent);} else{ echo '0';}?></span></th>
                                                <th><span class="text-orange">Tranport = &nbsp;<?php if($t_rent!=''){ echo number_format($t_rent);} else{ echo '0';}?></span></th>
                                                <th><span class="text-info"> Profit = &nbsp;<?php if($tot_profit_1!=''){ echo number_format($tot_profit_1);} else{ echo '0';};?></span></th>
                                                </tr>
                                            </table>

                                    </div>
                                </div>
                            </div>
                        </section>
                        </div>
                        <?php $gross_profit = intval($tot_profit)+intval($tot_profit_1); ?>
                        <h2>Total Profit : <strong><span class="text-orange" id="profit"><i class="fa fa-inr"></i><?php echo $gross_profit?></span> </strong></h2>
                         </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        