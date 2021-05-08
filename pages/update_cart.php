<?php  
	include_once 'function/product.php'; 
	if (isset($_POST['submit_cart'])) {
		unset($_POST['submit_cart']);

		foreach ($_POST as $id => $qty) {
			$_SESSION['cart'][$id]['qty'] = $qty;
		}

		header('location: index.php?page=shopping_cart');

		
	}

?>