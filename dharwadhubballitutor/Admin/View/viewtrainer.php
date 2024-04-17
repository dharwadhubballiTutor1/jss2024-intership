<?php
include "../../Admin/session.php";
include "../../Admin/DB Operations/TrainerOps.php";
include "../../Admin/model/Trainermodel.php";
$id = $_GET['id'];
$trainer = DBtrainer::viewtrainer($id);
include_once "header.php";
?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h6 class="">Trainer Details</h6>
            </div>
            <div class="col-md-6">
                <div class="form-check float-right">
                    <input type="radio" class="btn-check" name="options" id="option2">
                    <label class="" for="option2">Edit <i class="fas fa-edit"></i></label>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo 'uploads/', $trainer->get_photofile(); ?>" alt="Admin" class="rounded-circle" width="100" height="100">
                    <div class="mt-3">
                        <?php echo $trainer->get_name(); ?>
                    </div>
                    <div>
                        <?php
                        if (count($trainer->get_coursesassigned()) == 0) {
                            echo "No courses Mapped";
                        }
                        foreach ($trainer->get_coursesassigned() as $coursesname) {
                            echo "<span class='badge rounded-pill bg-warning text-dark'>" . $coursesname . "</span>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form class="form" action="update.php" method="POST" id="myForm" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="col-md-6 control-label">Full Name</label>
                            <div class="col-sm-12">
                                <input type="text" id="name" placeholder="Full Name" name="name" class="form-control" pattern="[a-zA-Z\-\ ]+" value="<?php
                                                                                                                                                        echo $trainer->get_name();
                                                                                                                                                        ?>">
                                <input type="hidden" id="id" name="id" value="<?php echo $trainer->get_id(); ?>">
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="phone" class="col-md-6 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="tel" id="phone" placeholder="Phone" name="phone" class="form-control" value="<?php
                                                                                                                            echo $trainer->get_phone();
                                                                                                                            ?>">
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="email" class="col-md-6 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" id="email" placeholder="Email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php
                                                                                                                                                                                echo $trainer->get_email();
                                                                                                                                                                                ?>">
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="qualification" class="col-md-6 control-label">Qualification</label>
                            <div class="col-sm-12">
                                <input type="text" id="qualification" name="qualification" placeholder="Your Qualification" class="form-control" pattern="[A-Za-z]+" required value="<?php
                                                                                                                                                                                        echo $trainer->get_qualification();
                                                                                                                                                                                        ?>">
                            </div>
                        </div>
                        <br />
                    </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="address" class="col-md-6 control-label">Address</label>
                <div class="col-sm-12">
                    <textarea id="address" name="address" placeholder="Residential Address" class="form-control" required><?php echo $trainer->get_address(); ?></textarea>
                </div>
            </div>
            <br/>
            <div class="col-md-6">
                <label for="adhaarno" class="control-label">Adhaar Number</label>
                <div class="col-sm-12">
                    <input type="text" 
                    id="adhaarno" 
                    name="adhaarno" 
                    placeholder="Your Adhaar Number" 
                    class="form-control" 
                    pattern="[0-9]{4}[0-9]{4}[0-9]{4}" 
                    required 
                    value="<?php echo $trainer->get_adhaarno();?>">
                </div>
            </div>
            <br/>
            <div class="col-md-6">
                <label for="adhaarfile" class="form-label">Adhaar File</label>
                <div class="col-sm-12">
                    <a href="<?php echo 'uploads/', $trainer->get_adhaarfile(); ?>" class="form-control" download> Click to download</a>
                </div>
            </div>
            <br/>
            <br/>
            <div class="col-md-6">
                <label for="adhaarfile" class="form-label">Resume</label>
                <div class="col-sm-12">
                    <a href="uploads/" $.adhaarfile class="form-control"> Click to
                        download</a>
                </div>
            </div>
            <br/>
            <div class="col-md-6">
                <label for="adhaarfile" class="form-label">Upload Adhaar</label>
                <div class="col-sm-12">
                    <input type="file" name="adhaarfile" id="adhaarfile" class="form-control">
                </div>
            </div>
            <br/>
            <div class="col-md-6">
                <label for="resume" class="form-label">Upload Resume</label>
                <div class="col-sm-12">
                    <input type="file" name="resume" id="resume" class="form-control">
                </div>
            </div>
            <br/>
            <button class="btn btn-success" type="submit" name="submit">Update</button>
            <br/>
        </div>
        </form>
        </br>
    </div>
</div>
</br>
<?php include_once("footer.php") ?>
<script>
    $(document).ready(function() {
        $("#myForm :input").prop("disabled", true);
        $('input[type=radio][name=options]').click(function() {
            $('#myForm :input').prop('disabled', false);
        });
    });
</script>