<!DOCTYPE HTML>
<!--
	HTML by
		Identity by HTML5 UP
		html5up.net | @n33co
		Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
	Scripting by Jakob Wedemeyer | jakob-wedemyer.de
-->
<?php
include 'user.php';
include 'session.php';
require 'db_conf.inc.php';

$q = $_REQUEST['q'];
$person = new User(readDB($q));

function readDB($identifier)
{
	$con  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$con->set_charset('utf8');
	if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
	if (is_numeric($identifier)) {
		$sql = "SELECT * FROM user WHERE UUID=$identifier";
	}
	else {
		$sql = "SELECT * FROM user WHERE handle REGEXP '$identifier'";
	}
	$retval = $con->query($sql);
	if(! $retval ) {
		die("Could not get data: (" . $con->errno.")". $con->error);
	}
	$arr = $retval->fetch_array(MYSQLI_ASSOC);
	return $arr;
}
/*function fbav($id)
{
	$request = new FacebookRequest(
  	$session,
  	'GET',
  	"/$id/picture"
	);
	$response = $request->execute();
	$graphObject = $response->getGraphObject();
	$pic_url = $graphObject->getProperty('data')['url'];
	return $pic_url;
}*/
?>

<html>

<head>
	<title>
		<?php $person->displayName ?>
	</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />
	<script src="assets/js/own.js" type="text/javascript"></script>
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-loading bg_norm">
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<section id="main">
			<header>
				<span class="avatar">
					<div id="avatar_wrap">
						<div class=" av_wrap switched" id="snapped">
							<img src=<?php echo $person->sccode ?> id="snap_svg"/>
							<svg xmlns="http://www.w3.org/2000/svg" id="snap_avatar" xmlns:xlink="http://www.w3.org/1999/xlink" width="122" height="122">
					  		<image xlink:href="https://graph.facebook.com/<?php echo $person->uuid ?>/picture" width="122" height="122" clip-path="url(#ghost)"></image>
							</svg>
						</div>
						<div class="av_wrap switched" id="av">
							<img src="https://graph.facebook.com/<?php echo $person->uuid ?>/picture" id="avatar" onmouseover="fade('av');" onmouseleave="fade('av')"/>
						</div>
				</div>
				</span>
				<h1><?php echo $person->displayName ?></h1>
				<p style="margin: 0 0 0 0;"><?php echo $person->tagline[1] ?></p>
				<p><?php echo $person->tagline[2] ?></p>
			</header>
			<footer>
				<ul class="icon_color icons">
					<li><a href="https://twitter.com/<?php echo $person->twhandle?>" class="fa-twitter link">Twitter</a></li>
					<li><a href="https://www.instagram.com/<?php echo $person->insta ?>" class="fa-instagram">Instagram</a></li>
					<li><a href="<?php echo $person->website?>" class="fa-coffee link">Blog</a></li>
					<li><a href="https://www.facebook.com/<?php echo $person->fbuname ?>" class="fa-facebook link">Facebook</a></li>
				</ul>
			</footer>
		</section>

		<!-- Footer -->
		<footer id="footer">
			<ul class="copyright">
				<li>&copy; <a href="mailto:mail@jakob-wedemyer.de">Jakob Wedemeyer</a> 2016</li>
				<li>Design: <a href="http://html5up.net">HTML5 UP</a> modified by <a href="http://jakob-wedemyer.de">Jakob Wedemeyer</a></li>
				<li><a href="admin/login.php">Login</a></li>
			</ul>
		</footer>
		<svg width="0" height="0">
			<defs>
				<clipPath id="ghost">
					<path fill="#000000" d="M519.13,180.79c27.04,0,54.42,5.88,79.08,16.94c40.83,18.31,74.18,52.87,90.69,94.6c9.45,23.89,9.73,51.4,9.51,76.72c-0.13,14.61-0.82,29.2-1.66,43.78c-0.43,7.33-0.89,14.65-1.35,21.98c-0.25,4.02-0.5,8.04-0.74,12.06c-0.15,2.59-1.05,6.09-0.48,8.64c1.25,5.61,10.15,9.35,15.06,10.9c12.97,4.08,26.53,1.14,39.01-3.31c7.44-2.65,14.14-7.09,22.3-6.34c5.91,0.54,12.76,3.18,16.97,7.46c4.42,4.5,3.49,8.94-0.31,13.25c-7.22,8.19-19.14,12.85-29.22,16.17c-11.04,3.63-22.24,6.86-32.53,12.39c-10.14,5.45-19.5,13.29-23.5,24.42c-4.65,12.94-0.77,26.1,4.7,38.08c9.29,20.35,21.36,39.42,35.47,56.78c26.38,32.46,60.86,58.79,101.3,70.8c5.94,1.76,11.96,3.22,18.05,4.36c2.58,0.48,4.25-0.11,3.34,2.64c-0.12,0.35-0.36,0.68-0.54,0.99c-1.35,2.26-3.56,4.07-5.66,5.6c-11.92,8.72-27.62,12.73-41.7,16.18c-6.66,1.64-13.38,3.05-20.12,4.32c-6.7,1.26-14.86,1.29-21.12,4.01c-10.45,4.53-12.01,20.12-14.14,29.74c-0.83,3.76-1.69,7.51-2.69,11.23c-0.89,3.3-0.62,4.99-4.14,5.04c-6.04,0.1-12.12-1.5-18.02-2.59c-13.89-2.56-27.98-3.93-42.11-3.59c-15.44,0.37-31.21,2.15-45.56,8.12c-13.73,5.72-26.01,14.35-38.1,22.88c-21.13,14.91-42.59,29.7-68.27,35.39c-12.87,2.85-26.18,3.15-39.31,2.73c-14-0.45-27.79-3.36-40.78-8.57c-24.77-9.94-44.92-27.53-67.27-41.61c-12.7-8-26.19-14.34-41.11-16.68c-15.83-2.49-31.92-2.99-47.86-1.29c-6.19,0.66-12.33,1.64-18.45,2.79c-5.99,1.12-12.47,3.24-18.6,3c-2.89-0.12-2.92-0.99-3.69-3.7c-1.13-4.03-2.06-8.11-2.96-12.2c-1.38-6.25-2.54-12.65-4.79-18.66c-1.76-4.7-4.36-9.49-9.07-11.76c-6.02-2.9-14.26-2.84-20.8-4.07c-12.18-2.28-24.33-4.98-36.16-8.72c-10.16-3.21-22.41-7.12-30.06-15.04c-0.73-0.75-1.45-1.55-1.99-2.45c-0.18-0.29-0.43-0.61-0.53-0.94c-0.83-2.55,0.16-2.2,2.65-2.66c11.77-2.16,23.31-5.49,34.41-9.95c20.32-8.14,39.02-19.98,55.57-34.27c24.28-20.95,44.38-47.03,59.37-75.35c5.12-9.68,10.62-20.27,12.35-31.08c4.35-27.14-17.99-42.5-40.51-50.69c-11.96-4.35-24.29-7.33-35.45-13.67c-5.09-2.89-14.98-8.66-14.21-15.87c0.58-5.48,7.36-9.18,11.89-10.88c3.07-1.15,6.44-1.9,9.74-1.72c3.97,0.22,7.37,2.32,10.99,3.8c13.15,5.39,27.86,9.23,42.14,7.01c7.14-1.11,14.54-3.82,19.69-9.08c1.24-1.27,1.7-1.8,1.98-3.34c0.51-2.84-0.37-6.63-0.53-9.47c-0.45-7.58-0.94-15.16-1.41-22.74c-1.79-28.91-3.52-58.05-1.37-86.99c0.92-12.41,2.54-24.93,6.16-36.87c3.6-11.86,9.63-23.12,16.09-33.65c11.91-19.4,27.38-36.53,45.81-49.93c27.01-19.65,59.62-30.92,92.76-34.08C497.89,180.77,508.53,180.79,519.13,180.79"
							transform="scale(0.119140625, 0.119140625)" />
				</clipPath>
			</defs>
		</svg>

	</div>

	<!-- Scripts -->
	<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
	<script>
		/*if ('addEventListener' in window) {
					document.getElementById('avatar_span').addEventListener('mouseover', snapper())
				}*/
		if ('addEventListener' in window) {
			window.addEventListener('load', function() {
				document.body.className = document.body.className.replace(/\bis-loading\b/, '');
			});
			document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
		}
	</script>

</body>

</html>
