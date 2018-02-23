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
		
	jQuery("#full_name").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please enter a full name"
	});
	jQuery("#email").validate({
	expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
	message: "Please Enter Your Valid Email ID"
	});
	 
	jQuery("#phone_no").validate({
     expression: "if (VAL.match(/^[1-9][0-9]{9}$/)) return true; else return false;",
	  message: "Please enter a Valid Mobile number",
    });
	jQuery("#user_name").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please enter a userame name"
	});
    jQuery("#password").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please enter a password"
	});
	jQuery("#con_password").validate({
	expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",
	message: "Confirm password doesn't match"
	});
	jQuery("#userfile").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select Profile Picture"
	});	
	jQuery("#user_rights").validate({
	expression: "if (VAL) return true; else return false;",
	message: "Please Select user rights type"
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


</script>        
<!-- end jquery validation -->