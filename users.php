<?php
require_once('../LoginSysteem/db.php');

class Users
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users;";
        $result = $this->db->query($query);
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM `users` WHERE `id`='$id'";
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function createUser($firstName, $lastName, $email, $password)
    {
        $query = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$password')";
        $this->db->query($query);
    }

    public function updateUser($firstName, $lastName, $email, $password, $id)
    {
        $query = "UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email', password='$password' WHERE id = $id";
        print_r($query);
        $this->db->query($query);
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM `users` WHERE `id`=$id;";
        $this->db->query($query);
    }

    public function getUsers($id) {
        return $this->db->query("SELECT * FROM users WHERE id=$id");
    }
}