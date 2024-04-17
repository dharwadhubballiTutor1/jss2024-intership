<?php
$configs = require_once("../../views/config.php");
require "../../Model/Registration.php";
require "../Utilities/Sanitization.php";
include "../../Admin/DB Operations/enqueryOps.php";
include "../../Admin/DB Operations/notificationOps.php";
include "../../blogadmin/dblayer/smsOps.php";
include "../../blogadmin/dblayer/templateOps.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['id'])) {
    $reg = new Registration();
    $reg->set_id(Sanitization::test_input($_POST["id"]));
    $reg->set_name(Sanitization::test_input($_POST["name2"]));
    $reg->set_email(Sanitization::test_input($_POST["email2"]));
    $reg->set_phone(Sanitization::test_input($_POST["phone2"]));
    $reg->set_Source(Sanitization::test_input($_POST["source"]));
    $reg->set_trainings(Sanitization::test_input($_POST["trainings2"]));
    $reg->set_demo(Sanitization::test_input($_POST["democlass"]));
    $reg->set_internship(Sanitization::test_input($_POST["internship2"]));
    $reg->set_services(Sanitization::test_input($_POST["services"]));
    $reg->setBranch(Sanitization::test_input($_POST["branch"]));

    DBenquery::update($reg);
  } else {
    $reg = new Registration();
    $reg->set_name(Sanitization::test_input($_POST["name2"]));
    $reg->set_email(Sanitization::test_input($_POST["email2"]));
    $reg->set_phone(Sanitization::test_input($_POST["phone2"]));
    if (isset($_POST['source'])) {
      $reg->set_Source(Sanitization::test_input($_POST["source"]));
    } else {
      $reg->set_Source("Website");
    }
    if (isset($_POST['trainings2'])) {
      $reg->set_trainings(Sanitization::test_input($_POST["trainings2"]));
    } else {
      $reg->set_trainings("");
    }
    if (isset($_POST['demo2'])) {
      $reg->set_demo(Sanitization::test_input($_POST["demo2"]));
    } else {
      $reg->set_demo("");
    }
    if (isset($_POST['internship2'])) {
      $reg->set_internship(Sanitization::test_input($_POST["internship2"]));
    } else {
      $reg->set_internship("");
    }
    if (isset($_POST['services'])) {
      $reg->set_services(Sanitization::test_input($_POST["services"]));
    } else {
      $reg->set_services("");
    }
    if (isset($_POST['branch'])) {
    $reg->setBranch(Sanitization::test_input($_POST["branch"]));
    }else {
      $reg->setBranch("");
    }
    if(isset($_POST["front"])){
      $reg->set_Source("Website");
    }
    $smsDetails = DBsms::getAllsmsDetails();
    $SenderMessage = DBtemplate::getSenderandMessage();
    $message = new sms();
    $message->setNumbers($reg->get_phone());

    $msg = str_replace("{name}", $reg->get_name(), $SenderMessage->getmessage());
    error_log($msg);
    error_log($reg->get_phone());
    $message->setMessage($msg);
    $message->setSender($SenderMessage->getsender());
    $message->setusername($smsDetails->getusername());
    $message->setAPIkey($smsDetails->getAPIkey());
    $message->setKey($smsDetails->getKey());
    DBenquery::insert($reg);
    $message->sendSMS();
    $notification = new Notification();
    $notification->setStatus('1');

    if (!empty($_POST['trainings2'])) {
      $notification->setMessage('There Has Been an enquiry for Training');
      $notification->setCategory('trainings-tab-content');
    } else if (!empty($_POST['internship2'])) {
      $notification->setMessage('There Has Been an enquiry for Internship');
      $notification->setCategory('Internship-tab-content');
    } else if (!empty($_POST['services'])) {
      $notification->setMessage('There Has Been an enquiry for Services');
      $notification->setCategory('services-tab-content');
    } else if (!empty($_POST['democlass2'])) {
      $notification->setMessage('There Has Been an enquiry for democlass');
      $notification->setCategory('democlass-tab-content');
    }
    DBnotification::insert($notification);
  }
}

if (Sanitization::test_input($_POST["front"]) == "front") {
  header("location:../../");
} else {

  header("location:../View/enquiries.php");
}
