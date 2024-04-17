<?php
require_once "../session.php";
require_once "../model/Feesmodel.php";
require_once "../Utilities/Sanitization.php";
require_once "../Utilities/Helper.php";
//require "../Admin/navbar.php";
require_once "../DB Operations/FeesOps.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $admit=new Fees();
    $admit->set_name(Sanitization::test_input($_POST["name"]));
    $admit->set_admitid(Sanitization::test_input($_POST["admitid"]));
    $admit->set_courseid(Sanitization::test_input($_POST["courseid"]));
    $admit->set_tfees(Sanitization::test_input($_POST["tfees"]));
    $admit->set_pfees(Sanitization::test_input($_POST["pfees"]));
    $admit->set_pendingfees(Sanitization::test_input($_POST["pendingfees"]));
    $admit->set_feesplan(Sanitization::test_input($_POST["feesplan"]));
    if (isset($_POST["duedate"])){
      $admit->set_duedate(Sanitization::test_input($_POST["duedate"]));
    }else{
      $admit->set_duedate(NULL); 
    }
    $admit->set_pmode(Sanitization::test_input($_POST["pmode"]));
    $admit->set_pdescription(Sanitization::test_input($_POST["pdescription"]));
    $filename="". $admit->get_name().date("Y-m-d").".pdf";
    $admit->set_feereceipt($filename);
    DBfees::insert($admit);
    // $receipt=DBfees::collectionoffees($admit->get_admitid());
    // Helper::feereceipt($receipt);
    header("location:../View/fees.php");
  }

  if ($_SERVER["REQUEST_METHOD"]=="GET") {
    
    DBfees::Transactiondetails($_GET['admitID']);
    error_log("hiii");
    }

?>



   