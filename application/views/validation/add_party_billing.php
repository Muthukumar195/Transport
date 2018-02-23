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
		
	jQuery("#billing_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Choose a Date"
	});
	jQuery("#party_name").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select a Party Name"
	});
    jQuery("#container_no").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Container Number"
	});
	jQuery("#material").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Material"
	});
	jQuery("#consignee").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Consignee"
	});
	jQuery("#consignor").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Consignor"
	});
	jQuery("#int_no").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a INO Number"
	});
	jQuery("#phone_no").validate({
   expression: "if (VAL.match(/^[1-9][0-9]{9}$/)) return true; else return false;",
    message: "Please Enter Mobile Number"
    });
	jQuery("#billing_from").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Billing From"
	});
	jQuery("#billing_to").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Enter a Billing To"
	});
	jQuery("#bill_res_date").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Choose a Bill Received Date"
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