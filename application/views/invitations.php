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
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/invitations.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/google.js'); ?>"></script>
		
		<script>
			var invitations = [];

			$.ajax({
			    url:'/meetie/index.php/invitations/getAll',
			    type: 'GET',
			    success: function(data){
			     	invitations = $.parseJSON(data);
			     	orderInvitedPersons();
			     	//sendInvitationReply('110', '2015-01-12 10:05:00');
			     	countVotesForTimes();
			    },
			    error: function(){
			    	console.log("Fail");
			    }
			 });
		</script>

		<label for="searchByTitle"> Title </label>
		<input id="searchByTitle" type="text" name="searchByTitle"/><br />

		<label for="searchByCreator"> Creator </label>
		<input id="searchByCreator" type="text" name="searchByCreator"/><br />

		<label for="searchByType"> Type </label>
		<select id="searchByType" name="searchByType">
			<option value=''></option>
			<option value="unique">Unique</option>
			<option value="daily">Daily</option>
			<option value="weekly">Weekly</option>
			<option value="monthly">Monthly</option>
		</select><br />

		<button id="multipleSearch" onclick="searchByFields('myInvitations')">Search</button>

		<!-- care au loc in perioada x-->		
	</body>
</html>