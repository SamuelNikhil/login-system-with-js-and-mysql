<?php  

    //IMP website uses session ID created by our website
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);

    session_set_cookie_params([
        //To destroy a cookie after sometimes and checks whether it is a secure connection
        'lifetime'=> 1800,
        'domain'  => 'localhost',
        'path' => '/',
        'secure' => true,
        'httponly' => true
    ]);

session_start();

if(isset($_SESSION["user_id"])){

    if (!isset($_SESSION['last_regeneration'])){
        //if no generates new session time
        regenerate_session_id_loggedin();
    } else{
        //if yes
    
        //regenerates session in every 30mins
        $interval = 60 * 30;
    
        //if previous time and the current session time is greater than the time interval it resets session time
        if(time() - $_SESSION['last_regeneration'] >= $interval){
            
            regenerate_session_id_loggedin();
        }
    }

}else{  
    //regenerates the current session cookie ID time to time

//checks whether page already has a session cookie or not
if (!isset($_SESSION['last_regeneration'])){
    //if no generates new session time
    regenerate_session_id();
} else{
    //if yes

    //regenerates session in every 30mins
    $interval = 60 * 30;

    //if previous time and the current session time is greater than the time interval it resets session time
    if(time() - $_SESSION['last_regeneration'] >= $interval){
        
        regenerate_session_id();
    }
}
}

function regenerate_session_id_loggedin(){
    
    session_regenerate_id(true);
    
    $userID = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $uniqueSessionId = $newSessionId . "_" . $result["ID"];
    session_id($uniqueSessionId);

    $_SESSION['last_regeneration'] = time();
    return $uniqueSessionId;
}

function regenerate_session_id(){

    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

