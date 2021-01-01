<?php 
include_once('conn.php'); 
session_start(); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>How to Sum Column in MySQL using PHP/MySQLi</title>
</head>
<body>
	<div style="float: left; width: auto;">
		<h3>Tabel Penjualan</h3>
		<table border="1">
			<th>Nama Produk</th>
			<th>Qty</th>

			<!-- Menampilkan semua data penjualan -->
			<?php
			$total_qty=0;

			//MySQLi OOP
			$query=$conn->query("SELECT * FROM sales LEFT JOIN product ON product.productid=sales.productid ORDER BY product.product_name ASC");

				while($row=$query->fetch_array()) {
					?>

					<tr>
						<td><?= $row['product_name']; ?></td>
						<td><?= $row['sales_qty']; ?></td>
					</tr>

					<?php 
					$total_qty += $row['sales_qty'];
				}
			?>

			<tr>
				<td><strong>TOTAL QTY</strong></td>
				<td><strong><?= $total_qty; ?></strong></td>
			</tr>
		</table>
	</div>
	<div style="float: left; margin-left: 100px; top: -300px;">
		<h3>Group By Produk</h3>
		<ul>
			
			<!-- Menampilkan jumlah total per item -->
			<?php 
			// MySQLi OOP
			$a=$conn->query("SELECT *, SUM(sales_qty) AS total_sales FROM sales LEFT JOIN product ON product.productid=sales.productid GROUP BY sales.productid");
			
			while($arow=$a->fetch_array()){
				?>
				<li>Total <?= $arow['product_name'] ?>: <?= $arow['total_sales']; ?></li>
				<?php 
			}
			?>

		</ul>
		<h3>Tambah Data Penjualan</h3>
		<form method="POST" action="add_sale.php">
			<select name="sales_product">
				<option value="0">Pilih Product</option>
				
				<!-- tampilkan data produk di combobox -->
				<?php
				$p=$conn->query("SELECT * FROM product");
				while($prow=$p->fetch_array()){
					?>
					<option value="<?= $prow['productid']; ?>"><?= $prow['product_name']; ?></option>
					<?php
				}	
				?>

			</select>
			Qty: <input type="text" name="sales_qty" required>
			<input type="submit" value="ADD">
		</form>
		<span>
			
			<?php
			if (isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset ($_SESSION['msg']);
			}
			?>

		</span>
	</div>
</body>
</html>