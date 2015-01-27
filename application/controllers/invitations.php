<?php
	class Invitations extends CI_Controller {

		public function index() {
			$user = $this->session->userdata('user');

			if (!$user)
				redirect('index.php/login');
			else
				$this->load->view('invitations');
		}

		public function getUserNetworkId() {
			$user = $this->session->userdata('user');
			echo json_encode($user['network_id']);
			die();
		}

		public function getAll() {
			$result = [];
			$count = 0;
			
			$user = $this->session->userdata('user');
			$this->load->model('get');
			$invitations = $this->get->getInvitationsForUser($user['network_id'], $user['network']);

			if ($invitations != false) {
				foreach ($invitations as $inv) {
					$invitation = $this->get->getInvitationByID($inv['invitation_id']);
				 	$meetingTimes = $this->get->getTimesForMeeting($inv['invitation_id']);
				 	$invitedPersons = $this->get->getInvitedPersons($inv['invitation_id']);
				 	$creator_name = $this->get->getCreatorName($invitation['creator_id']);
				 	
				 	$result[$count] = array(
					 	'id' => $invitation['id'],
					 	'creator_id' => $invitation['creator_id'],
					 	'creator_name' => $creator_name,
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
			}
			else {
				$result = "You have no invitations!";
			}

			echo json_encode($result);
			die();
		}

		public function storeInvitationReply() {
			$invitationId = $this->input->post('invitation_id');
			$timeOfMeeting = $this->input->post('timeOfMeeting');

			$user = $this->session->userdata('user');
			$this->load->model('set');
			$this->set->setInvitationReply($invitationId, $user['network_id'], $timeOfMeeting);
		}

		public function deleteInvitation() {
			$invitationId = $this->input->post('invitation_id');

			$user = $this->session->userdata('user');
			$this->load->model('set');
			$this->set->deleteInvitation($user['network_id'], $invitationId);
		}
	}
?>