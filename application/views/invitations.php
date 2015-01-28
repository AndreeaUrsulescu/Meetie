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
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/invitations.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/scripts/google.js'); ?>"></script>
		
		<script>
			var invitations = [];

			$.ajax({
			    url:'/meetie/index.php/invitations/getAll',
			    type: 'GET',
			    success: function(data){
			     	invitations = $.parseJSON(data);
			     	console.log(invitations);
			     	getNetworkId();
			    },
			    error: function(){
			    	console.log("Fail");
			    }
			 });
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

					<button id="multipleSearch" onclick="searchByFields()">Search</button>
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
		<script src="<?php echo base_url('assets/scripts/scriptsInvitatii.js'); ?>"  type="text/javascript"></script> 
		
	</body>
</html>