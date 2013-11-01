<?php 
	@session_start();
	if(isset($_SESSION['_validUser']))
	{
		include 'lib/EpiCurl.php';
		include 'lib/EpiOAuth.php';
		include 'lib/EpiTwitter.php';
		include 'lib/secret.php';
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		$twitterObj->setToken($_token,$_stoken);
		function postTweet($twito,$statusTxt)
		{
			$update_status = $twito->post_statusesUpdate(array('status' => $statusTxt));
			//echo $update_status->response;
		}
		function postTweet_web($twito,$statusTxt)
		{
			try
			{
				$update_status = $twito->post_statusesUpdate(array('status' => $statusTxt));
				//echo $update_status->response;
				return "sent";

			}
			catch(Exception $e)
			{
				$errors = json_decode($e->getMessage());
				return $errors->error;
			}
		}
	}
?>