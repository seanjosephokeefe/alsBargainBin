<?php
$title="Add Order";
$dropDownName="none";
$errorMessage="none";
include "header.php";
include "php/DBConnect.php";
if ($conn->connect_errno) {
		echo "$mysqli->connect_errno";
}else{
	if ($connStatus){
		if (isset($_POST['submit'])){
			if ($_POST['submit']=="finish order")
				$finish=true;
			else
				$finish=false;
			$itemCount=0;
			$postCustomersSQL="SELECT CONCAT(name, '     $ ', price) AS 'product', name, price, product_id FROM products";
			$result=$conn->query($postCustomersSQL);
			if ($conn->error){
				echo "Query Error: $conn->error";
			}else{
				//Form has been submitted at least once
				$dropDownName="DDProducts";
				$errorMessage="Please Choose a product to add to the Order.";
				echo "<h2 class='center'>Order Information</h2>";
				if (!$finish)
					echo "<form method='post' name='frmProducts' action='addorder.php' onsubmit='return ValidateOrder();'>\n";
				echo "<p class='center'>Customer: ".$_POST['customername'];
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "Date: ".date("d/m/Y")."</p>\n";
				$productArray=array();
				include "php/Product.php";
				if (!$finish) {
					echo "<h2 class='center'>Step 2: Please add items to the order:</h2>\n";
					echo "<p class='center'>Products: \n<select id='".$dropDownName."' name='product_id'>\n";
					echo "<option value='XX'>Choose a product....</option>\n";
				}
				//Populate drop down
				while($row = mysqli_fetch_assoc($result)) {
					array_push($productArray, new Product($row["product_id"],$row["name"],$row["price"]));
					if (!$finish)
						echo "<option value='".$row["product_id"]."'>".$row["product"]."</option>\n";				
				}
				if (!$finish) {
					echo "</select>\n";			
					echo"</p>\n";
				}
				if (isset($_POST['product_id'])){
					//Add products in a table
					$itemCount=$_POST['itemcount'];
					$orderTotal=0;
					echo "<h4 class='center'>Order List</h4>";
					echo "\n<table id='TblForm'>\n";
					echo "<tr><th>item name</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>price</th></tr>\n";
					for ($i=1;$i<=$itemCount;$i++){
						$num=$_POST['item'.$i]-1; //Gets product number from post and adjusts for array index.
						echo "<tr>";
						echo "<td>".$productArray[$num]->name."</td>";
						echo "<td><input type='hidden' name='item".$i."' value='".$_POST['item'.$i]."' /></td>";
						echo "<td class='right'>$ ".$productArray[$num]->price."</td>";							
						echo "</tr>\n";
						$orderTotal += $productArray[$num]->price;						
					}
					if (!$finish) {
						$num=$_POST['product_id']-1;
						$itemCount++;
						echo "<tr>";
						echo "<td>".$productArray[$num]->name."</td>";
						echo "<td><input type='hidden' name='item".$itemCount."' value='".$_POST['product_id']."' /></td>";
						echo "<td class='right'>$ ".$productArray[$num]->price."</td>";							
						echo "</tr>\n";
						$orderTotal += $productArray[$num]->price;						
					}				
					echo "<tr><td>Total:</td><td colspan='2' class='right'>$ ".$orderTotal."</td></tr>\n";
					echo "</table>\n";
				}
				if (!$finish) {
					echo "<input type='hidden' id='HTBName' name='customername' value='".$_POST['customername']."' />\n";
					echo "<input type='hidden' name='customerid' value='".$_POST['customerid']."' />\n";
					echo "<input type='hidden' name='itemcount' value='".$itemCount."' />\n";
					echo "<p class='center'><input type='submit' value='add item' name='submit' />\n&nbsp;\n";
					if (isset($_POST['product_id'])) {
						echo "<input type='submit' value='finish order' name='submit' id='BtnFinish' />\n&nbsp;\n";
					}
					echo "<input type='reset' value='clear' id='BtnReset' />\n&nbsp;\n";
					echo "<a href='addorder.php'><input type='button' value='cancel order' /></a></p>\n";
					echo "</form>\n";
					echo "<div id='DivMessage' class='error center'></div>\n";
				}else{
					$insertOrderSQL="INSERT INTO orders (customer_id, order_date) VALUES ('".$_POST['customerid']."','".date("Y-m-d")."')";
					$conn->query($insertOrderSQL);
					if ($conn->error){
						echo "Query Error: $conn->error";
					}else{
						$orderID=mysqli_insert_id($conn);
						$insertProductsSQL="";
						for ($i=1;$i<=$itemCount;$i++){
							if ($i>1)
								$insertProductsSQL .= " ";
							$insertProductsSQL .= "INSERT INTO order_products (order_id, product_id) VALUES (".$orderID.", ".$_POST['item'.$i].");";
						}
						//Add order to database
						if ($itemCount==1)
							$result=$conn->query($insertProductsSQL);
						else
							$result=$conn->multi_query($insertProductsSQL);
						if ($conn->error){
							echo "Query Error: $conn->error";
						}
						else{
							if ($result)
								echo"<h2 class='center'>Thank you. Your order has been submitted.</h2>\n";
						}					
					}
				}
			}
		}else{
			$postCustomersSQL="SELECT CONCAT(first, ' ', last) AS 'customer_name', customer_id FROM customers";
			$result=$conn->query($postCustomersSQL);
			if ($conn->error){
				echo "Query Error: $conn->error";
			}else{	
				$dropDownName="DDCustomers";
				$errorMessage="Please Choose a Customer to Place their Order.";
				echo "<form method='post' action='addorder.php' onsubmit='return ValidateOrder();'>\n";
				echo "<h2 class='center'>Step 1: Please choose a customer:</h2>\n";		
				//New Form. First let them check for which customer ordering
				echo "<p class='center'>Customers: \n<select id='".$dropDownName."' name='customerid'>\n";
				echo "<option value='XX'>Please choose a customer to place the order for.</option>\n";
				//Populate drop down
				while($row = mysqli_fetch_assoc($result)) {
				echo "<option value='".$row["customer_id"]."'>".$row["customer_name"]."</option>\n";				
				}
				echo "</select>\n";			
				echo"</p>\n";
				echo "<input type='hidden' id='HTBName' name='customername' />\n";
				echo "<p class='center'><input type='submit' value='continue' name='submit' />&nbsp;".
				"<input type='reset' value='clear' id='BtnReset' /></p>\n";
				echo "</form>\n";
				echo "<div id='DivMessage' class='error center'></div>\n";
			}	
		}
	}
}
?>
<script type="text/javascript">
                var finish = false;
                function ClearOrderErrors() {
                    $('.error').hide();
                }
                $(document).ready(function () {
                    $('#BtnReset').click(function () {
                        ClearOrderErrors()
                    });
                    $('#BtnFinish').click(function () {
                        finish = true;
                    });
					$('#DDCustomers').change(function() {
						$("#HTBName").val($('#DDCustomers option:selected').text());
					});
                });
                function ValidateOrder() {
                    ClearOrderErrors();
                    var isValid = true;
                    if (!finish) {
                        if ($('#<?php echo $dropDownName; ?> option:selected').val() == "XX") {
                            isValid = false;
                            $("#DivMessage").show();
                            $("#DivMessage").html("<?php echo $errorMessage; ?>");
                        }
                    }
                    return isValid;
                }
</script>
<?php
include "php/DBClose.php";
include "footer.php";
?>