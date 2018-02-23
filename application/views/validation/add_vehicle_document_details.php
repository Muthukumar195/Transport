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
		
	jQuery("#vehicle_number").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Vehicle Number"
	});
	jQuery("#m_permit_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a M Permit From"
	});
	jQuery("#m_permit_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a M Permit To"
	});
	/*jQuery("#n_permit_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a N Permit From"
	});
	jQuery("#n_permit_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a N Permit To"
	});*/
	/*jQuery("#ap_permit_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a AP Permit From"
	});
	jQuery("#ap_permit_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a AP Permit To"
	});*/
	jQuery("#insurance_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Insurance From"
	});
	jQuery("#insurance_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Insurance To"
	});
	jQuery("#fc_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a FC From"
	});
	jQuery("#fc_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a FC To"
	});
	jQuery("#tax_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Tax From"
	});
	jQuery("#tax_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Tax To"
	});
	jQuery("#pc_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Pollution Certificate"
	});
	jQuery("#pc_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Pollution Certificate"
	});
				
});
            /* ]]> */		
			
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