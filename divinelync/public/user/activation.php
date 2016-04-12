<?php

include("../config/Class.Crud.Php");

if(!empty($_GET['code']) && isset($_GET['code']))
{
	
	$code=$_GET['code'];
	$tablename="user";
	$InsColumnVal = array("activation_key"=>$code,"status"=>0);
	$fetch=$obj->fetch($tablename, $InsColumnVal);
	if(count($fetch) > 0)
	{
		$fetch=$obj->fetch($tablename, $InsColumnVal);
		if(count($fetch)=="1")
		{
			$user_id=$fetch['0']['user_id'];
			$set = array("status"=>1);
			$condition = array("user_id"=>$user_id,"status"=>'0');
			$msg=$obj->update($tablename, $set,$condition);
			if($msg=="Record updated successfully")
			{
				http("location:")
			}
		}
		else
		{
			$msg ="Your account is already active, no need to activate again";
		}
	}
	else
	{
		$msg ="Wrong activation code.";
	}
}
?>

