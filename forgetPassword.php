
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
	
	include("mail.php");
	$fromEmail = "taizit85@gmail.com";
	$fromPassword = "vrigdyphyvtobhco";
	
	$resultArr = array();
	$db  = new DB();
	$userOb  = new User($db );  
	
	
	$email =  isset($_POST["email"]) ? $_POST["email"] : ""; 
	$msg = "";
	
	if(isset($_POST["email"])  && $email != "" )
	{
		$userID  = $userOb->getUserIdByEmail($email);
		if( $userID > 0){
			
			$last_id  = $userOb->addToRecoveryRequest($email);
			if($last_id > 0)
			{
				$link = "http://localhost/2022/passwordManager/reset.php?id=".$last_id;	 
				if(sendRecoverEmail($link, $email, $fromEmail, $fromPassword)){
					$msg = "Attention, please check your email inbox to change your password within five minutes.";
				}
			}
			else{
				$msg = "Something went wrong, please try again later";
			}
		}else{
			$msg = "There is no account for this email.";
		}
		
	}
?> 
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
					<h4>Recover your password.</h4>
				</div>
                <!-- /.row -->
				<div class="row"> 
					<?php
					if($msg == ""){
					?>
					<form action="" method="post" enctype="multipart/form-data">
						<fieldset>							
							Email:
							<div class="form-group">
								<input class="form-control"  placeholder="Email" name="email" type="email" value="<?=$email?>" autofocus required />
							</div>	 
							
							<!-- Change this to a button or input when using this as a form -->
							<input type="submit" value="Recover" username="reserve" class="btn btn-lg btn-success btn-block">
						</fieldset>
						
					</form>
					<?php
					}else{
						echo "<h3>$msg</h3>";
					}
					?>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
        <!-- /#page-wrapper -->

	<?php 
	
	include("template/footer.htm");
	
	?>