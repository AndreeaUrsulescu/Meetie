<?php
	class Get extends CI_Model {

		public function user_exists($network_id, $network) {

			$whereCond = array('network' => $network, 'network_id' => $network_id);
			$this->db->where($whereCond);
			$result = $this->db->get("users");

			$users = $result->result_array();
			
			if (count($users) == 0) {
			 	return false;
			 }
			 else {
				$user = $users[0];
				return $user;
			}
		}

		public function getInvitationId($creator, $title) {

			$whereCond = array('creator_id' => $creator, 'title' => $title);
			$this->db->where($whereCond);
			$result = $this->db->get("invitations");

			$invitations = $result->result_array();

			if (count($invitations) == 0) {
			 	return false;
			 }
			 else {
				$invitation = $invitations[0];
				return $invitation['id'];
			}
		}

		public function getFacebookFriendEmail($networkId) {

			$whereCond = array('network_id' => $networkId, 'network' => 'facebook');
			$this->db->where($whereCond);
			$result = $this->db->get("users");

			$users = $result->result_array();

			if (count($users) == 0) {
			 	return false;
			 }
			 else {
				$user = $users[0];
				return $user['email'];
			}	
		}

		//invitatiile pe care le-am creat
		public function getCreatedMeetings($creator_id) {
			$whereCond = array('creator_id' => $creator_id);
			 $this->db->where($whereCond);
			 $result = $this->db->get("invitations");

			$invitations = $result->result_array();

			 if (count($invitations) == 0) {
			  	return false;
			 }
			else {
				return $invitations;
			}
		}

		//la care sunt invitat
		public function getInvitationsForUser($networkUserId, $network) {

			 $whereCond = array('person_id' => $networkUserId, 'network' => $network);
			 $this->db->where($whereCond);
			 $result = $this->db->get("invited_persons");

			$invitations = $result->result_array();

			 if (count($invitations) == 0) {
			  	return false;
			 }
			else {
				return $invitations;
			}
		}

		public function getInvitationByID($invId) {
			$whereCond = array('id' => $invId);
			$this->db->where($whereCond);
			$result = $this->db->get("invitations");

			$invitations = $result->result_array();

			if (count($invitations) == 0) {
			 	return false;
			}
			else {
				return $invitations[0];
			}
		}

		public function getTimesForMeeting($idMeeting) {
			$times = [];
			$count = 0;

			$whereCond = array('invitation_id' => $idMeeting);
			$this->db->where($whereCond);
			$result = $this->db->get("meeting_time");

			$resArray = $result->result_array();

			if (count($resArray) == 0) {
			 	return false;
			}
			else {
				foreach ($resArray as $time) {
					$times[$count] = $time['time'];
					$count = $count + 1;
				}
				return $times;
			}		
		}

		public function getInvitedPersons($idMeeting) {
			$persons = [];
			$count = 0;

			$whereCond = array('invitation_id' => $idMeeting);
			$this->db->where($whereCond);
			$result = $this->db->get("invited_persons");

			$resArray = $result->result_array();

			if (count($resArray) == 0) {
			 	return false;
			}
			else {
				foreach ($resArray as $person) {
					$persons[$count] = array(
						'userNetworkId' => $person['person_id'],
						'response' => $person['response'] 
					);
					$count = $count + 1;
				}
				return $persons;
			}		
		}
	}
?>