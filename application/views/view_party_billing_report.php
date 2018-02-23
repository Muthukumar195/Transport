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
                                <h1 class="title">Party Billing Report</h1>                            
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">

                         <!-- start mail box for read daily movement details -->
                           <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('party_billing/view_party_billing_report', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>       
          
          <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4"  >
                <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Date:</label>
                <div class="col-lg-6 col-md-6 col-sm-6"  >              
                   <?php 
                  $data2 = array(
                        'name'        => 'billing_date',
                        'id'          => 'billing_date',
                        'value'       => set_value('billing_date'),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => 'Select Bill Date'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>           
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Party Name:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                               
              <?php
                $options_party['']='Select Party Name';
                foreach($party_name_list->result() as $party)
                {                  
                  $options_party[$party->Party_dtl_id] = $party->Party_dtl_name;
				                  
                } 
                echo form_dropdown('party_name', $options_party, set_value('party_name'), 'class="form-control" id="party_name"');
              ?>
                
              </div> 
            </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Conatiner Number:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
                  $data2 = array(
                        'name'        => 'container_no',
                        'id'          => 'container_no',
                        'value'       => set_value('container_no'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
                        'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Container Number'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            </div>
             <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Material:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                    <?php 
                  $data2 = array(
                        'name'        => 'material',
                        'id'          => 'material',
                        'value'       => set_value('material'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Material'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Consignee:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php 
                  $data2 = array(
                        'name'        => 'consignee',
                        'id'          => 'consignee',
                        'value'       => set_value('consignee'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Consignee'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">Consignor:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php 
                  $data2 = array(
                        'name'        => 'consignor',
                        'id'          => 'consignor',
                        'value'       => set_value('consignor'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Consignor'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            </div>
             <div class="row"> 
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">INV No:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                    <?php 
                  $data2 = array(
                        'name'        => 'int_no',
                        'id'          => 'int_no',
                        'value'       => set_value('int_no'),
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter INT No'
                      ); 
                  echo form_input($data2);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">From:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                   <?php
                $data1 = array(
                        'name'        => 'billing_from',
                        'id'          => 'billing_from',
                        'value'       => set_value('billing_from'),
                        'maxlength'   => '20',
                        'class'       => 'form-control',
						'placeholder' => 'From'
                      ); 
                  echo form_input($data1);
              ?>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4" > 
              <div class="form-group" >
                <label class="col-lg-6 col-md-6 col-sm-6 control-label">To:</label>
                <div class="col-lg-6 col-md-6 col-sm-6" >              
                  <?php
                $data1 = array(
                        'name'        => 'billing_to',
                        'id'          => 'billing_to',
                        'value'       => set_value('billing_to'),
                        'maxlength'   => '20',
                        'class'       => 'form-control',
					    'placeholder' => 'To'
                      ); 
                  echo form_input($data1);
              ?>
                </div>
              </div> 
            </div>
            </div>
             
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">                
                <div class="col-lg-12 col-md-12 col-sm-12" align="center">              
                  <?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>                                 
                </div>
              </div>  
          </div>
     </div>
      </form>  

      <!-- start list driver details -->
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Party Billing Details List </h2>
                            <div class="actions panel_actions pull-right">
                                <i class="box_toggle fa fa-chevron-down"></i>
                                <!-- <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i> -->
                                <i class="box_close fa fa-times"></i>
                                <a href="JavaScript:newPopup('<?php echo base_url(); ?>index.php/party_billing/view_party_billing_report_print');"><img src='<?php echo base_url(); ?>/assets/images/print.png' border='0' title="Print" alt="Print" >&nbsp;Print</a>
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
                                            <th>INI No</th>
                                            <th>From</th>
                                            <th>To</th>
                                           
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
                                            <th>INI No</th>
                                            <th>From</th>
                                            <th>To</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        $sno=1;                                                    
                                        foreach ($party_billing_report->result() as $row)
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
        