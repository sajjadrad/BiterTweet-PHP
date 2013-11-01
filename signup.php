<?php
		@session_start();
		print("		
			<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 4.01 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			<html>
			<head>
				<title>BiterTweet | Connect Twitter from anywhere</title>
				<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/signup-style.css\" />
				<script type=\"text/javascript\" src=\"js/jquery.js\"></script>
				<script type=\"text/javascript\" src=\"js/script-bt.js\"></script>
				<script type=\"text/javascript\" src=\"js/ajax/ajax.js\"></script>
				<script type=\"text/javascript\">
				        if (document.images) {
				            imgtemp = new Image();
				            imgtemp.src = \"images/loading.gif\";
				        }
				</script>
			</head>
		");
		if(!isset($_SESSION['user']))
		{
			$_SESSION['user']= 0;
		}
		include ('controls/conf.php');
		function getrandomstring($length,$temp) {

			   global $template;
			   settype($template, "string");
			   $template = $temp;
			   //"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			   /* this line can include numbers or not */

			   settype($length, "integer");
			   settype($rndstring, "string");
			   settype($a, "integer");
			   settype($b, "integer");
			   for ($a = 0; $a <= $length; $a++) {
					   $b = rand(0, strlen($template) - 1);
					   $rndstring .= $template[$b];
			   }
			   return $rndstring; 
		}
		function is_email($val)
		{
		  return (bool)(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",
		  $val));
		}
		print("
			<body>
			
				<div id=\"des\"><b>How can I use BiterTweet?</b><br/>
						BiterTweet is a Twitter app that supports web and client services,You can use BitterTweet on Web,Windows and Android now.for register on BiterTweet you need invitation.We are sorry for our limited service becuase of server bandwidth and control growth of users.
				</div>
				<div id=\"wrapper\">
					<div id=\"content\">
						<div id=\"header\"></div>
						<div id=\"body\">
							<div id=\"formContent\">
			");
			if(isset($_GET['invitation']))
			{
				if($_GET['invitation']=="free" and $_SESSION['user']<6)
				{
					$_SESSION['user']=$_SESSION['user']+1;
					print("
								<form action=\"signup.php\" method=\"POST\" autocomplete=\"off\" onsubmit=\"return formValid();\">
									<span>BiterTweet Sign Up</span>
									<div class=\"block\">");
										$token_string=getrandomstring(6,md5(rand()).getrandomstring(6,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"));
										$token=R::dispense('bt_token');
										$token->bt_tokenstr=$token_string;
										$token->bt_use=0;
										date_default_timezone_set("Asia/Tehran");
										$token->bt_date=date("d M Y - h:i:s");
										R::store($token);
										print("<input type=\"hidden\" value=\"$token_string\" name=\"_suToken\" />
										<div class=\"title\">Basic Information</div><hr>
										<div class=\"row\"><div class=\"opt\">First Name</div><div class=\"val\"><input maxlength=\"255\" id=\"sname\" type=\"text\" name=\"firstName\"/></div></div>
										<div class=\"row\"><div class=\"opt\">Family</div><div class=\"val\"><input id=\"fname\" maxlength=\"255\" type=\"text\" name=\"family\"/></div></div>
										<div class=\"row\"><div class=\"opt\">Sex</div>
											<div class=\"val\">
												<select name=\"sex\">
													<option value=\"0\">Male</option>
													<option value=\"0\">Female</option>
												</select>
											</div>
										</div>
									</div>
									<div class=\"block\">
										<div class=\"title\">User Information</div><hr>
										<div class=\"row\"><div class=\"opt\">Email</div><div class=\"val\"><input type=\"text\" id=\"email\" maxlength=\"255\" name=\"email\"/></div><div class=\"status\" id=\"emailValidation\"><a href=\"#\" onClick=\"checkVar(document.getElementsByName('email')[0].value)\">Check</a></div><div id=\"wait\"></div><div class=\"cl\"></div></div>
										<div class=\"row\"><div class=\"opt\">Password</div><div class=\"val\"><input type=\"password\" maxlength=\"255\" id=\"psw\" name=\"pass\"/></div></div>
										<div class=\"row\"><div class=\"opt\">Confirm Password</div><div class=\"val\"><input type=\"password\" maxlength=\"255\" id=\"cpsw\" name=\"cpass\"/></div></div>	
									</div>
									<div class=\"block\">
										<div class=\"row\"><input name=\"register\" type=\"submit\" value=\"Free Sign up\" /></div>
									</div>
								</form>
								");
				}
				else
				{
					print("
						<div id=\"message\">Your token has been expired.</div>
					");
				}
			}
			else if(isset($_POST['register']))
			{
				$_token=$_POST['_suToken'];
				$_finame=$_POST['firstName'];
				$_faname=$_POST['family'];
				$_sex=$_POST['sex'];
				$_email=$_POST['email'];
				$_pass=$_POST['pass'];
				$_cpass=$_POST['cpass'];
				$cnt=R::find('bt_token','bt_tokenstr=?',array($_token));
				$used;
				foreach($cnt as $cn)
				{
					$used=$cn->bt_use;
					break;
				}
				if(count($cnt)==0 or $used==1)
				{
					print("
						<div id=\"message\">Your token has been expired.<br/><span style=\"font-size:12px;\"><a href=\"signup.php\">I have invitation code</a></div></span>
					");
				}
				else
				{
						$error=0;
						$cnt=R::find('bt_user','bt_em=?',array($_email));
						if(count($cnt)>0)
						{
							$error=1;
						}
						if(strlen($_finame)<3)
						{
							$error=1;
						}
						if(strlen($_faname)<3)
						{
							$error=1;
						}
						if($_sex<0 and $_sex>1)
						{
							$error=1;
						}
						if(!is_email($_email))
						{
							$error=1;
						}
						if($_pass!=$_cpass)
						{
							$error=1;
						}
						if(strlen($_pass)<5)
						{
							$error=1;
						}
						if($error==1)
						{
							print("
								<form action=\"signup.php\" method=\"POST\" autocomplete=\"off\" onsubmit=\"return formValid();\">
									<span style=\"font-size:13px;\">There is some error(s):</span>
									<span style=\"color:#e61103\">
										<ul>
										");
											if(count($cnt)>0)
											{
												print("<li>This email address exist.</li>");
											}
											if(strlen($_finame)<3)
											{
												print("<li>First name must be at least 3 characters.</li>");
											}
											if(strlen($_faname)<3)
											{
												print("<li>Family must be at least 3 characters.</li>");
											}
											if($_sex<0 and $_sex>1)
											{
												print("<li>Please select your sex.</li>");
											}
											if(!is_email($_email))
											{
												print("<li>Email address is invalid.</li>");
											}
											if($_pass!=$_cpass)
											{
												print("<li>Password and confirm password doesn't match.</li>");
											}
											if(strlen($_pass)<5)
											{
												print("<li>Password must be at least 5 characters.</li>");
											}
										print("
										</ul>
									</span>
									<div class=\"block\">");
										print("<input type=\"hidden\" value=\"$_token\" name=\"_suToken\" />
										<div class=\"title\">Basic Information</div><hr>
										<div class=\"row\"><div class=\"opt\">First Name</div><div class=\"val\"><input id=\"sname\" type=\"text\" name=\"firstName\"/></div></div>
										<div class=\"row\"><div class=\"opt\">Family</div><div class=\"val\"><input id=\"fname\" type=\"text\" name=\"family\"/></div></div>
										<div class=\"row\"><div class=\"opt\">Sex</div>
											<div class=\"val\">
												<select name=\"sex\">
													<option value=\"0\">Male</option>
													<option value=\"0\">Female</option>
												</select>
											</div>
										</div>
									</div>
									<div class=\"block\">
										<div class=\"title\">User Information</div><hr>
										<div class=\"row\"><div class=\"opt\">Email</div><div class=\"val\"><input type=\"text\" id=\"email\" name=\"email\"/></div><div class=\"status\" id=\"emailValidation\"><a href=\"#\" onClick=\"checkVar(document.getElementsByName('email')[0].value)\">Check</a></div><div id=\"wait\"></div><div class=\"cl\"></div></div>
										<div class=\"row\"><div class=\"opt\">Password</div><div class=\"val\"><input type=\"password\" id=\"psw\" name=\"pass\"/></div></div>
										<div class=\"row\"><div class=\"opt\">Confirm Password</div><div class=\"val\"><input type=\"password\" id=\"cpsw\" name=\"cpass\"/></div></div>	
									</div>
									<div class=\"block\">
										<div class=\"row\"><input name=\"register\" type=\"submit\" value=\"Free Sign up\" /></div>
									</div>
								</form>
								");
						}
						else
						{
							R::exec("update bt_token set bt_use=1 where bt_tokenstr='$_token'");
							$user=R::dispense('bt_user');
							$user->bt_em=$_email;
							$user->bt_psw=$_pass;
							$user->bt_finm=$_finame;
							$user->bt_fanm=$_faname;
							$user->bt_sx=$_sex;
							R::store($user);
							print("
								<div id=\"message\">
									Your account created successfully.<br/>
									<span style=\"font-size:12px;text-align:left;\">
										By this account you can use your twitter account from everywhere,without any filtering and use BiterTweet features.<br/>
										You account is registered now and we will inform you by email.</br>
										stay in touch.<br/><a href=\"http://sajjadrad.com/bt\">Home Page</a>
									</span>
									
								</div>
							");
						}
				}
				
				
			}
			else
			{
				print("
					<div id=\"message\">
						For sign up you need invitation code.<br/>
						<span style=\"font-size:12px;\">Please enter here:</span>
						<form action=\"signup.php\" method=\"GET\" autocomplete=\"off\">
							<div style=\"margin-top:10px\"><input type=\"text\" size=\"10\" value=\"free\" name=\"invitation\" /></div>
							<div style=\"margin-top:10px\"><input type=\"submit\" name=\"sendInvitation\" value=\"Send\" /></div>
						</form>
					</div>
				");
			}
				print("
							</div>
						</div>
						<div id=\"footer\"></div>
					</div>
					
					<div id=\"page-footer\">
						<div class=\"item\"><div id=\"ques\"></div></div>
						<div id=\"cr\">Copyright 2012 BiterTweet.All Right Reserved.</br>Created by <a href=\"http://twitter.com/SajjadRad\">@Sajjad Rad</a></br>Graphic design by <a href=\"http://twitter.com/HRafiee91\">@Hossein Rafiee</a></div>
						<div class=\"cl\"></div>
					
					</div>
				</div>
				");
			
			print("
			</body>
			</html>
		");
			
?>