<!DOCTYPE html>
<html>
	<head>
		<title> Meetie </title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
	</head>

	<body>
		<div class="all">
			<img id="cover" src="<?php echo base_url('assets/images/cover3.jpg'); ?>">
			<div class="shadow3">
				<img id="profile"/>
				<a class="delogare" href="<?php echo base_url('index.php/logout'); ?>">Logout</a>
				<div class="middle3">
					<div class="sus">
						<a href="<?php echo base_url('index.php/invitations'); ?>">
						<div class="planifica">
							<div class="header">
								<br>
								<label class="inHeader">My invitations</label>
							</div>
								<p class="descriere">Here you can see all the plans that your friends have for the next period. Would you like to join them? </p>
							
						</div> </a>
						<a href="<?php echo base_url('index.php/created_meetings'); ?>">
						<div class="invitatii">
							<div class="header">
								<br>
								<label class="inHeader">Meetings planned by me</label>
							</div>
								<p class="descriere"> That is where you can check out which of your friends will join you on your planned events. Plan your meetings and always keep your friends close. That's what Meetie does for you</p>
							
						</div> </a>
					</div>
					<div class="jos">
						<a href="<?php echo base_url('index.php/create_meeting'); ?>">
						<div style="margin-left: 20%" class="propune">
							<div class="header">
								<br>
								<label class="inHeader">Plan a meeting</label>
							</div>
								<p class="descriere"> In this section you will make a schedule of your meetings as well as a list of friends you would like to join you</p>
							
						</div> </a>
					</div>
				</div>
				<div class="footer"></div>
				<div class="footer2"></div>
			</div>
			
		</div>

		 <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
		 <script src="<?php echo base_url('assets/scripts/scripts.js'); ?>"  type="text/javascript"></script>
	</body>
</html>