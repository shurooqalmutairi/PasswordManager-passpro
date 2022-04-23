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
	$info_id = $_GET["info_id"] ?? 0;
	
	if($info_id > 0){
		$infoData = $infoOb->getUserInfo($info_id); 
		$title  = $aesOb->dencrypt($infoData['title']); 
		$info  = $aesOb->dencrypt($infoData['info']); 
		$addDate  =  $infoData['addDate'] ;
	}
	
	
	?>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> 
	 

	
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$title?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
				
					<div class="row" > 
						<table width="100%" class="table"> 
							<tbody>

								<tr role="row"> 
									<td width="10%"><b>Note:</b></td> 
									<td><?=$info?></td>           
								</tr> 

								<tr role="row"> 
									<td width="10%"><b>Added Date:</b></td> 
									<td colspan="2"><?=$addDate?></td>           
								</tr> 
 
							</tbody>
						</table> 
					</div>
					<div  class="col-lg-6">
							<a href="userInfo.php?action=delete&info_id=<?=$info_id?>" class="btn btn-primary">Delete Info</a>
					</div> 
					<div  class="col-lg-6">
							<a href="userInfo.php?action=edit&info_id=<?=$info_id?>" class="btn btn-primary">Update Info</a>
					</div>  
				</div>
			</div> 
		</div> 

	<?php 


include("template/footer.htm");

?>