<?php
	include ('../../controls/conf.php');
	if(isset($_POST['email']) and isset($_POST['password']))
	{
		$_email=$_POST['email'];
		$_pass=$_POST['password'];
		$user=R::findOne('bt_user','bt_em=?',array($_email));
		if($user)
		{
			if(sha1($_pass)==$user->bt_psw)
			{
				$result = array(
					"loginInfo"=>array(
						"status"=>"successLogin",
						"firstname"=>$user->bt_finm,
						"lastname"=>$user->bt_fanm,
						"sex"=>$user->bt_sx,
						"expireHash"=> md5("test")
					)
				);
				echo json_encode($result);
			}
			else
			{
				$result = array(
					"loginInfo"=>array(
						"status"=>"failed"
					)
				);
				echo json_encode($result);
			}
		}
		else
		{
			$result = array(
				"loginInfo"=>array(
					"status"=>"failed"
				)
			);
			echo json_encode($result);
		}
	}

?>