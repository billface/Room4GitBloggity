<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Event {
    private $authorsTable;
    private $eventsTable;

	public function __construct(DatabaseTable $eventsTable, DatabaseTable $authorsTable, Authentication $authentication) {
        $this->authorsTable = $authorsTable;
        $this->eventsTable = $eventsTable;
        $this->authentication = $authentication;
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
                    'email' => $author['email'],
                    'authorId' => $author['id']

                ];
      
          }
      
        $title = 'Event list';

        $author = $this->authentication->getUser();

        return ['template' => 'events.html.php', 
				'title' => $title, 
				'variables' => [
						'events' => $events,
                        'userId' => $author['id'] ?? null
					]
				];
        
    }

    public function add() {
        $author = $this->authentication->getUser();

        $event = $_POST['event'];
        //the above is from form, below is others
        //$event['eventDate'] = new \Datetime();

        $event['authorId'] = $author['id'];;

        $this->eventsTable->save($event);

        header('location: /event/list');
    }

    public function addpage() {

            $title = 'Add a new event';

            return ['template' => 'addevent.html.php', 'title' => $title];
        
    }

    public function delete() {
        $this->eventsTable->delete($_POST['eventId']);
    
        header('location: /event/list');
    }

    public function saveEdit() {
      
            
        $event = $_POST['event'];
        //the above is from form, below is others
        $event['authorId'] = 2;

        $this->eventsTable->save($event);

        header('location: /event/list');

    }

    public function displayEdit() {

            $event = $this->eventsTable->findById($_GET['id']);

            $title = 'Edit event';

            return ['template' => 'editevent.html.php', 
                    'title' => $title,
                    'variables' => [
                        'event' => $event
                        ]
                    ];
    }

}