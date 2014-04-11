<?php

abstract class dbconnect
{
    private $dbAddress;
    private $dbAccount;
    private $dbPwd;
    private $dbName;

    public function __construct($address, $account, $pwd, $name) 
	{
        $this->dbAddress = $address;
        $this->dbAccount = $account;
        $this->dbPwd = $pwd;
        $this->dbName = $name;
        $this->connect($this->dbAddress, $this->dbAccount,
        $this->dbPwd, $this->dbName);
    }

    public function __destruct() 
	{
        $this->disconnect();
    }

    public function __sleep() 
	{
        $this->disconnect();
        return array('dbAddress', 'dbAccount', 'dbPwd', 'dbName');
    }

    public function __wakeup() 
	{
        $this->connect($this->dbAddress, $this->dbAccount,
        $this->dbPwd, $this->dbName);
    }

    abstract protected function connect($address, $account, $pwd, $name);
    abstract protected function disconnect();
    abstract function query($query);
    abstract function fetchRow();
	abstract function fetchObject();	
    abstract function fetchAll();
    abstract function getNumRows();
	abstract function getAffectedRows();
    abstract function freeResult();
    abstract function getError();
}

?>
