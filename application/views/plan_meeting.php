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
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/utils.js'); ?>"></script>
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

			window.fbAsyncInit = function() {
				FB.init({
		    	appId      : '1520377664890574',
		    	cookie     : true,  
		    	xfbml      : true,  // parse social plugins on this page
		   		version    : 'v2.2' 
			});
				getUserName();
				getUserFriends();
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
				<div class="middle2">
					
						<div class="partOne">
							<div class="form1">
								<br><br>
							
								<div class="fields">
									<label class="labels">Title </label>
									<input id="title" type="text">
								</div>
									<br>
								<div style="height: 90px; margin-top: 5px;">
									<label class="labels">Description </label>
									<textarea id="txt"></textarea>
								</div>
									<br>
								<div class="fields">
									<label class="labels">Location </label>
									<input id="location" type="text">
								</div>
									<br>
								<div class="fields">
									<label class="labels">Type </label>
									<select id="type">
										<option value="unique">Unique</option>
										<option value="daily">Daily</option>
										<option value="weekly">Weekly</option>
										<option value="monthly">Monthly</option>	
									</select>
								</div>
									<br>
								<div class="fields">
									<label class="labels">Deadline </label>
									<input id="deadline" type="date">
								</div>
									<br>
								<div class="fields">
									<label class="labels">Date </label>
									<input id="datetime" type="datetime-local">
								</div>
								<button id="addDate" onClick="addDateTime()">+</button><br />
								<div id="meeting_times"></div><br />
		
					</div>
						</div>

						<div class="partTwo">
							<div class="inPartTwo fields">
								<label class="labels">Invited people </label>
								<input id="searchFriendInput" onkeyup="searchFriends(this)" style="width: 40%; margin-top: -1%;" type="text" placeholder="  Search"> 
							</div>
							<div id="friends">
							</div>
							<div class="pagini">
								<a class="page nume" id="previousPage" onclick="changePageNr('previousPage')" style='visibility:hidden'>Previous page</a>
								<a class="page nume" id="nextPage" onclick="changePageNr('nextPage')" style='visibility:hidden'>Next page</a>

							</div>
							<label class="selectAll">Select all</label>
							<input type="checkbox" id="selectAll" onclick='selectAll()'/>
					</div>
				</div>
					<a id="submitInvitation" onClick="sendInvitation()">Submit</a>
					<button id='sharePost' hidden></button>
				<div class="footer"></div>
				<div class="footer2"></div>
			</div>
									
		</div>
		<script src="<?php echo base_url('assets/scripts/scriptsCreare.js'); ?>"  type="text/javascript">
		</script> 

	</body>
</html>