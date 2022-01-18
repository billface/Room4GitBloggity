<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;

class Event {
    private $authorsTable;
    private $eventsTable;

	public function __construct(DatabaseTable $eventsTable, DatabaseTable $authorsTable) {
        $this->authorsTable = $authorsTable;
        $this->eventsTable = $eventsTable;
	}

    public function list() {
        $result = $this->eventsTable->findAll();

        $events = [];
          foreach ($result as $event) {
            $author = $this->authorsTable->findById($event['authorId']);
      
            $events[] = [
                    'id' => $event['id'],
                    'eventHeading' => $event['eventHeading'],
                    'eventText' => $event['eventText'],
                    'eventDate' => $event['eventDate'],
                    'name' => $author['name'],
                    'email' => $author['email']
                ];
      
          }
      
        $title = 'Event list';


        return ['template' => 'events.html.php', 
				'title' => $title, 
				'variables' => [
						'events' => $events
					]
				];
        
    }

}