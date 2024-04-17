<?php
require "../../Admin/Model/Trainermodel.php";
require "../../Utilities/Sanitization.php";
require "../../Admin/Utilities/Helper.php";
require "../../Admin/DB Operations/TrainerOps.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $admit = new Trainer();
  $admit->set_name(Sanitization::test_input($_POST["name"]));
  $admit->set_phone(Sanitization::test_input($_POST["phone"]));
  $admit->set_email(Sanitization::test_input($_POST["email"]));
  $admit->set_qualification(Sanitization::test_input($_POST["qualification"]));
  $admit->set_coursesassigned($_POST["coursesassigned"]);
  $admit->set_address(Sanitization::test_input($_POST["address"]));
  $admit->set_adhaarno(Sanitization::test_input($_POST["adhaarno"]));
  $filetoupload = $_FILES["adhaarfile"];
  Helper::fileupload($filetoupload);
  $filetoupload = $_FILES["photofile"];
  Helper::fileupload($filetoupload);
  $filetoupload = $_FILES["resume"];
  Helper::fileupload($filetoupload);
  $admit->set_adhaarfile($_FILES["adhaarfile"]['name']);
  $admit->set_photofile($_FILES["photofile"]['name']);
  $admit->set_resume($_FILES["resume"]['name']);
  $last_id=DBtrainer::insert($admit);
  foreach ($trainerObj->get_coursesassigned() as $courses) {
    $sql = "insert into trainercoursemapping(`trainerid`,`courseid`) values (" . $last_id . "," . $courses . ")";
    $connectionObj->query($sql);
  }
}
  header("location:../View/trainers.php");
