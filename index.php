<?php
include_once 'config/myConnect.php';
include_once 'function/product.php';
include_once 'function/product_sale.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once 'include/head.php';?>
</head>
<body>
<div>
<?php include_once 'include/header.php';?>
</div>
<div class="container">
	<!-- Trang chủ -->
	<?php
                
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else {
            $page = 'home';
        }
        if(file_exists('pages/'.$page.'.php'))
            include_once 'pages/'.$page.'.php';

	?>
</div>
<div>
    <!-- Footer -->
	<?php include_once 'include/footer.php'; ?>
</div>
</body>
</html>

