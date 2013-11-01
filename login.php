<?php
	ob_start();
	@session_start();
	include ('controls/conf.php');
	require('libs/Smarty.class.php');
	

	$smarty = new Smarty;

	$smarty->debugging = false;
	$smarty->caching = false;
	$smarty->cache_lifetime = 120;

	$smarty->assign("login","not",true);
	if(isset($_POST['submitLogin']))
	{
		$_email=$_POST['email'];
		$user=R::findOne('bt_user','bt_em=?',array($_email));
		if($user)
		{
			$_pass=$_POST['password'];
			$_dbpass=$user['bt_psw'];
			if(sha1($_pass)==$_dbpass)
			{
				$_SESSION['_validUser'] = $user->id;
				$tokenquery=R::findOne('bt_tokenkey','bt_userID=?',array($user->id));
				if($tokenquery)
					$_SESSION['_validToken']=1;
				else if(!$tokenquery and isset($_SESSION['_validToken']))
					unset($_SESSION['_validToken']);
				header('Location: home.php');
				//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=home.php">';
			}
			else
			{
				$smarty->assign("login","wrong",true);
			}
		}
		else
		{
			$smarty->assign("login","wrong",true);
		}
	}
	else
	{
		$smarty->assign("login","not",true);
	}
	$smarty->display('login.tpl');
	ob_flush();
?>