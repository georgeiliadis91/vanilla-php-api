<?php


class User{
	private $conn;
	private $table='users';

	//properties
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $password;
	public $user_type;


	//Const
	public function __construct($db){
		$this->conn=$db;
	}

	//Get Users
	public function read(){
		// Query
		$query="SELECT * FROM ".$this->table;
		// Statement prep
		$stmt = $this->conn->prepare($query);

		// Execute query
		$stmt->execute();

		return $stmt;
	}


	public function read_single(){
		//Query
		$query="SELECT * FROM ".$this->table." WHERE id = ?";

		// Statement prep
		$stmt = $this->conn->prepare($query);

		//Bind id
		$stmt->bindParam(1,$this->id);

		// Execute query
		$stmt->execute();

		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		//set Properties
		$this->id=$row['id'];
		$this->first_name=$row['first_name'];
		$this->last_name=$row['last_name'];
		$this->email=$row['email'];
		$this->user_type=$row['user_type'];


	}

	public function login(){
		$query="SELECT * FROM ".$this->table. " 
		WHERE 
			email = :email AND
			password = :password";

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':email',$this->email);
			$stmt->bindParam(':password',$this->password);

			$stmt->execute();

		return $stmt;

		
	}

	public function create(){
		$query="INSERT INTO ".$this->table." 
		SET 
			first_name = :first_name,
			last_name = :last_name,
			email = :email,
			password= :password,
			user_type= :user_type";

		$stmt = $this->conn->prepare($query);

		//Bind data
		$stmt->bindParam(':first_name',$this->first_name);
		$stmt->bindParam(':last_name',$this->last_name);
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':password',$this->password);
		$stmt->bindParam(':user_type',$this->user_type);

		//Execute query 

		if($stmt->execute()){
			return true;

		}else{
			//Print Error

			printf("Error: %s.\n",$stmt->error);
			return false;
		}
	}

	public function update(){
		$query="UPDATE ".$this->table." 
		SET 
			first_name = :first_name,
			last_name = :last_name,
			email = :email,
			password= :password,
			user_type= :user_type WHERE id = :id";

		$stmt = $this->conn->prepare($query);

		//Bind data
		$stmt->bindParam(':id',$this->id);
		$stmt->bindParam(':first_name',$this->first_name);
		$stmt->bindParam(':last_name',$this->last_name);
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':password',$this->password);
		$stmt->bindParam(':user_type',$this->user_type);

		//Execute query 

		if($stmt->execute()){
			return true;
		}else{
			//Print Error
			printf("Error: %s.\n",$stmt->error);
			return false;
		}
	}


	public function delete(){

		$query="DELETE FROM ".$this->table." WHERE id = :id";

		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':id',$this->id);

		if($stmt->execute()){
			return true;
		}else{
			//Print Error
			printf("Error: %s.\n",$stmt->error);
			return false;
		}
	}


}


?>