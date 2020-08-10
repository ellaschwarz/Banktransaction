<?php

class Recipients
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    //Getting all users from database
    public function recipientData()
    {
        $sql= ("SELECT * FROM bank.vw_users");
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        $recipient = [];

        while ($row = $stmt->fetch()) {
            
            // Extract $row
            extract($row);
    
            // Setup structure for recipient.
            $recipient_data = [
                'id' => $id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'username' => $username,
                'password' => $password,
                'account_id' => $account_id,
                'balance' => $balance
            ];
    
            // Add recipient_data to recipient array.
            array_push($recipient, $recipient_data);
        }

        return $recipient;
    }
}
