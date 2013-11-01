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
		function tweet_fav($twito,$id)
		{
			try
			{
				$resp = $twito->post('/favorites/create.json', array('id' => $id));
				return "ok";

			}
			catch(Exception $e)
			{
				$errors = json_decode($e->getMessage());
				if($errors->errors[0]->code == 139)
				{
					try
					{
						$resp = $twito->post('/favorites/destroy.json', array('id' => $id));
						return "unok";

					}
					catch(Exception $e)
					{
						$errors = json_decode($e->getMessage());
						return $errors->errors[0]->message;
					}
				}
				else
					return $errors->errors[0]->message;
			}

		}
		function tweet_unfav($twito,$id)
		{
			

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