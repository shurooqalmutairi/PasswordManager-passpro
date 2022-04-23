




<?php

/*to add,delete,and insert users information’s */


	$page_titel = "Add Information";
	include("classes/User.php"); 
	include("template/header.htm");
	include("classes/AES.php"); 
	include("classes/UsersInfo.php"); 

	$aesOb = new AES();
	$userInfoObj = new UsersInfo();
	$user = $_SESSION['user'];
	$userID = $user->getUserID();
	$title  = isset($_POST['title'])?$_POST['title']:""; 
	$info  = isset($_POST['info'])?$_POST['info']:"";  
	 
	?>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  

	
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add new information</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
				
	
	<?php
	if(isset($_GET['action']) && $_GET['action']=="delete")
	{
		$info_id = $_GET['info_id'];
		if(isset($_POST["yes"]))
		{
			if($userInfoObj->deleteUserInfo($userID  , $info_id)  ){
				echo "<div class='info'>UserInfo deleted successfully.</div>";
				echo "<meta http-equiv='refresh' content='5; url=index.php'>"; 
			}
		}elseif(isset($_POST["cancel"])){
			echo "<meta http-equiv='refresh' content='0; url=viewUserInfo.php?info_id=$info_id'>"; 
		}else{
		?>
		<form action="userInfo.php?action=delete&info_id=<?php echo $info_id;?>" method="post"  enctype="multipart/form-data" >
			<div class="form-group">
				Are you sure to delete this information?
				 
			</div>
			<input type="submit" class="btn btn-primary" name="yes" value="   Delete   "/> 
			<input type="submit" class="btn btn-primary" name="cancel" value="   Cancel   "/> 
		</form>
		<?php
		}
	}else if(isset($_GET['action']) && $_GET['action']=="edit")
	{
		$info_id = $_GET['info_id'];
		
		if(isset($_POST['title']) && $_POST['title'] != "" )
		{
			if($userInfoObj->editUserInfo($userID , $title,  $info , $info_id)  )
				echo "<div class='info'>Data updated successfully.</div>";
			 	
		}else{
			$row = $userInfoObj->getUserInfo($info_id);
			$title = $aesOb->dencrypt($row["title"]);
			$info = $aesOb->dencrypt($row["info"]); 
			 
			
	?>		
			<form action="userInfo.php?action=edit&info_id=<?php echo $info_id;?>" method="post" enctype="multipart/form-data">
				
				<fieldset>
					<div class="form-group">
						<input type="text" name="title" class="form-control" id="title" placeholder="Title" value="<?php echo $title;?>" required>
						 
					</div> 
					<div class="form-group">
						<input type="text" 
							name="info" class="form-control" 
							id="info" placeholder="Notes" value="<?php echo $info;?>" >
						 
					</div>
					<input type="submit" class="btn btn-primary" value="   Update   "/> 
					 
				</fieldset>
			</form> 
	<?php
			}
	}
	else
	{
		if( isset($_POST['title']) )
		{
			if($userInfoObj->insertNew($userID , $title, $info))
			{
				echo "<div class='info'>Data saved successfully.</div>";
			}else{
				echo "<div class='info'>Couldn't save the account.</div>";
			}
		}else{ 
			 
	?>
			<form action="userInfo.php" method="post"  enctype="multipart/form-data" >
				
				<fieldset>
					<div class="form-group">
						<input type="text" name="title" class="form-control" id="title" placeholder="Title" value="<?php echo $title;?>" required>
						 
					</div> 
					<div class="form-group">
						<input type="text" 
							name="info" class="form-control" 
							id="info" placeholder="Notes" value="<?php echo $info;?>" >
						 
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