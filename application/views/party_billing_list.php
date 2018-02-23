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
                             <h1 class="title">Party Billing Details</h1>                            
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
                                <h2 class="title pull-left">Party Billing List</h2>
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
                                            <th>Party Name</th>
                                            <th>Container No</th>
                                            <th>Consignee</th>
                                            <th>Consignor</th>
                                            <th>Material</th>
                                            <th>INV No</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <!--<th>Status</th>-->
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Party Name</th>
                                            <th>Container No</th>
                                            <th>Consignee</th>
                                            <th>Consignor</th>
                                            <th>Material</th>
                                            <th>INV No</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <!--<th>Status</th>-->
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($party_billing_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php  echo $sno; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->Party_billing_date)); ?></td>
                                            <td><?php echo $row->Party_dtl_name; ?></td>
                                            <td><?php echo $row->Party_billing_container_no; ?></td>
                                            <td><?php echo $row->Party_billing_consignee; ?></td>
                                            <td><?php echo $row->Party_billing_consignor; ?></td>
                                            <td><?php echo $row->Party_billing_material; ?></td>
                                            <td><?php echo $row->Party_billing_ini_no; ?></td>
                                            <td><?php echo $row->Party_billing_from; ?></td>
                                            <td><?php echo $row->Party_billing_to; ?></td>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <!--<td>
                                                <?php 
                                                /*if($row->Party_billing_status=='A')
                                                {
                                                   echo '<strong class="fa fa-check" style="color:green;"> Active</strong>';   
                                                }
                                                else
                                                {
                                                    echo '<strong class="fa fa-times" style="color:red;"> Deny</strong>';
                                                }*/
                                                ?>                                               
                                                
                                            </td>-->
                                            <?php } ?>
                                            <td>
                                            	 <a href="view_party_billing?id=<?php echo $row->Party_billing_party_name.'&pr_nme='.$row->Party_dtl_name; ?>" target="_blank"; alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Party Detail" data-placement="bottom"> View </a>
                                               
                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                 <!--<a href="edit_party_billing?id=<?php //echo $row->Party_billing_party_name; ?>"  alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit Party Billing Detail" data-placement="bottom"> Edit </a> -->
                                                <?php 
                                                /*if($row->Party_billing_status=='A')
                                                {
                                                   echo '<a href="deny_party_billing?id='.$row->Party_billing_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a Party" data-placement="bottom"> Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_party_billing?id='.$row->Party_billing_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a Party" data-placement="bottom"> Active </a>';
                                                }*/
                                                ?> 
                                               <!-- <a href="delete_message?id=<?php //echo $row->Party_billing_id;?>" onclick="return confirm('Are you sure you want to delete?')"alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a Party" data-placement="bottom" > Delete </a>-->
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
        