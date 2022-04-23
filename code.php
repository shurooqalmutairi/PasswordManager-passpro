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

    <title>Password Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

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

</head>

<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
				
                <div class="login-panel panel panel-default">
					<div style='text-align: center;'>User Login</div>
					<div style=" margin-left:auto; margin-right: auto; width:50%">
						<img  width="100%" src="images/logo.png"/>
					</div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Complete Your Login</h3>
                    </div>
                    <div class="panel-body">
<?php
 
	$resultArr = array();
	$expaireCode = false;
	
	
	$code = isset($_POST["code"])? $_POST["code"]:"0";
	if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == 0 )
	{
		header("location:login.php");
	}
	if($code != 0)
	{
		$user_id = $_SESSION['user_id'];
		$check_code = $user->checkCode($code , $user_id); 
		if($check_code && !$user->getIsExpaireCode()){
			 $_SESSION['user'] = $user;
			echo "<meta http-equiv='refresh' content='3; url=index.php'>";
			echo "<div class='info'>You are suucessfully logged in..</div>";
			echo "<div class='info'><a href='index.php'>Click here to continue to your dashboard</a>.</div>";
		}else{
			echo "<div class='info'>Invalid code or time is expaired.
						<a href='login.php' class='btn btn-lg btn-success btn-block'>Please try again</a>
					</div>";
		}
	} else{
	 
	?>
				<form action="" method="post" enctype="multipart/form-data">
					<fieldset>
						Please write 6 digits code from your email
						
						<div class="form-group">
							<input class="form-control" placeholder="Code" name="code" type="number" value="<?=$code?>" required autofocus>
						</div>
						
						
						
						<!-- Change this to a button or input when using this as a form -->
						<input type="submit" value="Complete Login" username="reserve" class="btn btn-lg btn-success btn-block">
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
