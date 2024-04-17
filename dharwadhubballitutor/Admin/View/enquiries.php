<?php
require "../session.php";
include "../../Admin/DB Operations/enqueryOps.php";
require_once "../../Admin/model/Coursesmodel.php";
require_once "../../Admin/DB Operations/CoursesOps.php";
include "../../Admin/DB Operations/followupOps.php";

require_once "header.php";
?>
<style>
    td.details-control {
        background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
    }
</style>

<div class="card">
    <div class="card-header">
        <h6 class="">Enquiries</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="trainings-tab" data-bs-toggle="tab" data-bs-target="#trainings-tab-content" type="button" role="tab" aria-controls="trainings" aria-selected="true"><b>Trainings</b></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="internship-tab" data-bs-toggle="tab" data-bs-target="#Internship-tab-content" type="button" role="tab" aria-controls="internship" aria-selected="false"><b>Internship</b></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="democlass-tab" data-bs-toggle="tab" data-bs-target="#democlass-tab-content" type="button" role="tab" aria-controls="democlass" aria-selected="false"><b>Demo
                        Class</b></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services-tab-content" type="button" role="tab" aria-controls="services" aria-selected="false"><b>Services</b></button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="followup-tab" data-bs-toggle="tab" data-bs-target="#followup-tab-content" type="button" role="tab" aria-controls="followup" aria-selected="false"><b>FollowUp</b></button>
            </li>

            <li class="nav-item " role="presentation">
                <button class="nav-link " id="enquiry-tab" data-bs-toggle="tab" data-bs-target="#enquiry" type="button" role="tab" aria-controls="enquiry" aria-selected="false"><b>Add
                        Enquiry</b></button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active table-responsive" id="trainings-tab-content" role="tabpanel" aria-labelledby="trainings-tab">
                <table id="training" class="display table table-bordered ">
                    <thead>
                        <tr>
                            <th class="details-control"></th>
                            <th style="display:none">Id</th>
                            <th>DOE</th>
                            <th>FupD</th>
                            <th>Name<i class="bi bi-arrow-down-up"></i></th>
                            <th style="display:none">Email</th>
                            <th>Phone</th>
                            <th style="display:none">Qualification</th>
                            <th>Status</th>
                            <th>Branch</th>
                            <th style="display:none">Source</th>
                            <th>Trainings</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    echo  "<tbody>";
                    $enquirylist = DBenquery::getAllEnqueryBySection("Trainings");
                    foreach ($enquirylist as $enquiry) {
                        if ($enquiry->get_followupDate() && $enquiry->get_followupDate() != '00-00-0000') {

                            if (date_diff(date_create(date('d-m-Y', strtotime($enquiry->get_followupDate()))), date_create(date("d-m-Y")))->format("%R%a") > 0) {
                                $rowClass = "table-danger";
                            } else {
                                $rowClass = " ";
                            }
                        } else {
                            $rowClass = " ";
                        }
                        echo "<tr class=" . $rowClass . ">
                        <td class='details-control'></td>
                        <td style=display:none> " . $enquiry->get_id() . "</td>
                        
                        <td> " . $enquiry->get_enqcreatedon() . "</td>
                        <td> " . $enquiry->get_followupDate() . "</td>
                        <td> " . $enquiry->get_name() . "</td>
                        <td style=display:none>" . $enquiry->get_email() . "</td>
                        <td>" . $enquiry->get_phone() . "</td>
                        <td style=display:none>" . $enquiry->get_qualification() . "</td>
                        <td>" . $enquiry->get_Status() . "</td>
                        <td>" . $enquiry->getBranch() . "</td>    
                        <td style=display:none>" . $enquiry->get_Source() . "  </td>
                        <td>" . $enquiry->get_enqueryFor() . "</td>          
                                <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenu2' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='fas fa-info-circle'></i>
                                        </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
                                        <a class='btn  dropdown-item' role='button' href='editenquiry.php?id=" . $enquiry->get_id() . "'> 
                                            <i class='fas fa-info'></i>
                                            Edit Enquiry
                                        </a>
                                    </div> 
                                    </div>
                                </td></tr>";
                    }
                    echo  "</tbody>";
                    ?>
                </table>
            </div>
            <div class="tab-pane fade table-responsive" id="Internship-tab-content" role="tabpanel" aria-labelledby="internship-tab">
                <table id="Internship" class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th style="display:none">Id</th>
                            <th>DOE</th>
                            <th>Followup Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="display:none">Qualification</th>
                            <th>Internship</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    echo  "<tbody>";
                    $enquirylist = DBenquery::getAllEnqueryBySection("Internship");
                    foreach ($enquirylist as $enquiry) {
                        if ($enquiry->get_followupDate() && $enquiry->get_followupDate() != '0000-00-00 00:00:00') {

                            if (date_diff(date_create(date('d-m-Y', strtotime($enquiry->get_followupDate()))), date_create(date("d-m-Y")))->format("%R%a") > 0) {
                                $rowClass = "table-danger";
                            } else {
                                $rowClass = "";
                            }
                        } else {
                            $rowClass = "";
                        }
                        echo "<tr class=" . $rowClass . ">
                        <td style=display:none> " . $enquiry->get_id() . "</td>
                        <td> " . $enquiry->get_enqcreatedon() . "</td>
                        <td> " . $enquiry->get_followupDate() . "</td>
                        <td> " . $enquiry->get_name() . "</td>
                        <td>" . $enquiry->get_email() . "</td>
                        <td>" . $enquiry->get_phone() . "</td>
                        <td style=display:none>" . $enquiry->get_qualification() . "</td>
                        <td>" . $enquiry->get_enqueryFor() . "</td>          
                        <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenu2' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='fas fa-info-circle'></i>
                                        </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
        
                                        <a class='btn  dropdown-item'  role='button' href='followup.php?id=" . $enquiry->get_id() . "'> 
                                            <i class='fas fa-comment-dots'></i>
                                            Follow Up
                                        </a>
                                        <a class='btn  dropdown-item' role='button' href='editenquiry.php?id=" . $enquiry->get_id() . "  &name=  " . $enquiry->get_name() . "  &email= " . $enquiry->get_email() . " &phone=  " . $enquiry->get_phone() . "''> 
                                            <i class='fas fa-info'></i>
                                            Edit Enquiry
                                        </a>
                                    </div> 
                                    </div>
                                </td></tr>";
                    }
                    echo  "</tbody>";
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="democlass-tab-content" role="tabpanel" aria-labelledby="democlass-tab">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="Tabledemoclass">
                            <thead>
                                <tr>
                                    <th style="display:none">Id</th>
                                    <th>Created Date</th>
                                    <th>Followup Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Enquired For</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                            echo  "<tbody>";
                            $enquirylist = DBenquery::getAllEnqueryBySection("Demo");
                            foreach ($enquirylist as $enquiry) {
                                if ($enquiry->get_followupDate() && $enquiry->get_followupDate() != '0000-00-00 00:00:00') {

                                    if (date_diff(date_create(date('d-m-Y', strtotime($enquiry->get_followupDate()))), date_create(date("d-m-Y")))->format("%R%a") > 0) {
                                        $rowClass = "table-danger";
                                    } else {
                                        $rowClass = " ";
                                    }
                                } else {
                                    $rowClass = " ";
                                }
                                echo "<tr class=" . $rowClass . ">
                                <td style=display:none> " . $enquiry->get_id() . "</td>
                        <td> " . $enquiry->get_enqcreatedon() . "</td>
                        <td> " . $enquiry->get_followupDate() . "</td>
                        <td> " . $enquiry->get_name() . "</td>
                        <td>" . $enquiry->get_email() . "</td>
                        <td>" . $enquiry->get_phone() . "</td>
                    
                        <td>" . $enquiry->get_enqueryFor() . "</td>          
                        <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenu2' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='fas fa-info-circle'></i>
                                        </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
        
                                        <a class='btn  dropdown-item'  role='button' href='followup.php?id=" . $enquiry->get_id() . "'> 
                                            <i class='fas fa-comment-dots'></i>
                                            Follow Up
                                        </a>
                                        <a class='btn  dropdown-item' role='button' href='editenquiry.php?id=" . $enquiry->get_id() . "  &name=  " . $enquiry->get_name() . "  &email= " . $enquiry->get_email() . " &phone=  " . $enquiry->get_phone() . "''> 
                                            <i class='fas fa-info'></i>
                                            Edit Enquiry
                                        </a>
                                    </div> 
                                    </div>
                                </td></tr>";
                            }
                            echo  "</tbody>";
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="services-tab-content" role="tabpanel" aria-labelledby="services-tab">
                <table class="table table-bordered " id="Services">
                    <thead>
                        <tr>
                            <th style="display:none">Id</th>
                            <th>DOE</th>
                            <th>followupDate</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Services</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    echo  "<tbody>";
                    $enquirylist = DBenquery::getAllEnqueryBySection("Services");
                    foreach ($enquirylist as $enquiry) {
                        if ($enquiry->get_followupDate() && $enquiry->get_followupDate() != '0000-00-00 00:00:00') {

                            if (date_diff(date_create(date('d-m-Y', strtotime($enquiry->get_followupDate()))), date_create(date("d-m-Y")))->format("%R%a") > 0) {
                                $rowClass = "table-danger";
                            } else {
                                $rowClass = " ";
                            }
                        } else {
                            $rowClass = " ";
                        }
                        echo "<tr class=" . $rowClass . ">
                        <td style=display:none> " . $enquiry->get_id() . "</td>
                        <td> " . $enquiry->get_enqcreatedon() . "</td>
                        <td> " . $enquiry->get_followupDate() . "</td>
                        <td> " . $enquiry->get_name() . "</td>
                        <td>" . $enquiry->get_email() . "</td>
                        <td>" . $enquiry->get_phone() . "</td>
                       
                        <td>" . $enquiry->get_enqueryFor() . "</td>          
                                <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenu2' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='fas fa-info-circle'></i>
                                        </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
        
                                        <a class='btn  dropdown-item'  role='button' href='followup.php?id=" . $enquiry->get_id() . "'> 
                                            <i class='fas fa-comment-dots'></i>
                                            Follow Up
                                        </a>
                                       <a class='btn  dropdown-item' role='button' href='editenquiry.php?id=" . $enquiry->get_id() . "  &name=  " . $enquiry->get_name() . "  &email= " . $enquiry->get_email() . " &phone=  " . $enquiry->get_phone() . "''> 
                                            <i class='fas fa-info'></i>
                                            Edit Enquiry
                                        </a>
                                    </div> 
                                    </div>
                                </td></tr>";
                    }
                    echo  "</tbody>";
                    ?>

                </table>
            </div>
            <div class="tab-pane fade" id="followup-tab-content" role="tabpanel" aria-labelledby="followup-tab">

                <table class="table table-bordered w-100" id="TableFollowup">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="display:none">Id</th>
                            <th>DOE</th>
                            <th>FupD</th>
                            <th>Name<i class="bi bi-arrow-down-up"></i></th>
                            <th style="display:none">Email</th>
                            <th>Phone</th>
                            <th style="display:none">Qualification</th>
                            <th>Status</th>
                            <th>Branch</th>
                            <th style="display:none">Source</th>
                            <th>Trainings</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    echo  "<tbody>";
                    $enquirylist = DBenquery::getTodaysFollowUps();
                    foreach ($enquirylist as $enquiry) {
                        if ($enquiry->get_followupDate() && $enquiry->get_followupDate() != '00-00-0000') {

                            if (date_diff(date_create(date('d-m-Y', strtotime($enquiry->get_followupDate()))), date_create(date("d-m-Y")))->format("%R%a") > 0) {
                                $rowClass = "table-danger";
                            } else {
                                $rowClass = " ";
                            }
                        } else {
                            $rowClass = " ";
                        }
                        echo "<tr class=" . $rowClass . ">
                                <td class='details-control'></td>
                                <td style=display:none> " . $enquiry->get_id() . "</td>
                                
                                <td> " . $enquiry->get_enqcreatedon() . "</td>
                                <td> " . $enquiry->get_followupDate() . "</td>
                                <td> " . $enquiry->get_name() . "</td>
                                <td style=display:none>" . $enquiry->get_email() . "</td>
                                <td>" . $enquiry->get_phone() . "</td>
                                <td style=display:none>" . $enquiry->get_qualification() . "</td>
                                <td>" . $enquiry->get_Status() . "</td>
                                <td>" . $enquiry->getBranch() . "</td>    
                                <td style=display:none>" . $enquiry->get_Source() . "  </td>
                                <td>" . $enquiry->get_enqueryFor() . "</td>          
                                        <td>
                                            <div class='dropdown'>
                                                <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenu2' data-bs-toggle='dropdown' aria-expanded='false'>
                                                <i class='fas fa-info-circle'></i>
                                                </button>
                                            <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
                                                <a class='btn  dropdown-item' role='button' href='editenquiry.php?id=" . $enquiry->get_id() . "'> 
                                                    <i class='fas fa-info'></i>
                                                    Edit Enquiry
                                                </a>
                                            </div> 
                                            </div>
                                        </td></tr>";
                    }
                    echo  "</tbody>";
                    ?>
                </table>

            </div>
            <div class="tab-pane fade" id="enquiry" role="tabpanel" aria-labelledby="enquiry-tab">

                <form class="form-horizontal" id="addenquiry_form" action="../Controller/newenquiry.php" method="POST" role="form" autocomplete="off" enctype="multipart/form-data" name="enquiryform" onsubmit="return FormValidation()">
                    <div class="row g-3">
                        <div class="alert alert-danger alert-dismissable" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Select one among Trainings/Internships/Demo/Services
                        </div>
                        <div class="col-md-3">
                            <label class=label for=name2>Name</label>
                            <div class="col-sm-12">
                                <input type=text name=name2 class=form-control id=name2 placeholder=Name required />
                            </div>
                        </div>
                        <br />
                        <div class="col-md-3">
                            <label class=label for=email2>Email</label>
                            <div class="col-sm-12">
                                <input type=email name=email2 class=form-control id=email2 placeholder=name@example.com />
                            </div>
                        </div>

                        <br />
                        <div class="col-md-3">
                            <label class=label for=phone2>Phone </label>
                            <div class="col-sm-12">
                                <input type=tel name=phone2 class=form-control id=phone2 placeholder=Number required maxlength="10" />
                            </div>
                        </div>
                        <br />
                        <div class="col-md-3">
                            <label class=label for=source>Source </label>
                            <div class="col-sm-12">
                                <select class="custom-select" id="source" name="source">
                                    <option value="">Select </option>
                                    <option value="Referral">Referral</option>
                                    <option value="Website">Website</option>
                                    <option value="Google">Google </option>
                                    <option value="Walk-in">Walk-in </option>
                                    <option value="Facebook">Facebook </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class=label for=trainings2>Trainings</label>
                            <div class="col-sm-12">
                                <select class="custom-select" id="trainings2" name="trainings2">
                                    <option value="">Select your Interest</option>
                                    <option value="Web Designing and Development">Web Designing and Development
                                    </option>
                                    <?php
                                    $option = "";
                                    $courselist = DBcourse::selectall();
                                    foreach ($courselist as $course) {
                                        $option .= "<option 
                                                         >" . $course->get_cname() . "</option>";
                                    }
                                    echo $option;
                                    ?>
                                </select><br />
                            </div>
                        </div>
                        <br />
                        <div class="col-md-3">
                            <label class=label for=democlass>Demo Class</label>
                            <div class="col-sm-12">
                                <select class=custom-select id=democlass name=democlass>
                                    <option value="">Select your Interest</option>
                                    <option value="Web Designing and Development">Web Designing and Development
                                    </option>
                                    <option value="Python Programming">Python Programming</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Android Development">Android Development</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class=label for=internship2>Internships</label>
                            <div class="col-sm-12">
                                <select class=custom-select id=internship2 name=internship2>
                                    <option value="">Select your Interest</option>
                                    <option value="Web Designing and Development">Web Designing and Development
                                    </option>
                                    <option value="Python Programming">Python Programming</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Android Development">Android Development</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class=label for=services>Services</label>
                            <div class="col-sm-12">
                                <select class=custom-select id=services name=services>
                                    <option value="">Select your Interest</option>
                                    <option value="Web Designing and Development">Web Designing and Development
                                    </option>
                                    <option value="Python Programming">Business Process Setup</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Mobile Development">Mobile Development</option>
                                    <option value="Graphic Designing">Graphic Designing</option>
                                    <option value="Branding">Branding</option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="col-md-3">
                            <label class=label for=branch>Branch</label>
                            <div class="col-sm-12">
                                <select class=custom-select id=branch name=branch>
                                    <option value="Dharwad">Dharwad</option>
                                    <option value="Hubballi">Hubballi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 ">
                                <button type="submit" class="btn btn-primary float-right" name="post" id="post">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once("footer.php") ?>

<br />

<script>
    function FormValidation() {
        debugger;
        if (document.enquiryform.trainings2.value == '' && document.enquiryform.democlass.value == '' &&
            document.enquiryform.internship2.value == '' && document.enquiryform.services.value == '') {
            $('.alert').show();
            return false;

        } else {
            return true;
        }

    }
    $(document).ready(function() {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = dd + '-' + mm + '-' + yyyy;
        $('#today').text(today);


        $('.toast').toast('show');


        // var table = $('#training').DataTable({
        //     "order": [0, 'desc']
        // });
        var internship = $('#Internship').DataTable();
        var DemoClass = $('#Tabledemoclass').DataTable();
        var Services = $('#Services').DataTable();

        $('#column3_search').on('keyup', function() {
            table.columns(0).search(this.value).draw();
            internship.columns(0).search(this.value).draw();
            DemoClass.columns(0).search(this.value).draw();
            Services.columns(0).search(this.value).draw();
        });


        var FollowUp = $('#TableFollowup').DataTable({});
        var table = $('#training').DataTable({

        });

        // Add event listener for opening and closing details
        $('#training tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                let template = `<table class="table table-bordered" id="followuptable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Follwed By</th>
                        <th> FollowUp Date</th>
                        <th>Comments</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead><tbody>`;

                let followUpUrl = config.developmentPath + "/Admin/controller/newfollowup.php?id=" + row.data()[1];

                $.getJSON(followUpUrl).done(function(data) {
                    console.log(data);
                    $.each(data, function(index, value) {

                        template += `<tr><td>${value.followup_by}</td>
                        <td>${value.followupDate}</td>
                        <td>${value.comments}</td>
                        <td>${value.status}</td>
                        <td>${value.followup_on}</td>
                      
                        </tr>`;
                    });

                    template += `</tbody></table><br><br><form method="post" id="followup_form" action="../Controller/newfollowup.php">
          
          <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                      <label for="followupDate" class="col-md-6 control-label">FollowUp Date</label>
                      <div class="col-sm-12">
                          <input type="date" id="followupDate" name="followupDate" class="form-control" required>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <label for="status" class="col-md-6 control-label">Status</label>
                      <div class="col-sm-12">
                          <select class="custom-select" id="status" name="status">
                              <option value="">Select</option>
                              <option value="In Progress">In Progress</option>
                              <option value="Converted">Converted</option>
                              <option value="Bad">Bad</option>
                              <option value="Demo Class">Demo Class</option>

                          </select>
                      </div>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-md-12">
                      <fieldset>
                          <legend>Comments:</legend>
                          <div class="form-floating">
                              <textarea class="form-control" placeholder="Leave a comment here" id="followcomment" style="height: 100px" data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-trigger="keyup" name="followcomment"></textarea>
                              <label for="followcomment">Comments</label>
                          </div>
                          <input type="hidden" name="followenqid" id="followenqid" value="${row.data()[1]}">
                          <fieldset>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-md-8">
                      <input type="hidden" name="followupBy" id="followupBy" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value=<?php echo $_SESSION['login_user']; ?> />
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-warning">FollowUp</button>
          </form>`;
                    row.child(template).show();
                });

                tr.addClass('shown');
            }
        });
        $('#TableFollowup tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = FollowUp.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                let template = `<table class="table table-bordered" id="followuptable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Follwed By</th>
                        <th> FollowUp Date</th>
                        <th>Comments</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead><tbody>`;

                let followUpUrl = config.developmentPath + "/Admin/controller/newfollowup.php?id=" + row.data()[1];

                $.getJSON(followUpUrl).done(function(data) {
                    console.log(data);
                    $.each(data, function(index, value) {

                        template += `<tr><td>${value.followup_by}</td>
                        <td>${value.followupDate}</td>
                        <td>${value.comments}</td>
                        <td>${value.status}</td>
                        <td>${value.followup_on}</td>
                      
                        </tr>`;
                    });

                    template += `</tbody></table><br><br><form method="post" id="followup_form" action="../Controller/newfollowup.php">
          
          <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                      <label for="followupDate" class="col-md-6 control-label">FollowUp Date</label>
                      <div class="col-sm-12">
                          <input type="date" id="followupDate" name="followupDate" class="form-control" required>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <label for="status" class="col-md-6 control-label">Status</label>
                      <div class="col-sm-12">
                          <select class="custom-select" id="status" name="status">
                              <option value="">Select</option>
                              <option value="In Progress">In Progress</option>
                              <option value="Converted">Converted</option>
                              <option value="Bad">Bad</option>
                              <option value="Demo Class">Demo Class</option>

                          </select>
                      </div>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-md-12">
                      <fieldset>
                          <legend>Comments:</legend>
                          <div class="form-floating">
                              <textarea class="form-control" placeholder="Leave a comment here" id="followcomment" style="height: 100px" data-parsley-pattern="/^[a-zA-Z\s]+$/" data-parsley-trigger="keyup" name="followcomment"></textarea>
                              <label for="followcomment">Comments</label>
                          </div>
                          <input type="hidden" name="followenqid" id="followenqid" value="${row.data()[1]}">
                          <fieldset>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-md-8">
                      <input type="hidden" name="followupBy" id="followupBy" class="form-control" required data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="12" data-parsley-trigger="keyup" value=<?php echo $_SESSION['login_user']; ?> />
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-warning">FollowUp</button>
          </form>`;
                    row.child(template).show();
                });

                tr.addClass('shown');
            }
        });


    });
</script>