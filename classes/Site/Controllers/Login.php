<?php
namespace Site\Controllers;

class Login {
	private $authentication;

	public function __construct(\Ninja\Authentication $authentication) {
		$this->authentication = $authentication;
	}

	public function loginForm() {
		return ['template' => 'login.html.php', 
				'title' => 'Log In',
				'metaRobots' => 'noindex',
			];
	}

	public function processLogin() {
		if ($this->authentication->login($_POST['email'], $_POST['password'])) {
			header('location: /login/success');
		}
		else {
			return ['template' => 'login.html.php',
					'title' => 'Log In',
					'metaRobots' => 'noindex',
					'variables' => [
							'error' => 'Invalid username/password.'
						]
					];
		}
	}

	public function success() {
		return ['template' => 'loginsuccess.html.php', 'title' => 'Login Successful', 'metaRobots' => 'noindex'];
	}

	public function error() {
		return ['template' => 'loginerror.html.php', 'title' => 'You are not logged in', 'metaRobots' => 'noindex'];
	}

	public function logout() {
		session_destroy();	
		return ['template' => 'logout.html.php', 'title' => 'You have been logged out', 'metaRobots' => 'noindex'];
	}
}
