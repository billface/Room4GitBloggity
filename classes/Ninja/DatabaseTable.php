<?php
namespace Ninja;

class DatabaseTable
{
	//PROPERTIES
	private $pdo;
	private $table;
	private $primaryKey;
	private $className;
	private $constructorArgs;

	//METHODS
	//a magic method that helps makes sure all the arguments are in the correct order and of the correct type
	public function __construct(\PDO $pdo, string $table, string $primaryKey, string $className = '\stdClass', array $constructorArgs = []) {
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
		$this->className = $className;
		$this->constructorArgs = $constructorArgs;
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

		return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
	}

	public function findById($value) {
		$query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';

		$parameters = [
			'value' => $value
		];

		$query = $this->query($query, $parameters);

		return $query->fetchObject($this->className, $this->constructorArgs);
	}

	function findAllById($value) {
		$query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';

		$parameters = [ 
			'value' => $value
		];

		$query = $this->query($query, $parameters);

		return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
	}

	public function findAllFutureDates($column) {
		$result = $this->query('SELECT * FROM `' . $this->table . '` WHERE `' . $column .
		 '` > CURRENT_TIMESTAMP ORDER BY `'. $column . '`');
		 		
		 return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
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

		return $this->pdo->lastInsertId();

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

	//this function is used to delete categories when editing
	public function deleteWhere($column, $value) {
		$query = 'DELETE FROM ' . $this->table . ' WHERE ' . $column . ' = :value';

		$parameters = [
			'value' => $value
		];

		$query = $this->query($query, $parameters);
	}

	public function findAll() {
		$result = $this->query('SELECT * FROM `' . $this->table . '`');

		return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
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
		$entity = new $this->className(...$this->constructorArgs);

		try {
			if ($record[$this->primaryKey] == '') {
				$record[$this->primaryKey] = null;
			}
			$insertId = $this->insert($record);

			$entity->{$this->primaryKey} = $insertId;

		}
		catch (\PDOException $e) {
			$this->update($record);
		}

		foreach ($record as $key => $value) {
			if (!empty($value)) {
				$entity->$key = $value;	
			}			
		}

		return $entity;	

	}

	public function upload($value) {
		$output = [
			'success' => false,
			'fileNameNew' => '',
			'message' => ''
		];

		$file = $_FILES['file'];
            
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png');

		if (in_array($fileActualExt, $allowed)){
			if($fileError === 0){
				if ($fileSize < 500000) {
					$fileNameNew = $value.'.'.$fileActualExt;
					$fileDestination = 'uploads/'.$fileNameNew;
					if (move_uploaded_file($fileTmpName, $fileDestination)) {
						$output['success'] = true;
						$output['fileNameNew'] = $fileNameNew;
					} else {
						$output['message'] = 'failed to move the file';
					}
				} else {
					$output['message'] = 'Your file was too big! Reduce size to less than 500kb';
				}

			} else {
				$output['message'] = 'There was an error uploading your file';
			}
		} else {
			$output['message'] = 'Please upload a .jpg or .png file. You may need to convert of image file types';
		}
		return $output;	

	}
}