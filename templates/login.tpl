{include file="header.tpl" title="BiterTweet | Login"}
		{if $login =='not'}
			<body>
				<div id="bt-message">
					<div id="content">
						<span id="message-txt" style="color:#000;">login with your BT username and password.</span>
						<div class="message-content" style="margin-top:20px;">
							<form action="login.php" method="POST">
									<input name="email" class="span3" type="text" placeholder="Email">
									<div class="input-append">
										<input class="span2" type="password" placeholder="Password" name="password">
										<input class="btn btn-primary" type="submit" value="Login" name="submitLogin">
									</div>
							</form>
						</div>
					</div>
				</div>
			</body>
		{else if $login=='wrong'}
			<body>
				<div id="bt-message">
					<div id="content">
						<span id="message-txt">Username or password is invalid.</span>
						<div class="message-content" style="margin-top:20px;">
							<form action="login.php" method="POST">
									<input name="email" class="span3" type="text" placeholder="Email">
									<div class="input-append">
										<input class="span2" type="password" placeholder="Password" name="password">
										<input class="btn btn-primary" type="submit" value="Login" name="submitLogin">
									</div>
							</form>
						</div>
					</div>
				</div>
			</body>

		{/if}
{include file="footer.tpl"}
				