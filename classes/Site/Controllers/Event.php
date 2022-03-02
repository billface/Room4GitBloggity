<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Event {
    private $eventsTable;
    private $authorsTable;
    private $pagesTable;
    private $blogsTable;
    private $commentsTable;

    

	public function __construct(DatabaseTable $eventsTable, DatabaseTable $authorsTable, Authentication $authentication, DatabaseTable $pagesTable, DatabaseTable $blogsTable, DatabaseTable $commentsTable) {
        $this->eventsTable = $eventsTable;
        $this->authorsTable = $authorsTable;
        $this->authentication = $authentication;
        $this->pagesTable = $pagesTable;
        $this->blogsTable = $blogsTable;
        $this->commentsTable = $commentsTable;

	}

    public function list() {
        $events = $this->eventsTable->findAllFutureDates('eventDate');

        $title = 'Event list';

        $author = $this->authentication->getUser();

        return ['template' => 'events.html.php', 
				'title' => $title, 
				'variables' => [
						'events' => $events,
                        'user' => $author //previously 'userId' => $author->id ?? null,
					]
				];
        
    }
    //checks auth and adds
    public function add() {
        $author = $this->authentication->getUser();

        $event = $_POST['event'];
        //the above is from form, below is others

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
                    'user' => $author 
                    ]
                ];
    }

}