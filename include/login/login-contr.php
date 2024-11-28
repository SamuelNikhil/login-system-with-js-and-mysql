<?php

declare(strict_types=1);

function is_input_empty(
    
    string $username,
    string $password
    
    ){

    if(
        empty($username) &&
        empty($password)
    ){

        return true ;
    }else{

        return false;
    }
}

function Wrong_username(bool | array $result){

    if(!$result){

        return true;
    }
    else{

        return false;
    }    
}

function Wrong_password(
    
    string $password, 
    string $hashedpwd
    
    ){

    if(!password_verify(
        
        $password, 
        $hashedpwd
        
        )){

        return true;
    }else {

        return false;
    }
}