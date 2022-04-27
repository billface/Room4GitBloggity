<?php
namespace Ninja;

class DatabaseTable
{
	//PROPERTIES
	private $pdo;
	private $table;
	private $primaryKey;

	//METHODS
	//a magic method that helps makes sure all the arguments are in the correct order and of the correct type
	public function __construct(\PDO $pdo, string $table, string $primaryKey){
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
	}
	/* special query function that sets the $parameters variable to an empty array 
	if no value is supplied */
	private function query( $sql, $parameters = []) {
		$query = $this->pdo->prepare($sql);
		$query->execute($parameters);
		return $query;
	}
	//shows how many blogs have been added
	public function total() {
		$query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
		$row = $query->fetch();
		return $row[0];
	}

	public function find($column, $value) {
		$query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value';

		$parameters = [
			'value' => $value
		];

		$query = $this->query($query, $parameters);

		return $query->fetchAll();
	}

	public function findById($value) {
		$query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';

		$parameters = [
			'value' => $value
		];

		$query = $this->query($query, $parameters);

		return $query->fetch();
	}

	function findAllById($value) {
		$query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';

		$parameters = [ 
			'value' => $value
		];

		$query = $this->query($query, $parameters);

		return $query->fetchAll();
	}

	public function findAllFutureDates($column) {
		$result = $this->query('SELECT * FROM `' . $this->table . '` WHERE `' . $column .
		 '` > CURRENT_TIMESTAMP ORDER BY `'. $column . '`');
		 		
		 return $result->fetchAll();
	}

	private function insert($fields) {
		$query = 'INSERT INTO `' . $this->table . '` (';

		foreach ($fields as $key => $value) {
			$query .= '`' . $key . '`,';
		}

		$query = rtrim($query, ',');

		$query .= ') VALUES (';


		foreach ($fields as $key => $value) {
			$query .= ':' . $key . ',';
		}

		$query = rtrim($query, ',');

		$query .= ')';

		$fields =$this->processDates($fields);

		$this->query($query, $fields);
	}

	private function update($fields) {

		$query = ' UPDATE `' . $this->table .'` SET ';


		foreach ($fields as $key => $value) {
			$query .= '`' . $key . '` = :' . $key . ',';
		}

		$query = rtrim($query, ',');

		$query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

		//Set the :primaryKey variable
		$fields['primaryKey'] = $fields['id'];

		$fields = $this->processDates($fields);

		$this->query($query, $fields);
	}

	
	public function delete($id) {
		$parameters = [':id' => $id];

		$this->query('DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id', $parameters);
	}

	public function findAll() {
		$result = $this->query('SELECT * FROM `' . $this->table . '`');

		return $result->fetchAll();
	}

	private function processDates($fields) {
		foreach ($fields as $key => $value) {
			if ($value instanceof \DateTime) {
				$fields[$key] = $value->format('Y-m-d H:i:s');
			}
		}

		return $fields;
	}

	public function save($record) {
		try {
			if (empty($record[$this->primaryKey])) {
				unset($record[$this->primaryKey]);
			}
			$this->insert($record);
		}
		catch (\PDOException $e) {
			$this->update($record);
		}
	}

	public function upload($value) {
		$file = $_FILES['file'];
            
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if ($fileSize < 500000) {
                        $fileNameNew = $value.'.'.$fileActualExt;
                        $fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file($fileTmpName,$fileDestination);
						
                    } else {
                        echo 'Your file was too big! Reduce size to less than 500kb';
                    }

                } else {
                    echo 'There was an error uploading your file';
                }
            } else {
                echo 'This is not an allowed filetype! Convert to jpg or png';
            }
			return $fileNameNew;

	}
}