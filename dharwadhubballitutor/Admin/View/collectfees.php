<?php
require "../../Admin/session.php";
require_once "../DB Operations/termsandconditionsOps.php";
include "../../Admin/DB Operations/FeesOps.php";
// include "../../Admin/model/Feesmodel.php";
include "../../Admin/Utilities/Helper.php";
include "header.php";
$id = $_GET['id'];
$collectfees = DBfees::collectionoffees($id);
?>
<style>
#enquery_length {
    float: left;
    width: 50%;
    display: inline;
    margin-left: 100px;
}

#feepaymentlist_length {
    float: left;
    width: 50%;
    display: inline;
    margin-left: 100px;
}
.table{
    width:100%;
    
}


</style>


<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h6 class="">Fees Details </h6>
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
        <table class="table table-bordered" id="feepaymentlist">
            <thead>
                <tr>
                    <th class="p-2">Paid Date</th>
                    <th>Paid Fees</th>
                    <th>Pending Fees</th>
                    <th>Payment Mode</th>
                    <th> Fee Receipt </th>
                </tr>
            </thead>
            <?php

            echo  "<tbody>";
            $feesdetails = DBfees::viewfeesdetails($id);
            foreach ($feesdetails as $fees) {
                echo "<tr><td> "  .  $fees->get_modifieddate() . "</td><td>"  . $fees->get_pfees() . "</td><td>" . $fees->get_pendingfees() . "</td><td>" . $fees->get_pmode() . "</td><td>"
                    . '<button class="btn btn-success" data-toggle="modal" data-target="#TransactionModal" role="button" id="feereceipt" name="feereceipt" > View Fee Receipt </button>' . '</td></tr>';
            }
            echo  "</tbody>";
            ?>
        </table>
        <div class="row">
            <div class="col-md-12">
                
                <form class="form" action="../Controller/feesaddition.php" method="POST" id="myForm"
                    enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="col-md-6 control-label">Full Name</label>
                            <div class="col-sm-12">
                                <input type="text" id="name" placeholder="Full Name" name="name" class="form-control"
                                    value="<?php echo $collectfees->get_name(); ?>">

                                <input type="hidden" id="admitid" name="admitid"
                                    value="<?php echo $collectfees->get_admitid(); ?>">
                                <input type="hidden" id="courseid" name="courseid"
                                    value="<?php echo $collectfees->get_courseid(); ?>">
                            </div>
                        </div>
                        <br />

                        <div class="col-md-6">
                            <label for="coursesopted" class="col-md-6 control-label">Courses
                                Opted</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="coursesopted" name="coursesopted" required
                                    value="<?php echo $collectfees->get_coursesopted(); ?>">
                            </div>
                        </div>
                        <br />

                        <div class="col-md-6">
                            <label for="phone" class="col-md-6 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="tel" id="phone" placeholder="Phone" name="phone" class="form-control"
                                    value="<?php echo $collectfees->get_phone(); ?>">
                            </div>
                        </div>
                        <br />

                        <div class="col-md-6">
                            <label for="tfees" class="col-md-6 control-label">Total fees</label>
                            <div class="col-sm-12">
                                <input type="text" id="tfees" name="tfees" class="form-control" required
                                    value="<?php echo $collectfees->get_tfees() ?>">
                            </div>
                        </div>
                        <br />

                        <div class="col-md-6">
                            <label for="pfees" class="col-md-6 control-label">Fees Paid</label>
                            <div class="col-sm-12">
                                <input type="text" id="pfees" name="pfees" class="form-control" required
                                    value="<?php echo $collectfees->get_pfees() ?>">
                            </div>
                        </div>
                        <br />

                        <div class="col-md-6">
                            <label for="pendingfees" class="col-md-6 control-label">Pending Fees</label>
                            <div class="col-sm-12">
                                <input type="text" id="pendingfees" name="pendingfees" class="form-control" required
                                    value="<?php echo $collectfees->get_pendingfees() ?>">
                            </div>
                        </div>
                        <br />

                        <div class="col-md-6">
                            <label for="feesplan" class="col-md-6 control-label">Fees Plan</label>
                            <div class="col-sm-12">
                                <select class="form-select" id="feesplan" name="feesplan" required>
                                    <option value="">Fees Plan</option>
                                    <option value="Part Payment">Part Payment</option>
                                    <option value="Full Payment">Full Payment</option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div id="duedatediv" class="col-md-6" style="display: none">
                            <label for="duedate" class="col-md-6 control-label"> Next payment on:</label>
                            <div class="col-sm-12">
                                <input type="date" id="duedate" name="duedate" class="form-control" required />
                            </div>
                        </div>
                        <br />
                        <div class="col-md-6">
                            <label for="pmode" class="col-md-6 control-label">Payment Mode</label>
                            <div class="col-sm-12">
                                <select class="form-select" id="pmode" name="pmode" required>
                                    <option value=""></option>
                                    <option value="Cash">Cash</option>
                                    <option value="Net Banking">Net Banking</option>
                                    <option value="Debit/Credit Card">Debit/Credit Card </option>
                                    <option value="UPI transaction">UPI transaction</option>
                                </select>
                            </div>
                        </div>
                        <br />

                        <div class="col-md-6">
                            <label for="pdescription" class="col-md-6 control-label">Payment
                                Description</label>
                            <div class="col-sm-12">
                                <input type="text" id="pdescription" name="pdescription"
                                    placeholder="Payment Description" class="form-control" required>
                            </div>
                        </div>
                        <br />

                        <div>
                            <button class="btn btn-success" id="btn" type="submit" name="submit">Update <i
                                    class="fas fa-save"></i></button>
                           
                        </div>
                </form>
             
                </br>
            </div>
        </div>
       
    </div>

</div>
<div class="modal fade" id=TransactionModal tabindex=-1 role=dialog aria-hidden=true>
    <div class="modal-dialog modal-xl">
        <div class="row gutters-sm">
            <div class="col-md-2 mb-2">
            </div>
            <div class="col-md-12">
                <form class="form" method="POST" id="TransactionForm" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                                    <div class="col-md-12" id="printTransaction">
                                      
      
                                        <table class="table table-bordered  container" id="StudentTransaction">
                                            <thead>
                                                <tr>
                                                    <td style="text-align:left" colspan="7">
                                                    <h1 style="text-align:left">ಧಾರವಾಡ ಹುಬ್ಬಳ್ಳಿ ಟ್ಯೂಟರ್</h1> 
                                                    <p style="text-align:left">  JP Nippani Complex,Gandhinagar</p>
                                                    <p style="text-align:left"><i class="fas fa-phone"></i>  +919741237334 ,+918007961759</p>
                                                    <p style="text-align:left"><i class="fas fa-globe"></i> www.dharwadhubballitutor.com </p>
                                                    </td>
                                                    <td colspan="4" style="text-align: center;">
                                                    <img alt="logo" src="../media/logo.png" width="100px" height="100px"> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td colspan="10" style="text-align:center">
                                                <h4>Invoice</h4>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <!-- <th >Customer Name </th> -->
                                                    <td colspan="10" style="text-align:left">
                                                        <h5>Student Details</h5>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan="4" >
                                                        Student Name : <span id="studName"><?php echo $collectfees->get_name(); ?></span>
                                                    </td>
                                                    <td colspan="6">
                                                        Admission Id : <span><?php echo $collectfees->get_admitid(); ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        Address : <span><?php echo $collectfees->getAddress(); ?></span>
                                                    </td>
                                                    <td colspan="6">
                                                        Course Opted: <span><?php echo $collectfees->get_coursesopted(); ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        Date : <span id="Date"><?php echo $date = date('d-m-Y '); ?></span>
                                                    </td>
                                                    <td colspan="6">
                                                        Total Amount : <span><?php echo $collectfees->get_tfees() ?></span>
                                                    </td>
                                                    <div id="POcode" style="display:none"></div>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:center">Sl</th>
                                                    <th style="text-align:center">Payment Date</th>
                                                    <th style="text-align:center">Mode of payment</th>
                                                    <th style="text-align:center" colspan=1>Pending Amount</th>
                                                    <th style="text-align:center" colspan=6>Paid Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
        
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    
        
                                                    <td style="text-align:right" rowspan="" colspan="3">Total</td>
                                                    <td id="pending" style="text-align:center" ></td>
                                                    <td id="totalpaidAmount" style="text-align:center"  colspan="6"></td>
                                                </tr>
                                            </tfoot>
                                            <tr>
        
                                            </tr>
                                        </table>
                                        <br><br><br><br><br><br>
<div style="text-align:right">
    Authorized Signatory
</div>


                                         <div class="form-group">
                                            <div class="row">
                                                 <input type="hidden" name="createdby" id="createdby" class="form-control"
                                                    required value="" />
                                                <input type="hidden" name="modifiedby" id="modifiedby" class="form-control"
                                                    required value="" />
                                                <input type="hidden" id="admitID"
                                                    value="<?php echo $collectfees->get_admitid(); ?>" />
                                            </div>
                                         </div>
                                         <br><br><br><br><br><br><br><hr>
                                         <div class="form-group">
                                              <div class="row">
                                                  <h4>Terms and Conditions:</h4>
                                                   <div style="font-size:13px">
                                                   <?php $term = DBterms::gettermsandconditions(); 
                                                   echo $term->getdescription();?>
                                                   </div>
                                              </div>
                                         </div>
                                     
                                    </div>
                        </div>
                        <div class="modal-footer" id="footer">
                                    <input type="submit" name="submit" id="PDF" class="btn btn-success"
                                        value="Save AS PDF" />
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                            
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php include ("footer.php");?>

<script>
$(document).ready(function() {
    $("#feepaymentlist").DataTable({})
    $("#myForm :input").prop("disabled", true);
    $('input[type=radio][name=options]').click(function() {
        $('#myForm :input').prop('disabled', false);
        if (!parseInt($('#tfees').val())) {
            $('#tfees').focus();
            $('#pfees').attr('disabled', true);
        } else {
            $('#tfees').attr('readonly', true);
        }
    });

    $("#feesplan").change(function() {

        if ($(this).val() == "Part Payment") {
            $("#duedatediv").show();
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;

            $("#duedate").attr("min", today);
            $("#duedate").attr('disabled', false);
            $("#btn").attr("disabled", false);
        } else {
            debugger;
            if (parseInt($("#pfees").val()) > 0 && parseInt($("#pendingfees").val()) != 0) {
                $("#btn").attr("disabled", true);
                alert("Fees is still due");
            }

            $("#duedate").attr('disabled', true);
        }
    });

    $("#tfees").change(function() {
        if (parseInt($(this).val()) > 0) {
            $('#pfees').attr('disabled', false);
        }
    });

    $("#pfees").change(function() {
        debugger;
        if (parseInt($(this).val()) < parseInt($("#tfees").val())) {
            if ($("#pendingfees").val() == 0) {
                var pendingfees = $("#tfees").val() - $("#pfees").val();
            } else {
                var pendingfees = $("#pendingfees").val() - $("#pfees").val();

            }
            $("#pendingfees").val(pendingfees);
        }


    });

    if (parseInt($("#pfees").val()) == parseInt($("#tfees").val())) {
        $("#myForm :input").prop("disabled", true);
        $("#option2").prop("disabled", true);
    }

    $('#TransactionModal').on('show.bs.modal', function(e) {
        debugger;
        var rowid =$('#admitID').val();
        
        var transactionUrl = config.developmentPath +
            "/Admin/Controller/feesaddition.php?admitID=" + rowid;
        console.log(transactionUrl);

        $.getJSON(transactionUrl, function(data) {
            console.log(data);
            var count = 1;
            var TotalPendingAmount = 0;
            var TotalPaidAmount = 0;
            $("#StudentTransaction tbody").find("tr:gt(0)").remove();
            $.each(data, function(index, value) {

                $('#StudentTransaction tbody').
                append($(document.createElement('tr')).prop({

                }));

                $('#StudentTransaction tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: count++,
                    style:"text-align:center"

                }));

                $('#StudentTransaction tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.modifieddate,
                    style:"text-align:center"
                }));

                $('#StudentTransaction tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.pmode,
                    style:"text-align:center"
                }));
                $('#StudentTransaction tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.pendingfees,
                    style:"text-align:center"
                }));
                $('#StudentTransaction tr:last').
                append($(document.createElement('td')).prop({
                    innerHTML: value.pfees,
                    colspan:6,
                    style:"text-align:center"
                }));

                TotalPendingAmount = parseInt(value.pendingfees)
                TotalPaidAmount = parseInt(TotalPaidAmount) + parseInt(value
                    .pfees)
            });
            $('#pending').text(TotalPendingAmount);
            $('#totalpaidAmount').text(TotalPaidAmount);
        });
    });


    $('#TransactionForm').submit(function(e) {
        debugger;
        $('#footer').hide();
        var content = $('#printTransaction').html();
        var fileName = $('#studName').text() + $('#Date').text()+ '_Transaction';

        var uniturl = config.developmentPath +
            "/Admin/Controller/pdfGeneratorContorller.php";

        $.ajax({
            type: "POST",
            url: uniturl,
            data: {
                "modifiedby": $('#modifiedby').val(),
                "admitID": $('#admitID').val(),
                "fileType": "Fee Receipts",
                // "waterMarked": waterMarked,
                "fileName": fileName,
                "html": content
            },
            dataType: "json",
            encode: true,
        }).done(function(data) {
            console.log(data);
            setTimeout(function() {
                $('#printTransaction').html('');
            }, 20000);
        });

        window.open(config.developmentPath + '/Admin/uploads/Fee Receipts/' + fileName
            .trim() + '.pdf');
    });

});
</script>