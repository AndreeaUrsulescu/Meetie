<!DOCTYPE html>
<html>
	<head>
		<title> Meetie </title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
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
		</script>

		<div class="all">
			
			<img id="cover" src="<?php echo base_url('assets/images/cover3.jpg'); ?>">
			<div class="shadow">
			<label class="middleText" style="margin-left: 23%">Plan your meetings and always keep your friends close. That's what Meetie does for you</label>
				<div class="middle">
					<div class="patrate">
						<div class="shape1"></div>
						<div class="shape2"></div> 
						<div class="shape3"></div>
						<label class="meetie">Meetie</label>
					</div>
					<div class="subtitlu" id="facebook" onclick="logInWithFacebook()">
						<img src="<?php echo base_url('assets/images/facebook.png'); ?>" class="ball">
						<label class="subtitleText">Login with Facebook</label>
					</div>
					<div class="subtitlu google" id="authorize-button" onclick="googleLogin()">
						<img src="<?php echo base_url('assets/images/google.png'); ?>" class="ball">
						<label class="subtitleText">Login with Google+</label>
					</div>
					<div class="subtitlu" id="twitter" onclick="twitterlogin()">
						<img src="<?php echo base_url('assets/images/twitter.jpg'); ?>" class="ball">
						<label class="subtitleText">Login with Twitter</label>
					</div>
				</div>
				<div class="footer"></div>
				<div class="footer2"></div>
			</div>
		</div>
		<script src="<?php echo base_url('assets/scripts/scripts.js'); ?>" type="text/javascript"></script> 
	</body>
</html>