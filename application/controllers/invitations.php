<?php
	class Invitations extends CI_Controller {

		public function index() {
			$user = $this->session->userdata('user');

			if (!$user)
				redirect('index.php/login');
			else
				$this->load->view('invitations');
		}

		public function getAll() {
			$result = [];
			$count = 0;
			
			$user = $this->session->userdata('user');
			$this->load->model('get');
			$invitations = $this->get->getInvitationsForUser($user['network_id'], $user['network']);

			foreach ($invitations as $inv) {
				$invitation = $this->get->getInvitationByID($inv['invitation_id']);
			 	$meetingTimes = $this->get->getTimesForMeeting($inv['invitation_id']);
			 	$invitedPersons = $this->get->getInvitedPersons($inv['invitation_id']);
			 	
			 	$result[$count] = array(
				 	'id' => $invitation['id'],
				 	'creator_id' => $invitation['creator_id'],
				 	'title' => $invitation['title'],
				 	'description' => $invitation['description'],
				 	'location' => $invitation['location'],
				 	'type' => $invitation['type'],
				 	'deadline' => $invitation['deadline'],
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