<?php
session_start();
if(isset($_POST['login'])) $login = $_POST['login']; 
if(isset($_POST['password'])) $password = $_POST['password'];
$con = new MongoClient();
$collection= $con-> notes-> users;
$user = $collection -> findOne(array('login' => $login));

if (empty($user)){
    $user = array('login' => $login, 'password' => md5($password));
    $collection -> insert($user);  
    session_start(); 
    $_SESSION["session_login"] = $login;
    header('Refresh:0;URL=http://notes/calendar.php');
}

 else {
    echo "Choose another login";
}
$con -> close();     
       


 