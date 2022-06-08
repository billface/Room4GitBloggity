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
    private $itemsTable;
    private $authentication;



    
	//the order of constucts is important. most specifically the position of $authentication vs SiteRoutes getRoutes()
	public function __construct(DatabaseTable $eventsTable, DatabaseTable $authorsTable, DatabaseTable $pagesTable, DatabaseTable $blogsTable, DatabaseTable $commentsTable, DatabaseTable $itemsTable, Authentication $authentication) {
        $this->eventsTable = $eventsTable;
        $this->authorsTable = $authorsTable;
        $this->pagesTable = $pagesTable;
        $this->blogsTable = $blogsTable;
        $this->commentsTable = $commentsTable;
        $this->itemsTable = $itemsTable;
        $this->authentication = $authentication;


	}

    public function list() {
        $events = $this->eventsTable->findAllFutureDates('eventDate');
        if (empty($events)) {
            $emptyMessage = 'No dates booked';
        }

        $title = 'Event list';
        $metaDescription = 'Events List';

        $author = $this->authentication->getUser();

        return ['template' => 'events.html.php', 
				'title' => $title, 
                'metaDescription' => $metaDescription,
				'variables' => [
						'events' => $events,
                        'userId' => $author->id ?? null,
                        'emptyMessage' => $emptyMessage ?? null
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
            $metaRobots = 'noindex';

            return ['template' => 'addevent.html.php',
                    'title' => $title,
                    'metaRobots' => $metaRobots
                ];
        
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
        $metaRobots = 'noindex';

        return ['template' => 'editevent.html.php', 
                'title' => $title,
                'metaRobots' => $metaRobots,
                'variables' => [
                    'event' => $event,
                    'userId' => $author->id ?? null
                    ]
                ];
    }

}