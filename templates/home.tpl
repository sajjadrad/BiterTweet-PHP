	{if $valid_token == 'true'}
{include file="home_header.tpl" title="BiterTweet | Home"}
			<body>
				<div id="bt-infobox">
					<div id="img"><img src="{$profile_url}" /></div>
					<div id="twdes"><span id="twtsname">@ {$screenName}</span> {$des}</div>
					<div class="cl"></div>
					<div id="loc">{$location}</div>
					<div id="logout"><a href="logout.php">Logout</a></div>
					<div class="cl"></div>
				</div>
				<div id="bt-newtweet">
					<div class="container-fluid">
						<div class="row-fluid">
							<textarea maxlength="140" class="span12" id="tweet-content"></textarea>
							<div class="span10 tweet-counter" id="tweet-c">140</div>
							<div class="span1">
								<button id="send-tweet" data-loading-text="Tweeting..." class="btn btn-primary disabled">Tweet</button>
							</div>
						</div>
						<div class="row-fluid" style="margin-top:10px;">
							<div class="span12" id="errors">
								
							</div>
						</div>
					</div>
				</div>
				<div id="timeline">
					<div id="bt-tweets">
						<div id="bt-title"><h3>BiterTweet</h3></div>
						{for $index=0 to $timeline_count-1}
								<div id="{$timeline[$index].id_str}" class="bt-tweetbody">
									<div class="bt-img">
									{if $timeline[$index].retweeted_status.text == ''}
										<img src="{$timeline[$index].user.profile_image_url}" />
									</div>
									<div class="bt-tweet">
										<div class="scrn">
												<a href="http://twitter.com/{$timeline[$index].user.screen_name}">{$timeline[$index].user.name}</a>
									{else}
											<img src="{$timeline[$index].retweeted_status.user.profile_image_url}" />
										</div>
									<div class="bt-tweet">
										<div class="scrn">
												<a href="http://twitter.com/{$timeline[$index].retweeted_status.user.screen_name}">{$timeline[$index].retweeted_status.user.name}</a>
									{/if}
										</div> 
										<div class="bt-tweet-txt">{$tweetTxt[$index]}</div> 
										<div class="menu">
											<ul>
												<li>
													<a onClick="return false" href="#" class="retweet">
														Reply
													</a>
												</li>
												<li>
													<a onClick="return false" href="#" class="favorite">
														Favorite
													</a>
												</li>
											</ul>
										</div> 
									</div>
									<div class="cl"></div>
								</div>
						{/for}
					</div>
					<div id="lid">{$timeline[$timeline_count-1].id_str}</div>
					<div id="bt-tl-footer"><div id="loading"></div><div id="status">Load more</div></div>
				</div>
			</body>
		</html>
	{/if}