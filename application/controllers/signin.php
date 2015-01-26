<?php

	class Signin extends CI_Controller {

		public function index() {
			$this->load->view('signin');
		}

		// public function logintoapp() {
		// 	$this->session->set_userdata('network', 'facebook');
		// 	$network = $this->session->userdata('network');
		// 	echo $network;
		// }
	}
?>