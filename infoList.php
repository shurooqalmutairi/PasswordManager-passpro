<?php
	
	$page_titel = "Password Manager";
	include("classes/User.php"); 
	include("template/header.htm");
	include("classes/AES.php"); 
	include("classes/UsersInfo.php"); 
	
	$userInfoOb = new UsersInfo();
	$user = $_SESSION['user'];
	$userID = $user->getUserID();
?>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
				
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Your saved Information List  </h1>
					</div>
                    <!-- /.col-lg-12 -->
                </div> 
                <!-- /.row -->
				<div class="row" > 
					<table width="100%" class="table">
						<thead>
							<tr role="row">
								
								<th>Title</th> 
								<th width="40">View</th>          
							</tr>
						</thead>
						<tbody>
						<?php echo $userInfoOb->showUserInfosTable($userID); ?>

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