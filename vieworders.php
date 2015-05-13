<?php
$title="View All Orders";
include "header.php";

include "php/DBConnect.php";
if ($conn->connect_errno) {
		echo "$mysqli->connect_errno";
}else{
	if ($connStatus){
		if (isset($_POST['submit'])){
		// Beginning of view an order........................................
			$selectSQL = "select p.name, p.price, CONCAT(c.first, ' ', c.last) AS 'customer_name', o.order_date ". 
						"FROM products p, customers c, orders o, order_products op ".
						"WHERE p.product_id = op.product_id AND ".
						"op.order_id = o.order_id AND ".
						"o.customer_id = c.customer_id AND ".
						"o.order_id = ".$_POST['submit'].";";
			$result=$conn->query($selectSQL);
			if ($conn->error){
				echo "Query Error: $conn->error";
			}
			else{
				$initial=true;
				$orderTotal=0;
				echo "<h2 class='center'>Order Details</h2>\n";
				if ($result) {				
						if($result->num_rows === 0){
							echo "<h3 class='center'>That order can not be viewed right now.</h3>\n";
						}else{				
							while($row = mysqli_fetch_assoc($result)) {
								if ($initial){
									//Set customer name and order date
									echo "<h3 class='center'>Customer: ".$row["customer_name"];
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									echo "Order Date: ".date('m/d/Y',strtotime($row["order_date"]))."</h3>\n";
									echo "\n<table id='TblForm'>\n";
									echo "<tr>";
									echo "<th>Product</th>";
									echo "<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>";
									echo "<th>Price</th>";
									echo "</tr>\n";													
									$initial=false;
								}
								//display each item in a table
								echo "<tr>";
								echo "<td>".$row["name"]."</td>";
								echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
								echo "<td class='right'>$ ".$row["price"]."</td>";
								echo "</tr>\n";									
								//start tallying total
								$orderTotal+=$row["price"];
							}
							echo "<tr><td class='right bold' colspan='3'>Order Total: $ ".$orderTotal."</td></tr>\n";
							//Display order total now
						echo "</table>\n";	
						}				
				}				
			}
		//End of view a single order..........................................
		}else{
			// Beginning of If Form is visited for the first time
			$selectSQL = "SELECT CONCAT(a.first, ' ', a.last) AS 'customer_name', b.order_id, b.order_date AS 'order_date', ".
			"SUM(c.price) AS 'order_total' FROM customers a, orders b, products c, order_products d WHERE a.customer_id".
			" = b.customer_id AND b.order_id = d.order_id AND d.product_id = c.product_id GROUP BY b.order_id;";
			$result=$conn->query($selectSQL);
				if ($conn->error){
					echo "Query Error: $conn->error";
				}
				else{
					echo "<form method='post' action='vieworders.php'>";
					echo "<h2 class='center'>Orders List</h2>";
					echo "\n<table id='TblForm'>\n";
					echo "<tr><th>customer name</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>date of order</th>".
					"<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>order total</th><th></th></tr>\n";
					if ($result) {
						if($result->num_rows === 0){
							echo "<tr><td colspan='5' class='center bold'>There are no orders.</td></tr>\n";
						}else{
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>".$row["customer_name"]."</td>";
								echo "<td>&nbsp;</td>";
								echo "<td>".date('m/d/Y',strtotime($row["order_date"]))."</td>";
								echo "<td>&nbsp;</td>";
								echo "<td class='right'>$ ".$row["order_total"]."</td>";
								echo "<td><button type='submit' name='submit' value='".$row["order_id"]."'>view order</button></td>";
								echo "</tr>\n";							
							}
						}
					}
					echo "</table>\n";
					echo "</form>";				
				}
			// End of If Form is visited for the first time	
		}
	}
}
include "php/DBClose.php";
include "footer.php";
?>