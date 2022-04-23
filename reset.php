
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

    <div id="wrapper">

<?php 
	include("classes/DB.php");
	include("classes/User.php");
	date_default_timezone_set('Asia/Aden');

	include("mail.php");
	 
	$db  = new DB();
	$userOb  = new User($db );  
	
	$expaireLink = false;
	 
	
	$req_id = isset($_GET["id"])? $_GET["id"]:"0"; 
	$data = $userOb->getRecoverByID( $req_id);
	
	$start_date = new DateTime($data["req_time"]);
		
	$since_start = $start_date->diff(new DateTime());
	// Check mins and hours
	if ($since_start->i >= 5 ) {
		$expaireLink = true;
	} 
	
	$updateSuccess = false;
	
	if(!$expaireLink)
	{
	
		$email =  $data["email"]; 
		
		$password = isset($_POST["password"]) ? $_POST["password"] : "";
		
		if( $password != "")
		{ 		
			$result = $userOb->updatePassword($email, $password );
			if($result)
			{
				echo "<h2>Password updated successfully</h2>";
				echo "<p><a href='login.php'>Back to login page</a></p>";
				$updateSuccess = true;
			}
			else{
				echo "<h2>Error, couldn't update your password</h2>";
			}
		}
		if(! $updateSuccess ){
	?>
	<!-- Page Content -->
			<div id="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<h3>Update your password.</h3>
					</div>
					<!-- /.row -->
					<div class="row">
					
						<form action="?id=<?=$req_id?>" method="post" enctype="multipart/form-data">
							<fieldset>
								<strong>Set New Password</strong>
								
								<div class="form-group">
									<input class="form-control" placeholder="New Password" name="password" type="password" value="<?=$password?>" required autofocus>
								</div>
								
								
								
								<!-- Change this to a button or input when using this as a form -->
								<input type="submit" value="Update" username="reserve" onclick="load()" class="btn btn-lg btn-success btn-block">
							</fieldset>
							
						</form>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->

		<?php 
		}
	}
	else{
		echo "<h1>This link has expired</h1>";
		echo "<p><a href='forgetPassword.php'>Back to forget password page</a></p>";
	}
	include("template/footer.htm");
	
	?>