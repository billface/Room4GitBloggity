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
	//shows how many blogs have been added, and how many in each category
	public function total($field = null, $value = null) {
		$sql = 'SELECT COUNT(*) FROM `' . $this->table . '`';
		$parameters = [];

		if (!empty($field)) {
			$sql .= ' WHERE `' . $field . '` = :value';
			$parameters = ['value' => $value];
		}
		
		$query = $this->query($sql, $parameters);
		$row = $query->fetch();
		return $row[0];
	}

	public function find($column, $value, $orderBy = null, $limit = null, $offset = null) {
		$query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value';

		$parameters = [
			'value' => $value
		];

		if ($orderBy != null) {
			$query .= ' ORDER BY ' . $orderBy;
		}

		if ($limit != null) {
			$query .= ' LIMIT ' . $limit;
		}

		if ($offset != null) {
			$query .= ' OFFSET ' . $offset;
		}

		$query = $this->query($query, $parameters);

		return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
	}


	public function findAndJoin($column, $value, $thisJoinColumn, $otherTable, $otherJoinColumn, $orderBy = null, $limit = null, $offset = null) {
		//function made to paginate list of category blogs in correct order (BASED on $query = 'SELECT * FROM ' . $this->table . ' JOIN blog ON blog_cat_join.blogId = blog.id WHERE ' . $column . ' = :value';)

        $query = 'SELECT * FROM ' . $this->table . ' JOIN ' . $otherTable . ' ON ' . $this->table . ' . ' . $thisJoinColumn . '  = ' . $otherTable . ' . ' . $otherJoinColumn. ' WHERE ' . $column . ' = :value';

        $parameters = [

            'value' => $value

        ];
        if ($orderBy != null) {

            $query .= ' ORDER BY ' . $orderBy;

        }
        if ($limit != null) {

            $query .= ' LIMIT ' . $limit;

        }
        if ($offset != null) {

            $query .= ' OFFSET ' . $offset;

        }
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

	public function deleteJoin($id) {
		$parameters = [':id' => $id];

		$this->query('DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :itemId', $parameters);
	}

	//this function is used to delete categories when editing
	public function deleteWhere($column, $value) {
		$query = 'DELETE FROM ' . $this->table . ' WHERE ' . $column . ' = :value';

		$parameters = [
			'value' => $value
		];

		$query = $this->query($query, $parameters);
	}

	public function findAll($orderBy = null, $limit = null, $offset = null) {
		$query = 'SELECT * FROM ' . $this->table;

		if ($orderBy != null) {
			$query .= ' ORDER BY ' . $orderBy;
		}

		
		if ($limit != null) {
			$query .= ' LIMIT ' . $limit;
		}
		
		if ($offset != null) {
			$query .= ' OFFSET ' . $offset;
		}
		
		$result = $this->query($query);

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

		//each time the save method is called it will return an entity instance representing the record thats just been save. See pg 575

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