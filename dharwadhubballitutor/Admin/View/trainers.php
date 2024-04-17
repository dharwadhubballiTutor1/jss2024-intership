<?php
require "../../Admin/session.php";
include "../../Admin/DB Operations/TrainerOps.php";
include "../../Admin/model/Trainermodel.php";
include "../../Admin/DB Operations/CoursesOps.php";
include "header.php";
?>

<style>
    .form-check-label {
        color: white;
    }

    #trainerslist_length {
        float: left;
        width: 50%;
        display: inline;
        margin-left: 100px;
    }
</style>
<div class="card">
    <div class="card-header">
            <h6 class="">Trainers</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-trainers-tab" data-bs-toggle="pill" data-bs-target="#pills-trainers" type="button" role="tab" aria-controls="pills-trainers" aria-selected="true">Trainers list</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="pills-newtrainer-tab" data-bs-toggle="pill" data-bs-target="#pills-newtrainer" type="button" role="tab" aria-controls="pills-newtrainer" aria-selected="false">New Trainer</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" 
            id="pills-trainers" 
            role="tabpanel" 
            aria-labelledby="pills-trainers-tab">
                <table class="table table-stripped" id="trainerslist">
                    <thead>
                        <tr>
                            <th style="display:none"> Id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Qualification</th>
                            <th>AdhaarNo</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <?php
                    echo  "<tbody>";
                    $trainerslist = DBtrainer::searchtrainer();
                    foreach ($trainerslist as $trainer) {
                        echo "<tr><td style='display:none'> "  . $trainer->get_id() . "</td><td>"  . $trainer->get_name() . "</td><td>" . $trainer->get_phone() . "</td><td>" . $trainer->get_email() . "</td><td>" . $trainer->get_qualification() . "</td><td>" . $trainer->get_adhaarno() . "</td><td>" . '<a class="btn btn-warning" href="../View/viewtrainer.php?id=' . $trainer->get_id() . '&photofile=' . $trainer->get_photofile() . '" role="button">View </a>' . '</td></tr>';
                    }
                    echo  "</tbody>";
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" 
            id="pills-newtrainer" 
            role="tabpanel" 
            aria-labelledby="pills-newtrainer-tab">
                <form class="form-horizontal" action="../Controller/newtrainer.php" method="POST" role="form" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="col-md-6 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" id="name" placeholder="Full Name" name="name" class="form-control" pattern="[a-zA-Z\-\ ]+" required>
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
                            <label for="qualification" class="col-md-6 control-label">Qualification</label>
                            <div class="col-sm-12">
                                <input type="text" id="qualification" name="qualification" placeholder="Your Qualification" class="form-control" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="coursesassigned" class="col-md-6 control-label" name="coursesassigned">Courses Assigned</label>
                            <div class="col-md-12">
                                <select class="form-select" multiple aria-label="multiple select example" id="coursesassigned" name="coursesassigned[]">
                                    <option value=''>-----SELECT-----</option>
                                    <?php
                                    $courselist = DBcourse::selectcourse();
                                    foreach ($courselist as $clist) {
                                        echo "<option value='" . $clist->get_id() . "'>" . $clist->get_cname() . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="address" class="col-md-6 control-label">Address</label>
                            <div class="col-sm-12">
                                <textarea id="address" 
                                name="address" 
                                placeholder="Residential Address" 
                                class="form-control" required></textarea>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="adhaarno" class="col-md-6 control-label">Adhaar Number</label>
                            <div class="col-sm-12">
                                <input type="text" id="adhaarno" name="adhaarno" placeholder="Your Adhaar Number" class="form-control" pattern="[0-9]{4}[0-9]{4}[0-9]{4}" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="adhaarfile" class=" col-md-6 form-label">Upload Adhaar</label>
                            <div class="col-sm-12">
                                <input type="file" name="adhaarfile" id="adhaarfile" class="form-control">
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="photofile" class=" col-md-6 form-label">Upload Photo</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" name="photofile" id="photofile" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="resume" class=" col-md-6 form-label">Upload Resume</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" name="resume" id="resume" required>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-warning">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once("footer.php"); ?>
<script>
    var trainerslist = $('#trainerslist').DataTable();
    $(document).ready(function() {
        $("[type=search]").addClass("form-control").attr("placeholder", "Type to search...").attr("style",
            "margin-left:50px");
        $("select").addClass("form-select").attr("aria-label", "Default select example");
    });
</script>
</body>

</html>