<?php
include_once('./Model/DA/UserDA.php');
function confirm_registration($username){
    
}

function validate_reg($username, $password, $email){
    $regError = '';
    if(!input_is_present($username)){
        $regError .= 'Please enter a valid username \n';
    }
    if(!username_not_duplicate($username)){
        $regError .= 'Username already in use. ';
    }
    if(!input_is_present($email) || !email_is_valid($email)){
        $regError .= 'Please enter a valid email address. \n';
    }
    if(!input_is_present($password)){
        $regError .= 'Please enter a valid password. \n';
    }
    return $regError;
}
function register_user($username, $password, $email){
    $hash = password_hash($password, PASSWORD_BCRYPT);
    add_new_user($username, $email, $hash);   
}
function input_is_present($input){
     $valid = false;
        if (trim($input) !== '') {
            $valid = true;}
        return $valid;  
}
function email_is_valid($email){
    
    $valid = false;
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $valid = true;
    }
    return $valid;
}

function email_not_duplicate($email){
    $valid = false;
    if(!check_email($email)){
        $valid = true;
    }
    return $valid;
}

function username_not_duplicate($username){
    $valid = false;
    if(!check_username($username)){
        $valid = true;
    }
    return $valid;
}

function starter_griffins(){
    
    
}



