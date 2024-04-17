<?php
require_once "../../DB Operations/dbconnection.php";
class DBtrainer
{
  public static function insert($trainerObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();

    $sql = "insert into trainers (`Name`, `Phone`, `Email`,`Qualification`,`Address`,`AdhaarNo`,`AdhaarFile`,`PhotoFile`,`Resume`) 
                values ('" . $trainerObj->get_name() . "','" . $trainerObj->get_phone() . "','" . $trainerObj->get_email() . "', '" . $trainerObj->get_qualification() . "','" . $trainerObj->get_address() . "','" . $trainerObj->get_adhaarno() . "','" . $trainerObj->get_adhaarfile() . "','" . $trainerObj->get_photofile() . "','" . $trainerObj->get_resume() . "')";
    if ($connectionObj->query($sql) === TRUE) {
      return $last_id = $connectionObj->insert_id;
    } else {
      echo "Error: " . $sql . "<br>" . $connectionObj->error;
    }
  }
  public static function searchtrainer()
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();

    $searchtrainer = "";
    if (isset($_POST['submit']))
      $searchtrainer = $_POST["search"];
    echo $searchtrainer;
    $sql = "SELECT id,Name,Email,Phone,Qualification,AdhaarNo,PhotoFile From trainers where Name like '%$searchtrainer%' ";
    $result = mysqli_query($db->getConnection(), $sql);
    $trainerslist = [];
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $view = new Trainer();
        $view->set_id($row['id']);
        $view->set_name($row['Name']);
        $view->set_phone($row['Phone']);
        $view->set_email($row['Email']);
        $view->set_qualification($row['Qualification']);
        $view->set_adhaarno($row['AdhaarNo']);
        $view->set_photofile($row['PhotoFile']);
        array_push($trainerslist, $view);
      }
    } else {
      echo "0 results";
    }
    return $trainerslist;
  }
  public static function viewtrainer($viewObj)
  {
    $db = ConnectDb::getInstance();
    $connectionObj = $db->getConnection();
    $sql = "select * from trainers where id=$viewObj";
    $result = mysqli_query($db->getConnection(), $sql);
    $view = new Trainer();
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $view->set_id($row['id']);
      $view->set_name($row['Name']);
      $view->set_phone($row['Phone']);
      $view->set_email($row['Email']);
      $view->set_qualification($row['Qualification']);
      $view->set_address($row['Address']);
      $view->set_adhaarno($row['AdhaarNo']);
      $view->set_adhaarfile($row['AdhaarFile']);
      $view->set_photofile($row['PhotoFile']);
      $view->set_resume($row['Resume']);
      $sql = "select CName from courses as C join trainercoursemapping as TCM on C.id=TCM.courseid where TCM.trainerid=(" . $viewObj . ")";
      $result = mysqli_query($db->getConnection(), $sql);
      if (mysqli_num_rows($result) > 0) {
        $courseslist = [];
        while ($row = mysqli_fetch_assoc($result)) {
          array_push($courseslist, $row['CName']);
        }
        $view->set_coursesassigned($courseslist);
      }
    } else {
      $view = NULL;
    }
    return $view;
  }
}
