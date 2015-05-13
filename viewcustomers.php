<?php
$title="View All Customers";
include "header.php";

include "php/DBConnect.php";
if ($conn->connect_errno) {
		echo "$mysqli->connect_errno";
}else{

	if ($connStatus){
		$selectSQL="SELECT * FROM customers";
		$result=$conn->query($selectSQL);
			if ($conn->error){
				echo "Query Error: $conn->error";
			}
			else{
				echo "<h2 class='center'>Customer List</h2>";
				echo "\n<table id='TblForm'>\n";
				echo "<tr><th>customer name</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>date of birth</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>state</th></tr>\n";
				if ($result) {
					if($result->num_rows === 0){
						echo "<tr><td colspan='5' class='center bold'>There are no customers.</td></tr>\n";
					}else{
						while($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>".$row["first"]." ".$row["last"]."</td>";
							echo "<td>&nbsp;</td>";
							echo "<td>".date('m/d/Y',strtotime($row["dob"]))."</td>";
							echo "<td>&nbsp;</td>";
							echo "<td>".$row["state"]."</td>";
							echo "</tr>\n";							
						}
					}
				}
				echo "</table>\n";				
			}		
	}
}
include "php/DBClose.php";
include "footer.php";
?>