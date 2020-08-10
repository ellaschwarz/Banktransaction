<?php

class User
{

    public $user_id;
    protected $firstName;
    protected $lastName;
    protected $username;
    protected $password;
    protected $account_id;
    protected $balance;
    protected $db;

    public function __construct($db, $username, $password)
    {
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
    }


    public function userData()
    {
        $sql= ("SELECT * FROM bank.vw_users WHERE username = :username");
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        $data = $stmt->fetchAll();
        print_r($data);
        

        $this->user_id = $data['id'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->account_id = $data['account_id'];
        $this->balance = $data['balance'];
    }
}