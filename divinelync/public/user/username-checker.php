<?php
if($_POST["type"]=="create")
{
	if(isset($_POST["emailid"]))
	{
		if (!filter_var($_POST["emailid"], FILTER_VALIDATE_EMAIL))
		{
			die('<img src="../img/not-available.png" />'.'Please enter valid emailid');
		}
		else
		{
			if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
			{
				die();
			}
			$mysqli = new mysqli('localhost' , 'root', 'PEG4VtRhaXHmTz7j', 'divine-lync');
			if ($mysqli->connect_error)
			{
				die('Could not connect to database!');
			}
			$emailid = filter_var($_POST["emailid"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
			$statement = $mysqli->prepare("SELECT user_email FROM user WHERE user_email=?");
			$statement->bind_param('s', $emailid);
			$statement->execute();
			$statement->bind_result($emailid);
			if($statement->fetch())
			{
				die('<img src="../img/not-available.png" />'.'This email is already registered. Want to');
			}
			else
			{
				die('<img src="../img/available.png" />');
			}
		}
	}
}
else if($_POST["type"]=="login")
{
	if(isset($_POST["emailid"]))
	{
	   if (!filter_var($_POST["emailid"], FILTER_VALIDATE_EMAIL))
	   {
			die('<img src="../img/not-available.png" />'.'Please enter valid emailid');
	   }
	   else
	   {
					
	   }
	}
}