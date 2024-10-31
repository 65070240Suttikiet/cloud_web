<?php

include("user.php");

class Instructor extends User {
    private $courses;

    // Constructor
    public function __construct($username, $email, $password, $role, $contact) {
        parent::__construct($username, $email, $password, $role, $contact);
        $this->courses = [];
    }

    // Getter for courses
    public function getCourses() {
        return $this->courses;
    }

    // Override showObjectData() to include courses
    public function showObjectData() {
        parent::showObjectData();
        echo "Courses: <br>";
        foreach ($this->getCourses() as $course) {
            echo " - " . $course->getName() . "<br>";
        }
    }

    public function createCourse($course) {
        $this->courses[] = $course;
    }


}

?>
