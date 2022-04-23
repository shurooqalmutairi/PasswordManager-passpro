<?php
 
	session_start();
	date_default_timezone_set('Asia/Aden');
	
	include("classes/DB.php");
	include("classes/User.php");
	 
	$page_titel = "Log In";
	
	$db = new DB();
	$user = new User($db);
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Password Manager - Singup</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <link href="css/pstyle.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	
	<!-- password_strength -->
	<script type="text/javascript" src="password_strength/password_strength_lightweight.js"></script>
	<!-- <script type="text/javascript" src="password_strength/password_strength.js"></script> -->
	<!-- <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="password_strength/password_strength.css">
	<script>
		$(document).ready(function($) { 

			$('#mySecondPassword').strength_meter({
				inputClass: 'c_strength_input',
				strengthMeterClass: 'c_strength_meter',
				toggleButtonClass: 'c_button_strength'
			});
 
		});
	</script>


</head>

<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
				
                <div class="login-panel panel panel-default">
					<div style='text-align: center;'>Create New Account</div>
					<div style=" margin-left:auto; margin-right: auto; width:50%">
						<img  width="100%" src="images/logo.png"/>
					</div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Sing Up</h3>
                    </div>
                    <div class="panel-body">

<?php  
	
	$email  = isset($_POST['email'])?$_POST['email']:"";
	$password = isset($_POST['password'])?$_POST['password']:"";
	$name = isset($_POST['name'])?$_POST['name']:""; 
	
	if(isset($_POST['email']) && $_POST['email']!="" && $_POST['password']!="" )
	{
		if($user->userSingup($_POST['name'] , $_POST['email'] , $_POST['password']))
		{			 
			echo "<div class='info'>Your account is ready, please
						<a href='login.php' class='btn btn-lg btn-success btn-block'>Login</a>
					</div>";
		}else{ 
			echo "<div class='info'>Couldn't create your account,
						<a href='singup.php' class='btn btn-lg btn-success btn-block'>Please try again</a>
					</div>";
		}
	}else{ 
?>
				
				<form action="singup.php" method="post">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="User Name" name="name" type="text" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Email" name="email" type="email"  required>
						</div>
						<div class="form-group">
							<div id="mySecondPassword"></div>
							 
							
						</div> 
						<input type="submit" value="Sing Up" class="btn btn-lg btn-success btn-block">
						
						<div class="form-group">
							Have Account? <a href="login.php">Log in to your account</a>
						</div> 
					</fieldset>
					
				</form>
		
		
	<?php
	}
	?>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
 
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
