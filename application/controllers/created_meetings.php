<?php
	class Created_meetings extends CI_Controller {

		public function index() {
			$user = $this->session->userdata('user');

			if (!$user)
				redirect('index.php/login');
			else
				$this->load->view('created_meetings');
		}

		public function getAll() {
			$result = [];
			$count = 0;
			
			$user = $this->session->userdata('user');
			$this->load->model('get');
			$invitations = $this->get->getCreatedMeetings($user['id']);

			foreach ($invitations as $inv) {
			 	$meetingTimes = $this->get->getTimesForMeeting($inv['id']);
			 	$invitedPersons = $this->get->getInvitedPersons($inv['id']);
			 	
			 	$result[$count] = array(
				 	'id' => $inv['id'],
				 	'creator_id' => $inv['creator_id'],
				 	'title' => $inv['title'],
				 	'description' => $inv['description'],
				 	'location' => $inv['location'],
				 	'type' => $inv['type'],
				 	'deadline' => $inv['deadline'],
				 	'times' => $meetingTimes,
				 	'invitedPers' => $invitedPersons
				);
				$count = $count + 1;
			}


			echo json_encode($result);
			die();
		}	
	}
?>