<?php  
	function addMemberOrder($fullname, $email, $phone, $address){
		global $conn;
		$sql = "INSERT INTO members(fullname, email, phone, address) VALUES('$fullname', '$email', '$phone', '$address')";
		return mysqli_query($conn, $sql);
	}

	function addOrder($member_id, $note, $key_token){
		global $conn;
		$sql = "INSERT INTO `order`(member_id, note, key_token) VALUES($member_id, '$note', '$key_token')";
		return mysqli_query($conn, $sql);
	}


	function addCart($order_id, $id, $price, $quantity, $total){
		global $conn;
		$sql = "INSERT INTO 'shopping_cart'(order_id, product_id, price, quantity, total) VALUES($order_id, $id, $price, $quantity, $total)";
		return mysqli_query($conn, $sql);
	}