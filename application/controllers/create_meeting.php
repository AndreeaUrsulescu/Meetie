<?php
	class Create_meeting extends CI_Controller {

		public function index() {
			$user = $this->session->userdata('user');

			if (!$user)
				redirect('index.php/login');
			else
				$this->load->view('plan_meeting');
		}

		public function createInvitation() {
			$invitationData = array(
				'creator_id' => $this->session->userdata('user')['id'],
				'title' => $this->input->post('title'),
			 	'description' => $this->input->post('description'),
			 	'location' => $this->input->post('location'),
			 	'type' => $this->input->post('type'),
			 	'deadline' => $this->input->post('deadline')
			);

			$this->load->model('set');
			$this->set->addInvitation($invitationData);

			$this->load->model('get');
			$invId = $this->get->getInvitationId($invitationData['creator_id'], $invitationData['title']);

			if ($invId != false) {
				$meeting_times = $this->input->post('meeting_times');
				foreach ($meeting_times as $time) {
					$invTime = array(
						'invitation_id' => $invId, 
						'time' => $time
					);
					$this->set->addMeetingTime($invTime);	
				}

				$friends = $this->input->post('friends');
				foreach ($friends as $friend) {
					$invFriend = array(
						'invitation_id' => $invId,
						'person_id' => $friend,
						'network' => $this->session->userdata('user')['network']
					);
					$this->set->addInvitedFriend($invFriend);
				}

				if ($this->session->userdata('user')['network'] == 'facebook') {
					$contor = 0;
					$friends_emails = [];
					foreach ($friends as $friend) {
						$friends_emails[$contor] = $this->get->getFacebookFriendEmail($friend);
						$contor = $contor + 1;
					}

					echo json_encode($friends_emails);
					die();
				}
			}			
		}
	}
?>
