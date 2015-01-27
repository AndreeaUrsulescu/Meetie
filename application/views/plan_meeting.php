<!DOCTYPE html>
<html>
	<head>
		<title>Meetie</title>
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

		<label for="title">Title</label>
		<input id="title" type="text" name="title"/><br />

		<label for="description">Description</label>
		<input id="description" type="text" name="description"/><br />

		<label for="location">Location</label>
		<input id="location" type="text" name="location" /><br />

		<label for="type">Type</label>
		<select id="type" name="type">
			<option value="unique">Unique</option>
			<option value="daily">Daily</option>
			<option value="weekly">Weekly</option>
			<option value="monthly">Monthly</option>
		</select><br />

		<label for="deadline">Deadline</label>
		<input id="deadline" type="date" name="deadline" /><br />

		<label for="datetime">Date and time</label>
		<input id="datetime" type="datetime-local" name="datetime" /> <button id="addDate" onClick="addDateTime()">+</button><br />

		<div id="meeting_times"></div><br />

		<input id="searchFriendInput" type="text" onkeyup="searchFriends(this)"/>
		<input id="selectAll" type='checkbox' onclick='selectAll()'> All </input>
		<div id="friends"></div>
		<button id="previousPage" onclick="changePageNr('previousPage')" style='visibility:hidden'>Previous</button>
		<button id="nextPage" onclick="changePageNr('nextPage')" style='visibility:hidden'>Next</button>
		<br /><br />
		<div id="group"></div><br />

		<button id='sharePost' hidden></button>
		<button id="submitInvitation" onClick="sendInvitation()">Submit</button>
	</body>
</html>