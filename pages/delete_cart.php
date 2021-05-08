<?php  
	include_once 'function/product.php'; 
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];
		if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
			unset($_SESSION['cart'][$id]);
		}
	}
	
	header('location: index.php?page=shopping_cart');

?>