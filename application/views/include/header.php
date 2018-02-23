<!DOCTYPE html>
<html class=" ">
<head>

        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Thirumala V-2.0</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>/assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->


        <!-- CORE CSS FRAMEWORK - START -->
        <link href="<?php echo base_url(); ?>/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        
        <!-- CORE CSS FRAMEWORK - END -->
        
        <!-- Image POPUP - START --> 
        <link href="<?php echo base_url(); ?>/assets/plugins/prettyphoto/prettyPhoto.css" rel="stylesheet" type="text/css" media="screen"/>  
       <!-- Image POPUP - END --> 
       
        <!-- OTHER SCRIPTS INCLUDED DATA TABLE ON THIS PAGE - START --> 
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>       <link href="<?php echo base_url(); ?>/assets/plugins/responsive-tables/css/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen"/>
         <!-- OTHER SCRIPTS INCLUDED  DATA TABLE ON THIS PAGE - END -->  

        <!-- CORE CSS TEMPLATE - START -->
        <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>



    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" "><!-- START TOPBAR -->
    <?php $page_name = $this->uri->segment(2, 0); ?>
        <div class='page-topbar ' >
            <div class='logo-area'>

            </div> 
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </a>                            
                        </li>
                        <li><strong><i class="fa fa-calendar"></i> <?php echo date("d-M-Y"); ?></strong></li>
                        <li class="message-toggle-wrapper">
                        
                       
                            <!--<a href="view_driver_details.php" data-toggle="dropdown" class="toggle">-->
                                <!--<i class="fa fa-bell-o"></i>-->
                                <?php echo anchor('due_details/upcoming_due_report','<i class="fa fa-bell-o"></i>','rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Upcoming Due Within 15 Days" data-placement="right"');?>
                                <span class="badge badge-danger"><?php
                                echo $due_upcoming_count;
                                ?></span>
                          <!--  </a>-->
                        </li>
                        <li class="message-toggle-wrapper">
                         
                                <?php echo anchor('Vehicle_document_details/upcoming_vehicle_doc_report','<i class="fa fa-bell"></i>','rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Upcoming Vehicle Document Within 15 Days" data-placement="right"');?>
                                <span class="badge badge-danger"><?php
                                echo $upcoming_vehicle_doc_count;
                                ?></span>
                        
                        </li>
                    </ul>
                   
                </div>
                
             
                <div class='pull-right'>
                
                    <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile">
                        <?php foreach ($get_admin_profile->result() as $row){  ?>
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" title="Profile Picture" alt="<?php echo $row->Admin_profile; ?>" class="img-circle img-inline" />
                                <strong style="color:rgb(9, 22, 86);"><?php echo $row->Admin_fullname; ?>&nbsp;<i class="fa fa-angle-down"></i></strong>
                            </a>
                           <?php } ?>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="#settings">
                                       
 <?php echo anchor('tranport_main/edit_admin_profile', "<i class='fa fa-wrench'></i> Edit Profile"); ?>
                                    </a>
                                </li>
                                <li class="last">                                    
                                    <?php echo anchor("tranport_main/logout", "<i class='fa fa-lock'></i> Logout"); ?>
                                    
                                </li>
                            </ul>
                        </li>
                        
                    </ul>			
                </div>		
            </div>

        </div>
        <!-- END TOPBAR -->