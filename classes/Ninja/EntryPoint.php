<?php
namespace Ninja;

class EntryPoint {
	private $route;
	private $method;
	private $routes;

	public function __construct(string $route, string $method, \Ninja\Routes $routes) {
		$this->route = $route;
		$this->routes = $routes;
		$this->method = $method;
		$this->checkUrl();
	}

	private function checkUrl() {
		if ($this->route !== strtolower($this->route)) {
			http_response_code(301);
			header('location: ' . strtolower($this->route));
		}
	}

    private function loadTemplate($templateFileName, $variables = []) {
		extract($variables);

		ob_start();
		include  __DIR__ . '/../../templates/' . $templateFileName;

		return ob_get_clean();
	}

 

    public function run() {

		$routes = $this->routes->getRoutes();

		$authentication = $this->routes->getAuthentication();

		if (isset($routes[$this->route]['login']) && isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
			header('location: /login/error');
		}
		else {
			$controller = $routes[$this->route][$this->method]['controller'];
			$action = $routes[$this->route][$this->method]['action'];

			$display = $controller->$action();

			$title = $display['title'];

			if (isset($display['variables'])) {
				$output = $this->loadTemplate($display['template'], $display['variables']);
			}
			else {
				$output = $this->loadTemplate($display['template']);
			}

			echo $this->loadTemplate('layout.html.php', ['loggedIn' => $authentication->isLoggedIn(),
														'output' => $output,
														'title' => $title
													]);		
		}
	}
}
