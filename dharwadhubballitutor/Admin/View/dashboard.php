<?php
require "../session.php";
include "../../DB Operations/dbconnection.php";
require_once "header.php";
$db = ConnectDb::getInstance();
$query = "SELECT * FROM `coursebasedenq`";
$courseBasedEnq = mysqli_query($db->getConnection(), $query);
$query = "SELECT A.Admissions AS Admission, E.Enqueries AS Enqueries, E.MONTH AS MONTH FROM admissionsforlastq AS A JOIN enqueriesforlastq AS E ON A.MONTH=E.MONTH";
$EnqAndAdmission = mysqli_query($db->getConnection(), $query);
$query="SELECT * FROM `monthlyIncome`";
$monthlyFeesCollected=mysqli_query($db->getConnection(), $query);
$result = mysqli_query($db->getConnection(), "SELECT count(*) as total from candidates");
$totalenquiries = mysqli_fetch_assoc($result);

$result = mysqli_query($db->getConnection(), "SELECT count(*) as total from admissions");
$totalstudents = mysqli_fetch_assoc($result);

$query = mysqli_query($db->getConnection(), "SELECT Sum(PaidFees) as total FROM feescollectionlastm");
$paidfees = mysqli_fetch_assoc($query);

$query = mysqli_query($db->getConnection(), "SELECT Sum(TotalFees) as total FROM feescollectionlastm");
$totalfees = mysqli_fetch_assoc($query);

$sql = 'SELECT * FROM feescollectionlastm';
$result = mysqli_query($db->getConnection(), $sql);


$feescalculate = 0;
if ($totalfees['total'] > 0) {
    $feescalculate = $paidfees['total'] / $totalfees['total'] * 100;
}
?>

<style>
    /* .mr-3, .mx-3 {
            margin-right: 1rem !important;
            margin-top: 0rem;
            border-radius: 50px;
        } */
    .widget-stat,
    .media {

        align-items: center;
        background-color: #2a0a5e;
        height: 100%
    }

    .usericon {
        color: #f8c000;
        display: table;
        margin: 0 auto;
    }

    .mb-1 {
        font-size: 16px;
    }

    .enquiries {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        background-color: #f8c000;
        margin-right: auto !important;
        width: 100%;
    }

    .progress {
        width: 120px;
        height: 120px;
        background: none;
        position: relative;
        border-radius: 2px;
    }

    .progress::after {
        content: "";
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 10px solid #eee;
        position: absolute;
        top: 0;
        left: 0;
    }

    .progress>span {
        width: 50%;
        height: 100%;
        overflow: hidden;
        position: absolute;
        top: 0;
        z-index: 1;
    }

    .progress .progress-left {
        left: 0;
    }

    .progress .progress-bar {
        width: 100%;
        height: 100%;
        background: none;
        border-width: 10px;
        border-style: solid;
        position: absolute;
        top: 0;
    }

    .progress .progress-left .progress-bar {
        left: 100%;
        border-top-right-radius: 80px;
        border-bottom-right-radius: 80px;
        border-left: 0;
        -webkit-transform-origin: center left;
        transform-origin: center left;
    }

    .progress .progress-right {
        right: 0;
    }

    .progress .progress-right .progress-bar {
        left: -100%;
        border-top-left-radius: 80px;
        border-bottom-left-radius: 80px;
        border-right: 0;
        -webkit-transform-origin: center right;
        transform-origin: center right;
    }

    .progress .progress-value {
        position: absolute;
        top: 0;
        left: 0;
    }

    .outerring {
        color: #000;
    }

    .vertical-responsive {
        height: 300px;
        overflow-y: scroll;
    }
</style>
<!--Load the AJAX API-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class=row>
                <div class="col-md-6">
                    <h6 class="display-6">Dashboard</h6>
                </div>
                <div class="col-md-6 ">
                    <h6 class="display-6 text-end" id="today"></h6>
                </div>
            </div>
            <br />
            <div class=row>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Total Enquiries</h6>
                        </div>
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-4x "></i><br />
                            <h2 class="display-2">
                                <?php
                                echo $totalenquiries['total'];
                                ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Total Admissions</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-graduation-cap fa-4x"></i><br />
                                <h2 class="display-2">
                                    <?php
                                    echo $totalstudents['total'];
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Fees Collection</h6>
                        </div>
                        <div class="card-body">
                            <div class="progress mx-auto" data-value=<?php echo intval($feescalculate) ?>>
                                <span class="progress-left">
                                    <span class="progress-bar outerring"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar outerring"></span>
                                </span>
                                <br />
                                <br />
                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <h5 class="display-5">
                                        <?php echo intval($feescalculate) . "%" ?></h5>
                                </div>
                            </div></br />
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <br />
            <br />
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Enqueries Based on Courses
                        </div>
                        <div class="card-body">
                            <div id="enquiries_div"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Enqueries and Admission
                        </div>
                        <div class="card-body">
                            <div id="admissions_div"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <br />
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">Fee Details</div>
                        <div class="card-body vertical-responsive">

                            <table class="table" id="">
                                <thead>
                                    <tr cellspacing="0">
                                        <th>Name</th>
                                        <th>TotalFees</th>
                                        <th>PaidFees</th>
                                        <th>Due Date</th>
                                    </tr>
                                </thead>
                                <?php
                                echo  "<tbody>";
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if (!empty($row["DueDate"]) && $row["TotalFees"] != $row["PaidFees"]) {
                                            if (date_diff(date_create(date('d-m-Y', strtotime($row["DueDate"]))), date_create(date("d-m-Y")))->format("%R%a") > 0) {
                                                $rowClass = "table-danger";
                                            } else {
                                                $rowClass = " ";
                                            }
                                        } else {
                                            $rowClass = " ";
                                        }
                                        echo "<tr class=" . $rowClass . "><td>" . $row["Name"] . "</td><td>"
                                            . $row["TotalFees"] . "</td><td> "
                                            . $row["PaidFees"] . "</td><td>"
                                            . $row["DueDate"] . "</td></tr>";
                                    }
                                }
                                echo  "</tbody>";
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </br>
            </br>

            <div class="row">
                 <div class="col">
                <div class="card">
                        <div class="card-header">
                            Month Wise Amount Recieved
                        </div>
                        <div class="card-body">
                            <div id="monthlyIncome_div"></div>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once("footer.php") ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawadmissionsChart);
    google.charts.setOnLoadCallback(drawCollectedFeesChart);
    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.arrayToDataTable([
            ['Trainings', 'NUMBER'],
            <?php
            while ($row = mysqli_fetch_array($courseBasedEnq)) {

                echo "['" . $row['Trainings'] . "'," . intval($row['NUMBER']) . "],";
            }
            ?>
        ]);

        // Set chart options
        var options = {
            'title': '',
            'width': 405,
            'height': 300,
            'bar': {
                groupWidth: "95%"
            },
            'legend': {
                position: "none"
            },
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('enquiries_div'));
        chart.draw(data, options);
    }

    function drawadmissionsChart() {
        var data = google.visualization.arrayToDataTable([
            ['MONTH', 'Enqueries', 'Admission'],
            <?php
            while ($row = mysqli_fetch_array($EnqAndAdmission)) {

                echo "['" . $row['MONTH'] . "'," . intval($row['Enqueries']) . "," . intval($row['Admission']) . "],";
            }
            ?>
        ]);

        var options = {
            'title': '',
            'width': 405,
            'height': 300
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('admissions_div'));
        chart.draw(data, options);

    }
    function drawCollectedFeesChart() {
        var data = google.visualization.arrayToDataTable([
            ['MONTH', 'Fees Collected'],
            <?php
            while ($row = mysqli_fetch_array($monthlyFeesCollected)) {

                echo "['" . $row['MONTH'] . "'," . intval($row['AmountCollected']) . "],";
            }
            ?>
        ]);

        var options = {
            'title': '',
            'width': 900,
            'height': 300
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('monthlyIncome_div'));
        chart.draw(data, options);

    }
</script>
<script>
    $(function() {
        $(".progress").each(function() {
            var value = $(this).attr("data-value")
            var left = $(this).find(".progress-left .progress-bar")
            var right = $(this).find(".progress-right .progress-bar")

            if (value > 0) {
                if (value <= 50) {
                    right.css("transform", "rotate(" + percentageToDegrees(value) + "deg)")
                } else {
                    right.css("transform", "rotate(180deg)")
                    left.css("transform", "rotate(" + percentageToDegrees(value - 50) + "deg)")
                }
            }
        })

        function percentageToDegrees(percentage) {
            return (percentage / 100) * 360
        }
    })
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = dd + '-' + mm + '-' + yyyy;
    $('#today').text(today);
    $(document).ready(function() {
        $('.toast').toast('show');
    })
</script>