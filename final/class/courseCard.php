<?php
include("instructor.php");
class Course {
  private $courseId;
  private $name;
  private $description;
  private $duration;
  private $instructor;
  private $price;

  // Constructor
  public function __construct($courseId, $name, $description, $duration, Instructor $instructor, $price) {
    $this->courseId = $courseId;
    $this->name = $name;
    $this->description = $description;
    $this->duration = $duration;
    $this->instructor = $instructor;
    $this->price = $price;
  }

  // Getters
  public function getCourseId() {
    return $this->courseId;
  }

  public function getName() {
    return $this->name;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getDuration() {
    return $this->duration;
  }

  public function getInstructor() {
    return $this->instructor;
  }

  public function getPrice(){
    return $this->price;
  }

  // Setters
  public function setName($name) {
    $this->name = $name;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setDuration($duration) {
    $this->duration = $duration;
  }

  public function setPrice($price){
    $this->price = $price;
  }
  // Display course information
  public function showCourseInfo() {
    echo "Course ID: " . $this->getCourseId() . "<br>";
    echo "Name: " . $this->getName() . "<br>";
    echo "Description: " . $this->getDescription() . "<br>";
    echo "Duration: " . $this->getDuration() . "<br>";
    echo "Instructor: " . $this->getInstructor()->getUsername() . "<br>";
  }
}
