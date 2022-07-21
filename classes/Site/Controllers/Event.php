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
        //echo '<pre>'; print_r($_POST); echo '</pre>';
        //die; 

        $author = $this->authentication->getUser();

        $event = $_POST['event'];

        
        

        //the above is from form, below is others
        
        if (isset($event['outOfStock'])){
            $event['outOfStock'] = 1;
        } else {
            $event['outOfStock'] = 0;
        }

        //upload file if it has been selected
        if ($_FILES['file']['size'] > 0){
            $return = $this->eventsTable->upload($event['eventImageName']);
            $event['eventFileName'] = $return['fileNameNew'];

            //end upload files and handle any errors
                if ($return['message'] == '') {
                $author->addEvent($event);
                unset($_SESSION['event']);
                header('location: /event/list');
                } else {
                    $_SESSION['event'] = $event;
                    $_SESSION['uploadErrorMessage'] = $return['message'];
                    if ($_POST['hiddenId'] != '') {
                        header('location: /event/edit?id='.$_POST['hiddenId']);
                    } else {
                        header('location: /event/edit');
                    }
                }
            }else{
                $author->addEvent($event);
                header('location: /event/list');
            }
    // if no file
            

    }

    public function addOrEdit() {

        $author = $this->authentication->getUser();

        if (isset($_GET['id'])) {
            $event = $this->eventsTable->findById($_GET['id']);
        }

        $title = 'Edit event';
        $tinyMCE = true;
        $metaRobots = 'noindex';

        return ['template' => 'eventedit.html.php', 
                'title' => $title,
                'tinyMCE' => $tinyMCE,
                'metaRobots' => $metaRobots,
                'variables' => [
                    'event' => $event ?? null,
                    'user' => $author //previously 'userId' => $author->id ?? null,
                    ]
                ];
    }

}