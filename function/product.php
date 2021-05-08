<?php
session_start();
include_once "config/myConnect.php";
function getProduct(){
        global $conn;
        $result = array (); 
        $sql = "SELECT *FROM product";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
			$result[] = $row;
		}
		return $result;
    }
    // Lấy thông tin sản phẩm khách hàng muốn mua
	function getProductID($id){
		global $conn;
		$result = array(); // ouput

		$sql = "SELECT *FROM product WHERE id = $id";
		$query = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$result = $row;
		}
		return $result;
	}
?>