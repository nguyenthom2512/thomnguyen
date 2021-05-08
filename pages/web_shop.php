<?php 
    include_once 'function/product.php'; 
    $product = getProduct();
?>
<?php
    if(isset($_SESSION['noti-cart'])){
?>
    <div id="notification">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <?php echo $_SESSION['noti-cart']; ?>
        </div>
    </div>
<?php 
    }
    unset($_SESSION['noti-cart']);
?>

<link rel="stylesheet" href="./css/bootstrap.min.css">
<div id="preloder">
    <div class="loader"></div>
</div>
<div class="contanier">
<div class="sort">
	<form class="sb" method="post">
		<select>
			<option>Sort by</option>
			<option>Newest</option>
			<option>Price (low to high)</option>
			<option>Price (high to low)</option>
			<option>Name A-Z</option>
			<option>Name Z-A</option>
		</select>
	</form>
</div>
<div class="product_list">
    <div class="list">
        <?php  
            foreach ($product as $value) {
        ?>
            <div class="product__item">
                <img src="assets/img/<?php echo $value['images']; ?>" alt="" class="product__item-img" width="305px" height="380px">
                <div class="title">
                    <p class="text">
                        <?php echo $value['product_name']; ?>
                    </p>
                    <p class="price"><center>
                        $<?php echo $value['price']; ?></center>
                    </p>
                    <a href="index.php?page=order&id=<?php echo $value['id']; ?>"><button class="view">Add to cart</button></a>
                </div>
                
            </div>
    
        <?php
            }
        ?>
    </div>
</div>
<style>
    #notification{
        width: 300px;
        position: fixed;
        z-index: 999;
        right: 0;
        top: 31%;

    }
    .btn-info{
        border:none;
        padding: 5px;
    }
    .alert.alert-success {
    position: absolute;
    left: -575px;
    top: 150px;
    background: white;
    width: 300px;
    text-align: center;
    height: 140px;
    opacity:0.7;
    }
    b {
    font-size: 20px;
    font-family: -webkit-pictograph;
    }
    button.view_detail {
    padding: 5px;
    background-color: #DC8665;
    border-radius: 40px;
    margin-top:25px;
    }
    #yes{
    overflow: visible;
    color: green;
    height: 40px;
    width: 45px;
    }
</style>