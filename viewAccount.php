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
	$account_id = $_GET["account_id"] ?? 0;/*to get the digits of the account id , if it was more than 0 we called “getAccount” function from “Account” class.
	The function is used as a data base to store the id digits. And we search for the id that has been entered . then we read and decrypt all of the user information's */
	
	if($account_id > 0){
		$accountData = $accountOb->getAccount($account_id); 
		$account_name  = $aesOb->dencrypt($accountData['account_name']); 
		$notes  = $aesOb->dencrypt($accountData['notes']); 
		$email  = $aesOb->dencrypt($accountData['email']); 
		$password  = $aesOb->dencrypt($accountData['password']); 
		
	}
	
	
	?>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> 
	<style>
		.copy{
			width: 25px;
			height: 25px;
		}
		
		#snackbar {
		  visibility: hidden;
		  min-width: 250px;
		  margin-left: -125px;
		  background-color: #333;
		  color: #fff;
		  text-align: center;
		  border-radius: 2px;
		  padding: 16px;
		  position: fixed;
		  z-index: 1;
		  left: 50%;
		  bottom: 30px;
		  font-size: 17px;
		}

		#snackbar.show {
		  visibility: visible;
		  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
		  animation: fadein 0.5s, fadeout 0.5s 2.5s;
		}

		@-webkit-keyframes fadein {
		  from {bottom: 0; opacity: 0;} 
		  to {bottom: 30px; opacity: 1;}
		}

		@keyframes fadein {
		  from {bottom: 0; opacity: 0;}
		  to {bottom: 30px; opacity: 1;}
		}

		@-webkit-keyframes fadeout {
		  from {bottom: 30px; opacity: 1;} 
		  to {bottom: 0; opacity: 0;}
		}

		@keyframes fadeout {
		  from {bottom: 30px; opacity: 1;}
		  to {bottom: 0; opacity: 0;}
		} 
	</style>
	
	<script>  

		function showToast() {
		  var x = document.getElementById("snackbar");
		  x.className = "show";
		  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		}
		/*copy function: can copy the data and then create a text “snackbar” to pop on the screen “massage copied to clipboard”*/
		function copy(id) { 
			var copyText = document.getElementById(id).innerText;  
			navigator.clipboard.writeText(copyText); 
			document.getElementById("snackbar").innerText = id+" Copied to clipboard";  
			showToast();
		} 
	</script>

	
	<!-- Page Content -->
	<!-- we viewed the encrypted information’s (email and password)          
-we called the copy function: to copy the email and password “on click” when the button is pressed.-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$account_name?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
				
					<div class="row" > 
						<table width="100%" class="table"> 
							<tbody>
								<tr role="row"> 
									<td width="10%"><b>Email:</b></td> 
									<td><?=$email?></td>      
									<td><span id="email" style="display:none"><?=$email?></span><a href="#email" onclick="copy('email')"><img src="images/copy.png" class="copy"/></a></td>        
								</tr> 

								<tr role="row"> 
									<td width="10%"><b>Password:</b></td> 
									<td>***************</td>          
									<td><span id="password" style="display:none"><?=$password?></span><a href="#password" onclick="copy('password')"><img src="images/copy.png" class="copy"/></a></td>          
								</tr> 

								<tr role="row"> 
									<td width="10%"><b>Notes:</b></td> 
									<td colspan="2"><?=$notes?></td>           
								</tr> 

							</tbody>
						</table> 
					</div>
					<div  class="col-lg-6">
							<a href="accounts.php?action=delete&account_id=<?=$account_id?>" class="btn btn-primary">Delete Account</a>
					</div> 
					<div  class="col-lg-6">
							<a href="accounts.php?action=edit&account_id=<?=$account_id?>" class="btn btn-primary">Update Account</a>
					</div> 
					<div id="snackbar"></div>
				</div>
			</div> 
		</div> 

	<?php 


include("template/footer.htm");

?>