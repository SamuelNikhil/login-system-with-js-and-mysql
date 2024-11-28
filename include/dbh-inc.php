<?php
//database handler

    ///declared variable to grab Mysql login data
    $host = "localhost";
    $dbname = "myfirstdb";
    $dbusername = "root";
    $dbpassword = "";

	///used try catch for error handling
	
    try{
        //DATABASE CONNECTION
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        //Attributes for PDO connection 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        //if error in DB connect stops connection and throw error
        die("Connection Failed: " . $e->getMessage());
    }