<?php
//PopulateDropDownState.php
include "DBConnect.php";
if ($conn->connect_errno) {
		echo "$mysqli->connect_errno";
}else{
	if ($connStatus){
		$ddSQL="SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'customers' AND COLUMN_NAME = 'state'";
		$result=$conn->query($ddSQL);
		if ($conn->error){
			echo "$mysqli->error";
		}
		else{
			$row = mysqli_fetch_array($result);
			$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
			echo "\n".'<select id="DDState" name="state">'."\n";
			echo "\n<option value=\"XX\">Please choose a state...</option>\n";
			foreach($enumList as $value)
				echo "<option value=\"$value\">$value</option>\n";
			echo "</select>\n";				
		}
	}
}
include "DBClose.php";
?>