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
                                <h1 class="title">Add Party Billing</h1>                            </div>


                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">

    <div class="row">
       
       <!-- edit form column -->
       <div class="col-md-12 col-sm-12 col-lg-12 personal-info">
       <?php if($this->session->flashdata('success_msg')!=null){ ?>
        <div class="alert alert-success alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-check-square"></i>
          <?php echo $this->session->flashdata('success_msg'); ?>
        </div>  
        <?php } ?>    
        
        <!-- <form class="form-horizontal" role="form"> -->
        <?php echo form_open_multipart('party_billing/validate_party_billing', array('class'=>'form-horizontal')); ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span> 
          <div class="form-group">
            <label class="col-lg-2 control-label">Date :</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'billing_date',
                        'id'          => 'billing_date',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => 'Select Bill Date'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            <label class="col-lg-2 control-label">Party Name :</label>
            <div class="col-lg-3">              
              <?php
                $options_party['']='Select Party Name';
                foreach($party_name_list->result() as $party)
                {                  
                  $options_party[$party->Party_dtl_id] = $party->Party_dtl_name;
				                  
                } 
                echo form_dropdown('party_name', $options_party, '', 'class="form-control" id="party_name"');
              ?>
            </div>
          </div> 
          <div class="form-group">
            <label class="col-lg-2 control-label">Container No :</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'container_no',
                        'id'          => 'container_no',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Container Number'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            <label class="col-lg-2 control-label">Material :</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'material',
                        'id'          => 'material',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Material'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
             <label class="col-lg-2 control-label">Consignee :</label>
            <div class="col-lg-3">              
           <?php 
                  $data2 = array(
                        'name'        => 'consignee',
                        'id'          => 'consignee',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Consignee'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
           <label class="col-lg-2 control-label">Consignor :</label>
            <div class="col-lg-3">              
            <?php 
                  $data2 = array(
                        'name'        => 'consignor',
                        'id'          => 'consignor',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Consignor'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-lg-2 control-label">INV No :</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'int_no',
                        'id'          => 'int_no',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter INV No'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            <label class="col-lg-2 control-label">Phone No :</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'phone_no',
                        'id'          => 'phone_no',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control',
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter Phone No'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">From :</label>
            <div class="col-lg-3">              
              <?php
                $data1 = array(
                        'name'        => 'billing_from',
                        'id'          => 'billing_from',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control',
						'placeholder' => 'From'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
            <label class="col-lg-2 control-label">To:</label>
            <div class="col-lg-3">  
              <?php
                $data1 = array(
                        'name'        => 'billing_to',
                        'id'          => 'billing_to',
                        'value'       => '',
                        'maxlength'   => '20',
                        'class'       => 'form-control',
					    'placeholder' => 'To'
                      ); 
                  echo form_input($data1);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Bill Received Date:</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'bill_res_date',
                        'id'          => 'bill_res_date',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => ' Select Bill Received Date'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            <label class="col-lg-2 control-label">EY Vaild Date :</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'ey_date',
                        'id'          => 'ey_date',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => 'Select EY Vaild Date'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
             <label class="col-lg-2 control-label">CNS No :</label>
            <div class="col-lg-3">              
            <?php 
                  $data2 = array(
                        'name'        => 'cns_no',
                        'id'          => 'cns_no',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'onkeyup'     => 'checkInt(this)',
						'placeholder' => 'Enter CNS No'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
            <label class="col-lg-2 control-label">Train No :</label>
            <div class="col-lg-3">   
             <?php 
                  $data2 = array(
                        'name'        => 'train_no',
                        'id'          => 'train_no',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Train No'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
             <label class="col-lg-2 control-label">U/L Date :</label>
            <div class="col-lg-3">              
            <?php 
                  $data2 = array(
                        'name'        => 'ul_date',
                        'id'          => 'ul_date',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => 'Select U/L Date'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
           <label class="col-lg-2 control-label">Last Date :</label>
            <div class="col-lg-3">              
            <?php 
                  $data2 = array(
                        'name'        => 'last_date',
                        'id'          => 'last_date',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => 'Select Last Date'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Empty :</label>
            <div class="col-lg-8">              
              <?php 
                  $data2 = array(
                        'name'        => 'empty',
                        'id'          => 'empty',
                        'value'       => '',
                        'maxlength'   => '120',
                        'class'       => 'form-control',
						'placeholder' => 'Enter Empty'
                      ); 
                  echo form_input($data2);
              ?>
            </div>
          </div>
        
          
          <div class="form-group">
            <label class="col-lg-2 control-label">Remark:</label>
            <div class="col-lg-8">
             <?php  
                $data = array(
				  'name'        => 'billing_remark',
				  'id'          => '', 
				  'value'       => '',
				  'rows'        => '5',
				  'cols'        => '10',
				  'style'       => '',
				  'class'	   => 'form-control'
				);
			
			  echo form_textarea($data); 
			?> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">              
              <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel" onClick="javascript: document.location.href='party_details_list'" >
            </div>
          </div> 
      </form>
       
      </div>
  </div>
  <!-- End .row -->
  
  

                            </div>
                        </section></div>



                </section>
            </section>
            <!-- END CONTENT -->


                </div>
        <!-- END CONTAINER -->
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<?php include('include/footer.php');
include('validation/add_party_billing.php');
?>        