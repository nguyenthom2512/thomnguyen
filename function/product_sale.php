<?php
include_once "config/myConnect.php";
function getProductSale(){
        global $conn;
        $result = array (); 
        $sql = "SELECT *FROM product_sale";
        $query = mysqli_query($conn, $sql);
		// mysqli_fetch_assoc: lấy dạng mảng từ đối tượng trung gian
        while ($row = mysqli_fetch_assoc($query)) {
			$result[] = $row;
		}
		return $result;
    }
    // Lấy thông tin sản phẩm khách hàng muốn mua
	function getID($id){
		global $conn;
		$result = array(); // ouput
		$sql = "SELECT *FROM product_sale WHERE id = $id";
		$query = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$result = $row;
		}
		return $result;
	}
?>