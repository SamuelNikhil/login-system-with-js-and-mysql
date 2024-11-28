<?php

function Check_login_errors(){

   if(isset($_SESSION["login_errors"])){

       $errors = $_SESSION["login_errors"];

       foreach ($errors as $error){

          echo $error ;
       }
        unset($_SESSION["login_errors"]);
   
    }
    // elseif(isset($_GET["login"]) && $_GET["login"] === "success"){
    //     echo "<br>";
    //     echo "<span class='form-error'>Login Success!</span>";
    // }
    
}