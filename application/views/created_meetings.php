<!DOCTYPE html>
<html>
	<head>
		<title>Meetie</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
	</head>

	<body>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/oauth.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/facebook.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/twitter.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/createdMeeting.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/google.js'); ?>"></script>
		
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script src="https://apis.google.com/js/client:platform.js" async defer></script>
		<script >
 			window.___gcfg = {
    	 		lang: 'en_US',
    	 		parsetags: 'onload'
  			};
		</script>

		<script>
			initializeOAuth();
			var invitations = [];

			$.ajax({
			    url:'/meetie/index.php/created_meetings/getAll',
			    type: 'GET',
			    success: function(data){
			       	invitations = $.parseJSON(data);
			     	getNetworkId();
			    },
			    error: function(){
			    	console.log("Fail");
			    }
			 	});
		</script>

		<script>

			window.fbAsyncInit = function() {
				FB.init({
		    	appId      : '1520377664890574',
		    	cookie     : true,  
		    	xfbml      : true,  // parse social plugins on this page
		   		version    : 'v2.2' 
			});
			};
						

		// Load the SDK asynchronously
			(function(d, s, id) {
			   	var js, fjs = d.getElementsByTagName(s)[0];

			   	if (d.getElementById(id)) return;
			   	js = d.createElement(s); js.id = id;
			   	js.src = "//connect.facebook.net/en_US/sdk.js";
			   	fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		<div class="all">
			<img id="cover" src="<?php echo base_url('assets/images/cover3.jpg'); ?>">
			<div class="shadow2">
				<a href="<?php echo base_url('index.php/home'); ?>"><img id="arrow" src="<?php echo base_url('assets/images/arrow.png'); ?>"></a>
				<img id="profile"/>
				<a class="delogare" href="<?php echo base_url('index.php/logout'); ?>">Logout</a>

				<div id="searchDiv">
					<label for="searchByTitle" class="fors"> Title </label>
					<input id="searchByTitle" type="text" name="searchByTitle"/><br />

					<label for="searchByCreator" class="fors"> Creator </label>
					<input id="searchByCreator" type="text" name="searchByCreator"/><br />

					<label for="searchByType" class="fors"> Type </label>
					
					<select id="searchByType" name="searchByType">
						<option value=''></option>
						<option value="unique">Unique</option>
						<option value="daily">Daily</option>
						<option value="weekly">Weekly</option>
						<option value="monthly">Monthly</option>
					</select><br />

					<button id="multipleSearch" onclick="searchByFields('myInvitations')">Search</button>
				</div>

				<div class="middle3">
						<div class="partOne" id="par">
						
						</div>

						<div class="partTwo" id="impar">
		
					</div>


				</div>
				<div class="footer"></div>
				<div class="footer2"></div>
			</div>
									
		</div>
		<button id='sharePost' hidden></button>
		<script src="<?php echo base_url('assets/scripts/scriptsCreare.js'); ?>"  type="text/javascript"></script> 
	</body>
</html>