<?php
require "../session.php";
require_once "../DB Operations/enqueryOps.php";
require_once "../../Admin/DB Operations/AdmissionsOps.php";
include "../../Admin/DB Operations/CoursesOps.php";
require_once "../../Admin/model/Admissionsmodel.php";
require_once "header.php"
?>
<div class="card">
    <div class="card-header">
        <h6 class="">Admission</h6>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-enquiry-tab" data-bs-toggle="pill" data-bs-target="#pills-enquiry" type="button" role="tab" aria-controls="pills-enquiry" aria-selected="true">From Enquiry</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="pills-newadmit-tab" data-bs-toggle="pill" data-bs-target="#pills-newadmit" type="button" role="tab" aria-controls="pills-newadmit" aria-selected="false">New Admission</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-admissions-tab" data-bs-toggle="pill" data-bs-target="#pills-admissions" type="button" role="tab" aria-controls="pills-admissions" aria-selected="false">Admission List</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-enquiry" role="tabpanel" aria-labelledby="pills-enquiry-tab">
                <table class="table table-bordered table-responsive" id="enquery">
                    <thead>
                        <tr>
                            <th style="display:none">Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Qualification</th>
                            <th> Move to Admission </th>
                        </tr>
                    </thead>
                    <?php
                    echo  "<tbody>";
                    $enquirylist = DBenquery::getAllEnquery();
                    foreach ($enquirylist as $enquiry) {
                        echo "<tr><td style='display:none'> " . $enquiry->get_Id() . "</td>
                                        <td> " . $enquiry->get_name() .
                            "</td><td>" . $enquiry->get_email() .
                            "</td><td>" . $enquiry->get_phone() .
                            "</td><td>" . $enquiry->get_qualification() .
                            "</td><td>
                                        <a class='btn btn-warning' href='moveadmission.php?id=" . $enquiry->get_id() . "&name=" . $enquiry->get_name() . "&phone=" . $enquiry->get_phone() . "&email=" . $enquiry->get_email() . "&qualification=" . $enquiry->get_qualification() . " role='button' type='submit' >Move </a>
                                        </td></tr>";
                    }
                    echo  "</tbody>";

                    ?>
                </table>
            </div>
            <div class="tab-pane fade " id="pills-newadmit" role="tabpanel" aria-labelledby="pills-newadmit-tab">
                <form class="form-horizontal" action="../Controller/newadmissions.php" method="POST" role="form" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="col-md-6 control-label">Full Name</label>
                            <div class="col-sm-12">
                                <input type="text" id="name" placeholder="Full Name" name="name" class="form-control" pattern="[a-zA-Z\-\ ]+" required>
                                <input type="hidden" name="id" id="id" value="">
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="phone" class="col-md-6 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="tel" id="phone" placeholder="Phone" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="email" class="col-md-6 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" id="email" placeholder="Email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="dateofbirth" class="col-md-6 control-label">Date of
                                Birth</label>
                            <div class="col-sm-12">
                                <input type="date" id="dateofbirth" name="dateofbirth" class="form-control" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="gender" class="col-md-6 control-label">Gender</label>
                            <div class="col-md-12">
                                <div class="col-md-4 form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="Female">
                                    <label class="form-check-label" for="inlineRadio1">Female</label>
                                </div>
                                <div class="col-md-4 form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="Male">
                                    <label class="form-check-label" for="gender">Male</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="qualification" class="col-md-6 control-label">Qualification</label>
                            <div class="col-sm-12">
                                <input type="text" id="qualification" name="qualification" placeholder="Your Qualification" class="form-control"  required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="guardiansname" class="col-md-6 control-label">Guardians
                                Name</label>
                            <div class="col-sm-12">
                                <input type="text" id="guardiansname" name="guardiansname" placeholder="Guardians Name" class="form-control" pattern="[a-zA-Z\-\ ]+" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="guardiansphone" class="col-md-8 control-label">Guardians Phone
                                Number</label>
                            <div class="col-sm-12">
                                <input type="text" id="guardiansphone" name="guardiansphone" placeholder="Guardians Phone Number" class="form-control" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="coursesopted" class="col-md-6 control-label">Courses
                                Opted</label>
                            <div class="col-sm-12">
                                <select class="form-select" id="coursesopted" name="coursesopted" required>
                                    <option value="">Select Your Interest</option>
                                    <?php
                                    $option = "";
                                    $courselist = DBcourse::selectall();
                                    foreach ($courselist as $course) {
                                        $option .= "<option value='" . $course->get_id() . "'";
                                        $option .=  ">" . $course->get_cname() . "</option>";
                                    }
                                    echo $option;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="address" class="col-md-6 control-label">Address</label>
                            <div class="col-sm-12">
                                <textarea id="address" name="address" placeholder="Residential Address" class="form-control" required></textarea>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="adhaarno" class="col-md-6 control-label">Adhaar Number</label>
                            <div class="col-sm-12">
                                <input type="text" id="adhaarno" name="adhaarno" placeholder="Your Adhaar Number" class="form-control" pattern="[0-9]{4}[0-9]{4}[0-9]{4}" >
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="adhaarfile" class=" col-md-12 form-label">Upload Your
                                Adhaar</label>
                            <div class="col-sm-12">
                                <input type="file" name="adhaarfile" id="adhaarfile" class="form-control" >
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="photofile" class=" col-md-6 form-label">Upload Your
                                Photo</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" name="photofile" id="photofile" >
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="resume" class=" col-md-12 form-label">Upload Your Resume</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" name="resume" id="resume" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-warning">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade table-responsive" id="pills-admissions" role="tabpanel" aria-labelledby="pills-admissions-tab">
                <table class="table table-bordered" id="addmissionlist">
                    <thead>
                        <tr>
                            <th style='display:none'> Id</th>
                            <th>Created Date</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Degree</th>
                            <th style='display:none'>Guardians Phone</th>
                            <th>Courses</th>
                            <th>DOA</th>
                            <th style='display:none'>AdhaarNo</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <?php
                    echo  "<tbody>";
                    $admissionlist = DBadmission::selectall();
                    foreach ($admissionlist as $admission) {
                        echo "<tr><td style='display:none'> "  . $admission->get_id() .
                        "</td><td>"  . $admission->getCreateddate() .
                            "</td><td>"  . $admission->get_name() .
                            "</td><td>" . $admission->get_phone() .
                            "</td><td >" . $admission->get_email() .
                            "</td><td>" . $admission->get_qualification() .
                            "</td><td style='display:none'>" . $admission->get_guardiansphone() .
                            "</td><td>" . $admission->get_coursesopted() .
                            "</td><td>" . $admission->getModifiedDate() .
                            "</td><td style='display:none'>" . $admission->get_adhaarno() .
                            "</td><td><a class='btn btn-warning' href='../View/viewprofile.php?id=" . $admission->get_id() .
                            "&photofile=" . $admission->get_photofile() .
                            "'role='button'>View </a></td></tr>";
                    }
                    echo  "</tbody>";
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once("footer.php")
?>
<script>
    $(document).ready(function() {
        var table = $('#enquery').DataTable({
            "order": [0, 'desc']
        });
        var addmissionList = $('#addmissionlist').DataTable({
            "order": [0, 'desc']
        });
        $("#dateofbirth").focus(function() {
            let thisYear = new Date();
            thisYear = thisYear.getFullYear();
            let allowedYear = thisYear - 5;
            allowedYear = allowedYear.toString();
            let year = new Date(allowedYear);
            let dd = String(year.getDate()).padStart(2, '0');
            let mm = String(year.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = year.getFullYear();
            year = yyyy + '-' + mm + '-' + dd;
            $("#dateofbirth").attr("max", year);
        })
    });
</script>