<?php 

session_start();

include 'mainAcc.user.php';
$user = new User();
if(isset($_POST['signup1'])){

if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){

if($_POST['password'] !== $_POST['confirm_password']){
$sessData['status']['type'] = 'error';
$sessData['status']['msg'] = 'All password fields must be the same'; 
}else{

$prevCon['where'] = array('email'=>$_POST['email']);
$prevCon['return_type'] = 'count';
$prevUser = $user->getRows($prevCon);
if($prevUser > 0){
$sessData['status']['type'] = 'error';
$sessData['status']['msg'] = 'Email already exists, use another email.';
}else{

$userData = array(
'first_name' => $_POST['first_name'],
'last_name' => $_POST['last_name'],
'email' => $_POST['email'],
'password' => md5($_POST['password']),
'phone' => $_POST['phone']
);
$insert = $user->insert($userData);

if($insert){
$sessData['status']['type'] = 'success';
$sessData['status']['msg'] = 'You have registered successfully.';
}else{
$sessData['status']['type'] = 'error';
$sessData['status']['msg'] = 'There was a problem, please try again.';
}
}
}
}else{
$sessData['status']['type'] = 'error';
$sessData['status']['msg'] = 'All fields are mandatory.'; 
}

$_SESSION['sessData'] = $sessData;
$redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'registration.php';

header("Location:".$redirectURL);






}elseif(isset($_POST['login1'])){

if(!empty($_POST['email']) && !empty($_POST['password'])){

$conditions['where'] = array(
'email' => $_POST['email'],
'password' => md5($_POST['password']),
'status' => '1'
);
$conditions['return_type'] = 'single';
$userData = $user->getRows($conditions);

if($userData){
$sessData['userLoggedIn'] = TRUE;
$sessData['userID'] = $userData['id'];
$sessData['status']['type'] = 'success';
$sessData['status']['msg'] = 'Welcome '.$userData['first_name'].'!';
}else{
$sessData['status']['type'] = 'error';
$sessData['status']['msg'] = 'Wrong email or password, try again.'; 
}
}else{
$sessData['status']['type'] = 'error';
$sessData['status']['msg'] = 'Enter email and password.'; 
}

$_SESSION['sessData'] = $sessData;

header("Location:index.php");







}elseif(!empty($_REQUEST['logout_me'])){

unset($_SESSION['sessData']);
session_destroy();

$sessData['status']['type'] = 'success';
$sessData['status']['msg'] = 'You have logout successfully.';
$_SESSION['sessData'] = $sessData;

header("Location:index.php");
}else{

header("Location:index.php");
}