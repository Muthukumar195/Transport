<!-- SIDEBAR - START -->
            <div class="page-sidebar ">


                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                        <?php foreach($get_admin_profile->result() as $row){ ?>
                            <a href="#">
                               <img src="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" title="Profile Picture" alt="<?php echo $row->Admin_profile; ?>" class="img-responsive img-circle" />
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3>
                                <a href="#"> <?php echo $row->Admin_fullname; ?></a>

                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>

                            <p class="profile-title"></p>
 
                        </div>
                        <?php } ?>

                    </div>
                    <!-- USER INFO - END -->

                    <?php //$anchor_act_cls='';
                    // start for check user rights
                    $user_typ_ary=explode(',', $this->session->userdata('user_rights_dtl'));                    
                    // end for check user rights
                     ?>

                    <ul class='wraplist'> 
                  
                        <li <?php if($page_name=='dashboard'){ echo 'class="open"'; } ?> > 
                            <!-- <a href="dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a> -->
                            <?php echo anchor('tranport_main/dashboard', '<i class="fa fa-dashboard"></i> <span class="title">Dashboard</span>'); ?>                            
                        </li>
                    <?php 
                      if((in_array("Driver Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                      { 
                    ?> 
                        <li <?php if(($page_name=='driver_details_list')||($page_name=='add_driver_details')||($page_name=='edit_driver_details')||($page_name=='view_driver_details')||($page_name=='validate_driver_details')||($page_name=='validate_edit_driver_details')||($page_name=='view_report')){ echo 'class="open"'; } ?> > 
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span class="title">Driver Details</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>                                    
                                    <?php 
                                     if(($page_name=='driver_details_list')||($page_name=='validate_driver_details')||($page_name=='view_driver_details')||($page_name=='validate_driver_details')||($page_name=='validate_edit_driver_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('driver_details/driver_details_list', 'View', ''.$anchor_act_cls.'' ); ?>
                                </li>
                                <li>                                    
                                    <?php
                                    if($page_name=='add_driver_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('driver_details/add_driver_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>                                    
                                    <?php
                                    if($page_name=='view_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('driver_details/view_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li>
                    <?php 
                    } // for check driver details rights 
                    ?>
                    <?php 
                      if((in_array("Driver Pay Rate", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                      { 
                    ?>
                        <li <?php if(($page_name=='driver_pay_rate_list')||($page_name=='add_driver_pay_rate')||($page_name=='validate_edit_driver_pay_rate')||($page_name=='edit_driver_pay_rate')||($page_name=='view_driver_pay_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-road"></i>
                                <span class="title">Driver Pay Rate</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                   <?php 
                                   if(($page_name=='driver_pay_rate_list')||($page_name=='view_driver_pay_details')||($page_name=='validate_edit_driver_pay_rate')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('driver_pay_rate/driver_pay_rate_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php
                                    if($page_name=='add_driver_pay_rate'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('driver_pay_rate/add_driver_pay_rate', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                               
                                
                            </ul>
                        </li>
                    <?php } // check for driver pay rights ?>
                     <?php 
                      if((in_array("Driver Payment", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                      { 
                    ?>
                        <li <?php if(($page_name=='driver_payment_list')||($page_name=='validate_edit_driver_payment')||($page_name=='edit_driver_payment')||($page_name=='driver_payment_report')||($page_name=='view_driver_payment')||($page_name=='add_driver_payment_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-inr"></i>
                                <span class="title">Driver Payment</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                   <?php 
                                   if(($page_name=='driver_payment_list')||($page_name=='view_driver_payment')||($page_name=='validate_edit_driver_payment')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('driver_payment/driver_payment_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                 <li>
                                    <?php
                                    if($page_name=='add_driver_payment_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('driver_payment/add_driver_payment_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                <?php /*?> <li>                                    
                                    <?php
                                    if($page_name=='driver_payment_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('driver_payment/driver_payment_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li><?php */?>
                                
                            </ul>
                        </li>
                    <?php } // check for party pay rights ?>
                     <?php 
                      if((in_array("Party Pay rate", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                      { 
                    ?>
                        <li <?php if(($page_name=='party_pay_rate_list')||($page_name=='validate_edit_party_pay_rate')||($page_name=='edit_party_pay_rate')||($page_name=='party_pay_rate_report')||($page_name=='view_party_pay_rate')||($page_name=='add_party_pay_rate')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-inr"></i>
                                <span class="title">Party Pay rate</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                   <?php 
                                   if(($page_name=='party_pay_rate_list')||($page_name=='view_party_pay_rate')||($page_name=='validate_edit_party_pay_rate')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('party_pay_rate/party_pay_rate_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                 <li>
                                    <?php
                                    if($page_name=='add_party_pay_rate'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('party_pay_rate/add_party_pay_rate', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                <?php /*?> <li>                                    
                                    <?php
                                    if($page_name=='driver_payment_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('driver_payment/driver_payment_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li><?php */?>
                                
                            </ul>
                        </li>
                    <?php } // check for party pay rights ?>
                    <?php 
                      if((in_array("Vehicle Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                      { 
                    ?>
                        <li <?php if(($page_name=='vehicle_details_list')||($page_name=='add_vehicle_details')||($page_name=='edit_vehicle_details')||($page_name=='view_vehicle_details')||($page_name=='validate_edit_vehicle_details')||($page_name=='deny_vehicle')||($page_name=='approve_vehicle')||($page_name=='view_vehicle_report')){ echo 'class="open"'; } ?> > 
                            <a href="javascript:;">
                                <i class="fa fa-bus"></i>
                                <span class="title">Vehicle Details</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>                                    
                                    <?php
                                    if(($page_name=='vehicle_details_list')||($page_name=='view_vehicle_details')||($page_name=='validate_edit_vehicle_details')||($page_name=='deny_vehicle')||($page_name=='approve_vehicle')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                    echo anchor('vehicle_details/vehicle_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php  
                                    if($page_name=='add_vehicle_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                    echo anchor('vehicle_details/add_vehicle_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>                                    
                                    <?php
                                    if($page_name=='view_vehicle_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('vehicle_details/view_vehicle_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } // check for vehicle details rights ?>
                        <?php 
                          if((in_array("Vehicle Document Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>

                        <li <?php if(($page_name=='vehicle_document_details_list')||($page_name=='add_vehicle_document_details')||($page_name=='edit_vehicle_document_details')||($page_name=='view_vehicle_document_details')||($page_name=='validate_edit_vehicle_document_details')||($page_name=='view_vehicle_document_report')){ echo 'class="open"'; } ?> > 
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span class="title">Vehicle Documents</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                  <?php
                                  if(($page_name=='vehicle_document_details_list')||($page_name=='view_vehicle_document_details')||($page_name=='edit_vehicle_document_details')||($page_name=='validate_edit_vehicle_document_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('vehicle_document_details/vehicle_document_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php
                                    if($page_name=='add_vehicle_document_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('vehicle_document_details/add_vehicle_document_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php
                                    if(($page_name=='view_vehicle_document_report')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('vehicle_document_details/view_vehicle_document_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } // for check vehicle document rights
                        ?>
                        <?php 
                          if((in_array("Daily Movement", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                        <li <?php 
                        if(($page_name=='daily_movement_details_list')||($page_name=='add_daily_movement_details')||($page_name=='edit_daily_movement_details')||($page_name=='read_daily_movement_details')||($page_name=='delete_daily_movement')||($page_name=='deny_daily_movement')||($page_name=='approve_daily_movement')||($page_name=='view_daily_movement_report')||($page_name=='validate_edit_daily_movement_details')||($page_name=='add_other_expenses')||($page_name=='add_transport_expenses')||($page_name=='validate_add_driver_payment')){ echo 'class="open"'; 
                        } ?> > 
                            <a href="javascript:;">
                                <i class="fa fa-pencil-square-o"></i>
                                <span class="title">Daily Movement</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>                                    
                                    <?php
                                    if(($page_name=='daily_movement_details_list')||($page_name=='read_daily_movement_details')||($page_name=='delete_daily_movement')||($page_name=='deny_daily_movement')||($page_name=='approve_daily_movement')||($page_name=='validate_edit_daily_movement_details')||($page_name=='validate_add_driver_payment')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                    echo anchor('daily_movement/daily_movement_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php
                                    if(($page_name=='add_daily_movement_details')||($page_name=='add_other_expenses')||($page_name=='add_transport_expenses')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                    echo anchor('daily_movement/add_daily_movement_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                 <li>                                    
                                    <?php
                                    if($page_name=='view_daily_movement_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('daily_movement/view_daily_movement_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                               
                            </ul>
                        </li>
                        <?php } // check for daily movement rights ?>
                        <?php 
                          if((in_array("Party Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                        <li <?php if(($page_name=='party_details_list')||($page_name=='view_party_details')||($page_name=='add_party_details')||($page_name=='edit_party_details')||($page_name=='validate_edit_party_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-university"></i>
                                <span class="title">Party Details</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                   <?php 
                                   if(($page_name=='party_details_list')||($page_name=='view_party_details')||($page_name=='validate_edit_party_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('party_details/party_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if($page_name=='add_party_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                    echo anchor('party_details/add_party_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } // check for party details rights ?>
                         <?php 
                          if((in_array("Party Billing", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                        <li <?php if(($page_name=='party_billing_list')||($page_name=='view_party_details')||($page_name=='add_party_billing')||($page_name=='edit_party_billing')||($page_name=='validate_edit_party_billing')||($page_name=='view_party_billing')||($page_name=='view_party_billing_report')||($page_name=='read_party_billing_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">Party Billing</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                   <?php 
                                   if(($page_name=='party_billing_list')||($page_name=='view_party_billing')||($page_name=='validate_edit_party_billing')||($page_name=='view_party_billing')||($page_name=='read_party_billing_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('party_billing/party_billing_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if($page_name=='add_party_billing'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                    echo anchor('party_billing/add_party_billing', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                 <li>                                    
                                    <?php
                                    if($page_name=='view_party_billing_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('party_billing/view_party_billing_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } // check for party Billing details rights ?>
                        <?php 
                          if((in_array("Party Payment", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                        <li <?php if(($page_name=='party_payments_list')||($page_name=='view_party_payments')||($page_name=='add_party_payment_details')||($page_name=='validate_edit_party_payment_details')||($page_name=='paid_daily_movement')||($page_name=='validate_party_payment_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-cc-visa"></i>
                                <span class="title">Party Payments</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                   <?php 
                                   if(($page_name=='party_payments_list')||($page_name=='view_party_payments')||($page_name=='validate_edit_party_payment_details')||($page_name=='paid_daily_movement')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('party_payments/party_payments_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if(($page_name=='add_party_payment_details')||($page_name=='validate_party_payment_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                    echo anchor('party_payments/add_party_payment_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } // check for party details rights ?>
                        <?php 
                          if((in_array("ISO Movement", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                        <li <?php if(($page_name=='iso_movement_details_list')||($page_name=='add_iso_movement_details')||($page_name=='edit_iso_movement_details')||($page_name=='deny_iso_movement_details')||($page_name=='approve_iso_movement_details')||($page_name=='view_iso_movement_details')||($page_name=='view_iso_movement_report')||($page_name=='validate_edit_iso_movement_details')||($page_name=='iso_driver_payment')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-sitemap"></i>
                                <span class="title">ISO Movement</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                     <?php 
                                     if(($page_name=='iso_movement_details_list')||($page_name=='deny_iso_movement_details')||($page_name=='approve_iso_movement_details')||($page_name=='view_iso_movement_details')||($page_name=='validate_edit_iso_movement_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('iso_movement_details/iso_movement_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                   <?php 
                                    if($page_name=='add_iso_movement_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('iso_movement_details/add_iso_movement_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                 <li>                                    
                                    <?php
                                    if($page_name=='view_iso_movement_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }

                                     echo anchor('iso_movement_details/view_iso_movement_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } // check for iso movement rights ?>
                        
                        <?php 
                          if((in_array("Transport Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                        <li  <?php if(($page_name=='transport_details_list')||($page_name=='add_transport_details')||($page_name=='edit_transport_details')||($page_name=='view_transport_details')||($page_name=='view_transport_report')||($page_name=='validate_edit_transport_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-truck"></i>
                                <span class="title">Transport Details</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <?php 
                                     if(($page_name=='transport_details_list')||($page_name=='view_transport_details')||($page_name=='validate_edit_transport_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('transport_details/transport_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if($page_name=='add_transport_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('transport_details/add_transport_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if($page_name=='view_transport_report'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('transport_details/view_transport_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li> 
                        <?php } // check for transport details rights ?>  
                          <?php 
                          if((in_array("Transport Payment", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>
                        <li  <?php if(($page_name=='transport_payment_list')||($page_name=='add_transport_payment')||($page_name=='edit_transport_payment')||($page_name=='view_transport_payment')||($page_name=='validate_edit_transport_payment')||($page_name=='view_transport_payments')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-rupee"></i>
                                <span class="title">Transport Payment</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <?php 
                                     if(($page_name=='transport_payment_list')||($page_name=='view_transport_payment')||($page_name=='validate_edit_transport_payment')||($page_name=='view_transport_payments')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('transport_payment/transport_payment_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if($page_name=='add_transport_payment'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('transport_payment/add_transport_payment', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                               
                            </ul>
                        </li> 
                        <?php } // check for transport details rights ?>  
                        <?php 
                          if((in_array("Vehicle Due Details", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>  
                        <li  <?php if(($page_name=='due_details_list')||($page_name=='add_due_details')||($page_name=='edit_due_details')||($page_name=='validate_edit_due_details')||($page_name=='view_due_details')||($page_name=='add_due_amount')||($page_name=='view_due_report')||($page_name=='upcoming_due_report')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span class="title">Vehicle Due Details</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <?php 
                                     if(($page_name=='due_details_list')||($page_name=='validate_edit_due_details')||($page_name=='view_due_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('due_details/due_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if(($page_name=='add_due_details')||($page_name=='add_due_amount')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('due_details/add_due_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if(($page_name=='view_due_report')||($page_name=='upcoming_due_report')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('due_details/view_due_report', 'Report', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li> 
                        <?php } // check for vehicle due details rights ?>    
						 <?php 
                          if((in_array("Vehicle Maintenance", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?>  
                        <li  <?php if(($page_name=='list' || $page_name=='add' || $page_name=='edit')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span class="title">Vehicle Maintenance</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <?php 
                                     if(($page_name=='list')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('vehicle_maintenance/list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                        </li> 
                        <?php } // check for vehicle maintenance rights ?>    
                        <?php 
                          if((in_array("Admin User Rights", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                        ?> 
						<li  <?php if(($page_name=='admin_user_rights_details_list')||($page_name=='add_admin_user_rights_details')||($page_name=='edit_admin_user_rights_details')||($page_name=='validate_edit_admin_user_rights_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-group"></i>
                                <span class="title">User Rights </span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <?php 
                                     if(($page_name=='admin_user_rights_details_list')||($page_name=='validate_edit_admin_user_rights_details')||($page_name=='validate_edit_admin_user_rights_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('admin_user_rights_details/admin_user_rights_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if($page_name=='add_admin_user_rights_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('admin_user_rights_details/add_admin_user_rights_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                                
                            </ul>
                    </li>
                    <?php } // chekc for admin user rights details rights ?>
                    <?php  
                          if((in_array("User", $user_typ_ary)==true)||($this->session->userdata('username')=='admin'))
                          { 
                    ?> 
                    <li  <?php if(($page_name=='user_details_list')||($page_name=='add_user_details')||($page_name=='edit_user_details')||($page_name=='validate_edit_user_details')){ echo 'class="open"'; } ?>> 
                            <a href="javascript:;">
                                <i class="fa fa-key"></i>
                                <span class="title">User</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <?php 
                                     if(($page_name=='user_details_list')||($page_name=='validate_edit_user')||($page_name=='validate_edit_user_details')){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                     echo anchor('user_details/user_details_list', 'View', ''.$anchor_act_cls.''); ?>
                                </li>
                                <li>
                                    <?php 
                                    if($page_name=='add_user_details'){ $anchor_act_cls='class="active"';  }else{ $anchor_act_cls=''; }
                                   echo anchor('user_details/add_user_details', 'Add', ''.$anchor_act_cls.''); ?>
                                </li>
                            </ul>
                    </li>
                    <?php } // check for user details rights ?>
                    <li <?php if($page_name=='profit_details_list'){ echo 'class="open"'; } ?> > 
                            <!-- <a href="dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a> -->
                            <?php echo anchor('profit/profit_details_list', '<i class="fa fa-smile-o"></i> <span class="title">Profit</span>'); ?>                            
                        </li>
                </ul>

                </div>
                <!-- MAIN MENU - END -->


                <div class="project-info">
                    <div class="block1">
                      Developed By <a href="http://daffodillstechnologies.com/" title="Daffodills Technologies" style="color:#FFF;">:- <strong>Daffodills Technologies</strong></a>
                    </div>
                </div>


            </div>
            <!--  SIDEBAR - END -->