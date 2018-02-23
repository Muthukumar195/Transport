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
                                <h1 class="title">Driver Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('driver_details/view_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Driver Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'full_name',
                            'id'          => 'full_name',
                            'value'       => set_value('full_name'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Name'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Driver Category Type:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                    $options = array(
                      ''  => '-- Select Type --',
                      'P'    => 'Permanent',
                      'A'   => 'Acting'                  
                    );     
                    $class_nme = 'class="form-control" id="driver_type"';       
                    echo form_dropdown('driver_type', $options, set_value('driver_type'), $class_nme);
                  ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3" >                   
              <div class="form-group">                
                <div class="col-lg-12 col-md-12 col-sm-12">              
                  <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>                                 
                </div>
              </div>   
            </div>  
            <div class="col-lg-1 col-md-1 col-sm-1" ></div>                   
          </div>
      </form>  

      <!-- start list driver details -->
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Driver Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
                                <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/driver_details/view_report_print');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
                            </div>
                        </header>
                        <div class="content-body">    <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">


                                <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Name</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                            <th>License File</th>
                                            <th>Driver Category</th>
                                            
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Name</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                            <th>License File</th>
                                            <th>Driver Category</th>                                      
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($driver_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td>
                                            <?php 
                                              echo anchor('driver_details/view_driver_details?id='.$row->Driver_dtl_id.'', $row->Driver_dtl_name, 'target="_blank"  alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Detail" data-placement="bottom"' );
                                            ?>
                                            </td>
                                            <td>
                                            <?php 
                                              echo anchor('driver_details/view_driver_details?id='.$row->Driver_dtl_id.'', $row->Driver_dtl_phone, 'target="_blank"  alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Detail" data-placement="bottom"' );
                                            ?>
                                            </td>
                                            <td>
                                            <?php 
                                              echo anchor('driver_details/view_driver_details?id='.$row->Driver_dtl_id.'', $row->Driver_dtl_address, 'target="_blank"  alt="View"  rel="tooltip" data-color-class = "primary" data-animate=" animated fadeIn" data-toggle="tooltip" data-original-title="Click To View Driver Detail" data-placement="bottom"' );
                                            ?>
                                            </td>
                                            <td width="10%">
                                                <a href="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>" target="_blank" class="preview" title="Driver Licence" rel="prettyPhoto" ><img src="<?php echo base_url(); ?>/uploads/license/<?php echo $row->Driver_dtl_license_file; ?>"  title="Driver License" alt="<?php echo $row->Driver_dtl_license_file; ?>" class="img-rounded" width="65%" /></a>
                                            </td>
                                            <td>
                                                <?php 
                                                if($row->Driver_dtl_type=='P')
                                                {
                                                   echo 'Permanent';   
                                                }
                                                else
                                                {
                                                    echo "Acting";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php $sno++; } ?>
                                    </tbody>
                            </table>

                           </div>

                            </div>
                </section>
      <!-- end list driver details -->   
                         <!-- end mail box for read daily movement details -->   
                     

                     </div>   
                            


                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');?>
        