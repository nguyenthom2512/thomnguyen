<!-- Checkout Section Begin -->
<section class="shopping-cart">
    <div class="container">
        <?php  
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
       ?>
        <div class="row">
                <div class="col-lg-12">
                    <div class="shopping_cart_table" id="cart">
                    <form action="index.php?page=update_cart" method="POST" name="cart">
                        <table id="data-cart">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $_SESSION['sum_total'] = 0;
                                    foreach ($_SESSION['cart'] as $key => $value) {
                                ?>
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="assets/img/<?php echo $value['images']; ?>" alt="" width="100" heigh="100" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product__cart__item__text">
                                                    <h6><?php echo $value['product_name']; ?></h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <h5>$<?php echo $value['price']; ?></h5>
                                                </div>
                                            </td>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input style="width:80px; height:25px" min="1" max="5" type="number" pattern="[0-9]" class="update_cart" name="<?php echo $value['id']; ?>" value="<?php echo $value['qty']; ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                <?php  
                                                    $total = $value['price'] * $value['qty']; // Tổng tiền cho từng sản phẩm
                                                    $_SESSION['sum_total'] += $total; // Tổng tiền cho cả đơn hàng
                                                    echo '$'.$total.'.00';
                                                ?>
                                            </td>
                                            <td class="cart__close" width="100">
                                                <a onclick="return confirm('Xóa sản phẩm khỏi giỏ hàng? ');" href="index.php?page=delete_cart&id=<?php echo $value['id']; ?>">
                                                <i class="fas fa-trash-alt" style="color:black"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            }
            ?>
            </form>
            <div class="col-lg-4" id="total-price">
                <div class="cart__total total-price">
                    <div class="total_text">
                    <ul style="font-size: 20px; color: brown">
                        <li>Total <span>$<?php echo $_SESSION['sum_total']; ?>.00</span></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="checkout__input">
                            <div class="checkout__input">
                                <p>Full Name<span>*</span></p>
                                <input required="" type="text" name="fullname" />
                            </div>
                        </div>
                        <div class="checkout__input">
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input required="" type="text" name="email" />
                            </div>
                        </div>

                        <div class="checkout__input">
                            <div class="checkout__input">
                                <p>Phone<span>*</span></p>
                                <input required="" type="text" name="phone" />
                            </div>
                        </div>

                        <div class="checkout__input">
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input required="" type="text" name="address" />
                            </div>
                        </div>

                        
                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input name="note" type="text"
                            placeholder="Notes about your order, e.g. special notes for delivery.">
                            <br>
                            <button type="submit" name="order" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php 
    include_once 'function/order.php';
    if (isset($_POST['order'])) {
        // Thông tin người mua hàng
        $fullname   = $_POST['fullname'];
        $phone  = $_POST['phone'];
        $email  = $_POST['email'];
        $address = $_POST['address'];
        $note   = $_POST['note'];
        addMemberOrder($fullname, $email, $phone, $address);

        // Thông tin đơn hàng
        $member_id = mysqli_insert_id($conn);
        $key_token = md5($member_id.$phone);
        addOrder($member_id, $note, $key_token);

        $order_id = mysqli_insert_id($conn);

        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $key => $value) {
                $total = $value['price'] * $value['qty'];
                addCart($order_id, $value['id'], $value['price'], $value['qty'], $total);
            }
        }
        echo "<script>alert('Thank you for your order!');";
        echo "location.href='index.php'; </script>";


        unset($_SESSION['cart']);
    }
?>
<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<style>
    section.shopping-cart {
    padding-left: 300px;
    padding-top: 75px;
    }
    th {
    font-size: 17px;
    font-family: serif;
    padding-right: 70px;
    }
    h6, h5, td.cart__price {
    margin-right: 55px;
    font-size: 15px;
    color: brown;
    }
    img {
    margin-top: 5px;
    margin-right: 75px;
    }
    .continue__btn.update__btn {
    padding-left: 895px;
    }
    button.update {
    padding: 10px 30px;
    font-size: 15px;
    border-style: none;
    border-radius: 30px;
    background-color: #DC8665;
    color: white;
    }
    div#total-price {
    padding-top: 30px;
    }
    .total_text {
    padding-left: 900px;
    }
    section.checkout.spad {
    text-align: center;
    }
    h6.checkout__title {
    font-size: 30px;
    }
    .checkout__input {
    padding-top: 10px;
    }
    p {
    font-size: 18px;
    }
    input[type="text"] {
    width: 440px;
    height: 30px;
    }
    button.site-btn {
    margin-top: 35px;
    padding: 5px 35px;;
    background-color: #DC8665;
    border-radius: 30px;
    color: #fff;
    font-size: 18px;
    border: none;
    }
    .site-btn:hover {
		background-color: #CD7672;
		color: #041B2D;
	}
    </style>