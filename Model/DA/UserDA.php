<?php

include_once('DAMethods.php');
//    $dsn="mysql:host=184.154.206.12;dbname=pidrawsc_eyrie;charset=utf8";
//    $username='pidrawsc_birdadmin';
//    $password='Squareroot#2';

//localhost
$dsn="mysql:host=localhost;dbname=pidrawsc_eyrie";
$username='root';
$password='';
    try {
     $db = new PDO($dsn, $username, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo $e->getMessage();
    exit();
    }

    function get_user($username) {
    global $db;
    $query = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $info = $statement->fetchAll();
    $statement->closeCursor();
    
   foreach($info as $user){
    $user['id'] = new User(
            $user['id'], 
            $user['username'], 
            $user['barn'], 
            $user['food'], 
            $user['medicine'], 
            $user['money'],
            $user['role']);
    
   return $user['id'];  } 
}

function get_user_by_id($id){
     global $db;
    $query = 'SELECT * FROM users WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $info = $statement->fetchAll();
    $statement->closeCursor();
    
    foreach($info as $user){
    $user['id'] = new User(
            $user['id'], 
            $user['username'], 
            $user['barn'], 
            $user['food'], 
            $user['medicine'], 
            $user['money'],
            $user['role']);
    
    return $user['id'];  } 
}

function get_all_users(){
    
}

function add_new_user($username, $email, $password){
    global $db;
    $query = "INSERT INTO users (username, email, password, barn, food, medicine, money)
             VALUES (:username, :email, :password, 'My Barn', 50, 10, 2000)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
}

function get_user_password($userid){
    
}

function get_user_by_griffin($griffinID){
    global $db;
    $query = "SELECT userid FROM griffins WHERE id = :griffinid";
    $statement = $db->prepare($query);
    $statement->bindValue(':griffinid', $griffinID);
    $statement->execute();
    $data = $statement->fetchAll();
    $statement->closeCursor();
    
    foreach($data as $id){
        $userID = $id['userid'];
    }
    return $userID;
}

function check_username($userName) {
    global $db;
    $query = "SELECT UserName FROM users WHERE UserName=:userPlaceholder";
    $statement = $db->prepare($query);
    $statement->bindValue('userPlaceholder', $userName);
    $statement->execute();
    $userresults = $statement->fetchAll();
    $statement->closeCursor();
    if (count($userresults) > 0) {
        return true;
    } else {
        return false;
    }
}
function check_email($email) {
    global $db;
    $query = "SELECT email FROM users WHERE email=:emailPlaceholder";
    $statement = $db->prepare($query);
    $statement->bindValue('emailPlaceholder', $email);
    $statement->execute();
    $emailresults = $statement->fetchAll();
    $statement->closeCursor();
    if (count($emailresults) > 0) {
        return true;
    } else {
        return false;
    }
}

?>


