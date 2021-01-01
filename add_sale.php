<?php
	
	include('conn.php');
	session_start();
	$product=$_POST['sales_product'];
	$qty=$_POST['sales_qty'];
		if ($product==0){
			$_SESSION['msg']="Please select a product";
			header('location:index.php');
		}
		else{
			
			//MySQLi OOP
			$conn->query("insert into sales (productid,sales_qty) values ('$product','$qty')");
			header('location:index.php');
		}
?>