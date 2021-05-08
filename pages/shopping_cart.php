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
                                                    <img src="assets/img/<?php echo $value['images']; ?>" alt="" width="200" height="200" />
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
                                                        <input style="width:80px; height:25px" type="number" class="update_cart" name="<?php echo $value['id']; ?>" value="<?php echo $value['qty']; ?>">
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
                                                <a onclick="return confirm('Are you sure you want to remove this item from your cart? ');" href="index.php?page=delete_cart&id=<?php echo $value['id']; ?>">
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
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <button type="submit" name="submit_cart" class="update">Update cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr style="width:1000px">
            <div class="col-lg-4" id="total-price">
                <div class="cart__total total-price">
                    <div class="total_text">
                    <ul style="font-size: 20px; color: brown">
                        <li>Total <span>$<?php echo $_SESSION['sum_total']; ?>.00</span></li>
                    </ul>
                    <a href="index.php?page=checkout" class="primary-btn" style="color:brown">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }else{
        ?>
            <div class="alert alert-danger">
                <button type="button" data-dismiss="alert" aria-hidden="true"></button>
                <img src="assets/img/empty.png" width="130" height="130"><br>
                <strong style="color: brown; font-size: 40px">Your Cart is Empty </strong><br>
                <a href="index.php" style="color:#6CA1AD">Continue Shopping</a>
            </div>
        <?php
            }
        ?>
    </div>
</section>
<style>
    section.shopping-cart {
    padding-left: 300px;
    padding-top: 75px;
    }
    th {
    font-size: 25px;
    font-family: serif;
    padding-right: 70px;
    }
    h6, h5, td.cart__price {
    margin-right: 55px;
    font-size: 20px;
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
    </style>