<?php
//header.php
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $title; ?></title>
    <link href="styles/styles.css" rel="stylesheet" />
    <link href="LIB/jquery-ui.css" rel="stylesheet" />
    <link href="LIB/jquery-ui.structure.css" rel="stylesheet" />
    <link href="LIB/jquery-ui.theme.css" rel="stylesheet" />
    <script src="scripts/jquery-2.1.3.min.js"></script>
    <script src="LIB/jquery-ui.min.js"></script>
</head>
<body>
    <div id="DivHeading">
        <img src="images/Banner.png" />
    </div>
    <div id="DivMenu">
        <a href="addcustomer.php"><input type="button" value="New Customer" /></a>
        <a href="viewcustomers.php"><input type="button" value="See All Customers" /></a>
		<a href="viewproducts.php"><input type="button" value="View All Products" /></a>
        <a href="addorder.php"><input type="button" value="Add Order" /></a>
        <a href="vieworders.php"><input type="button" value="View All Orders" /></a>
    </div>
    <div id="DivBody">
        <div id="DivContent">
		