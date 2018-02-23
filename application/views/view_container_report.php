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
                                <h1 class="title">Container Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('container_details/view_container_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Container Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                      $data1 = array(
                            'name'        => 'container_number',
                            'id'          => 'container_number',
                            'value'       => set_value('container_number'),
                            'maxlength'   => '160',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter Container Number'
                          ); 
                      echo form_input($data1);
                  ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Container Type:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                    $options = array(
                      ''  => '-- Select Type --',
                      'F'    => 'Fourty Feet',
                      'T'   => 'Twenty Feet'                  
                    );     
                    $class_nme = 'class="form-control" id="container_type"';       
                    echo form_dropdown('container_type', $options, set_value('container_type'), $class_nme);
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
                                            <th>Container Number</th>
                                            <th>Container Size</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Container Number</th>
                                            <th>Container Size</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($container_details_list->result() as $row)
                                        {                                                               
                                    ?>
                                        <tr>
                                            <td><?php echo $sno; ?></td>
                                            <td><?php echo $row->Container_dtl_container_no; ?></td>
                                            <td>
                                                <?php 
                                                if($row->Container_dtl_size=='T')
                                                {
                                                   echo 'Twenty Feet';   
                                                }
                                                else
                                                {
                                                    echo 'Fourty Feet';
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
        