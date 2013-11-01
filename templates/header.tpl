	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html>
			<head>
				<title>{$title}</title>
				<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
				<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
				<script type="text/javascript" src="js/jquery.js"></script>
				<script type="text/javascript" src="js/script-bt.js"></script>
				<script type="text/javascript">
					var flag=false;
					function checkDiag()
					{
						if(!flag)
						{
							showLogin();
							flag=true;
						}
						else
						{
							hideLogin()
							flag=false;
						}
					}
					function showLogin()
					{
						$('#click').fadeOut("fast");
						$('#login').fadeIn("normal");
					}
					function hideLogin()
					{
						$('#login').fadeOut("normal");
						$('#click').fadeIn("fast");
					}
					if (document.images) {
				            imgtemp = new Image();
				            imgtemp.src = "/assets/img/sub.png";
				            imgtemp2 = new Image();
							imgtemp2.src = "images/loading-tw.gif";
				    }
				</script>
			</head>
