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
                                <h1 class="title">User Details</h1>                            </div>


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
                                <h2 class="title pull-left">User Details List</h2>
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
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>User Name</th>
                                            <th>Profile</th>
                                            <th>User Rights</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                           <th>Sno</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>User Name</th>
                                            <th>Profile</th>
                                            <th>User Rights</th>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <th>Status</th>
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($user_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo $row->Admin_fullname; ?></td>
                                            <td><?php echo $row->Admin_email; ?></td>
                                            <td><?php echo $row->Admin_phone; ?></td>
                                            <td><?php echo $row->Admin_username; ?></td>
                                            <td width="10%">
                                                <a href="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" target="_blank" class="preview" title="User Profile" rel="prettyPhoto"><img src="<?php echo base_url(); ?>/uploads/admin_profie/<?php echo $row->Admin_profile; ?>" title="User Profile" alt="<?php echo $row->Admin_profile; ?>" class="img-rounded" width="65%" /></a>
                                            </td>
                                            <td><?php echo $row->User_rights_type_value; ?></td>
                                            <?php if($this->session->userdata('username')=='admin'){ ?>
                                            <td>
                                                <?php 
                                                if($row->Admin_status=='A')
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
                                                <a href="view_user_details?id=<?php echo $row->Admin_id; ?>" target="_blank"  alt="View" class="fa fa-search-plus" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View User Detail" data-placement="bottom"> View </a>
                                                

                                                <?php if($this->session->userdata('username')=='admin'){ ?>
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="edit_user_details?id=<?php echo $row->Admin_id; ?>" alt="Edit" class="fa fa-pencil-square-o" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Edit User Detail" data-placement="bottom"> Edit </a> <i class="fa fa-ellipsis-v"></i>
                                                <?php 
                                                if($row->Admin_status=='A')
                                                {
                                                   echo '<a href="deny_user?id='.$row->Admin_id.'" alt="Update Status" class="fa fa-times" style="color:red;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Deny a User" data-placement="bottom"> Deny </a>';   
                                                }
                                                else
                                                {
                                                    echo '<a href="approve_user?id='.$row->Admin_id.'" alt="Update Status" class="fa fa-check" style="color:green;" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Active a User" data-placement="bottom"  > Active </a>';
                                                }
                                                ?>   
                                                <i class="fa fa-ellipsis-v"></i>
                                                <a href="delete_message?id=<?php echo $row->Admin_id;?>&file_name=<?php echo $row->Admin_profile;?>" onclick="return confirm('Are you sure you want to delete?')" alt="Delete" class="fa fa-trash" rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To Delete a User" data-placement="bottom" > Delete </a>
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
        