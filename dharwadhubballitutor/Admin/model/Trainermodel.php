
<?php 
   class Trainer
  {
    private $id;
    private $Name;
    private $Phone;
    private $Email;
    private $Qualification;
    private $Coursesassigned=array();
    private $Address;
    private $AdhaarNo;
    private $Adhaarfile;
    private $Photofile;
    private $Resume;
    private $table_name="trainers";
    
    function set_id($id) {
      $this->id = $id;
    }
    function get_id() {
      return $this->id;
    }

    function set_name($name) {
    $this->Name = $name;
    }
    function get_name() {
    return $this->Name;
    }

    function set_phone($phone) {
    $this->Phone = $phone;
    }
    function get_phone() {
    return $this->Phone;
    }


    function set_email($email) {
    $this->Email = $email;
    }
    function get_email() {
    return $this->Email;
    }

    function set_qualification($qualification) {
    $this->Qualification = $qualification;
    
    }
    function get_qualification() {
    return $this->Qualification;
    }

    function set_coursesassigned($coursesassigned) {
    $this->Coursesassigned= $coursesassigned;
    }
    function get_coursesassigned() {
    return $this->Coursesassigned;
    }

    function set_address($address) {
    $this->Address = $address;
    }
    function get_address() {
    return $this->Address;
    }
    function set_adhaarno($adhaarno) {
    $this->AdhaarNo = $adhaarno;
    }
    function get_adhaarno() {
    return $this->AdhaarNo;
    }
    function set_adhaarfile($adhaarfile) {
    $this->AdhaarFile = $adhaarfile;
    }
    function get_adhaarfile() {
    return $this->AdhaarFile;
    }
    function set_photofile($photofile) {
    $this->PhotoFile = $photofile;
    }
    function get_photofile() {
    return $this->PhotoFile;
    }
    function set_resume($resume) {
      $this->Resume = $resume;
      }
      function get_resume() {
      return $this->Resume;
      }
 }
 
?>
