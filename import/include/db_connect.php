<?php
/**
 * @company:Kamilklkn
 * @link:http://kamilklkn.com
 * @editBy:Kamil Kalkan
 * @date:01/12/2015
 */
 
class DB_CONNECT {
    function __construct() {
        $this->connect();
    }
    function __destruct() {
        // closing db connection
        $this->close();
    }	 
    function connect() {         
		require_once 'db_config.php';
		
		// Connecting to mysql database
        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
		
        // Selecing database
        $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
		mysql_query('SET character_set_results=utf8');
		mysql_query('SET names=utf8'); 
		mysql_query('SET NAMES UTF8');		
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_connection=utf8');   
		mysql_query('SET character_set_results=utf8');   
		mysql_query('SET collation_connection=utf8_general_ci'); 
         
        return $con;
    }    
    function close() {
        
    }
}
 
?>