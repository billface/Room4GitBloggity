<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Event {
    private $authorsTable;
    private $eventsTable;
    private $blogsTable;
    private $pagesTable;
    private $commentsTable;




	public function __construct(DatabaseTable $eventsTable, DatabaseTable $authorsTable, Authentication $authentication, DatabaseTable $blogsTable, DatabaseTable $pagesTable, DatabaseTable $commentsTable) {
        $this->authorsTable = $authorsTable;
        $this->eventsTable = $eventsTable;
        $this->authentication = $authentication;
        $this->blogsTable = $blogsTable;
        $this->pagesTable = $pagesTable;
        $this->commentsTable = $commentsTable;



	}

    public function list() {
        $result = $this->eventsTable->findAllFutureDates('eventDate');

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
    //checks auth and adds
    public function add() {
        $author = $this->authentication->getUser();

        $authorObject = new \Site\Entity\Author($this->blogsTable, $this->eventsTable, $this->pagesTable, $this->commentsTable);

        $authorObject->id = $author['id'];
        $authorObject->name = $author['name'];
        $authorObject->email = $author['email'];
        $authorObject->password = $author['password'];

        $event = $_POST['event'];
        //the above is from form, below is others
        //$event['eventDate'] = new \Datetime();

        $authorObject->addEvent($event);

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

        if ($event['authorId'] != $author['id']) {
            return;
        }
        
        $this->eventsTable->delete($_POST['eventId']);
    
        header('location: /event/list');
    }

    public function saveEdit() {
        $author = $this->authentication->getUser();
        
        $authorObject = new \Site\Entity\Author($this->blogsTable, $this->eventsTable, $this->pagesTable, $this->commentsTable);

        $authorObject->id = $author['id'];
        $authorObject->name = $author['name'];
        $authorObject->email = $author['email'];
        $authorObject->password = $author['password'];
            
        $event = $_POST['event'];
        //the above is from form, below is others

        $authorObject->addEvent($event);



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