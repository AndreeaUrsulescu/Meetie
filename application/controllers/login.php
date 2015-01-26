<?php

	class Login extends CI_Controller {

		public function index() {
			$user = $this->session->userdata('user');

			if (!$user)
				$this->load->view('login');
			else
				redirect('index.php/home');
		}

		public function logintoapp() {
			$userinfo  = array(
				'network' => $this->input->post('network'),
				'network_id' => $this->input->post('id'),
				'name' => $this->input->post('name')
			);

			if ($userinfo['network'] != 'twitter') {
				$userinfo['email'] = $this->input->post('email');
			}

			$this->load->model('get');
			$user_exists = $this->get->user_exists($userinfo['network_id'], $userinfo['network']);

			if ($user_exists == false) {
				$this->load->model('set');
				$this->set->addUser($userinfo);
				$user_exists = $this->get->user_exists($userinfo['network_id'], $userinfo['network']);
			}

			$userinfo['id'] = $user_exists['id'];

			$this->session->set_userdata('user', $userinfo);
		}
	}
?>