<!DOCTYPE html>
<html>
	<head>
		<title> Meetie </title>
	</head>

	<body>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/oauth.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/facebook.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/twitter.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/utils.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/google.js'); ?>"></script>
		<script>
			removeLocalData();
			initializeOAuth();
			//initializeOAuthGoogle();
		</script>

		<button onclick="logInWithFacebook()">Sign in with Facebook</button>

		<button id="authorize-button" onclick="googleLogin()">Sign in with Google+</button>

		<button onclick="twitterlogin()">Twitter</button>

		<div id="status">
		</div>
		
	</body>
</html>