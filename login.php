<!-- The login class:
here we call two classes: the database class and the user class
DB.php,User.php -->



<?php
 
	session_start();
	date_default_timezone_set('Asia/Aden');
	
	include("classes/DB.php");
	include("classes/User.php");
	
	include("mail.php"); 
	$fromEmail = "taizit85@gmail.com";
	$fromPassword = "vrigdyphyvtobhco";
	
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
<!-- We well check if the user sumbetted his data succuflly 
We well call the function user login from the user class
If the user is exiest we will call the function gerate code from user class -->


<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
				
                <div class="login-panel panel panel-default">
					<div style='text-align: center;'>User Login</div>
					<div style=" margin-left:auto; margin-right: auto; width:50%">
						<img  width="100%" src="images/logo.png"/>
					</div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">

<?php
	 

	$no_of_login = isset($_SESSION['no_of_login'])?$_SESSION['no_of_login']:0;/* to save the number of attempts to log in*/
	$session_email = isset($_SESSION['email'])?$_SESSION['email']:0;
	$email  = isset($_POST['email'])?$_POST['email']:"";
	$password = isset($_POST['password'])?$_POST['password']:"";
	$errLogin = false;
	if(isset($_POST['email']) && $_POST['email']!="" && $_POST['password']!="" ) /*condition for each time the user tries to login , true if the inputs are correct and false if the inputs are incorrect .*/
	{
		if($user->userLogin($_POST['email'] , $_POST['password']))
		{
			if($user->generateCode()){ 
			  
				$code = $user->getCode();
				if(sendEmail ($code, $email , $fromEmail, $fromPassword)){
				//if(true){
					$_SESSION['no_of_login'] = 0;
					header("location:code.php");
				}else{
					echo "<div class='info'>Something goes wrong
						<a href='login.php' class='btn btn-lg btn-success btn-block'>Please try again</a>
					</div>"; 
				}
			} 
			$_SESSION['user_id'] = $user->getUserID();
			$errLogin = true;
		}
		if(!$errLogin){
			if(!$user->isActive()) /*First we check if the user is active or blocked (blocked: if he tries to login more than 3 times) , if the user is active it means that it’s his first , second , of third try to login.*/
			{
				echo "<div class='info'>Your Account is blocked
							<a href='forgetPassword.php' class='btn btn-lg btn-success btn-block'>Reset Password</a>
						</div>";
			}else{
				echo "<div class='info'>Invalid user
							<a href='login.php' class='btn btn-lg btn-success btn-block'>Please try again</a>
						</div>";
				if($email == $session_email){
					if( $no_of_login < 3){ /*Then we check if the number of attempts is less than three.*/
						$_SESSION['no_of_login'] = ($no_of_login + 1);
						$_SESSION['email'] = $email; 
					}else{
						$text = "Your account blocked due too many falied login, you can reset your passowrd";
						sendTextEmail ($text, $email , $fromEmail, $fromPassword);
						$user->blockAccount($email); /*and the account will be blocked using the function “blockAccount” from “user” class , and an email will be sent to the user to reset password.*/
						echo "<h2>You exceed number of login, accont has blocked</h2>";
					}
				}
				else{
					$_SESSION['no_of_login'] = 0; /*2-If  the user tried to login with a different email we set attempts to zero.*/
					$_SESSION['email'] = $email;
				}
			}
			
		}
		 
	}else{
		if(!isset($_SESSION['admin']) || gettype($_SESSION['admin'])!="object")
		{
?>
				
				<form action="login.php" method="post">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Email" name="email" type="email" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
						</div> 
						<input type="submit" value="Login" class="btn btn-lg btn-success btn-block">
						<div class="form-group">
							New User? <a href="singup.php">Create your account now</a>
						</div> 
						<div class="form-group">
							Forget Password? <a href="forgetPassword.php">Reset your password</a>
						</div> 
					</fieldset>
					
				</form>
		
		<?php
		}else{
			
			echo "<meta http-equiv='refresh' content='1; url=index.php'>";
			echo "<div class='info'>You are already logged in..</div>";
			echo "<div class='info'><a href='index.php'>Click here to continue</a>.</div>";

		}
		?>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php
	}
	?>
 
 
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
