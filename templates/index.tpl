{include file="header.tpl" title="BiterTweet | Connect Twitter from anywhere"}
			<body>
				<div id="bt-sun"></div>
				<div id="bt-main">
					<div id="bt-clouds">
						<div id="bt-bt-container">
							<div id="click">
							</div>
							<div id="login">
								<div id="content">
									<form action="login.php" method="POST" autocomplete="On">
										<div class="row">
											<div class="inp">
												 <input name="email" type="text" class="span3" placeholder="Email">
											</div>
										</div>
										<div class="row">
											<div class="input-append">
												<input name="password" type="password" class="span2" placeholder="Password">
												<input class="btn btn-primary" type="submit" name="submitLogin" value="Login">
											</div>
										</div>
									</form>
								</div>
								<div id="sub"></div>
							</div>
							<div id="bt-biter" onClick="checkDiag()"></div>
						</div>
					</div>
				</div>
{include file="footer.tpl"}
				