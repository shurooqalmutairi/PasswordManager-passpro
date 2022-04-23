<?php
		/*Is for adding data and viewing the list of accounts.*/

	$page_titel = "Password Manager";
	include("classes/User.php"); 
	include("template/header.htm");
	include("classes/AES.php");  /*used the decryption method in “showAccountsTable” function to decrypt the account name*/
	include("classes/Account.php"); 
	
	$accountOb = new Account();
	$user = $_SESSION['user'];/* Used as a cache memory to remember the current user.*/
	$userID = $user->getUserID();
?>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
				
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome to Password Manager  </h1>
					</div>
                    <!-- /.col-lg-12 -->
                </div> 
                <!-- /.row -->
				<div class="row" > 
					<table width="100%" class="table">
						<thead>
							<tr role="row">
								
								<th>Account Name</th> 
								<th width="40">View</th>          
							</tr>
						</thead>
						<tbody>
						<?php echo $accountOb->showAccountsTable($userID); ?> <!-- to show all the accounts that associated with the current user. -->

						</tbody>
					</table> 
				</div>
				
			</div>
			<!-- /.container-fluid -->
		</div>
        <!-- /#page-wrapper -->
	

	
<?php
include("template/footer.htm");

?>