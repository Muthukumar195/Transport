<!-- start jquery validation -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery.validate.css" />
<script src="<?php echo base_url(); ?>/assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/assets/js/jquery.validate.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>/assets/js/jquery.validation.functions.js" type="text/javascript">
</script>
<script type="text/javascript">
/* <![CDATA[ */ 
jQuery(function(){
		
	jQuery("#daily_movement_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Choose a Date"
	});
	jQuery("#transport_vehicle_type").validate({
	expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please Select a Transport Type"
	});
	jQuery("#container_type").validate({
	expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please Select a Container Type"
	});
	
	jQuery("#place_name").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Place Name"
	});
	jQuery("#pick_up").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Pickup Place"
	});
	jQuery("#drop").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Drop Place"
	});	
	jQuery("#party_name").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Party Name"
	});
	jQuery("#party_advance").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Party Advance"
	});
	
	jQuery("#party_pay_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Date of Party Pay"
	});
	/*jQuery("#party_pay_status").validate({
	expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please Click a Party Pay Status"
	});*/
	jQuery("#party_pay_status").validate({
    expression: "if (isChecked(SelfID)) return true; else return false;",
    message: "Please Click a Party Pay Status"
	});
	jQuery("#driver_pay_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Date of Driver Pay"
	});
	jQuery("#driver_pay_status").validate({
	expression: "if (isChecked(SelfID)) return true; else return false;",
	message: "Please Click a Driver Pay Status"
	});
	jQuery("#other_expenses").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Other Expenses(Rs)"
	});
	jQuery("#driver_remarks").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Driver Remarks"
	});
	jQuery("#loading_status").validate({
    expression: "if (isChecked(SelfID)) return true; else return false;",
    message: "Please Click a Loading Status"
	});
	jQuery("#rent").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Rent"
	});
	jQuery("#ot_rent").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter Other Transport Rent"
	});
				
});
            /* ]]> */		

/*function check_validation_javascript()
{  
	doc = document.registration;
	if((!document.getElementById('party_pay_status1').checked)&&(!document.getElementById('party_pay_status2').checked))
	{
		$('#user_type_checkbox').html("Please select a user type");		
	}
	else
	{
		$('#user_type_checkbox').html("");
	}
  
}*/



function checkInt(obj)
{
	if(obj.value*1 - obj.value*1!=0)
		{obj.value="";}
	
	if(obj.value.indexOf(" ",0)!=-1)
		{
		obj.value="";
		alert ("No Spaces Allowed");	
		obj.focus();
		obj.value="";
		}
}

// start fullname exist or not
/* $("#full_name").change(function() 
			{ //if theres a change in the username textbox
			if(document.getElementById('full_name').value=='')
			{
				$("#full_name_status").html('');
			}
			var full_name = $("#full_name").val();//Get the value in the email textbox
			if(full_name.length > 3)//if the lenght greater than 3 characters
			{ 
			$("#full_name_status").html('<img src="<?php //echo base_url(); ?>/assets/images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
			//Add a loading image in the span id="availability_status"			
			
			
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "<?php //echo base_url(); ?>index.php/driver_details/ajax_check_full_name",  
				data: "full_name="+ full_name,  //data
				success: function(server_response1)
				{				    
				    $("#full_name_status").ajaxComplete(function(event, request)
				    { 			
						if(server_response1==0)//if ajax_check_username.php return value "0"
						{  
						$("#full_name_status").html('<img src="<?php  //echo base_url(); ?>/assets/images/available.png" align="absmiddle"> <font color="Green"> Available </font>  ');
						//add this image to the span with id "availability_status"
						}  
						else  if(server_response1==1)//if it returns "1"
						{   
						 $("#full_name_status").html('<img src="<?php //echo base_url(); ?>/assets/images/button_cancel.png" align="absmiddle"> <font color="red">Username Alreay Exists </font>');
						 return false;
						}  
				   
			   		});
			   } 
			   
			  }); 
			
			}			
			else
				{
					if(full_name_status == 1)
					{
						return false;
					}
					else	
					{
						return true;
					}
				}	
			
			return false;
			});
*/
// end fullname exist or not

</script>        
<!-- end jquery validation -->