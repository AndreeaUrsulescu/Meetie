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
		
		<script>
			 $.ajax({
			    url:'/meetie/index.php/invitations/getAll',
			    type: 'GET',
			    success: function(data){
			       console.log(data);
			    },
			    error: function(){
			    	console.log("Fail");
			    }
			 });
		</script>
	</body>
</html>