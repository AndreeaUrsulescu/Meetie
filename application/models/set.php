<?php
	class Set extends CI_Model {

		public function addUser($user) {
			$this->db->insert("users", $user);
		}

		public function addInvitation($invitation) {
			$this->db->insert("invitations", $invitation);
		}

		public function addMeetingTime($meetingTime) {
			$this->db->insert("meeting_time", $meetingTime);
		}

		public function addInvitedFriend($friend) {
			$this->db->insert("invited_persons", $friend);
		}

		public function setInvitationReply($invitationId, $personId, $response) {
			if ($response == "uncheck") $response = null;
			
			$data = array(
				'response' => $response 
			);

			$whereCond = array('invitation_id' => $invitationId, 'person_id' => $personId);
			$this->db->where($whereCond);
			$this->db->update('invited_persons', $data);
		}

		public function deleteCreatedInvitation($invitationId) {
			$this->db->delete('invited_persons', array('invitation_id' => $invitationId));
			$this->db->delete('meeting_time', array('invitation_id' => $invitationId));
			$this->db->delete('invitations', array('id' => $invitationId));
		}

		public function deleteInvitation($invitedPerson, $invitationId) {
			$this->db->delete('invited_persons', array('invitation_id' => $invitationId, 'person_id' => $invitedPerson));
		}
	}
?>