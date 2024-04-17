<?php
require "../../Admin/session.php";
require "../../Admin/Utilities/Helper.php";
include "../../Admin/DB Operations/followupOps.php";
require "../../Model/Registration.php";
require_once "header.php";
$id = $_GET["id"];
?>
<div class="card">
    <div class="card-header">
        <h6>Follow Up's</h6>
    </div>
    <div class=card-body>
        
    </div>
    <div class="card-footer">
        
    </div>
</div>


</div>
</div>
</div>
</div>
</body>
<script>
    
    ($document).ready(function() {
        $("#followupDate").focus(function() {
            let thisYear = new Date();
            thisYear = thisYear.getFullYear();
            let allowedYear = thisYear - 5;
            allowedYear = allowedYear.toString();
            let year = new Date(allowedYear);
            let dd = String(year.getDate()).padStart(2, '0');
            let mm = String(year.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = year.getFullYear();
            year = yyyy + '-' + mm + '-' + dd;
            $("#followupDate").attr("max", year);
        })

    });
</script>

</html>