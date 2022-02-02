<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Event {
    private $authorsTable;
    private $eventsTable;
    private $blogsTable;

    

	public function __construct(DatabaseTable $eventsTable, DatabaseTable $authorsTable, Authentication $authentication, DatabaseTable $blogsTable) {
        $this->authorsTable = $authorsTable;
        $this->eventsTable = $eventsTable;
        $this->authentication = $authentication;
        $this->blogsTable = $blogsTable;

	}

    public function list() {
        $events = $this->eventsTable->findAllFutureDates('eventDate');
 
        $title = 'Event list';

        $author = $this->authentication->getUser();

        return ['template' => 'events.html.php', 
				'title' => $title, 
				'variables' => [
						'events' => $events,
                        'userId' => $author->id ?? null
					]
				];
        
    }
    //checks auth and adds
    public function add() {
        $author = $this->authentication->getUser();

        $event = $_POST['event'];
        //the above is from form, below is others
        //$event['eventDate'] = new \Datetime();

        $author->addEvent($event);

        header('location: /event/list');
    }
    //brings up form
    public function addpage() {

            $title = 'Add a new event';

            return ['template' => 'addevent.html.php', 'title' => $title];
        
    }

    public function delete() {

        $author = $this->authentication->getUser();

        $event = $this->eventsTable->findById($_POST['eventId']);

        if ($event->authorId != $author->id) {
            return;
        }
        
        $this->eventsTable->delete($_POST['eventId']);
    
        header('location: /event/list');
    }

    public function saveEdit() {
        $author = $this->authentication->getUser();

        
            
        $event = $_POST['event'];
        //the above is from form, below is others

        $author->addEvent($event);

        header('location: /event/list');

    }

    public function displayEdit() {

        $author = $this->authentication->getUser();

        $event = $this->eventsTable->findById($_GET['id']);

        $title = 'Edit event';

        return ['template' => 'editevent.html.php', 
                'title' => $title,
                'variables' => [
                    'event' => $event,
                    'userId' => $author['id'] ?? null
                    ]
                ];
    }

}