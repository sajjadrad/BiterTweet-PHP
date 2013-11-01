<?php
	require('libs/Smarty.class.php');
	$smarty = new Smarty;

	$smarty->debugging = false;
	$smarty->caching = true;
	$smarty->cache_lifetime = 120;

	$smarty->assign("page","index",true);
	if(isset($_POST['submitLogin']))
	{
		echo "Yes";
	}
	else
	{
		$smarty->display('index.tpl');
	}
?>