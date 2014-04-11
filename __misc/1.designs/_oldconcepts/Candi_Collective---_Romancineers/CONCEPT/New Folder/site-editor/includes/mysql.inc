<?php
require_once('iface.inc');

class connection extends dbconnect 
{
    private $connection;
    private $result;
        
    /* 
     * Connect function, also selects correct database
     * Returns 1 upon success, otherwise 0
     */
    function connect($address, $account, $pwd, $name)
    {
        $this->connection = @mysql_connect($address, $account, $pwd);

        if ($this->connection != 0) 
		{
            if (mysql_select_db($name, $this->connection)) 
			{
                return 1;
            }
            else
			{
                return 0;
            }
        }
        else 
		{
            return 0;
        }
    }

    /*
     * Disconnect function
     * Returns 1 upon success, otherwise 0
     */    
    function disconnect()
    {
		if (@mysql_close($this->connection) != 0) 
		{
            return 1;
        }
        else 
		{
            return 0;
        }
    }

    /*
     * Does a mysql-query, returns 1 upon sucess otherwise 0
     */    
    function query($query)
    {
        $this->result = mysql_query($query, $this->connection) or die (mysql_error());

        if ($this->result != 0) 
		{
            return 1; 
        }
        else 
		{
            return 0;
        }
    }

    /*
     * Fetches an array row
     */    
    function fetchRow()
    {
        return mysql_fetch_array($this->result);
    }
	
	
    /*
     * Returns an object with properties that correspond to the fetched row
     */
    function fetchObject()
    {
        return mysql_fetch_object($this->result);
    }
		

    function fetchAll()
    {
        while ($row = mysql_fetch_array($this->result)) 
		{
            $a_rs[] = $row;
        }
        mysql_free_result($this->result);
        return $a_rs;
    }
    
    /*
     * Get number of rows - use for SELECT or SHOW
     */
    function getNumRows()
    {
        return mysql_num_rows($this->result);
    }



    /*
     * Get number of affected rows - use for INSERT, UPDATE, REPLACE or DELETE
     */
    function getAffectedRows()
    {
        return mysql_affected_rows($this->connection);
    }	
	




	
	

    /*
     * Free resources allocated by a query 
     */    
    function freeResult()
    {
        mysql_free_result($this->result);
    }

    /*
     * Get errorstring
     */
    function getError()
    {
        return mysql_error($this->connection);
    }
}        

?>
