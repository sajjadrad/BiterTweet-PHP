<?php
	require('rb.php');
	$dbname='DATABASE_NAME';
	$dbUser='DATABASE_USERNAME';
	$dbPass='USER_PASSWORD';
	R::setup('mysql:host=localhost;dbname='.$dbname,$dbUser,$dbPass);
?>