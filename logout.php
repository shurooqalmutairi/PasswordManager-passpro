<?php

$page_titel = "Log out page";
include("template/header.htm");

$_SESSION['user'] = null;
$_SESSION['user_id'] = null;
session_destroy();

?>

		<meta http-equiv='refresh' content='0; url=index.php'>

		<div class="errorbox notice">
			<p>You are logged out succcesfully</p>
		</div>
	

	
<?php
include("template/footer.htm");

?>