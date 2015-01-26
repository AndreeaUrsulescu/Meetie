<!DOCTYPE html>
<html>
	<head>
		<title> Meetie </title>
	</head>

	<body>
		<a href="<?php echo base_url('index.php/create_meeting'); ?>"><button> Plan a meeting </button></a>
		<a href="<?php echo base_url('index.php/created_meetings'); ?>"><button> My proposed meetings </button></a>
		<a href="<?php echo base_url('index.php/invitations'); ?>"><button> Invitations </button></a>
		<a href="<?php echo base_url('index.php/logout'); ?>"><button> Log out </button></a>
	</body>
</html>