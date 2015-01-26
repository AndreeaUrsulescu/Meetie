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
	}
?>