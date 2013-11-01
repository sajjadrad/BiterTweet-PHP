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
		function make_tweet_linkable($text) {
			  return preg_replace_callback(
			    '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', 
			    create_function(
			      '$matches',
			      'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
			    ),
			    $text
			  );
		}
		function make_mention_linkable($text) {
			  return preg_replace_callback(
			    '/@+[a-zA-Z0-9_]*/', 
			    create_function(
			      '$matches',
			      'return "<a href=\'http://twitter.com/{$matches[0]}\'>{$matches[0]}</a>";'
			    ),
			    $text
			  );
		}
		function gusertimeline_max($id,$count,$twito)
		{
			$resp = $twito->get("/statuses/home_timeline.json",array("max_id"=>"$id","count"=>"$count"));
			return $resp;
		}
		function gusertimeline($count,$twito)
		{
			$resp = $twito->get("/statuses/home_timeline.json",array("count"=>"$count"));
			return $resp;
		}
		function gscreenname($twito)
		{
			$twitterInfo= $twito->get_accountVerify_credentials();
			$screenName=$twitterInfo->screen_name;
			return $screenName;
		}
        function guserinfo($screenName,$twito)
		{
			$resp = $twito->get("/users/show.json",array("screen_name"=>"{$screenName}"));
			return $resp;
		}
	}
?>