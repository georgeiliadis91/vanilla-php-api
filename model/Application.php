<?php

class Application{
	private $conn;
	private $table='applications';

		//properties
		public $id;
		public $date_start;
		public $date_end;
		public $reason;
		public $status;
		public $user_id;

			//Const
		public function __construct($db){
			$this->conn=$db;
		}


	//Get applications
	public function read(){
		// Query
		$query="SELECT * FROM " .$this->table. " ORDER BY submit_date DESC";
		// Statement prep
		$stmt = $this->conn->prepare($query);

		// Execute query
		$stmt->execute();

		return $stmt;
	}

	public function read_single(){
		//Query
		$query="SELECT * FROM ".$this->table." WHERE zid = ?";

		// Statement prep
		$stmt = $this->conn->prepare($query);

		//Bind id
		$stmt->bindParam(1,$this->id);

		// Execute query
		$stmt->execute();

		$row=$stmt->fetch(PDO::FETCH_ASSOC);


		//set Properties
		$this->id=$row['id'];
		$this->submit_date=$row['submit_date'];
		$this->date_start=$row['date_start'];
		$this->date_end=$row['date_end'];
		$this->reason=$row['reason'];
		$this->status=$row['status'];
		$this->user_type=$row['user_id'];


	}

	public function create(){
		$query="INSERT INTO ".$this->table." 
		SET 
			date_start = :date_start,
			date_end = :date_end,
			reason = :reason,
			user_id= :user_id";

		$stmt = $this->conn->prepare($query);

		//Bind data
		$stmt->bindParam(':date_start',$this->date_start);
		$stmt->bindParam(':date_end',$this->date_end);
		$stmt->bindParam(':reason',$this->reason);
		$stmt->bindParam(':user_id',$this->user_id);

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
			date_start = :date_start,
			date_end = :date_end,
			reason = :reason,
			status= :status,
			user_id= :user_id WHERE id = :id";

		$stmt = $this->conn->prepare($query);

		//Bind data
		$stmt->bindParam(':id',$this->id);
		$stmt->bindParam(':date_start',$this->date_start);
		$stmt->bindParam(':date_end',$this->date_end);
		$stmt->bindParam(':reason',$this->reason);
		$stmt->bindParam(':status',$this->status);
		$stmt->bindParam(':user_id',$this->user_id);

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