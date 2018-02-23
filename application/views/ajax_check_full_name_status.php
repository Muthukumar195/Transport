<?php
session_start();
include("include/config.php");

 $user_name =$_POST['user_name']; 

if(isset($_POST['user_name']))
{
	$select_category="SELECT User_name FROM user_registration WHERE  User_name='$user_name'";
	$execute_select_category=mysql_query($select_category);

	$counts=mysql_num_rows($execute_select_category);
	list($email)=mysql_fetch_array($execute_select_category);	
	
	if($counts>0)
	{
	$chkflag=1;
	}
	else
	{
	 $chkflag=0;
	}
			
	 echo addslashes(trim($chkflag));
}
?>