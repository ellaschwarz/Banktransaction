<?php

class Transaction
{

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertData($transaction_data)
    {

        $checkRecipient = $this->checkRecipient($transaction_data);
        $checkSender = $this->checkSender($transaction_data);
        $checkbalance = $this->checkBalance($transaction_data);
        $checkNumber = $this->checkNumber($transaction_data);


        if (!$checkSender) {
            throw new Exception('The account number of the sender does not exist');
        }

        if (!$checkNumber) {
            throw new Exception('The amount must be a number');
        }

        if (!$checkRecipient) {
            throw new Exception('The account number of the recipient does not exist');
        }

        if ($transaction_data->from_amount !== $transaction_data->to_amount) {
            throw new Exception('You must send the same value');
        }

        if ($transaction_data->from_amount < 0 || $transaction_data->to_amount < 0) {
            throw new Exception('Amount can not be less than zero');
        }

        if ($transaction_data->from_amount > $checkbalance) {
                throw new Exception('Not enough money in your account, try a smaller amount');

        } else {
            //If there's no exceptions, insert data to database
            $sql = ('INSERT INTO bank.transactions (from_account, to_account, to_amount, from_amount) VALUES (:from_account, :to_account, :to_amount, :from_amount)');

            print_r($transaction_data);
    
            // Prepare query.
            $stmt = $this->db->connect()->prepare($sql);

            // Bind values.
            $stmt->bindValue('from_account', filter_var($transaction_data->from_account, FILTER_SANITIZE_STRING));
            $stmt->bindValue('to_account', filter_var($transaction_data->to_account, FILTER_SANITIZE_STRING));
            $stmt->bindValue('to_amount', filter_var($transaction_data->to_amount, FILTER_SANITIZE_STRING));
            $stmt->bindValue('from_amount', filter_var($transaction_data->from_amount, FILTER_SANITIZE_STRING));
            echo 'Transaction made successfully';

            // Execute query and return result.
            return $stmt->execute();
        }
    }

    //Checks if sender exists in database
    protected function checkSender($transaction_data)
    {
        $sql = ('SELECT account_id FROM bank.vw_users WHERE account_id = :from_account');
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':from_account', $transaction_data->from_account);
        $stmt->execute();
        $from_account_id = $stmt->fetch();

        return $from_account_id;
    }

    //Checks if recipient exists in database
    protected function checkRecipient($transaction_data)
    {
        $sql = ('SELECT account_id FROM bank.vw_users WHERE account_id = :to_account');
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':to_account', $transaction_data->to_account);
        $stmt->execute();
        $to_account_id = $stmt->fetch();

        return $to_account_id;
    }

    //Checks if the account holds enough money
    protected function checkBalance($transaction_data)
    {
        $sql = ('SELECT balance FROM bank.vw_users WHERE account_id = :from_account');
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':from_account', $transaction_data->from_account);
        $stmt->execute();
        $balance = $stmt->fetch();
        $balancebalance = $balance['balance'];

        return $balancebalance;
    }

    //Checks if amount is number
    protected function checkNumber($transaction_data)
    {
        if (is_numeric($transaction_data->from_amount) || (is_numeric($transaction_data->from_amount))) {
            return true;
        }
    }
}
