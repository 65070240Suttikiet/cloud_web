<?php
include('user.php');

class Student extends User {
    private $studentId;

    // Constructor
    public function __construct($username, $email, $password, $role, $contact) {
        parent::__construct($username, $email, $password, $role, $contact);
    }

    // Override method showObjectData
    public function showObjectData(){
        parent::showObjectData();
    }
}
