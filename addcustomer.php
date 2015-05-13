<?php
$title="Add New Customer";
include "header.php";

if (isset($_POST["submit"])){
	include "php/DBConnect.php";
	if ($conn->connect_errno) {
			echo "$mysqli->connect_errno";
	}else{
		if ($connStatus){
			$insertSQL="INSERT INTO customers (first, last, state, dob, created) values ('".$_POST["first"]."',".
			" '".$_POST["last"]."', '".$_POST["state"]."', '".$_POST["dob"]."', '".date('Y-m-d')."')";
			$result=$conn->query($insertSQL);
			if ($conn->error){
				echo "Query Error: $conn->error";
			}
			else{
				if ($result)
					echo "<h2 class='center'>Customer <span class='whiteBG'>".$_POST["first"]." ".$_POST["last"]."</span> has been added.</h2>\n";
			}
		}
	}
	include "php/DBClose.php";	
}else{
?>
            <form method="post" action="addcustomer.php" onsubmit="return ValidateForm();">           
                <table>
				    <tr><td colspan="3"><h1>Add New Customer</h1></td></tr>
                    <tr>
                        <td>
                            <p class="center">
                                First Name: <input id="TBFName" name="first" value="" type="text" class="tbMedium" />&nbsp;<span id="SpanFNameError" class="error">*</span>
                            </p>
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td><p>Last Name: <input id="TBLName" name="last" value="" type="text" class="tbMedium" /><span id="SpanLNameError" class="error">*</span></p></td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                State:&nbsp;
				<?php
				include "php/PopulateDropDown.php";
				?>
                                <span id="SpanStateError" class="error">*</span>
                            </p>
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td><p>Date of Birth: <input type="text" id="DPdateOfBirth" readonly="readonly">&nbsp;<span id="SpanDateError" class="error">*</span></p></td>
                    </tr>
                </table>
				<div id="DivMessage" class="error center"><br />Please fix the above errors</div>
                <br />
                <div id="DivButtons"><input id="BtnSubmit" type="submit" name="submit" value="add user" />&nbsp;<input id="BtnReset" type="reset" value="reset" /></div>
				<input type="hidden" name="dob" id="HTBDOB" />
            </form>
            <script>
                $(document).ready(function () {
                    $("#DPdateOfBirth").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        showButtonPanel: true,
                        yearRange: "-110:+0"
                    });
                    $("#BtnReset").click(function () {
                        ClearErrors();
                    })
                });

                function ValidateForm() {
                    ClearErrors();
                    var isValid = true;
                    if ($("#TBFName").val().length == 0) {
                        isValid = false;
                        $("#SpanFNameError").show();
                    }
                    if ($("#TBLName").val().length == 0) {
                        isValid = false;
                        $("#SpanLNameError").show();
                    }
                    if ($('#DDState option:selected').val() == "XX") {
                        isValid = false;
                        $("#SpanStateError").show();
                    }
                    if ($("#DPdateOfBirth").val().length == 0) {
                        isValid = false;
                        $("#SpanDateError").show();
                    }
					if (!isValid)
                        $("#DivMessage").show();
					else {
						var dateArray = $("#DPdateOfBirth").val().split("/");
						$("#HTBDOB").val(dateArray[2]+"-"+dateArray[0]+"-"+dateArray[1]);
					}
                    return isValid;
                }

                function ClearErrors() {
                    $(".error").hide();
                }
            </script>
<?php
}
include "footer.php";
?>