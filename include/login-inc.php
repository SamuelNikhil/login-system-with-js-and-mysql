<?php

//var_dump($_SERVER["REQUEST_METHOD"]);
//if condition to check whether the REQUEST_METHOD is POST ELSE CODE DIE


if ($_SERVER["REQUEST_METHOD"] === "POST") {
	
	//Grabs data from index PHP using "name" input type	
		
    $username= $_POST["username"];
    $password= $_POST["password"];
    
	//Used try and catch for error handling
	
    try{
        require_once "dbh-inc.php";
        require_once "login/login-model.php";
        require_once "login/login-contr.php";

        // Error Handlers
        $errors = [];

        if(is_input_empty($username, $password)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if( Wrong_username($result)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if(! Wrong_username($result) && Wrong_password($password, $result["Pwd"])){
            $errors["login_incorrect"] = "Incorrect Password info!";
        }
    
        require_once "config-session-inc.php";

        if($errors){
            $_SESSION["login_errors"] = $errors ;

            require_once "login/login-view.php";

            Check_login_errors();
            die();
        }

        $newSessionId = session_create_id();

        $_SESSION["user_id"] = $result["ID"];
        $_SESSION["user_username"] = htmlspecialchars($result["Username"]);

        $_SESSION['last_regeneration'] = time();

        $pdo = NULL;
        $stmt = NULL;

        die();
    } catch (PDOException $e){

        die("Query failed:" . $e->getmessage());
    }
}else {

    die();
}