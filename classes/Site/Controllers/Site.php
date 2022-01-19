<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;

class Site {
	private $siteTable;

	public function __construct(DatabaseTable $siteTable) {
		$this->siteTable = $siteTable;
	}

    public function home() {
        $title = 'Internet Blogging Database';

        return ['template' => 'home.html.php', 'title' => $title];
    }

    public function about() {
		return ['template' => 'about.html.php', 
			'title' => 'About'];
	}
}