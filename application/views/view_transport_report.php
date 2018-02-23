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
                                <h1 class="title">Transport Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('transport_details/view_transport_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Transport Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'tranport_name',
                            'id'          => 'tranport_name',
                            'value'       => set_value('tranport_name'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Transport Name'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Phone Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'phone_number',
                            'id'          => 'phone_number',
                            'value'       => set_value('phone_number'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Phone Number'
                          ); 
                      echo form_input($data1);
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
                            <h2 class="title pull-left">Container Details List </h2>
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
                                            <th>Name</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Name</th>
                                            <th>Phone No</th>
                                            <th>Address</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($transport_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo $row->Transport_dtl_name; ?></td>
                                            <td><?php echo $row->Transport_dtl_phone_no; ?></td>
                                            <td><?php echo $row->Transport_dtl_address; ?></td>
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
        