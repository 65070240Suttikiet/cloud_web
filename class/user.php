<?php

//mutable Class

class User {
    private $username;
    private $email;
    private $password;
    private $role;
    private $contact;

    // Constructor
    public function __construct($username, $email, $password, $role, $contact) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->contact = $contact;
    }

    // Getters
    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getContact() {
        return $this->contact;
    }

    // Setters
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    // for checking
    public function showObjectData(){
        echo "ข้อมูลเกี่ยวกับผู้ใช้:<br>";
        echo "Username: " . $this->getUsername() . "<br>";
        echo "Email: " . $this->getEmail() . "<br>";
        echo "Role: " . $this->getRole() . "<br>";
        echo "Contact: " . $this->getContact() . "<br>";
    }
}

?>
