<?php

	$page_titel = "Add UsersInfo";
	include("classes/User.php"); 
	include("template/header.htm");
	include("classes/AES.php"); 
	include("classes/UsersInfo.php"); 

	$aesOb = new AES();
	$infoOb = new UsersInfo();
	$user = $_SESSION['user'];
	$userID = $user->getUserID(); 
	
	$userOb = new User(new DB());
	$userData = $userOb->getUser($userID);  
	
	?>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
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
	
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Update Profile</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
				

<?php
	  
	$email  = isset($_POST['email'])?$_POST['email']:$userData["email"];
	$password = isset($_POST['password'])?$_POST['password']: "";
	$name = isset($_POST['name']) ? $_POST['name'] : $userData["name"]; 
	
	if(isset($_POST['email']) && $_POST['email']!="" && $_POST['password']!="" )
	{
		if($userOb->updateData($name, $email, $password, $userID) )
		{			 
			echo "<div class='info'>Your account is updated
						<a href='index.php' class='btn btn-lg btn-success btn-block'>Back Home</a>
					</div>";
		}else{ 
			echo "<div class='info'>Couldn't update your account,
						<a href='index.php' class='btn btn-lg btn-success btn-block'>Back Home</a>
					</div>";
		}
	}else{  
?>
				
				<form action="profile.php" method="post">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="User Name" name="name" value="<?=$name?>" type="text" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Email" name="email" value="<?=$email?>"  type="email"  required>
						</div>
						<div class="form-group">
							<div id="mySecondPassword"></div>
							 
							
						</div> 
						<input type="submit" value="Update" class="btn btn-lg btn-primary">
						 
					</fieldset>
					
				</form>
		
		
	<?php
	}
	?>
				</div>
			</div> 
		</div> 

	<?php 


include("template/footer.htm");
?>
