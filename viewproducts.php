<?php
$title="View All Orders";
include "header.php";

include "php/DBConnect.php";
if ($conn->connect_errno) {
		echo "$mysqli->connect_errno";
}else{

	if ($connStatus){
		$selectSQL="SELECT * FROM products";
		$result=$conn->query($selectSQL);
			if ($conn->error){
				echo "Query Error: $conn->error";
			}
			else{
				echo "<h2 class='center'>Products List</h2>";
				echo "\n<table id='TblForm'>\n";
				echo "<tr><th>product name</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>price</th></tr>\n";
				if ($result) {
					if($result->num_rows === 0){
						echo "<tr><td colspan='3' class='center bold'>There are no products.</td></tr>\n";
					}else{
						while($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>".$row["name"]."</td>";
							echo "<td>&nbsp;</td>";
							echo "<td class='right'>$ ".$row["price"]."</td>";
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