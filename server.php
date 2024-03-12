<?php
include_once('users.php');
// session_start();

$Users = new Users();

// initialize variables
$firstName = "";
$lastName = "";
$email = "";
$password = "";
$id = 0;
$update = false;

if (isset($_POST['save'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $Users->createUser($firstName, $lastName, $email, $password);
    // $db->query("INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES (NULL, '$firstName', '$lastName', '$email', '$password')");
    $_SESSION['message'] = "User saved";
    header('location: index.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $Users->updateUser($firstName, $lastName, $email, $password, $id);

    $_SESSION['message'] = "User updated!";
    header('location: index.php');
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $Users->deleteUser($id);
    $_SESSION['message'] = "User deleted!";
    header('location: index.php');
}
?>