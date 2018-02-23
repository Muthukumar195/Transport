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
                                <h1 class="title">Edit Party Billing </h1>                            
                                </div>
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
        <?php echo form_open_multipart('party_billing/validate_edit_party_billing', array('class'=>'form-horizontal'));        
        foreach ($party_billing_data->result() as $row)
        {           
        ?>
          <span style="color:red; "><?php echo validation_errors(); ?></span>
          <div class="form-group">
            <label class="col-lg-2 control-label">Date :</label>
            <div class="col-lg-3">              
              <?php 
                  $data2 = array(
                        'name'        => 'billing_date',
                        'id'          => 'billing_date',
                        'value'       => date('d-m-y', strtotime($row->Party_billing_date)),
                        'maxlength'   => '20',
                        'class'       => 'form-control datepicker',
						'readonly'    =>'true',
						'data-format' => 'dd MM yyyy',
						'placeholder' => 'Select Bill Date'
                      ); 
                  echo form_input($data2);
              ?>
              <input type="hidden" id="id" name="id" value="<?php echo $row->Party_billing_id; ?>">
            </div>
            <label class="col-lg-2 control-label">Party Name :</label>
            <div class="col-lg-3">              
              <?php
                $options_party['']='Select Party Name';
                foreach($party_name_list->result() as $party)
                {                  
                  $options_party[$party->Party_dtl_id] = $party->Party_dtl_name;
				                  
                } 
                echo form_dropdown('party_name', $options_party, $row->Party_billing_party_name, 'class="form-control" id="party_name"');
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
                        'value'       => $row->Party_billing_container_no,
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
                        'value'       => $row->Party_billing_consignee,
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
                        'value'       => $row->Party_billing_consignor,
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
                        'value'       => $row->Party_billing_material,
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
                        'value'       => $row->Party_billing_ini_no,
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
                        'value'       => $row->Party_billing_ph_no,
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
                        'id'          => 'billing_to',
                        'value'       => $row->Party_billing_from,
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
                        'value'       => $row->Party_billing_to,
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
                        'value'       => $row->Party_billing_bill_recd_dt,
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
                        'value'       => $row->Party_billing_ey_valid_dt,
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
                        'value'       => $row->Party_billing_cni_no,
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
                        'value'       => $row->Party_billing_train_no,
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
                        'value'       => $row->Party_billing_ul_date,
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
                        'value'       => $row->Party_billing_last_date,
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
                        'value'       => $row->Party_billing_empty,
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
				  'id'          => 'billing_remark', 
				  'value'       => $row->Party_billing_remark,
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
          <?php  } ?>
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
        