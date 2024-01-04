<?php
    class Reward{
        private $conn;
        private $table= 'tbl_rewards';

        public $id;
        public $mobile;
        public $client_mobile;
        public $client_paid;
        public $r7pcent;
        public $cashout;
        public $created_at;


        public function __construct($db){
            $this->conn= $db;
        }

        //getting post from database
        public function read(){
            //create query
            $query='SELECT * FROM
            '.$this->table. ' WHERE cashout = "N" ';
            //prepare the statement
            $sql= $this->conn->prepare($query);
            //execute query
            $sql->execute();
            return $sql;
        }

    public function create(){
        $query='INSERT INTO ' .$this->table . ' SET mobile = :mobile, client_mobile = :client_mobile, client_paid = :client_paid, r7pcent = :r7pcent, cashout = :cashout';
        //prepare the statement
        $sql= $this->conn->prepare($query);
        //clean data (remove unwanted special characters)
        $this->mobile       =htmlspecialchars(strip_tags($this->mobile));
        $this->client_mobile       =htmlspecialchars(strip_tags($this->client_mobile));
        $this->client_paid      =htmlspecialchars(strip_tags($this->client_paid));
        $this->r7pcent      =htmlspecialchars(strip_tags($this->r7pcent));
        $this->cashout      =htmlspecialchars(strip_tags($this->cashout));


        //bind parameter
        $sql->bindParam(':mobile', $this->mobile);
        $sql->bindParam(':client_mobile', $this->client_mobile);
        $sql->bindParam(':client_paid', $this->client_paid);
        $sql->bindParam(':r7pcent', $this->r7pcent);
        $sql->bindParam(':cashout', $this->cashout);

        //execute query
        if($sql->execute()){
            return true;
        }
        //print error if something goes wrong
        printf("Error %s. \n",$sql->error);
        return false;
    }
    public function update(){
        $query='UPDATE ' .$this->table. '
        SET  cashout = "T"
        WHERE cashout = "N" AND id =:id
        ';
        //prepare the statement
        $sql= $this->conn->prepare($query);
        //clean data (remove unwanted special characters)
        $this->id       =htmlspecialchars(strip_tags($this->id));
        

        //bind parameter
        $sql->bindParam(':id', $this->id);
        

        //execute query
        if($sql->execute()){
            return true;
        }
        //print error if something goes wrong
        printf("Error %s. \n",$sql->error);
        return false;
    }
    public function delete(){
        $query='DELETE FROM ' .$this->table . ' WHERE id = :id';
        //prepare the statement
        $sql= $this->conn->prepare($query);
        //clean data (remove unwanted special characters)
        $this->id =htmlspecialchars(strip_tags($this->id));
        //bind parameter
        $sql->bindParam(':id', $this->id);

        //execute query
        if($sql->execute()){
            return true;
        }
        //print error if something goes wrong
        printf("Error %s. \n",$sql->error);
        return false;

      }
    }
