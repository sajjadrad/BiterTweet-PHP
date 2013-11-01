<?php 
	@session_start();
	if(isset($_SESSION['_validUser']))
	{
		include 'lib/EpiCurl.php';
		include 'lib/EpiOAuth.php';
		include 'lib/EpiTwitter.php';
		include 'lib/secret.php';
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		$url = $twitterObj->getAuthorizationUrl();
        echo "<a style=\"margin-top:10px;\" class=\"btn btn-large btn-block btn-primary\" href='$url'>Connect Your Twitter</a></br><a class=\"btn btn-mini\" style=\"margin-top:10px;\" href=\"logout.php\">logout</a>";
	}
?>