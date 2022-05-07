<?php 
require_once('connection.php');
require_once('alert.php');
session_start();

// initializing variables
$username = $password_1 = $password_2 = $sex = $nrTel = $email = $tara = "";

$errors = array();
$page = "";
$match = "";
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'php');

// REGISTER USER
if (isset($_POST['Register'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $password_1 = mysqli_real_escape_string($db, $_POST['pass']);
  $password_2 = mysqli_real_escape_string($db, $_POST['pass1']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $nrTel = mysqli_real_escape_string($db, $_POST['nrTel']);
  $sex = mysqli_real_escape_string($db, $_POST['gender']);
  $tara = mysqli_real_escape_string($db, $_POST['tara']);
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username) || preg_match('^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$', $username) === 0) {      array_push($errors, "Username obligatoriu. Trebuie sa inceapa cu o litera, poate sa contina cifre."); }
  if (empty($password_1) || preg_match('/^[a-zA-Z]\w{3,14}$/', $password_1) === 0) { array_push($errors, "Parola obligatorie. Minim 3 caractere, alfanumerice."); }
  if ($password_1 != $password_2) {
	array_push($errors, "Parolele nu se potrivesc");
  }
  if (empty($email)) { array_push($errors, "Email obligatoriu. ceva.ceva@ceva"); }
  if (empty($nrTel) || preg_match('/^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/', $nrTel) === 0) { array_push($errors, "Numar de telefon obligatoriu"); } 
  if (empty($sex)) { array_push($errors, "Alegeti-va sexul"); }
  if (empty($tara) || preg_match('/^([a-zA-Z])\w+/', $tara) === 0) { array_push($errors, "Tara obligatorie. Cuvant."); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM login WHERE name='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['name'] === $username) {
      $error = "Username existent. Introduceti unul nou.";
      $page = "register.php?Invalid= Username existent";
      phpAlert($error, $page);
    }

    if ($user['email'] === $email) {
      $error = "Email existent. Introduceti unul nou.";
      $page = "register.php?Invalid= Email existent";
      phpAlert($error, $page);
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO login (name, pass, email, nr_telefon, sex, tara, tip) 
  			  VALUES('$username', '$password_1', '$email', '$nrTel', '$sex', '$tara', 'user')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
  else{
      
      header('location: register.php?errors='.print_r($errors));
      
  }
}