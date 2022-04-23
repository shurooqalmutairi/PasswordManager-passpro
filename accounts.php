<?php

	$page_titel = "Add Account";
	include("classes/User.php"); 
	include("template/header.htm");
	include("classes/AES.php"); 
	include("classes/Account.php"); 

	$aesOb = new AES();
	$accountOb = new Account();
	$user = $_SESSION['user'];
	$userID = $user->getUserID();
	$account_name  = isset($_POST['account_name'])?$_POST['account_name']:""; 
	$notes  = isset($_POST['notes'])?$_POST['notes']:""; 
	$email  = isset($_POST['email'])?$_POST['email']:""; 
	$password  = isset($_POST['password'])?$_POST['password']:""; 
	 
	?>
	
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
				toggleButtonClass: 'btn btn-default'
			});
  		});
		
		var password=document.getElementById("password1"); 
		/*genPassword function is used to generate complex strong passwords and it takes every number, letter, simple.
fist we gave the function all possible numbers, characters, small letters ,and capital letters. 
with the password length 12 characters.*/

/*The function loops generate a random number between zero and the size of the number of letters so that the letter corresponding to the random number is chosen.
then we have “password1” for hiding the password and “password2” for showing the password */

		 function genPassword() {
			var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			var passwordLength = 12;
			var password = "";
			for (var i = 0; i <= passwordLength; i++) {
			   var randomNumber = Math.floor(Math.random() * chars.length);
			   password += chars.substring(randomNumber, randomNumber +1);
			} 
			document.getElementById("password1").value = password;
			document.getElementById("password2").value = password;
		 }

		function copyPassword() {
			var copyText = document.getElementById("password1"); 
			copyText.select();
			copyText.setSelectionRange(0, 99999);
			navigator.clipboard.writeText(copyText.value); 
		}
		function copyEmail() {
			var copyText = document.getElementById("email"); 
			copyText.select();
			copyText.setSelectionRange(0, 99999);
			navigator.clipboard.writeText(copyText.value); 
		}
	</script>

	
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add new account</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
				
	
	<?php
	if(isset($_GET['action']) && $_GET['action']=="delete")
	{
		$account_id = $_GET['account_id'];
		if(isset($_POST["yes"]))
		{
			if($accountOb->deleteAccount($userID  , $account_id)  ){
				echo "<div class='info'>Account deleted successfully.</div>";
				echo "<meta http-equiv='refresh' content='5; url=index.php'>"; 
			}
		}elseif(isset($_POST["cancel"])){
			echo "<meta http-equiv='refresh' content='0; url=viewAccount.php?account_id=$account_id'>"; 
		}else{
		?>
		<form action="accounts.php?action=delete&account_id=<?php echo $account_id;?>" method="post"  enctype="multipart/form-data" >
			<div class="form-group">
				Are you sure to delete this account?
				 
			</div>
			<input type="submit" class="btn btn-primary" name="yes" value="   Delete   "/> 
			<input type="submit" class="btn btn-primary" name="cancel" value="   Cancel   "/> 
		</form>
		<?php
		}
	}else if(isset($_GET['action']) && $_GET['action']=="edit")
	{
		$account_id = $_GET['account_id'];
		
		if(isset($_POST['account_name']) && $_POST['account_name'] != "" )
		{
			if($accountOb->editAccount($userID , $account_name, $email, $password, $notes , $account_id)  )
				echo "<div class='info'>Data updated successfully.</div>";
			 	
		}else{
			$row = $accountOb->getAccount($account_id);
			$account_name = $aesOb->dencrypt($row["account_name"]);
			$notes = $aesOb->dencrypt($row["notes"]);
			$email = $aesOb->dencrypt($row["email"]); 
			 
			
	?>		
			<form action="accounts.php?action=edit&account_id=<?php echo $account_id;?>" method="post" enctype="multipart/form-data">
				
				<fieldset>
					<div class="form-group">
						<input type="text" name="account_name" class="form-control" id="account_name" placeholder="Account Name" value="<?php echo $account_name;?>" required>
						 
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="Email" id="email"  name="email" type="email" value="<?php echo $email;?>" required>
					</div>
					<div class="form-group">
						<div id="mySecondPassword"></div> 
						<a href="#" onclick="genPassword()" class="btn btn-default">Generate Password</a>
						<a href="#" onclick="copyPassword()" class="btn btn-default">Copy Password</a>
					</div>   
					<div class="form-group">
						<input type="text" 
							name="notes" class="form-control" 
							id="notes" placeholder="Notes" value="<?php echo $notes;?>" >
						 
					</div>
					<input type="submit" class="btn btn-primary" value="   Update   "/> 
					 
				</fieldset>
			</form> 
	<?php
			}
	}
	else
	{
		if( isset($_POST['account_name']) )
		{
			if($accountOb->insertNew($userID , $account_name, $email, $password, $notes))
			{
				echo "<div class='info'>Data saved successfully.</div>";
			}else{
				echo "<div class='info'>Couldn't save the account.</div>";
			}
		}else{ 
			 
	?>
			<form action="accounts.php" method="post"  enctype="multipart/form-data" >
				
				<fieldset>
					<div class="form-group">
						<input type="text" name="account_name" class="form-control" id="account_name" placeholder="Account Name" value="<?php echo $account_name;?>" required>
						 
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="Email" id="email"  name="email" type="email"  required>
					</div>
					<div class="form-group">
						<div id="mySecondPassword"></div> 
						<a href="#" onclick="genPassword()" class="btn btn-default">Generate Password</a>
						<a href="#" onclick="copyPassword()" class="btn btn-default">Copy Password</a>
					</div>  
					<div class="form-group">
						<input type="text" 
							name="notes" class="form-control" 
							id="notes" placeholder="Notes" value="<?php echo $notes;?>" >
						 
					</div>
					<input type="submit" class="btn btn-primary" value="   Add   "/> 
					 
				</fieldset>
			</form>
			
	<?php
			}
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