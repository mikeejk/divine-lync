<?php
include("../config/Class.Crud.Php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Divine - Lync</title>
<link rel="stylesheet" type="text/css" href="../utils/bootstrap-3.3.4-dist/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../utils/bootstrap-3.3.4-dist/css/bootstrap-theme.min.css" />
<link rel="stylesheet" type="text/css" href="css/global-style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="../utils/html5shiv.min.js"></script>
          <script src="../utils/respond.min.js"></script>
         
        <![endif]-->
        <script type="text/javascript">
$(document).ready(function() {
    var x_timer;    
    $("#emailid").keyup(function (e){
        clearTimeout(x_timer);
        $("#user-email").html('<img src="../img/not-available.png" />'+'Validating');
        var emailid = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(emailid);
        }, 1000);
    }); 

function check_username_ajax(emailid){
   
    $.post('username-checker.php', {'emailid':emailid,'type':'login'}, function(data) {
      $("#user-email").html(data);
    });
}
});
</script>
		<style type="text/css">
		div.sidetip{
			position: absolute;
    left: 830px;
    width: 300px;
    display: table;
    min-height: 92px;
    margin-top: -6px;
    margin-left: 10px;
		}
		div.sidetip p {
    font-size: 13px;
    line-height: 16px;
    padding-left: 18px;
    background-repeat: no-repeat;
    background-position: 0 9px;
    color: gray;
    display: none;
    }
		@import "bourbon";
		.wrapper {
				margin-top: 80px;
				margin-bottom: 80px;
		}
		.form-signin {
			max-width: 380px;
			padding: 15px 35px 45px;
			margin: 0 auto;
			background-color: #fff;
			border: 1px solid rgba(0,0,0,0.1);
			.form-signin-heading,
			.checkbox {
				margin-bottom: 30px;
			}
			.checkbox {
				font-weight: normal;
			}
			.form-control {
				position: relative;
				font-size: 16px;
				height: auto;
				padding: 10px;
				@include box-sizing(border-box);
				&:focus {
					z-index: 2;
				}
			}
			input[type="text"] {
				margin-bottom: -1px;
				border-bottom-left-radius: 0;
				border-bottom-right-radius: 0;
			}
			input[type="password"] {
				margin-bottom: 20px;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
			}
		}
		</style>
    </head>
    <body>
        <div class="container">
            <div class="navbar-header">
				<a class="navbar-brand" href="login.php">
					
				</a>
			</div>
            <div class="row">
                <div class="wrapper">
					<form class="form-signin" method="post" action="login.php">
					  <h2 class="form-signin-heading">Login</h2>
					  <input  id="emailid" type="text" class="form-control" name="user[emailid]" placeholder="Email" required="true" />
					  <span id="user-email"></span>
					  <br/>
					  <input id="password" type="password" class="form-control" name="user[userpassword]" placeholder="Password"  required="true"/>
					  <br/>
					  <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin" value="Login">Login</button>
					</form>
				</div>
            </div>
        </div>
        <script src="../utils/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="../utils/bootstrap-3.3.4-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/global-script.js" type="text/javascript"></script>
    </body>
</html>
<?php if(isset($_POST['btnLogin'])){
	
	
	
			$tablename="user";
			
			$usermailid=$_POST['user']['emailid'];
			$userpassword=md5($_POST['user']['userpassword']);
			$InsColumnVal = array("user_email"=>$usermailid,"user_password"=>$userpassword,"status"=>1);
			$fetch=$obj->fetch($tablename, $InsColumnVal);
			if(count($fetch)>1)
			{
				
			}
			else if(count($fetch)=="0")
			{
				if (!filter_var($_POST['user']['emailid'], FILTER_VALIDATE_EMAIL)) {
					die('<img src="../img/not-available.png" />'.'Please enter valid emailid');
				}
				else {
					
					die('<img src="../img/not-available.png" />'.'The username and password you entered did not match our records. Please double-check and try again.');
				}
			}
			
}?>