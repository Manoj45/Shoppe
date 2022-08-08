<?php
session_start();

$host = "localhost";  
$user = "root";  
$password = '';  
$db_name = "login";  
  

// initializing variables
$username = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'login');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM loginform WHERE username='$username' OR password='$password' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }


  // Finally, register user if there are no errors in the form
  //if (count($errors) == 0) {
  	//$password = md5($password);//encrypt the password before saving in the database


    
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  }//
  $query = "INSERT INTO loginform (username, password) 
  VALUES('$username','$password')";
$run = mysqli_query($db, $query);

if($run)
{
echo "";
}

else{
echo "not submitted";
}
}
