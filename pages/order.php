<?php 
	include_once 'function/product.php'; 
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];
		$product = getProductID($id);

		// $_SESSION['cart'] lưu thông tin sản phẩm khách hàng mua
		if (!isset($_SESSION['cart']) && empty($_SESSION['cart'])){
			$_SESSION['cart'][$id] = $product;
			$_SESSION['cart'][$id]['qty'] = 1;
		}else{
			if (array_key_exists($id, $_SESSION['cart'])) {
				$_SESSION['cart'][$id]['qty'] += 1;
			}else{
				$_SESSION['cart'][$id] = $product;
				$_SESSION['cart'][$id]['qty'] = 1;
			}
		}

		$_SESSION['noti-cart'] = '<i class="fas fa-check" id="yes"></i><br><p><b>Item added to your cart</b></p><a href="index.php?page=shopping_cart"><center><button class="view_detail">View Detail</button></center></a>';
        header('location: index.php?page=web_shop');
    }else {
        header('location: index.php?page=web_shop');
    }

?>